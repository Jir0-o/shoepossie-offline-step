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
        <!---Start Edit--->

        <div class="main-panel">
            <div class="content-wrapper pb-0">
                <div class="col-12 container">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-5">Supplie Payment (For Due)</h4>

                            <form action="{{route('backoffice.store-supplier-payment')}}" method="post">

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

                                @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif

                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3">Supplier:</label>
                                            <div class="col-sm-9">
                                                <select name="supplier_id" id="supplier_id" class="form-select form-control" required>
                                                    <option selected disabled>-----Select-----</option>
                                                    @foreach($supplier as $data)
                                                    <option value="{{$data->supplier_id}}">{{$data->supplier_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3">Invoice:</label>
                                            <div class="col-sm-9">
                                                <select id="purchase_id" name="purchase_id" class="form-select form-control">

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Amount</label>
                                            <div class="col-sm-9">
                                                <input type="number" name="amount" id="amount" class="form-control" min="1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Payable</label>
                                            <div class="col-sm-9">
                                                <span id="payable"></span>
                                                <hr />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3">Payment Method</label>
                                            <div class="col-sm-9">
                                                <select name="payment_method_id"
                                                    id="payment_method_id" class="form-control">
                                                    <option value="1">Cash</option>
                                                    <option value="2">Bank</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Due Amount</label>
                                            <div class="col-sm-9">
                                                <span id="due_amount"></span>
                                                <hr />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="check">
                                </div>

                                <div class="row mt-5">
                                    <div class="col-12 text-right">
                                        <button type="submit" class="btn btn-primary">Complete</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!---End Edit--->

        <script src="{{asset('assets/js/jquery/jquery.slim.min.js')}}"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
            integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
            integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script type="text/javascript">
            $(document).ready(function() {

                $(document).on('change', '#supplier_id', function(e) {
                    var supplier_id = $(this).val();
                    $.ajax({
                        url: 'ajax-get-sup-invoice/' + supplier_id,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        dataType: "json",
                        success: function(data) {
                            $("#payable").empty();
                            $("#purchase_id").empty();
                            $("#due_amount").empty();

                            $("#purchase_id").append('<option value="" selected>-----Select-----</option>');
                            $.each(data, function(col, purchase) {
                                var shtml = '<option value="' + purchase.purchase_id + '">' + purchase.purchase_id + '</option>';
                                $('#purchase_id').append(shtml);
                            });
                        }
                    });
                });

                $(document).on('change', '#purchase_id', function(e) {
                    var purchase_id = $(this).val();
                    $.ajax({
                        url: 'ajax-get-pur-data/' + purchase_id,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        dataType: "json",
                        success: function(data) {
                            $("#payable").empty();
                            $("#due_amount").empty();
                            $("#payable").append(data.total_payable);
                            $("#due_amount").append(data.due_amount);

                        }
                    });
                });
                $(document).on('change', '#payment_method_id', function(e) {
                    var payment_method_id = $(this).val();
                    $("#check").empty();
                    console.log(payment_method_id);
                    if (payment_method_id == 2) {
                        var chehtml = '<div class="col-md-6"><div class="form-group row"><label class="col-sm-3 col-form-label">Bank Name</label>'
                        chehtml += '<div class="col-sm-9">'
                        chehtml += '<select type="text" name="bank_id" id="bank_id" class="form-control mt-2">'
                        chehtml += '<option selected disabled>----Select----</option>'
                        chehtml += '<option value="1">DBBL</option>'
                        chehtml += '<option value=2>City Bank</option>'
                        chehtml += '</select>'
                        chehtml += '</div></div></div>'
                        chehtml += '<div class="col-md-6"><div class="form-group row"><label class="col-sm-3 col-form-label">Check No</label>'
                        chehtml += '<div class="col-sm-9">'
                        chehtml += '<input type="text" name="cheque_no" id="cheque_no" class="form-control">'
                        chehtml += '</div></div></div>';

                        $("#check").append(chehtml);
                    }
                });

            });
        </script>
        @endsection