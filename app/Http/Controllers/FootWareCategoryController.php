<?php

namespace App\Http\Controllers;

use App\Models\FootWareCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FootWareCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $footWareCategory = FootWareCategory::select('foot_ware_categories_id','foot_ware_categories_name','foot_ware_categories_code','foot_ware_categories_is_active')->orderby('foot_ware_categories_code','asc')->get();
        return view('dashboard.FootwareCategory.footWareCategory',compact(['footWareCategory']));
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
            'foot_ware_categories_name' => 'required',
            'foot_ware_categories_code' => 'required|numeric|min:0',
        ]);

        if ($request->foot_ware_categories_code < 0) {
            return redirect()->back()->with('error','Code Must Be Positive Or 0');
        }

        if($validator->fails()){
            return redirect()->back()->with('error','Please Fill All Section');
        }
        else{
            $uniqueCode = $request->foot_ware_categories_code;

            if(FootWareCategory::where('foot_ware_categories_code',$uniqueCode)->exists()){
                return redirect()->back()->with('error','Please Try Unique Code Number');
            }
            else{
                $storFootWareCategory = new FootWareCategory;
                $storFootWareCategory->foot_ware_categories_name = $request->foot_ware_categories_name;
                $storFootWareCategory->foot_ware_categories_code = $request->foot_ware_categories_code;
                $storFootWareCategory->save();
                return redirect()->back()->with('success','Foot Ware Category Add Successfully');
            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FootWareCategory  $footWareCategory
     * @return \Illuminate\Http\Response
     */
    public function show(FootWareCategory $footWareCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FootWareCategory  $footWareCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(FootWareCategory $footWareCategory,$id)
    {
        $getId =  decrypt($id);

        $findFootWareCategory = FootWareCategory::where('foot_ware_categories_id',$getId)->first();
        return view('dashboard.FootwareCategory.footWareCategoryEdit',compact(['findFootWareCategory']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FootWareCategory  $footWareCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FootWareCategory $footWareCategory,$id)
    {
        $validator = Validator::make($request->all(), [
            'foot_ware_categories_name' => 'required',
            'foot_ware_categories_code' => 'required|numeric|min:0',
        ]);

        if ($request->foot_ware_categories_code < 0) {
            return redirect()->route('backoffice.footWareCategory')->with('error','Code Must Be Positive Or 0');
        }

        if($validator->fails()){
            return redirect()->route('backoffice.footWareCategory')->with('error','Please Fill All Section');
        }
        else{
            $postFootWareCategory = FootWareCategory::find($id);
            if($postFootWareCategory->foot_ware_categories_code==$request->foot_ware_categories_code){
                $postFootWareCategory->foot_ware_categories_name = $request->foot_ware_categories_name;
                $postFootWareCategory->foot_ware_categories_code = $request->foot_ware_categories_code;
                $postFootWareCategory->foot_ware_categories_is_active = $request->foot_ware_categories_is_active;
                $postFootWareCategory->save();
                return redirect()->route('backoffice.footWareCategory')->with('success','Foot Ware Category Update Successfully');
            }

            elseif(FootWareCategory::where('foot_ware_categories_code',$request->foot_ware_categories_code)->exists()){
                return redirect()->back()->with('error','Please Try Unique Code Number');
            }
            else{
                $postFootWareCategory->foot_ware_categories_name = $request->foot_ware_categories_name;
                $postFootWareCategory->foot_ware_categories_code = $request->foot_ware_categories_code;
                $postFootWareCategory->foot_ware_categories_is_active = $request->foot_ware_categories_is_active;
                $postFootWareCategory->save();
                return redirect()->route('backoffice.footWareCategory')->with('success','Foot Ware Category Update Successfully');
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FootWareCategory  $footWareCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(FootWareCategory $footWareCategory)
    {
        //
    }
}
