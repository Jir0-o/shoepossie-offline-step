<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Models\PurchaseInfo;
use App\Models\Supplier;
use App\Models\SupplierPayment;
use Illuminate\Http\Request;

class SupplierPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Supplier::all();
        return view('purchase.supplierPayment', compact(['supplier']));
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
        $this->validate($request, [
            'amount' => 'required|numeric',
            'supplier_id' => 'required|numeric',
            'payment_method_id' => 'required|numeric'
        ]);

        if ($request->purchase_id != null) {
            $supplier_payment = PurchaseInfo::where('supplier_id', $request->supplier_id)
                ->where('purchase_id', $request->purchase_id)
                ->first();
            $payment = SupplierPayment::where('supplier_id', $request->supplier_id)
                ->where('purchase_id', $request->purchase_id)
                ->first();

            if ($request->amount > $supplier_payment->due_amount) {
                return redirect()->back()->with('fail', 'Amount exceeds due amount');
            }

            $supplier_payment->paid_amount += $request->amount;
            $supplier_payment->due_amount -= $request->amount;
            if ($supplier_payment->due_amoun <= 0) {
                $supplier_payment->paid_status = 2;
            }
            $supplier_payment->update();

            $payment->paid_amount += $request->amount;
            $payment->revised_due -= $request->amount;
            $payment->payment_method = $request->payment_method_id;
            if ($request->payment_method_id == 2) {
                $payment->bank_id = $request->bank_id;
                $payment->cheque_no = $request->cheque_no;
            }
            $payment->update();
        } else {
            $supplier_payment = new SupplierPayment();
            $supplier_payment->supplier_id = $request->supplier_id;
            $supplier_payment->paid_amount = $request->amount;
            $supplier_payment->payment_method = $request->payment_method_id;
            if ($request->payment_method_id == 2) {
                $supplier_payment->bank_id = $request->bank_id;
                $supplier_payment->cheque_no = $request->cheque_no;
            }
            $supplier_payment->save();
        }

        return redirect()->back()->with('success', 'Congratulations !! Payment Done Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ajaxGetSupInvoice($id)
    {
        $pur = PurchaseInfo::where('supplier_id', $id)->where('due_amount', '>', 0)->get();
        return response()->json($pur);
    }
    public function ajaxGetPurData($id)
    {
        $pur = PurchaseInfo::where('purchase_id', $id)->first();
        return response()->json($pur);
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
