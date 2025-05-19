
@extends('layouts.layout')

@section('content')
<div class="container-scroller">
    @include('dashboard.pertials.sideNav')
    <div class="container-fluid page-body-wrapper">
        <div id="theme-settings" class="settings-panel">
            <i class="settings-close mdi mdi-close"></i>
            <p class="settings-heading">SIDEBAR SKINS</p>
            <div class="sidebar-bg-options selected" id="sidebar-default-theme">
                <div class="img-ss rounded-circle bg-light border mr-3"></div> Default
            </div>
            <div class="sidebar-bg-options" id="sidebar-dark-theme">
                <div class="img-ss rounded-circle bg-dark border mr-3"></div> Dark
            </div>
            <p class="settings-heading mt-2">HEADER SKINS</p>
            <div class="color-tiles mx-0 px-4">
                <div class="tiles light"></div>
                <div class="tiles dark"></div>
            </div>
        </div>


        @include('dashboard.pertials.topNav')
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title">Salary Info</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Salary Info</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Home </li>
                        </ol>
                    </nav>
                </div>
                @if (session()->has('success'))
                <div class="alert alert-info" role="alert">
                    <strong>{{session()->get('success')}}</strong>
                  </div>
                @endif
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-title">
                                <h4 class="p-3 text-center">Edit  Salary Info</h4>
                                <hr>
                            </div>
                            <div class="card-body">

                              <form action="{{route('backoffice.salary-info-update',$getSalaryInfo->salary_info_id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Employee Name</label>
                                            <select class="form-control" name="back_office_login_id" required id="exampleFormControlSelect1">
                                              <option disabled selected value="">----Select Employee Name---</option>
                                              @foreach ($getBackOfficeEmployee as $getBackOfficeEmployees)
                                              <option  @if ($getSalaryInfo->back_office_login_id==$getBackOfficeEmployees->login_id)
                                                selected
                                              @endif value="{{$getBackOfficeEmployees->login_id}}">{{ $getBackOfficeEmployees->full_name}}-Employee ID ({{ $getBackOfficeEmployees->office_user_id}})</option>
                                              @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Salary Type</label>
                                            <select class="form-control" name="salary_type_id" required id="exampleFormControlSelect1">
                                              <option disabled selected value="">----Select Salary Type---</option>
                                              @foreach ($getsalaryType as $getsalaryTypes)
                                              <option @if ($getSalaryInfo->salary_type_id == $getsalaryTypes->salary_type_id)
                                                selected
                                              @endif value="{{$getsalaryTypes->salary_type_id}}">{{ $getsalaryTypes->salary_type_name}}</option>
                                              @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Salary Amount</label>
                                            <input type="number" value="{{$getSalaryInfo->salary_amount}}" min="0" required class="form-control" value="0" name="salary_amount" id="exampleFormControlInput1" placeholder="Salary Amount">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Due</label>
                                            <input type="number" value="{{$getSalaryInfo->due}}" min="0" required class="form-control" value="0" name="due" id="exampleFormControlInput1" placeholder="Due">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Paid</label>
                                            <input type="number" value="{{$getSalaryInfo->paid}}" min="0" required class="form-control" value="0" name="paid" id="exampleFormControlInput1" placeholder="paid">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Status</label>
                                            <select class="form-control" name="is_active" required id="exampleFormControlSelect1">
                                              <option value="">Select Salary Type</option>
                                              <option @if ($getSalaryInfo->is_active==1)
                                                selected
                                              @endif  value="1">Active</option>
                                              <option @if ($getSalaryInfo->is_active==0)
                                                selected
                                              @endif value="0">Deactive</option>
                                            </select>
                                        </div>
                                    </div>
                                  </div>
                                  <div class="form-group ">
                                    <a class="btn btn-primary mt-2 float-right" href="{{route('backoffice.salary-info')}}">Back</a>
                                    <button type="submit" class="btn btn-primary mt-2">Submit</button>
                                  </div>

                                  <br>
                              </form>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>

        @endsection
