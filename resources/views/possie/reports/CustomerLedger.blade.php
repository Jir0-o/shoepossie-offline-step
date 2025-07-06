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
                    <div class="card p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="form-group">
                                <label for="login_id">Select Customer</label>
                                <br>
                                <select name="login_id" id="login_id" class="form-control select2">
                                </select>
                            </div>
                            <div id="custLedgerPrint">

                            </div>
                        </div>
                        <div class="card-header text-center">
                            CUSTOMER LEDGER
                        </div>
                        <div id="customer_details">
                            <div class="text-center p-3">
                                Please Select Customer
                            </div>
                        </div>
                    </div>
                    <!-- main-panel ends -->
                </div>
                <!-- page-body-wrapper ends -->
            </div>
            <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
                integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
            </script>

            <script type="text/javascript">
                $(document).ready(function() {
                    function formatDate(dateString) {
                        const date = new Date(dateString);
                        const day = String(date.getDate()).padStart(2, '0');
                        const month = String(date.getMonth() + 1).padStart(2, '0'); // January is 0!
                        const year = date.getFullYear();
                    
                        return `${day}/${month}/${year}`;
                    }
                    
                    $('#login_id').select2({
                        placeholder: "----select----",
                        allowClear: true,
                        width: '100%' 
                    });

                    // Fetch customers and populate
                    $.ajax({
                        url: 'ajax-get-customer',
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            let $select = $("#login_id");
                            $select.empty().append('<option></option>'); // For placeholder
                            
                            $.each(data, function(index, customer) {
                                $select.append(
                                    $('<option>', {
                                        value: customer.login_id,
                                        text: " (" + customer.mobile_no + ")"
                                    })
                                );
                            });

                            // Trigger update
                            $select.trigger('change');
                        }
                    });

                    $(document).on('change', '#login_id', function (e) {
                        var login_id = $(this).val();
                        $("#customer_details").empty();
                        $("#custLedgerPrint").empty();

                        $.ajax({
                            url: 'ajax-get-customer-details_short/' + login_id,
                            type: "GET",
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            dataType: "json",
                            success: function (data) {
                                if (data.consumer) {
                                    var loginId = data.consumer.login_id;
                                    var printUrl = `print-customer-ledger/${loginId}`;
                                    var buttonHtml = `
                                        <a href="${printUrl}" target="_blank" class="btn btn-primary btn-icon-text">
                                            Print <i class="mdi mdi-printer btn-icon-append"></i>
                                        </a>`;
                                    $("#custLedgerPrint").append(buttonHtml);
                                } else {
                                    alert("Customer not found!");
                                }

                                let customer_html = `
                                    <p class="my-2">
                                        <strong>Mobile No.:</strong> ${data.consumer.mobile_no}
                                    </p>
                                    <h3 class="text-center">Transaction Details</h3>
                                    <div class="table-responsive">
                                        <table id="customerLedgerTable" class="table table-bordered table-striped nowrap" style="width:100%">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th class="text-center p-2">Date</th>
                                                    <th class="text-center p-2">Payable</th>
                                                    <th class="text-center p-2">Paid</th>
                                                    <th class="text-center p-2">Due</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th class="text-end p-2">Total</th>
                                                    <th class="text-end px-3" id="totalPayable">0.00</th>
                                                    <th class="text-end px-3" id="totalPaid">0.00</th>
                                                    <th class="text-end px-3" id="totalDue">0.00</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                `;
                                $("#customer_details").append(customer_html);

                                // Destroy existing DataTable if already initialized
                                if ($.fn.DataTable.isDataTable('#customerLedgerTable')) {
                                    $('#customerLedgerTable').DataTable().destroy();
                                    $('#customerLedgerTable').empty(); // Remove old data
                                }

                                // Prepare totals (optional, you could move this to footer callback)
                                let totalPayable = 0, totalPaid = 0, totalDue = 0;

                                data.payments.forEach(trx => {
                                    totalPayable += trx.payable_amount !== null ? parseFloat(trx.payable_amount) : 0;
                                    totalPaid += trx.paid_amount !== null ? parseFloat(trx.paid_amount) : 0;
                                    totalDue += trx.revised_due !== null ? parseFloat(trx.revised_due) : 0;
                                });

                                // Initialize DataTable
                                $('#customerLedgerTable').DataTable({
                                    data: data.payments,
                                    columns: [
                                        {
                                            data: 'created_at',
                                            render: function (data) {
                                                return formatDate(data);
                                            },
                                            className: 'text-center p-2'
                                        },
                                        {
                                            data: 'payable_amount',
                                            render: function (data) {
                                                return data !== null ? parseFloat(data).toFixed(2) : '0.00';
                                            },
                                            className: 'text-end px-3'
                                        },
                                        {
                                            data: 'paid_amount',
                                            render: function (data) {
                                                return data !== null ? parseFloat(data).toFixed(2) : '0.00';
                                            },
                                            className: 'text-end px-3'
                                        },
                                        {
                                            data: 'revised_due',
                                            render: function (data) {
                                                return data !== null ? parseFloat(data).toFixed(2) : '0.00';
                                            },
                                            className: 'text-end px-3'
                                        }
                                    ],
                                    scrollX: true,
                                    pageLength: 10,
                                    responsive: true,
                                    searching: true,
                                    info: true,
                                    paging: true,
                                    ordering: true,
                                    footerCallback: function (row, data, start, end, display) {
                                        let api = this.api();
                                        // Calculate totals
                                        let totalPayable = 0, totalPaid = 0, totalDue = 0;

                                        data.forEach(trx => {
                                            totalPayable += trx.payable_amount !== null ? parseFloat(trx.payable_amount) : 0;
                                            totalPaid += trx.paid_amount !== null ? parseFloat(trx.paid_amount) : 0;
                                            totalDue += trx.revised_due !== null ? parseFloat(trx.revised_due) : 0;
                                        });

                                        // Update the footer cells
                                        $(api.column(1).footer()).html(`<strong>${totalPayable.toFixed(2)}</strong>`);
                                        $(api.column(2).footer()).html(`<strong>${totalPaid.toFixed(2)}</strong>`);
                                        $(api.column(3).footer()).html(`<strong>${totalDue.toFixed(2)}</strong>`);
                                    }
                                });
                            }
                        });
                    });
                });
            </script>

@endsection
