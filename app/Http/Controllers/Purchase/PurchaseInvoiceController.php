<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\BankTransaction;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\ConsumerLogin;
use App\Models\Product;
use App\Models\CartTemporary;
use App\Models\CartTemporaryItem;
use App\Models\CartTemporaryPayment;
use App\Models\CartInformtion;
use App\Models\CartItem;
use App\Models\FinalStockTable;
use App\Models\PurchaseDetail;
use App\Models\PurchaseInfo;
use App\Models\PurchaseTemporary;
use App\Models\PurchaseTemporaryItem;
use App\Models\Store;
use App\Models\SubCategoryOne;
use App\Models\Supplier;
use App\Models\SupplierPayment;
use App\Models\UnitDefinition;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PurchaseInvoiceController extends Controller
{
    public function index()
    {
        return view('purchase/purchaseForm');
    }

    public function getAjaxCategory()
    {
        $ProductCategory = ProductCategory::where('is_active', 1)->get();
        return response()->json($ProductCategory);
    }

    public function purchaseSubCategory($id)
    {
        $category_id = $id;
        $SalesSubCat = ProductCategory::join('sub_category_one', 'sub_category_one.category_id', '=', 'product_category.category_id')
            ->where('product_category.category_id', '=', $category_id)
            ->select('sub_category_one.*')
            ->get();
        return response()->json($SalesSubCat);
    }

    public function purchaseCategoryWiseItems($id)
    {
        $SalesProducts = SubCategoryOne::join('products', 'products.sc_one_id', '=', 'sub_category_one.sc_one_id')
            //->leftJoin('final_stock_table', 'final_stock_table.product_id', '=', 'products.product_id')
            //->leftJoin('stores', 'stores.store_id', '=', 'final_stock_table.store_id')
            ->where('products.sc_one_id', '=', $id)
            ->where('products.is_active', 1)
            ->select(
                'products.product_name',
                'products.product_id'
            )
            ->get();
        return response()->json($SalesProducts);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function autocompleteMobileNo($id)
    {
        $data = ConsumerLogin::select("mobile_no")
            ->where("mobile_no", "LIKE", '%' . $id . '%')
            ->get();

        return response()->json($data);
    }

    public function getSuspendedItems()
    {
        $suspended = CartTemporary::where('is_suspended', 1)->get();

        return response()->json([
            'status' => true,
            'suspend_data' => $suspended
        ], 200);
    }
    public function getSuspendedData($id)
    {
        $cart_temporary_data = CartTemporary::join('cart_temporary_items', 'cart_temporary_items.temp_cart_id', '=', 'cart_temporary.temp_cart_id')
            ->join('products', 'products.product_id', '=', 'cart_temporary_items.product_id')
            ->where('cart_temporary.temp_cart_id', '=', $id)
            ->select(
                'cart_temporary_items.*',
                'cart_temporary.*',
                'products.product_id',
                'products.product_name',
                'products.cost_price',
                'products.sales_price',
                'products.unit_type',
                'products.image_path',
                'products.product_image',
                'products.sku_no',
                'products.is_active'
            )
            ->get();
        $cart_temporary_update_all = CartTemporary::where('cart_temporary.temp_cart_id', '<>', $id)->update(['is_suspended' => '1']);

        $cart_temporary_update = CartTemporary::where('cart_temporary.temp_cart_id', '=', $id)->update(['is_suspended' => '0']);


        $items = $cart_temporary_data->count();
        $subtotal = 0;
        $quantity = 0;
        $total_discount = 0;
        $total = 0;
        $table_no = 0;
        $vat = 0;
        foreach ($cart_temporary_data as $data) {
            $subtotal += $data->temp_net_amount;
            $total_discount += $data->total_discount;
            $quantity += $data->quantity;
            $temp_cart_id = $data->temp_cart_id;
            $table_no = $data->table_no;
            $vat += $data->vat;
        }
        $total = $subtotal - $total_discount + $vat;;
        $paid_amount = 0;
        $due_amount = $total;
        $transaction_data = array('temp_cart_id' => $temp_cart_id, 'quantity' => $quantity, 'items' => $items, 'subtotal' => $subtotal, 'total_discount' => $total_discount, 'total_payable' => $total, 'total' => $total, 'paid_amount' => $paid_amount, 'due_amount' => $due_amount, 'vat' => $vat);

        $IsPaymentExists = CartTemporaryPayment::where('cart_temporary_id', $temp_cart_id)->exists();
        $TempPaymentdata = CartTemporaryPayment::where('cart_temporary_id', $temp_cart_id)->first();

        return response()->json([
            'status' => true,
            'transaction_data' => $transaction_data,
            'cart_temporary_data' => $cart_temporary_data,
            'IsPaymentExists' => $IsPaymentExists,
            'TempPaymentdata' => $TempPaymentdata,
            'table_no' => $table_no
        ], 200);
    }

    public function addSalesItemsWithBarcode(Request $request, $barcode, $msg)
    {
        $barcode = $barcode;
        $products = Product::where('barcode', $barcode)->first();

        if (!$products) {
            return response()->json("Barcode Not Found");
        }

        $product_id = $products->product_id;

        if ($msg == "false") {

            if (!$request->session()->has("Temp_Consumer_ID")) {
                $request->session()->put('Temp_Consumer_ID', $this->random_strings(5));
            }
            if (!$request->session()->has("From_Ip")) {
                $request->session()->put('From_Ip', $request->ip());
            }

            // return $request->session()->pull('Temp_Consumer_ID');

            $created_by = session()->get('LoggedUser');
            $from_ip = $request->session()->get('From_Ip');
            $temporary_consumer_id = $request->session()->get('Temp_Consumer_ID');
            $temp_cart_date = Carbon::now();

            $cart_temporary = new CartTemporary();
            $cart_temporary->temporary_consumer_id = $temporary_consumer_id;
            $cart_temporary->create_date = $temp_cart_date;
            $cart_temporary->from_ip = $from_ip;
            $cart_temporary->created_by = $created_by;
            $cart_temporary->is_suspended = 0;
            $cart_temporary->save();

            $cart_temporary_items = new CartTemporaryItem();
            $cart_temporary_items->temp_cart_id = $cart_temporary->temp_cart_id;
            $cart_temporary_items->product_id = $products->product_id;
            $cart_temporary_items->quantity = 1;
            $cart_temporary_items->vat = ($products->vat) * ($cart_temporary_items->quantity);
            $cart_temporary_items->total_discount = 0;
            $cart_temporary_items->temp_net_amount = (($cart_temporary_items->quantity) * ($products->sales_price));
            $cart_temporary_items->save();

            $cart_temporary_data = CartTemporary::join('cart_temporary_items', 'cart_temporary_items.temp_cart_id', '=', 'cart_temporary.temp_cart_id')
                ->join('products', 'products.product_id', '=', 'cart_temporary_items.product_id')
                ->where('cart_temporary.temp_cart_id', '=', $cart_temporary->temp_cart_id)
                ->select(
                    'cart_temporary_items.*',
                    'cart_temporary.*',
                    'products.product_id',

                    'products.product_name',
                    'products.cost_price',
                    'products.sales_price',
                    'products.unit_type',
                    'products.image_path',
                    'products.product_image',
                    'products.sku_no',
                    'products.is_active',
                )
                ->get();

            $items = $cart_temporary_data->count();
            $subtotal = 0;
            $quantity = 0;
            $total_discount = 0;
            $total = 0;
            $vat = 0;
            foreach ($cart_temporary_data as $data) {
                $subtotal += $data->temp_net_amount;
                $total_discount += $data->total_discount;
                $quantity += $data->quantity;
                $temp_cart_id = $data->temp_cart_id;
                $vat += $data->vat;
            }
            $total = $subtotal - $total_discount + $vat;;
            $paid_amount = 0;
            $due_amount = $total;
            $transaction_data = array('temp_cart_id' => $temp_cart_id, 'quantity' => $quantity, 'items' => $items, 'subtotal' => $subtotal, 'discount_amount' => $total_discount, 'total_payable' => $total, 'paid_amount' => $paid_amount, 'due_amount' => $due_amount, 'vat' => $vat);

            return response()->json([
                'status' => true,
                'success' => 'Product Added to Cart',
                'transaction_data' => $transaction_data,
                'cart_temporary_data' => $cart_temporary_data
            ], 200);
            return response()->json("false");
        } else {

            $temp_cart_check = CartTemporary::join('cart_temporary_items', 'cart_temporary_items.temp_cart_id', '=', 'cart_temporary.temp_cart_id')
                ->join('products', 'products.product_id', '=', 'cart_temporary_items.product_id')
                ->where('cart_temporary.temp_cart_id', '=', $msg)
                ->where('cart_temporary_items.product_id', '=', $product_id)
                ->exists();
            if ($temp_cart_check) {
                $cart_temporary_items = CartTemporaryItem::where('cart_temporary_items.temp_cart_id', '=', $msg)
                    ->where('cart_temporary_items.product_id', '=', $product_id)->first();
                $cart_temporary_items->quantity = ($cart_temporary_items->quantity) + 1;
                $cart_temporary_items->vat = ($products->vat) * ($cart_temporary_items->quantity);
                $cart_temporary_items->temp_net_amount = (($cart_temporary_items->quantity) * ($products->sales_price));
                $cart_temporary_items->update();

                $cart_temporary_data = CartTemporary::join('cart_temporary_items', 'cart_temporary_items.temp_cart_id', '=', 'cart_temporary.temp_cart_id')
                    ->join('products', 'products.product_id', '=', 'cart_temporary_items.product_id')
                    ->where('cart_temporary.temp_cart_id', '=', $msg)
                    ->select(
                        'cart_temporary_items.*',
                        'cart_temporary.*',
                        'products.product_id',

                        'products.product_name',
                        'products.cost_price',
                        'products.sales_price',
                        'products.unit_type',
                        'products.image_path',
                        'products.product_image',
                        'products.sku_no',
                        'products.is_active',
                    )
                    ->get();

                $items = $cart_temporary_data->count();
                $subtotal = 0;
                $quantity = 0;
                $total_discount = 0;
                $total = 0;
                $vat = 0;
                foreach ($cart_temporary_data as $data) {
                    $subtotal += $data->temp_net_amount;
                    $total_discount += $data->total_discount;
                    $quantity += $data->quantity;
                    $temp_cart_id = $data->temp_cart_id;
                    $vat += $data->vat;
                }
                $total = $subtotal - $total_discount + $vat;;
                $paid_amount = 0;
                $due_amount = $total;
                $transaction_data = array('temp_cart_id' => $temp_cart_id, 'quantity' => $quantity, 'items' => $items, 'subtotal' => $subtotal, 'discount_amount' => $total_discount, 'total_payable' => $total, 'paid_amount' => $paid_amount, 'due_amount' => $due_amount, 'vat' => $vat);

                return response()->json([
                    'status' => true,
                    'success' => 'Product Added to Cart',
                    'transaction_data' => $transaction_data,
                    'cart_temporary_data' => $cart_temporary_data
                ], 200);
            } else {

                $cart_temporary_items = new CartTemporaryItem();
                $cart_temporary_items->temp_cart_id = $msg;
                $cart_temporary_items->product_id = $product_id;
                $cart_temporary_items->quantity = 1;
                $cart_temporary_items->vat = ($products->vat) * ($cart_temporary_items->quantity);
                $cart_temporary_items->total_discount = 0;
                $cart_temporary_items->temp_net_amount = (($cart_temporary_items->quantity) * ($products->sales_price));
                $cart_temporary_items->save();

                $cart_temporary_data = CartTemporary::join('cart_temporary_items', 'cart_temporary_items.temp_cart_id', '=', 'cart_temporary.temp_cart_id')
                    ->join('products', 'products.product_id', '=', 'cart_temporary_items.product_id')
                    ->where('cart_temporary.temp_cart_id', '=', $msg)
                    ->select(
                        'cart_temporary_items.*',
                        'cart_temporary.*',
                        'products.product_id',

                        'products.product_name',
                        'products.cost_price',
                        'products.sales_price',
                        'products.unit_type',
                        'products.image_path',
                        'products.product_image',
                        'products.sku_no',
                        'products.is_active',
                    )
                    ->get();

                $items = $cart_temporary_data->count();
                $subtotal = 0;
                $quantity = 0;
                $total_discount = 0;
                $total = 0;
                $vat = 0;
                foreach ($cart_temporary_data as $data) {
                    $subtotal += $data->temp_net_amount;
                    $total_discount += $data->total_discount;
                    $quantity += $data->quantity;
                    $temp_cart_id = $data->temp_cart_id;
                    $vat += $data->vat;
                }
                $total = $subtotal - $total_discount + $vat;
                $paid_amount = 0;
                $due_amount = $total;
                $transaction_data = array('temp_cart_id' => $temp_cart_id, 'quantity' => $quantity, 'items' => $items, 'subtotal' => $subtotal, 'discount_amount' => $total_discount, 'total_payable' => $total, 'paid_amount' => $paid_amount, 'due_amount' => $due_amount, 'vat' => $vat);

                return response()->json([
                    'status' => true,
                    'success' => 'Product Added to Cart',
                    'transaction_data' => $transaction_data,
                    'cart_temporary_data' => $cart_temporary_data
                ], 200);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addPurchaseItemToTempCart(Request $request, $id, $msg)
    {
        $product_id = $id;

        $pur_date = Carbon::now();
        $check = PurchaseInfo::where('is_completed', 0)->exists();
        if ($check) {
            $PurchaseInfo = PurchaseInfo::where('is_completed', 0)->first();
        } else {
            $PurchaseInfo = new PurchaseInfo();
            $PurchaseInfo->pur_date = $pur_date;
            $PurchaseInfo->is_completed = 0;
            $PurchaseInfo->paid_status = 0;
            $PurchaseInfo->save();
        }

        $PurchaseDetail = new PurchaseDetail();
        $PurchaseDetail->product_id = $product_id;
        $PurchaseDetail->purchase_id = $PurchaseInfo->purchase_id;
        $PurchaseDetail->save();

        $PurchaseData = PurchaseInfo::leftJoin('purchase_details', 'purchase_details.purchase_id', '=', 'purchase_info.purchase_id')
            ->leftJoin('products', 'products.product_id', '=', 'purchase_details.product_id')
            ->where('purchase_info.is_completed', 0)
            ->select('purchase_info.*', 'purchase_details.*', 'products.*')
            ->get();

        return response()->json([
            'status' => true,
            'success' => 'Product Added to Purchase',
            'purchase_data' => $PurchaseData,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function purchasedTempCartData($id)
    {
        $PurchaseData = PurchaseInfo::leftJoin('purchase_details', 'purchase_details.purchase_id', '=', 'purchase_info.purchase_id')
            ->leftJoin('products', 'products.product_id', '=', 'purchase_details.product_id')
            ->where('purchase_info.is_completed', 0)
            ->select('purchase_info.*', 'purchase_details.*', 'products.*')
            ->get();

        return response()->json([
            'status' => true,
            'success' => 'Product Added to Purchase',
            'purchase_data' => $PurchaseData,
        ], 200);
    }

    public function storePurchaseProductData(Request $request)
    {

        $product_id = $request->product_id;

        if ($request->msg == "false") {

            if (!$request->session()->has("Temp_Consumer_ID")) {
                $request->session()->put('Temp_Consumer_ID', $this->random_strings(5));
            }
            if (!$request->session()->has("From_Ip")) {
                $request->session()->put('From_Ip', $request->ip());
            }

            // return $request->session()->pull('Temp_Consumer_ID');

            $created_by = session()->get('LoggedUser');
            $from_ip = $request->session()->get('From_Ip');
            $temporary_consumer_id = $request->session()->get('Temp_Consumer_ID');
            $temp_cart_date = Carbon::now();

            $cart_temporary = new PurchaseTemporary();
            $cart_temporary->temporary_consumer_id = $temporary_consumer_id;
            $cart_temporary->create_date = $temp_cart_date;
            $cart_temporary->from_ip = $from_ip;
            $cart_temporary->created_by = $created_by;
            $cart_temporary->is_suspended = 0;
            $cart_temporary->save();

            $cart_temporary_items = new PurchaseTemporaryItem();
            $cart_temporary_items->purchase_temporary_id = $cart_temporary->purchase_temporary_id;
            $cart_temporary_items->product_id = $request->product_id;
            $cart_temporary_items->unit_id = $request->unit_id;
            $cart_temporary_items->quantity = $request->quantity;
            $cart_temporary_items->purchase_price = $request->purchase_price;
            $cart_temporary_items->sales_price = $request->sales_price;
            $cart_temporary_items->wholesale_price = $request->wholesale_price;
            $cart_temporary_items->vat = ($request->vat) * ($request->quantity);
            $cart_temporary_items->discount = $request->discount;
            $cart_temporary_items->temp_net_amount = (($cart_temporary_items->quantity) * ($request->purchase_price));
            $cart_temporary_items->save();

            $cart_temporary_data = PurchaseTemporary::join('purchase_temporary_items', 'purchase_temporary_items.purchase_temporary_id', '=', 'purchase_temporaries.purchase_temporary_id')
                ->join('products', 'products.product_id', '=', 'purchase_temporary_items.product_id')
                ->where('purchase_temporaries.purchase_temporary_id', '=', $cart_temporary->purchase_temporary_id)
                ->select(
                    'purchase_temporary_items.*',
                    'purchase_temporaries.*',
                    'products.product_id',
                    'products.product_name',
                    'products.unit_type',
                    'products.image_path',
                    'products.product_image',
                    'products.sku_no',
                    'products.is_active',
                )
                ->get();

            $items = $cart_temporary_data->count();
            $subtotal = 0;
            $quantity = 0;
            $total_discount = 0;
            $total = 0;
            $vat = 0;
            foreach ($cart_temporary_data as $data) {
                $subtotal += $data->temp_net_amount;
                $total_discount += $data->discount;
                $quantity += $data->quantity;
                $purchase_temporary_id = $data->purchase_temporary_id;
                $vat += $data->vat;
            }
            $total = $subtotal - $total_discount + $vat;;
            $paid_amount = 0;
            $due_amount = $total;
            $transaction_data = array('purchase_temporary_id' => $purchase_temporary_id, 'quantity' => $quantity, 'items' => $items, 'subtotal' => $subtotal, 'discount_amount' => $total_discount, 'total_payable' => $total, 'paid_amount' => $paid_amount, 'due_amount' => $due_amount, 'vat' => $vat);

            return response()->json([
                'status' => true,
                'success' => 'Product Added to Cart',
                'transaction_data' => $transaction_data,
                'cart_temporary_data' => $cart_temporary_data
            ], 200);
        } else {

            $temp_cart_check = PurchaseTemporary::join('purchase_temporary_items', 'purchase_temporary_items.purchase_temporary_id', '=', 'purchase_temporaries.purchase_temporary_id')
                ->join('products', 'products.product_id', '=', 'purchase_temporary_items.product_id')
                ->where('purchase_temporaries.purchase_temporary_id', '=', $request->msg)
                ->where('purchase_temporary_items.product_id', '=', $product_id)
                ->exists();

            if ($temp_cart_check) {
                $cart_temporary_items = PurchaseTemporaryItem::where('purchase_temporary_items.purchase_temporary_id', '=', $request->msg)
                    ->where('purchase_temporary_items.product_id', '=', $product_id)->first();
                $cart_temporary_items->quantity = $request->quantity;
                $cart_temporary_items->purchase_price = $request->purchase_price;
                $cart_temporary_items->unit_id = $request->unit_id;
                $cart_temporary_items->sales_price = $request->sales_price;
                $cart_temporary_items->discount = $request->discount;
                $cart_temporary_items->wholesale_price = $request->wholesale_price;
                $cart_temporary_items->vat = ($request->vat) * ($request->quantity);
                $cart_temporary_items->temp_net_amount = (($cart_temporary_items->quantity) * ($request->purchase_price));
                $cart_temporary_items->update();

                $cart_temporary_data = PurchaseTemporary::join('purchase_temporary_items', 'purchase_temporary_items.purchase_temporary_id', '=', 'purchase_temporaries.purchase_temporary_id')
                    ->join('products', 'products.product_id', '=', 'purchase_temporary_items.product_id')
                    ->where('purchase_temporaries.purchase_temporary_id', '=', $cart_temporary_items->purchase_temporary_id)
                    ->select(
                        'purchase_temporary_items.*',
                        'purchase_temporaries.*',
                        'products.product_id',
                        'products.product_name',
                        'products.unit_type',
                        'products.image_path',
                        'products.product_image',
                        'products.sku_no',
                        'products.is_active',
                    )
                    ->get();

                $items = $cart_temporary_data->count();
                $subtotal = 0;
                $quantity = 0;
                $total_discount = 0;
                $total = 0;
                $vat = 0;
                foreach ($cart_temporary_data as $data) {
                    $subtotal += $data->temp_net_amount;
                    $total_discount += $data->discount;
                    $quantity += $data->quantity;
                    $purchase_temporary_id = $data->purchase_temporary_id;
                    $vat += $data->vat;
                }
                $total = $subtotal - $total_discount + $vat;;
                $paid_amount = 0;
                $due_amount = $total;
                $transaction_data = array('purchase_temporary_id' => $purchase_temporary_id, 'quantity' => $quantity, 'items' => $items, 'subtotal' => $subtotal, 'discount_amount' => $total_discount, 'total_payable' => $total, 'paid_amount' => $paid_amount, 'due_amount' => $due_amount, 'vat' => $vat);

                return response()->json([
                    'status' => true,
                    'success' => 'Product Added to Cart',
                    'transaction_data' => $transaction_data,
                    'cart_temporary_data' => $cart_temporary_data
                ], 200);
            } else {

                $cart_temporary_items = new PurchaseTemporaryItem();
                $cart_temporary_items->purchase_temporary_id = $request->msg;
                $cart_temporary_items->product_id = $request->product_id;
                $cart_temporary_items->unit_id = $request->unit_id;
                $cart_temporary_items->quantity = $request->quantity;
                $cart_temporary_items->purchase_price = $request->purchase_price;
                $cart_temporary_items->sales_price = $request->sales_price;
                $cart_temporary_items->wholesale_price = $request->wholesale_price;
                $cart_temporary_items->vat = ($request->vat) * ($request->quantity);
                $cart_temporary_items->discount = $request->discount;
                $cart_temporary_items->temp_net_amount = (($cart_temporary_items->quantity) * ($request->purchase_price));
                $cart_temporary_items->save();

                $cart_temporary_data = PurchaseTemporary::join('purchase_temporary_items', 'purchase_temporary_items.purchase_temporary_id', '=', 'purchase_temporaries.purchase_temporary_id')
                    ->join('products', 'products.product_id', '=', 'purchase_temporary_items.product_id')
                    ->where('purchase_temporaries.purchase_temporary_id', '=', $cart_temporary_items->purchase_temporary_id)
                    ->select(
                        'purchase_temporary_items.*',
                        'purchase_temporaries.*',
                        'products.product_id',
                        'products.product_name',
                        'products.unit_type',
                        'products.image_path',
                        'products.product_image',
                        'products.sku_no',
                        'products.is_active',
                    )
                    ->get();

                $items = $cart_temporary_data->count();
                $subtotal = 0;
                $quantity = 0;
                $total_discount = 0;
                $total = 0;
                $vat = 0;
                foreach ($cart_temporary_data as $data) {
                    $subtotal += $data->temp_net_amount;
                    $total_discount += $data->discount;
                    $quantity += $data->quantity;
                    $purchase_temporary_id = $data->purchase_temporary_id;
                    $vat += $data->vat;
                }
                $total = $subtotal - $total_discount + $vat;;
                $paid_amount = 0;
                $due_amount = $total;
                $transaction_data = array('purchase_temporary_id' => $purchase_temporary_id, 'quantity' => $quantity, 'items' => $items, 'subtotal' => $subtotal, 'discount_amount' => $total_discount, 'total_payable' => $total, 'paid_amount' => $paid_amount, 'due_amount' => $due_amount, 'vat' => $vat);

                return response()->json([
                    'status' => true,
                    'success' => 'Product Added to Cart',
                    'transaction_data' => $transaction_data,
                    'cart_temporary_data' => $cart_temporary_data
                ], 200);
            }
        }
    }

    public function purchaseTempCartData($id)
    {
        $cart_temporary_data = PurchaseTemporary::join('purchase_temporary_items', 'purchase_temporary_items.purchase_temporary_id', '=', 'purchase_temporaries.purchase_temporary_id')
            ->join('products', 'products.product_id', '=', 'purchase_temporary_items.product_id')
            ->where('purchase_temporaries.created_by', '=', $id)
            ->where('purchase_temporaries.is_suspended', '=', 0)
            ->select(
                'purchase_temporary_items.*',
                'purchase_temporaries.*',
                'products.product_id',
                'products.product_name',
                'products.unit_type',
                'products.image_path',
                'products.product_image',
                'products.sku_no',
                'products.is_active',
            )
            ->get();

        $items = $cart_temporary_data->count();
        $subtotal = 0;
        $quantity = 0;
        $total_discount = 0;
        $total = 0;
        $vat = 0;
        foreach ($cart_temporary_data as $data) {
            $subtotal += $data->temp_net_amount;
            $total_discount += $data->discount;
            $quantity += $data->quantity;
            $purchase_temporary_id = $data->purchase_temporary_id;
            $vat += $data->vat;
        }
        $total = $subtotal - $total_discount + $vat;;
        $paid_amount = 0;
        $due_amount = $total;
        $transaction_data = array('purchase_temporary_id' => $purchase_temporary_id, 'quantity' => $quantity, 'items' => $items, 'subtotal' => $subtotal, 'discount_amount' => $total_discount, 'total_payable' => $total, 'paid_amount' => $paid_amount, 'due_amount' => $due_amount, 'vat' => $vat);

        return response()->json([
            'status' => true,
            'success' => 'Product Added to Cart',
            'transaction_data' => $transaction_data,
            'cart_temporary_data' => $cart_temporary_data
        ], 200);
    }

    public function storePurchaseForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'paid_amount' => 'numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'transaction_data' => $validator->errors("paid_amount")
            ], 200);
        }
        if (!$request->temp_cart_id) {
            return response()->json([
                'temp_cart_id_error' => false,
                'error' => "List is Empty"
            ], 200);
        }
        if (!$request->store_id) {
            return response()->json([
                'store_id_error' => false,
                'error' => "Please Select Location"
            ], 200);
        }

        $pur_date = Carbon::now();
        $purchase_temporary_id = $request->temp_cart_id;

        $Purchase = new PurchaseInfo();
        $Purchase->ref_no = $request->ref_no;
        $Purchase->notes = $request->notes;
        $Purchase->store_id = $request->store_id;
        $Purchase->supplier_id = $request->supplyer_id;
        $Purchase->pur_date = $pur_date;
        $Purchase->paid_amount = $request->paid_amount;
        $Purchase->save();

        $puechase_temporary = PurchaseTemporary::where('purchase_temporary_id', $purchase_temporary_id)->first();
        $purchase_temporary_items = PurchaseTemporaryItem::where('purchase_temporary_id', $purchase_temporary_id)->get();

        foreach ($purchase_temporary_items as $items) {

            $details = new PurchaseDetail();
            $details->purchase_id = $Purchase->purchase_id;
            $details->product_id = $items->product_id;
            $details->unit_id = $items->unit_id;
            $details->quantity = $items->quantity;
            $details->purchase_price = $items->purchase_price;
            $details->wholesale_price = $items->wholesale_price;
            $details->sales_price = $items->sales_price;
            $details->total_purchase_price = $items->temp_net_amount;
            $details->discount = $items->discount;
            $details->vat = $items->vat;
            $details->save();

            $FinalStockTable = new FinalStockTable();
            $FinalStockTable->total_purchased_quantity = $items->quantity;
            $FinalStockTable->total_sold_quantity = 0;
            $FinalStockTable->total_ordered_quantity = 0;
            $FinalStockTable->in_order_queue = 0;
            $FinalStockTable->temp_quantity = $items->quantity;
            $FinalStockTable->final_quantity = $items->quantity;
            $FinalStockTable->purchase_id = $Purchase->purchase_id;
            $FinalStockTable->purchase_price = $details->purchase_price;
            $FinalStockTable->wholesale_price = $details->wholesale_price;
            $FinalStockTable->sales_price = $details->sales_price;
            $FinalStockTable->product_id = $details->product_id;
            $FinalStockTable->store_id = $request->store_id;
            $FinalStockTable->save();

            $details_update = PurchaseDetail::where('purchase_details_id', $details->purchase_details_id)->first();
            $details_update->stock_id = $FinalStockTable->stock_id;
            $details_update->update();
        }

        $detNew = PurchaseDetail::where('purchase_id', $Purchase->purchase_id)->get();

        $PurchaseInfo_Update = PurchaseInfo::where('purchase_id', '=', $Purchase->purchase_id)->first();

        $PurchaseInfo_Update->discount = $detNew->sum('discount');

        $PurchaseInfo_Update->total_vat = $detNew->sum('vat');

        $PurchaseInfo_Update->total_item_price = $detNew->sum('total_purchase_price');

        $PurchaseInfo_Update->total_payable = ($PurchaseInfo_Update->total_item_price - $PurchaseInfo_Update->discount) + $PurchaseInfo_Update->total_vat;

        $PurchaseInfo_Update->is_completed = 1;
        if ($request->paid_amount >= $PurchaseInfo_Update->total_payable) {
            $PurchaseInfo_Update->due_amount = 0;
            $PurchaseInfo_Update->paid_status = 2;
            $PurchaseInfo_Update->paid_amount = $PurchaseInfo_Update->total_payable;
        } elseif ($request->paid_amount < $PurchaseInfo_Update->total_payable) {

            $PurchaseInfo_Update->due_amount = $PurchaseInfo_Update->total_payable - $request->paid_amount;
            $PurchaseInfo_Update->paid_amount = $request->paid_amount;
            $PurchaseInfo_Update->paid_status = 1;
        }

        $update = $PurchaseInfo_Update->update();

        if ($update) {

            $sup_payment = new SupplierPayment();
            $sup_payment->supplier_id = $PurchaseInfo_Update->supplier_id;
            $sup_payment->purchase_id = $PurchaseInfo_Update->purchase_id;
            $sup_payment->payable_amount = $PurchaseInfo_Update->total_payable;
            if ($request->paid_amount >= $PurchaseInfo_Update->total_payable) {
                $sup_payment->paid_amount = $PurchaseInfo_Update->total_payable;
                if ($request->paid_amount != $PurchaseInfo_Update->total_payable) {
                    $sup_payment_new = new SupplierPayment();
                    $sup_payment_new->supplier_id = $PurchaseInfo_Update->supplier_id;
                    $sup_payment_new->paid_amount = $request->paid_amount - $PurchaseInfo_Update->total_payable;
                    $sup_payment_new->payment_method = $request->payment_type_id;
                    if ($request->bank_id) {
                        $sup_payment_new->bank_id = $request->bank_id;
                    }
                    if ($request->cheque_no) {
                        $sup_payment_new->cheque_no = $request->cheque_no;
                    }
                    $sup_payment_new->notes = $request->notes;
                    $sup_payment_new->save();
                }
            } elseif ($request->paid_amount < $PurchaseInfo_Update->total_payable) {
                $sup_payment->revised_due = $sup_payment->payable_amount - $request->paid_amount;
                $sup_payment->paid_amount = $request->paid_amount;
            }

            $sup_payment->payment_method = $request->payment_type_id;

            if ($request->bank_id) {
                $sup_payment->bank_id = $request->bank_id;
            }
            if ($request->cheque_no) {
                $sup_payment->cheque_no = $request->cheque_no;
            }
            $sup_payment->notes = $request->notes;
            $sup_payment->save();

            if ($request->payment_type_id == 2) {
                $Bank = Bank::where('bank_id', $request->bank_id)->first();

                $BankTransaction = new BankTransaction();
                $BankTransaction->bank_id = $request->bank_id;
                $BankTransaction->date = date('Y-m-d');
                $BankTransaction->trx_type = 2;
                if ($request->bank_id && $request->cheque_no) {
                    $BankTransaction->trx_mode = 2;
                    $BankTransaction->bank_id = $request->bank_name;
                    $BankTransaction->cheque_no = $request->cheque_no;
                }
                $BankTransaction->prev_balance = $Bank->balance;
                $BankTransaction->amount = $request->paid_amount;
                $BankTransaction->current_balance = $BankTransaction->prev_balance - $BankTransaction->amount;

                if ($request->transaction_no) {
                    $BankTransaction->trx_mode = 4;
                    $BankTransaction->transaction_no = $request->transaction_no;
                }
                $BankTransaction->save();

                $Bank->balance = $BankTransaction->current_balance;
                $Bank->save();
            }
        }

        $puechase_temporary->delete();
        foreach ($purchase_temporary_items as $del) {
            $del->delete();
        }

        return response()->json([
            'temp_cart_id' => false,
            'message' => "Product Purchased Successfully"
        ], 200);
    }


    public function ajaxGetUnit()
    {

        $unit = UnitDefinition::all();
        return response()->json($unit);
    }

    public function ajaxGetSupplyer()
    {
        $Supplier = Supplier::where('is_active', 1)->get();
        return response()->json($Supplier);
    }
    public function ajaxGetLocation()
    {
        $Store = Store::where('is_active', 1)->get();
        return response()->json($Store);
    }
    public function ajaxStoreSupplierData(Request $request)
    { 
        $Supplier = new Supplier();
        $Supplier->supplier_name = $request->supplier_name;
        $Supplier->supplier_address = $request->supplier_address;
        $Supplier->supplier_contact_person = $request->supplier_contact_person;
        $Supplier->supplier_contact_no = $request->supplier_contact_no;
        $Supplier->is_active = 1;
        $Supplier->save();

        $data = Supplier::all();
        return response()->json($data);
    }

    public function ajaxStoreLocationData(Request $request)
    {

        $Store = new Store();
        $Store->store_name = $request->store_name;
        $Store->is_active = 1;
        $Store->save();

        $data = Store::all();
        return response()->json($data);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function random_strings($length_of_string)
    {

        // String of all alphanumeric character
        $str_result = '0123456789';

        // Shuffle the $str_result and returns substring
        // of specified length
        return substr(
            str_shuffle($str_result),
            0,
            $length_of_string
        );
    }

    public function priceCalculation($id, $qty, $sales_price)
    {
        $temp_cart_item_id = $id;
        $CartTemporaryItem = PurchaseTemporaryItem::where('temp_purchase_id', $temp_cart_item_id)->first();
        $stock_qty = FinalStockTable::select('final_quantity')->where('stock_id', $CartTemporaryItem->stock_id)->first();
        if($stock_qty->final_quantity < $qty){
            return response()->json([
                'status' => false,
                'qty' => $stock_qty->final_quantity,
                'fail' => 'You Can Not Sell Product More Than Your Stock Quantity'
            ], 200);
        }
        $CartTemporaryItem->quantity = $qty;
        $CartTemporaryItem->vat = $CartTemporaryItem->vat * $qty;
        $CartTemporaryItem->temp_net_amount = $sales_price * $qty;
        $CartTemporaryItem->update();

        $cart_temporary_data = PurchaseTemporary::join('purchase_temporary_items', 'purchase_temporary_items.purchase_temporary_id', '=', 'purchase_temporaries.purchase_temporary_id')
            ->join('products', 'products.product_id', '=', 'purchase_temporary_items.product_id')
            ->where('purchase_temporaries.purchase_temporary_id', '=', $CartTemporaryItem->purchase_temporary_id)
            ->select(
                'purchase_temporary_items.*',
                'purchase_temporaries.*',
                'products.product_id',
                'products.product_name',
                'products.unit_type',
                'products.image_path',
                'products.product_image',
                'products.sku_no',
                'products.is_active',
            )
            ->get();

        $items = $cart_temporary_data->count();
        $subtotal = 0;
        $quantity = 0;
        $total_discount = 0;
        $total = 0;
        $vat = 0;
        foreach ($cart_temporary_data as $data) {
            $subtotal += $data->temp_net_amount;
            $total_discount += $data->discount;
            $quantity += $data->quantity;
            $purchase_temporary_id = $data->purchase_temporary_id;
            $vat += $data->vat;
        }
        $total = $subtotal - $total_discount + $vat;
        $paid_amount = 0;
        $due_amount = $total;
        $transaction_data = array('purchase_temporary_id' => $purchase_temporary_id, 'quantity' => $quantity, 'items' => $items, 'subtotal' => $subtotal, 'discount_amount' => $total_discount, 'total_payable' => $total, 'paid_amount' => $paid_amount, 'due_amount' => $due_amount, 'vat' => $vat);

        return response()->json([
            'status' => true,
            'success' => 'Product Added to Cart',
            'transaction_data' => $transaction_data,
            'cart_temporary_data' => $cart_temporary_data,
            'cart_temporary_item' => $CartTemporaryItem
        ], 200);
    }

    public function destroy(Request $request)
    {
        if ($request->session()->get('LoggedUser')) {

            $login_id = $request->session()->get('LoggedUser');
            $cart_temporary = CartTemporary::where('cart_temporary.created_by', '=', $login_id)
                ->where('cart_temporary.is_suspended', '=', 0)->first();

            if (!$cart_temporary) {
                return redirect()->back()->with(['success' => 'No Data Available To Cart']);
            } else {
                $CartTemporaryItem = CartTemporaryItem::where('temp_cart_id', $cart_temporary->temp_cart_id)->get();
                foreach ($CartTemporaryItem as $tempItem) {
                    $tempItem->delete();
                }

                $cart_temporary->delete();
                $request->session()->pull('From_Ip');
                $request->session()->pull('Temp_Consumer_ID');

                return redirect()->back()->with(['success' => 'Cart Cleared Successfully']);
            }
        } else {
            return redirect()->back()->with(['success' => 'No Data Available To Cart']);
        }
    }

    public function addSuspense($id, $waiter_id, $table_no)
    {
        // return $table_no;

        $temp_cart_id = $id;
        $tempcart = CartTemporary::find($temp_cart_id);
        $tempcart->waiter_id = $waiter_id;
        $tempcart->table_no = $table_no;
        $tempcart->is_suspended = 1;
        $tempcart->update();

        return response()->json([
            'status' => true,
            'success' => 'Product Suspended',
            'tempcart' => $tempcart
        ], 200);
    }

    public function deletePurchaseForm()
    {
        $PurchaseInfo = PurchaseTemporary::where('is_suspended', 0)->first();

        if ($PurchaseInfo) {
            $PDetails = PurchaseTemporaryItem::where('purchase_temporary_id', $PurchaseInfo->purchase_temporary_id)->get();

            foreach ($PDetails as $detl) {
                $detl->delete();
            }
            $PurchaseInfo->delete();

            return redirect()->back()->with('success', 'Purchase Cleared Successfully');
        } else {
            return redirect()->back()->with('success', 'Nothing To Delete');
        }
    }

    public function salesTempPayment(Request $request)
    {
        $tempcart = CartTemporary::join('cart_temporary_items', 'cart_temporary_items.temp_cart_id', '=', 'cart_temporary.temp_cart_id')
            ->join('products', 'products.product_id', '=', 'cart_temporary_items.product_id')
            ->where('cart_temporary.temp_cart_id', $request->temp_cart_id)
            ->select('cart_temporary_items.*', 'cart_temporary.*', 'products.bulk_price')
            ->get();
        $IsPaymentExists = CartTemporaryPayment::where('cart_temporary_id', $request->temp_cart_id)->exists();

        if (!$IsPaymentExists) {

            $temp_net_amount = 0;
            $vat = 0;
            $temp_net_amount_new = 0;

            foreach ($tempcart as $data) {

                $temp_net_amount += $data->temp_net_amount;
                $vat += $data->vat;
                $temp_net_amount_new += ($data->bulk_price * $data->quantity);
            }

            if ($request->sales_type == 1) {
                $TempPaymentdata = new CartTemporaryPayment();
                $TempPaymentdata->cart_temporary_id = $request->temp_cart_id;
                $TempPaymentdata->cart_temporary_total = $temp_net_amount;
                $TempPaymentdata->vat = $vat;
                $TempPaymentdata->discount_amount = $request->discount;
                $TempPaymentdata->payment_method_id = $request->payment_type_id;
                $TempPaymentdata->total_payable = ($TempPaymentdata->cart_temporary_total) - ($TempPaymentdata->discount_amount) + ($vat);
                $TempPaymentdata->paid_amount = $request->paid_amount;
                if (($TempPaymentdata->total_payable) - ($TempPaymentdata->paid_amount) < 0) {
                    $TempPaymentdata->due_amount = 0;
                } else {
                    $TempPaymentdata->due_amount = ($TempPaymentdata->total_payable) - ($TempPaymentdata->paid_amount);
                }

                $TempPaymentdata->change_amount = ($TempPaymentdata->paid_amount) - ($TempPaymentdata->total_payable);
                $TempPaymentdata->save();

                return response()->json(['TempPaymentdata' => $TempPaymentdata, 'is_payment_exists' => $IsPaymentExists]);
            } else {
                $TempPaymentdata = new CartTemporaryPayment();
                $TempPaymentdata->cart_temporary_id = $request->temp_cart_id;
                $TempPaymentdata->cart_temporary_total = $temp_net_amount_new;
                $TempPaymentdata->vat = $vat;
                $TempPaymentdata->discount_amount = $request->discount;
                $TempPaymentdata->payment_method_id = $request->payment_type_id;
                $TempPaymentdata->total_payable = ($TempPaymentdata->cart_temporary_total) - ($TempPaymentdata->discount_amount) + ($vat);
                $TempPaymentdata->paid_amount = $request->paid_amount;
                if (($TempPaymentdata->total_payable) - ($TempPaymentdata->paid_amount) < 0) {
                    $TempPaymentdata->due_amount = 0;
                } else {
                    $TempPaymentdata->due_amount = ($TempPaymentdata->total_payable) - ($TempPaymentdata->paid_amount);
                }

                $TempPaymentdata->change_amount = ($TempPaymentdata->paid_amount) - ($TempPaymentdata->total_payable);
                $TempPaymentdata->save();

                return response()->json(['TempPaymentdata' => $TempPaymentdata, 'is_payment_exists' => $IsPaymentExists]);
            }
        } else {
            $TempPaymentdata = CartTemporaryPayment::where('cart_temporary_id', $request->temp_cart_id)->first();
            return response()->json(['is_payment_exists' => $IsPaymentExists, 'TempPaymentdata' => $TempPaymentdata]);
        }
    }

    public function destroyTemporaryPayment(Request $request, $id)
    {
        $cart_temporary_payment_id = $id;
        $TempPaymentdelete = CartTemporaryPayment::where('cart_temporary_payment_id', $cart_temporary_payment_id)->first();

        $temp_cart_id = $TempPaymentdelete->cart_temporary_id;

        $TempPaymentdelete->delete();

        $cart_temporary_data = CartTemporary::join('cart_temporary_items', 'cart_temporary_items.temp_cart_id', '=', 'cart_temporary.temp_cart_id')
            ->join('products', 'products.product_id', '=', 'cart_temporary_items.product_id')
            ->where('cart_temporary.temp_cart_id', '=', $temp_cart_id)
            ->select(
                'cart_temporary_items.*',
                'cart_temporary.*',
                'products.product_id',
                'products.product_name',
                'products.cost_price',
                'products.sales_price',
                'products.unit_type',
                'products.image_path',
                'products.product_image',
                'products.sku_no',
                'products.is_active',
            )
            ->get();
        $items = $cart_temporary_data->count();
        $subtotal = 0;
        $quantity = 0;
        $total_discount = 0;
        $total = 0;
        $vat = 0;
        foreach ($cart_temporary_data as $data) {
            $subtotal += $data->temp_net_amount;
            $total_discount += $data->total_discount;
            $quantity += $data->quantity;
            $temp_cart_id = $data->temp_cart_id;
            $vat += $data->vat;
        }
        $total = $subtotal - $total_discount + $vat;;
        $paid_amount = 0;
        $due_amount = $total;
        $TempPaymentdata = array('temp_cart_id' => $temp_cart_id, 'quantity' => $quantity, 'items' => $items, 'subtotal' => $subtotal, 'discount_amount' => $total_discount, 'total_payable' => $total, 'paid_amount' => $paid_amount, 'due_amount' => $due_amount, 'vat' => $vat);

        return response()->json(['deleted' => true, 'TempPaymentdata' => $TempPaymentdata]);
    }


    public function storeSales(Request $request)
    {
        $temp_cart_data = CartTemporary::join('cart_temporary_items', 'cart_temporary_items.temp_cart_id', '=', 'cart_temporary.temp_cart_id')
            ->join('products', 'products.product_id', '=', 'cart_temporary_items.product_id')
            ->where('cart_temporary.temp_cart_id', $request->temp_cart_id)
            ->select(
                'cart_temporary_items.*',
                'cart_temporary.temp_cart_id',
                'cart_temporary_items.quantity',
                'products.product_name',
                'cart_temporary_items.product_id',
                'products.product_image',
                'products.sales_price',
                'products.cost_price',
                'products.unit_type',
                'products.bulk_price',
            )
            ->get();

        $cart_date = Carbon::now();
        $ConsumerExists = ConsumerLogin::where('mobile_no', $request->mobile_no)->exists();
        if (!$ConsumerExists) {
            $newConsumer = new ConsumerLogin();
            $newConsumer->mobile_no = $request->mobile_no;
            $newConsumer->save();
        } else {
            $newConsumer = ConsumerLogin::where('mobile_no', $request->mobile_no)->first();
        }


        // Add to Cart Informations table
        $CartInformtion = new CartInformtion();
        $CartInformtion->consumer_id = $newConsumer->login_id;
        $CartInformtion->cart_date = $cart_date;
        $CartInformtion->sales_type = $request->sales_type;
        $CartInformtion->created_by = $request->session()->get('LoggedUser');
        $CartInformtion->payment_method_id = $request->payment_method_id;
        $CartInformtion->save();
        $TempPayment = CartTemporaryPayment::where('cart_temporary_id', $request->temp_cart_id)->first();


        foreach ($temp_cart_data as $item_data) {

            $CartItem = new CartItem();
            $CartItem->cart_id = $CartInformtion->cart_id;
            $CartItem->product_id = $item_data->product_id;
            $CartItem->unit_id = $item_data->unit_type;
            $CartItem->unit_purchase_cost = $item_data->cost_price;
            $CartItem->quantity = $item_data->quantity;
            $CartItem->unit_sales_cost = $item_data->sales_price;
            if ($request->sales_type == 2) {
                $CartItem->total_price = ($item_data->bulk_price) * ($item_data->quantity);
            } else {
                $CartItem->total_price = ($item_data->sales_price) * ($item_data->quantity);
            }
            $CartItem->vat = ($item_data->vat);
            $CartItem->net_amount = $CartItem->total_price + $CartItem->vat;
            $CartItem->is_confirmed = 1;
            $save = $CartItem->save();

            if (FinalStockTable::where('product_id', $CartItem->product_id)->exists()) {
                $final_stock_table = FinalStockTable::where('product_id', $CartItem->product_id)->first();
                $final_stock_table->total_sold_quantity += $CartItem->quantity;
                $final_stock_table->final_quantity -= $CartItem->quantity;
                $final_stock_table->update();
            }
        }

        $NewCartItem = CartItem::where('cart_id', $CartItem->cart_id)->get();
        $purchQty = CartItem::where('cart_id', $CartItem->cart_id)->sum(DB::raw('unit_purchase_cost * quantity'));

        $CartInformtion_Update = CartInformtion::where('cart_id', '=', $CartItem->cart_id)->first();

        $CartInformtion_Update->cart_status = 1;
        $CartInformtion_Update->total_cart_amount = $NewCartItem->sum('total_price');
        $CartInformtion_Update->vat_amount = $NewCartItem->sum('vat');
        $CartInformtion_Update->total_discount = $request->discount;
        $CartInformtion_Update->total_payable_amount = ($CartInformtion_Update->total_cart_amount) + ($CartInformtion_Update->vat_amount) - ($CartInformtion_Update->total_discount);
        $CartInformtion_Update->final_total_amount = $CartInformtion_Update->total_payable_amount;
        $CartInformtion_Update->paid_amount = $CartInformtion_Update->total_payable_amount;
        $CartInformtion_Update->due_amount = ($CartInformtion_Update->total_payable_amount - $CartInformtion_Update->paid_amount);
        $CartInformtion_Update->gross_profit = $CartInformtion_Update->total_payable_amount - $purchQty;
        $CartInformtion_Update->net_profit = $CartInformtion_Update->gross_profit;
        $save = $CartInformtion_Update->save();

        $CartTemporaryItem = CartTemporaryItem::where('temp_cart_id', '=', $request->temp_cart_id)->get();
        foreach ($CartTemporaryItem as $del) {
            $del->delete();
        }

        $CartTemporary = CartTemporary::where('temp_cart_id', '=', $request->temp_cart_id)->get();
        foreach ($CartTemporary as $delet) {
            $delet->delete();
        }

        $CartTemporaryPayment = CartTemporaryPayment::where('cart_temporary_id', '=', $request->temp_cart_id)->get();
        foreach ($CartTemporaryPayment as $delet) {
            $delet->delete();
        }

        $CartInformtionForPrint = CartInformtion::join('cart_items', 'cart_items.cart_id', '=', 'cart_informtion.cart_id')
            ->join('products', 'products.product_id', '=', 'cart_items.product_id')
            ->where('cart_informtion.cart_id', $CartInformtion_Update->cart_id)
            ->select('cart_informtion.*', 'cart_items.*', 'products.product_name', 'products.cost_price', 'products.sales_price', 'products.bulk_price')
            ->get();

        if ($save) {
            return view('sales/print/printInvoice', compact(['CartInformtion', 'CartInformtionForPrint']));
        } else {
            return redirect()->back()->with('fail', 'Something went wrong, failed to Add');
        }
    }

    public function salesSubCategory($id)
    {
        $category_id = $id;
        $SalesSubCat = ProductCategory::join('sub_category_one', 'sub_category_one.category_id', '=', 'product_category.category_id')
            ->where('product_category.category_id', '=', $category_id)
            ->select('sub_category_one.*')
            ->get();
        return response()->json($SalesSubCat);
    }

    public function deleteTempPurchaseItem($id)
    {
        $PurchaseTempItem = PurchaseTemporaryItem::where('temp_purchase_id', $id)->first();
        $PurchaseTempItem->delete();

        $cart_temporary_data = purchaseFormDataHelper($PurchaseTempItem->purchase_temporary_id);
        $transaction_data = purchaseFormTransactionHelper($cart_temporary_data);

        return response()->json([
            'status' => true,
            'success' => 'Cart Item Deleted Successfully',
            'transaction_data' => $transaction_data,
            'cart_temporary_data' => $cart_temporary_data
        ], 200);
    }

    public function editTempPurchaseItem($id)
    {
        $PurchaseTempItem = PurchaseTemporaryItem::where('temp_purchase_id', $id)->first();

        return response()->json($PurchaseTempItem);
    }
}
