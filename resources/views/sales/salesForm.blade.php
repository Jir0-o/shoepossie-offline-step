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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12" style="margin-top: 10px;">
                        <div class="card">
                            <div>
                                <div class="row pt-3 px-3">
                                    <div class="col-md-6">
                                        <div class="mt-2 h5 text-right">SALES INVOICE</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mt-2 float-right">
                                            <select class="p-2 form-control" name="suspended_items"
                                                id="suspended_items">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" style="overflow-x:scroll;">

                                <form action="{{ route('backoffice.store-sales') }}" method="post"
                                    enctype="multipart/form-data">
                                    @if (Session::get('success'))
                                    <div class="alert alert-success">
                                        {{ Session::get('success') }}
                                    </div>
                                    @endif

                                    @csrf

                                    <div class="row">
                                        <div class="col-md-7 card p-2">
                                            <div class="">CATEGORIES</div>
                                            <hr>
                                            <div class="row" style="overflow:scroll; height:250px;"
                                                id="all-category"></div>
                                            <hr />
                                            <div class="">SUB CATEGORIES</div>
                                            <hr>
                                            <div class="row" style="overflow:scroll; height:200px;"
                                                id="all-sub-category"></div>
                                            <hr />
                                            <div class="">PRODUCTS</div>
                                            <hr>
                                            <input
                                                style="padding-right: 25px;
                                                background: url('https://static.thenounproject.com/png/101791-200.png') no-repeat right;
                                                background-size: 20px;"
                                                class="form-control" type="text" id="myInput" onkeyup="test()"
                                                placeholder="Search for Product">
                                            <div class="row" style="overflow:scroll; height:70%;">
                                                <div class="col-12">
                                                    <table id="myTable"
                                                        style="width: 100%;
                                                        margin-bottom: 1rem;
                                                        color: #212529;">
                                                        <thead>
                                                            <tr class="p-3">
                                                                <th style="padding: 0.75rem;
                                                                    vertical-align: top;
                                                                    border-top: 1px solid #dee2e6;"
                                                                    width="40%" class="p-3">Product Name</th>
                                                                <th style="padding: 0.75rem;
                                                                    vertical-align: top;
                                                                    border-top: 1px solid #dee2e6;"
                                                                    width="20%" class="p-3">Location</th>
                                                                <th style="padding: 0.75rem;
                                                                    vertical-align: top;
                                                                    border-top: 1px solid #dee2e6;"
                                                                    width="20%" class="p-3">In Stock</th>
                                                                <th style="padding: 0.75rem;
                                                                    vertical-align: top;
                                                                    border-top: 1px solid #dee2e6;"
                                                                    width="25%" class="p-3" id="type_name">Sales Price</th>
                                                                <th style="padding: 0.75rem;
                                                                    vertical-align: top;
                                                                    border-top: 1px solid #dee2e6;"
                                                                    width="10%" class="p-3">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="sales-cat-wise-items">
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div>ORDERS</div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="float-right">{{ date('d-M-Y') }}</div>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row mt-3">
                                                                <div class="col-3">Scan Barcode </div>
                                                                <div class="col-9">
                                                                    <input class="form-control" name="barcode"
                                                                        type="text" id="barcode"
                                                                        placeholder="Barcode" value="" />
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="col-3">Sales Type</div>
                                                                <div class="col-9">
                                                                    <select class="form-control" name="sales_type"
                                                                        type="text" id="sales_type">
                                                                        <option value="1" selected>Retail</option>
                                                                        <option value="2">Whole Sale</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <p class="pt-3 pl-3">SELLED ITEMS</p>
                                                        <div class="p-2" style="overflow:scroll; height:300px;">
                                                            <table>
                                                                <thead>
                                                                    <tr class="py-3">
                                                                        <th class="p-3" width="40%">Product</th>
                                                                        <th class="p-3" width="10%">Price
                                                                        </th>
                                                                        <th class="p-3" width="30%">Qty</th>
                                                                        <th class="p-3" width="10%">Total
                                                                        </th>
                                                                        <th class="p-3" width="10%"></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="temp-cart-items" class="clickAction">

                                                                </tbody>

                                                            </table>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <p class="pt-3 pl-2">TRANSACTION DETAILS</p>
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <td>
                                                                        Quantity of <span id="no_of_items"></span>
                                                                        Items
                                                                    </td>
                                                                    <td id="total_quantity">
                                                                    </td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <p class="card-text">Subtotal</p>
                                                                    </td>
                                                                    <td id="subtotal" class="text-right pr-2">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <p class="card-text">Vat</p>
                                                                    </td>
                                                                    <td id="vat" class="text-right pr-2">

                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Discount
                                                                    </td>
                                                                    <td id="discount" class="text-right pr-2">0</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Payable</td>
                                                                    <td id="total" class="text-right pr-2"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Paid Amount
                                                                    </td>
                                                                    <td id="paid" class="text-right pr-2"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Due Amount
                                                                    </td>
                                                                    <td id="due" class="text-right pr-2"></td>
                                                                </tr>
                                                            </tbody>

                                                        </table>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row py-3" id="hide_suspense">
                                                <div class="col-12">
                                                    <div class="btn btn-warning float-right p-2" id="add_suspense">
                                                        Suspend
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <td>
                                                                    Customer Mobile No
                                                                </td>
                                                                <td>
                                                                    <input
                                                                        class="form-control"
                                                                        name="mobile_no"
                                                                        type="text"
                                                                        placeholder="Customer Mobile No" required />
                                                                </td>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="add_payment_table">
                                                            <tr>
                                                                <td>
                                                                    Payment Type
                                                                </td>
                                                                <td>
                                                                    <select name="payment_method_id"
                                                                        id="payment_type_id" class="form-control">
                                                                        <option value="1">Cash</option>
                                                                        <option value="2">Bank</option>
                                                                        <option value="3">Others</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr id="type_wise"></tr>
                                                            <tr id="checque_no"></tr>
                                                            <tr>
                                                                <td>
                                                                    Discount
                                                                </td>
                                                                <td>
                                                                    <input class="form-control" type="text"
                                                                        id="disc" name="discount"
                                                                        min="1">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Paid Amount
                                                                </td>
                                                                <td>
                                                                    <input class="form-control" type="text"
                                                                        id="paid_amount" name="paid_amount"
                                                                        min="1">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>

                                                                </td>
                                                                <td class="text-right" id="sales_payment_add_button">
                                                                    <div class="btn btn-primary" id="add_payment">Add
                                                                        Payment</div>
                                                                </td>
                                                            </tr>

                                                        </tbody>

                                                    </table>

                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th></th>
                                                                <th>Type</th>
                                                                <th>Payable</th>
                                                                <th>Paid</th>
                                                                <th>Due</th>
                                                                <th>Change</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="temp_payment">

                                                        </tbody>
                                                    </table>

                                                    <div class="row mt-5">
                                                        <div class="col-6"><a
                                                                href="{{ route('backoffice.delete_sales_form') }}"
                                                                class="btn btn-danger">Delete</a></div>
                                                        <div class="col-6 text-right"><button
                                                                class="btn btn-success">Complete</button></div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>

                            </div>
                            </form>
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
        $('body').addClass('sidebar-icon-only');

        window.TempTransactionHelper = function(data) {
            $('#discount').empty();
            $('#total').empty();
            $('#paid').empty();
            $('#due').empty();
            $('#vat').empty();

            $('#discount').append(data.TempPaymentdata.discount_amount);
            $('#total').append(data.TempPaymentdata.total_payable);
            $('#paid').append(data.TempPaymentdata.paid_amount);
            $('#due').append(data.TempPaymentdata.due_amount);
            $('#vat').append(data.TempPaymentdata.vat);
        }

        window.TempPaymentHtmlHelper = function(data) {

            $('#sales_payment_add_button').empty();
            var temp_payment_html = '<tr>'
            temp_payment_html += '<td>'
            temp_payment_html += '<a cart_temporary_payment_id="' + data.TempPaymentdata
                .cart_temporary_payment_id +
                '" id="delete_temp_payment"><i class="fa fa-trash" aria-hidden="true"></i><a>'
            temp_payment_html += '</td>'
            temp_payment_html += '<td>' + data.TempPaymentdata.payment_method_id + '</td>'
            temp_payment_html += '<td>' + data.TempPaymentdata.total_payable + '</td>'
            temp_payment_html += '<td>' + data.TempPaymentdata.paid_amount + '</td>'
            temp_payment_html += '<td>' + data.TempPaymentdata.due_amount + '</td>'
            if (data.TempPaymentdata.change_amount < 0) {
                temp_payment_html += '<td>0</td>'
            } else {
                temp_payment_html += '<td>' + data.TempPaymentdata.change_amount + '</td>'
            }
            temp_payment_html += '</tr>'

            $('#temp_payment').append(temp_payment_html);
        }

        window.ItemDataHelper = function(data) {

            var temp_cart_items_html = "";

            if (data.status == true) {
                var i = 1;
                $('#temp-cart-items').empty();
                $.each(data.cart_temporary_data, function(col, temp_cart_item) {
                    var product_image = temp_cart_item.product_image.split(",")[0];
                    temp_cart_items_html += "<tr class='py-3' value='" + temp_cart_item
                        .temp_cart_item_id + "'>"
                    temp_cart_items_html +=
                        "<td class='p-3' width='40%'><input i='" + i++ +
                        "' id='temp_cart_id' name='temp_cart_id' type='hidden' value='" +
                        temp_cart_item
                        .temp_cart_id + "'/>"
                    temp_cart_items_html += temp_cart_item.product_name
                    temp_cart_items_html += "</td>"
                    if (data.sales_type == 1) {
                        temp_cart_items_html += "<td class='p-3' width='10%'><a id='sales_sales_price'>" + temp_cart_item.sales_price + "</a></td>"
                        temp_cart_items_html += "<td class='p-3' width='30%' class='text-right'>"
                        temp_cart_items_html += "<input class='form-control text-right'sales_sales_price='" +
                            temp_cart_item.sales_price + "' temp_cart_item_id='" + temp_cart_item
                            .temp_cart_item_id + "' data='sales_quantity" + i + "' value='" +
                            temp_cart_item.quantity +
                            "' type='text' id='sales_quantity' name='quantity' min='1'>"
                        temp_cart_items_html += "</td>"
                    } else if (data.sales_type == 2) {
                        temp_cart_items_html += "<td class='p-3' width='10%'><a id='sales_sales_price'>" + temp_cart_item.wholesale_price + "</a></td>"
                        temp_cart_items_html += "<td class='p-3' width='30%'>"
                        temp_cart_items_html += "<input class='form-control'sales_sales_price='" +
                            temp_cart_item.wholesale_price + "' temp_cart_item_id='" + temp_cart_item
                            .temp_cart_item_id + "' data='sales_quantity" + i + "' value='" +
                            temp_cart_item.quantity +
                            "' type='text' id='sales_quantity' name='quantity' min='1'>"
                        temp_cart_items_html += "</td>"
                    }

                    temp_cart_items_html += "<td class='p-3' width='10%'><a id='sales_quantity" +
                        i +
                        "' value='" +
                        temp_cart_item.sales_price + "'>" + temp_cart_item.temp_net_amount +
                        "</a></td>"
                    temp_cart_items_html += "<td width='10%'>"
                    temp_cart_items_html += "<a value='" + temp_cart_item
                        .temp_cart_item_id +
                        "' id='delete_tempcart'><i class='fa fa-trash' aria-hidden='true'></i><a/>"
                    temp_cart_items_html += "</td>"
                    temp_cart_items_html += "</tr>"
                });

                $('#no_of_items').empty();
                $('#total_quantity').empty();
                $('#subtotal').empty();
                $('#discount').empty();
                $('#total').empty();
                $('#paid').empty();
                $('#due').empty();
                $('#vat').empty();

            }

            return temp_cart_items_html;
        }


        window.ItemTransactionHelper = function(data) {


            $('#no_of_items').empty();
            $('#total_quantity').empty();
            $('#subtotal').empty();
            $('#discount').empty();
            $('#total').empty();
            $('#paid').empty();
            $('#due').empty();
            $('#vat').empty();


            $('#no_of_items').append(data.transaction_data.items);
            $('#total_quantity').append(data.transaction_data.quantity);
            $('#subtotal').append(data.transaction_data.subtotal);
            $('#discount').attr("value", data.transaction_data.total_discount);
            $('#total').append(data.transaction_data.total_payable);
            $('#paid').append(data.transaction_data.paid_amount);
            $('#due').append(data.transaction_data.due_amount);
            $('#vat').append(data.transaction_data.vat);
            $('#paid_amount').attr("value", data.transaction_data.due_amount);
            $('#paid_amount').attr("temp_cart_id", data.transaction_data.temp_cart_id);
            $('#disc').val(data.transaction_data.total_discount);

            return console.log(data.transaction_data);
        }

        //-------- Fetch All categery with Ajax---------
        $.ajax({
            url: '{{ route('
            backoffice.get - ajax - category ') }}',
            type: "GET",
            data: {
                "_token": "{{ csrf_token() }}"
            },
            dataType: "json",
            success: function(data) {
                $.each(data, function(col, category) {
                    var catImage = category.sample_image;
                    var category_html = '<div class="col-3 col-lg-3 col-md-3 mb-1">'
                    category_html += '<a value="' + category.category_id +
                        '" id="sales-category" class="btn">'
                    category_html +=
                        '<img height="70px" width="75px" src="{{ asset('
                    backend / images / CategoryWise / ') }}' +
                        '/' + catImage + '" alt="' + catImage + '">'
                    category_html += '<div>'
                    category_html += '<div>' + category.category_name + '</div>'
                    category_html += '</a></div></div>'


                    $('#all-category').append(category_html);
                });



            }
        });

        //--------Fetch Category Sub Category ----------
        $(document).on('click', '#sales-category', function(e) {
            var category_id = $(this).attr('value');
            $('#sales-cat-wise-items').empty();
            $('#all-sub-category').empty();
            $.ajax({
                url: 'sales-sub-category/' + category_id,
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(data) {
                    $.each(data, function(col, category) {
                        var catImage = category.sc_one_image;
                        var category_html = '<div class="col-3 col-lg-3 col-md-3 mb-1">'
                        category_html += '<a value="' + category.sc_one_id +
                            '" id="get-sales-subcategory" class="btn">'
                        category_html +=
                            '<img height="70px" width="75px" src="{{ asset('
                        backend / images / CategoryWise / ') }}' +
                            '/' + catImage + '" alt="' + catImage + '">'
                        category_html += '<div>'
                        category_html += '<div>' + category.sc_one_name + '</div>'
                        category_html += '</a></div></div>'
                        $('#all-sub-category').append(category_html);
                    });
                }
            });
        });
        //--------Fetch Category Wise Items With Ajax ----------
        $(document).on('click', '#get-sales-subcategory', function(e) {
            var sc_one_id = $(this).attr('value');
            var sales_type = $("#sales_type").val();
            $('#sales-cat-wise-items').empty();
            $.ajax({
                url: "sales-cat-wise-items/" + sc_one_id,
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(data) {
                    $.each(data, function(col, categoryWiseItem) {
                        var product_html = "<tr class='p-3'>"
                        product_html += "<td width='40%' class='p-3'>"
                        product_html += categoryWiseItem.product_name
                        product_html += "</td>"
                        product_html += "<td width='20%' class='p-3'>"
                        product_html += categoryWiseItem.store_name
                        product_html += "</td>"
                        product_html += "<td width='20%' class='p-3'>"
                        product_html += categoryWiseItem.final_quantity
                        product_html += "</td>"
                        if (sales_type == 1) {
                            product_html += "<td width='25%' class='p-3'>"
                            product_html += categoryWiseItem.sales_price
                            product_html += "</td>"
                        } else if (sales_type == 2) {
                            product_html += "<td width='25%' class='p-3'>"
                            product_html += categoryWiseItem.wholesale_price
                            product_html += "</td>"
                        }
                        product_html += "<td width='10%' class='p-3'>"
                        product_html += "<a product_id='" + categoryWiseItem.product_id + "' stock_id='" + categoryWiseItem.stock_id + "' id='sales-product-item' value='" +
                            categoryWiseItem.purchase_details_id +
                            "' class='btn btn-success'>add</a>"
                        product_html += "</td>"
                        product_html += "</tr>"

                        $('#sales-cat-wise-items').append(product_html);
                    });
                }
            });

        });

        //-------- Fetch Sub Categery with Category Id---------
        $(document).on('click', '#sales-subcat', function(e) {
            var sc_one_id = $(this).attr('value');
            console.log(sc_one_id);
            $('#sales-cat-wise-items').empty();
            $.ajax({
                url: "sales-cat-wise-items/" + sc_one_id,
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(data) {
                    $.each(data, function(col, categoryWiseItem) {

                        var product_html = "<tr class='p-3'>"
                        product_html += "<td width='50%' class='p-3'>"
                        product_html += categoryWiseItem.product_name
                        product_html += "</td>"
                        product_html += "<td class='p-3'>"
                        product_html += categoryWiseItem.sales_price
                        product_html += "</td>"
                        product_html += "<td class='p-3'>"
                        product_html += "<a id='sales-product-item' value='" +
                            categoryWiseItem.product_id +
                            "' class='btn btn-success'>add</a>"
                        product_html += "</td>"
                        product_html += "</tr>"

                        $('#sales-cat-wise-items').append(product_html);
                    });
                }
            });

        });

        //-------- Add Product To Temp Cart---------
        $(document).on('click', '#sales-product-item', function(e) {

            var purchase_details_id = $(this).attr('value');
            var stock_id = $(this).attr('stock_id');
            var product_id = $(this).attr('product_id');
            var temp_cart_id = $("#temp_cart_id").val();
            var sales_type = $("#sales_type").val();
            var msg;

            if (temp_cart_id) {
                msg = temp_cart_id;
            } else {
                msg = false;
            }
            $('#add-sales-items-to-temp').empty();
            $.ajax({
                url: '{{ route('backoffice.add-sales-items-to-temp')}}',
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "purchase_details_id": purchase_details_id,
                    "stock_id": stock_id,
                    "temp_cart_id": temp_cart_id,
                    "sales_type": sales_type,
                    "product_id": product_id,
                    "msg": msg
                },
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    if (data.stock_error == true) {
                        swal(data.message, data.in_stock + ' Products Available', 'error');
                        return;
                    }

                    $('#temp-cart-items').append(ItemDataHelper(data));
                    ItemTransactionHelper(data);
                }
            });

        });

        //-------- Fetch Temp Cart Data On Reload---------
        var SESSION = {
            "LoggedUser": "<?php echo session()->get('LoggedUser'); ?>",
        };
        var login_id = SESSION.LoggedUser;
        var st = $("#sales_type").val();
        $.ajax({
            url: "get_sales_temp_cart_data/" + login_id + "/" + st,
            type: "GET",
            data: {
                "_token": "{{ csrf_token() }}"
            },
            dataType: "json",
            success: function(data) {
                $('#temp-cart-items').append(ItemDataHelper(data));
                ItemTransactionHelper(data);
                if (data.IsPaymentExists) {
                    TempPaymentHtmlHelper(data);
                    TempTransactionHelper(data);
                }

            }
        });
        //--------End Fetch Temp Cart Data On Reload---------

        //-------- Adjust Price On Sales Type Change---------
        $(document).on('change', '#sales_type', function(e) {
            e.preventDefault();
            var sales_type_id = $(this).val();
            var temp_cart_id = $("#temp_cart_id").val();
            $('#sales-cat-wise-items').empty();
            var msg;
            if (temp_cart_id) {
                msg = temp_cart_id;
            } else {
                msg = false;
            }

            if (sales_type_id == 2) {
                $("#type_name").empty();
                $("#type_name").append("Wholesale Price");
            } else {
                $("#type_name").empty();
                $("#type_name").append("Sales Price");
            }

            $.ajax({
                url: "sales-type-wise-price/" + sales_type_id + '/' + msg,
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(data) {
                    $('#temp-cart-items').append(ItemDataHelper(data));
                    ItemTransactionHelper(data);
                }
            });
        });

        //-------- Adjust Price On Sales Quantity Change---------
        $(".clickAction").on('change', '#sales_quantity', function(e) {
            var data_id = "";
            var sales_price = ""
            var sales_quantity = $(this).val();

            var sales_price = $(this).attr('sales_sales_price');
            var temp_cart_item_id = $(this).attr('temp_cart_item_id');
            var data_id = $(this).attr('data');
            var sales_type = $("#sales_type").val();
            $("#" + data_id).empty()
            if (sales_quantity <= 0) {
                swal("Qnt Should Be Grater Then Zero", "Fail", "error");
                $('#no_of_items').empty();
                $('#total_quantity').empty();
                $('#subtotal').empty();
                $('#discount').empty();
                $('#total').empty();
                $('#paid').empty();
                $('#due').empty();
                $('#vat').empty();
                $('#paid_amount').attr("value", 0);
                $('#disc').attr("value", 0);
                return;
            } else {
                $.ajax({
                    url: "price_calculation/" + temp_cart_item_id + "/" + sales_quantity + "/" +
                        sales_price + "/" + sales_type,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        var new_sales = data.cart_temporary_item.temp_net_amount;
                        $("#" + data_id).append(new_sales);
                        ItemTransactionHelper(data);
                    }
                });
            }

        });


        //-------- change paid amount on discount change ---------
        $(document).on('blur', '#disc', function(e) {
            var paid_amount = $('#paid_amount').val();
            var discount = $(this).val();
            var subtotal = $('#subtotal').text();
            var vat = $('#vat').text();
            if (discount < 0) {
                swal("Discount Should Be Positive", "Fail", "error");
                return;
            } else if (discount > (parseInt(subtotal) + parseInt(vat))) {
                swal("Discount Amount Can Not Exceed The Payable Amount", "Fail", "error");
                return;
            } else if (/%$/.test(discount)) {
                var getDiscountValue = parseFloat(discount) / 100; //input value  value =  0.1/100 = 0.1

                var dis = parseInt(subtotal) * getDiscountValue;
                $('#paid_amount').attr("value", parseInt(subtotal) + parseInt(vat) - dis);
            } else {
                $('#paid_amount').attr("value", parseInt(subtotal) + parseInt(vat) - discount);
            }


        });

        //-------- Delete Temp Cart ---------
        $(".clickAction").on('click', '#delete_tempcart', function(e) {
            e.preventDefault();
            var temp_cart_item_id = $(this).attr('value');
            var sales_type = $("#sales_type").val();
            $.ajax({
                url: "delete_sales_temp_cart_item/" + temp_cart_item_id + "/" + sales_type,
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(data) {
                    $('#temp-cart-items').append(ItemDataHelper(data));
                    ItemTransactionHelper(data);
                }
            });
        });



        //-------- Create Temp Payment ---------
        $(document).on('click', '#add_payment', function(e) {

            e.preventDefault();
            var paid_amount = $('#paid_amount').val();
            var discount = $('#disc').val();
            var subtotal = $('#subtotal').text();
            if (/%$/.test(discount)) {
                var getDiscountValue = parseFloat(discount) / 100; //input value  value =  0.1/100 = 0.1
                var dis = parseInt(subtotal) * getDiscountValue;
                discount = dis;
            }
            var vat = $('#vat').text();


            if (!discount) {
                discount = 0;
            }
            //check negative value
            else if (discount < 0) {
                swal("Discount Should Be Positive", "Fail", "error");
                return;
            } else if (discount > (parseInt(subtotal) + parseInt(vat))) {
                swal("Discount Amount Can Not Exceed The Payable Amount", "Fail", "error");
                return;
            }

            if (paid_amount < 0) {
                swal("Paid Amount Should Be Positive", "Fail", "error");
                return;
            }
            var payment_type_id = $('#payment_type_id').val();
            var bank_name = $('#bank_name').val();
            var cheque_no = $('#cheque_no').val();
            var transaction_no = $('#transaction_no').val();
            if (payment_type_id == 2) {
                if (!bank_name) {
                    swal('Bank name field is Required !!', 'Validation Error', 'error');
                    return;
                }
                if (!cheque_no) {
                    swal('Cheque No field is Required !!', 'Validation Error', 'error');
                    return;
                }
            } else if (payment_type_id == 3) {
                if (!transaction_no) {
                    swal('Transaction No field is Required !!', 'Validation Error', 'error');
                    return;
                }
            }
            var temp_cart_id = $("#paid_amount").attr("temp_cart_id");
            var sales_type = $("#sales_type").val();

            $.ajax({
                url: '{{ route('
                backoffice.store - sales - temp - payment ') }}',
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "paid_amount": paid_amount,
                    "discount": discount,
                    "payment_type_id": payment_type_id,
                    "temp_cart_id": temp_cart_id,
                    "sales_type": sales_type
                },
                dataType: "json",
                success: function(data) {
                    TempPaymentHtmlHelper(data);
                    TempTransactionHelper(data);
                }
            });
        });

        //-------- Suspend a cart ---------
        $(document).on('click', '#add_suspense', function(e) {
            e.preventDefault();

            var temp_cart_id = $("#temp_cart_id").val();
            var waiter_id = 1;
            var sales_type = $("#sales_type").val();
            $.ajax({
                url: "add_suspense/" + temp_cart_id + '/' + waiter_id + '/' + sales_type,
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(data) {

                    GetSuspenseDataHelper();

                    $('#temp-cart-items').empty();
                    $('#no_of_items').empty();
                    $('#total_quantity').empty();
                    $('#subtotal').empty();
                    $('#discount').empty();
                    $('#total').empty();
                    $('#paid').empty();
                    $('#due').empty();
                    $('#vat').empty();
                    $('#paid_amount').attr("value", 0);
                    $('#disc').attr("value", 0);
                    $("#table_no").attr('value', "");
                    $("#barcode").attr('value', null).focus();
                }
            });
        });

        //-------- Fetch All Suspended Items ---------
        window.GetSuspenseDataHelper = function() {
            $.ajax({
                url: "get-suspended-items",
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(data) {
                    $("#suspended_items").empty();
                    $("#suspended_items").append(
                        "<option selected disabled>SUSPENDED ITEMS</option>"
                    );
                    $.each(data.suspend_data, function(col, items) {
                        var suspended_items_html =
                            "<option value='" + items
                            .temp_cart_id +
                            "'>" + items.temp_cart_id +
                            "</option/>";
                        $("#suspended_items").append(
                            suspended_items_html);
                    });
                }
            });
        }
        GetSuspenseDataHelper();

        //-------- Fetch Suspended Item Wise Data ---------
        $(document).on('change', '#suspended_items', function(e) {

            var cart_item_id = $(this).val();
            $("#table_no").attr('value', "");
            $.ajax({
                url: "get_suspended_data/" + cart_item_id,
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    GetSuspenseDataHelper();
                    $('#temp-cart-items').append(ItemDataHelper(data));
                    ItemTransactionHelper(data);
                }
            });

        });

        //-------- Insert Data To temp Cart With barcode------------
        $(document).on('change', '#barcode', function(e) {
            e.preventDefault();
            var barcode = $(this).val();
            var temp_cart_id = $("#temp_cart_id").val();
            var sales_type = $("#sales_type").val();
            var msg;
            if (temp_cart_id) {
                msg = temp_cart_id;
            } else {
                msg = false;
            }
            $('#add-sales-items-to-temp').empty();
            $.ajax({
                url: "add-sales-items-with-barcode/" + barcode + '/' + msg + "/" + sales_type,
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(data) {
                    if (data.barcode_error) {
                        swal(data.message, "Error", "error");
                        return;
                    }
                    $('#temp-cart-items').append(ItemDataHelper(data));
                }
            });
        });

        $(document).on('click', '#delete_temp_payment', function(e) {
            e.preventDefault();
            var cart_temporary_payment_id = $(this).attr("cart_temporary_payment_id");

            $.ajax({
                url: "delete_temporary_payment/" + cart_temporary_payment_id,
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(data) {
                    if (data.deleted) {
                        var add_payment_button =
                            '<div class="btn btn-primary" id="add_payment">Add Payment</div>'
                        $('#sales_payment_add_button').append(add_payment_button);
                        $('#temp_payment').empty();

                        TempTransactionHelper(data);
                    }

                }
            });
        });

        $("#payment_type_id").on("change", function() {
            $("#type_wise").empty();
            $("#checque_no").empty();
            var mode_type = $(this).val();
            var mfd = "";
            var mfc = "";
            if (mode_type == 2) {
                mfd += '<td>Bank Name:</td>'
                mfd += '<td>'
                mfd += '<input placeholder="Bank Name" type="text" id="bank_name" class="form-control mt-2" name="bank_name" />'
                mfd += '</td>'

                mfc += '<td>Checque No</td>'
                mfc += '<td>'
                mfc += '<input placeholder="Checque No" type="text" id="cheque_no" class="form-control mt-2" name="cheque_no"/>'
                mfc += '</td>'
                $("#type_wise").append(mfd);
                $("#checque_no").append(mfc);
            } else if (mode_type == 3) {
                mfd += '<td>Transaction No</td>'
                mfd += '<td>'
                mfd += '<input placeholder="Transaction No" type="text" id="transaction_no" class="form-control mt-2" name="transaction_no"/>'
                mfd += '</td>'

                $("#type_wise").append(mfd);
            }
        });

    });

    function test() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
@endsection