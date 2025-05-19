@php
    $banner = \App\Models\BannerInformation::first();
@endphp
<html>

<head>
    <title>Invoice</title>
    <style>
        @media print {

            @page {
                size: portrait;
                /* auto is the initial value */
                margin: 0;
                /* this affects the margin in the printer settings */
            }

            html {
                background-color: #FFFFFF;
                margin: 0;
                /* this affects the margin on the html before sending to printer */
            }

            body {
                margin: 0 10mm;
                /* margin you want for the content */
            }
        }

        .wrapper {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            grid-auto-rows: minmax(100px, auto);
        }

        .one {
            grid-row-start: 1;
            grid-row-end: 1;
            grid-column-start: 2;
            grid-column-end: 4;
        }

        .two {
            grid-row-start: 1;
            grid-row-end: 1;
            grid-column-start: 1;
            grid-column-end: 2;
        }

        .dotted {
            border: none;
            border-top: 1px dotted #000000;
            height: 1px;
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>

    <div id="print" xmlns:margin-top="http://www.w3.org/1999/xhtml">
        {{--    Company Details --}}
        <div style="text-align: center;">
            <img height="100px" src="{{ $banner->banner_logo }}" alt="Restaurant Image">
        </div>
        <div style="text-align: center;">
            <h3>Return Details</h3>
        </div>
        <div class="row">
            <div class="col-12 card">
                    @foreach($CartItemReturn as $return)
                    <div class="card-body">

                       
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


                    </div>

                    @endforeach
                </div>
        </div>
    </div>


    <script>
        window.print();
    </script>
</body>

</html>
