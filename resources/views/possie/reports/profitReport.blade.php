@extends('layouts.layout')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.min.js"></script>

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
                        <h3 class="page-title">Profit Report</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Reports</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> Profit Report </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="from">From: </label>
                                <input id="from" type="date" class="form-control" placeholder="From">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="to">To: </label>
                                <input id="to" type="date" class="form-control file-upload-info" placeholder="To">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="singledate">Specific Date: </label>
                                <input id="singledate" type="date" name="singledate" class="form-control file-upload-info" placeholder="To">
                            </div>
                        </div>
                    </div>
                    <p class="m-0">
                        <strong>Note: </strong>This form does not need to be submitted. Simply enter your values in any field to view your results.
                    </p>
                    <div class="mb-4" id="error"></div>
                    <div id="printable" class="card p-4">                          
                        <div class="d-flex justify-content-between mb-3">
                            <h4 class="card-title pb-3">PROFIT REPORT</h4>                                
                            <button type="button" class="print no-print btn btn-primary">
                                Print <i class="mdi mdi-printer btn-icon-append"></i>
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-center p-3">SL</th>
                                        <th class="text-center p-3">Product</th>
                                        <th class="text-center p-3">Category</th>
                                        <th class="text-center p-3">Quantity</th>
                                        <th class="text-center p-3">Selling Date</th>
                                        <th class="text-center p-3">Consumer</th>
                                        <th class="text-center p-3">Profit</th>
                                    </tr>
                                </thead>
                                <tbody id="sales"></tbody>
                                <tfoot id="summary" class="summary-print"></tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- main-panel ends -->
                </div>
                <!-- page-body-wrapper ends -->
            </div>
            <style>
                @media print {
                    .summary-print {
                        display: table-row-group;
                        page-break-before: always;
                    }

                    .no-print {
                        display: none !important;
                    }
                }
            </style>
            <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
                integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
            </script>

            <script type="text/javascript">
                $(document).ready(function() {
                    var nodata = '<tr><td colspan="11" class="text-center"><p>Select Date For Result</p></td></tr>';
                    $('#sales').append(nodata);
                    $("#error").empty();

                    $(document).on('change', '#singledate', function(e) {
                        var singledate = $(this).val();
                        $('#sales').empty();
                        $('#summary').empty();
                        $("#error").empty();
                        $.ajax({
                            url: 'single-date-profit/' + singledate,
                            type: "GET",
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            dataType: "json",
                            success: function(data) {
                                var i=0;
                                $.each(data.singleDateProfit, function(index, dsdata) {
                                    // Iterate through items for each record    
                                    console.log(dsdata);
                                                                    
                                    i++;
                                    var dshtml = '<tr>' +
                                            '<td id="example" class="text-center px-3 py-2">' + i + '</td>' +
                                            '<td class="text-center px-3 py-2">' + dsdata.items.map(res => res.product_name).join('<br>') + '</td>' +
                                            '<td class="text-center px-3 py-2">' + dsdata.items.map(res => res.category_name ).join('<br>') + '</td>' +
                                            '<td class="text-center px-3 py-2">' + dsdata.items.map(res => res.quantity).join('<br>') + '</td>' +
                                            '<td class="text-center px-3 py-2">' + dsdata.cart_date + '</td>' +
                                            '<td class="text-center px-3 py-2">' + dsdata.mobile_no + '</td>' +
                                            '<td class="text-end px-3 py-2">' + dsdata.net_profit + '</td>' +
                                        '</tr>';
                                    $('#sales').append(dshtml);
                                });
                                var summary_data = '<tr class="h4 bg-secondary">' +
                                        '<td class="text-end px-3 py-2" colspan="5">Summary</td>' +
                                        '<td class="text-center px-3 py-2">' + data.summary.quantity + '</td>' +
                                        '<td class="text-end px-3 py-2">' + data.summary.profit + '</td>' +
                                    '</tr>';
                                $('#summary').append(summary_data);
                            },
                            error: function() {
                                $("#error").append('<div class="alert alert-danger">Unable to fetch data.</div>');
                            }
                        });
                    });

                    $(document).on('change', '#from', function(e) {
                        $('#sales').empty();
                        $('#summary').empty();
                        var from=$("#from").val();
                        var to=$("#to").val();
                        if(!to){
                            $("#error").append('<div class="alert alert-danger"> To Date Is Required</div>');
                            return;
                        }
                        if(!from){
                            $("#error").append('<div class="alert alert-danger"> From Date Is Required</div>');
                            return;
                        }

                        $.ajax({
                            url: 'multi-date-profit/'+from+'/'+to,
                            type: "GET",
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            dataType: "json",
                            success: function(data) {
                                var i=0;
                                $.each(data.singleDateProfit, function(index, dsdata) {
                                    // Iterate through items for each record    
                                    console.log(dsdata);
                                                                    
                                    i++;
                                    var dshtml = '<tr>' +
                                            '<td id="example" class="text-center px-3 py-2">' + i + '</td>' +
                                            '<td class="text-center px-3 py-2">' + dsdata.items.map(res => res.product_name).join('<br>') + '</td>' +
                                            '<td class="text-center px-3 py-2">' + dsdata.items.map(res => res.category_name ).join('<br>') + '</td>' +
                                            '<td class="text-center px-3 py-2">' + dsdata.items.map(res => res.quantity).join('<br>') + '</td>' +
                                            '<td class="text-center px-3 py-2">' + dsdata.cart_date + '</td>' +
                                            '<td class="text-center px-3 py-2">' + dsdata.mobile_no + '</td>' +
                                            '<td class="text-end px-3 py-2">' + dsdata.net_profit + '</td>' +
                                        '</tr>';
                                    $('#sales').append(dshtml);
                                });
                                var summary_data = '<tr class="h4 bg-secondary">' +
                                    '<td class="text-end px-3 py-2" colspan="5">Summary</td>' +
                                    '<td class="text-center px-3 py-2">' + data.summary.quantity + '</td>' +
                                    '<td class="text-end px-3 py-2">' + data.summary.profit + '</td>' +
                                    '</tr>';
                                $('#summary').append(summary_data);
                            },
                            error: function() {
                                $("#error").append('<div class="alert alert-danger">Unable to fetch data.</div>');
                            }
                        });
                    });

                    $(document).on('change', '#to', function(e) {
                        $('#sales').empty();
                        $('#summary').empty();
                        var from=$("#from").val();
                        var to=$("#to").val();
                        if(!to){
                            $("#error").append('<div class="alert alert-danger"> To Date Is Required</div>');
                            return;
                        }
                        if(!from){
                            $("#error").append('<div class="alert alert-danger"> From Date Is Required</div>');
                            return;
                        }

                        $.ajax({
                                url: 'multi-date-profit/'+from+'/'+to,
                                type: "GET",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                },
                                dataType: "json",
                                success: function(data) {
                                var i=0;
                                $.each(data.singleDateProfit, function(index, dsdata) {
                                    // Iterate through items for each record    
                                    console.log(dsdata);
                                                                    
                                    i++;
                                    var dshtml = '<tr>' +
                                            '<td class="text-center px-3 py-2">' + i + '</td>' +
                                            '<td class="text-center px-3 py-2">' + dsdata.items.map(res => res.product_name).join('<br>') + '</td>' +
                                            '<td class="text-center px-3 py-2">' + dsdata.items.map(res => res.category_name ).join('<br>') + '</td>' +
                                            '<td class="text-center px-3 py-2">' + dsdata.items.map(res => res.quantity).join('<br>') + '</td>' +
                                            '<td class="text-center px-3 py-2">' + dsdata.cart_date + '</td>' +
                                            '<td class="text-center px-3 py-2">' + dsdata.mobile_no + '</td>' +
                                            '<td class="text-end px-3 py-2">' + dsdata.net_profit + '</td>' +
                                        '</tr>';
                                    $('#sales').append(dshtml);
                                });
                                var summary_data = '<tr class="h4 bg-secondary">' +
                                            '<td class="text-end px-3 py-2" colspan="5">Summary</td>' +
                                            '<td class="text-center px-3 py-2">' + data.summary.quantity + '</td>' +
                                            '<td class="text-end px-3 py-2">' + data.summary.profit + '</td>' +
                                        '</tr>';
                                $('#summary').append(summary_data);
                            },
                            error: function() {
                                $("#error").append('<div class="alert alert-danger">Unable to fetch data.</div>');
                            }
                        });
                    });
                });
                //print purchase  Report

                $("#printable").find('.print').on('click', function() {
                    $.print("#printable");
                });
            </script>
        </div>
    </div>
@endsection
