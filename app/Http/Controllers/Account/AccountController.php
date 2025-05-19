<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\BankTransaction;
use App\Models\BannerInformation;
use App\Models\CartInformtion;
use App\Models\CustomerPayment;
use App\Models\DayEndBalance;
use App\Models\Expense;
use App\Models\PurchaseDetail;
use App\Models\PurchaseInfo;
use App\Models\SupplierPayment;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function accountsReceivable()
    {
        $CartInfo = CartInformtion::join('backoffice_login as usr', 'usr.login_id', '=', 'cart_informtion.created_by') //->join('backoffice_login as wtr', 'wtr.login_id', '=', 'cart_informtion.waiter_id')
            ->where('cart_informtion.due_amount', '>', 0)
            ->select('cart_informtion.*', 'usr.full_name as created_by_name') //, 'wtr.full_name as waiter_name')
            ->get();
        return view('account.accountsReceivable', compact(['CartInfo']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function accountsPayable()
    {
        $PurchaseInfo = PurchaseInfo::where('due_amount', '>', 0)->get();
        return view('account.accountsPayable', compact(['PurchaseInfo']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function paymentReport()
    {
        $bank_transactions = BankTransaction::all();
        $SupplierPayment = SupplierPayment::all();
        $customerPayments = CustomerPayment::all();

        return view('account.paymentReport', compact(['bank_transactions']));
    }

    public function supplierPayments()
    {
        $SupplierPayment = SupplierPayment::all();
        return view('account.SupplierPayment', compact(['SupplierPayment']));
    }
    public function customerPayments()
    {
        $customerPayments = CustomerPayment::all();
        return view('account.customerPayment', compact(['customerPayments']));
    }

    public function cashFlow()
    {
        return view('account.cashFlow');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function incomeStatement()
    {
        $PurchaseInfo = CartInformtion::all();
        $banner = BannerInformation::first();

        return view('account.incomeStatement', compact(['PurchaseInfo', 'banner']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ajaxGetIncomeStat($id)
    {
        $date = $id;
        $dayend = DayEndBalance::where('date', $date)->exists();

        if (!$dayend) {
            $lastday = DayEndBalance::latest("day_end_balance_id")->first();
            $opening_balance = $lastday->closing_balance;
        } else {
            $day = DayEndBalance::where("date", $date)->first();
            $lastday = DayEndBalance::where("day_end_balance_id", '<', $day->day_end_balance_id)->orderBy('day_end_balance_id', 'desc')->first();
            $opening_balance = $lastday->closing_balance;
        }

        //Sales
        $cartinfo = CartInformtion::leftJoin('customer_payments', 'customer_payments.sales_info_id', '=', 'cart_informtion.cart_id')
            ->where('cart_informtion.cart_date', 'like', '%' . $date . '%')
            ->where('customer_payments.payment_method', 1)
            ->select('cart_informtion.*')
            ->get();
        $sales_total_payable_amount = $cartinfo->sum('total_payable_amount');
        $sales_gross_profit = $cartinfo->sum('gross_profit');
        $sales_total_due = $cartinfo->sum('due_amount');
        $sales_paid_amount = $cartinfo->sum('paid_amount');

        //Purchase
        $purchaseInfo = PurchaseInfo::leftJoin('supplier_payments', 'supplier_payments.purchase_id', '=', 'purchase_info.purchase_id')
            ->where('purchase_info.pur_date', 'like', '%' . $date . '%')
            ->where('supplier_payments.payment_method', 1)
            ->select(
                'purchase_info.*',
                'supplier_payments.payment_method'
            )
            ->get();
        $purchase_total_payable_amount = $purchaseInfo->sum('total_payable');
        $purchase_total_due = $purchaseInfo->sum('due_amount');
        $purchase_paid_amount = $purchaseInfo->sum('paid_amount');

        //Supplier Payment
        $supPayment = SupplierPayment::where('created_at', 'like', '%' . $date . '%')
            ->where('payment_method', 1)
            ->where('purchase_id', '=', null)
            ->get();
        $all_supplier_payments =  $supPayment->sum("paid_amount");

        //Supplier Payment
        $cusPayment = CustomerPayment::where('created_at', 'like', '%' . $date . '%')
            ->where('sales_info_id', '=', null)
            ->get();
        $all_customer_payments =  $cusPayment->sum("paid_amount");

        //Expense
        $expense = Expense::join('expense_details', 'expense_details.expense_id', '=', 'expenses.expense_id')
            ->where('expense_details.date', 'like', '%' . $date . '%')
            ->get();
        $total_expense = $expense->sum('amount');

        $balance = $opening_balance + $sales_paid_amount + $all_customer_payments - $purchase_paid_amount - $all_supplier_payments - $total_expense;


        $data = array(
            'balance' => $balance,
            'opening_balance' => $opening_balance,
            'sales_total_payable_amount' => $sales_total_payable_amount,
            'sales_paid_amount' => $sales_paid_amount,
            'sales_total_due' => $sales_total_due,
            'sales_gross_profit' => $sales_gross_profit,
            'total_expense' => $total_expense,
            'purchase_total_payable_amount' => $purchase_total_payable_amount,
            'purchase_total_due' => $purchase_total_due,
            'purchase_paid_amount' => $purchase_paid_amount,
            'all_supplier_payments' => $all_supplier_payments,
            'all_customer_payments' => $all_customer_payments,
            'dayend' => $dayend,
            'date' => $date,
        );
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function multiDateIncomeStat($from, $to)
    {
        $cartinfo = CartInformtion::whereBetween('cart_date', [$from, $to])->get();
        $total_payable_amount = $cartinfo->sum('total_payable_amount');
        $gross_profit = $cartinfo->sum('gross_profit');

        $expense = Expense::join('expense_details', 'expense_details.expense_id', '=', 'expenses.expense_id')
            ->whereBetween('expense_details.date', [$from, $to])
            ->get();
        $total_expense = $expense->sum('amount');
        $balance = $total_payable_amount - $total_expense;

        $data = array('balance' => $balance, 'total_payable_amount' => $total_payable_amount, 'gross_profit' => $gross_profit, 'total_expense' => $total_expense);
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function dayEnd($id)
    {
        $date = $id;

        $lastday = DayEndBalance::latest("day_end_balance_id")->first();
        $opening_balance = $lastday->closing_balance;
        //Sales
        $cartinfo = CartInformtion::leftJoin('customer_payments', 'customer_payments.sales_info_id', '=', 'cart_informtion.cart_id')
            ->where('cart_informtion.cart_date', 'like', '%' . $date . '%')
            ->where('customer_payments.payment_method', 1)
            ->select('cart_informtion.*')
            ->get();
        $sales_total_payable_amount = $cartinfo->sum('total_payable_amount');
        $sales_gross_profit = $cartinfo->sum('gross_profit');
        $sales_total_due = $cartinfo->sum('due_amount');
        $sales_paid_amount = $cartinfo->sum('paid_amount');

        //Purchase
        $purchaseInfo = PurchaseInfo::leftJoin('supplier_payments', 'supplier_payments.purchase_id', '=', 'purchase_info.purchase_id')
            ->where('purchase_info.pur_date', 'like', '%' . $date . '%')
            ->where('supplier_payments.payment_method', 1)
            ->select(
                'purchase_info.*',
                'supplier_payments.payment_method'
            )
            ->get();
        $purchase_total_payable_amount = $purchaseInfo->sum('total_payable');
        $purchase_total_due = $purchaseInfo->sum('due_amount');
        $purchase_paid_amount = $purchaseInfo->sum('paid_amount');

        //Supplier Payment
        $supPayment = SupplierPayment::where('created_at', 'like', '%' . $date . '%')
            ->where('payment_method', 1)
            ->where('purchase_id', '=', null)
            ->get();
        $all_supplier_payments =  $supPayment->sum("paid_amount");

        //Supplier Payment
        $cusPayment = CustomerPayment::where('created_at', 'like', '%' . $date . '%')
            ->where('sales_info_id', '=', null)
            ->get();
        $all_customer_payments =  $cusPayment->sum("paid_amount");

        //Expense
        $expense = Expense::join('expense_details', 'expense_details.expense_id', '=', 'expenses.expense_id')
            ->where('expense_details.date', 'like', '%' . $date . '%')
            ->get();
        $total_expense = $expense->sum('amount');

        $balance = $sales_paid_amount + $all_customer_payments - $total_expense - $purchase_paid_amount - $all_supplier_payments;

        $DayEndBalance = new DayEndBalance();
        $DayEndBalance->date = $date;
        $DayEndBalance->opening_balance = $lastday->closing_balance;
        $DayEndBalance->total_sales = $sales_total_payable_amount;
        $DayEndBalance->sales_paid_amount = $sales_paid_amount;
        $DayEndBalance->sales_due_amount = $sales_total_due;
        $DayEndBalance->cash_in = $sales_paid_amount + $all_customer_payments;
        $DayEndBalance->total_purchase = $purchase_total_payable_amount;
        $DayEndBalance->total_sales = $sales_total_payable_amount;
        $DayEndBalance->purchase_paid_amount = $purchase_paid_amount;
        $DayEndBalance->purchase_due_amount = $purchase_total_due;
        $DayEndBalance->total_expense = $total_expense;
        $DayEndBalance->cash_out = $purchase_total_payable_amount + $total_expense + $all_supplier_payments;
        $DayEndBalance->closing_balance = $opening_balance + $DayEndBalance->cash_in - $DayEndBalance->cash_out;
        $DayEndBalance->save();

        $dayend = DayEndBalance::where('date', $date)->exists();

        $data = array(
            'balance' => $balance,
            'opening_balance' => $opening_balance,
            'sales_total_payable_amount' => $sales_total_payable_amount,
            'sales_paid_amount' => $sales_paid_amount,
            'sales_total_due' => $sales_total_due,
            'sales_gross_profit' => $sales_gross_profit,
            'total_expense' => $total_expense,
            'purchase_total_payable_amount' => $purchase_total_payable_amount,
            'purchase_total_due' => $purchase_total_due,
            'purchase_paid_amount' => $purchase_paid_amount,
            'all_supplier_payments' => $all_supplier_payments,
            'all_customer_payments' => $all_customer_payments,
            'dayend' => $dayend,
            'date' => $date,
        );
        return response()->json($data);
    }
}
