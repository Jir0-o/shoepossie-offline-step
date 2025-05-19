<?php

namespace App\Http\Controllers;

use App\Models\MaterialTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MaterialTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materialtTypes = MaterialTypes::select('material_type_id','material_type_name','material_type_code','material_type_is_active')->orderby('material_type_code','asc')->get();
        return view('dashboard.MaterialTypes.materialTypes',compact(['materialtTypes']));
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
            'material_type_name' => 'required',
            'material_type_code' => 'required|numeric|min:0',
        ]);

        if ($request->material_type_code < 0) {
            return redirect()->back()->with('error','Code Must Be Positive Or 0');
        }

        if($validator->fails()){
            return redirect()->back()->with('error','Please Fill All Section');
        }
        else{
            $uniqueCode = $request->material_type_code;

            if(MaterialTypes::where('material_type_code',$uniqueCode)->exists()){
                return redirect()->back()->with('error','Please Try Unique Code Number');
            }
            else{
                $storTypes = new MaterialTypes;
                $storTypes->material_type_name = $request->material_type_name;
                $storTypes->material_type_code = $request->material_type_code;
                $storTypes->save();
                return redirect()->back()->with('success','Material Type Add Successfully');
            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MaterialTypes  $materialTypes
     * @return \Illuminate\Http\Response
     */
    public function show(MaterialTypes $materialTypes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MaterialTypes  $materialTypes
     * @return \Illuminate\Http\Response
     */
    public function edit(MaterialTypes $materialTypes,$id)
    {
        $getId =  decrypt($id);

        $findMaterialTypes = MaterialTypes::where('material_type_id',$getId)->first();
        return view('dashboard.MaterialTypes.materialTypesEdit',compact(['findMaterialTypes']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MaterialTypes  $materialTypes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MaterialTypes $materialTypes,$id)
    {
        $validator = Validator::make($request->all(), [
            'material_type_name' => 'required',
            'material_type_code' => 'required|numeric|min:0',
        ]);

        if ($request->material_type_code < 0) {
            return redirect()->route('backoffice.material-types')->with('error','Code Must Be Positive Or 0');
        }

        if($validator->fails()){
            return redirect()->route('backoffice.material-types')->with('error','Please Fill All Section');
        }
        else{
            $postMaterialTypes = MaterialTypes::find($id);
            if($postMaterialTypes->material_type_code==$request->material_type_code){
                $postMaterialTypes->material_type_name = $request->material_type_name;
                $postMaterialTypes->material_type_code = $request->material_type_code;
                $postMaterialTypes->material_type_is_active = $request->material_type_is_active;
                $postMaterialTypes->save();
                return redirect()->route('backoffice.material-types')->with('success','Material Type Update Successfully');
            }

            elseif(MaterialTypes::where('material_type_code',$request->material_type_code)->exists()){
                return redirect()->back()->with('error','Please Try Unique Code Number');
            }
            else{
                $postMaterialTypes->material_type_name = $request->material_type_name;
                $postMaterialTypes->material_type_code = $request->material_type_code;
                $postMaterialTypes->material_type_is_active = $request->material_type_is_active;
                $postMaterialTypes->save();
                return redirect()->route('backoffice.material-types')->with('success','Type Update Successfully');
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MaterialTypes  $materialTypes
     * @return \Illuminate\Http\Response
     */
    public function destroy(MaterialTypes $materialTypes)
    {
        //
    }
}
