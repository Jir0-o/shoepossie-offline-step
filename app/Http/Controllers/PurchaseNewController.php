<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\BankTransaction;
use App\Models\BrandTypes;
use App\Models\Colors;
use App\Models\FinalStockTable;
use App\Models\FootWareCategory;
use App\Models\MaterialTypes;
use App\Models\ProductMaterial;
use App\Models\PurchaseDetail;
use App\Models\PurchaseInfo;
use App\Models\PurchaseNew;
use App\Models\Sizes;
use App\Models\SupplierPayment;
use App\Models\Types;
use Illuminate\Http\Request;
use Carbon\Carbon;
class PurchaseNewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productMaterials = ProductMaterial::join('foot_ware_categories','product_materials.foot_ware_categories_id','=','foot_ware_categories.foot_ware_categories_id')
        ->join('types','product_materials.type_id','=','types.type_id')
        ->join('material_types','product_materials.material_type_id','=','material_types.material_type_id')
        ->join('brand_types','product_materials.brand_type_id','=','brand_types.brand_type_id')
        ->orderby('product_materials.product_material_id','desc')
        ->select('product_materials.*','foot_ware_categories.foot_ware_categories_name','types.type_name','material_types.material_type_name','brand_types.brand_type_name')
        ->get();
        $colors = Colors::select('colors_id','colors_name')->get();
        $sizes = Sizes::where('size_code','<',11)->select('size_id','size_name')->get();
        $sizes_11_20 = Sizes::where('size_code','>',10)->where('size_code','<',21)->select('size_id','size_name')->get();
        $sizes_21_30 = Sizes::where('size_code','>',20)->where('size_code','<',31)->select('size_id','size_name')->get();
        $sizes_31_40 = Sizes::where('size_code','>',30)->where('size_code','<',41)->select('size_id','size_name')->get();
        $sizes_41_unli = Sizes::where('size_code','>',40)->select('size_id','size_name')->get();
        return view('dashboard.purchaseNew.purchaseNew',compact(['productMaterials','colors','sizes','sizes_11_20','sizes_21_30','sizes_31_40','sizes_41_unli']));
    }

    public function getProductNew(Request $request){

        //Colors Row 
        $getColorsId = $request->GetColorsValue;
        $convertIntegerColorsID = array_map('intval',$getColorsId);
        $GetColors = Colors::whereIn('colors_id', $convertIntegerColorsID)->get();

        //Sizes Row

        $getSizesId = $request->checkSizesValue;
        $convertIntegerSizesId = array_map('intval',$getSizesId);
        $getSizes = Sizes::whereIn('size_id',$convertIntegerSizesId)->get();

        //Product
        $getProduct = ProductMaterial::where('product_material_id',$request->getProductID)->first();
        $getFootWareCategory = FootWareCategory::find($getProduct->foot_ware_categories_id);
        $getType = Types::find($getProduct->type_id);
        $getMaterial = MaterialTypes::find($getProduct->material_type_id);
        $getBrands = BrandTypes::find($getProduct->brand_type_id);
        $currentMonth = Carbon::now()->format('m');
        $currentYear = Carbon::now()->format('y');
        $storeArray = [];
        foreach( $GetColors as  $GetColor){
            foreach( $getSizes as  $getSize){
                $storeArray[] =  $getFootWareCategory->foot_ware_categories_code.
                                 $getType->type_code.
                                 $getMaterial->material_type_code.
                                 $GetColor->colors_code.
                                 $getBrands->brand_type_code.
                                 $request->getArticleValue.'-'.
                                 str_pad($getSize->size_code, 2, '0', STR_PAD_LEFT).'-'.
                                 $currentMonth.
                                 $currentYear;
            }
        }

        return response()->json([
            'getCode'=>$storeArray
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // return response()->json([
        //     'request'=>$request->payment_type_id
        // ]);

        $pur_date = Carbon::now();
        $Purchase = new PurchaseInfo();
        $Purchase->ref_no = $request->ref_no;
        $Purchase->notes = $request->notes;
        $Purchase->store_id = $request->store_id;
        $Purchase->supplier_id = $request->supplyer_id;
        $Purchase->pur_date = $pur_date->format('Y-m-d');
        $Purchase->paid_amount = $request->paid_amount;
        $Purchase->save();

         //Colors Row
         $getColorsId = $request->color;
         $convertIntegerColorsID = array_map('intval',$getColorsId);
         $GetColors = Colors::whereIn('colors_id', $convertIntegerColorsID)->get();
         //Sizes Row
         $getSizesId = $request->size;
         $convertIntegerSizesId = array_map('intval',$getSizesId);
         $getSizes = Sizes::whereIn('size_id',$convertIntegerSizesId)->get();

         $getProductId = $request->product_material_id;
         $getBatch = $request->batch;
         $getPurchasePrice = $request->purchase_price;
         $getWholeSellPrice = $request->wholeSell_price;
         $getSalesPrice = $request->sales_price;
         $getDiscount = $request->discount;
         $getSVat = $request->vat;
         $getQty = $request->qty;
         $getArticle = $request->article;
         $getProduct = ProductMaterial::where('product_material_id',$getProductId)->first();
         $getFootWareCategory = FootWareCategory::find($getProduct->foot_ware_categories_id);
         $getType = Types::find($getProduct->type_id);
         $getMaterial = MaterialTypes::find($getProduct->material_type_id);
         $getBrands = BrandTypes::find($getProduct->brand_type_id);
         $currentMonth = Carbon::now()->format('m');
         $currentYear = Carbon::now()->format('y');
        $i = 0;
         foreach( $GetColors as  $GetColor){
            foreach( $getSizes as  $getSize){
                $storePurchase = new PurchaseDetail();
                $storePurchase->purchase_id = $Purchase->purchase_id;
                $storePurchase->product_id = $getProductId;
                $storePurchase->unit_id = NULL;
                $storePurchase->colors_id = $GetColor->colors_id;
                $storePurchase->size_id = $getSize->size_id;
                $storePurchase->batch = $getBatch;
                $storePurchase->article = $getArticle;
                $storePurchase->date = date('Y-m-d');
                $storePurchase->purchase_price = $getPurchasePrice[$i];
                $storePurchase->wholesale_price = $getWholeSellPrice[$i];
                $storePurchase->sales_price = $getSalesPrice[$i];
                $storePurchase->total_purchase_price = $getPurchasePrice[$i]*$getQty[$i];

                // $storePurchase->date = date('Y-m-d');
                if($getSVat[$i]){
                    $storePurchase->vat = $getSVat[$i]*$getQty[$i];
                }
                else{
                    $storePurchase->vat = 0;
                }

                if($getDiscount[$i]){
                    $storePurchase->discount = $getDiscount[$i];
                }
                else{
                    $storePurchase->discount = 0;
                }
                $quantity =  $getQty[$i];
                $storePurchase->quantity = $quantity;
                // $storePurchase->purchase_code = $getFootWareCategory->foot_ware_categories_code.
                //                                 $getType->type_code.
                //                                 $getMaterial->material_type_code.
                //                                 $GetColor->colors_code.
                //                                 $getBrands->brand_type_code.
                //                                 $getArticle.
                //                                 $getSize->size_code.'-'.
                //                                 $currentMonth.
                //                                 $currentYear;
                $storePurchase->barcode =   $getFootWareCategory->foot_ware_categories_code.
                                            $getType->type_code.
                                            $getMaterial->material_type_code.
                                            $GetColor->colors_code.
                                            $getBrands->brand_type_code.
                                            $getArticle.'-'.
                                            str_pad($getSize->size_code, 2, '0', STR_PAD_LEFT).'-'.
                                            $currentMonth.
                                            $currentYear;
                $storePurchase->save();
                $FinalStockTable = new FinalStockTable();
                $FinalStockTable->total_purchased_quantity = $quantity;
                $FinalStockTable->total_sold_quantity = 0;
                $FinalStockTable->total_ordered_quantity = 0;
                $FinalStockTable->in_order_queue = 0;
                $FinalStockTable->temp_quantity =$quantity;
                $FinalStockTable->final_quantity =$quantity;
                $FinalStockTable->purchase_id = $Purchase->purchase_id;
                $FinalStockTable->purchase_price = $storePurchase->purchase_price;
                $FinalStockTable->wholesale_price = $storePurchase->wholesale_price;
                $FinalStockTable->sales_price = $storePurchase->sales_price;
                $FinalStockTable->product_id =  $storePurchase->product_id;
                $FinalStockTable->store_id = $request->store_id;
                $FinalStockTable->colors_id = $storePurchase->colors_id;
                $FinalStockTable->size_id = $storePurchase->size_id;
                $FinalStockTable->article =  $storePurchase->article;
                $FinalStockTable->barcode =  $storePurchase->barcode;
                $FinalStockTable->save();

                $details_update = PurchaseDetail::where('purchase_details_id', $storePurchase->purchase_details_id)->first();
                $details_update->stock_id = $FinalStockTable->stock_id;
                $details_update->update();
                $i++;
            }
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

        return response()->json([
            'success'=>'Product Purchased Successfully'
        ]);
    }

    public function dailyPurchase(){
        $getDailyPurchase = PurchaseDetail::join('product_materials','purchase_details.product_id','=','product_materials.product_material_id')
        ->join('colors','purchase_details.colors_id','=','colors.colors_id')
        ->join('sizes','purchase_details.size_id','=','sizes.size_id')
        ->join('foot_ware_categories','product_materials.foot_ware_categories_id','=','foot_ware_categories.foot_ware_categories_id')
        ->join('types','product_materials.type_id','=','types.type_id')
        ->join('material_types','product_materials.material_type_id','=','material_types.material_type_id')
        ->join('brand_types','product_materials.brand_type_id','=','brand_types.brand_type_id')
        ->where('purchase_details.date',date('Y-m-d'))
        ->orderby('purchase_details.purchase_details_id','desc')
        ->select('purchase_details.*','product_materials.product_material_name','foot_ware_categories.foot_ware_categories_name','types.type_name','material_types.material_type_name','brand_types.brand_type_name','colors.colors_name','sizes.size_name')
        ->get();
        // return $getDailyPurchase;

        $getPurchaseTotal = $getDailyPurchase->sum('purchase_price');
        $getSalesTotal = $getDailyPurchase->sum('sales_price');
        $getWholeSellPrice = $getDailyPurchase->sum('wholesale_price');
        $totalDiscount = $getDailyPurchase->sum('discount');
        $totalQty = $getDailyPurchase->sum('quantity');
        $totalVat = $getDailyPurchase->sum('vat');
        return view('dashboard.purchaseNew.dailyPurchaseReportNew',compact(['getDailyPurchase','getPurchaseTotal','getSalesTotal','getWholeSellPrice','totalDiscount','totalQty','totalVat']));
    }

    public function dailyPurchaseBarcode($id){
        $getId = decrypt($id);
        $getPurchaseBarcode = PurchaseDetail::find($getId);
        return view('dashboard.purchaseNew.dailyPurchaseBarcode',compact(['getPurchaseBarcode']));
    }

    public function allPurchase(){
        $getDailyPurchase = PurchaseDetail::join('product_materials','purchase_details.product_id','=','product_materials.product_material_id')
        ->join('colors','purchase_details.colors_id','=','colors.colors_id')
        ->join('sizes','purchase_details.size_id','=','sizes.size_id')
        ->join('foot_ware_categories','product_materials.foot_ware_categories_id','=','foot_ware_categories.foot_ware_categories_id')
        ->join('types','product_materials.type_id','=','types.type_id')
        ->join('material_types','product_materials.material_type_id','=','material_types.material_type_id')
        ->join('brand_types','product_materials.brand_type_id','=','brand_types.brand_type_id')
        // ->where('purchase_details.date',date('Y-m-d'))
        ->orderby('purchase_details.purchase_details_id','desc')
        ->select('purchase_details.*','product_materials.product_material_name','foot_ware_categories.foot_ware_categories_name','types.type_name','material_types.material_type_name','brand_types.brand_type_name','colors.colors_name','sizes.size_name')
        ->get();
        // return $getDailyPurchase;

        $getPurchaseTotal = $getDailyPurchase->sum('purchase_price');
        $getSalesTotal = $getDailyPurchase->sum('sales_price');
        $getWholeSellPrice = $getDailyPurchase->sum('wholesale_price');
        $totalDiscount = $getDailyPurchase->sum('discount');
        $totalQty = $getDailyPurchase->sum('quantity');
        $totalVat = $getDailyPurchase->sum('vat');
        return view('dashboard.purchaseNew.dailyPurchaseReportNew',compact(['getDailyPurchase','getPurchaseTotal','getSalesTotal','getWholeSellPrice','totalDiscount','totalQty','totalVat']));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseNew  $purchaseNew
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseNew $purchaseNew)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseNew  $purchaseNew
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseNew $purchaseNew)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseNew  $purchaseNew
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseNew $purchaseNew)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseNew  $purchaseNew
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseNew $purchaseNew)
    {
        //
    }
}
