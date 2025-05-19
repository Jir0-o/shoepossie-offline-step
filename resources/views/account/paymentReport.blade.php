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
            <h3 class="page-title">All Payment Report</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Reports</a></li>
                <li class="breadcrumb-item active" aria-current="page"> All Payment Report </li>
                </ol>
            </nav>
            </div>
            <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                <div class="card-body">
                    <div class="card-description row">
                        <div class="col-md-5">
                            <!-- <a class="btn btn-outline-info" href="{{ route('backoffice.supplier-payment')}}"><i class="fa fa-credit-card mr-1" aria-hidden="true"></i>Supplier Payment</a>
                            <a class="btn btn-outline-success" href="{{ route('backoffice.customer-payment')}}"><i class="fa fa-credit-card mr-1" aria-hidden="true"></i>Customer Payment</a> -->
                        </div>
                        <div class="col-md-7">
                            <div class="input-group mb-3">
                                {{-- <select type="text" class="form-control" id="type" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                    <option selected disabled>-----Select-----</option>
                                    <option value="1">Supplier Payment</option>
                                    <option value="2">Customer Payment</option>
                                    <option value="3">Expenses</option>
                                    <option value="4">Transactions</option>
                                </select> --}}
                                <input type="date" class="form-control" id="date" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary text-light btn" id="inputGroup-sizing-default">Generate</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" width="100%">
                
                        <thead>
                        <tr>
                            <th>TRX ID</th>
                            <th>Date</th>
                            <th>Trx Type</th>
                            <th>Trx Mode</th>
                            <th>Amount</th>
                        </tr>
                        
                        </thead>
                        <tbody>
                            @foreach ($bank_transactions as $item)
                                <tr>
                                    <td>{{$item->bank_transaction_id}}</td>
                                    <td>{{$item->date}}</td>
                                    <td>{{$item->trx_type}}</td>
                                    <td>{{$item->trx_mode}}</td>
                                    <td>{{$item->amount}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </tfoot>
                        
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