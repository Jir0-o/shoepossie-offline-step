
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
        <div class="modal fade" id="modal_sizes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Sizes</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('backoffice.sizes-add')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <label for="exampleFormControlInput1">Sizes</label>
                          <input type="text" required class="form-control" name="size_name" id="exampleFormControlInput1" placeholder="Sizes">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Code</label>
                            <input type="number" min="0" required class="form-control" name="size_code" id="exampleFormControlInput1" placeholder="Code">
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
                    <h3 class="page-title">Sizes</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Sizes</a></li>
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
                                <button data-toggle="modal" data-target="#modal_sizes" class="btn btn-outline-primary btn-sm">Add Sizes</button>
                             </div>
                            <div class="card-body">
                                <h4 class="card-title text-center">Sizes</h4>
                                <div>
                                    <table id="example" class="table table-bordered">

                                        <thead>
                                            <tr>

                                                <th>SL</th>
                                                <th>Sizes</th>
                                                <th>Code</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sizes as $size)
                                            <tr>
                                                <td >{{$loop->index+1}}</td>
                                                <td >{{ $size->size_name }}</td>
                                                <td >{{ $size->size_code }}</td>
                                                <td >@if ($size->size_is_active==1)
                                                    <span class="badge badge-pill badge-success">Active</span>
                                                @else
                                                <span class="badge badge-pill badge-danger">Deactive</span>
                                                @endif</td>
                                                <td><a href="{{route('backoffice.sizes-edit',encrypt($size->size_id))}}" class="btn btn-outline-primary">Edit</a></td>
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
