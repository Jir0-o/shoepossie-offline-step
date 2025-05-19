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
                <div class="row justify-content-center">
                    <div class="col-lg-10 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-group mb-4">
                                                    <div class="input-group col-xs-12">
                                                        <span class="input-group-append">
                                                            <span class="file-upload-browse btn btn-primary"> Customer </span>
                                                        </span>
                                                        <select name="login_id" id="login_id" class="form-control">
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-6 text-right">
                                                <button type="button" class="btn btn-primary btn-icon-text"> Print <i class="mdi mdi-printer btn-icon-append"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="card">
                                            <div class="card-header text-center">
                                                CUSTOMER BALANCE DETAILS
                                            </div>
                                            <div class="card-body" id="customer_details">
                                                <div class="text-center p-5">
                                                    Please Select Customer
                                                </div>
                                            </div>
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
        <script src="{{asset('assets/js/jquery/jquery.slim.min.js')}}"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                $("#login_id").empty();
                $("#login_id").append("<option selected disabled> ----select---- </option>");
                $.ajax({
                    url: 'ajax-get-customer',
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    dataType: "json",
                    success: function(data) {
                        $.each(data, function(col, customer) {
                            $("#login_id").append('<option value="' + customer.login_id + '">' + customer.mobile_no + '</option>');
                        });
                    }

                });

                $(document).on('change', '#login_id', function(e) {
                    var login_id = $(this).val();
                    $("#customer_details").empty();
                    $.ajax({
                        url: 'ajax-get-customer-details/' + login_id,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        dataType: "json",
                        success: function(data) {
                            var customer_html = '';
                            customer_html += '<div class="row"><div class="col-12 col-md-6 col-lg-6">'
                            customer_html += '<div class="p-2"><i>Total Sales Amount</i></div></hr>'
                            customer_html += '<div class="p-2"><i>Paid Amount</i></div></hr>'
                            customer_html += '<div class="p-2"><i>Due Amount</i></div></hr>'
                            customer_html += '<div class="p-2"><i>Extra Paid</i></div>'
                            customer_html += '<div class="p-2"><i>Balance</i></div>'
                            customer_html += '</div>'
                            customer_html += '<div class="col-12 col-md-6 col-lg-6">'
                            customer_html += '<div class="p-2"><i>' + data.total_sales + '</i></div></hr>'
                            customer_html += '<div class="p-2"><i>' + data.paid_amount + '</i></div></hr>'
                            customer_html += '<div class="p-2"><i>' + data.due_amount + '</i></div></hr>'
                            customer_html += '<div class="p-2"><i>' + data.customer_payment + '</i></div>'
                            customer_html += '<div class="p-2"><i><b>' + data.balance + '</b></i></div>'
                            customer_html += '</div></div>';

                            $("#customer_details").append(customer_html);
                        }

                    });
                });
            });
        </script>

        @endsection