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
            <div class="content-wrapper pb-0">

        <!--Bank Section Start---->

        <div class="card">
            <div class="card-title">
                <h4 class="p-3 text-center">Edit Bank</h4>
                <hr>
            </div>
            <div class="card-body">

              <form action="{{route('backoffice.update-bank',$getdatas->bank_id)}}" method="post" enctype="multipart/form-data">

                @if (session()->has('updatefail'))

                <div class="alert alert-danger">{{session()->get('updatefail')}}</div>

                @endif

                @csrf
                @method('put')
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Bank Name:</label>
                        <div class="col-sm-9">
                          <input required type="text" class="form-control" name="bank_name" placeholder="Enter Bank Name" value="{{$getdatas->bank_name}}">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Select Status</label>
                        <div class="col-sm-9">
                          <select  class="form-control" name="is_active" required>
                            <option value=""  selected="true" disabled="disabled">-----------Select----------</option>
                            <option @if ($getdatas->is_active==1) selected @endif value="1">Active</option>
                            <option @if ($getdatas->is_active==0) selected @endif value="0">Not Active</option>
                        </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                      <a class="btn btn-primary mt-2" class="text-light" href="{{route('backoffice.bank_list')}}">Back</a>
                      <button type="submit" class="btn btn-warning mt-2 float-right">Update</button>
                  </div>

                  <br>
              </form>
            </div>

        </div>






        <!--Bank Section End---->
    </div>

</div>


@endsection


