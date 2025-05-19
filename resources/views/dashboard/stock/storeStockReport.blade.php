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
                    <h3 class="page-title">Stock</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Stock</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> Stock Report </li>
                        </ol>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-description btn btn-info"><a class="text-light" href="{{ route('backoffice.stock-transfer')}}">Stock Transfer</a></div>
                                <h4 class="card-title text-center">Stock Report</h4>
                                @if (Session::get('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                                @endif
                                @if (Session::get('fail'))
                                <div class="alert alert-danger">
                                    {{ Session::get('fail') }}
                                </div>
                                @endif
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered">

                                        <thead>
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Store Name</th>
                                                <th>Unit </th>
                                                <th>Stock </th>

                                            </tr>

                                        </thead>
                                        <tbody>
                                            @foreach($store_stock_report as $values)
                                            <tr>
                                                <td>{{$values->product_material_name }}</td>
                                                <td>{{$values->store_name }}</td>
                                                <td>{{$values->unit_symbol }}</td>
                                                <td>{{$values->final_quantity === null ? 0 : $values->final_quantity}}</td>


                                                <!-- <td><a class="btn btn-warning" class="text-light" href="{{ route('backoffice.edit-supplier',Crypt::encryptString($values->supplier_id))}}">Edit</a></td> -->

                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                                <th>Product Name</th>
                                                <th>Store Name</th>
                                                <th>Unit </th>
                                                <th>Stock </th>

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
