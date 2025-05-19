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
                                <h4 class="p-3 text-center">Add Delivery Charge</h4>
                                <hr
                            </div>
                            <div class="card-body">
                                    
                              <form action="{{ route('backoffice.create-charge') }}" method="post">
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
                                      <label for="deliver_charge_name">Delivery Charge Name</label>
                                      <input type="text" class="form-control my-2" name="deliver_charge_name" placeholder="Enter Delivary Charge Name" value="{{ old('deliver_charge_name') }}">
                                      <span class="text-danger">@error('deliver_charge_name'){{ $message }} @enderror</span>
                                  </div>
                                 <div class="form-group">
                                      <label for="agency_id">Agency Name</label>
                                      <select class="form-control my-2" name="agency_id">
                                          <option selected="true" disabled="disabled">-----------Select----------</option>
                                          @foreach($DeliveryAgency as $Agency)
                                          <option value="{{ $Agency->delivery_agency_id}}">{{ $Agency->delivery_agency_name}}</option>
                                          @endforeach
                                      </select>
                                      <span class="text-danger">@error('agency_id'){{ $message }} @enderror</span>
                                  </div>
                                  <div class="form-group">
                                      <label for="package_description">Package Description</label>
                                      <textarea  type="text" class="form-control my-2" name="package_description" 
                                                  placeholder="Enter Package Description" value="{{ old('package_description') }}" rows="4" cols="50"></textarea>
                                      <span class="text-danger">@error('package_description'){{ $message }} @enderror</span>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label for="source">Source</label>
                                      <input type="text" class="form-control my-2" name="source" placeholder="Enter Source" value="{{ old('source') }}">
                                      <span class="text-danger">@error('source'){{ $message }} @enderror</span>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label for="expected_delivery_days">Expected Delivery Days</label>
                                      <input type="text" class="form-control my-2" name="expected_delivery_days" placeholder="Enter Expected Delivery Days" value="{{ old('expected_delivery_days') }}">
                                      <span class="text-danger">@error('expected_delivery_days'){{ $message }} @enderror</span>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label for="delivery_charge">Delivery Charge</label>
                                      <input type="text" class="form-control my-2" name="delivery_charge" placeholder="Enter Delivery Charge " value="{{ old('delivery_charge') }}">
                                      <span class="text-danger">@error('delivery_charge'){{ $message }} @enderror</span>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label for="destination">Description</label>
                                      <textarea  type="text" class="form-control my-2" name="destination" 
                                                  placeholder="Enter Description" value="{{ old('destination') }}" rows="4" cols="50"></textarea>
                                      <span class="text-danger">@error('destination'){{ $message }} @enderror</span>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label for="is_active">Select Status</label>
                                      <select class="form-control my-2" name="is_active">
                                          <option selected="true" disabled="disabled">-----------Select----------</option>
                                          <option value="1">Active</option>
                                          <option value="0">Not Active</option>
                                      </select>
                                      <span class="text-danger">@error('is_active'){{ $message }} @enderror</span>
                                  </div>
                                  
                                  <div class="form-group">
                                      <button type="submit" class="btn btn-primary mt-2">Submit</button>
                                      <a class="btn btn-primary mt-2 float-right" class="text-light" href="{{route('backoffice.all-charge')}}">Back</a>
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