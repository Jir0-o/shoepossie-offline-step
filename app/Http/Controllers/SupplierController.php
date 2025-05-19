<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;

use App\Models\Supplier;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Supplier=Supplier::all();
        
        return view('dashboard.supplier.allSupplier',compact(['Supplier']));
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
              'supplier_name'=>'required',
              'supplier_address'=>'required',
              'supplier_contact_person'=>'required',
              'supplier_contact_no'=>'required',
              'is_active'=>'required',
          ]);
          
                                
          $Supplier = new Supplier();
          
          $Supplier->supplier_name = $request->supplier_name;
          $Supplier->supplier_address = $request->supplier_address;
          $Supplier->supplier_contact_person = $request->supplier_contact_person;
          $Supplier->supplier_contact_no = $request->supplier_contact_no;
          $Supplier->is_active = $request->is_active;
          $save = $Supplier->save();

          if( $save ){
              return redirect()->route('backoffice.all-suppliers')->with('success','Supplier Created successfully');
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
                return view('dashboard.supplier.addSupplier');
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
        $Supplier=Supplier::where('supplier_id','=',$id)->get();
        
        return view('dashboard.supplier.editSupplier',compact(['Supplier']));
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
              'supplier_name'=>'required',
              'supplier_address'=>'required',
              'supplier_contact_person'=>'required',
              'supplier_contact_no'=>'required',
              'is_active'=>'required',
          ]);
          
                                
          $Supplier = Supplier::find($request->id);
          
          $Supplier->supplier_name = $request->supplier_name;
          $Supplier->supplier_address = $request->supplier_address;
          $Supplier->supplier_contact_person = $request->supplier_contact_person;
          $Supplier->supplier_contact_no = $request->supplier_contact_no;
          $Supplier->is_active = $request->is_active;
          $save = $Supplier->save();

          if( $save ){
              return redirect()->route('backoffice.all-suppliers')->with('success','Supplier Updated successfully');
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
