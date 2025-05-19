
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
                    <h3 class="page-title">Foot Ware Caregory</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Foot Ware Category</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Home </li>
                        </ol>
                    </nav>
                </div>
                @if (session()->has('success'))
                <div class="alert alert-info" role="alert">
                    <strong>{{session()->get('success')}}</strong>
                  </div>
                @endif
                @if (session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    <strong>{{session()->get('error')}}</strong>
                  </div>
                @endif
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-title">
                                <h4 class="p-3 text-center">Edit Foot Ware Category</h4>
                                <hr>
                            </div>
                            <div class="card-body">

                              <form action="{{route('backoffice.footWareCategory-update',$findFootWareCategory->foot_ware_categories_id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                 <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Foot Ware Category Name:</label>
                                        <div class="col-sm-9">
                                          <input type="text" class="form-control my-2" name="foot_ware_categories_name" placeholder="Foot Ware Category Name" value="{{$findFootWareCategory->foot_ware_categories_name}}" required="">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">Code:</label>
                                          <div class="col-sm-9">
                                            <input type="number" min="0" class="form-control my-2" name="foot_ware_categories_code" placeholder="Code" value="{{$findFootWareCategory->foot_ware_categories_code}}" required="">
                                          </div>
                                        </div>
                                      </div>
                                    <div class="col-md-6">
                                      <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Status</label>
                                        <div class="col-sm-9">
                                          <select required="" class="form-control mt-2" name="foot_ware_categories_is_active">
                                            <option value="" selected="true" disabled="disabled">-----------Select----------</option>
                                            @if ($findFootWareCategory->foot_ware_categories_is_active==1)
                                            <option selected="" value="1">Active</option>
                                            <option  value="0">Deactive</option>
                                            @else
                                            <option  value="1">Active</option>
                                            <option selected="" value="0">Deactive</option>
                                            @endif

                                        </select>
                                        </div>
                                      </div>
                                    </div>

                                  </div>

                                  <div class="form-group ">
                                    <a class="btn btn-primary mt-2 float-right" href="{{route('backoffice.footWareCategory')}}">Back</a>
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
