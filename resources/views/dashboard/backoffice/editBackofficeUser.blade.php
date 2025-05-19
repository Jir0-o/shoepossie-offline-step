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
                                <h4 class="p-3 text-center">Backoffice Register</h4>
                                <hr />
                            </div>
                            <div class="card-body">
                                
                          <form action="{{ route('backoffice.update-backoffice-user') }}" method="post" autocomplete="off">
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
                            
                            @foreach($backoffice_users as $backofffice_user)
                            
                              <input type="hidden" name="login_id" value="{{ $backofffice_user->login_id}}">
                              <div class="form-group"> 
                                  <label for="office_user_id">Office User Id</label>
                                  <input type="text" class="form-control my-2" name="office_user_id" placeholder="Enter Office User Id" value="{{ $backofffice_user->office_user_id }}">
                                  <span class="text-danger">@error('office_user_id'){{ $message }} @enderror</span>
                              </div>
                              <div class="form-group">
                                  <label for="name">Full Name</label>
                                  <input type="text" class="form-control my-2" name="name" placeholder="Enter full name" value="{{ $backofffice_user->full_name }}">
                                  <span class="text-danger">@error('name'){{ $message }} @enderror</span>
                              </div>
                              <div class="form-group">
                                  <label for="uname">User Name</label>
                                  <input type="text" class="form-control my-2" name="uname" placeholder="Enter user name" value="{{ $backofffice_user->login_user_name }}">
                                  <span class="text-danger">@error('uname'){{ $message }} @enderror</span>
                              </div>
                              <div class="form-group">
                                  <label for="backoffice_role">Select Your Role</label>
                                  <select class="form-control my-2" name="backoffice_role">
                                      <option selected="true" disabled="disabled">-----------Select----------</option>
                                      @foreach($backoffice_role as $role)
                                      <option  value="{{ $role->role_id }}" {{ $backofffice_user->role_id == $role->role_id ? 'selected' : '' }}>{{ $role->role_name }}</option>
                                      @endforeach
                                  </select>
                                  <span class="text-danger">@error('backoffice_role'){{ $message }} @enderror</span>
                              </div>
                              <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control my-2" name="email" placeholder="Enter email address" value="{{ $backofffice_user->user_email }}">
                                <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                              </div>
                              <div class="form-group">
                                  <label for="password">Password</label>
                                  <input type="password" class="form-control my-2" name="password" placeholder="Enter password">
                                  <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                              </div>
                              <div class="form-group">
                                  <button type="submit" class="btn btn-primary my-2">Register</button>
                                  <a class="btn btn-primary mt-2 float-right" class="text-light" href="{{route('backoffice.all-backoffice-user')}}">Back</a>
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