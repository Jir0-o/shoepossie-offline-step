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
              <h3 class="page-title">Delivery</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Delivery</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Delivery Requests </li>
                </ol>
              </nav>
            </div>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title text-center">Orders List</h4>
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
                    <div class="table-responsive">
                      <table id="example" class="table table-striped table-bordered" width="100%">
                
                        <thead>
                          <tr>
                            
                            <th> Agency </th>
                            <th> Agent</th>
                            <th>Details</th>
                            <th>Cart Status</th>
                          </tr>
                        
                        </thead>
                        <tbody>

                            @foreach($Cartinformation as $info)
                              <tr>
                                  <form action="{{ route('backoffice.accept-cart',$info->cart_id)}}" method="post">
                                      @csrf
                                      
                                        <input type="hidden" value="{{$info->cart_id}}" name="cart_id" />
                                        
                                        <td>
                                            @if($info->delivery_status_id == 4)
                                                @if($role_name=='Office Staff' || $role_name=='Administrator' || $role_name=='Super Administrator')
                                                <select class="form-control border border-dark" id="delivery_agency_id" name="delivery_agency_id" required="required">
                                                    <option value="">-- Select Agency --</option>
                                                    @foreach($DeliveryAgency as $Agency)
                                                    <option value="{{$Agency->delivery_agency_id}}">{{$Agency->delivery_agency_name}}</option>
                                                    @endforeach
                                                </select>
                                                @endif
                                            @endif
                                           
                                            @if($info->delivery_status_id >= 5)
                                            
                                                @foreach($CartDelivery as $delivery)
                                                
                                                     @if($info->cart_id == $delivery->cart_id)
                                                        @foreach($DeliveryAgency as $Agency)
                                                            @if($Agency->delivery_agency_id == $delivery->delivery_agency_id)
                                                             <div>{{$Agency->delivery_agency_name}}</div>
                                                            @endif
                                                         @endforeach
                                                     @endif
                                                     
                                                @endforeach
                                            
                                            @elseif($info->delivery_status_id == 4)
                                                 <div></div>
                                            @else
                                                 <div>Agency Is Not Selected Yet</div> 
                                            @endif
                                        </td>
                                        <td>
                                            @if($info->delivery_status_id == 4)
                                                 @if($role_name=='Office Staff' || $role_name=='Administrator' || $role_name=='Super Administrator')
                                                <select class="form-control border border-dark" id="delivery_agent_id" name="delivery_agent_id">
                                                    <option value="">-- Select Agent --</option>
                                                    @foreach($DeliveryAgent as $Agent)
                                                    <option value="{{$Agent->delivery_agent_id}}">{{$Agent->delivery_agent_name}}</option>
                                                    @endforeach
                                                </select>
                                                @endif
                                            @endif
                                            @if($info->delivery_status_id >= 5)
                                             
                                                @foreach($CartDelivery as $delivery)
                                                
                                                     @if($info->cart_id == $delivery->cart_id)
                                                        @foreach($DeliveryAgent as $Agent)
                                                            @if($Agent->delivery_agency_id == $delivery->delivery_agency_id)
                                                             <div>{{$Agent->delivery_agent_name}}</div>
                                                            @endif
                                                         @endforeach
                                                     @endif
                                                     
                                                @endforeach
                                             
                                            @elseif($info->delivery_status_id == 4)
                                            <div></div>
                                            @else
                                              <div>Agent Is Not Selected Yet</div> 
                                            @endif
                                        </td>
                                        
                                        <td>
                                            <a href="{{ route('backoffice.orderDetails',$info->cart_id)}}" class="btn btn-primary">view Order Details</a>
                                        </td>
                                      
                                         <td>
                                            @if($info->delivery_status_id<=2)
                                            
                                               @if($role_name=='Office Staff' || $role_name=='Administrator' || $role_name=='Super Administrator')
                                                
                                                   <button type="submit" class="btn btn-primary">Accept</button>
                                                @else
                                                
                                                    @foreach($DeliveryStatus as $Status)
                                                        @if($Status->delivery_status_id == $info->delivery_status_id)
                                                        <div class="text-danger">{{$Status->delivery_status}}</div>
                                                        @endif
                                                    @endforeach
                                                
                                               @endif
                                                
                                            @elseif($info->delivery_status_id==3) 
                                                
                                                @if($role_name=='Warehouse Incharge')
                                                    <button type="submit" class="btn btn-primary">Accept</button>
                                                @else
                                                
                                                    @foreach($DeliveryStatus as $Status)
                                                        @if($Status->delivery_status_id == $info->delivery_status_id)
                                                        <div class="text-danger">{{$Status->delivery_status}}</div>
                                                        @endif
                                                    @endforeach
                                                
                                                @endif
                                                
                                            @elseif($info->delivery_status_id==4) 
                                                @if($role_name=='Office Staff' || $role_name=='Administrator' || $role_name=='Super Administrator')
                                                
                                                     <button type="submit" class="btn btn-primary">Accept</button>
                                                @else
                                                
                                                    @foreach($DeliveryStatus as $Status)
                                                        @if($Status->delivery_status_id == $info->delivery_status_id)
                                                        <div class="text-danger">{{$Status->delivery_status}}</div>
                                                        @endif
                                                    @endforeach
                                                
                                                @endif
                                            @elseif($info->delivery_status_id==5) 
                                                @if($role_name=='Delivery Agency')
                                                
                                                    <button type="submit" class="btn btn-primary">Parcel Handover to Agent</button>
                                                @else
                                                
                                                    @foreach($DeliveryStatus as $Status)
                                                        @if($Status->delivery_status_id == $info->delivery_status_id)
                                                        <div class="text-danger">{{$Status->delivery_status}}</div>
                                                        @endif
                                                    @endforeach
                                                
                                                @endif
                                            @elseif($info->delivery_status_id==6) 
                                                @if($role_name=='Delivery Agent')
                                                
                                                    <button type="submit" class="btn btn-primary">Payment Collected</button>
                                                @else
                                                
                                                    @foreach($DeliveryStatus as $Status)
                                                        @if($Status->delivery_status_id == $info->delivery_status_id)
                                                        <div class="text-danger">{{$Status->delivery_status}}</div>
                                                        @endif
                                                    @endforeach
                                                
                                                @endif  
                                            @elseif($info->delivery_status_id==7) 
                                            
                                                @if($role_name=='Office Staff' || $role_name=='Administrator' || $role_name=='Super Administrator')
                                                
                                                    <button type="submit" class="btn btn-primary">Payment Collected Form Agency</button>
                                                @else
                                                
                                                    @foreach($DeliveryStatus as $Status)
                                                        @if($Status->delivery_status_id == $info->delivery_status_id)
                                                        <div class="text-danger">{{$Status->delivery_status}}</div>
                                                        @endif
                                                    @endforeach
                                                
                                                @endif
                                            @elseif($info->delivery_status_id==8)
                                            
                                                @foreach($DeliveryStatus as $Status)
                                                    @if($Status->delivery_status_id == $info->delivery_status_id)
                                                    <div class="text-danger">{{$Status->delivery_status}}</div>
                                                    @endif
                                                @endforeach
                                                
                                            @endif
                                        </td>
                                     
                                  </form>
                                
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
   </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Order Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal-body">
        <table class="table table-striped">
                       <thead>
                          <tr>
                            <th>Cart Id</th>
                            <th>product Name </th>
                          </tr>
                        </thead>
                        <tbody id="details">
                              <tr>
                                  
                              </tr>
                        </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    
@endsection