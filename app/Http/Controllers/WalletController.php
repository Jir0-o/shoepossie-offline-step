<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\CommissionWithdraw;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $CommissionWithdraw = CommissionWithdraw::join('consumer_information', 'consumer_information.consumer_id', '=', 'commission_withdraw.consumer_id')
            ->join('consumer_Login', 'consumer_Login.consumer_id', '=', 'consumer_information.consumer_id')
            ->select('commission_withdraw.*', 'consumer_information.consumer_name', 'consumer_Login.mobile_no')
            ->get();

        return view('dashboard.wallet.allWithdraw', compact(['CommissionWithdraw']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function verify($id)
    {
        $commission_withdraw_id = Crypt::decryptString($id);
        $CommissionWithdraw = CommissionWithdraw::where('commission_withdraw_id', $commission_withdraw_id)->first();
        $CommissionWithdraw->is_verified = 1;
        $CommissionWithdraw->save();
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function payment_given($id)
    {
        $commission_withdraw_id = Crypt::decryptString($id);
        $CommissionWithdraw = CommissionWithdraw::where('commission_withdraw_id', $commission_withdraw_id)->first();
        $CommissionWithdraw->is_verified = 2;
        $CommissionWithdraw->save();
        return redirect()->back();
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
