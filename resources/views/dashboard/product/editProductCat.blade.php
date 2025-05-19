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
                                <h4 class="p-3 text-center">Edit Product Category</h4><hr
                            </div>
                            <div class="card-body">
                                    
                              <form action="{{ route('backoffice.update-category') }}" method="post" autocomplete="off" enctype="multipart/form-data">
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
                                @foreach($Productcat as $Category)
                                
                                  <input type="hidden" name="id" value="{{$Category->category_id}}">
                                  <div class="form-group">
                                      <label for="name">Category Name</label>
                                      <input type="text" class="form-control my-2" name="cat_name" placeholder="Enter Category Namee" value="{{ $Category->category_name }}">
                                      <span class="text-danger">@error('cat_name'){{ $message }} @enderror</span>
                                  </div>
                                  <div class="form-group">
                                      <label for="sample_image">Sample Image</label>
                                      <input type="file" class="form-control my-2" name="sample_image" placeholder="Enter Sample Image" value="{{ $Category->sample_image }}">
                                      <span class="text-danger">@error('sample_image'){{ $message }} @enderror</span>
                                  </div>
                                  <div class="form-group">
                                      <label for="status">Select Status</label>
                                      <select class="form-control my-2" name="status">
                                          <option selected="true" disabled="disabled">-----------Select----------</option>
                                          @if($Category->is_active==1)
                                          <option value="1" selected="selected">Active</option>
                                          <option value="0">Not Active</option>
                                          @else
                                          <option value="1">Active</option>
                                          <option value="0" selected="selected">Not Active</option>
                                          @endif
                                      </select>
                                      <span class="text-danger">@error('status'){{ $message }} @enderror</span>
                                  </div>
                                  
                                  <div class="form-group">
                                      <a class="btn btn-primary mt-2" class="text-light" href="{{route('backoffice.all-product-cat')}}">Back</a>
                                      <button type="submit" class="btn btn-warning my-2 float-right">Update</button>
                                  </div>
                                  <br>
                                  @endforeach
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