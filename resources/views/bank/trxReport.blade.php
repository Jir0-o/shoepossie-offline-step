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

                        <h4 class="px-3 pt-3 text-center">Generate Transaction Report</h4>

                    </div>

                    <div class="card-body pt-0">

                        <div class="row">

                            <div class="col-md-3">

                                <div class="form-group">

                                    <label for="bank_id">Bank Name: </label>

                                    <select id="bank_id" class="form-select" name="bank_id"></select>

                                </div>

                            </div>

                            <div class="col-md-3">

                                <div class="form-group">

                                    <label for="trx_type">Trx Type: </label>

                                    <select id="trx_type" class="form-select" name="trx_type">

                                        <option selected disabled>---------Select---------</option>

                                        <option value="1">Deposit</option>

                                        <option value="2">Withdraw</option>

                                    </select>

                                </div>

                            </div>

                            <div class="col-md-3">

                                <div class="form-group">

                                    <label for="trx_mode">Trx Mode: </label>

                                    <select id="trx_mode" class="form-select" name="trx_mode">

                                        <option selected disabled>---------Select---------</option>

                                        <option value="1">Cash</option>

                                        <option value="2">Cheque</option>

                                        <option value="3">ATM</option>

                                        <option value="4">Others</option>

                                    </select>

                                </div>

                            </div>

                            <div class="col-md-3">

                                <div class="form-group">

                                    <label for="date_from">Cheque No: </label>

                                    <input type="text" id="cheque_no" class="form-control" name="cheque_no" />

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group">

                                    <label for="date_from">Date From: </label>

                                    <input type="date" id="from_date" class="form-control" name="from_date" />

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group">

                                    <label for="date_from">To Date: </label>

                                    <input type="date" id="to_date" class="form-control" name="to_date" />

                                </div>

                            </div>

                            <div class="col-md-4">

                                <button id="generate" type="submit" class="btn btn-success w-100 mt-4">Generate</button>

                            </div>

                        </div>

                        <div class="py-3">

                            <div class="table-responsive">

                                <table id="example" class="table table-bordered display compact nowrap" style="width:100%">

                                    <thead>

                                        <tr>

                                            <th class="text-center">SL</th>

                                            <th class="text-center">Bank</th>

                                            <th class="text-center">Date</th>

                                            <th class="text-center">Trx Type</th>

                                            <th class="text-center">Trx Mode</th>

                                            {{-- <th>Party</th> --}}

                                            <th class="text-center">Par. Bank</th>

                                            <th class="text-center">Trx Ref.</th>

                                            <th class="text-center">prev Balance</th>

                                            <th class="text-center">Amount</th>

                                            <th class="text-center">Curr Balance</th>

                                        </tr>

                                    </thead>

                                    <tbody id="trxtt">

                                        @foreach($bankTrx as $Trx)

                                        @if($Trx->trx_type == 1)

                                        <tr style="background-color:#bff5da;">

                                        @else

                                        <tr style="background-color:#f7dada;">

                                        @endif

                                            @php $j=1; @endphp

                                            <td class="text-center"> {{$loop->index +1 }}</td>

                                            <td class="text-center">{{$Trx->bank_name}}</td>

                                            <td class="text-center">{{$Trx->date}}</td>

                                            <td class="text-center">
                                                @if ($Trx->trx_type == 1)
                                                <span class="badge badge-pill badge-success">Deposit</span>
                                                @else
                                                <span class="badge badge-pill badge-danger">Withdraw</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($Trx->trx_mode == 1)
                                                    Cash
                                                    
                                                @elseif ($Trx->trx_mode == 2)
                                                    
                                                    Cheque
                                                    
                                                @elseif ($Trx->trx_mode == 3)
                                                    
                                                    ATM
                                                    
                                                @elseif ($Trx->trx_mode == 4)
                                                    
                                                    Others
                                                    
                                                @endif
                                            </td>
                                            {{-- <td>{{$Trx->party}}</td> --}}

                                            <td class="text-center">{{$Trx->other_bank}}</td>

                                            <td class="text-center">{{$Trx->trx_ref}}</td>

                                            <td class="text-end">{{$Trx->prev_balance}}</td>

                                            <td class="text-end">{{$Trx->amount}}</td>

                                            <td class="text-end">{{$Trx->current_balance}}</td>

                                        </tr>

                                        @endforeach

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

                <!--Bank Section End---->

            </div>



        </div>

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">

        </script>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/simple-icons/3.2.0/tata.js"></script>



        <script type="text/javascript">

            $(document).ready(function() {

                var abd = "";

                abd += "<option selected disabled>---------Select---------</option>"

                $.ajax({

                    url: '{{ route('backoffice.ajax-all-bank') }}',

                    type: "GET",

                    data: {

                        "_token": "{{ csrf_token() }}"

                    },

                    dataType: "json",

                    success: function(data) {

                        $.each(data, function(col, bank) {

                            abd += '<option value="' + bank.bank_id + '">' + bank.bank_name + '</option>'

                        });

                        $("#bank_id").append(abd);

                    }

                });



                $("#generate").on("click", function() {

                    var bank_id = $("#bank_id").val();

                    var trx_type = $("#trx_type").val();

                    var trx_mode = $("#trx_mode").val();

                    var cheque_no = $("#cheque_no").val();

                    var from_date = $("#from_date").val();

                    var to_date = $("#to_date").val();



                    $.ajax({

                        url: '{{ route('backoffice.ajax-generate-report')}}',

                        type: "POST",

                        data: {

                            "_token": "{{ csrf_token() }}",

                            "bank_id": bank_id,

                            "trx_type": trx_type,

                            "trx_mode": trx_mode,

                            "cheque_no": cheque_no,

                            "from_date": from_date,

                            "to_date": to_date,

                        },

                        dataType: "json",

                        success: function(data) {
                            console.log(data);

                            $("#trxtt").empty();

                            var trxdtd = "";

                            var j = 1;

                            $.each(data, function(col, bank) {

                                if (bank.trx_type == 1) {

                                    trxdtd += '<tr style="background-color:#bff5da;">'

                                } else {

                                    trxdtd += '<tr style="background-color:#f7dada;">'

                                }

                                trxdtd += '<td class="text-center">' + j++ + '</td>'

                                trxdtd += '<td class="text-center">' + bank.bank_name + '</td>'

                                trxdtd += '<td class="text-center">' + bank.date + '</td>'

                                if (bank.trx_type == 1) {

                                    trxdtd += '<td class="text-center">Deposit</td>'

                                } else {

                                    trxdtd += '<td class="text-center">Withdraw</td>'

                                }

                                if (bank.trx_mode == 1) {

                                    trxdtd += '<td class="text-center">Cash</td>'

                                } else if (bank.trx_mode == 2) {

                                    trxdtd += '<td class="text-center">Checque</td>'



                                } else if (bank.trx_mode == 3) {

                                    trxdtd += '<td class="text-center">ATM</td>'



                                } else if (bank.trx_mode == 4) {

                                    trxdtd += '<td class="text-center">Others</td>'

                                }

                                trxdtd += '<td class="text-center"></td>'
                                trxdtd += '<td class="text-center"></td>'

                                trxdtd += '<td class="text-end">' + bank.prev_balance + '</td>'

                                trxdtd += '<td class="text-end">' + bank.amount + '</td>'

                                trxdtd += '<td class="text-end">' + bank.current_balance + '</td>'

                                trxdtd += '</tr>'

                            });

                            $("#trxtt").append(trxdtd);

                        }

                    });

                });

            });

        </script>

        @endsection