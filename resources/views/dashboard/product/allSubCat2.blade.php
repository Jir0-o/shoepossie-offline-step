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
              <h3 class="page-title">All Sub Category Two</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Product Categories </a></li>
                  <li class="breadcrumb-item active" aria-current="page"> All Sub Category Two </li>
                </ol>
              </nav>
            </div>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="card-description btn btn-info"><a class="text-light" href="{{ route('backoffice.subCat2')}}">Add Sub Category Two</a></div>
                    <h4 class="card-title text-center">Sub Category Two Table</h4>
                    <div class="table-responsive">
                      <table id="example" class="table table-striped table-bordered">
                
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Sub Category One Name</th>
                            <th>Sample Image</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        
                        </thead>
                        <tbody>
                            @foreach($SubCategoryTwo as $values)
                              <tr>
                                <td>{{$values->sc_two_name}}</td>
                                <td>{{$values->sc_one_name}}</td>
                                <td>
                                    <img height="100px" width="100px" src="{{ asset('backend/images/'.$values->sc_two_image) }}">
                                </td>
                                
                                @if($values->is_active==1)
                                <td>Active</td>
                                @else
                                <td>Not Active</td>
                                @endif
                                
                                <td><a class="btn btn-warning"  href="{{ route('backoffice.edit-subCat2',Crypt::encryptString($values->sc_two_id))}}">Edit</a></td>

                              </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                          <tr>
                            <th>Name</th>
                            <th>Sub Category One Name</th>
                            <th>Sample Image</th>
                            <th>Status</th>
                            <th>Action</th>
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