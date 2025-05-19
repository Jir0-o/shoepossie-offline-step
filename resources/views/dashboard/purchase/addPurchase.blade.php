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
                                <h4 class="p-3 text-center">Purchase Produce</h4>
                                <hr>
                            </div>
                            <div class="card-body">
                                    
                              <form action="{{ route('backoffice.create-purchase') }}" method="post">
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
                                            <label for="ref_no">Reference No (If Any)</label>
                                            <input type="text" class="form-control my-2" name="ref_no" placeholder="Enter Reference No" value="{{ old('ref_no') }}">
                                            <span class="text-danger">@error('ref_no'){{ $message }} @enderror</span>                               
                                        </div>                                     
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="product_id">Select Product</label>
                                            <select class="form-control my-2" name="product_id">
                                                <option selected="true" disabled="disabled">----------Select---------</option>
                                                @foreach($Product as $values)
                                                 <option value="{{$values->product_id}}">{{$values->product_name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('product_id'){{ $message }} @enderror</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="supplier_id">Select Supplier</label>
                                            <select class="form-control my-2" name="supplier_id">
                                                <option selected="true" disabled="disabled">----------Select---------</option>
                                                @foreach($Supplier as $values)
                                                 <option value="{{$values->supplier_id}}">{{$values->supplier_name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('supplier_id'){{ $message }} @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="store_id">Select Location</label>
                                            <select class="form-control my-2" name="store_id">
                                                <option selected="true" disabled="disabled">----------Select---------</option>
                                                @foreach($Store as $values)
                                                 <option value="{{$values->store_id}}">{{$values->store_name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('store_id'){{ $message }} @enderror</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 com-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="unit_id">Select Unit Type</label>
                                            <select class="form-control my-2" name="unit_id">
                                                <option selected="true" disabled="disabled">----------Select---------</option>
                                                @foreach($UnitDefinition as $values)
                                                 <option value="{{$values->unit_id}}">{{$values->unit_name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('unit_id'){{ $message }} @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-12 com-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="purchase_price">Purchase Price</label>
                                            <input type="text" class="form-control my-2" name="purchase_price" placeholder="Enter Purchase Price" value="{{ old('purchase_price') }}">
                                            <span class="text-danger">@error('purchase_price'){{ $message }} @enderror</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 com-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="wholesale_price">WholeSale Price</label>
                                            <input type="text" class="form-control my-2" name="wholesale_price" placeholder="Enter Purchase Price" value="{{ old('wholesale_price') }}">
                                            <span class="text-danger">@error('wholesale_price'){{ $message }} @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-12 com-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="sales_price">Sales Price</label>
                                            <input type="text" class="form-control my-2" name="sales_price" placeholder="Enter Sales Price" value="{{ old('sales_price') }}">
                                            <span class="text-danger">@error('sales_price'){{ $message }} @enderror</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 com-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="quantity">Quantity</label>
                                            <input type="number" class="form-control my-2" name="quantity" placeholder="Enter Quantity" value="{{ old('quantity') }}">
                                            <span class="text-danger">@error('quantity'){{ $message }} @enderror</span>
                                        </div>
                                       
                                    </div>
                                    <div class="col-12 com-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="discount">Discount</label>
                                            <input type="number" class="form-control my-2" name="discount" placeholder="Enter discount" value="{{ old('discount') }}">
                                            <span class="text-danger">@error('discount'){{ $message }} @enderror</span>
                                        </div>
                                       
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-12 com-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="total_payable">Total Payable</label>
                                            <input type="number" class="form-control my-2" name="total_payable" placeholder="Enter total_payable" value="{{ old('total_payable') }}">
                                            <span class="text-danger">@error('total_payable'){{ $message }} @enderror</span>
                                        </div>
                                       
                                    </div>
                                    <div class="col-12 com-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="paid_status">Is Full Paid ?</label>
                                            <select class="form-control" name="paid_status">
                                                <option value="1">Paid</option>
                                                <option value="0">Due</option>
                                            </select>
                                        </div>
                                       
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-primary mt-2">Submit</button>
                                    <a class="btn btn-primary mt-2 float-right" class="text-light" href="{{route('backoffice.all-products')}}">Back</a>
                                </div>
                                  <br>
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

    
@endsection