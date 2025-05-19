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
                    <div class="col-md-10 offset-md-1" style="margin-top: 45px; ">
                        <div class="card">
                            <div class="card-title">
                                <h4 class="p-3 text-center">Settings</h4>
                                <hr>
                            </div>
                            <div class="card-body">
                                    
                            <form action="{{ route('backoffice.update-settings',$Banner->id) }}" method="post" enctype="multipart/form-data">
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
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <label for="banner_name">Banner Name</label>
                                        <input type="text" class="form-control my-2" name="banner_name" placeholder="Banner Name" value="{{ $Banner->banner_name }}">
                                        <span class="text-danger">@error('banner_name'){{ $message }} @enderror</span>
                                        </div>
                                    </div>
                                    {{-- banner Code --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <label for="banner_code">Banner Code</label>
                                        <input type="text" class="form-control my-2" name="banner_code" placeholder="Banner Code" value="{{ $Banner->banner_code }}">
                                        <span class="text-danger">@error('banner_code'){{ $message }} @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <label for="banner_url">Banner Url</label>
                                        <input type="text" class="form-control my-2" name="banner_url" placeholder="Banner Url" value="{{ $Banner->banner_url }}">
                                        <span class="text-danger">@error('banner_url'){{ $message }} @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <label for="banner_mobile">Mobile No</label>
                                        <input type="text" class="form-control my-2" name="banner_mobile" placeholder="Banner Mobile No" value="{{ $Banner->banner_mobile }}">
                                        <span class="text-danger">@error('banner_mobile'){{ $message }} @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <label for="banner_email">Banner Email</label>
                                        <input type="text" class="form-control my-2" name="banner_email" placeholder="Banner Email" value="{{ $Banner->banner_email }}">
                                        <span class="text-danger">@error('banner_email'){{ $message }} @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <label for="banner_logo">Banner Logo</label>
                                        <input 
                                            type="file" 
                                            class="form-control my-2" 
                                            name="banner_logo" 
                                            value="{{ old('banner_logo') }}"
                                        >
                                        <span class="text-danger">@error('banner_logo'){{ $message }} @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <label>Banner Address</label>
                                        <input type="text" class="form-control my-2" name="banner_address" value="{{ $Banner->banner_address }}"/>
                                        <span class="text-danger">@error('banner_address'){{ $message }} @enderror</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-warning mt-2 float-right">Update</button>
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