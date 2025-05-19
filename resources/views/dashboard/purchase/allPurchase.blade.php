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
              <h3 class="page-title">All Purchase</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Product</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> All Purchase </li>
                </ol>
              </nav>
            </div>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="card-description btn btn-info"><a class="text-light" href="{{ route('backoffice.purchase')}}">Purchase Product</a></div>
                    <h4 class="card-title text-center">Purchase List</h4>
                    <div class="table-responsive">
                      <table id="example" class="table table-striped table-bordered" width="100%">
                
                        <thead>
                          <tr>
                            <th>Product Name</th>
                            <th>Supply No</th>
                            <th>Supplier Id</th>
                            <th>Purchase Price</th>
                            <th>Sales Price</th>
                            <th>Quantity</th>
                            <th>Barcode</th>
                            <th>Product</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        
                        </thead>
                        <tbody>
                            @foreach($PurchaseDetail as $values)
                              <tr>
                                <td>{{$values->product_name}}</td>
                                <td>{{$values->supply_no}}</td>
                                <td>{{$values->supplier_id}}</td>
                                <td>{{$values->purchase_price}}</td>
                                <td>{{$values->sales_price}}</td>
                                <td>{{$values->temp_quantity}}</td>
                                <td>
                                    @if ($values->barcode == null)
                                        <a class="btn" class="text-light"
                                            href="{{ route('backoffice.create-barcode', Crypt::encryptString($values->product_id)) }}"><i
                                                class="fa fa-barcode"></i></a>
                                    @else
                                        <a target="_blank" class="brn"
                                            href="{{ route('backoffice.print-barcode', Crypt::encryptString($values->product_id)) }}"><img
                                                style="margin-left:10px;"
                                                src="{{ asset('backend/printer.webp') }}"
                                                alt="print"></a>
                                    @endif
                                </td>
                                <td><a href="{{ route('backoffice.view-purchase',Crypt::encryptString($values->product_id))}}" class="btn btn-primary">view</a></td>
                                @if($values->is_verified==1)
                                <td>Verified</td>
                                @else
                                <td>Not Verified</td>
                                @endif
                                
                                <td><a class="btn btn-warning" class="text-light" href="{{ route('backoffice.edit-product',Crypt::encryptString($values->product_id))}}">Edit</a></td>

                              </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                          <tr>
                            <th>Product Name</th>
                            <th>Supply No</th>
                            <th>Supplier Id</th>
                            <th>Purchase Price</th>
                            <th>Sales Price</th>
                            <th>Quantity</th>
                            <th>Barcode</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                        
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


    
@endsection