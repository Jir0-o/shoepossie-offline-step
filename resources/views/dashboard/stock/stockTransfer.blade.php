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
            <div class="container">
                <div class="row">
                    <div class="col-md-7 offset-md-1" style="margin-top: 45px; ">
                        <div class="card">
                            <div class="card-title">
                                <h4 id="stock_name" class="p-3 text-center"></h4>
                                <hr>
                            </div>
                            <div class="card-body">

                                <form action="{{ route('backoffice.transfer-stock') }}" method="post">
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
                                    @if (Session::get('error'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('error') }}
                                    </div>
                                    @endif

                                    @csrf
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label for="is_active">Product</label>
                                                <select id="product_id" class="form-control my-2" name="product_id">
                                                    <option selected="true" disabled="disabled">-----------Select----------</option>
                                                    @foreach($products as $values)
                                                    <option value="{{$values->product_material_id }}">{{$values->product_material_name}}</option>
                                                    @endforeach

                                                </select>
                                                <span class="text-danger">@error('is_active'){{ $message }} @enderror</span>
                                            </div>

                                        </div>
                                        <div class="col-sm">
                                            <div class="p-2 float-right">
                                                <span id="from_quantity"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="from-location">From Location</label>
                                                <select id="from_location" class="form-control my-2" name="from_store">
                                                </select>

                                                <span class="text-danger">@error('from_location'){{ $message }} @enderror</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="p-2 float-right">
                                                <span id="to_quantity"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="supplier_address">To Location</label>
                                                <select id="to_location" class="form-control my-2" name="to_store">
                                                </select>
                                                <span class="text-danger">@error('to_location'){{ $message }} @enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label for="transfer_quantity">Quantity</label>
                                                <input type="number" min="1" class="form-control my-2" name="transfer_quantity" placeholder="Transfer Quantity" value="{{ old('transfer_quantity') }}">
                                                <span class=" text-danger">@error ('transfer_quantity'){{ $message }} @enderror</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info mt-2 float-right">Transfer</button>
                                    </div>
                                    <br>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 " style="margin-top: 45px; ">
                        <div class="card">
                            <div class="card-title">
                                <h4 id="stock_name" class="p-3 text-center">Stock</h4>
                                <hr>
                            </div>
                            <div class="card-body">
                                <table id="store-stock" class="table table-striped">
                                </table>
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

<script src="{{asset('assets/js/jquery/jquery.slim.min.js')}}" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#stock_name").append("Stock Transfer");
        var className = $("#stock_name").attr("class");

        $(document).on('change', '#product_id', function(e) {
            e.preventDefault();
            var product_id = $(this).val();

            // from store
            $.ajax({
                url: "p-w-s/" + product_id,
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(data) {
                    $('#to_quantity').empty();
                    $('#from_quantity').empty();
                    $('#from_location').empty();
                    $('#to_location').empty();
                    $('#from_location').append('<option selected disabled> -----Select----- </option>')
                    var fromLocHtml = '';
                    $.each(data, function(key, value) {
                        fromLocHtml += '<option value="' + value.store_id + '"> ' + value.store_name + ' </option>'
                    });
                    $('#from_location').append(fromLocHtml);
                }
            });

            $.ajax({
                url: "p-w-a-q/" + product_id,
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(data) {
                    $('#store-stock').empty();

                    $('#store-stock').append('<thead><tr><th scope="col">Store Name</th><th scope="col">Total Stock</th></tr></thead>')
                    var fromLocHtml = '<tbody>';
                    $.each(data, function(key, value) {
                        fromLocHtml += '<tr><td>' + value.store_name + '</td><td>' + value.final_quantity + '</td></tr>'
                    });
                    fromLocHtml += '</tbody>'
                    $('#store-stock').append(fromLocHtml);
                }
            });


        });

        $(document).on('change', '#from_location', function(e) {
            e.preventDefault();
            var store_id = $(this).val();
            var product_id = $("#product_id").val();





            // to store
            $.ajax({
                url: "p-w-r/" + product_id,
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(data) {

                    $('#to_quantity').empty();
                    $('#from_quantity').empty();
                    $('#to_location').empty();
                    $('#to_location').append('<option selected disabled> -----Select----- </option>')
                    var fromLocHtml = '';
                    $.each(data, function(key, value) {
                        if (store_id != value.store_id) {
                            fromLocHtml += '<option value="' + value.store_id + '"> ' + value.store_name + ' </option>'
                        }
                    });
                    $('#to_location').append(fromLocHtml);
                    $.ajax({
                        url: "p-w-s-d/" + store_id + "/" + product_id,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            $('#from_quantity').empty();
                            $('#from_quantity').append(data.final_quantity);
                        }
                    });
                }
            });

        });
        $(document).on('change', '#to_location', function(e) {
            e.preventDefault();
            var store_id = $(this).val();
            var product_id = $("#product_id").val();



            $.ajax({
                url: "p-w-s-q/" + store_id + "/" + product_id,
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(data) {
                    $('#to_quantity').empty();
                    if (data.final_quantity) {
                        $('#to_quantity').append(data.final_quantity);
                    } else {
                        $('#to_quantity').append(0);
                    }

                }
            });

        });



    });
</script>

@endsection