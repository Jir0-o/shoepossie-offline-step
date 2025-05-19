<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Models\PurchaseDetail;
use App\Models\PurchaseInfo;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PurchaseReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dailyPurchaseReport()
    {
        $user_id = session()->get('LoggedUser');
        $user_data = \App\Models\BackofficeLogin::join('backoffice_role', 'backoffice_role.role_id', '=', 'backoffice_login.role_id')
            ->where('login_id', $user_id)
            ->first();
        $banner_Information= \App\Models\BannerInformation::first();
        if($user_data->role_id==4){
            $current_date = Carbon::now()->format('Y-m-d');
            $PurchaseInfo = PurchaseInfo::where('pur_date', 'like', '%' . $current_date . '%')
            ->where('is_vat_show',1)->get();

            return view('purchase.reports.dailyPurchaseReport', compact(['PurchaseInfo']));
        }
        else{
            $current_date = Carbon::now()->format('Y-m-d');
            $PurchaseInfo = PurchaseInfo::where('pur_date', 'like', '%' . $current_date . '%')->get();

            return view('purchase.reports.dailyPurchaseReport', compact(['PurchaseInfo']));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rangePurchaseReport()
    {
        $PurchaseInfo = PurchaseInfo::whereBetween('purchase_info.pur_date', ["2022-12-15 14:22:09", "2022-12-16 14:22:09"])->get();

        return view('purchase.reports.rengePurchaseReport', compact(['PurchaseInfo']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function allPurchaseReport()
    {
        $user_id = session()->get('LoggedUser');
        $user_data = \App\Models\BackofficeLogin::join('backoffice_role', 'backoffice_role.role_id', '=', 'backoffice_login.role_id')
            ->where('login_id', $user_id)
            ->first();
        $banner_Information= \App\Models\BannerInformation::first();
        if($user_data->role_id==4){
            $PurchaseInfo = PurchaseInfo::where('is_vat_show',1)->get();
            $Supplier = Supplier::all();
            return view('purchase.reports.allPurchaseReport', compact(['PurchaseInfo', 'Supplier']));
        }
        else{
            $PurchaseInfo = PurchaseInfo::all();
            $Supplier = Supplier::all();
            return view('purchase.reports.allPurchaseReport', compact(['PurchaseInfo', 'Supplier']));
        }

    }
    public function allPurchaseReportForVat(Request $request){

        $getAllId = $request->selectedRowIds;
        $perchase = PurchaseInfo::whereIn('purchase_id',$getAllId)->get();
        foreach($perchase as $perchase){
            $perchase->is_vat_show = 1;
            $perchase->save();
        }
        return response()->json([
            'status'=> 200,
            'success'=>'success'
        ]);
    }

    public function supPurchaseReport($supplier_id)
    {
        $PurchaseInfo = PurchaseInfo::where('purchase_info.supplier_id', $supplier_id)
            ->select('purchase_info.*')
            ->get();

        return response()->json($PurchaseInfo);
    }
    public function purNameQuantity($purchase_id)
    {
        $cart_item_data = PurchaseDetail::join('products', 'products.product_id', '=', 'purchase_details.product_id')
            ->where('purchase_details.purchase_id', $purchase_id)
            ->select('purchase_details.quantity', 'products.product_name')
            ->get();

        return response()->json($cart_item_data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
