@php
$user_id = session()->get('LoggedUser');
$user_data = \App\Models\BackofficeLogin::join('backoffice_role', 'backoffice_role.role_id', '=', 'backoffice_login.role_id')
->where('login_id', $user_id)
->first();
$banner_Information= \App\Models\BannerInformation::first();
@endphp
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
                            @if ($user_data->role_id==4)

                            @else
                            <div>
                                <div class="card-description w-25 float-right">
                                    <div class="input-group mb-3">
                                        <select aria-label="Default" aria-describedby="inputGroup-sizing-default" class="form-control" name="category_id" id="category_id">
                                            <option selected disabled>-------Select-------</option>
                                            @foreach($Supplier as $sup)
                                            <option value="{{$sup->supplier_id}}">{{$sup->supplier_name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-light" id="inputGroup-sizing-default">Supplier</span>
                                        </div>
                                    </div>
                                    <button id="GetRowValue" class="btn btn-outline-primary btn-sm">To Vat</button>
                                </div>
                            </div>
                            @endif


                            <div class="card-body">
                                <h4 class="card-title text-center">All Purchase</h4>
                                <div style="overflow-x:scroll;">
                                    <table id="cheack" class="table table-bordered">

                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>SL</th>
                                                <th>Pur No</th>
                                                <th>Items & Qty</th>
                                                <th>Pur Date & Time</th>
                                                <th>Total</th>
                                                <th>Discount</th>
                                                <th>Vat</th>
                                                <th>Payable</th>
                                                <th>Paid</th>
                                                @if ($user_data->role_id==4)

                                                @else
                                                <th>Is Vat</th>
                                                @endif
                                                <th>Due</th>
                                                {{-- <th>Barcode</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody id="pur_table">
                                            @php $i=1; @endphp
                                            @foreach ($PurchaseInfo as $user)
                                            <tr>
                                                <td value="{{$user->purchase_id}}" class="also checkboxonly-{{$i}}"></td>
                                                <td style="width: 10px;">{{ $i++ }}</td>
                                                <td style="width: 60px;">{{ $user->purchase_id }}</td>
                                                <td style="width: 250px;">
                                                    @php
                                                    $cart_item_data = \App\Models\PurchaseDetail::join('products', 'products.product_id', '=', 'purchase_details.product_id')
                                                    ->where('purchase_details.purchase_id', $user->purchase_id)
                                                    ->select('purchase_details.quantity', 'products.product_name')
                                                    ->get();
                                                    @endphp
                                                    @foreach ($cart_item_data as $itemdata)
                                                    <div class="row pr-3 pt-2">
                                                        <div class="col-12">
                                                            {{ $itemdata->product_name }}
                                                        </div>
                                                        <div class="col-12 mt-2">
                                                            {{ $itemdata->quantity }}
                                                        </div>
                                                        <div class="col-12 mt-2 text-right">
                                                            {{ $itemdata->purchase_price }}
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </td>
                                                <td style="width: 60px;">{{ $user->pur_date }}</td>
                                                <td style="width: 60px;" class="text-right">{{ $user->total_item_price	 }}</td>
                                                <td style="width: 60px;" class="text-right">{{ $user->discount }}</td>
                                                <td style="width: 60px;" class="text-right">{{ $user->total_vat }}</td>
                                                <td style="width: 60px;" class="text-right">{{ $user->total_payable }}</td>
                                                @php
                                                $pay = \App\Models\SupplierPayment::where('purchase_id', $user->purchase_id)
                                                ->first();
                                                @endphp
                                                <td style="width: 60px;" class="text-right">{{ $pay->paid_amount }}</td>
                                                @if ($user_data->role_id==4)

                                                @else
                                                <td>@if ( $user->is_vat_show == 0)
                                                    No
                                                    @else
                                                    Yes
                                                    @endif</td>
                                                @endif

                                                </td>
                                                <td style="width: 60px;" class="text-right">{{ $pay->revised_due }}</td>
                                            </tr>
                                            {{-- <td>
                                                        @if ($user->barcode == null)
                                                            <a class="btn" class="text-light"
                                                                href="{{ route('backoffice.create-barcode', Crypt::encryptString($user->purchase_id)) }}"><i class="fa fa-barcode"></i></a>
                                            @else
                                            <a target="_blank" class="brn" href="{{ route('backoffice.print-barcode', Crypt::encryptString($user->purchase_id)) }}"><img style="margin-left:10px;" src="{{ asset('backend/printer.webp') }}" alt="print"></a>
                                            @endif
                                            </td> --}}
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                {{-- <th></th> --}}
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
        <script src="{{asset('assets/js/jquery/jquery.slim.min.js')}}" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>

        <script type="text/javascript">
            $(document).ready(function() {

                $(document).on('change', '#category_id', function(e) {
                    e.preventDefault();
                    var category_id = $(this).val();
                    // from store
                    $.ajax({
                        url: "sup-purchase-report/" + category_id,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            $("#pur_table").empty();
                            var stockhtml = "";
                            $.each(data, function(key, value) {
                                stockhtml += '<tr>'
                                stockhtml += '<td>' + (key + 1) + '</td>'
                                stockhtml += '<td>' + value.purchase_id + '</td>'
                                stockhtml += '<td id="test-' + value.purchase_id + '">'

                                $.ajax({
                                    url: "pur-name-quantity/" + value.purchase_id,
                                    type: "GET",
                                    data: {
                                        "_token": "{{ csrf_token() }}"
                                    },
                                    dataType: "json",
                                    success: function(pro) {
                                        proHtml = ""
                                        $.each(pro, function(k, val) {
                                            proHtml += '<div class="row pr-3 pt-2"><div class="col-12 col-lg-6 col-md-6 text-truncate mb-1">' + val.product_name + '</div><br><div class="col-12 col-lg-6 col-md-6">' + val.quantity + '</div></div>'
                                        });

                                        $("#" + "test-" + value.purchase_id).append(proHtml)
                                    }
                                });

                                stockhtml += '</td>'
                                stockhtml += '<td>' + value.pur_date + '</td>'
                                stockhtml += '<td class="text-right">' + value.total_item_price + '</td>'
                                stockhtml += '<td class="text-right">' + value.discount + '</td>'
                                stockhtml += '<td class="text-right">' + value.total_payable + '</td>'
                                stockhtml += '<td class="text-right">' + value.total_vat + '</td>'
                                stockhtml += '<td class="text-right">' + value.paid_amount + '</td>'
                                stockhtml += '<td class="text-right">' + value.due_amount + '</td>'
                                stockhtml += '</tr>'
                            });
                            $("#pur_table").append(stockhtml);
                        }
                    });
                });


                $(document).on('click', '#GetRowValue', function() {
                    var selectedRowIds = [];

                    $('#cheack tbody input[type="checkbox"]:checked').each(function() {
                        var rowId = $(this).closest('tr').find('td:nth-child(1)').attr('value'); // Assuming the ID is in the third column (index 2)
                        selectedRowIds.push(rowId);
                    });

                    // Retrieve IDs from all pages
                    if ($('#cheack').DataTable().page.info().pages > 1) {
                        var currentPage = $('#cheack').DataTable().page();
                        $('#cheack').DataTable().page.len(-1).draw(); // Show all rows on a single page
                        $('#cheack tbody input[type="checkbox"]:checked').each(function() {
                            var rowId = $(this).closest('tr').find('td:nth-child(1)').attr('value'); // Assuming the ID is in the third column (index 2)
                            if (!selectedRowIds.includes(rowId)) {
                                selectedRowIds.push(rowId);
                            }
                        });
                        $('#cheack').DataTable().page.len(10).draw(); // Restore original page length
                        $('#cheack').DataTable().page(currentPage).draw(); // Return to original page
                    }

                    // console.log(selectedRowIds);

                    $.ajax({
                        url: "all-purchase-report-for-vat",
                        method: "GET",
                        data: {
                            'selectedRowIds': selectedRowIds,
                        },
                        dataType: "json",
                        success: function(response) {
                            // $('#tableVaue').empty();
                            swal("Success!", "SuccessFully Add For Vat Show", response.success)
                            // console.log(response.status);
                        }
                    });
                });

            });
        </script>
        @endsection