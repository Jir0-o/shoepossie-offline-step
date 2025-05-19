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
                                <h4 class="p-3 text-center">Edit Delivery Agent</h4>
                                <hr
                            </div>
                            <div class="card-body">
                                    
                              <form action="{{ route('backoffice.update-agent') }}" method="post">
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
                                @foreach($DeliveryAgent as $Agent)
                                  <input name="id" value="{{$Agent->delivery_agent_id}}" type="hidden">
                                  <div class="form-group">
                                      <label for="delivery_agent_name">Agent Name</label>
                                      <input type="text" class="form-control my-2" name="delivery_agent_name" placeholder="Enter Delivary Agent Name" value="{{ $Agent->delivery_agent_name }}">
                                      <span class="text-danger">@error('delivery_agent_name'){{ $message }} @enderror</span>
                                  </div>
                                 <div class="form-group">
                                      <label for="delivery_agency_id">Agency Name</label>
                                      <select class="form-control my-2" name="delivery_agency_id">
                                          <option selected="true" disabled="disabled">-----------Select----------</option>
                                          @foreach($DeliveryAgency as $Agency)
                                          <option value="{{ $Agency->delivery_agency_id}}" {{ $Agent->delivery_agency_id == $Agency->delivery_agency_id ? 'selected' : '' }}>{{ $Agency->delivery_agency_name}}</option>
                                          @endforeach
                                      </select>
                                      <span class="text-danger">@error('delivery_agency_id'){{ $message }} @enderror</span>
                                  </div>
                                  <div class="form-group">
                                      <label for="agent_contact_no">Agent Contact No</label>
                                      <input type="text" class="form-control my-2" name="agent_contact_no" placeholder="Enter Delivary Agent Contact No" value="{{ $Agent->agent_contact_no }}">
                                      <span class="text-danger">@error('agent_contact_no'){{ $message }} @enderror</span>
                                  </div>
                                  <div class="form-group">
                                      <label for="is_active">Select Status</label>
                                      <select class="form-control my-2" name="is_active">
                                          <option selected="true" disabled="disabled">-----------Select----------</option>
                                          @if($Agent->is_active==1)
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
                                      <a class="btn btn-primary mt-2 float-right" class="text-light" href="{{route('backoffice.all-agent')}}">Back</a>
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