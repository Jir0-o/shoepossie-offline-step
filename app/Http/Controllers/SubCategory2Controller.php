<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\SubCategoryOne;
use App\Models\SubCategoryTwo;

class SubCategory2Controller extends Controller
{
       public function index(){
            
            $subCategoryOne=SubCategoryOne::all();
            
            return view('dashboard.product.subCat2',compact(['subCategoryOne']));
        }
    
        public function createSubCategoryTwo(Request $request)
        {
   
            //Validate Inputs
              $request->validate([
                  'sub_cat1_id'=>'required',
                  'sub_cat2_name'=>'required',
                  'sc_two_image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                  'sub_cat2_status'=>'required',
              ]);
              
    
              $subcategoryTwo = new SubCategoryTwo();
              
              $imageName = $request->sc_two_image->getClientOriginalName();
          
              $request->sc_two_image->move(public_path('backend/images/'), $imageName);
              
              $subcategoryTwo->sc_one_id = $request->sub_cat1_id;
              $subcategoryTwo->sc_two_name = $request->sub_cat2_name;
              $subcategoryTwo->sc_two_image = $imageName;
              $subcategoryTwo->is_active = $request->sub_cat2_status;
              $save = $subcategoryTwo->save();
    
              if( $save ){
                  return redirect()->route('backoffice.all-subCat2')->with('success','Sub Category Two Created successfully');
              }else{
                  return redirect()->back()->with('fail','Something went wrong, failed to register');
              }
        }
        
        public function AllSubCat2(){
            
             $SubCategoryTwo=SubCategoryTwo::join('sub_category_one','sub_category_one.sc_one_id','=','sub_category_two.sc_one_id')
                            ->select('sub_category_two.*','sub_category_one.sc_one_id','sub_category_one.sc_one_name')
                            ->get();
        
            return view('dashboard.product.allSubCat2',compact(['SubCategoryTwo']));
        }
        
        public function edit($id){
            
            $id=Crypt::decryptString($id);
            $subCategoryOne=SubCategoryOne::all();
            $subCategoryTwo=SubCategoryTwo::where('sc_two_id','=',$id)->get();
            
            return view('dashboard.product.editSubCat2',compact(['subCategoryTwo','subCategoryOne']));
        }
        
        public function update(Request $request){
            //Validate Inputs
              $request->validate([
                  'sub_cat1_id'=>'required',
                  'sub_cat2_name'=>'required',
                  'sc_two_image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                  'sub_cat2_status'=>'required',
              ]);
              
    
              $subcategoryTwo = SubCategoryTwo::find($request->id);
              
              $imageName = $request->sc_two_image->getClientOriginalName();
          
              $request->sc_two_image->move(public_path('backend/images/'), $imageName);
              
              $subcategoryTwo->sc_one_id = $request->sub_cat1_id;
              $subcategoryTwo->sc_two_name = $request->sub_cat2_name;
              $subcategoryTwo->sc_two_image = $imageName;
              $subcategoryTwo->is_active = $request->sub_cat2_status;
              $save = $subcategoryTwo->save();
    
              if( $save ){
                  return redirect()->route('backoffice.all-subCat2')->with('success','Sub Category Two Updated successfully');
              }else{
                  return redirect()->back()->with('fail','Something went wrong, failed to register');
              }
        }
}
