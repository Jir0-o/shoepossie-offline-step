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
                            <li class="breadcrumb-item"><a href="#">Reports</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> All Purchase </li>
                        </ol>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-center">ALl Purchase</h4>
                                <div style="overflow-x:scroll;">
                                    <table id="example" class="table table-bordered">

                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Action</th>
                                                <th>Product</th>
                                                <th>Category</th>
                                                <th>Type</th>
                                                <th>Material</th>
                                                <th>Brand</th>
                                                <th>Color</th>
                                                <th>Size</th>
                                                <th>Batch</th>
                                                <th>Purchase Price</th>
                                                <th>WholeSell Price</th>
                                                <th>Sales Price</th> 
                                                <th>Discount</th>
                                                <th>Qty</th>
                                                <th>Vat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($getDailyPurchase as $getDailyPurchase)
                                                <tr>
                                                    <td>{{$loop->index+1}}</td>
                                                    <td><a href="{{route('backoffice.dailyPurchaseBarcode',encrypt($getDailyPurchase->purchase_details_id))}}" target="_blank" rel="noopener noreferrer"><img src="{{asset('/backend/printer.webp')}}" alt=""></a></td>
                                                    <td>{{$getDailyPurchase->product_material_name}}</td>
                                                    <td>{{$getDailyPurchase->foot_ware_categories_name}}</td>
                                                    <td>{{$getDailyPurchase->type_name}}</td>
                                                    <td>{{$getDailyPurchase->material_type_name}}</td>
                                                    <td>{{$getDailyPurchase->brand_type_name}}</td>
                                                    <td>{{$getDailyPurchase->colors_name}}</td>
                                                    <td>{{$getDailyPurchase->size_name}}</td>
                                                    <td>{{$getDailyPurchase->batch}}</td>
                                                    <td class="text-end">{{$getDailyPurchase->purchase_price}}</td>
                                                    <td class="text-end">{{$getDailyPurchase->wholesale_price}}</td>
                                                    <td class="text-end">{{$getDailyPurchase->sales_price}}</td>
                                                    <td class="text-end">{{$getDailyPurchase->discount}}</td>
                                                    <td>{{$getDailyPurchase->quantity}}</td>
                                                    <td>{{$getDailyPurchase->vat}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                              <td>Total:</td>
                                              <td colspan="10" class="text-end font-weight-bold">{{$getPurchaseTotal}}</td>
                                              <td class="text-end font-weight-bold">{{$getWholeSellPrice}}</td>
                                              <td class="text-end font-weight-bold">{{$getSalesTotal}}</td>
                                              <td class="text-end font-weight-bold">{{$totalDiscount}}</td>
                                              <td class="font-weight-bold">{{$totalQty}}</td>
                                              <td class="font-weight-bold">{{$totalVat}}</td>
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
