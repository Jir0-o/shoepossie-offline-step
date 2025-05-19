<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseDetail;
use App\Models\Product;
use App\Models\WebNewArrival;
use App\Models\WebOnSale;
use Carbon\Carbon;

class WebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function new_arraival()
    {
        $Purchase=PurchaseDetail::join('products','products.product_id','=','purchase_details.product_id')
                                ->join('web_new_arrival','web_new_arrival.product_id','=','products.product_id')
                                ->join('unit_definition','unit_definition.unit_id','=','products.unit_type')
                                ->where('web_new_arrival.is_active','=',1)
                                ->select('products.*','purchase_details.*','unit_definition.unit_id','unit_definition.unit_name')
                                ->get();

        return view('dashboard.web.allNewArraival',compact(['Purchase']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_new_arraival()
    {
        $Purchase=PurchaseDetail::join('products','products.product_id','=','purchase_details.product_id')
                                ->select('products.*','purchase_details.*')
                                ->get();
        
        return view('dashboard.web.addNewArraival',compact(['Purchase']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     
    public function store_new_arraival(Request $request)
    {

        $currentTime = Carbon::now()->format('d-m-Y');
        $user_id=session()->get('LoggedUser');
        
        $product_check=WebNewArrival::where('product_id','=',$request->product_id)->exists();
        
        if($product_check){
            
            return redirect()->back()->with('fail','Already in new Arraival List');
        
        }else{
            
        $WebNewArrival=new WebNewArrival();
        
        $WebNewArrival->product_id=$request->product_id;
        $WebNewArrival->web_new_arrival_listed_on=$currentTime;
        $WebNewArrival->web_new_arrival_listed_by=$user_id;
        $WebNewArrival->is_active=$request->status;
        $save=$WebNewArrival->save();
        
        if( $save ){
              return redirect()->back()->with('success','Product Added to New Arraival');
          }else{
              return redirect()->back()->with('fail','Something went wrong, failed to register');
         }
        
            
        }
    }
    
    
    public function store_on_sale(Request $request)
    {

        $currentTime = Carbon::now()->format('d-m-Y');
        $user_id=session()->get('LoggedUser');
        
        $product_check=WebOnSale::where('product_id','=',$request->product_id)->exists();
        
        if($product_check){
            
            return redirect()->back()->with('fail','Already in On Sale');
        
        }else{
            
        $WebOnSale=new WebOnSale();
        
        $WebOnSale->product_id=$request->product_id;
        $WebOnSale->on_sale_listed_on=$currentTime;
        $WebOnSale->on_sale_listed_by=$user_id;
        $WebOnSale->is_active=$request->status;
        $save=$WebOnSale->save();
        
        if( $save ){
              return redirect()->back()->with('success','Product Added to On Sale');
          }else{
              return redirect()->back()->with('fail','Something went wrong, failed to register');
         }
        
            
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function on_sale()
    {
        $Purchase=PurchaseDetail::join('products','products.product_id','=','purchase_details.product_id')
                                ->join('web_on_sale','web_on_sale.product_id','=','products.product_id')
                                ->join('unit_definition','unit_definition.unit_id','=','products.unit_type')
                                ->where('web_on_sale.is_active','=',1)
                                ->select('products.*','purchase_details.*','unit_definition.unit_id','unit_definition.unit_name')
                                ->get();

        return view('dashboard.web.allOnSale',compact(['Purchase']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_on_sale()
    {
        $Purchase=PurchaseDetail::join('products','products.product_id','=','purchase_details.product_id')
                                ->select('products.*','purchase_details.*')
                                ->get();
        
        return view('dashboard.web.addOnSale',compact(['Purchase']));
    }


}
