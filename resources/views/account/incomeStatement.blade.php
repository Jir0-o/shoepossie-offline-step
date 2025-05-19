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
            <div id="printable" class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title">Cash Flow Statement</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item no-print"><a href="#">Reports</a></li>
                            <li class="breadcrumb-item active no-print" aria-current="page"> Cash Flow Statement </li>
                        </ol>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4 no-print">
                        <div class="input-group mb-4">
                            <div class="input-group col-xs-12">
                                <input id="singledate" type="date" name="singledate" class="form-control file-upload-info" placeholder="To">
                                <span class="input-group-append">
                                    <span class="file-upload-browse btn btn-primary"> Date </span>
                                </span>
                                <span class="ml-3">
                                    <button type="button" class="print no-print btn btn-primary btn-icon-text"> Print <i class="mdi mdi-printer btn-icon-append"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 col-md-6 col-lg-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-center pb-3">Cash Flow Statement <span id="showDate"></span></h4>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="50%">
                                                OPENING BALANCE
                                            </th>
                                            <th class="text-right pr-2" id="opening_balance"></th>
                                        </tr>
                                    </thead>
                                </table>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="50%">
                                                IN
                                            </th>
                                            <th class="text-right pr-2" id="in"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="sales"></tbody>
                                </table>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="50%">
                                                CUSTOMER PAYMENT
                                            </th>
                                            <th class="text-right pr-2" id="customer_payment"></th>
                                        </tr>
                                    </thead>
                                </table>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="50%">
                                                OUT
                                            </th>
                                            <th class="text-right pr-2" id="out"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="expense"></tbody>
                                </table>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="50%">
                                                SUPPLIER PAYMENT
                                            </th>
                                            <th class="text-right pr-2" id="supplier_payment"></th>
                                        </tr>
                                    </thead>
                                </table>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="50%">
                                                BALANCE
                                            </th>
                                            <th class="text-right pr-2" id="balance"></th>
                                        </tr>
                                    </thead>
                                </table>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="50%">

                                            </th>
                                            <th class="text-right pr-2 no-print" id="day_end"></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <script src="{{asset('assets/js/jquery/jquery.slim.min.js')}}"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                var nodata = '<tr><td colspan="2" class="text-center"><p>Select Date For Result</p></td></tr>'
                $('#sales').append(nodata);
                $('#expense').append(nodata);
                $('#others').append(nodata);
                $('#netIncome').append(nodata);

                $(document).on('change', '#singledate', function(e) {
                    var singledate = $(this).val();
                    $.ajax({
                        url: 'ajax-get-income-stat/' + singledate,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        dataType: "json",
                        success: function(data) {
                            $('#sales').empty();
                            $('#expense').empty();
                            $('#balance').empty();
                            $('#opening_balance').empty();
                            $('#in').empty();
                            $('#out').empty();
                            $('#supplier_payment').empty();
                            $('#customer_payment').empty();
                            $('#day_end').empty();
                            $('#showDate').empty();

                            $('#opening_balance').append(data.opening_balance);
                            $('#customer_payment').append(data.all_customer_payments);
                            $('#supplier_payment').append(data.all_supplier_payments);
                            $('#in').append(data.sales_paid_amount);
                            $('#balance').append(data.balance);
                            $('#out').append(data.purchase_paid_amount + data.total_expense);
                            $('#showDate').append("(" + data.date + ")");


                            var saleshtml = '<tr><td>Sales</td><td>' + data.sales_total_payable_amount + '</td></tr>';
                            saleshtml += '<tr><td>Paid Amount</td><td>' + data.sales_paid_amount + '</td></tr>';
                            saleshtml += '<tr><td>Due Amount</td><td>' + data.sales_total_due + '</td></tr>';
                            $('#sales').append(saleshtml);

                            var expenseHtml = '<tr><td>Expense</td><td>' + data.total_expense + '</td></tr>';
                            expenseHtml += '<tr><td>Total Purchase</td><td>' + data.purchase_total_payable_amount + '</td></tr>';
                            expenseHtml += '<tr><td>Paid Amount</td><td>' + data.purchase_paid_amount + '</td></tr>';
                            expenseHtml += '<tr><td>Due Amount</td><td>' + data.purchase_total_due + '</td></tr>';
                            $('#expense').append(expenseHtml);

                            if (!data.dayend) {
                                $('#day_end').append('<div value="' + data.date + '" id="dayend" class="btn btn-primary">Day End</div>');
                            }
                        }
                    });
                });
                $(document).on('click', '#dayend', function(e) {
                    var date = $(this).attr("value");
                    $.ajax({
                        url: 'day-end/' + date,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        dataType: "json",
                        success: function(data) {
                            $('#dayend').empty();
                            $('#sales').empty();
                            $('#expense').empty();
                            $('#balance').empty();
                            $('#opening_balance').empty();
                            $('#in').empty();
                            $('#out').empty();
                            $('#supplier_payment').empty();
                            $('#customer_payment').empty();
                            $('#day_end').empty();
                            $('#showDate').empty();
                        }
                    });

                });
                $(document).on('change', '#from', function(e) {
                    $('#sales').empty();
                    $('#summary').empty();
                    var from = $("#from").val();
                    var to = $("#to").val();
                    if (!to) {
                        $("#error").append('<div class="alert alert-danger"> To Date Is Required</div>');
                        return;
                    }
                    if (!from) {
                        $("#error").append('<div class="alert alert-danger"> From Date Is Required</div>');
                        return;
                    }

                    $.ajax({
                        url: 'multi-date-income-stat/' + from + '/' + to,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        dataType: "json",
                        success: function(data) {
                            console.log(data);
                            $('#sales').empty();
                            $('#expense').empty();
                            $('#balance').empty();

                            var saleshtml = '<tr><td>Sales</td><td>' + data.total_payable_amount + '</td></tr>';
                            saleshtml += '<tr><td>Gross Profit</td><td>' + data.gross_profit + '</td></tr>';
                            $('#sales').append(saleshtml);

                            var expenseHtml = '<tr><td>Total Expense</td><td>' + data.total_expense + '</td></tr>';
                            $('#expense').append(expenseHtml);

                            var balanceHtml = '<tr><td>Balance</td><td><b>' + data.balance + '</b></td></tr>';
                            $('#balance').append(balanceHtml);
                        }

                    });
                });
                $(document).on('change', '#to', function(e) {
                    $('#sales').empty();
                    $('#summary').empty();
                    var from = $("#from").val();
                    var to = $("#to").val();
                    if (!to) {
                        $("#error").append('<div class="alert alert-danger"> To Date Is Required</div>');
                        return;
                    }
                    if (!from) {
                        $("#error").append('<div class="alert alert-danger"> From Date Is Required</div>');
                        return;
                    }

                    $.ajax({
                        url: 'multi-date-income-stat/' + from + '/' + to,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        dataType: "json",
                        success: function(data) {
                            console.log(data);
                            $('#sales').empty();
                            $('#expense').empty();
                            $('#balance').empty();

                            var saleshtml = '<tr><td>Sales</td><td>' + data.total_payable_amount + '</td></tr>';
                            saleshtml += '<tr><td>Gross Profit</td><td>' + data.gross_profit + '</td></tr>';
                            $('#sales').append(saleshtml);

                            var expenseHtml = '<tr><td>Total Expense</td><td>' + data.total_expense + '</td></tr>';
                            $('#expense').append(expenseHtml);

                            var balanceHtml = '<tr><td>Balance</td><td><b>' + data.balance + '</b></td></tr>';
                            $('#balance').append(balanceHtml);
                        }

                    });
                });
                //print Expense  Report

                $("#printable").find('.print').on('click', function() {
                    $.print("#printable");
                });
            });
        </script>

        @endsection