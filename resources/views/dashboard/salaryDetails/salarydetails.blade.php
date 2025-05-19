
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
        <div class="modal fade" id="salary-details-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Salary Details</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('backoffice.salary-details-add')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Employee Name </label>
                                    <select class="form-control" name="salary_info_id" required id="salary_info_id">
                                      <option disabled selected value="">----Select Employee Name---</option>
                                      @foreach ($getSalaryInfo as $getSalaryInfos)
                                      <option  value="{{$getSalaryInfos->salary_info_id}}">{{ $getSalaryInfos->full_name}}-Employee ID ({{ $getSalaryInfos->office_user_id}})</option>
                                      @endforeach
                                    </select>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Pay Date</label>
                                    <input type="date"  required class="form-control"  name="pay_date" id="pay_date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Salary Amount</label>
                                    <input type="number"  required class="form-control"  name="salary_amount" id="salary_amount" placeholder="Salary Amount">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Extra Allowence</label>
                                    <input type="number" value="0" required class="form-control"  name="extra_allowence_amount" id="extra_allowence_amount" placeholder="Extra Allowence">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Paid Amount</label>
                                    <input type="number"  required class="form-control"  name="paid_amount" id="paid_amount" placeholder="Paid Amount">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Paid For Month</label>
                                    <input type="text"  required class="form-control"  name="paid_for_month" id="paid_for_month" placeholder="Paid For Month">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Description</label>
                                    <textarea type="text"  required class="form-control"  name="description" id="description" placeholder="Description"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">For Due Adjustment</label>
                                    <input type="checkbox" id="vehicle3" name="due_adjust_ment" value="due">
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
                    <h3 class="page-title">Salary Details</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Salary Details</a></li>
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
                                <button data-toggle="modal" data-target="#salary-details-modal" class="btn btn-outline-primary btn-sm">Add Salary Details</button>
                             </div>
                            <div class="card-body">
                                <h4 class="card-title text-center">Salary Details</h4>
                                <div>
                                    <table id="example" class="table table-bordered">

                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Employee Name</th>
                                                <th>Pay Date</th>
                                                <th class="text-end">Salary Amount</th>
                                                <th class="text-end">Extra Allowence</th>
                                                <th class="text-end">Paid Amount</th>
                                                <th >Paid For Month</th>
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($getSalesDetails as $getSalesDetail)
                                            <tr>
                                                <td >{{$loop->index+1}}</td>
                                                <td >{{ $getSalesDetail->full_name }}({{ $getSalesDetail->office_user_id }})</td>
                                                <td >{{ $getSalesDetail->pay_date }}</td>
                                                <td class="text-end">{{ $getSalesDetail->salary_amount }}</td>
                                                <td class="text-end">{{ $getSalesDetail->extra_allowence_amount }}</td>
                                                <td class="text-end">{{ $getSalesDetail->paid_amount }}</td>
                                                <td>{{ $getSalesDetail->paid_for_month }}</td>
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
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script>
            $(document).ready(function () {
                $('#salary_info_id').change(function (e) {
                    e.preventDefault();
                    const getSalaryINfoID = $(this).val();
                    // console.log(getSalaryINfoID);
                    $.ajax({
                        url: "salary-info-amount/"+getSalaryINfoID,
                        method: "GET",
                        dataType: "json",
                        success: function (response) {
                            if(response.status==200){

                                // console.log(response.getSalaryINfo);
                                $('#salary_amount').empty();
                                $('#extra_allowence_amount').empty();
                                $('#paid_amount').empty();
                                $('#salary_amount').val(response.getSalaryINfo.salary_amount);
                                var getSalaryAMount = $('#salary_amount').val();
                                var GetextraAllowance = $('#extra_allowence_amount').val();
                                var totalAmount = parseInt(getSalaryAMount)+parseInt(GetextraAllowance);
                                $('#paid_amount').val(totalAmount);
                            }
                        }
                    });
                });
                $(document).on('change','#salary_amount', function () {
                    $('#salary_amount').empty();
                    $('#extra_allowence_amount').empty();
                    $('#paid_amount').empty();
                    var getSalaryAMount = $('#salary_amount').val();
                    var GetextraAllowance = $('#extra_allowence_amount').val();
                    var totalAmount = parseInt(getSalaryAMount)+parseInt(GetextraAllowance);
                    $('#paid_amount').val(totalAmount);
                });

                $(document).on('change','#extra_allowence_amount', function () {
                    $('#salary_amount').empty();
                    $('#extra_allowence_amount').empty();
                    $('#paid_amount').empty();
                    var getSalaryAMount = $('#salary_amount').val();
                    var GetextraAllowance = $('#extra_allowence_amount').val();
                    var totalAmount = parseInt(getSalaryAMount)+parseInt(GetextraAllowance);
                    $('#paid_amount').val(totalAmount);
                });

            });
        </script>
        @endsection
