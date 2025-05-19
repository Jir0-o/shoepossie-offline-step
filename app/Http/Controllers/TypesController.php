<?php

namespace App\Http\Controllers;

use App\Models\Types;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Types::select('type_id','type_name','type_code','type_is_active')->orderby('type_code','asc')->get();
        return view('dashboard.Types.types',compact(['types']));
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
            'type_name' => 'required',
            'type_code' => 'required|numeric|min:0',
        ]);

        if ($request->type_code < 0) {
            return redirect()->back()->with('error','Code Must Be Positive Or 0');
        }

        if($validator->fails()){
            return redirect()->back()->with('error','Please Fill All Section');
        }
        else{
            $uniqueCode = $request->type_code;

            if(Types::where('type_code',$uniqueCode)->exists()){
                return redirect()->back()->with('error','Please Try Unique Code Number');
            }
            else{
                $storTypes = new Types;
                $storTypes->type_name = $request->type_name;
                $storTypes->type_code = $request->type_code;
                $storTypes->save();
                return redirect()->back()->with('success','Type Add Successfully');
            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Types  $types
     * @return \Illuminate\Http\Response
     */
    public function show(Types $types)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Types  $types
     * @return \Illuminate\Http\Response
     */
    public function edit(Types $types,$id)
    {
        $getId =  decrypt($id);

        $findTypes = Types::where('type_id',$getId)->first();
        return view('dashboard.Types.typesEdit',compact(['findTypes']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Types  $types
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Types $types,$id)
    {
        $validator = Validator::make($request->all(), [
            'type_name' => 'required',
            'type_code' => 'required|numeric|min:0',
        ]);

        if ($request->type_code < 0) {
            return redirect()->route('backoffice.types')->with('error','Code Must Be Positive Or 0');
        }

        if($validator->fails()){
            return redirect()->route('backoffice.types')->with('error','Please Fill All Section');
        }
        else{
            $postTypes = Types::find($id);
            if($postTypes->type_code==$request->type_code){
                $postTypes->type_name = $request->type_name;
                $postTypes->type_code = $request->type_code;
                $postTypes->type_is_active = $request->type_is_active;
                $postTypes->save();
                return redirect()->route('backoffice.types')->with('success','Type Update Successfully');
            }

            elseif(Types::where('type_code',$request->type_code)->exists()){
                return redirect()->back()->with('error','Please Try Unique Code Number');
            }
            else{
                $postTypes->type_name = $request->type_name;
                $postTypes->type_code = $request->type_code;
                $postTypes->type_is_active = $request->type_is_active;
                $postTypes->save();
                return redirect()->route('backoffice.types')->with('success','Type Update Successfully');
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Types  $types
     * @return \Illuminate\Http\Response
     */
    public function destroy(Types $types)
    {
        //
    }
}
