<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\PurchaseDetail;
use App\Models\PurchaseInfo;
use App\Models\ColorDefinition;
use App\Models\UnitDefinition;
use App\Models\SizeDefinition;
use App\Models\Brand;
use App\Models\Supplier;
use App\Models\FinalStockTable;
use App\Models\Store;
use Illuminate\Support\Facades\Crypt;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Supplier = Supplier::all();
        $Brand = Brand::all();
        $UnitDefinition = UnitDefinition::all();
        $ColorDefinition = ColorDefinition::all();
        $SizeDefinition = SizeDefinition::all();
        $Product = Product::all();
        $Store = Store::all();

        return view('dashboard.purchase.addPurchase', compact(['UnitDefinition', 'ColorDefinition', 'SizeDefinition', 'Brand', 'Supplier', 'Product', 'Store']));
    }

    public function AllPurchase()
    {
        $PurchaseDetail = PurchaseDetail::join('purchase_info', 'purchase_info.purchase_id', '=', 'purchase_details.purchase_id')
            ->join('products', 'products.product_id', '=', 'purchase_details.product_id')
            ->join('final_stock_table', 'final_stock_table.purchase_id', '=', 'purchase_info.purchase_id')
            ->select('purchase_info.*', 'purchase_details.*', 'products.product_name', 'final_stock_table.temp_quantity')
            ->get();
        return view('dashboard.purchase.allPurchase', compact(['PurchaseDetail']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $data = $request->validate([
            'product_id' => 'required',
            'supplier_id' => 'required',
            'product_id' => 'required',
            'unit_id' => 'required',
            'purchase_price' => 'required',
            'wholesale_price' => 'required',
            'sales_price' => 'required',
            'quantity' => 'required',
            'store_id' => 'required',
            'discount' => 'required',
            'total_payable' => 'required',
            'paid_status' => 'required',
        ]);

        $PurchaseInfo = new PurchaseInfo();
        $PurchaseInfo->supplier_id = $request->supplier_id;
        $PurchaseInfo->ref_no = $request->ref_no;
        $PurchaseInfo->pur_date = date("Y-m-d");
        $PurchaseInfo->discount = $request->discount;
        $PurchaseInfo->total_payable = $request->total_payable;
        $PurchaseInfo->paid_status = $request->paid_status;
        $PurchaseInfo->total_item_price = ($request->purchase_price) * ($request->quantity);
        $save = $PurchaseInfo->save();

        $PurchaseDetails = new PurchaseDetail();

        $PurchaseDetails->purchase_id = $PurchaseInfo->purchase_id;
        $PurchaseDetails->product_id = $request->product_id;
        $PurchaseDetails->quantity = $request->quantity;
        $PurchaseDetails->unit_id = $request->unit_id;
        $PurchaseDetails->sales_price = $request->sales_price;
        $PurchaseDetails->purchase_price = $request->purchase_price;
        $PurchaseDetails->wholesale_price = $request->wholesale_price;
        $PurchaseDetails->total_purchase_price = ($request->purchase_price) * ($request->quantity);

        $save = $PurchaseDetails->save();

        $FinalStockTable = new FinalStockTable();
        $FinalStockTable->product_id = $request->product_id;
        $FinalStockTable->purchase_id = $PurchaseInfo->purchase_id;
        $FinalStockTable->total_purchased_quantity = $request->quantity;
        $FinalStockTable->total_sold_quantity = 0;
        $FinalStockTable->temp_quantity = $request->quantity;
        $FinalStockTable->final_quantity = $request->quantity;
        $FinalStockTable->store_id = $request->store_id;
        $FinalStockTable->save();


        if ($save) {
            return redirect()->route('backoffice.all-purchase')->with('success', 'Purchase Created successfully');
        } else {
            return redirect()->back()->with('fail', 'Something went wrong, failed to register');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewPurchase($id)
    {
        $product_id = Crypt::decryptString($id);
        $Product = PurchaseDetail::join('products', 'products.product_id', '=', 'purchase_details.product_id')
            ->where('purchase_details.product_id', $product_id)
            ->select('products.*', 'purchase_details.*')
            ->get();
        return view('dashboard.purchase.viewPurchase', compact(['Product']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
