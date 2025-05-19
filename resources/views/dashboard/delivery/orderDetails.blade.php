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
                                    <h4 class="card-title text-center">Order Details</h4>
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
                                    <div class="row">
                                        <div class="col-md-4">
                                            @foreach ($Consumer_details as $values)
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="2">
                                                                Consumer Details
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                Name:
                                                            </td>
                                                            <td>
                                                                {{ $values->consumer_name }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                Address:
                                                            </td>
                                                            <td>
                                                                {{ $values->address }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                Mobile No:
                                                            </td>
                                                            <td>
                                                                {{ $values->mobile_no }}
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            @endforeach
                                        </div>
                                        <div class="col-md-4">
                                            @foreach ($CartInfo as $info)
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="2">
                                                                Consumer Details
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                Consumer Id:
                                                            </td>
                                                            <td>
                                                                {{ $info->consumer_id }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                Order No:
                                                            </td>
                                                            <td>
                                                                #{{ sprintf('%09d', $info->cart_id) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                Order Date:
                                                            </td>
                                                            <td>
                                                                {{ $info->cart_date }}
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            @endforeach
                                        </div>
                                        <div class="col-md-4">
                                            @foreach ($CartInfo as $values)
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="2">
                                                                Delivery Details
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                {{ $values->delivery_address }}
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            @endforeach
                                        </div>

                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12">

                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th>Item Details</th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <tr>
                                                        <td>
                                                            Item Code
                                                        </td>
                                                        <td>
                                                            Item Name
                                                        </td>
                                                        <td>
                                                            Size
                                                        </td>
                                                        <td>
                                                            Color
                                                        </td>
                                                        <td>
                                                            Qty
                                                        </td>
                                                        <td>
                                                            Unit Price
                                                        </td>
                                                        <td>
                                                            Total Price
                                                        </td>
                                                    </tr>
                                                    @foreach ($CartItem as $items)
                                                        <tr>
                                                            <td>
                                                                {{ $items->product_id }}
                                                            </td>
                                                            <td>
                                                                {{ $items->product_name }}
                                                            </td>
                                                            <td>
                                                                @foreach ($size_definition as $size)
                                                                    @if ($size->size_id == $items->size_id)
                                                                        {{ $size->size_name }}
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                @foreach ($color_definition as $color)
                                                                    @if ($color->color_id == $items->color_id)
                                                                        {{ $color->color_name }}
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                {{ $items->quantity }}
                                                            </td>
                                                            <td>
                                                                {{ $items->sales_price }}
                                                            </td>
                                                            <td>
                                                                {{ $items->total_price }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    @foreach ($CartInfo as $info)
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>Total Discount</td>
                                                            <td>- {{ $info->total_discount }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td class="text-info">Subtotal</td>
                                                            <td>{{ $info->total_cart_amount }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>Total Vat</td>
                                                            <td>+ {{ $info->vat_amount }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>Total Delevery Charge</td>
                                                            <td>+ {{ $info->delivery_charge }}</td>
                                                        </tr>
                                                        <tr class="bg-info text-light">
                                                            <td>


                                                            </td>
                                                            <td>
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>Final Total</td>
                                                            <td>{{ $info->total_payable_amount }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div>
                                                <a href="{{ URL::previous() }}"
                                                    class="float-right btn btn-warning mt-2">Back</a>
                                            </div>

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
