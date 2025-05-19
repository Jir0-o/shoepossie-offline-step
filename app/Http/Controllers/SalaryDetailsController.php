<?php

namespace App\Http\Controllers;

use App\Models\BackofficeLogin;
use App\Models\SalaryDetails;
use App\Models\salaryInfo;
use Illuminate\Http\Request;

class SalaryDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getSalesDetails = SalaryDetails::join('salary_infos','salary_details.salary_info_id','=','salary_infos.salary_info_id')
        ->join('backoffice_login','salary_infos.back_office_login_id','=','backoffice_login.login_id')
        ->select('salary_details.*','backoffice_login.office_user_id','backoffice_login.full_name')->get();
        $getSalaryInfo = salaryInfo::join('backoffice_login','salary_infos.back_office_login_id','=','backoffice_login.login_id')
        ->select('salary_infos.*','backoffice_login.office_user_id','backoffice_login.full_name')->get();
        return view('dashboard.salaryDetails.salarydetails',compact(['getSalesDetails','getSalaryInfo']));

    }

    public function getSalaryInfoAmount($id){
        $getSalaryINfo = salaryInfo::find($id);
        return response()->json([
            'status'=>200,
            'getSalaryINfo'=>$getSalaryINfo
        ]);
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

        $postSalaryDetails = new SalaryDetails;
        $postSalaryDetails->salary_info_id = $request->salary_info_id;
        $postSalaryDetails->pay_date = $request->pay_date;
        $postSalaryDetails->salary_amount = $request->salary_amount;
        $postSalaryDetails->extra_allowence_amount = $request->extra_allowence_amount;
        $postSalaryDetails->paid_for_month = $request->paid_for_month;
        $postSalaryDetails->description = $request->description;
        $postSalaryDetails->paid_amount = $request->extra_allowence_amount+$request->salary_amount;

        $getSalaryInfo = salaryInfo::find($request->salary_info_id);

        if($getSalaryInfo->salary_amount!=$request->salary_amount && $request->due_adjust_ment =='due'){
            $AdjustDue = $getSalaryInfo->due-$request->salary_amount;
            $getSalaryInfo->due = $AdjustDue;
            $getSalaryInfo->paid =$getSalaryInfo->paid+$request->salary_amount;
        }
        elseif($getSalaryInfo->salary_amount!=$request->salary_amount){

            $getAMount = $getSalaryInfo->salary_amount-$request->salary_amount;
            $getSalaryInfo->due = $getAMount;
            $getSalaryInfo->paid =$getSalaryInfo->paid+$request->salary_amount;

            // if( $request->due_adjust_ment =='due'){
            //     $AdjustDue = $getSalaryInfo->due-$request->salary_amount;
            //     $getSalaryInfo->due = $AdjustDue;
            // }
        }

        else{
               $getSalaryInfo->paid =$getSalaryInfo->paid+$request->salary_amount;
        }
        $getSalaryInfo->save();
        $postSalaryDetails->save();
        return redirect()->back()->with('success','Salary Details Add Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SalaryDetails  $salaryDetails
     * @return \Illuminate\Http\Response
     */
    public function show(SalaryDetails $salaryDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SalaryDetails  $salaryDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(SalaryDetails $salaryDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SalaryDetails  $salaryDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalaryDetails $salaryDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SalaryDetails  $salaryDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalaryDetails $salaryDetails)
    {
        //
    }
}
