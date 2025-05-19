
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

        {{-- Modal For Add Salary  Type Start --}}
        <div class="modal fade" id="salary-info-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Salary Info</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('backoffice.salary-info-add')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Employee Name</label>
                                    <select class="form-control" name="back_office_login_id" required id="exampleFormControlSelect1">
                                      <option disabled selected value="">----Select Employee Name---</option>
                                      @foreach ($getBackOfficeEmployee as $getBackOfficeEmployees)
                                      <option  value="{{$getBackOfficeEmployees->login_id}}">{{ $getBackOfficeEmployees->full_name}}-Employee ID ({{ $getBackOfficeEmployees->office_user_id}})</option>
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
                                      <option  value="{{$getsalaryTypes->salary_type_id}}">{{ $getsalaryTypes->salary_type_name}}</option>
                                      @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Salary Amount</label>
                                    <input type="number" min="0" required class="form-control" value="0" name="salary_amount" id="exampleFormControlInput1" placeholder="Salary Amount">
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Due</label>
                                    <input type="number" min="0" required class="form-control" value="0" name="due" id="exampleFormControlInput1" placeholder="Due">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Paid</label>
                                    <input type="number" min="0" required class="form-control" value="0" name="paid" id="exampleFormControlInput1" placeholder="paid">
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Status</label>
                                    <select class="form-control" name="is_active" required id="exampleFormControlSelect1">
                                      <option value="">Select Salary Type</option>
                                      <option selected value="1">Active</option>
                                      <option value="0">Deactive</option>
                                    </select>
                                </div>
                            </div>
                          </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                          </div>
                      </form>
                </div>

              </div>
            </div>
          </div>
        {{-- Modal For Add Salary  Type End --}}
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
                            <div class="text-end mt-3 mr-4">
                                <button data-toggle="modal" data-target="#salary-info-modal" class="btn btn-outline-primary btn-sm">Add Salary Info</button>
                             </div>
                            <div class="card-body">
                                <h4 class="card-title text-center">Salary Information</h4>
                                <div>
                                    <table id="example" class="table table-bordered">

                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Employee Id</th>
                                                <th>Salary Type</th>
                                                <th class="text-end">Salary Amount</th>
                                                <th class="text-end">Due</th>
                                                <th class="text-end">Paid</th>
                                                <th class="text-center">Status</th>
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($getSalaryInfo as $getSalaryInfos)
                                            <tr>
                                                <td >{{$loop->index+1}}</td>
                                                <td >{{ $getSalaryInfos->full_name }}({{ $getSalaryInfos->office_user_id }})</td>
                                                <td >{{ $getSalaryInfos->salary_type_name }}</td>
                                                <td class="text-end">{{ $getSalaryInfos->salary_amount }}</td>
                                                <td class="text-end">{{ $getSalaryInfos->due }}</td>
                                                <td class="text-end">{{ $getSalaryInfos->paid }}</td>
                                                <td class="text-center">@if ($getSalaryInfos->is_active==1)
                                                    <span class="badge badge-pill badge-success">Active</span>
                                                @else
                                                <span class="badge badge-pill badge-danger">Deactive</span>
                                                @endif</td>
                                                {{-- <td><a href="{{route('backoffice.salary-info-edit',encrypt($getSalaryInfos->salary_info_id))}}" class="btn btn-outline-primary">Edit</a></td> --}}
                                            </tr>

                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>

        @endsection
