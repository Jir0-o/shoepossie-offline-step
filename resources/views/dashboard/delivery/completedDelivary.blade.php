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
                            
                            <th>Agency </th>
                            <th>Agent</th>
                            <th>Details</th>
                            <th>Cart Status</th>
                          </tr>
                        
                        </thead>
                        <tbody>

                            @foreach($Cartinformation as $info)
                              @if($info)
                              <tr>
                                  <form action="#" method="post">
                                      @csrf
                                      
                                        <input type="hidden" value="{{$info->cart_id}}" name="cart_id" />
                                        
                                        @foreach($cartDelivery as $agency)                                         
                                        <td>

                                            <div>{{$agency->delivery_agency_name}}</div>
                                        </td>
                                        <td>
                                            <div>{{$agency->delivery_agent_name}}</div>
                                        </td>
                                        @endforeach
                                        
                                        <td>
                                            <a href="{{ route('backoffice.orderDetails',$info->cart_id)}}" class="btn btn-primary">view Order Details</a>
                                        </td>
                                      
                                         <td>
                                             
                                            <div class="text-success"> Delivery Completted </div>
                                            
                                        </td>
                                     
                                  </form>
                                
                              </tr>
                              @endif
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

    
@endsection