<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\CartInformtion;
use App\Models\ConsumerLogin;
use App\Models\CustomerPayment;
use App\Models\Supplier;
use Illuminate\Http\Request;

class CustomerPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = ConsumerLogin::all();
        return view('purchase.customerPayment', compact(['supplier']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxGetCusInvoice($id)
    {
        $pur = CartInformtion::where('consumer_id', $id)->where('due_amount', '>', 0)->get();
        return response()->json($pur);
    }

    public function ajaxGetCusData($id)
    {
        $pur = CartInformtion::where('cart_id', $id)->first();
        return response()->json($pur);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|numeric',
            'consumer_id' => 'required|numeric',
            'payment_method_id' => 'required|numeric'
        ]);

        if ($request->cart_id != null) {
            $customer_payment = CartInformtion::where('consumer_id', $request->consumer_id)
                ->where('cart_id', $request->cart_id)
                ->first();
            $payment = CustomerPayment::where('customer_id', $request->consumer_id)
                ->where('sales_info_id', $request->cart_id)
                ->first();

            if ($request->amount > $customer_payment->due_amount) {
                return redirect()->back()->with('fail', 'Amount exceeds due amount');
            }

            $customer_payment->due_amount -= $request->amount;

            if ($customer_payment->due_amoun <= 0) {
                $customer_payment->cart_status = 2;
            }
            $customer_payment->update();

            $payment->paid_amount += $request->amount;
            $payment->revised_due -= $request->amount;
            $payment->payment_method = $request->payment_method_id;
            if ($request->payment_method_id == 2) {
                $payment->bank_name = $request->bank_name;
                $payment->cheque_no = $request->cheque_no;
            }
            $payment->update();
        } else {
            $customer_payment = new CustomerPayment();
            $customer_payment->customer_id = $request->consumer_id;
            $customer_payment->paid_amount = $request->amount;
            $customer_payment->payment_method = $request->payment_method_id;
            if ($request->payment_method_id == 2) {
                $customer_payment->bank_name = $request->bank_name;
                $customer_payment->cheque_no = $request->cheque_no;
            }
            $customer_payment->save();
        }

        return redirect()->back()->with('success', 'Congratulations !! Payment Done Successfully');
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
