<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function store_list()
    {
        $all_Store_datas = Store::all();
        return view('store.allStore', ['all_Store_datas' => $all_Store_datas]);
    }

    public function add_store()
    {

        return view('store.addStore');
    }



    public function insert_store(Request $request)
    {
        //Validate Inputs
        $request->validate([
            'store_name' => 'required',
            'is_active' => 'required',
        ]);

        $insert_datas = new Store;
        $insert_datas->store_name = $request->store_name;
        $insert_datas->is_active = $request->is_active;
        $save =  $insert_datas->save();

        return redirect()->route('backoffice.store-list')->with('success', 'Store Add SuccessFully');
    }
    public function edit_store($id)
    {

        $getdata = Store::find($id);

        return view('store.editStore', ['getdatas' => $getdata]);
    }

    public function update_store(Request $request, $id)
    {

        //Validate Inputs
        $request->validate([
            'store_name' => 'required',
            'is_active' => 'required',
        ]);

        $update_data = Store::find($id);
        $update_data->store_name =  $request->store_name;
        $update_data->is_active =  $request->is_active;
        $save =  $update_data->save();
        if ($save) {
            return redirect()->route('backoffice.store-list')->with('update', 'Store Update SuccessFully');
        } else {
            return redirect()->back()->with('updatefail', 'Something went wrong, Please Try Again');
        }
    }
}
