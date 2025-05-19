<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseCategoryController extends Controller
{
    public function expense_category_list()
    {
        $all_expense_category_datas = ExpenseCategory::all();
        return view('Expense Category.expenseCategoryList', ['all_expense_category_datas' => $all_expense_category_datas]);
    }
    public function add_expense_category()
    {

        return view('Expense Category.addExpenseCategory');
    }

    public function insert_expense_category(Request $request)
    {
        //Validate Inputs
        $request->validate([
            'expense_category_name' => 'required',
            'is_default' => 'required',
            'is_active' => 'required',
        ]);

        $insert_datas = new ExpenseCategory;

        $insert_datas->expense_category_name = $request->expense_category_name;
        $insert_datas->is_default = $request->is_default;
        $insert_datas->is_active = $request->is_active;
        $save =   $insert_datas->save();
        if ($save) {
            return redirect()->route('backoffice.expense_category_list')->with('success', 'Expense Category Add SuccessFully');
        } else {
            return redirect()->back()->with('fail', 'Something went wrong, Please Try Again');
        }
    }

    public function edit_expense_category($id)
    {

        $getdata = ExpenseCategory::find($id);

        return view('Expense Category.editExpenseCategory', ['getdatas' => $getdata]);
    }

    public function update_expense_category(Request $request, $id)
    {
        //Validate Inputs
        $request->validate([
            'expense_category_name' => 'required',
            'is_default' => 'required',
            'is_active' => 'required',
        ]);


        $update_data = ExpenseCategory::find($id);
        $update_data->expense_category_name =  $request->expense_category_name;
        $update_data->is_default =  $request->is_default;
        $update_data->is_active =  $request->is_active;
        $save =  $update_data->save();
        if ($save) {
            return redirect()->route('backoffice.expense_category_list')->with('update', 'Expense Category Update SuccessFully');
        } else {
            return redirect()->back()->with('updatefail', 'Something went wrong, Please Try Again');
        }
    }
}
