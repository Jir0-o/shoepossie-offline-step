<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\DeliveryAgent;

use App\Models\DeliveryAgency;

class DeliveryAgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $DeliveryAgent=DeliveryAgent::join('delivery_agency','delivery_agency.delivery_agency_id','=','delivery_agent.delivery_agency_id')
                            ->select('delivery_agent.*','delivery_agency.delivery_agency_name')
                            ->get();
        
        return view('dashboard.delivery.deliveryAgent',compact(['DeliveryAgent']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAgent($agency_id=0)
    {

     // Fetch Agents by Agency
     $empData['data'] = DeliveryAgent::where('delivery_agency_id',$agency_id)
        ->get();
     
     return response()->json($empData);


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
              'delivery_agent_name'=>'required',
              'delivery_agency_id'=>'required',
              'agent_contact_no'=>'required',
              'is_active'=>'required',
          ]);
          
          $DeliveryAgent = new DeliveryAgent();
          
          $DeliveryAgent->delivery_agent_name = $request->delivery_agent_name;
          $DeliveryAgent->delivery_agency_id = $request->delivery_agency_id;
          $DeliveryAgent->agent_contact_no = $request->agent_contact_no;
          $DeliveryAgent->is_active = $request->is_active;
          $save = $DeliveryAgent->save();

          if( $save ){
              return redirect()->route('backoffice.all-agent')->with('success','Agent Created successfully');
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
       
       return view('dashboard.delivery.addAgent',compact(['DeliveryAgency']));
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
       $DeliveryAgent=DeliveryAgent::where('delivery_agent_id','=',$id)->get();
       
       return view('dashboard.delivery.editAgent',compact(['DeliveryAgency','DeliveryAgent']));
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
              'delivery_agent_name'=>'required',
              'delivery_agency_id'=>'required',
              'agent_contact_no'=>'required',
              'is_active'=>'required',
          ]);
          
          $DeliveryAgent =DeliveryAgent::find($request->id);
          
          $DeliveryAgent->delivery_agent_name = $request->delivery_agent_name;
          $DeliveryAgent->delivery_agency_id = $request->delivery_agency_id;
          $DeliveryAgent->agent_contact_no = $request->agent_contact_no;
          $DeliveryAgent->is_active = $request->is_active;
          $save = $DeliveryAgent->save();

          if( $save ){
              return redirect()->route('backoffice.all-agent')->with('success','Agent Updated successfully');
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
