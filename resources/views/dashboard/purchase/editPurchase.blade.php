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
                    <div class="col-md-12" style="margin-top: 45px; ">
                        <div class="card">
                            <div class="card-title">
                                <h4 class="p-3 text-center">Edit Purchase</h4>
                                <hr>
                            </div>
                            <div class="card-body">
                                @foreach($Purchase as $purchases)
                                <form action="{{ route('backoffice.update-purchase') }}" method="post">
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

                                    <input type="hidden" name="purchase_id" value="{{$purchases->purchase_id}}" />
                                    <input type="hidden" name="purchase_details_id" value="{{$purchases->purchase_details_id}}" />
                                    <input type="hidden" name="stock_id" value="{{$purchases->stock_id}}" />
                                    <div class="row">
                                        <div class="col-12 col-md-8 col-lg-8">
                                            <div class="row">
                                                <div class="col-12 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="product_id">Product Name</label>
                                                        <select class="form-control my-2" name="product_id" id="purchase_edit_product_id" required>
                                                            @foreach($Product as $values)
                                                            @if($purchases->product_id == $values->product_id)
                                                            <option class="text-dark" value="{{$values->product_id}}" selected>{{$values->product_name}}</option>
                                                            @endif
                                                            @endforeach
                                                        </select>
                                                        <span class="text-danger">@error('product_id'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="supplier_id">Select Supplier</label>
                                                        <select class="form-control my-2" name="supplier_id">
                                                            <option selected="true" disabled="disabled">----------Select---------</option>
                                                            @foreach($Supplier as $values)
                                                            <option value="{{$values->supplier_id}}" {{ $purchases->supplier_id == $values->supplier_id ? 'selected' : '' }}>{{$values->supplier_name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="text-danger">@error('supplier_id'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="brand_id">Select Brand</label>
                                                        <select class="form-control my-2" name="brand_id">
                                                            <option selected="true" disabled="disabled">----------Select---------</option>
                                                            @foreach($Brand as $values)
                                                            <option value="{{$values->brand_id}}" {{ $purchases->brand_id == $values->brand_id ? 'selected' : '' }}>{{$values->brand_name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="text-danger">@error('brand_id'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="unit_id">Select Unit Type</label>
                                                        <select class="form-control my-2" name="unit_id">
                                                            <option selected="true" disabled="disabled">----------Select---------</option>
                                                            @foreach($UnitDefinition as $values)
                                                            <option value="{{$values->unit_id}}" {{ $purchases->unit_id == $values->unit_id ? 'selected' : '' }}>{{$values->unit_name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="text-danger">@error('unit_id'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="purchase_price">Purchase Price</label>
                                                        <input required type="number" class="form-control my-2" name="purchase_price" placeholder="Enter Purchase Price" value="{{ $purchases->purchase_price }}">
                                                        <span class="text-danger">@error('purchase_price'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="sales_price">Sales Price</label>
                                                        <input required type="number" class="form-control my-2" name="sales_price" placeholder="Enter Sales Price" value="{{ $purchases->sales_price }}">
                                                        <span class="text-danger">@error('sales_price'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="quantity">Quantity</label>
                                                        <input required type="number" class="form-control my-2" name="quantity" placeholder="Enter Quantity" value="{{ $purchases->quantity }}">
                                                        <span class="text-danger">@error('quantity'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="supply_no">Supply No</label>
                                                        <input required type="text" class="form-control" name="supply_no" placeholder="Enter Supply No" value="{{ $purchases->supply_no}}" />
                                                        <span class="text-danger">@error('supply_no'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="courier_cost">Courier Cost</label>
                                                        <input required type="number" class="form-control" id="courier_cost" name="courier_cost" placeholder="Enter Courier Cost" value="{{ $purchases->courier_cost}}" />
                                                        <span class="text-danger">@error('courier_cost'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="transport_cost">Transport Cost</label>
                                                        <input required type="number" class="form-control" id="transport_cost" name="transport_cost" value="{{ $purchases->transport_cost}}" placeholder="Enter Transport Cost" />
                                                        <span class="text-danger">@error('transport_cost'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="bonus_point">Bonus Point</label>
                                                        <input required type="number" class="form-control" id="bonus_point" name="bonus_point" value="{{ $purchases->bonus_point}}" placeholder="Enter Bonus Point" />
                                                        <span class="text-danger">@error('bonus_point'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="discount">Discount</label>
                                                        <input required type="number" class="form-control" id="discount" name="discount" value="{{ $purchases->discount}}" placeholder="Enter Discount" />
                                                        <span class="text-danger">@error('discount'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div id="edit_textarea-ajax-inputs">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row">
                                                <div class="col-12">
                                                    <div id="edit_checkbox-ajax-inputs">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <div class="h4 text-center">Attribute Section</div>
                                            <div id="edit_purchase_set_attr_input">

                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-warning mt-2">Update</button>
                                        <a class="btn btn-primary mt-2 float-right" class="text-light" href="{{route('backoffice.all-purchase')}}">Back</a>
                                    </div>

                                    <br>
                                </form>
                                @endforeach
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

<script src="{{asset('assets/js/jquery/jquery.slim.min.js')}}" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function() {
        var price = $('#discount').val();
        console.log(price);
        window.k = 1;

        window.Remove = function(kVal) {
            $(document).on('click', '#Remove' + kVal, function() {

                $(this).parents('tr').remove();
            });
        }
        window.passAttribute = function(id) {

            $.ajax({
                url: 'get-ajax-attribute/' + id,
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    $.each(response, function(l, r) {
                        window.name = r.attribute_name;
                    });
                }

            });
            k = k + 1;
            $(document).on('click', '#' + id, function() {

                newhtml = "<tr>"
                newhtml += "<td>"
                newhtml += "<label></label>"
                newhtml += "</td>"
                newhtml += "<td>"
                newhtml += "<input class='form-control' type='text' placeholder='Name' name='" + id + "[]'>"
                newhtml += "</td>"
                newhtml += "<td>"
                newhtml += "<div class='btn btn-danger' onclick='Remove(" + k + ")' id='Remove" + k + "'>"
                newhtml += "<i class='fa-solid fa-minus'></i>"
                newhtml += "</div>"
                newhtml += "</td>"
                newhtml += "</tr>"
                name = "";
                $(this).closest('tbody').append(newhtml);

                newhtml.empty();

            });
            name = "";

        }


        var product_id = $('#purchase_edit_product_id').val();
        console.log(product_id);

        $.ajax({
            url: '{{ asset("backoffice/get-ajax-product")}}' + '/' + product_id,
            type: "GET",
            data: {
                "_token": "{{ csrf_token() }}"
            },
            dataType: "json",
            success: function(data) {
                console.log(data);
                $('#edit_purchase_set_attr_input').empty();
                $('#edit_checkbox-ajax-inputs').empty();
                $('#edit_textarea-ajax-inputs').empty();

                $.each(data, function(col, productData) {
                    var attributeList = productData.attribute_id.split(",");

                    if (attributeList != null) {
                        $.each(attributeList, function(key, attr) {

                            $.ajax({
                                url: '{{ asset("backoffice/edit-purchase-ajax-attribute")}}' + '/' + attr + '/' + product_id,
                                type: "GET",
                                data: {
                                    "_token": "{{ csrf_token() }}"
                                },
                                dataType: "json",
                                success: function(response) {
                                    $.each(response, function(ke, val) {



                                        if (val.attribute_type_name == 'checkbox') {

                                            var json = {
                                                "attribute_id": val.attribute_id,
                                                "attribute_name": val.attribute_name
                                            }

                                            var checkboxhtml = "<table class='table'>"
                                            checkboxhtml += "<tbody>"
                                            checkboxhtml += "<tr>"
                                            checkboxhtml += "<td>"
                                            checkboxhtml += "<label for='" + val.attribute_name + "'>" + val.attribute_name + "</label>"
                                            checkboxhtml += "<input type='hidden' id='" + val.attribute_name + "' value='" + val.attribute_id + "'/>"
                                            checkboxhtml += "</td>"
                                            checkboxhtml += "<td>"
                                            checkboxhtml += "<input required class='form-control' type='text' id='" + val.attribute_id + "_name' value='" + val.attribute_value + "' name='" + val.attribute_id + "[]' placeholder='" + val.attribute_name + " Name'>"
                                            checkboxhtml += "</td>"
                                            checkboxhtml += "<td>"
                                            checkboxhtml += "<a class='btn btn-primary text-light' onclick='passAttribute(" + val.attribute_id + ")' id='" + val.attribute_id + "'>"
                                            checkboxhtml += "<i class='fa-solid fa-plus'></i>"
                                            checkboxhtml += "</a>"
                                            checkboxhtml += "</td>"
                                            checkboxhtml += "</tr>"
                                            checkboxhtml += "</tbody>"
                                            checkboxhtml += "</table>"

                                            $('#edit_checkbox-ajax-inputs').append(checkboxhtml);
                                        } else if (val.attribute_type_name == 'textarea') {
                                            var textareahtml = "<div class='form-group'> <label>" + val.attribute_name + "</label>"
                                            textareahtml += "<textarea required  name='" + val.attribute_id + "' value='" + val.attribute_value + "' class='form-control' type='" + val.attribute_type_name + "' rows='4'></textarea>"
                                            textareahtml += "</div>"
                                            $('#edit_textarea-ajax-inputs').append(textareahtml);
                                        } else {
                                            var html = "<div class='form-group'> <label class='py-2' for='" + val.attribute_name + "'>" + val.attribute_name + "</label>"
                                            html += "<input required type='" + val.attribute_type_name + "' value='" + val.attribute_value + "' name='" + val.attribute_id + "' class='form-control'/>"
                                            html += "</div>"

                                            $('#edit_purchase_set_attr_input').append(html);
                                        }

                                        console.log(val.attribute_type_name);
                                    });
                                }
                            });
                        });
                    }

                });



            }
        });


    });
</script>

@endsection