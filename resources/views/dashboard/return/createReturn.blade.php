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
                    <div class="col-md-10 offset-md-1" style="margin-top: 45px; ">
                        <div class="card">
                            <div class="card-title">
                                <h4 class="p-3 text-center">Create Product Return</h4>
                                <hr>
                            </div>
                            <div class="card-body">

                                <form action="{{ route('backoffice.store-return') }}" method="post">
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
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="consumer_id">Scan IMEI / Barcode(If Any)</label>
                                                <input id="imei_barcode" placeholder="Click Here To Scan IMEI / Barcode" type="text" name="imei_barcode" class="form-control">
                                                <span class="text-danger">@error('consumer_id'){{ $message }} @enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="consumer_id">Select Consumer</label>
                                                <select class="form-control" id="select_consumer_id" name="consumer_id">

                                                    <option>------Select------</option>
                                                    @foreach($ConsumerLogin as $data)
                                                    <option value="{{$data->login_id}}">{{$data->mobile_no}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger">@error('consumer_id'){{ $message }} @enderror</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="cart_id">Select Cart</label>
                                                <select class="form-control" id="select_cart_id" name="cart_id"></select>
                                                <div data-toggle="modal" data-target="#cartModal" id="cart_view_btn" class="btn btn-primary float-right">View Cart</div>
                                                <!-- Modal -->
                                                <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Cart Details</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div id="cart_view_modal" class="modal-body" style="scroll">

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span class="text-danger">@error('cart_id'){{ $message }} @enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="cart_item_id">Reason of Return</label>
                                                <textarea class="form-control" rows="3" name="reason_of_return" required></textarea>
                                                <span class="text-danger">@error('reason_of_return'){{ $message }} @enderror</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="cart_item_id">Select Cart Item</label>
                                                <select class="form-control" name="cart_item_id[]" id="select_item_id" multiple>

                                                </select>
                                                <span class="text-danger">@error('cart_item_id'){{ $message }} @enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3">
                                            <div class="form-group">
                                                <label for="quantity">Quantity</label>
                                                <input type="number" id="quantity" class="form-control" name="quantity" />
                                                <span class="text-danger">@error('quantity'){{ $message }} @enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3">
                                            <div class="form-group">
                                                <label for="cart_item_id">Total Amount</label>
                                                <input type="number" id="get_total_amount" class="form-control" name="total_amount" />
                                                <span class="text-danger">@error('total_amount'){{ $message }} @enderror</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="cart_item_id">Returnable Amount</label>
                                                <input type="number" id="get_refundAble_amount" class="form-control" name="refundAble_amount" />
                                                <span class="text-danger">@error('refundAble_amount'){{ $message }} @enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="cart_item_id">No RefundAble(Vat)</label>
                                                <input type="number" id="get_non_refundAble" class="form-control" name="non_refundAble" />
                                                <span class="text-danger">@error('non_refundAble'){{ $message }} @enderror</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <a class="btn btn-primary mt-2" class="text-light" href="{{route('backoffice.all-return')}}">Back</a>
                                        <button type="submit" class="btn btn-primary mt-2 float-right">Submit</button>
                                    </div>

                                    <br>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/js/jquery/jquery.slim.min.js')}}" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {

        $('#imei_barcode').on('change', function() {
            var barcode = $(this).val();
            if (barcode) {
                $.ajax({
                    url: 'get-return-cart-with-barcode/' + barcode,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        return;
                        if (data) {
                            $('#select_cart_id').empty();
                            $('#select_item_id').empty();
                            $("#get_total_amount").val('');
                            $("#get_non_refundAble").val('');
                            $("#quantity").val('');
                            $("#get_refundAble_amount").val('');
                            $('#select_cart_id').append('<option hidden>Choose Cart</option>');
                            $.each(data, function(key, value) {
                                $('select[name="cart_id"]').append('<option value="' + value.cart_id + '">' + value.cart_id + '</option>');
                            });
                        } else {
                            $('#select_cart_id').empty();
                        }
                    }
                });
            }
        });

        $('#select_consumer_id').on('change', function() {
            var consumer_id = $(this).val();
            if (consumer_id) {
                $.ajax({
                    url: 'get-return-cart/' + consumer_id,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            $('#select_cart_id').empty();
                            $('#select_item_id').empty();
                            $("#get_total_amount").val('');
                            $("#get_non_refundAble").val('');
                            $("#quantity").val('');
                            $("#get_refundAble_amount").val('');
                            $('#select_cart_id').append('<option hidden>Choose Cart</option>');
                            $.each(data, function(key, value) {
                                $('select[name="cart_id"]').append('<option value="' + value.cart_id + '">' + value.cart_id + '</option>');
                            });
                        } else {
                            $('#select_cart_id').empty();
                        }
                    }
                });
            } else {
                $('#select_cart_id').empty();
            }
        });

        $('#select_cart_id').on('change', function() {

            var cart_id = $(this).val();

            if (cart_id) {
                $.ajax({
                    url: 'get-return-item/' + cart_id,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data) {

                            $('#select_item_id').empty();
                            $('#cart_view_modal').empty();
                            $('#items').empty();
                            var viewHtml = "";
                            viewHtml += '<div class="row px-5 py-3"><div class="col-6">Order No</div><div class="col-6">' + data.cartInfo.cart_id + '</div></div>'
                            viewHtml += '<div class="row px-5 py-3"><div class="col-6">Date</div><div class="col-6">' + data.cartInfo.cart_date + '</div></div>'
                            viewHtml += '<div class="row px-5 py-3"><div class="col-6">Items</div><div class="col-6" id="items"></div></div>'
                            viewHtml += '<div class="row px-5 py-3"><div class="col-6">Total Cart Amount</div><div class="col-6">' + data.cartInfo.total_cart_amount + '</div></div>'
                            viewHtml += '<div class="row px-5 py-3"><div class="col-6">Vat</div><div class="col-6">' + data.cartInfo.vat_amount + '</div></div>'
                            viewHtml += '<div class="row px-5 py-3"><div class="col-6">Discount</div><div class="col-6">' + data.cartInfo.total_discount + '</div></div>'
                            viewHtml += '<div class="row px-5 py-3"><div class="col-6">Payable</div><div class="col-6">' + data.cartInfo.total_payable_amount + '</div></div>'
                            viewHtml += '<div class="row px-5 py-3"><div class="col-6">Paid</div><div class="col-6">' + data.cartInfo.paid_amount + '</div></div>'
                            viewHtml += '<div class="row px-5 py-3"><div class="col-6">Due</div><div class="col-6">' + data.cartInfo.due_amount + '</div></div>'

                            $('#cart_view_modal').append(viewHtml);
                            $.each(data.CartItem, function(key, item) {

                                var checkbox = '<option value="' + item.cart_item_id + '">' + item.barcode + '</option>'
                                $('#select_item_id').append(checkbox);
                                $('#items').append("<p>" + item.barcode + "</p>");
                            });
                        } else {
                            $('#select_item_id').empty();
                        }
                    }
                });
            } else {
                $('#select_item_id').empty();
            }
        });

        $('#select_item_id').on('change', function() {

            var cart_id = "";
            cart_id = $('#select_cart_id').val();
            var item_id = [];
            item_id = $(this).val();

            if (cart_id) {
                $.ajax({
                    url: 'get-return-item/' + cart_id,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        var total_amount;
                        var non_refundAble;
                        var refundAble_amount;
                        var quantity;
                        console.log(data);
                        if (data) {
                            var selected_item_id = [];
                            total_amount = 0;
                            non_refundAble = 0;
                            refundAble_amount = 0;
                            quantity = 0;
                            $.each(data.CartItem, function(key, item) {
                                quantity = item.quantity;
                                $.each(item_id, function(key, item_data) {
                                    if (item_data == item.cart_item_id) {

                                        selected_item_id.push(item_data);
                                        total_amount = Math.floor(total_amount + item.total_price);
                                        non_refundAble = Math.floor(non_refundAble + item.vat);
                                        refundAble_amount = Math.floor(refundAble_amount + item.total_price);

                                    }
                                });

                            });
                        }
                        $("#quantity").val(quantity);
                        $("#get_total_amount").val(total_amount);
                        $("#get_non_refundAble").val(non_refundAble);
                        $("#get_refundAble_amount").val(refundAble_amount);
                    }
                });
            }

        });

        $('#quantity').on('change', function() {
            var cart_id = "";
            cart_id = $('#select_cart_id').val();
            var item_id = [];
            item_id = $('#select_item_id').val();

            if (cart_id) {
                $.ajax({
                    url: 'get-return-item/' + cart_id,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    async: false,
                    success: function(data) {
                        var total_amount;
                        var non_refundAble;
                        var refundAble_amount;
                        var new_quantity;
                        var quantity;
                        new_quantity = $('#quantity').val();

                        if (data) {
                            var selected_item_id = [];
                            total_amount = 0;
                            non_refundAble = 0;
                            refundAble_amount = 0;
                            quantity = 0;
                            $.each(data.CartItem, function(key, item) {
                                quantity = item.quantity;
                                $.each(item_id, function(key, item_data) {

                                    if (item_data == item.cart_item_id) {

                                        selected_item_id.push(item_data);
                                        total_amount = Math.floor(total_amount + item.total_price);
                                        non_refundAble = Math.floor(non_refundAble + item.vat);
                                        refundAble_amount = Math.floor(refundAble_amount + item.total_price);


                                    }
                                });

                            });
                        }
                        $("#get_total_amount").empty();
                        $("#get_total_amount").val((total_amount / quantity) * new_quantity);
                        $("#get_non_refundAble").val(non_refundAble);
                        $("#get_refundAble_amount").val((total_amount / quantity) * new_quantity);
                    }
                });
            }
        });

    });
</script>

@endsection