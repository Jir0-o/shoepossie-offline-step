<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;

use Illuminate\Http\Request;
use App\Models\DeliveryAgency;

class DeliveryAgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $DeliveryAgency=DeliveryAgency::all();
        
        return view('dashboard.delivery.deliveryAgency',compact(['DeliveryAgency']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

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
              'delivery_agency_name'=>'required',
              'delivery_agency_address'=>'required',
              'delivery_agency_contact'=>'required',
              'is_active'=>'required',
          ]);
          
          $DeliveryAgency = new DeliveryAgency();
          
          $DeliveryAgency->delivery_agency_name = $request->delivery_agency_name;
          $DeliveryAgency->agency_address = $request->delivery_agency_address;
          $DeliveryAgency->agency_contact_no = $request->delivery_agency_contact;
          $DeliveryAgency->is_active = $request->is_active;
          $save = $DeliveryAgency->save();

          if( $save ){
              return redirect()->route('backoffice.all-agency')->with('success','Agency Created successfully');
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
        return view('dashboard.delivery.addAgency');
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
        $DeliveryAgency= DeliveryAgency::where('delivery_agency_id','=',$id)->get();
        
        return view('dashboard.delivery.editAgency',compact(['DeliveryAgency']));
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
              'delivery_agency_name'=>'required',
              'delivery_agency_address'=>'required',
              'delivery_agency_contact'=>'required',
              'is_active'=>'required',
          ]);
          
          $DeliveryAgency = DeliveryAgency::find($request->id);
          
          $DeliveryAgency->delivery_agency_name = $request->delivery_agency_name;
          $DeliveryAgency->agency_address = $request->delivery_agency_address;
          $DeliveryAgency->agency_contact_no = $request->delivery_agency_contact;
          $DeliveryAgency->is_active = $request->is_active;
          $save = $DeliveryAgency->save();

          if( $save ){
              return redirect()->route('backoffice.all-agency')->with('success','Agency Updated successfully');
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
