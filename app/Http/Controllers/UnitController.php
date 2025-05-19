<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\UnitDefinition;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Unit = UnitDefinition::all();
       
        return view('dashboard.unit.allUnit',compact(['Unit']));
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
              'unit_name'=>'required',
              'unit_symbol'=>'required',
              'is_fractional'=>'required',
              'is_active'=>'required',
          ]);
          
                                
          $Unit = new UnitDefinition();
          
          $Unit->unit_name = $request->unit_name;
          $Unit->unit_symbol = $request->unit_symbol;
          $Unit->is_fractional = $request->is_fractional;
          $Unit->is_active = $request->is_active;
          $save = $Unit->save();

          if( $save ){
              return redirect()->route('backoffice.all-unit')->with('success','Unit Created successfully');
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
        return view('dashboard.unit.addUnit');
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
        $Unit = UnitDefinition::where('unit_id','=',$id)->get();
       
        return view('dashboard.unit.editUnit',compact(['Unit']));
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
              'unit_name'=>'required',
              'unit_symbol'=>'required',
              'is_fractional'=>'required',
              'is_active'=>'required',
          ]);
          
                                
          $Unit =UnitDefinition::find($request->id);
          
          
          $Unit->unit_name = $request->unit_name;
          $Unit->unit_symbol = $request->unit_symbol;
          $Unit->is_fractional = $request->is_fractional;
          $Unit->is_active = $request->is_active;
          $save = $Unit->save();

          if( $save ){
              return redirect()->route('backoffice.all-unit')->with('success','Unit Updated successfully');
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
