@extends('layouts.layout')

@php
    $user_data = \App\Models\BannerInformation::first();
@endphp

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
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Company</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> Profile </li>
                            </ol>
                        </nav>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="login_id" value="" />
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

                                <div class="row border p-5 text-capitalize">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-6 py-2">
                                                <span class="text-info">Company Name :</span> {{$user_data->banner_name}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 py-2">
                                                <span class="text-info">Contact No :</span> {{$user_data->banner_mobile}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 py-2">
                                                <span class="text-info">Address :</span> {{$user_data->banner_address}}
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <img alt="" src="{{ $user_data->banner_logo}}" height="150px"
                                            width="150px" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- main-panel ends -->
                </div>
                <!-- page-body-wrapper ends -->
            </div>

        </div>
    </div>
@endsection
