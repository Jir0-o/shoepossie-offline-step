<?php

namespace App\Http\Controllers;

use App\Models\BrandTypes;
use App\Models\FootWareCategory;
use App\Models\MaterialTypes;
use App\Models\Product;
use App\Models\ProductMaterial;
use App\Models\Types;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductMaterialController extends Controller
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
        $footWareCategorys = FootWareCategory::where('foot_ware_categories_is_active',1)->select('foot_ware_categories_id','foot_ware_categories_name')->get();
        $types = Types::where('type_is_active',1)->select('type_id','type_name')->get();
        $materials = MaterialTypes::where('material_type_is_active',1)->select('material_type_id','material_type_name')->get();
        $brands = BrandTypes::where('brand_type_is_active',1)->select('brand_type_id','brand_type_name')->get();
        return view('dashboard.productMaterial.productMaterial',compact(['productMaterials','footWareCategorys','types','materials','brands']));
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
        $validator = Validator::make($request->all(), [
            'product_material_name' => 'required',
            'foot_ware_categories_id' => 'required',
            'type_id' => 'required',
            'material_type_id' => 'required',
            'brand_type_id' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->with('error','Please Fill All Section');
        }
        else{

            $productMaterial = new ProductMaterial;
            $productMaterial->product_material_name = $request->product_material_name;
            $productMaterial->foot_ware_categories_id = $request->foot_ware_categories_id;
            $productMaterial->type_id = $request->type_id;
            $productMaterial->material_type_id = $request->material_type_id;
            $productMaterial->brand_type_id = $request->brand_type_id;
            $productMaterial->save();

            $product = new Product;
            $product->product_name = $request->product_material_name;
            $product->unit_type =1;
            $product->is_active =1;
            $product->save();


            return redirect()->back()->with('success','Product Add Successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductMaterial  $productMaterial
     * @return \Illuminate\Http\Response
     */
    public function show(ProductMaterial $productMaterial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductMaterial  $productMaterial
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductMaterial $productMaterial,$id)
    {
        $getId =  decrypt($id);
        $getProductMaterial = ProductMaterial::where('product_material_id',$getId)->first();
        $footWareCategorys = FootWareCategory::where('foot_ware_categories_is_active',1)->select('foot_ware_categories_id','foot_ware_categories_name')->get();
        $types = Types::where('type_is_active',1)->select('type_id','type_name')->get();
        $materials = MaterialTypes::where('material_type_is_active',1)->select('material_type_id','material_type_name')->get();
        $brands = BrandTypes::where('brand_type_is_active',1)->select('brand_type_id','brand_type_name')->get();
        return view('dashboard.productMaterial.productMaterialEdit',compact(['getProductMaterial','footWareCategorys','types','materials','brands']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductMaterial  $productMaterial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductMaterial $productMaterial,$id)
    {
        $validator = Validator::make($request->all(), [
            'product_material_name' => 'required',
            'foot_ware_categories_id' => 'required',
            'type_id' => 'required',
            'material_type_id' => 'required',
            'brand_type_id' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->with('error','Please Fill All Section');
        }
        else{

            $productMaterial = ProductMaterial::where('product_material_id',$id)->first();
            $productMaterial->product_material_name = $request->product_material_name;
            $productMaterial->foot_ware_categories_id = $request->foot_ware_categories_id;
            $productMaterial->type_id = $request->type_id;
            $productMaterial->material_type_id = $request->material_type_id;
            $productMaterial->brand_type_id = $request->brand_type_id;
            $productMaterial->save();
            return redirect()->route('backoffice.productMaterial')->with('success','Product Update Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductMaterial  $productMaterial
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductMaterial $productMaterial)
    {
        //
    }
}
