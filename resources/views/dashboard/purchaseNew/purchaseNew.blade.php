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

                                <form id="puchase_form" method="post"
                                    enctype="multipart/form-data">
                                    @if (Session::get('success'))
                                    <div class="alert alert-success">
                                        {{ Session::get('success') }}
                                    </div>
                                    @endif

                                    @csrf

                                    <div class="row">
                                        <div class="col-md-4 col-lg-4 card p-2">

                                            <div class="">PRODUCTS</div>
                                            <hr>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Select Product(Cat)(Type)(Material)(Brand)</label>
                                                <select required="" class="form-control mt-2 select2-plugin" name="product_material_id" id="product_material_id">
                                                    <option value="" selected="true" disabled="disabled">-----------Select----------</option>
                                                    @foreach ($productMaterials as $productMaterial)
                                                    <option value="{{$productMaterial->product_material_id}}">{{$productMaterial->product_material_name}}({{$productMaterial->foot_ware_categories_name}})({{$productMaterial->type_name}})({{$productMaterial->material_type_name}})({{$productMaterial->brand_type_name}})</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Article</label>
                                                <input type="number" min="0" required class="form-control" name="article" id="article" placeholder="Enter Article Number">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p>Color</p>
                                                    <table>
                                                        @php
                                                        $i = 1
                                                        @endphp
                                                        <tbody>
                                                            @foreach ($colors as $color)
                                                            <tr>
                                                                <td><input value="{{$color->colors_id}}" type="checkbox" name="color[]" class="checkboxonly-{{$i}} colors"></td>
                                                                <td>{{$color->colors_name}}</td>
                                                            </tr>
                                                            @php
                                                            $i++;
                                                            @endphp
                                                            @endforeach


                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>Size</p>
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <table>
                                                                @php
                                                                $l = 1;
                                                                @endphp
                                                                <tbody>

                                                                    @foreach ($sizes as $size)
                                                                    <tr>
                                                                        <td><input value="{{$size->size_id}}" type="checkbox" name="size[]" class="checkboxSizes-{{$l}} sizes"></td>
                                                                        <td>{{$size->size_name}}</td>
                                                                    </tr>
                                                                    @php
                                                                    $l++;
                                                                    @endphp
                                                                    @endforeach


                                                                </tbody>

                                                            </table>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <table>
                                                                @php
                                                                $g = 11;
                                                                @endphp
                                                                <tbody>

                                                                    @foreach ($sizes_11_20 as $sizes_11_20)
                                                                    <tr>
                                                                        <td><input value="{{$sizes_11_20->size_id}}" type="checkbox" name="size[]" class="checkboxSizes-{{$g}} sizes"></td>
                                                                        <td>{{$sizes_11_20->size_name}}</td>

                                                                    </tr>
                                                                    @php
                                                                    $g++;
                                                                    @endphp
                                                                    @endforeach


                                                                </tbody>

                                                            </table>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <table>
                                                                @php
                                                                $a = 21;
                                                                @endphp
                                                                <tbody>

                                                                    @foreach ($sizes_21_30 as $sizes_21_30)
                                                                    <tr>
                                                                        <td><input value="{{$sizes_21_30->size_id}}" type="checkbox" name="size[]" class="checkboxSizes-{{$a}} sizes"></td>
                                                                        <td>{{$sizes_21_30->size_name}}</td>
                                                                    </tr>
                                                                    @php
                                                                    $a++;
                                                                    @endphp
                                                                    @endforeach


                                                                </tbody>

                                                            </table>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <table>
                                                                @php
                                                                $b = 31;
                                                                @endphp
                                                                <tbody>

                                                                    @foreach ($sizes_31_40 as $sizes_31_40)
                                                                    <tr>
                                                                        <td><input value="{{$sizes_31_40->size_id}}" type="checkbox" name="size[]" class="checkboxSizes-{{$b}} sizes"></td>
                                                                        <td>{{$sizes_31_40->size_name}}</td>
                                                                    </tr>
                                                                    @php
                                                                    $b++;
                                                                    @endphp
                                                                    @endforeach


                                                                </tbody>

                                                            </table>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <table>
                                                                @php
                                                                $c = 41;
                                                                @endphp
                                                                <tbody>

                                                                    @foreach ($sizes_41_unli as $sizes_41_unli)
                                                                    <tr>
                                                                        <td><input value="{{$sizes_41_unli->size_id}}" type="checkbox" name="size[]" class="checkboxSizes-{{$c}} sizes"></td>
                                                                        <td>{{$sizes_41_unli->size_name}}</td>
                                                                    </tr>
                                                                    @php
                                                                    $c++;
                                                                    @endphp
                                                                    @endforeach


                                                                </tbody>

                                                            </table>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
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
                                                                        <th>S.N</th>
                                                                        <th width="30%">Code</th>
                                                                        <th>Qty</th>
                                                                        <th>Purchase Price</th>
                                                                        <th>WholeSale Price</th>
                                                                        <th>Sales Price</th>
                                                                        <th>Discount</th>
                                                                        <th>Vat</th>
                                                                        {{-- <th>Actions</th> --}}
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="code-view" class="">
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
                                                                <td class="text-center" id="quantity">
                                                                    0
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    SubTotal
                                                                </td>
                                                                <td class="text-center" id="subtotals">
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
                                                                    <select name="payment_type_id" required
                                                                        id="payment_type_id" class="form-control">
                                                                        <option selected value="1">Cash</option>
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
                                                                    <input class="form-control" id="paid_amount" name="paid_amount" type="text" placeholder="Paid Amount">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Reference No (If Any)
                                                                </td>
                                                                <td>
                                                                    <input class="form-control" name="ref_no" type="text" list="suggesstion-box" id="ref_no" placeholder="Reference No">

                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Batch
                                                                </td>
                                                                <td>
                                                                    <input class="form-control" name="batch"
                                                                        type="text" list="suggesstion-box"
                                                                        id="batch"
                                                                        required
                                                                        placeholder="Batch" />
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
                                                                href="{{ route('backoffice.purchaseNew') }}"
                                                                class="btn btn-danger">Delete</a></div>
                                                        <div class="col-6 text-right"><button type="submit" id="complete_the_purchase"
                                                                class="btn btn-success">Complete</button></div>
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
     crossorigin="anonymous">
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.select2-plugin').select2();
        var getProductID;
        var getArticleValue;
        $('#product_material_id').change(function(e) {
            e.preventDefault();
            var getvalue = $('#product_material_id').val();
            getProductID = getvalue;

        });

        // $('#article').keydown(function (e) {
        //     e.preventDefault();
        //     var getArticle =  $('#article').val();
        //     getArticleValue =getArticle;
        //     console.log(getArticle);
        // });

        $('#article').change(function(e) {
            var getArticle = $('#article').val();
            getArticleValue = getArticle;
            // console.log(getArticle);
        });

        var GetColorsValue = [];
        $(document).on('click', '.colors', function() {
            var i = 1;
            var checkedValues = [];
            // console.log( getProductID);
            $('.colors').each(function() {
                var isCheak = $('.checkboxonly-' + i).is(':checked');

                if (isCheak) {
                    var value = $('.checkboxonly-' + i).val();
                    checkedValues.push(value);
                }
                i++;
            })
            if (!checkedValues.length > 0) {
                swal("Error!", "Please Check At List One Item In Colors", 'error');
                return;
            }
            // console.log(getProductID);
            if (!getProductID) {
                swal("Error!", "Please Select Product", 'error');
                return;
            }
            if (!getArticleValue) {
                swal("Error!", "Please Enter Article", 'error');
                return;
            }
            // console.log(checkedValues);
            GetColorsValue = checkedValues;
        });


        $(document).on('click', '.sizes', function() {
            var checkSizesValue = [];
            var l = 1;
            $('.sizes').each(function() {
                var isCheakSizes = $('.checkboxSizes-' + l).is(':checked');

                if (isCheakSizes) {
                    var sizeValue = $('.checkboxSizes-' + l).val();
                    checkSizesValue.push(sizeValue);
                }
                l++;
            })
            if (!checkSizesValue.length > 0) {
                swal("Error!", "Please Check At List One Item In Sizes", 'error');
                return;
            }
            if (!getProductID) {
                swal("Error!", "Please Select Product", 'error');
                return;
            }
            if (!getArticleValue) {
                swal("Error!", "Please Enter Article", 'error');
                return;
            }

            // console.log(GetColorsValue); 
            // console.log(checkSizesValue);
            $.ajax({
                url: "getProductNew",
                method: "GET",
                data: {
                    'GetColorsValue': GetColorsValue,
                    'checkSizesValue': checkSizesValue,
                    'getProductID': getProductID,
                    'getArticleValue': getArticleValue,
                },
                dataType: "json",
                success: function(response) {
                    var code_view = '';
                    $('#code-view').empty();
                    var i = 1;
                    // console.log(response.getCode);
                    $.each(response.getCode, function(item, valueOfElement) {
                        code_view += '<tr>'
                        code_view += '<td>' + i + '</td>'
                        code_view += '<td><input type="text" hidden value="' + valueOfElement + '"  required name="code[]">' + valueOfElement + '</td>'
                        code_view += '<td><input type="number" class="qty" required name="qty[]" style="width:80px;"></td>'
                        code_view += '<td><input class="form-control purchase_price"   name="purchase_price[]" type="text" required placeholder="Purchase Price"/></td>'
                        code_view += '<td><input class="form-control" id="wholeSell_price" name="wholeSell_price[]" type="text" required placeholder="WholeSell Price"/></td>'
                        code_view += '<td><input class="form-control" name="sales_price[]" type="text" list="suggesstion-box" id="sales_price" required placeholder="Sales Price"/></td>'
                        code_view += '<td><input class="form-control discount" name="discount[]" type="text" list="suggesstion-box"  placeholder="Discount"/></td>'
                        code_view += '<td><input class="form-control vat" name="vat[]" type="text" list="suggesstion-box"   placeholder="Vat" style="width:70px;"/></td>'
                        // code_view+='<td><a class="btn btn-danger">Delete</a></td>'
                        code_view += '</tr>'
                        i++;
                    });
                    $('#code-view').append(code_view);


                }
            });

        });
        //Qunatity Count And Get Qunatity Value
        var getQtyGlobal = [];
        $(document).on('change', '.qty', function() {
            // console.log('Hello');
            var getQty = [];
            let totalQunatity = 0;
            let i = 0;
            $('#quantity').empty();
            $('.qty').each(function() {
                var value = $(this).val();
                if (value) {
                    getQty.push(parseInt(value));
                    totalQunatity += parseInt(value);
                    i++;
                }
            })
            $('#items').text(i);
            $('#quantity').text(totalQunatity);
            getQtyGlobal = getQty;
        });
        //Get Sub Total
        $(document).on('change', '.purchase_price', function() {
            var getPurchasePrice = [];
            let subTotal = 0;
            let i = 0;
            $('#subtotals').empty();
            $('.purchase_price').each(function() {
                var value = $(this).val();
                if (value) {
                    getPurchasePrice.push(parseInt(value));
                    if (getQtyGlobal[i]) {
                        subTotal += getQtyGlobal[i] * parseInt(value);
                        i++;
                    } else {
                        subTotal += 0 * parseInt(value);
                        i++;
                    }

                }

            });
            $('#subtotals').text(subTotal)
            TotalPayable();
        })

        //Get Total Discount

        $(document).on('change', '.discount', function() {
            // console.log('Hello');
            var getDiscount = [];
            let totalDiscount = 0;
            let i = 0;
            $('#discount').empty();
            $('.discount').each(function() {
                var value = $(this).val();
                if (value) {
                    getDiscount.push(parseInt(value));
                    totalDiscount += parseInt(value);
                    i++;
                }
            })
            $('#discount').text(totalDiscount);
            TotalPayable();
        });

        // Get Total vat

        $(document).on('change', '.vat', function() {
            var getVat = [];
            let TotalVat = 0;
            let i = 0;
            $('#vat').empty();
            $('.vat').each(function() {
                var value = $(this).val();
                if (value) {
                    getVat.push(parseInt(value));
                    TotalVat += getQtyGlobal[i] * parseInt(value);
                    i++;
                }

            });
            $('#vat').text(TotalVat);
            TotalPayable();
        })
        //Total Payable
        TotalPayable();

        function TotalPayable() {
            var GetTotalPayable = parseInt($('#subtotals').text()) + parseInt($('#discount').text()) + parseInt($('#vat').text());
            $('#Payable').text(GetTotalPayable);
            $('#paid_amount').val(GetTotalPayable);
        }





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
            abd += "<option selected  disabled>---------Select---------</option>"
            $.ajax({
                url: '{{ route('backoffice.ajax-all-bank') }}',
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(data) {
                    $.each(data, function(col, bank) {
                        abd += '<option  value="' + bank.bank_id + '">' + bank.bank_name + '</option>'
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

        $('#puchase_form').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            // console.log(formData);
            var supplyer_id = $("#supplyer_id").val();
            var paid_amount = $("#paid_amount").val();
            var Payable = $("#Payable").text();
            if (!paid_amount) {
                swal("Paid Amount is Empty!!", "Error", "error");
                return;
            }
            if (paid_amount < 0) {
                swal("Paid Amount is Invalid!!", "Error", "error");
                return;
            }

            var due = Payable - paid_amount;

            if (!(due <= 0)) {

                if (!supplyer_id) {
                    swal("Please Select Supplier!!", "Error", "error");
                    return;
                }

            }

            $.ajax({
                url: "store-Purchase",
                method: "POST",
                data: formData,
                dataType: "json",
                success: function(response) {
                    // console.log(response.request);
                    // swal("Good Job!", response.success, 'success');
                    swal({
                        title: "Good Job!",
                        text: response.success,
                        icon: 'success',
                        button: "Ok"
                    }).then(function() {
                        window.location.reload();
                    });
                    // location.reload();
                    // setTimeout(() => {
                    //     window.location.reload()
                    // }, 5000);
                }
            });
        });

    });
</script>
@endsection