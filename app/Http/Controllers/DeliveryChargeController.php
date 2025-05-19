<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use App\Models\DeliveryChargeDefinition;
use App\Models\DeliveryAgency;

class DeliveryChargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $DeliveryCharge = DeliveryChargeDefinition::join('delivery_agency','delivery_agency.delivery_agency_id','=','delivery_charge_definition.agency_id')
                            ->select('delivery_charge_definition.*','delivery_agency.delivery_agency_name')
                            ->get();
        return view('dashboard.charge.allCharge',compact(['DeliveryCharge']));
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
              'deliver_charge_name'=>'required',
              'agency_id'=>'required',
              'package_description'=>'required',
              'source'=>'required',
              'destination'=>'required',
              'expected_delivery_days'=>'required',
              'delivery_charge'=>'required',
              'is_active'=>'required',
          ]);
          
                                
          $DeliveryCharge = new DeliveryChargeDefinition();
          
          $DeliveryCharge->deliver_charge_name = $request->deliver_charge_name;
          $DeliveryCharge->agency_id = $request->agency_id;
          $DeliveryCharge->package_description = $request->package_description;
          $DeliveryCharge->source = $request->source;
          $DeliveryCharge->destination = $request->destination;
          $DeliveryCharge->expected_delivery_days = $request->expected_delivery_days;
          $DeliveryCharge->delivery_charge = $request->delivery_charge;
          $DeliveryCharge->is_active = $request->is_active;
          $save = $DeliveryCharge->save();

          if( $save ){
              return redirect()->route('backoffice.all-charge')->with('success','Delivery Charge Created successfully');
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
       $DeliveryAgency=DeliveryAgency::all();
       
       return view('dashboard.charge.addCharge',compact(['DeliveryAgency']));
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
       $DeliveryAgency=DeliveryAgency::all();
       $DeliveryCharge=DeliveryChargeDefinition::where('delivery_charge_id','=',$id)->get();
       
       return view('dashboard.charge.editCharge',compact(['DeliveryAgency','DeliveryCharge']));
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
              'deliver_charge_name'=>'required',
              'agency_id'=>'required',
              'package_description'=>'required',
              'source'=>'required',
              'destination'=>'required',
              'expected_delivery_days'=>'required',
              'delivery_charge'=>'required',
              'is_active'=>'required',
          ]);
          
                                
          $DeliveryCharge =  DeliveryChargeDefinition::find($request->id);
          
          $DeliveryCharge->deliver_charge_name = $request->deliver_charge_name;
          $DeliveryCharge->agency_id = $request->agency_id;
          $DeliveryCharge->package_description = $request->package_description;
          $DeliveryCharge->source = $request->source;
          $DeliveryCharge->destination = $request->destination;
          $DeliveryCharge->expected_delivery_days = $request->expected_delivery_days;
          $DeliveryCharge->delivery_charge = $request->delivery_charge;
          $DeliveryCharge->is_active = $request->is_active;
          $save = $DeliveryCharge->save();

          if( $save ){
              return redirect()->route('backoffice.all-charge')->with('success','Delivery Charge Updated successfully');
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
