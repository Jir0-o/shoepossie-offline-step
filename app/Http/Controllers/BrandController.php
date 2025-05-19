<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\Crypt;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Brand =Brand::all();
        return view('dashboard.brands.allBrands',compact(['Brand']));
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
              'brand_name'=>'required',
              'brand_logo'=>'required|image|max:2048',
              'is_active'=>'required',
          ]);
          
          
          $Brand = new Brand();
          
          
            $imageFile = $request->file('brand_logo')->getClientOriginalName();
            $imageName = date('Ymd').time().pathinfo($imageFile, PATHINFO_FILENAME).'.webp';
            $img = Image::make($request->file('brand_logo'))->encode('webp')->resize(300,300)->save(public_path('backend/images/brands/'.$imageName));

          

          $Brand->brand_name = $request->brand_name;
          $Brand->brand_logo = $imageName;
          $Brand->is_active = $request->is_active;
          $save = $Brand->save();

          if( $save ){
              return redirect()->back()->with('success','Brand Created successfully');
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
        return view('dashboard.brands.addBrand');
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
        
        $Brand=Brand::where('brand_id','=',$id)->get();
        
        return view('dashboard.brands.editBrand',compact(['Brand']));
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
              'brand_name'=>'required',
              'brand_logo'=>'required|image|max:2048',
              'is_active'=>'required',
          ]);
          
          $Brand = Brand::find($request->id);
          
          $destination= 'backend/images/brands/'.$Brand->bramd_logo;
            
            if(File::exists($destination)){
                File::delete($destination);
            }
          
          $imageFile = $request->file('brand_logo')->getClientOriginalName();
          $imageName = date('Ymd').time().pathinfo($imageFile, PATHINFO_FILENAME).'.webp';
          $img = Image::make($request->file('brand_logo'))->encode('webp')->resize(300,300)->save(public_path('backend/images/brands/'.$imageName));
          
          $Brand->brand_name = $request->brand_name;
          $Brand->brand_logo = $imageName;
          $Brand->is_active = $request->is_active;
          $save = $Brand->save();

          if( $save ){
              return redirect()->back()->with('success','brand Updated successfully');
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
