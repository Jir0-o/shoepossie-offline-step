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

        

        @foreach($backoffice_user as $user)

        <div class="main-panel">

            <div class="content-wrapper">

            <div class="page-header">

              <nav aria-label="breadcrumb">

                <ol class="breadcrumb">

                  <li class="breadcrumb-item"><a href="#">Backoffice</a></li>

                  <li class="breadcrumb-item active" aria-current="page"> Profile </li>

                </ol>

              </nav>

              <div class="btn btn-outline-info float-right" data-toggle="modal" data-target="#exampleModal">Update Your Password</div>

              <!-- Modal -->

              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                <div class="modal-dialog" role="document">

                  <div class="modal-content">

                    <div class="modal-header">

                      <h5 class="modal-title" id="exampleModalLabel">Please Fill Up This Form</h5>

                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                      </button>

                    </div>

                    <div class="modal-body p-4">

                        <div id="validation_error"></div>

                        <div id="success_msg"></div>

                        <div class="input-group mb-3">

                          <div class="input-group-prepend">

                            <span class="input-group-text bg-primary text-light" id="inputGroup-sizing-default">Old Password</span>

                          </div>

                          <input type="password" id="old_password" placeholder="Old Password" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">

                        </div>

                        <div class="input-group mb-3">

                          <div class="input-group-prepend">

                            <span class="input-group-text bg-primary text-light" id="inputGroup-sizing-default">New Password</span>

                          </div>

                          <input type="password" id="new_password" placeholder="New Password" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">

                        </div>

                        <div class="input-group mb-3">

                          <div class="input-group-prepend">

                            <span class="input-group-text bg-primary text-light" id="inputGroup-sizing-default">Re-Write Password</span>

                          </div>

                          <input type="password" id="re_write_password" placeholder="Re-Write Password" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">

                        </div>

                        <div id="pass_error"></div>

                    </div>

                    <div class="modal-footer">

                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                      <button type="button" id="update_password" class="btn btn-primary">Save changes</button>

                    </div>

                  </div>

                </div>

              </div>

            </div>

            <div class="card">

              <div class="card-body">

                <form action="{{ route('backoffice.update-profile')}}" method="post" enctype="multipart/form-data">

                    @csrf

                    

                    <input type="hidden" name="login_id" value="{{ $user->login_id }}"/>

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

                    

                    <div class="row border p-5">

                        <div class="col-md-8">

                            <div>

                                <h3>{{ $user->full_name }}</h3>

                            </div>

                            <div class="row">

                                <div class="col-md-6 py-2">

                                    <span class="text-info">Role :</span>  {{ $user->role_name }}

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6 py-2">

                                    <span class="text-info">User Id :</span>  {{ $user->office_user_id }}

                                </div>

                            </div>

                            <hr>

                            <div class="row">

                                <div class="col-md-6 py-2">

                                    <div class="pb-2">Email : {{ $user->user_email }}</div>

                                </div>

                            </div>

                            

                        </div>

                        <div class="col-md-4">

                            <img 

                                alt="{{ $user->full_name }}" 

                                src="{{asset('backend/images/profile_picture/'.$user->user_image)}}" 

                                height="150px" 

                                width="150px" 

                            />

                            <input class="form-control mt-2" type="file" name="user_image" required="required" accept="image/*" />

                            <button class="btn btn-outline-primary mt-4" type="submit"> Update Picture</button>

                        </div>

                    </div>

                </form>

              </div>

            </div>



            <!-- main-panel ends -->

          </div>

          <!-- page-body-wrapper ends -->

        </div>

        @endforeach

   </div>

</div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"

        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">

    </script>

    <script type="text/javascript">

        $(document).ready(function() {

            window.i=0;

            $(document).on('keyup', '#re_write_password', function(e) {

              var re_write_password = $(this).val();

              var new_password = $("#new_password").val();

              if(new_password!=re_write_password && i==0){

                $("#pass_error").append("<div class='alert alert-danger'>Password Did Not Matched</div>");

                i=1;

              }else if(new_password==re_write_password){

                $("#pass_error").empty();

                i=0;

              }else if(!new_password && !re_write_password){

                $("#pass_error").empty();

                i=0;

              }

            });



            $(document).on('click', '#update_password', function(e) {

                

                var old_password = $("#old_password").val();

                var new_password = $("#new_password").val();

                var re_write_password = $("#re_write_password").val();



                $.ajax({

                    url: '{{ route('backoffice.update-password') }}',

                    type: "POST",

                    data: {

                        "_token": "{{ csrf_token() }}",

                        "old_password": old_password,

                        "new_password": new_password,

                        "re_write_password": re_write_password,

                    },

                    dataType: "json",

                    success: function(data) {

                        $("#validation_error").empty();

                        $("#success_msg").empty();



                        if(data.pass_error==true){

                          $("#validation_error").append("<div class='alert alert-danger'>"+data.message+"</div>");

                        }

                        if(data.validation_error == true){

                          

                          $.each(data.messages, function(row, col) {

                              $("#validation_error").append("<div class='alert alert-danger'>"+col[0]+"</div></br>");

                          });

                        }

                        if(data.success==true){

                          $("#success_msg").append("<div class='alert alert-success'>"+data.message+"</div>");

                          $("#old_password").val('');

                          $("#new_password").val('');

                          $("#re_write_password").val('');

                        }

                    }

                });

            });

        });

    </script>

@endsection