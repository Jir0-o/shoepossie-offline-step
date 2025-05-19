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
              <h3 class="page-title">Return</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Return</a></li>
                  <li class="breadcrumb-item active" aria-current="page">All Return </li>
                </ol>
              </nav>
            </div>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title text-center">Return List</h4>
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
                            <th> Consumer Mobile No </th>
                            <th> Return Date </th>
                            <th> Authorize Date </th>
                            <th> Return Status </th>
                            <th> View Details </th>
                            <th>Invoice</th>
                          </tr>

                        </thead>
                        <tbody>

                            @foreach($CartItemReturn as $info)
                              <tr>
                                      <td>{{$info->mobile_no}}</td>
                                      <td>{{$info->return_date}}</td>
                                      <td>
                                          @if($info->authorize_date)
                                            {{$info->authorize_date}}
                                         @else
                                            Not Authorized
                                         @endif
                                      </td>
                                      <td>
                                         @if($info->return_status>1)
                                           @if($info->return_status==2)
                                                Returning To WareHouse
                                           @elseif($info->return_status==3)
                                                Rejected
                                           @elseif($info->return_status==4)
                                                Returned To Warehouse
                                           @endif
                                         @else
                                            Not Authorized
                                         @endif
                                      </td>
                                      <td>
                                          <a href="{{ route('backoffice.view-return',Crypt::encryptString($info->cart_item_return_id)) }}" class="btn btn-primary">View</a>
                                      </td>
                                      <td><a target="_blank" class="brn" href="{{ route('backoffice.return-invoice', Crypt::encryptString($info->cart_item_return_id)) }}"><img src="{{ asset('backend/printer.webp') }}" alt="print"></a>


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

@endsection
