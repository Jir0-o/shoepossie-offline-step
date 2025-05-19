
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
        <div class="modal fade" id="modal_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('backoffice.productMaterial-add')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Product Name</label>
                                    <input type="text" required class="form-control" name="product_material_name" id="exampleFormControlInput1" placeholder="Product Name">
                                  </div>
                              </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Foot Ware Category</label>
                                    <select required="" class="form-control mt-2" name="foot_ware_categories_id">
                                        <option value="" selected="true" disabled="disabled">-----------Select----------</option>
                                        @foreach ($footWareCategorys as $footWareCategory)
                                        <option value="{{$footWareCategory->foot_ware_categories_id}}">{{$footWareCategory->foot_ware_categories_name}}</option>
                                        @endforeach
                                    </select>
                                  </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Type</label>
                                    <select required="" class="form-control mt-2" name="type_id">
                                        <option value="" selected="true" disabled="disabled">-----------Select----------</option>
                                        @foreach ($types as $type)
                                        <option value="{{$type->type_id}}">{{$type->type_name}}</option>
                                        @endforeach
                                    </select>
                                  </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Material Type</label>
                                    <select required="" class="form-control mt-2" name="material_type_id">
                                        <option value="" selected="true" disabled="disabled">-----------Select----------</option>
                                        @foreach ($materials as $material)
                                        <option value="{{$material->material_type_id}}">{{$material->material_type_name}}</option>
                                        @endforeach
                                    </select>
                                  </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Brand</label>
                                    <select required="" class="form-control mt-2" name="brand_type_id">
                                        <option value="" selected="true" disabled="disabled">-----------Select----------</option>
                                        @foreach ($brands as $brand)
                                        <option value="{{$brand->brand_type_id}}">{{$brand->brand_type_name}}</option>
                                        @endforeach
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
                            <div class="text-end mt-3 mr-4">
                                <button data-toggle="modal" data-target="#modal_product" class="btn btn-outline-primary btn-sm">Add Product</button>
                             </div>
                            <div class="card-body">
                                <h4 class="card-title text-center">Product</h4>
                                <div>
                                    <table id="example" class="table table-bordered">

                                        <thead>
                                            <tr>

                                                <th>SL</th>
                                                <th>Product Name</th>
                                                <th>Foot Ware Category</th>
                                                <th>Type</th>
                                                <th>Material</th>
                                                <th>Brand</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($productMaterials as $productMaterial)
                                            <tr>
                                                <td >{{$loop->index+1}}</td>
                                                <td >{{ $productMaterial->product_material_name }}</td>
                                                <td >{{ $productMaterial->foot_ware_categories_name }}</td>
                                                <td >{{ $productMaterial->type_name }}</td>
                                                <td >{{ $productMaterial->material_type_name }}</td>
                                                <td >{{ $productMaterial->brand_type_name }}</td>
                                                <td><a href="{{route('backoffice.productMaterial-edit',encrypt($productMaterial->product_material_id))}}" class="btn btn-outline-primary">Edit</a></td>
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
