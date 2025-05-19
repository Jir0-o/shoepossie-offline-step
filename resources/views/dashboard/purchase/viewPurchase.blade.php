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
                  <li class="breadcrumb-item" aria-current="page"> All Purchase </li>
                  <li class="breadcrumb-item active" aria-current="page"> View Purchase </li>
                </ol>
              </nav>
            </div>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                   <div class="card-header"><a class="btn btn-primary" href="{{ route('backoffice.all-purchase')}}">All Purchase</a></div>
                   <div class="card-body">
                    @foreach($Product as $value)
                    <div class="py-4 text-center">
                        Purchase Details
                    </div>
                    <div class="row border py-3">
                        <div class="col-md-2">
                            <b>Product Name</b>
                        </div>
                        <div class="col-md-6">
                            {{$value->product_name}}
                        </div>
                    </div>
                    <div class="row border py-3">
                        <div class="col-md-2">
                            <b>Product Description</b>
                        </div>
                        <div class="col-md-6">
                            {{$value->product_description}}
                        </div>
                    </div>
                    <div class="row border py-3">
                        <div class="col-md-2">
                            <b>Product In Stock:</b>
                        </div>
                        <div class="col-md-6">
                            {{$value->quantity}}
                        </div>
                    </div>
                    <div class="row border py-3">
                        <div class="col-md-2">
                            <b>Purchase Price:</b>
                        </div>
                        <div class="col-md-6">
                            {{$value->purchase_price}}
                        </div>
                    </div>
                    <div class="row border py-3">
                        <div class="col-md-2">
                            <b>Sales Price:</b>
                        </div>
                        <div class="col-md-6">
                            {{$value->sales_price}}
                        </div>
                    </div>
                    <div class="row border py-3">
                        <div class="col-md-2">
                            <b>Discount:</b>
                        </div>
                        <div class="col-md-6">
                            {{$value->discount}}
                        </div>
                    </div>
                    <div class="row border py-3">
                        <div class="col-md-2">
                            <b>Point Benifit:</b>
                        </div>
                        <div class="col-md-6">
                            {{$value->point_benefit}}
                        </div>
                    </div>
                    <div class="row border py-3">
                        <div class="col-md-2">
                            <b>Cash Benifit:</b>
                        </div>
                        <div class="col-md-6">
                            {{$value->cash_benefit}}
                        </div>
                    </div>
                    <div class="row border py-3">
                        <div class="col-md-2">
                            <b>Product Images:</b>
                        </div>
                        <div class="col-md-6">
                            {{$value->product_image}}
                        </div>
                    </div>
                    @endforeach
                    <div class="row border py-3">
                        <div class="col-12 col-md-12">
                            <a href="{{ url()->previous() }}" class="btn btn-primary float-right">Back</a>
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