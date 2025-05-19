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
              <h3 class="page-title">Running Orders</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Orders</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Running Orders </li>
                </ol>
              </nav>
            </div>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title text-center">Running Order List</h4>
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
                            <th>Order Details</th>
                            <th>Cart Status</th>
                          </tr>
                        
                        </thead>
                        <tbody>

                            @foreach($Cartinformation as $info)
                              <tr>
                                  <form action="#" method="post">
                                      @csrf
                                      
                                        <input type="hidden" value="{{$info->cart_id}}" name="cart_id" />
                                        
                                        
                                        <td>
                                            <a href="{{ route('backoffice.orderDetails',$info->cart_id)}}" class="btn btn-primary">view Order Details</a>
                                        </td>
                                      
                                        <td>
                                            @if($info->delivery_status_id<=2)
                                                
                                                    @foreach($DeliveryStatus as $Status)
                                                        @if($Status->delivery_status_id == $info->delivery_status_id)
                                                        <div class="text-danger">{{$Status->delivery_status}}</div>
                                                        @endif
                                                    @endforeach
                                                
                                                
                                            @elseif($info->delivery_status_id==3) 
                                                
                                                    @foreach($DeliveryStatus as $Status)
                                                        @if($Status->delivery_status_id == $info->delivery_status_id)
                                                        <div class="text-danger">{{$Status->delivery_status}}</div>
                                                        @endif
                                                    @endforeach
                                                
                                                
                                            @elseif($info->delivery_status_id==4) 
                                                
                                                    @foreach($DeliveryStatus as $Status)
                                                        @if($Status->delivery_status_id == $info->delivery_status_id)
                                                        <div class="text-danger">{{$Status->delivery_status}}</div>
                                                        @endif
                                                    @endforeach
                                                
                                            @elseif($info->delivery_status_id==5) 
                                                
                                                    @foreach($DeliveryStatus as $Status)
                                                        @if($Status->delivery_status_id == $info->delivery_status_id)
                                                        <div class="text-danger">{{$Status->delivery_status}}</div>
                                                        @endif
                                                    @endforeach
                                                
                                            @elseif($info->delivery_status_id==6) 
                                                
                                                    @foreach($DeliveryStatus as $Status)
                                                        @if($Status->delivery_status_id == $info->delivery_status_id)
                                                        <div class="text-danger">{{$Status->delivery_status}}</div>
                                                        @endif
                                                    @endforeach
                                                
                                            @elseif($info->delivery_status_id==7) 
                                                
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
                    <div class="row float-right">
                          <div class="p-5 col-md-12">
                                <a href="{{ URL::previous() }}" class="btn btn-primary"> Back </a>
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
   </div>
</div>

    
@endsection