<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use App\Models\ColorDefinition;

class ColorDefinitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Color=ColorDefinition::all();
        return view('dashboard.color.allColors',compact(['Color']));
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
              'color_name'=>'required',
              'color_syblol'=>'required',
              'is_active'=>'required',
          ]);
          
          $ColorDefinition = new ColorDefinition();
          
          $ColorDefinition->color_name = $request->color_name;
          $ColorDefinition->color_syblol = $request->color_syblol;
          $ColorDefinition->is_active = $request->is_active;
          $save = $ColorDefinition->save();

          if( $save ){
              return redirect()->back()->with('success','Color Created successfully');
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
        return view('dashboard.color.addColor');
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
        
        $Color=ColorDefinition::where('color_id','=',$id)->get();
        
        return view('dashboard.color.editColors',compact(['Color']));
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
         $request->validate([
          'color_name'=>'required',
          'color_syblol'=>'required',
          'is_active'=>'required',
          ]);
          
          $ColorDefinition = ColorDefinition::find($request->id);
          
          $ColorDefinition->color_name = $request->color_name;
          $ColorDefinition->color_syblol = $request->color_syblol;
          $ColorDefinition->is_active = $request->is_active;
          $save = $ColorDefinition->save();

          if( $save ){
              return redirect()->route('backoffice.all-colors')->with('success','Color Updated successfully');
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
