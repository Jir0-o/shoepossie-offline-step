<?php

namespace App\Http\Controllers;

use App\Models\BackofficeLogin;
use App\Models\salaryInfo;
use App\Models\SalaryType;
use Illuminate\Http\Request;

class SalaryInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getSalaryInfo = salaryInfo::join('backoffice_login','salary_infos.back_office_login_id','=','backoffice_login.login_id')
        ->join('salary_types','salary_infos.salary_type_id','=','salary_types.salary_type_id')
        ->select('salary_infos.*','backoffice_login.office_user_id','backoffice_login.full_name','salary_types.salary_type_name')->get();

        $getBackOfficeEmployee = BackofficeLogin::where('is_active',1)->where('role_id',5)->get();
        $getsalaryType = SalaryType::where('is_active',1)->get();
        return view('dashboard.salaryInfo.salaryInfo',compact(['getSalaryInfo','getBackOfficeEmployee','getsalaryType']));
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

        $postSalaryInfo = new salaryInfo;
        $postSalaryInfo->back_office_login_id = $request->back_office_login_id;
        $postSalaryInfo->salary_type_id  = $request->salary_type_id ;
        $postSalaryInfo->salary_amount	 = $request->salary_amount	;
        // $postSalaryInfo->paid = $request->paid;
        // $postSalaryInfo->due =  $request->due;
        $postSalaryInfo->is_active = $request->is_active;
        $postSalaryInfo->save();
        return redirect()->back()->with('success','Salary Info Add Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\salaryInfo  $salaryInfo
     * @return \Illuminate\Http\Response
     */
    public function show(salaryInfo $salaryInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\salaryInfo  $salaryInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(salaryInfo $salaryInfo,$id)
    {
        $getBackOfficeEmployee = BackofficeLogin::where('is_active',1)->get();
        $getsalaryType = SalaryType::where('is_active',1)->get();
        $getSalaryInfo = salaryInfo::find(decrypt($id));
        return view('dashboard.salaryInfo.salaryInfoEdit',compact(['getSalaryInfo','getBackOfficeEmployee','getsalaryType']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\salaryInfo  $salaryInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, salaryInfo $salaryInfo,$id)
    {
        $postSalaryInfo = salaryInfo::find($id);
        $postSalaryInfo->back_office_login_id = $request->back_office_login_id;
        $postSalaryInfo->salary_type_id  = $request->salary_type_id ;
        $postSalaryInfo->salary_amount	 = $request->salary_amount	;
        // $postSalaryInfo->paid = $request->paid;
        // $postSalaryInfo->due =  $request->due;
        $postSalaryInfo->is_active = $request->is_active;
        $postSalaryInfo->save();
        return redirect()->route('backoffice.salary-info')->with('success','Salary Info Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\salaryInfo  $salaryInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(salaryInfo $salaryInfo)
    {
        //
    }
}
