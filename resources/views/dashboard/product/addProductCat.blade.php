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
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-md-2" style="margin-top: 45px; ">
                        <div class="card">
                            <div class="card-title">
                                <h4 class="p-3 text-center">Add Product Category</h4><hr
                            </div>
                            <div class="card-body">
                                    
                              <form action="{{ route('backoffice.create-cat') }}" method="post" autocomplete="off" enctype="multipart/form-data">
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
            
                                @csrf
                                  <div class="form-group">
                                      <label for="name">Category Name</label>
                                      <input type="text" class="form-control my-2" name="cat_name" placeholder="Enter Category Namee" value="{{ old('cat_name') }}">
                                      <span class="text-danger">@error('cat_name'){{ $message }} @enderror</span>
                                  </div>
                                  <div class="form-group">
                                      <label for="sample_image">Sample Image</label>
                                      <input type="file" class="form-control my-2" name="sample_image" placeholder="Enter Sample Image">
                                      <span class="text-danger">@error('sample_image'){{ $message }} @enderror</span>
                                  </div>
                                  <div class="form-group">
                                      <label for="status">Select Status</label>
                                      <select class="form-control my-2" name="status">
                                          <option selected="true" disabled="disabled">-----------Select----------</option>
                                          <option value="1">Active</option>
                                          <option value="0">Not Active</option>
                                      </select>
                                      <span class="text-danger">@error('status'){{ $message }} @enderror</span>
                                  </div>
                                  
                                  <div class="form-group">
                                      <a class="btn btn-primary mt-2" class="text-light" href="{{route('backoffice.all-product-cat')}}">Back</a>
                                      <button type="submit" class="btn btn-primary my-2 float-right">Submit</button>
                                  </div>
                                  <br>
                              </form>     
                            </div>
                          
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