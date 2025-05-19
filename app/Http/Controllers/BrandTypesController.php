<?php

namespace App\Http\Controllers;

use App\Models\BrandTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = BrandTypes::select('brand_type_id','brand_type_name','brand_type_code','brand_type_is_active')->get();
        return view('dashboard.BrandsForProduct.brands',compact(['brands']));
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
            'brand_type_name' => 'required',
            'brand_type_code' => 'required',
        ]);



        if($validator->fails()){
            return redirect()->back()->with('error','Please Fill All Section');
        }
        else{
            $uniqueCode = $request->brand_type_code;

            if(BrandTypes::where('brand_type_code',$uniqueCode)->exists()){
                return redirect()->back()->with('error','Please Try Unique Code Number');
            }
            else{
                $storBrands = new BrandTypes;
                $storBrands->brand_type_name = $request->brand_type_name;
                $storBrands->brand_type_code = $request->brand_type_code;
                $storBrands->save();
                return redirect()->back()->with('success','Brands Add Successfully');
            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BrandTypes  $brandTypes
     * @return \Illuminate\Http\Response
     */
    public function show(BrandTypes $brandTypes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BrandTypes  $brandTypes
     * @return \Illuminate\Http\Response
     */
    public function edit(BrandTypes $brandTypes,$id)
    {
        $getId =  decrypt($id);

        $findBrandType = BrandTypes::where('brand_type_id',$getId)->first();
        return view('dashboard.BrandsForProduct.brandsEdit',compact(['findBrandType']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BrandTypes  $brandTypes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BrandTypes $brandTypes,$id)
    {
        $validator = Validator::make($request->all(), [
            'brand_type_name' => 'required',
            'brand_type_code' => 'required',
        ]);


        if($validator->fails()){
            return redirect()->route('backoffice.brands')->with('error','Please Fill All Section');
        }
        else{
            $postBrandsTypes = BrandTypes::find($id);
            if($postBrandsTypes->brand_type_code==$request->brand_type_code){
                $postBrandsTypes->brand_type_name = $request->brand_type_name;
                $postBrandsTypes->brand_type_code = $request->brand_type_code;
                $postBrandsTypes->brand_type_is_active = $request->brand_type_is_active;
                $postBrandsTypes->save();
                return redirect()->route('backoffice.brands')->with('success','Brands Update Successfully');
            }

            elseif(BrandTypes::where('brand_type_code',$request->brand_type_code)->exists()){
                return redirect()->back()->with('error','Please Try Unique Code Number');
            }
            else{
                $postBrandsTypes->brand_type_name = $request->brand_type_name;
                $postBrandsTypes->brand_type_code = $request->brand_type_code;
                $postBrandsTypes->brand_type_is_active = $request->brand_type_is_active;
                $postBrandsTypes->save();
                return redirect()->route('backoffice.brands')->with('success','Brands Update Successfully');
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BrandTypes  $brandTypes
     * @return \Illuminate\Http\Response
     */
    public function destroy(BrandTypes $brandTypes)
    {
        //
    }
}
