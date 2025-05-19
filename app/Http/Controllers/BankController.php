<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\BankTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BankController extends Controller
{
    public function ajaxGetBalance($bank_id)
    {
        $all_bank_datas = Bank::where('bank_id', $bank_id)->first();
        return response()->json($all_bank_datas->balance);
    }

    public function bank_list()
    {
        $all_bank_datas = Bank::all();
        return view('bank.bankList', ['all_bank_datas' => $all_bank_datas]);
    }

    public function add_bank() 
    {
        return view('bank.addBank');
    }
    public function ajaxAllBank()
    {
        $all_banks = Bank::all();
        return response()->json($all_banks);
    }
    public function TrxReport()
    {
        $bankTrx = BankTransaction::join('banks', 'banks.bank_id', '=', 'bank_transactions.bank_id')->get();

        return view('bank.trxReport', compact(['bankTrx']));
    }
    public function ajaxAllTransactions()
    {
        $all_bt = BankTransaction::leftJoin('banks', 'banks.bank_id', '=', 'bank_transactions.bank_id')
            ->where('bank_transactions.date', date("Y-m-d"))
            ->select('bank_transactions.*', 'banks.bank_name')
            ->orderBy('bank_transactions.bank_transaction_id', 'desc')
            ->get();
        return response()->json($all_bt);
    }

    public function ajaxGenerateReport(Request $request)
    {
        $query = BankTransaction::join('banks', 'banks.bank_id', '=', 'bank_transactions.bank_id')
            ->select('bank_transactions.*', 'banks.bank_name');
    
        if ($request->bank_id) {
            $query->where('bank_transactions.bank_id', $request->bank_id);
        }
    
        if ($request->trx_type) {
            $query->where('bank_transactions.trx_type', $request->trx_type);
        }
    
        if ($request->trx_mode) {
            $query->where('bank_transactions.trx_mode', $request->trx_mode);
        }
    
        if ($request->cheque_no) {
            $query->where('bank_transactions.cheque_no', 'LIKE', '%' . $request->cheque_no . '%');
        }
    
        if ($request->from_date && $request->to_date) {
            $query->whereBetween('bank_transactions.date', [$request->from_date, $request->to_date]);
        } elseif ($request->from_date) {
            $query->where('bank_transactions.date', '>=', $request->from_date);
        } elseif ($request->to_date) {
            $query->where('bank_transactions.date', '<=', $request->to_date);
        }
    
        $result = $query->get();
    
        return response()->json($result);
    }
    
    public function ajaxStoreDWData(Request $request)
    {
        $validateUser = Validator::make(
            $request->all(),
            [
                'bank_id' => 'required',
                'trx_type' => 'required',
                'trx_mode' => 'required',
                'amount' => 'required',
            ]
        );

        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ]);
        }

        $Bank = Bank::where('bank_id', $request->bank_id)->first();
        if ($request->trx_type == 2) {
            if ($request->amount > $Bank->balance) {
                return response()->json([
                    'status' => false,
                    'message' => 'Amount Exceeds Current Bank Balance'
                ]);
            }
        }

        if ($request->cheque_no) {
            $exists = BankTransaction::where('cheque_no', $request->cheque_no)->exists();
            if ($exists) {
                return response()->json([
                    'status' => false,
                    'message' => 'This Checque No is Not Valid'
                ]);
            }
        }

        if ($request->transaction_no) {
            $trx_exists = BankTransaction::where('transaction_no', $request->transaction_no)->exists();
            if ($trx_exists) {
                return response()->json([
                    'status' => false,
                    'message' => 'This Transaction No is Not Valid'
                ]);
            }
        }

        $BankTransaction = new BankTransaction();
        $BankTransaction->bank_id = $request->bank_id;
        $BankTransaction->date = date('Y-m-d');
        $BankTransaction->trx_type = $request->trx_type;
        $BankTransaction->trx_mode = $request->trx_mode;
        $BankTransaction->prev_balance = $Bank->balance;
        $BankTransaction->amount = $request->amount;
        if ($request->trx_type == 1) {
            $BankTransaction->current_balance = $BankTransaction->prev_balance + $BankTransaction->amount;
        } else if ($request->trx_type == 2) {
            $BankTransaction->current_balance = $BankTransaction->prev_balance - $BankTransaction->amount;
        }
        if ($request->bank_name) {
            $BankTransaction->bank_name = $request->bank_name;
        }
        if ($request->cheque_no) {
            $BankTransaction->cheque_no = $request->cheque_no;
        }
        if ($request->transaction_no) {
            $BankTransaction->transaction_no = $request->transaction_no;
        }
        $BankTransaction->save();

        $Bank->balance = $BankTransaction->current_balance;
        $Bank->save();

        $trx = BankTransaction::orderBy('bank_transaction_id', 'desc')->get();
        return response()->json($trx);
    }

    public function insert_bank(Request $request)
    {
        //Validate Inputs

        $request->validate([
            'bank_name' => 'required',
            'is_active' => 'required',
        ]);


        $insert_datas = new Bank;
        $insert_datas->bank_name = $request->bank_name;
        $insert_datas->is_active = $request->is_active;
        $save =  $insert_datas->save();
        if ($save) {
            return redirect()->back()->with('success', $insert_datas->bank_name . ' Bank Add SuccessFully');
        } else {
            return redirect()->back()->with('fail', 'Something went wrong, Please Try Again');
        }
    }

    public function edit_bank($id)
    {

        $getdata = Bank::find($id);

        return view('bank.editBank', ['getdatas' => $getdata]);
    }

    public function update_bank(Request $request, $id)
    {
        //Validate Inputs

        $request->validate([
            'bank_name' => 'required',
            'is_active' => 'required',
        ]);


        $update_data = Bank::find($id);
        $update_data->bank_name =  $request->bank_name;
        $update_data->is_active =  $request->is_active;
        $save =  $update_data->save();
        if ($save) {
            return view('bank.bankActions');
        } else {
            return redirect()->back()->with('updatefail', 'Something went wrong, Please Try Again');
        }
    }
}
