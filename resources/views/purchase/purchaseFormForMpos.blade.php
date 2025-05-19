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
                                        <div class="mt-2 h5 text-right">PURCHASE INVOICE</div>
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

                                <form action="{{ route('backoffice.store-purchase-form') }}" method="post"
                                    enctype="multipart/form-data">
                                    @if (Session::get('success'))
                                    <div class="alert alert-success">
                                        {{ Session::get('success') }}
                                    </div>
                                    @endif

                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 card p-2">
                                            <div class="">CATEGORIES</div>
                                            <hr>
                                            <div class="row" style="overflow:scroll; height:200px;"
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
                                                class="form-control" type="text" id="myInput" onkeyup="searchProduct()"
                                                placeholder="Search for Product">
                                            <div class="row" style="overflow:scroll; height:600px;">
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
                                                                    width="60%" class="p-3">Product Name</th>
                                                                <th style="padding: 0.75rem;
                                                                vertical-align: top;
                                                                border-top: 1px solid #dee2e6;"
                                                                    width="40%" class="p-3">Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="sales-cat-wise-items">
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div>PRODUCTS</div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="float-right">{{ date('d-M-Y') }}</div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="p-2" style="overflow:scroll; height:300px;">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="30%">Name</th>
                                                                        <th>Purchase Price</th>
                                                                        <th>Qty</th>
                                                                        <th>SubTotal</th>
                                                                        <th>Actions</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="temp-cart-items" class="clickAction">

                                                                </tbody>

                                                            </table>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12">
                                                    <table class="table table-bordered">
                                                        <tbody id="add_payment_table">
                                                            <tr>
                                                                <td>
                                                                    Purchased <span id="items">0</span> Items Today
                                                                </td>
                                                                <td id="quantity">
                                                                    0
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    SubTotal
                                                                </td>
                                                                <td class="text-center" id="subtotal">
                                                                    0
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    vat
                                                                </td>
                                                                <td class="text-center" id="vat">
                                                                    0
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Discount
                                                                </td>
                                                                <td class="text-center" id="discount">
                                                                    0
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Payable
                                                                </td>
                                                                <td class="text-center" id="Payable">
                                                                    0
                                                                </td>
                                                            </tr>
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
                                                                    Paid Amount
                                                                </td>
                                                                <td>
                                                                    <input class="form-control" id="paid_amount" name="paid_amount"
                                                                        type="text"
                                                                        placeholder="Paid Amount" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Reference No (If Any)
                                                                </td>
                                                                <td>
                                                                    <input class="form-control" name="ref_no"
                                                                        type="text" list="suggesstion-box"
                                                                        id="ref_no"
                                                                        placeholder="Reference No" />

                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>
                                                                    Supplier
                                                                </td>
                                                                <td>
                                                                    <div class="row">
                                                                        <div class="col-md-7 col-lg-7">
                                                                            <select name="supplyer_id"
                                                                                id="supplyer_id" class="form-control">
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-5 col-lg-5">
                                                                            <div class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#exampleModal">
                                                                                <i class="fa fa-plus"></i>
                                                                            </div>
                                                                            <!-- Modal -->
                                                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                <div class="modal-dialog" role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title" id="exampleModalLabel">Add Supplyer</h5>
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                <span aria-hidden="true">&times;</span>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <div class="form-group">
                                                                                                <label for="supplier_name">Supplier Name</label>
                                                                                                <input id="supplier_name" type="text" class="form-control my-2" name="supplier_name" placeholder="Enter Supplier Name" value="{{ old('supplier_name') }}">
                                                                                                <span class="text-danger">@error('supplier_name'){{ $message }} @enderror</span>
                                                                                            </div>

                                                                                            <div class="form-group">
                                                                                                <label for="supplier_address">Supplier Address</label>
                                                                                                <input id="supplier_address" type="text" class="form-control my-2" name="supplier_address" placeholder="Enter Supplier Address" value="{{ old('supplier_address') }}">
                                                                                                <span class="text-danger">@error('supplier_address'){{ $message }} @enderror</span>
                                                                                            </div>

                                                                                            <div class="form-group">
                                                                                                <label for="supplier_contact_person">Supplier Contact Person</label>
                                                                                                <input id="supplier_contact_person" type="text" class="form-control my-2" name="supplier_contact_person" placeholder="Supplier Contact Person" value="{{ old('supplier_contact_person') }}">
                                                                                                <span class="text-danger">@error('supplier_contact_person'){{ $message }} @enderror</span>
                                                                                            </div>

                                                                                            <div class="form-group">
                                                                                                <label for="supplier_contact_no">Supplier Contact No</label>
                                                                                                <input id="supplier_contact_no" type="text" class="form-control my-2" name="supplier_contact_no" placeholder="Supplier Contact No" value="{{ old('supplier_contact_no') }}">
                                                                                                <span class="text-danger">@error('supplier_contact_no'){{ $message }} @enderror</span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                            <button type="button" class="btn btn-primary" data-dismiss="modal" id="save_supplier">Save changes</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Location
                                                                </td>
                                                                <td>
                                                                    <div class="row">
                                                                        <div class="col-md-7 col-lg-7">
                                                                            <select name="store_id"
                                                                                id="store_id" class="form-control">
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-5 col-lg-5">
                                                                            <div class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#LocationModal">
                                                                                <i class="fa fa-plus"></i>
                                                                            </div>
                                                                            <!-- Modal -->
                                                                            <div class="modal fade" id="LocationModal" tabindex="-1" role="dialog" aria-labelledby="LocationModalLabel" aria-hidden="true">
                                                                                <div class="modal-dialog" role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title" id="LocationModalLabel">Add Location</h5>
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                <span aria-hidden="true">&times;</span>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <div class="form-group">
                                                                                                <label for="store_name">Location Name</label>
                                                                                                <input id="store_name" type="text" class="form-control my-2" name="store_name" placeholder="Enter Supplier Name" value="{{ old('store_name') }}">
                                                                                                <span class="text-danger">@error('supplier_name'){{ $message }} @enderror</span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                            <button type="button" class="btn btn-primary" data-dismiss="modal" id="save_location">Save changes</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Notes
                                                                </td>
                                                                <td>
                                                                    <textarea class="form-control" name="notes" id="notes" cols="30" rows="5"></textarea>
                                                                </td>
                                                            </tr>

                                                        </tbody>

                                                    </table>
                                                    <div class="row mt-5">
                                                        <div class="col-6"><a
                                                                href="{{ route('backoffice.delete_purchase_form') }}"
                                                                class="btn btn-danger">Delete</a></div>
                                                        <div class="col-6 text-right">
                                                            <p id="complete_purchase"
                                                                class="btn btn-success">Complete</p>
                                                        </div>
                                                        {{-- <div class="col-6 text-right"><button
                                                                class="btn btn-success">Complete</button></div> --}}
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
            temp_payment_html += '<td>' + data.TempPaymentdata.change_amount + '</td>'
            temp_payment_html += '</tr>'

            $('#temp_payment').append(temp_payment_html);
        }

        //Item Data Helper
        window.ItemDataHelper = function(data) {

            var purchase_html = "";

            if (data.status == true) {
                var i = 1;
                $('#temp-cart-items').empty();

                $.each(data.purchase_data, function(col, purchase) {

                    purchase_html += '<tr>'
                    purchase_html += '<td width="60%"><input type="hidden" name="purchase_id" value="' + purchase.purchase_id + '">' + purchase.product_name + '</td>'
                    purchase_html += '<td width="40%">'
                    purchase_html += '<div type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-' + i + '"><i class="fa fa-plus"></i><span class="ml-2">Add</span></div>'
                    purchase_html += '<div class="modal fade" id="modal-' + i + '" tabindex="-1" role="dialog" aria-labelledby="modal-' + i + 'Title" aria-hidden="true">'
                    purchase_html += '<div class="modal-dialog modal-dialog-centered" role="document">'
                    purchase_html += '<div class="modal-content">'
                    purchase_html += '<div class="modal-header">'
                    purchase_html += '<h4 class="modal-title text-center" id="exampleModalLongTitle">' + purchase.product_name + '</h4>'
                    purchase_html += '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
                    purchase_html += '<span aria-hidden="true">&times;</span>'
                    purchase_html += '</button></div>'
                    purchase_html += '<div class="modal-body">'
                    purchase_html += '<div class="row mt-3"><div class="col-md-12"><div class="input-group"><div class="input-group-prepend">'
                    purchase_html += '<span class="input-group-text bg-primary text-white">Purchase Price</span></div><input name="purchase_price" id="purchase_price-' + i + '" type="text" class="form-control" placeholder="Purchase Price">'
                    purchase_html += '</div></div></div>'
                    purchase_html += '<div class="row mt-3"><div class="col-md-12"><div class="input-group"><div class="input-group-prepend">'
                    purchase_html += '<span class="input-group-text bg-success text-white">WholeSale Price</span></div><input name="wholesale_price" id="wholesale_price-' + i + '" type="text" class="form-control" placeholder="WholeSale Price">'
                    purchase_html += '</div></div></div>'
                    purchase_html += '<div class="row mt-3"><div class="col-md-12"><div class="input-group"><div class="input-group-prepend">'
                    purchase_html += '<span class="input-group-text bg-warning text-white">Sales Price</span></div><input name="sales_price" id="sales_price-' + i + '" type="text" class="form-control" placeholder="Sales Price">'
                    purchase_html += '</div></div></div>'
                    purchase_html += '<div class="row mt-3"><div class="col-md-12"><div class="input-group"><div class="input-group-prepend">'
                    purchase_html += '<span class="input-group-text bg-danger text-white">Quantity</span></div><input name="quantity" id="quantity-' + i + '" type="text" class="form-control" placeholder="Quantity" min="1">'
                    purchase_html += '</div></div></div>'
                    purchase_html += '<div class="row mt-3"><div class="col-md-12"><div class="input-group"><div class="input-group-prepend">'
                    purchase_html += '<span class="input-group-text bg-dark text-white">Discount</span></div><input name="discount" id="discount-' + i + '" type="text" class="form-control" placeholder="Discount">'
                    purchase_html += '</div></div></div>'
                    purchase_html += '<div class="row mt-3"><div class="col-md-12"><div class="input-group"><div class="input-group-prepend">'
                    purchase_html += '<span class="input-group-text text-dark bg-secondary text-white">Vat</span></div><input name="vat" id="vat-' + i + '" type="text" class="form-control" placeholder="Vat">'
                    purchase_html += '</div></div></div>'
                    purchase_html += '<div class="modal-footer"><button purchase_details_id="' + purchase.purchase_details_id + '" modal_id="' + i + '" id="submit_modal" type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button></div>'

                    purchase_html += '</div></div></div></td></tr>'

                    i = i + 1;
                });

            }

            return purchase_html;
        }

        window.ItemListHelper = function(data) {
            var temp_cart_items_html = "";
            if (data.status == true) {
                var i = 1000;
                $('#temp-cart-items').empty();
                $.each(data.cart_temporary_data, function(col, temp_cart_item) {
                    var product_image = temp_cart_item.product_image.split(",")[0];
                    temp_cart_items_html += "<tr class='py-3' value='" + temp_cart_item
                        .temp_purchase_id + "'>"
                    temp_cart_items_html +=
                        "<td class='p-3' width='40%'><input i='" + i++ +
                        "' id='temp_cart_id' name='temp_cart_id' type='hidden' value='" +
                        temp_cart_item
                        .purchase_temporary_id + "'/>"
                    temp_cart_items_html += temp_cart_item.product_name
                    temp_cart_items_html += "</td>"
                    temp_cart_items_html +=
                        "<td class='p-3 text-right' ><a id='sales_sales_price'>" +
                        temp_cart_item
                        .purchase_price + "</a></td>"
                    temp_cart_items_html += "<td class='p-3 text-right' ><a id='sales_quantity" +
                        i +
                        "' value='" +
                        temp_cart_item.purchase_price + "'>" + temp_cart_item.quantity +
                        "</a></td>"
                    temp_cart_items_html += "<td class='p-3 text-right' ><a id='sales_quantity" +
                        i +
                        "' value='" +
                        temp_cart_item.purchase_price + "'>" + temp_cart_item.temp_net_amount +
                        "</a></td>"
                    temp_cart_items_html += "<td>"
                    temp_cart_items_html += "<a class='mr-2' value='" + temp_cart_item
                        .temp_purchase_id +
                        "' id='delete_tempcart'><i class='fa fa-trash' aria-hidden='true'></i><a/>"
                    temp_cart_items_html += "<a type='button' data-toggle='modal' data-target='#editmodal-" + i + "' value='" + temp_cart_item
                        .temp_purchase_id +
                        "' id='edit_tempPayment'><i class='fa fa-edit' aria-hidden='true'></i><a/>"
                    temp_cart_items_html += '<div class="modal fade" id="editmodal-' + i + '" tabindex="-1" role="dialog" aria-labelledby="editmodal-' + i + 'Title" aria-hidden="true">'
                    temp_cart_items_html += '<div class="modal-dialog modal-dialog-centered" role="document">'
                    temp_cart_items_html += '<div class="modal-content">'
                    temp_cart_items_html += '<div class="modal-header">'
                    temp_cart_items_html += '<h4 class="modal-title text-center" id="exampleModalLongTitle">' + temp_cart_item
                        .product_name + '<input type="hidden" id="product_id-' + i + '" value="' + temp_cart_item.product_id + '" /></h4>'
                    temp_cart_items_html += '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
                    temp_cart_items_html += '<span aria-hidden="true">&times;</span>'
                    temp_cart_items_html += '</button></div>'
                    temp_cart_items_html += '<div class="modal-body">'
                    temp_cart_items_html += '<div class="row mt-3"><div class="col-md-12"><div class="input-group"><div class="input-group-prepend">'
                    temp_cart_items_html += '<span class="input-group-text bg-primary text-white">Purchase Price</span></div><input value="' + temp_cart_item.purchase_price + '" name="purchase_price" id="purchase_price-' + i + '" type="text" class="form-control" placeholder="Purchase Price">'
                    temp_cart_items_html += '</div></div></div>'
                    temp_cart_items_html += '<div class="row mt-3"><div class="col-md-12"><div class="input-group"><div class="input-group-prepend">'
                    temp_cart_items_html += '<span class="input-group-text bg-success text-white">WholeSale Price</span></div><input value="' + temp_cart_item.wholesale_price + '" name="wholesale_price" id="wholesale_price-' + i + '" type="text" class="form-control" placeholder="WholeSale Price">'
                    temp_cart_items_html += '</div></div></div>'
                    temp_cart_items_html += '<div class="row mt-3"><div class="col-md-12"><div class="input-group"><div class="input-group-prepend">'
                    temp_cart_items_html += '<span class="input-group-text bg-warning text-white">Sales Price</span></div><input value="' + temp_cart_item.sales_price + '" name="sales_price" id="sales_price-' + i + '" type="text" class="form-control" placeholder="Sales Price">'
                    temp_cart_items_html += '</div></div></div>'
                    temp_cart_items_html += '<div class="row mt-3"><div class="col-md-12"><div class="input-group"><div class="input-group-prepend">'
                    temp_cart_items_html += '<span class="input-group-text bg-danger text-white">Quantity</span></div><input value="' + temp_cart_item.quantity + '" name="quantity" id="quantity-' + i + '" type="text" class="form-control" placeholder="Quantity" min="1">'
                    temp_cart_items_html += '</div></div></div>'
                    temp_cart_items_html += '<div class="row mt-3"><div class="col-md-12"><div class="input-group"><div class="input-group-prepend">'
                    temp_cart_items_html += '<span class="input-group-text bg-dark text-white">Discount</span></div><input value="' + temp_cart_item.discount + '" name="discount" id="discount-' + i + '" type="text" class="form-control" placeholder="Discount">'
                    temp_cart_items_html += '</div></div></div>'
                    temp_cart_items_html += '<div class="row mt-3"><div class="col-md-12"><div class="input-group"><div class="input-group-prepend">'
                    temp_cart_items_html += '<span class="input-group-text text-dark bg-secondary text-white">Vat</span></div><input value="' + temp_cart_item.vat / temp_cart_item.quantity + '" name="vat" id="vat-' + i + '" type="text" class="form-control">'
                    temp_cart_items_html += '</div></div></div>'
                    temp_cart_items_html += '<div class="modal-footer"><button purchase_details_id="" modal_id="' + i + '" id="submit_modal" type="button" class="btn btn-warning" data-dismiss="modal">Update changes</button></div>'
                    temp_cart_items_html += '</div></div></div>'
                    temp_cart_items_html += "</td>"
                    temp_cart_items_html += "</tr>"
                });

                $('#items').empty();
                $('#Payable').empty();
                $('#subtotal').empty();
                $('#discount').empty();
                $('#total').empty();
                $('#paid').empty();
                $('#due').empty();
                $('#vat').empty();
                $('#quantity').empty();

            }

            return temp_cart_items_html;
        }


        window.ItemTransactionHelper = function(data) {


            $('#items').empty();
            $('#Payable').empty();
            $('#subtotal').empty();
            $('#discount').empty();
            $('#total').empty();
            $('#paid').empty();
            $('#due').empty();
            $('#vat').empty();
            $('#quantity').empty();


            $('#items').append(data.transaction_data.items);
            $('#quantity').append(data.transaction_data.quantity);
            $('#subtotal').append(data.transaction_data.subtotal);
            $('#discount').append(data.transaction_data.discount_amount);
            $('#Payable').append(data.transaction_data.total_payable);
            $('#paid').append(data.transaction_data.paid_amount);
            $('#due').append(data.transaction_data.due_amount);
            $('#vat').append(data.transaction_data.vat);
            $('#paid_amount').attr("value", data.transaction_data.due_amount);
            $('#paid_amount').attr("temp_cart_id", data.transaction_data.temp_cart_id);

            return console.log(data.transaction_data);
        }

        // Ajax To Show Category

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

        // Ajax To Fetch and Show Sub Category

        $(document).on('click', '#sales-category', function(e) {
            var category_id = $(this).attr('value');
            $('#sales-cat-wise-items').empty();
            $('#all-sub-category').empty();
            $.ajax({
                url: 'purchase-sub-category/' + category_id,
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

        $(document).on('click', '#get-sales-subcategory', function(e) {
            var sc_one_id = $(this).attr('value');
            $('#sales-cat-wise-items').empty();
            $.ajax({
                url: "purchase-cat-wise-items/" + sc_one_id,
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(data) {
                    var i = 1;
                    $.each(data, function(col, categoryWiseItem) {

                        var product_html = '<tr class="p-3">'
                        product_html += '<td width="70%" class="p-2">'
                        product_html += categoryWiseItem.product_name
                        product_html += '<input type="hidden" id="product_id-' + i + '" value="' + categoryWiseItem.product_id + '" />'
                        product_html += '</td>'
                        product_html += '<td class="p-2">'
                        product_html += '<div type="button" class="btn btn-social-icon btn-outline-facebook" data-toggle="modal" data-target="#modal-' + i + '"><i class="fa fa-plus mt-3"></i></div>'
                        product_html += '<div class="modal fade" id="modal-' + i + '" tabindex="-1" role="dialog" aria-labelledby="modal-' + i + 'Title" aria-hidden="true">'
                        product_html += '<div class="modal-dialog modal-dialog-centered" role="document">'
                        product_html += '<div class="modal-content">'
                        product_html += '<div class="modal-header">'
                        product_html += '<h4 class="modal-title text-center" id="exampleModalLongTitle">' + categoryWiseItem.product_name + '</h4>'
                        product_html += '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
                        product_html += '<span aria-hidden="true">&times;</span>'
                        product_html += '</button></div>'
                        product_html += '<div class="modal-body">'
                        product_html += '<div class="row mt-3"><div class="col-md-6">Purchase Price<div class="input-group">'
                        product_html += '<input name="purchase_price" id="purchase_price-' + i + '" type="text" class="form-control" placeholder="Purchase Price">'
                        product_html += '</div></div>'
                        product_html += '<div class="col-md-6">WholeSale Price<div class="input-group">'
                        product_html += '<input name="wholesale_price" id="wholesale_price-' + i + '" type="text" class="form-control" placeholder="WholeSale Price">'
                        product_html += '</div></div>'
                        product_html += '<div class="col-md-6">Sales Price<div class="input-group">'
                        product_html += '<input name="sales_price" id="sales_price-' + i + '" type="text" class="form-control" placeholder="Sales Price">'
                        product_html += '</div></div>'
                        product_html += '<div class="col-md-6">Quantity<div class="input-group">'
                        product_html += '<input name="quantity" id="quantity-' + i + '" type="text" class="form-control" placeholder="Quantity">'
                        product_html += '</div></div>'
                        product_html += '<div class="modal-footer"><button purchase_details_id="" modal_id="' + i + '" id="submit_modal" type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button></div>'

                        product_html += '</div></div></div></td>'

                        i = i + 1;
                        product_html += '</tr>'

                        $('#sales-cat-wise-items').append(product_html);
                    });
                }
            });

        });

        $(document).on('click', '#complete_purchase', function(e) {
            e.preventDefault();
            var temp_cart_id = $("#temp_cart_id").val();
            if (!temp_cart_id) {
                swal("List is Empty!!", "Error", "error");
                return;
            }
            var payment_type_id = $("#payment_type_id").val();
            var paid_amount = $("#paid_amount").val();
            if (!paid_amount) {
                swal("Paid Amount is Empty!!", "Error", "error");
                return;
            }
            if (paid_amount < 0) {
                swal("Paid Amount is Invalid!!", "Error", "error");
                return;
            }
            var ref_no = $("#ref_no").val();
            var store_id = $("#store_id").val();
            var supplyer_id = $("#supplyer_id").val();
            var notes = $("#notes").val();
            var cheque_no = $("#cheque_no").val();
            var bank_id = $("#bank_id").val();
            var Payable = $("#Payable").text();
            var due = Payable - paid_amount;

            if (!(due <= 0)) {

                if (!supplyer_id) {
                    swal("Please Select Supplier!!", "Error", "error");
                    return;
                }

            }

            $.ajax({
                url: '{{ route('
                backoffice.store - purchase - form ') }}',
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "temp_cart_id": temp_cart_id,
                    "payment_type_id": payment_type_id,
                    "paid_amount": paid_amount,
                    "ref_no": ref_no,
                    "store_id": store_id,
                    "supplyer_id": supplyer_id,
                    "notes": notes,
                    "cheque_no": cheque_no,
                    "bank_id": bank_id
                },
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    if (data.status == false) {
                        swal("Invalid Paid Amount", "Validation Error", "error");
                        return;
                    }
                    if (data.temp_cart_id_error == false) {
                        swal("List is Empty", "Validation Error", "error");
                        return;
                    }
                    if (data.store_id_error == false) {
                        swal(data.error, "Validation Error", "error");
                        return;
                    }
                    swal("Product Purchased Successfully ", "Success", "success");
                    $('#temp-cart-items').empty();
                    $('#temp-cart-id').val('');
                    $('#items').empty();
                    $('#Payable').empty();
                    $('#subtotal').empty();
                    $('#discount').empty();
                    $('#total').empty();
                    $('#paid').empty();
                    $('#due').empty();
                    $('#vat').empty();
                    $("#cheque_no").val('');
                    $('#quantity').empty();
                    $("#paid_amount").val('');
                    $("#ref_no").val('');
                    $("#notes").val('');
                    $('#supplier_name').val('');
                    $('#supplier_address').val('');
                    $('#supplier_contact_person').val('');
                    $('#supplier_contact_no').val('');
                    $('#store_name').val('');
                    GetSupplierDataHelper();
                    GetLocationDataHelper();

                }
            });
        });

        $(document).on('click', '#submit_modal', function(e) {
            e.preventDefault();
            var modal_id = $(this).attr('modal_id');
            var sales_price = $('#sales_price-' + modal_id).val();
            var wholesale_price = $('#wholesale_price-' + modal_id).val();
            var quantity = $('#quantity-' + modal_id).val();
            var purchase_price = $('#purchase_price-' + modal_id).val();
            var discount = $('#discount-' + modal_id).val();
            var vat = $('#vat-' + modal_id).val();
            var product_id = $('#product_id-' + modal_id).val();
            var temp_cart_id = $("#temp_cart_id").val();
            var msg;
            if (temp_cart_id) {
                msg = temp_cart_id;
            } else {
                msg = false;
            }

            if (!purchase_price) {
                swal("Please set purchase price", "Validation Error", "error");
                return;
            }
            if (!quantity) {
                swal("Please set quantity", "Validation Error", "error");
                return;
            } else if (quantity < 0) {
                swal("Quantity Should Be Positive", "Fail", "error");
                return;
            }

            if (discount < 0) {
                swal("Discount Should Be Positive", "Fail", "error");
                return;
            }

            if (sales_price < 0 || wholesale_price < 0 || purchase_price < 0) {
                swal("Price Should Be Positive", "Fail", "error");
                return;
            }
            if (vat < 0) {
                swal("Vat Should Be Positive", "Fail", "error");
                return;
            }



            $.ajax({
                url: '{{ route('
                backoffice.store - purchase - product - data ') }}',
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "purchase_price": purchase_price,
                    "sales_price": sales_price,
                    "wholesale_price": wholesale_price,
                    "quantity": quantity,
                    "discount": discount,
                    "vat": vat,
                    "product_id": product_id,
                    "msg": msg
                },
                dataType: "json",
                success: function(data) {
                    $('#temp-cart-items').append(ItemListHelper(data));
                    ItemTransactionHelper(data);
                }
            });
        });

        $(document).on('click', '#sales-product-item', function(e) {
            var product_id = $(this).attr('value');
            var temp_cart_id = $("#temp_cart_id").val();
            var msg;
            if (temp_cart_id) {
                msg = temp_cart_id;
            } else {
                msg = false;
            }
            $('#add-sales-items-to-temp').empty();
            $.ajax({
                url: "add-purchased-items-to-temp/" + product_id + '/' + msg,
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(data) {
                    $('#temp-cart-items').append(ItemDataHelper(data));
                    // ItemTransactionHelper(data);
                }
            });

        });

        window.GetSupplierDataHelper = function() {
            $.ajax({
                url: "ajax-get-supplyer",
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(data) {
                    $('#supplyer_id').empty();
                    $('#supplyer_id').append('<option selected disabled>Select</option>');

                    $.each(data, function(col, mobile) {
                        var shtml = '<option value="' + mobile.supplier_id + '">' + mobile.supplier_name + '</option>';
                        $('#supplyer_id').append(shtml);
                    });
                }
            });
        }
        GetSupplierDataHelper();

        window.GetLocationDataHelper = function() {
            $.ajax({
                url: "ajax-get-location",
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(data) {
                    $('#store_id').empty();
                    $('#store_id').append('<option selected disabled>Select</option>');

                    $.each(data, function(col, mobile) {
                        var shtml = '<option value="' + mobile.store_id + '">' + mobile.store_name + '</option>';
                        $('#store_id').append(shtml);
                    });
                }
            });
        }
        GetLocationDataHelper();

        var SESSION = {
            "LoggedUser": "<?php echo session()->get('LoggedUser'); ?>",
        };
        var login_id = SESSION.LoggedUser;
        $.ajax({
            url: "get_purchase_temp_cart_data/" + login_id,
            type: "GET",
            data: {
                "_token": "{{ csrf_token() }}"
            },
            dataType: "json",
            success: function(data) {
                $('#temp-cart-items').append(ItemListHelper(data));
                ItemTransactionHelper(data);
            }
        });

        $(document).on('click', '#save_supplier', function(e) {
            e.preventDefault();

            var supplier_name = $('#supplier_name').val();
            var supplier_address = $('#supplier_address').val();
            var supplier_contact_person = $('#supplier_contact_person').val();
            var supplier_contact_no = $('#supplier_contact_no').val();

            $.ajax({
                url: 'ajax-store-supplier-data',
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "supplier_name": supplier_name,
                    "supplier_address": supplier_address,
                    "supplier_contact_person": supplier_contact_person,
                    "supplier_contact_no": supplier_contact_no,
                },
                dataType: "json",
                success: function(data) {
                    $('#supplyer_id').empty();
                    $('#supplyer_id').append('<option selected disabled>Select</option>');

                    $.each(data, function(col, mobile) {
                        var shtml = '<option value="' + mobile.supplier_id + '">' + mobile.supplier_name + '</option>';
                        $('#supplyer_id').append(shtml);
                    });
                }
            });
        });

        $(document).on('click', '#save_location', function(e) {
            e.preventDefault();

            var store_name = $('#store_name').val();

            $.ajax({
                url: 'ajax-store-location-data',
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "store_name": store_name,
                },
                dataType: "json",
                success: function(data) {
                    $('#store_id').empty();
                    $('#store_id').append('<option selected disabled>Select</option>');

                    $.each(data, function(col, mobile) {
                        var shtml = '<option value="' + mobile.store_id + '">' + mobile.store_name + '</option>';
                        $('#store_id').append(shtml);
                    });
                }
            });
        });

        $(".clickAction").on('change', '#sales_quantity', function(e) {
            var data_id = "";
            var sales_price = ""
            var sales_quantity = $(this).val();
            var sales_price = $(this).attr('sales_sales_price');
            var temp_cart_item_id = $(this).attr('temp_cart_item_id');
            var data_id = $(this).attr('data');
            $("#" + data_id).empty()
            $.ajax({
                url: "purchase_price_calculation/" + temp_cart_item_id + "/" + sales_quantity + "/" +
                    sales_price,
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    var new_sales = data.cart_temporary_item.temp_net_amount;
                    $("#" + data_id).append(new_sales);
                    ItemTransactionHelper(data);
                }
            });

        });

        $(".clickAction").on('click', '#delete_tempcart', function(e) {
            e.preventDefault();
            var temp_purchase_id = $(this).attr('value');
            $.ajax({
                url: "delete_purchase_temp_cart_item/" + temp_purchase_id,
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(data) {
                    $('#temp-cart-items').append(ItemListHelper(data));
                    ItemTransactionHelper(data);
                }
            });
        });

        $(".clickAction").on('click', '#edit_tempPayment', function(e) {
            e.preventDefault();
            var temp_purchase_id = $(this).attr('value');
            $.ajax({
                url: "edit_purchase_temp_cart_item/" + temp_purchase_id,
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    // $('#temp-cart-items').append(ItemListHelper(data));
                    // ItemTransactionHelper(data);
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
                mfd += '<span id="balance" class="float-right"></span>'
                mfd += '<select id="bank_id" placeholder="Bank Name" type="text" id="bank_id" class="form-control mt-2" name="bank_id">S</select>'
                mfd += '</span>'

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

            var abd = "";
            abd += "<option selected disabled>---------Select---------</option>"
            $.ajax({
                url: '{{ route('
                backoffice.ajax - all - bank ') }}',
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(data) {
                    $.each(data, function(col, bank) {
                        abd += '<option value="' + bank.bank_id + '">' + bank.bank_name + '</option>'
                    });
                    $("#bank_id").append(abd);
                }
            });

            $("#bank_id").on("change", function() {
                $("#balance").empty();
                $.ajax({
                    url: 'ajax-get-balance/' + $(this).val(),
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        $("#balance").append(data);
                    }
                });
            });

        });

    });

    // Function For Search Products
    function searchProduct() {
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