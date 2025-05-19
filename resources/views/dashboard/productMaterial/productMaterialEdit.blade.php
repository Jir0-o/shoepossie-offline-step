
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
                    <h3 class="page-title">Product</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Product</a></li>
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
                                <h4 class="p-3 text-center">Edit Product</h4>
                                <hr>
                            </div>
                            <div class="card-body">

                              <form action="{{route('backoffice.productMaterial-update',$getProductMaterial->product_material_id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                 <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Product Name:</label>
                                        <div class="col-sm-9">
                                          <input type="text" class="form-control my-2" name="product_material_name" placeholder="Product Name" value="{{$getProductMaterial->product_material_name}}" required="">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">Foot Ware Category:</label>
                                          <div class="col-sm-9">
                                            <select required="" class="form-control mt-2" name="foot_ware_categories_id">
                                                <option value="" selected="true" disabled="disabled">-----------Select----------</option>
                                                @foreach ($footWareCategorys as $footWareCategory)
                                                <option @if ($footWareCategory->foot_ware_categories_id==$getProductMaterial->foot_ware_categories_id)
                                                    selected
                                                @endif value="{{$footWareCategory->foot_ware_categories_id}}">{{$footWareCategory->foot_ware_categories_name}}</option>
                                                @endforeach
                                            </select>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">Type:</label>
                                          <div class="col-sm-9">
                                            <select required="" class="form-control mt-2" name="type_id">
                                                <option value="" selected="true" disabled="disabled">-----------Select----------</option>
                                                @foreach ($types as $type)
                                                <option @if ($type->type_id==$getProductMaterial->type_id)
                                                    selected
                                                @endif  value="{{$type->type_id}}">{{$type->type_name}}</option>
                                                @endforeach
                                            </select>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">Material:</label>
                                          <div class="col-sm-9">
                                            <select required="" class="form-control mt-2" name="material_type_id">
                                                <option value="" selected="true" disabled="disabled">-----------Select----------</option>
                                                @foreach ($materials as $material)
                                                <option @if ($material->material_type_id==$getProductMaterial->material_type_id)
                                                    selected
                                                @endif value="{{$material->material_type_id}}">{{$material->material_type_name}}</option>
                                                @endforeach
                                            </select>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">Brand:</label>
                                          <div class="col-sm-9">
                                            <select required="" class="form-control mt-2" name="brand_type_id">
                                                <option value="" selected="true" disabled="disabled">-----------Select----------</option>
                                                @foreach ($brands as $brand)
                                                <option @if ($brand->brand_type_id==$getProductMaterial->brand_type_id)
                                                    selected
                                                @endif value="{{$brand->brand_type_id}}">{{$brand->brand_type_name}}</option>
                                                @endforeach
                                            </select>
                                          </div>
                                        </div>
                                    </div>


                                  </div>

                                  <div class="form-group ">
                                    <a class="btn btn-primary mt-2 float-right" href="{{route('backoffice.productMaterial')}}">Back</a>
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
