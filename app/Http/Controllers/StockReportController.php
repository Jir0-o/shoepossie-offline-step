<?php

namespace App\Http\Controllers;


use App\Models\FinalStockTable;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductMaterial;
use App\Models\PurchaseDetail;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Session;

class StockReportController extends Controller
{
    public function PWS($product_id)
    {
        $locations = FinalStockTable::join('stores', 'stores.store_id', '=', 'final_stock_table.store_id')
            ->where('final_stock_table.product_id', '=', $product_id)
            ->where('final_stock_table.final_quantity', '>', 0)
            ->select('stores.*', 'final_stock_table.final_quantity')
            ->get();

        return response()->json($locations);
    }
    public function CatWiseStock($category_id) 
    {
        $locations = FinalStockTable::join('products', 'products.product_id', '=', 'final_stock_table.product_id')
            ->join('product_materials', 'product_materials.product_material_id', '=', 'final_stock_table.product_id')
            ->join('stores', 'stores.store_id', '=', 'final_stock_table.store_id')
            ->where('product_materials.product_material_id', $category_id)
            ->select('final_stock_table.*', 'stores.store_name', 'products.unit_type', 'products.product_name', 'product_materials.product_material_name')
            ->get();

        return response()->json($locations);
    }
    public function PWAQ($product_id)
    {
        $stock = FinalStockTable::join('stores', 'stores.store_id', '=', 'final_stock_table.store_id')
            ->where('final_stock_table.product_id', '=', $product_id)
            ->select('stores.*', 'final_stock_table.final_quantity')
            ->get();

        return response()->json($stock);
    }
    public function PWR($product_id)
    {
        $locations = Store::select('stores.*')
            ->get();

        return response()->json($locations);
    }
    public function PWSD($store_id, $product_id)
    {
        $qty = FinalStockTable::where('final_stock_table.product_id', '=', $product_id)
            ->where('final_stock_table.store_id', '=', $store_id)
            ->select('final_stock_table.final_quantity')
            ->first();

        // return ($qty);
        return response()->json($qty);
    }
    public function PWSQ($store_id, $product_id)
    {
        $qty = FinalStockTable::where('final_stock_table.product_id', '=', $product_id)
            ->where('final_stock_table.store_id', '=', $store_id)
            ->select('final_stock_table.final_quantity')
            ->first();

        // return ($qty);
        return response()->json($qty);
    }
    public function stock_report()
    {

        $stock_report = FinalStockTable::join('product_materials', 'product_materials.product_material_id', '=', 'final_stock_table.product_id')
            ->join('foot_ware_categories', 'product_materials.foot_ware_categories_id', '=', 'foot_ware_categories.foot_ware_categories_id')
            ->join('types', 'product_materials.type_id', '=', 'types.type_id')
            ->join('material_types', 'product_materials.material_type_id', '=', 'material_types.material_type_id')
            ->join('brand_types', 'product_materials.brand_type_id', '=', 'brand_types.brand_type_id')
            ->join('sizes', 'sizes.size_id', '=', 'final_stock_table.size_id')
            ->join('colors', 'colors.colors_id', '=', 'final_stock_table.colors_id')
            ->where('final_stock_table.final_quantity','>',0)
            // ->leftJoin('unit_definition', 'unit_definition.unit_id', '=', 'products.unit_type')
            // ->join('stores', 'stores.store_id', '=', 'final_stock_table.store_id')

            ->select(
                'final_stock_table.*',
                // 'products.category_id',
                // 'products.product_name',
                'product_materials.product_material_name',
                // 'products.unit_type',
                // 'products.image_path',
                // 'products.product_image',
                // 'products.is_active',
                // 'products.cost_price',
                // 'products.sales_price',
                // 'products.bulk_price',
                // 'products.barcode',
                // 'unit_definition.unit_name',
                // 'unit_definition.unit_symbol',
                'foot_ware_categories.foot_ware_categories_name',
                'types.type_name',
                'material_types.material_type_name',
                'brand_types.brand_type_name',
                'colors.colors_name',
                'sizes.size_name',
                // 'stores.store_name'
            )
            ->get();


        $store_stock_report = FinalStockTable::join('products', 'products.product_id', '=', 'final_stock_table.product_id')
            ->join('unit_definition', 'unit_definition.unit_id', '=', 'products.unit_type')
            ->join('stores', 'stores.store_id', '=', 'final_stock_table.store_id')
            ->select(
                'final_stock_table.*',
                'products.product_name',
                'products.unit_type',
                'unit_definition.unit_symbol',
                'stores.store_name'
            )
            ->get();


        $totalPrice  = 0;

        foreach ($stock_report as $stock_report_total) {
            $totalPrice += $stock_report_total->final_quantity * $stock_report_total->sales_price;
        }



        $totalStock =  $stock_report->sum('final_quantity');

        $product_cat = ProductMaterial::join('foot_ware_categories', 'foot_ware_categories.foot_ware_categories_id', '=', 'product_materials.foot_ware_categories_id')
        ->join('types', 'types.type_id', '=', 'product_materials.type_id')
        ->join('material_types', 'material_types.material_type_id', '=', 'product_materials.material_type_id')
        ->join('brand_types', 'brand_types.brand_type_id', '=', 'product_materials.brand_type_id')
        ->select(
            'foot_ware_categories.foot_ware_categories_id', 
            'foot_ware_categories.foot_ware_categories_name',
            'types.type_name',
            'material_types.material_type_name',
            'brand_types.brand_type_name',
        )
        ->get();
    
        return view('dashboard.stock.stockReport', compact(['stock_report', 'store_stock_report', 'product_cat', 'totalStock', 'totalPrice']));
    }
    public function store_stock_report()
    {


        $store_stock_report = FinalStockTable::join('products', 'products.product_id', '=', 'final_stock_table.product_id')
            ->join('product_materials', 'product_materials.product_material_id', '=', 'final_stock_table.product_id')
            ->join('unit_definition', 'unit_definition.unit_id', '=', 'products.unit_type')->join('stores', 'stores.store_id', '=', 'final_stock_table.store_id')
            ->select(
                'final_stock_table.*',
                'products.product_name',
                'product_materials.product_material_name',
                'products.unit_type',
                'unit_definition.unit_symbol',
                'stores.store_name'
            )
            ->get();

        // return $store_stock_report;
        return view('dashboard.stock.storeStockReport', compact(['store_stock_report']));
    }


    public function stock_transfer()
    {
        $products = ProductMaterial::select('product_materials.*')
            ->get();
        $stores = Store::select('stores.*')
            ->get();
        // return $products;
        return view('dashboard.stock.stockTransfer', compact(['products', 'stores']));
    }

    public function store_stock_transfer(Request $request)
    {

        $from_store_product = FinalStockTable::where('store_id', '=', $request->from_store)->where('product_id', '=', $request->product_id)
            ->select('final_stock_table.*')
            ->first();
        $from_store_product_exist = FinalStockTable::where('store_id', '=', $request->from_store)->where('product_id', '=', $request->product_id)
            ->select('final_stock_table.*')
            ->exists();

        if (!$from_store_product_exist) {

            return redirect()->back()->with('error', 'This Product not available');
        }
        if ($from_store_product->final_quantity < $request->transfer_quantity) {

            return redirect()->back()->with('error', 'Transfer quantity can not exceed the stock quantity');
        }
        if ($request->transfer_quantity < 0) {

            return redirect()->back()->with('error', 'You cannot transfer Negative Quantity ');
        }
        if ($request->from_store == $request->to_store) {

            return redirect()->back()->with('error', 'You cannot transfer in same store ');
        }

        $to_store_product = FinalStockTable::where('store_id', '=', $request->to_store)->where('product_id', '=', $request->product_id)
            ->select('final_stock_table.*')
            ->first();

        $to_store_product_exist = FinalStockTable::where('store_id', '=', $request->to_store)->where('product_id', '=', $request->product_id)
            ->select('final_stock_table.*')
            ->exists();


        // check to location have same product or not
        if ($to_store_product_exist) {
            $to_store_product->final_quantity =  $to_store_product->final_quantity + $request->transfer_quantity;
            $from_store_product->final_quantity =  $from_store_product->final_quantity - $request->transfer_quantity;
            $from_store_product->colors_id  =  $from_store_product->colors_id;
            $from_store_product->size_id   =  $from_store_product->size_id;
            $from_store_product->article   =  $from_store_product->article;
            $from_store_product->barcode   =  $from_store_product->barcode;
        } else {

            $to_store_product = new FinalStockTable();
            $from_store_product->final_quantity =  $from_store_product->final_quantity - $request->transfer_quantity;
            $to_store_product->product_id = $from_store_product->product_id;
            $to_store_product->colors_id = $from_store_product->colors_id;
            $to_store_product->size_id = $from_store_product->size_id;
            $to_store_product->barcode = $from_store_product->barcode;
            $to_store_product->article = $from_store_product->article;
            $to_store_product->final_quantity = $request->transfer_quantity;
            $to_store_product->store_id = $request->to_store;
        }

        $to_store_product->save();
        $from_store_product->save();




        return redirect(Route('backoffice.store-stock-report'));
    }
}
