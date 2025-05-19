@extends('layouts.layout')
@section('content')
<style>
    .sidebar {
        max-height: 100vh;
        overflow-y: auto;
    }  
    .sidebar::-webkit-scrollbar {
        width: 4px;
        background: transparent;
        display: none;
    }  
    .sidebar::-webkit-scrollbar-thumb {
        width: 4px;
        background: #0ea12e;
    }  
    .select2-selection.select2-selection--single {
        padding: 0;
    }
    .flex-box-container {
        display: flex;
        height: calc(100vh - 105px);
        flex-direction: column;
    }
    .product-list {
        flex: 1 1 auto;
    }
    select.form-control:focus {
        background-color: #fff;
        color: #363636;
    }
    .btn-danger {
        background-color: #ee0606;
    }
    .form-control:focus {
        background-color: #fff;
        color: #363636;
    }
</style>

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
            <form id="puchase_form" method="post"
                enctype="multipart/form-data">
                @if (Session::get('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif

                @csrf
                <div class="row p-3 pb-0">
                    <div class="col-md-6">
                        <div class="flex-box-container">
                            <div class="select-product bg-dark text-white p-2 mb-3">
                                <div class="row align-items-end">
                                    <div class="col-md-3">
                                        <div class="form-group m-0">
                                            <label for="product_material_id">Select Product</label>
                                            <select required class="form-control select2-plugin" name="product_material_id" id="product_material_id">
                                                <option selected disabled>-----Select-----</option>
                                                @foreach ($productMaterials as $productMaterial)
                                                <option value="{{$productMaterial->product_material_id}}">{{$productMaterial->product_material_name}}({{$productMaterial->foot_ware_categories_name}})({{$productMaterial->type_name}})({{$productMaterial->material_type_name}})({{$productMaterial->brand_type_name}})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group m-0">
                                            <label for="article">Article</label>
                                            <input type="number" required class="form-control py-2" name="article" id="article" placeholder="Enter Article Number">                                
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group m-0">
                                            <label for="colors">Colors</label>
                                            <select required class="form-control select2-plugin" name="color[]" id="colors" multiple="multiple">
                                                <option disabled>Please Select Any</option>
                                                @foreach ($colors as $color)
                                                    <option value="{{$color->colors_id}}">{{$color->colors_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group m-0">
                                            <label for="size">Size</label>
                                            <select required class="form-control select2-plugin" name="size[]" id="sizes" multiple="multiple">
                                                <option disabled>Please Select Any</option>
                                                @foreach ($sizes as $size)
                                                    <option value="{{$size->size_id}}">{{$size->size_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group m-0 d-flex flex-column">
                                            <div class="btn btn-primary" id="add_product">
                                                Add
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-list card p-2">
                                <h4>Products</h4>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="bg-dark text-white">
                                            <tr>
                                                <th class="p-2 text-center">S.N</th>
                                                <th class="p-2 text-center">Code</th>
                                                <th class="p-2 text-center">Qty</th>
                                                <th class="p-2 text-center">Pur. Price</th>
                                                <th class="p-2 text-center">Whl. Price</th>
                                                <th class="p-2 text-center">Sale Price</th>
                                                <th class="p-2 text-center">Discount</th>
                                                <th class="p-2 text-center">Vat</th>
                                                <th class="p-2 text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="code-view" class="">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-md-6">
                                    <button class="btn btn-danger w-100">Delete</button>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-warning w-100">Hold Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bg-dark text-white d-flex justify-content-between align-items-center p-2">
                            <h4 class="m-0">
                                Purchase Information of (Item: <span id="items">0</span> & Quantity: <span id="quantity">0</span>) 
                            </h4>
                            <small>{{ date('d-m-Y') }}</small>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <strong>Sub-total</strong>
                            <h5 id="subtotals"></h5>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <strong>Discount</strong>
                            <h5 id="discount"></h5>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <strong>vat</strong>
                            <h5 id="vat"></h5>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <strong>Payable</strong>
                            <h5 id="Payable"></h5>
                        </div>
                        <h4>Payment Details</h4>
                        <div class="form-group">
                            <label for="payment_type_id">Payment Type</label>
                            <select name="payment_type_id" required
                                id="payment_type_id" class="form-control">
                                <option selected value="1">Cash</option>
                                <option value="2">Bank</option>
                                <option value="3">Others</option>
                            </select>
                        </div>
                        <div class="d-flex">
                            <div id="type_wise"></div>
                            <div id="checque_no"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="paid_amount">Paid Amount</label>
                                    <input class="form-control" id="paid_amount" name="paid_amount" type="text" placeholder="Paid Amount">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ref_no">Reference No (If Any)</label>
                                    <input class="form-control" name="ref_no" type="text" list="suggesstion-box" id="ref_no" placeholder="Reference No">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="batch">Batch</label>
                                    <input class="form-control" name="batch" type="number" list="suggesstion-box" id="batch" required placeholder="Batch" />                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="supplyer_id">Supplier</label>
                                    <div class="d-flex" style="gap: 12px">
                                        <select name="supplyer_id" id="supplyer_id" class="form-control">
                                        </select>
                                        <div class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#exampleModal">
                                            <i class="fa fa-plus"></i>
                                        </div>   
                                    </div>           
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="supplyer_id">Location</label>
                                    <div class="d-flex" style="gap: 12px">
                                        <select name="store_id" id="store_id" class="form-control">
                                        </select>
                                        <div class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#LocationModal">
                                            <i class="fa fa-plus"></i>
                                        </div>  
                                    </div>           
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="notes">Notes</label>
                                    <textarea class="form-control" name="notes" id="notes" rows="1"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex flex-column">
                                    <button id="complete_purchase" class="btn btn-success m-0" type="submit">Complete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal for supplier Create --}}
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

                {{-- modal for location create --}}
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
            </form>
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
            console.log(getProductID); // product id
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
            console.log(getArticle); // article value
        });

        $(document).on('click', '#add_product', function() {
            // Get values from Select2 multi-selects
            var GetColorsValue = $('#colors').val(); // returns array
            var checkSizesValue = $('#sizes').val(); // returns array

            // Check if colors and sizes are selected
            if (!GetColorsValue || GetColorsValue.length === 0) {
                swal("Error!", "Please select at least one color", 'error');
                return;
            }

            if (!checkSizesValue || checkSizesValue.length === 0) {
                swal("Error!", "Please select at least one size", 'error');
                return;
            }

            // Check if product ID and article are available
            if (!getProductID) {
                swal("Error!", "Please select a product", 'error');
                return;
            }

            if (!getArticleValue) {
                swal("Error!", "Please enter article", 'error');
                return;
            }

            // AJAX call
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
                success: function (response) {
                    var code_view = '';
                    $('#code-view').empty();
                    var i = 1;
                    $.each(response.getCode, function (item, valueOfElement) {
                        code_view += '<tr>';
                        code_view += '<td>' + i + '</td>';
                        code_view += '<td><input type="text" hidden value="' + valueOfElement + '" required name="code[]">' + valueOfElement + '</td>';
                        code_view += '<td><input type="number" class="qty" required name="qty[]" style="width:80px;"></td>';
                        code_view += '<td><input class="form-control purchase_price" name="purchase_price[]" type="text" required placeholder="Purchase Price"/></td>';
                        code_view += '<td><input class="form-control" name="wholeSell_price[]" type="text" required placeholder="WholeSell Price"/></td>';
                        code_view += '<td><input class="form-control" name="sales_price[]" type="text" required placeholder="Sales Price"/></td>';
                        code_view += '<td><input class="form-control discount" name="discount[]" type="text" placeholder="Discount"/></td>';
                        code_view += '<td><input class="form-control vat" name="vat[]" type="text" placeholder="Vat" style="width:70px;"/></td>';
                        code_view += '</tr>';
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