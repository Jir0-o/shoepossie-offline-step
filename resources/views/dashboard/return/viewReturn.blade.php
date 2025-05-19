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
        <div class="container" style="margin-top: 100px;">
            <div class="row">
                <div class="col-12 card">
                    @foreach($CartItemReturn as $return)
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 pb-2 h3"><b>Return Details</b></div>
                            @if (Session::get('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                            @endif
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-6 col-md-3"></div>
                            <div class="col-6 col-md-3">{{ $return->consumer_name}}</div>
                            <div class="col-6 col-md-3"><b>Authorized By</b></div>
                            @if($return->authorized_by)

                            @foreach($backofficeLogin as $login)
                            @if($login->login_id==$return->authorized_by)
                            <div class="col-6 col-md-3">{{$login->full_name}} ({{$login->role_name}}) </div>
                            @endif
                            @endforeach

                            @else
                            @foreach($backofficeLogin as $login)
                            @if($login->role_name == 'Administrator' || $login->role_name == 'Super Administrator')
                            <div class="col-6 col-md-3">
                                <select class="form-control mb-2 border border-primary" id="authorize_status_def">
                                    <option disabled selected>-----Select One-----</option>
                                    <option value="2">Return to Warehouse</option>
                                    <option value="3">Rejected</option>
                                </select>
                                <div id="authorize_button"></div>
                            </div>
                            @else
                            <div class="col-6 col-md-3"> Not Authorized </div>
                            @endif
                            @endforeach
                            @endif
                        </div>
                        <div class="row mt-3">
                            <div class="col-6 col-md-3">Mobile No</div>
                            <div class="col-6 col-md-3">{{ $return->mobile_no}}</div>
                            <div class="col-6 col-md-3"><b>Authorization Date</b></div>
                            <div class="col-6 col-md-3">
                                @if($return->authorize_date)
                                {{$return->authorize_date}}
                                @else
                                Not Authorized
                                @endif
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6 col-md-3">Cart No</div>
                            <div class="col-6 col-md-3">{{ $return->cart_id}}</div>
                            <div class="col-6 col-md-3"><b>Return Status</b></div>
                            <div class="col-6 col-md-3">
                                @if($return->return_status>1)
                                @if($return->return_status==2)
                                Returning To WareHouse
                                @elseif($return->return_status==3)
                                Rejected
                                @elseif($return->return_status==4)
                                Returned To Warehouse
                                @endif
                                @else
                                Not Authorized
                                @endif
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6 col-md-3">Cart Items</div>
                            <div class="col-6 col-md-3">
                                @foreach($CartItems as $Items)
                                @foreach($Items as $value)
                                <p>{{$value->barcode}}</p>
                                @endforeach
                                @endforeach


                            </div>
                            @if($return->return_status==2 )
                            @foreach($backofficeLogin as $login)
                            @if($login->role_name=='Warehouse Incharge')
                            <div class="col-6 col-md-3"><b>Recieve Product</b></div>
                            <div class="col-6 col-md-3"><a href="{{ route('backoffice.recived-to-warehouse',Crypt::encryptString($return->cart_item_return_id)) }}" class="btn btn-warning">Product Received</a></div>
                            @endif
                            @endforeach
                            @endif
                        </div>
                        <div class="row mt-3">
                            <div class="col-6 col-md-3">Total Amount</div>
                            <div class="col-6 col-md-3">Tk. {{ $return->total_amount}}</div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6 col-md-3">Non RefundAble(vat)</div>
                            <div class="col-6 col-md-3">Tk. {{ $return->non_refundable_vat}}</div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6 col-md-3"> Refund Amount</div>
                            <div class="col-6 col-md-3 text-danger">Tk. {{ $return->refund_amount}}</div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6 col-md-3"> Return Date</div>
                            <div class="col-6 col-md-3">{{ $return->return_date}}</div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6 col-md-3">Reason of Return</div>
                            <div class="col-6 col-md-3">{{ $return->reason_of_return}}</div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6 col-md-3">Received By</div>
                            @foreach($backofficeLogin as $login)
                            @if($login->login_id==$return->received_by_id)
                            <div class="col-6 col-md-3">{{$login->full_name}} ({{$login->role_name}}) </div>
                            @endif
                            @endforeach

                        </div>

                        <div class="row mt-5">
                            <div class="col-12 text-right">
                                <a href="{{URL::previous()}}" class="btn btn-warning">Back</a>
                            </div>
                        </div>
                    </div>

                    @endforeach
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

        $('#authorize_status_def').on('change', function() {
            var authorize_status = "";
            authorize_status = $(this).val();

            $('#authorize_button').empty();

            if (authorize_status == 2) {
                var html = `<a href="{{ route('backoffice.return-authorization',[Crypt::encryptString($return->cart_item_return_id),4]) }}" class="btn btn-primary return_to_warehouse" target="_blank">`
                html += `Return to Warehouse`
                html += `</a>`

                $('#authorize_button').append(html);
            } else if (authorize_status == 3) {
                var html = `<a href="{{ route('backoffice.return-authorization',[Crypt::encryptString($return->cart_item_return_id),3]) }}" class="btn btn-primary">`
                html += `Rejected`
                html += `</a>`

                $('#authorize_button').append(html);

            } else {
                $('#authorize_button').empty();
            }


        });

        $(document).on('click', '.return_to_warehouse', function() {

            setTimeout(() => {
                location.reload();
            }, 1000);
        });
    });
</script>

@endsection