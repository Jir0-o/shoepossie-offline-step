<?php

namespace App\Http\Controllers;

use App\Models\Colors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ColorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = Colors::select('colors_id','colors_name','colors_code','colors_is_active')->orderby('colors_code','asc')->get();
        return view('dashboard.ColorsForCat.colors',compact(['colors']));
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
            'colors_name' => 'required',
            'colors_code' => 'required|numeric|min:0',
        ]);

        if ($request->colors_code < 0) {
            return redirect()->back()->with('error','Code Must Be Positive Or 0');
        }

        if($validator->fails()){
            return redirect()->back()->with('error','Please Fill All Section');
        }
        else{
            $uniqueCode = $request->colors_code;

            if(Colors::where('colors_code',$uniqueCode)->exists()){
                return redirect()->back()->with('error','Please Try Unique Code Number');
            }
            else{
                $storColors = new Colors;
                $storColors->colors_name = $request->colors_name;
                $storColors->colors_code = $request->colors_code;
                $storColors->save();
                return redirect()->back()->with('success','Colors Add Successfully');
            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Colors  $colors
     * @return \Illuminate\Http\Response
     */
    public function show(Colors $colors)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Colors  $colors
     * @return \Illuminate\Http\Response
     */
    public function edit(Colors $colors,$id)
    {
        $getId =  decrypt($id);

        $findColors= Colors::where('colors_id',$getId)->first();
        return view('dashboard.ColorsForCat.colorsEdit',compact(['findColors']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Colors  $colors
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Colors $colors,$id)
    {
        $validator = Validator::make($request->all(), [
            'colors_name' => 'required',
            'colors_code' => 'required|numeric|min:0',
        ]);

        if ($request->colors_code < 0) {
            return redirect()->route('backoffice.colors')->with('error','Code Must Be Positive Or 0');
        }

        if($validator->fails()){
            return redirect()->route('backoffice.colors')->with('error','Please Fill All Section');
        }
        else{
            $postColors = Colors::find($id);
            if($postColors->colors_code==$request->colors_code){
                $postColors->colors_name = $request->colors_name;
                $postColors->colors_code = $request->colors_code;
                $postColors->colors_is_active = $request->colors_is_active;
                $postColors->save();
                return redirect()->route('backoffice.colors')->with('success','Colors Update Successfully');
            }

            elseif(Colors::where('colors_code',$request->colors_code)->exists()){
                return redirect()->back()->with('error','Please Try Unique Code Number');
            }
            else{
                $postColors->colors_name = $request->colors_name;
                $postColors->colors_code = $request->colors_code;
                $postColors->colors_is_active = $request->colors_is_active;
                $postColors->save();
                return redirect()->route('backoffice.colors')->with('success','Colors Update Successfully');
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Colors  $colors
     * @return \Illuminate\Http\Response
     */
    public function destroy(Colors $colors)
    {
        //
    }
}
