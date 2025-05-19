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
                                    <h4 class="p-3 text-center">Edit Item</h4>
                                    <hr>
                                </div>
                                <div class="card-body">

                                    <form action="{{ route('backoffice.update-product') }}" method="post"
                                        enctype="multipart/form-data">
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
                                        @foreach ($Products as $Product)
                                            <div class="row">
                                                <div class="col-12 col-md-6 col-lg-6">
                                                    <input type="hidden" name="id" value="{{ $Product->product_id }}">
                                                    <div class="form-group">
                                                        <label for="product_name">Product Name</label>
                                                        <input type="text" class="form-control my-2" name="product_name"
                                                            placeholder="Enter Product Name"
                                                            value="{{ $Product->product_name }}">
                                                        <span class="text-danger">
                                                            @error('product_name')
                                                                {{ $message }}
                                                            @enderror
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="unit_type">Select Unit Type</label>
                                                        <select class="form-control my-2" name="unit_type">
                                                            <option selected="true" disabled="disabled">
                                                                ----------Select---------</option>
                                                            @foreach ($UnitDefinition as $values)
                                                                <option value="{{ $values->unit_id }}"
                                                                    {{ $Product->unit_type == $values->unit_id ? 'selected' : '' }}>
                                                                    {{ $values->unit_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="text-danger">
                                                            @error('unit_type')
                                                                {{ $message }}
                                                            @enderror
                                                        </span>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="sc_one_id">Product Sub Category</label>
                                                        <select class="form-control my-2" name="sc_one_id"
                                                            required="required">
                                                            <option selected="true" disabled="disabled">
                                                                ----------Select---------
                                                            </option>
                                                            @foreach ($subCategoryOne as $values)
                                                                <option value="{{ $values->sc_one_id }}"
                                                                    {{ $Product->sc_one_id == $values->sc_one_id ? 'selected' : '' }}>
                                                                    {{ $values->sc_one_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="text-danger">
                                                            @error('sc_one_id')
                                                                {{ $message }}
                                                            @enderror
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="images" class="form-label">Upload Product
                                                            Images:</label>
                                                        <input type="file" name="images[]" accept="image/*"
                                                            class="form-control" multiple>
                                                        <span class="text-danger">
                                                            @error('images')
                                                                {{ $message }}
                                                            @enderror
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="status">Select Status</label>
                                                        <select class="form-control my-2" name="status"
                                                            value="{{ $Product->status }}">
                                                            <option selected="true" disabled="disabled">
                                                                -----------Select----------</option>
                                                            @if ($Product->is_active == 1)
                                                                <option value="1" selected="selected">Active
                                                                </option>
                                                                <option value="0">Not Active</option>
                                                            @else
                                                                <option value="1">Active</option>
                                                                <option value="0" selected="selected">Not Active
                                                                </option>
                                                            @endif
                                                        </select>
                                                        <span class="text-danger">
                                                            @error('status')
                                                                {{ $message }}
                                                            @enderror
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <a class="btn btn-primary mt-2" class="text-light"
                                                    href="{{ route('backoffice.all-products') }}">Back</a>
                                                <button type="submit" class="btn btn-warning mt-2 float-right">Update</button>
                                            </div>

                                            <br>
                                        @endforeach
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
