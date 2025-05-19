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
                    <h3 class="page-title">Sales Summary Report</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Reports</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> Sales Report <span id="report-type"> <span></li>
                        </ol>
                    </nav>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <div class="input-group mb-4 align-items-center ">
                            <label class="form-label m-0 btn btn-primary">From Date </label>
                            <input id="from" type="date" class="form-control" placeholder="From Date">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-4 align-items-center">
                            <label class="form-label m-0 btn btn-primary">To Date </label>
                            <input id="to" type="date" class="form-control file-upload-info" placeholder="To">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-4 align-items-center">
                            <label class="form-label m-0 btn btn-primary">Payment Method</label>
                            <select name="payment_method"
                                id="payment_method" class="form-control">
                                <option selected value="">----Select Payment Type-----</option>
                                @foreach ($getCartPaymentMethod as $getCartPaymentMethods)
                                <option value="{{$getCartPaymentMethods->payment_method_id}}">{{$getCartPaymentMethods->payment_method}}</option>
                                @endforeach
                            </select> 
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group mb-4">
                            <label class="form-label m-0 btn btn-primary">Customer</label>
                            <input id="Customer" type="text" name="Customer" class="form-control file-upload-info" placeholder="Enter Customer Mobile">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-4">
                            <label class="form-label m-0 btn btn-primary">Report Type</label>
                            <select id="report_type" type="number" name="report_type" class="form-control file-upload-info" placeholder="Enter Due">
                                <option selected value="">----Select Report Type-----</option>
                                <option value="1">Details</option>
                                <option value="2">Summary</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 ">
                        <div class="d-flex justify-content-end">
                            <button id="generate" class="btn btn-info" type="submit">Generate Report</button>
                        </div>
                    </div>
                </div>
                <hr>
                <div id="printable" class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h4 class="card-title m-0">SALES <span id="r_type">SUMARY</span> REPORT</h4>
                                    <button type="button" class="print no-print btn btn-primary btn-icon-text"> Print <i class="mdi mdi-printer btn-icon-append"></i></button>
                                </div>

                                <table class="table table-bordered" style="display: block;
                                max-width: -moz-fit-content;
                                max-width: fit-content;
                                margin: 0 auto;
                                overflow-x: auto;
                                white-space: nowrap;">
                                    <thead id="report-head">
                                        
                                    </thead>
                                    <tbody id="sales"></tbody>
                                    <tfoot id="summary"></tfoot>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- main-panel ends -->

                {{-- New Summary
                <div id="printable-new" class="row a">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-9 col-lg-9">
                                        <h4 class="card-title pb-3">SALES Sumary Report</h4>
                                    </div>
                                    <div class="col-12 col-md-3 col-lg-3 text-right">
                                        <button type="button"   class="print-new no-print btn btn-primary btn-icon-text"> Print <i class="mdi mdi-printer btn-icon-append"></i>
                                        </button>
                                    </div>
                                </div>

                                <table class="table table-bordered">
                                    <thead >
                                        <tr>
                                            <th>SL</th>
                                            <th>Date</th>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Customer</th>
                                            <th>Bill Amount</th>
                                            <th>Discount</th>
                                            <th>Vat</th>
                                            <th>Payable</th>
                                            <th>Paid</th>
                                            <th>Due</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="sales-summary"></tbody>
                                    <tfoot id="summary-total"></tfoot>
                                </table>

                            </div>
                        </div>
                    </div>
                </div> --}}
                <!-- page-body-wrapper ends -->
            </div>
            <script src="{{asset('assets/js/jquery/jquery-3.5.1.js')}}"></script>

            <script type="text/javascript">
                $(document).ready(function() {
                    var nodata = '<tr><td colspan="10" class="text-center"><p>Select Date For Result</p></td></tr>';
                    $('#sales').append(nodata);
                    $("#error").empty();

                    function showDetailsReport(data) {
                        // let tableHead = `
                        //                 <tr>
                        //                     <th>SL</th>
                        //                     <th>Date</th>
                        //                     <th>Article No</th>
                        //                     <th>Brand</th>
                        //                     <th>Payment Type</th>
                        //                     <th>Quantity</th>
                        //                     <th>Customer</th>
                        //                     <th>Bill Amount</th>
                        //                     <th>Discount</th>
                        //                     <th>Payable</th>
                        //                     <th>Due/Change</th>
                        //                     <th>Paid</th>
                        //                 </tr>
                        //                 `;
                        // Removed 
                        // <th>Due/Change</th>
                        // <th>Paid</th>
                        let tableHead = `
                                        <tr>
                                            <th>SL</th>
                                            <th>Date</th>
                                            <th>Article</th>
                                            <th>Brand</th>
                                            <th>Payment Type</th>
                                            <th>Quantity</th>
                                            <th>Customer</th>
                                            <th>Bill Amount</th>
                                            <th>Discount</th>
                                            <th>Paid</th>
                                        </tr>
                                        `;
                        
                                        $('#report-head').append(tableHead);
                                var i = 0;
                                var dshtml;
                                $.each(data.singleDateSales, function(col, dsdata) {
                                    i++;
                                    dshtml = `
                                        <tr>
                                            <td>${i}</td>
                                            <td>${dsdata.cart_date.slice(0, 10)}</td>
                                            <td>${dsdata.items.map(res=>'<span class="d-block">'+res.barcode+'</span>')}</td>
                                            <td>${dsdata.items.map(res=>'<span class="d-block">'+res.brand_type_name+'</span>')}</td>
                                            <td>${dsdata.pay.map(res=>'<span class="d-block">'+res.payment_method +" " + (res.payment_method_id!=1?res.paid_amount:parseInt(res.paid_amount)+parseInt(dsdata.paid_amount)) +'</span>')}</td>
                                            <td>${dsdata.quantity}</td>
                                            <td>${dsdata.mobile_no}</td>
                                            <td class="text-right">${dsdata.total_cart_amount}</td>
                                            <td class="text-right">${dsdata.total_discount ? dsdata.total_discount : '0'}</td>
                                            <td class="text-right">${dsdata.total_payable_amount}</td>
                                            <!-- <td class="text-right">${dsdata.paid_amount}</td> -->
                                            <!-- <td class="text-right">${dsdata.due_amount}</td> -->
                                        </tr>
                                    `;
                                    $('#sales').append(dshtml);
                                });

                                // $.each(data.singleDateSales, function(col, dsdata) {
                                //     i++;
                                //     dshtml = '<tr>'
                                //     dshtml += '<td>' + i + '</td>'
                                //     dshtml += '<td>' + dsdata.cart_date.slice(0, 10) + '</td>'
                                //     dshtml += '<td>' + dsdata.items.barcode + '</td>'
                                //     dshtml += '<td>' + dsdata.items.brand_type_name + '</td>'
                                //     dshtml += '<td>' + dsdata.payment_method + '</td>'
                                //     dshtml += '<td>' + dsdata.quantity + '</td>'
                                //     dshtml += '<td>' + dsdata.mobile_no + '</td>'
                                //     dshtml += '<td class="text-right">' + dsdata.total_cart_amount + '</td>'
                                //     dshtml += '<td class="text-right">' + (dsdata.total_discount ? dsdata.total_discount : '0') + '</td>'
                                //     dshtml += '<td class="text-right">' + dsdata.total_payable_amount + '</td>'
                                //     // dshtml += '<td class="text-right">' + dsdata.paid_amount + '</td>'
                                //     // dshtml += '<td class="text-right">' + dsdata.due_amount + '</td>'
                                //     dshtml += '</tr>';
                                //     $('#sales').append(dshtml);
                                // });
                
                                var summary_data = '<tr class="h4 bg-secondary">'
                                summary_data += '<td colspan="2">Summary</td>'
                                summary_data += '<td></td>'            
                                summary_data += '<td></td>'            
                                summary_data += '<td></td>'            
                                summary_data += '<td>' + data.summary.totalQuantity + '</td>'
                                summary_data += '<td></td>'
                                summary_data += '<td class="text-right">' + data.summary.invoice_amount + '</td>'
                                summary_data += '<td class="text-right">' + data.summary.discount + '</td>'
                                summary_data += '<td class="text-right">' + data.summary.payable + '</td>'
                                // summary_data += '<td class="text-right">' + data.summary.paid_amount + '</td>'
                                // summary_data += '<td class="text-right">' + data.summary.due + '</td>'
                                summary_data += '</tr>';
                                $('#summary').append(summary_data);

                    }

                    function showSumeryReport(data) {
                        let tableHead = `
                                        <tr>
                                            <th>SL</th>
                                            <th>Formated Date</th>
                                            <th>Total Invoice</th>
                                            <th>Total Quantity</th>
                                            <th>Total Final Amount</th>
                                            <th>Total Discount</th>
                                            <th>Total Paid Amount</th>
                                            
                                            
                                        </tr>
                                        `;
                        
                                        $('#report-head').append(tableHead);
                        var i = 0;
                        // var sum_cart = 0;
                        // var sum_invoice_amount = 0;
                        // var sum_due_amount = 0;
                        // var sum_paid_amount = 0;
                        // var sum_net_profit = 0;

                                var dshtml;
                            
                                $.each(data.singleDateSales, function(col, dsdata) {
                                    i++;
                                    // sum_cart = sum_cart + dsdata.total_carts
                                    // sum_cart = sum_cart + dsdata.total_quantity
                                    // sum_final_amount = sum_final_amount + dsdata.invoice_amount
                                    // sum_final_amount = sum_final_amount + dsdata.invoice_amount
                                    // sum_paid_amount = sum_paid_amount + dsdata.total_paid_amount
                                    // sum_net_profit = sum_net_profit + dsdata.total_net_profit
                                    dshtml = '<tr>'
                                    dshtml += '<td>' + i + '</td>'
                                    dshtml += '<td >' + dsdata.formatted_date + '</td>'
                                    dshtml += '<td>' + dsdata.total_carts + '</td>'
                                    dshtml += '<td>' + dsdata.total_quantity + '</td>'
                                    dshtml += '<td class="text-right">' + dsdata.total_final_amount + '</td>'
                                    dshtml += '<td class="text-right">' + (dsdata.total_discount_amount?? 0) + '</td>'
                                    dshtml += '<td class="text-right">' + dsdata.total_paid_amount + '</td>'
                                    // dshtml += '<td class="text-right">' + dsdata.total_net_profit + '</td>'
                                    dshtml += '</tr>';
                                    $('#sales').append(dshtml);
                                });
                
                                var summary_data = '<tr class="h4 bg-secondary">'
                                summary_data += '<td colspan="2">Total</td>'
                                summary_data += '<td>'+ data.summary.total_orders +'</td>'
                                summary_data += '<td >'+ data.summary.total_quantity +'</td>'
                                summary_data += '<td class="text-right">'+ data.summary.invoice_amount  +'</td>'
                                summary_data += '<td class="text-right">'+ data.summary.discount  +'</td>'
                                summary_data += '<td class="text-right">'+ data.summary.paid  +'</td>'
                                // summary_data += '<td class="text-right">'+ data.summary.profit  +'</td>'
                                
                                
                                summary_data += '</tr>';
                                $('#summary').append(summary_data);

                    }

                    
                    $(document).on('click', '#generate', function(e) {
                        $('#sales').empty();
                        $('#summary').empty();
                        $('#report-head').empty();
                        $('#r_type').empty();

                        var from = $("#from").val();
                        var to = $("#to").val();
                        var payment_method = $("#payment_method").val();
                        var customer = $("#Customer").val();
                        var report_type = $("#report_type").val();
                        
                        if (!report_type) {
                            alert("Select Report Type");
                            return; // Early return to prevent further execution if report_type is not selected
                        }
                
                        var data = {
                            "_token": "{{ csrf_token() }}",
                            "from_date": from,
                            "to_date": to,
                            "payment_method_id": payment_method,
                            "customer": customer,
                            "report_type": report_type,
                        };
                
                        $.ajax({
                            url: 'multi-filter-report/',
                            type: "GET",
                            data: data, // send data object directly
                            dataType: "json",
                            success: function(data) {
                                // console.log(data);
                                if(report_type==1){
                                    $('#r_type').text('DETAILS' )
                                    showDetailsReport(data);
                                    
                                    
                                }   
                                else if(report_type==2){
                                    $('#r_type').text('SUMARY')
                                    showSumeryReport(data);
                                }   
                                
                            }
                        });
                    });
                
                    // Print Sales Report
                    $("#printable").find('.print').on('click', function() {
                        $.print("#printable");
                    });
                    
                    // Print New Sales Report
                    $("#printable-new").find('.print-new').on('click', function() {
                        $.print("#printable-new");
                    });
                });

            </script>

            @endsection