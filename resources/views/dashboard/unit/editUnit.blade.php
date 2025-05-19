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
                                <h4 class="p-3 text-center">Edit Unit</h4>
                                <hr
                            </div>
                            <div class="card-body">
                                    
                              <form action="{{ route('backoffice.update-unit') }}" method="post">
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
                                
                                @foreach($Unit as $values)
                                 <input type="hidden" name="id" value="{{$values->unit_id}}">
                                 
                                  <div class="form-group">
                                      <label for="unit_name">Unit Name</label>
                                      <input type="text" class="form-control my-2" name="unit_name" placeholder="Enter Unit Name" value="{{ $values->unit_name }}">
                                      <span class="text-danger">@error('unit_name'){{ $message }} @enderror</span>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label for="unit_symbol">Unit Symbol</label>
                                      <input type="text" class="form-control my-2" name="unit_symbol" placeholder="Enter Unit Symbol" value="{{ $values->unit_symbol }}">
                                      <span class="text-danger">@error('unit_symbol'){{ $message }} @enderror</span>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label for="is_fractional">Is Fractional</label>
                                      <select class="form-control my-2" name="is_fractional">
                                          <option selected="true" disabled="disabled">-----------Select----------</option>
                                          @if($values->is_fractional==1)
                                          <option value="1" selected="selected">Yes</option>
                                          <option value="0">No</option>
                                          @else
                                          <option value="1">Yes</option>
                                          <option value="0" selected="selected">No</option>
                                          @endif
                                      </select>
                                      <span class="text-danger">@error('is_fractional'){{ $message }} @enderror</span>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label for="is_active">Select Status</label>
                                      <select class="form-control my-2" name="is_active">
                                          <option selected="true" disabled="disabled">-----------Select----------</option>
                                          @if($values->is_active==1)
                                          <option value="1" selected="selected">Active</option>
                                          <option value="0">Not Active</option>
                                          @else
                                          <option value="1">Active</option>
                                          <option value="0" selected="selected">Not Active</option>
                                          @endif
                                      </select>
                                      <span class="text-danger">@error('is_active'){{ $message }} @enderror</span>
                                  </div>
                                  
                                  <div class="form-group">
                                      <button type="submit" class="btn btn-warning mt-2">Update</button>
                                      <a class="btn btn-primary mt-2 float-right" class="text-light" href="{{route('backoffice.all-unit')}}">Back</a>
                                  </div>
                                  @endforeach
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