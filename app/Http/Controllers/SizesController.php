<?php

namespace App\Http\Controllers;

use App\Models\Sizes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SizesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sizes = Sizes::select('size_id','size_name','size_code','size_is_active')->get();
        return view('dashboard.sizesForProduct.sizes',compact(['sizes']));
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
            'size_name' => 'required',
            'size_code' => 'required|numeric|min:0',
        ]);

        if ($request->size_code < 0) {
            return redirect()->back()->with('error','Code Must Be Positive Or 0');
        }

        if($validator->fails()){
            return redirect()->back()->with('error','Please Fill All Section');
        }
        else{
            $uniqueCode = $request->size_code;

            if(Sizes::where('size_code',$uniqueCode)->exists()){
                return redirect()->back()->with('error','Please Try Unique Code Number');
            }
            else{
                $storSizes = new Sizes;
                $storSizes->size_name = $request->size_name;
                $storSizes->size_code = $request->size_code;
                $storSizes->save();
                return redirect()->back()->with('success','Sizes Add Successfully');
            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sizes  $sizes
     * @return \Illuminate\Http\Response
     */
    public function show(Sizes $sizes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sizes  $sizes
     * @return \Illuminate\Http\Response
     */
    public function edit(Sizes $sizes,$id)
    {
        $getId =  decrypt($id);

        $findSizes = Sizes::where('size_id',$getId)->first();
        return view('dashboard.sizesForProduct.sizesEdit',compact(['findSizes']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sizes  $sizes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sizes $sizes,$id)
    {
        $validator = Validator::make($request->all(), [
            'size_name' => 'required',
            'size_code' => 'required|numeric|min:0',
        ]);

        if ($request->size_code < 0) {
            return redirect()->route('backoffice.sizes')->with('error','Code Must Be Positive Or 0');
        }

        if($validator->fails()){
            return redirect()->route('backoffice.sizes')->with('error','Please Fill All Section');
        }
        else{
            $postSizes = Sizes::find($id);
            if($postSizes->size_code==$request->size_code){
                $postSizes->size_name = $request->size_name;
                $postSizes->size_code = $request->size_code;
                $postSizes->size_is_active = $request->size_is_active;
                $postSizes->save();
                return redirect()->route('backoffice.sizes')->with('success','Sizes Update Successfully');
            }

            elseif(Sizes::where('size_code',$request->size_code)->exists()){
                return redirect()->back()->with('error','Please Try Unique Code Number');
            }
            else{
                $postSizes->size_name = $request->size_name;
                $postSizes->size_code = $request->size_code;
                $postSizes->size_is_active = $request->size_is_active;
                $postSizes->save();
                return redirect()->route('backoffice.sizes')->with('success','Sizes Update Successfully');
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sizes  $sizes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sizes $sizes)
    {
        //
    }
}
