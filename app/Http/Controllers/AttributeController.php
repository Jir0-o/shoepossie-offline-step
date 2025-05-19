<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\AttributeDefinition;
use App\Models\AttributeTypeDefinition;
use App\Models\ColorDefinition;
use App\Models\SizeDefinition;
use App\Models\Product;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $allAttributes=AttributeDefinition::with('attribute_type_definition')->get();
        return view('dashboard.attribute.allAttributes',compact(['allAttributes']));
    }
    
    
    public function getAjaxAttribute($id){
        $allAttributes=AttributeDefinition::join('attribute_type_definition','attribute_type_definition.attribute_type_id','attribute_definition.attribute_type_id')
        ->where('attribute_definition.attribute_id',$id)
        ->select('attribute_definition.*','attribute_type_definition.*')
        ->orderBy('attribute_definition.attribute_id')
        ->get();
        return $allAttributes->toArray();
    }
    
    public function editPurchaseAjaxAttribute($id,$product_id){
        $allAttributes=AttributeDefinition::join('attribute_type_definition','attribute_type_definition.attribute_type_id','attribute_definition.attribute_type_id')
        ->join('product_attribute','product_attribute.attribute_id','attribute_definition.attribute_id')
        ->where('product_attribute.product_id',$product_id)
        ->where('attribute_definition.attribute_id',$id)
        ->select('attribute_definition.*','attribute_type_definition.*','product_attribute.*')
        ->orderBy('attribute_definition.attribute_id')
        ->get();
        return $allAttributes->toArray();
    }
    
    
    public function getAjaxProduct($id){
        $allProducts=Product::where('product_id',$id)->get();
        return $allProducts->toArray();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getColor()
    {
        $color = ColorDefinition::all();
        
        return response()->json($color);
    }
    
    public function getSize()
    {
        $size = SizeDefinition::all();
        
        return response()->json($size);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
              'attribute_name'=>'required',
              'attribute_type'=>'required',
              'is_active'=>'required',
          ]);
          
          $AttributeDefinition = new AttributeDefinition();
          
          $AttributeDefinition->attribute_name = $request->attribute_name;
          $AttributeDefinition->attribute_type_id = $request->attribute_type;
          $AttributeDefinition->is_active = $request->is_active;
          $save = $AttributeDefinition->save();

          if( $save ){
              return redirect()->back()->with('success','Attribute Created successfully');
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
        $attType=AttributeTypeDefinition::where('is_active',1)->get();
        return view('dashboard.attribute.addAttribute',compact(['attType']));
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
        
        $attType=AttributeTypeDefinition::where('is_active',1)->get();
        $Attribute=AttributeDefinition::where('attribute_id','=',$id)->get();
        
        return view('dashboard.attribute.editAttributes',compact(['Attribute','attType']));
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
              'attribute_name'=>'required',
              'attribute_type'=>'required',
              'is_active'=>'required',
          ]);
          
          $AttributeDefinition = AttributeDefinition::find($request->id);
          
          $AttributeDefinition->attribute_name = $request->attribute_name;
          $AttributeDefinition->attribute_type_id = $request->attribute_type;
          $AttributeDefinition->is_active = $request->is_active;
          $save = $AttributeDefinition->save();

          if( $save ){
              return redirect()->route('backoffice.all-attributes')->with('success','Attribute Updated successfully');
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
