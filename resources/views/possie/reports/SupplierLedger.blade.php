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
                        <label for="login_id">Select Supplier</label>
                        <select name="login_id" id="login_id" class="form-control select2-supplier">
                        </select>
                    </div>
                    <div id="supLedgerPrint"></div>
                        </div>
                    </div>
                    <div class="card-header text-center">
                        SUPPLIER LEDGER
                    </div>
                    <div id="supplier_details">
                        <div class="text-center p-3">
                            Please Select Supplier
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
                
                // Initialize Select2
                $('#login_id').select2({
                    placeholder: "----select----",
                    allowClear: true,
                    width: '100%'
                });

                // Load supplier data
                $.ajax({
                    url: 'ajax-get-supplier',
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        let $select = $("#login_id");
                        $select.empty().append('<option></option>'); // For placeholder

                        $.each(data, function(index, supplier) {
                            $select.append(
                                $('<option>', {
                                    value: supplier.supplier_id,
                                    text: supplier.supplier_name + (supplier.mobile_no ? " (" + supplier.mobile_no + ")" : "")
                                })
                            );
                        });

                        $select.trigger('change');
                    }
                });

                $(document).on('change', '#login_id', function (e) {
                    var login_id = $(this).val();
                    $("#supplier_details").empty();
                    $("#supLedgerPrint").empty();

                    $.ajax({
                        url: 'ajax-get-supplier-details-short/' + login_id,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        dataType: "json",
                        success: function (data) {
                            if (data.supplier) {
                                var supplier_id = data.supplier.supplier_id;
                                var printUrl = `print-supplier-ledger/${supplier_id}`;
                                var buttonHtml = `
                                    <a href="${printUrl}" target="_blank" class="btn btn-primary btn-icon-text">
                                        Print <i class="mdi mdi-printer btn-icon-append"></i>
                                    </a>`;
                                $("#supLedgerPrint").append(buttonHtml);
                            } else {
                                alert("Supplier not found!");
                                return;
                            }

                            let supplier_html = `
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="my-2"><strong>Name:</strong> ${data.supplier.supplier_name}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="my-2"><strong>Contact:</strong> ${data.supplier.supplier_contact_person}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="my-2"><strong>Address:</strong> ${data.supplier.supplier_address}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="my-2"><strong>Mobile No.:</strong> ${data.supplier.supplier_contact_no}</p>
                                    </div>
                                </div>

                                <h3 class="text-center">Transaction Details</h3>
                                <div class="table-responsive">
                                    <table id="supplierLedgerTable" class="table table-bordered table-striped nowrap" style="width:100%">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th class="text-center p-2">Date</th>
                                                <th class="text-center p-2">Invoice</th>
                                                <th class="text-center p-2">Payable</th>
                                                <th class="text-center p-2">Paid</th>
                                                <th class="text-center p-2">Balance</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th class="text-center p-2">Total</th>
                                                <th class="text-end px-3" id="supTotalPayable">0.00</th>
                                                <th class="text-end px-3" id="supTotalPaid">0.00</th>
                                                <th class="text-end px-3" id="supTotalDue">0.00</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            `;

                            $("#supplier_details").append(supplier_html);

                            // Destroy existing DataTable if reloading
                            if ($.fn.DataTable.isDataTable('#supplierLedgerTable')) {
                                $('#supplierLedgerTable').DataTable().clear().destroy();
                            }

                            // Initialize DataTable
                            $('#supplierLedgerTable').DataTable({
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
                                        data: 'purchase_id',
                                        render: function (data) {
                                            return data !== null ? data : '';
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
                                    let totalPayable = 0, totalPaid = 0, totalDue = 0;

                                    data.forEach(trx => {
                                        totalPayable += trx.payable_amount !== null ? parseFloat(trx.payable_amount) : 0;
                                        totalPaid += trx.paid_amount !== null ? parseFloat(trx.paid_amount) : 0;
                                        totalDue += trx.revised_due !== null ? parseFloat(trx.revised_due) : 0;
                                    });

                                    // Update footer totals
                                    $('#supTotalPayable').html(`<strong>${totalPayable.toFixed(2)}</strong>`);
                                    $('#supTotalPaid').html(`<strong>${totalPaid.toFixed(2)}</strong>`);
                                    $('#supTotalDue').html(`<strong>${totalDue.toFixed(2)}</strong>`);
                                }
                            });
                        }
                    });
                });
            });
        </script>

@endsection
