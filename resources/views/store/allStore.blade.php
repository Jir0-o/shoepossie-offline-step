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
        <!--store Section Start---->


        <div class="card">
            <div class="card-body">
                <div class="card-description"><a class="text-light btn btn-info" href="{{ route('backoffice.add-store') }}">Add New Store</a></div>

                    @if (session()->has('success'))

                    <div class="alert alert-success">{{session()->get('success')}}</div>

                    @endif

                    @if (session()->has('update'))

                    <div class="alert alert-success">{{session()->get('update')}}</div>

                    @endif
                    @if (session()->has('updatefail'))

                    <div class="alert alert-danger">{{session()->get('updatefail')}}</div>

                    @endif


              </p>
              <div class="table-responsive">
                <table id="example" class="table table-striped display">
                  <thead>
                    <tr >
                      <th>S.N</th>
                      <th>Store Name</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                       @foreach ( $all_Store_datas as $all_Store_data )
                    <tr>
                      <td>{{$loop->index+1}}</td>
                      <td>{{ $all_Store_data->store_name}}</td>
                        @if ($all_Store_data->is_active==1)

                      <td>Active</td>

                      @else
                      <td>No Active</td>
                      @endif
                      <td><a class="btn btn-warning" class="text-light" href="{{ route('backoffice.edit-store',$all_Store_data->store_id)}}">Edit</a></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>



        <!--store Section End---->
            </div>

          </div>

@endsection