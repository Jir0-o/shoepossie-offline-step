<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;

use Illuminate\Http\Request;
use App\Models\SizeDefinition;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $Size = SizeDefinition::all();
       
        return view('dashboard.size.allSize',compact(['Size']));
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
        //Validate Inputs
        
          $request->validate([
              'size_name'=>'required',
              'size_symbol'=>'required',
              'is_active'=>'required',
          ]);
          
                                
          $Size = new SizeDefinition();
          
          $Size->size_name = $request->size_name;
          $Size->size_symbol = $request->size_symbol;
          $Size->is_active = $request->is_active;
          $save = $Size->save();

          if( $save ){
              return redirect()->route('backoffice.all-size')->with('success','Size Created successfully');
          }else{
              return redirect()->back()->with('fail','Something went wrong, failed to register');
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('dashboard.size.addSize');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id=Crypt::decryptString($id);
        
        $Size = SizeDefinition::where('size_id','=',$id)->get();
       
        return view('dashboard.size.editSize',compact(['Size']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
                        //Validate Inputs
        
          $request->validate([
              'size_name'=>'required',
              'size_symbol'=>'required',
              'is_active'=>'required',
          ]);
          
                                
          $Size = SizeDefinition::find($request->id);
          
          $Size->size_name = $request->size_name;
          $Size->size_symbol = $request->size_symbol;
          $Size->is_active = $request->is_active;
          $save = $Size->save();

          if( $save ){
              return redirect()->route('backoffice.all-size')->with('success','Size updated successfully');
          }else{
              return redirect()->back()->with('fail','Something went wrong, failed to register');
          }
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
