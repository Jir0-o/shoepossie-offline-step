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
                        <h3 class="page-title">All Customers</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Consumer</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> All Customers </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <!--<div class="card-description btn btn-info"><a class="text-light" href="{{ route('backoffice.register') }}">Add Backoffice User</a></div>-->
                                    <h4 class="card-title text-center">Customer Table</h4>
                                    <div>
                                        <table id="example" class="table table-striped table-bordered">

                                            <thead>
                                                <tr>
                                                    <th>Mobile No</th>
                                                    <th>Completed Orders</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($consumerLogin as $user)
                                                    <tr>
                                                        <td>{{ $user->mobile_no }}</td>

                                                        <td>
                                                            <a class="btn btn-outline-dark"
                                                                href="{{ route('backoffice.consumer-completed-delivery', Crypt::encryptString($user->login_id)) }}">
                                                                <i class="fa-solid fa-list-check"></i>
                                                            </a>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Mobile No</th>
                                                    <th>Completed Orders</th>
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
