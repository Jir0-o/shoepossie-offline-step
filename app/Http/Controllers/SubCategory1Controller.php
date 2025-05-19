<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\SubCategoryOne;
use App\Models\ProductCategory;

class SubCategory1Controller extends Controller
{
    public function index()
    {

        $category = ProductCategory::all();
        return view('dashboard.product.subCat1', compact(['category']));
    }

    public function createSubCategoryOne(Request $request)
    {

        //Validate Inputs
        $request->validate([
            'category_id' => 'required',
            'sub_cat1_name' => 'required',
            'sc_one_image' => 'required|image|max:2048',
            'sub_cat1_status' => 'required',
        ]);


        $subcategoryOne = new SubCategoryOne();
        if ($file = $request->file('sc_one_image')) {
            $imageName = date("dmy") . $file->getClientOriginalName();
            $path = url('/') . "/backend/images/CategoryWise/" . $imageName;
            $request->sc_one_image->move(public_path('backend/images/CategoryWise/'), $imageName);
            $subcategoryOne->sc_one_image = $imageName;
            $subcategoryOne->sc_one_image_path = $path;
        }
        $subcategoryOne->category_id = $request->category_id;
        $subcategoryOne->sc_one_name = $request->sub_cat1_name;
        $subcategoryOne->is_active = $request->sub_cat1_status;
        $save = $subcategoryOne->save();

        if ($save) {
            return redirect()->route('backoffice.all-subCat1')->with('success', 'Sub Category One Created successfully');
        } else {
            return redirect()->back()->with('fail', 'Something went wrong, failed to register');
        }
    }


    public function AllSubCat1()
    {

        $SubCategoryOne = SubCategoryOne::join('product_category', 'product_category.category_id', '=', 'sub_category_one.category_id')
            ->select('sub_category_one.*', 'product_category.category_id', 'product_category.category_name')
            ->get();

        return view('dashboard.product.allSubCat1', compact(['SubCategoryOne']));
    }

    public function edit($id)
    {
        $id = Crypt::decryptString($id);
        $Categories = ProductCategory::all();
        $subCategoryOne = SubCategoryOne::where('sc_one_id', '=', $id)->get();

        return view('dashboard.product.editSubCat1', compact(['Categories', 'subCategoryOne']));
    }

    public function update(Request $request)
    {
        //Validate Inputs
        $request->validate([
            'category_id' => 'required',
            'sub_cat1_name' => 'required',
            'sub_cat1_status' => 'required',
        ]);


        $subcategoryOne = SubCategoryOne::find($request->id);

        if ($file = $request->file('sc_one_image')) {
            $imageName = date("dmy") . $file->getClientOriginalName();
            $path = url('/') . "/backend/images/CategoryWise/" . $imageName;
            $request->sc_one_image->move(public_path('backend/images/CategoryWise/'), $imageName);
            $subcategoryOne->sc_one_image = $imageName;
            $subcategoryOne->sc_one_image_path = $path;
        }

        $subcategoryOne->category_id = $request->category_id;
        $subcategoryOne->sc_one_name = $request->sub_cat1_name;
        $subcategoryOne->is_active = $request->sub_cat1_status;
        $save = $subcategoryOne->update();

        if ($save) {
            return redirect()->route('backoffice.all-subCat1')->with('success', 'Sub Category One Updated successfully');
        } else {
            return redirect()->back()->with('fail', 'Something went wrong, failed to register');
        }
    }
}
