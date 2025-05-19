<?php

namespace App\Http\Controllers;

use App\Models\SalaryType;
use Illuminate\Http\Request;

class SalaryTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salaryTypes = SalaryType::all();
      return view('dashboard.salaryType.salary',compact(['salaryTypes']));
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
        $storSalaryType = new SalaryType;
        $storSalaryType->salary_type_name = $request->salary_type_name;
        $storSalaryType->is_active = $request->is_active;
        $storSalaryType->save();
        return redirect()->back()->with('success','Salary Type Add Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SalaryType  $salaryType
     * @return \Illuminate\Http\Response
     */
    public function show(SalaryType $salaryType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SalaryType  $salaryType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $getId =  decrypt($id);
        $findsalaryType = SalaryType::where('salary_type_id',$getId)->first();
        return view('dashboard.salaryType.salaryTypeEdit',compact(['findsalaryType']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SalaryType  $salaryType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalaryType $salaryType,$id)
    {
        $storSalaryType = SalaryType::where('salary_type_id',$id)->first();
        $storSalaryType->salary_type_name = $request->salary_type_name;
        $storSalaryType->is_active = $request->is_active;
        $storSalaryType->save();
        return redirect()->route('backoffice.salary-type')->with('success','Salary Type Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SalaryType  $salaryType
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalaryType $salaryType)
    {
        //
    }
}
