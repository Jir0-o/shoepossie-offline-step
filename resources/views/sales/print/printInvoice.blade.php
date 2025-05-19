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

        .payment-info-box {
            display: flex;
            flex-direction: column;
            justify-content: end;
            align-items: end;
        }

        .payment-border {            
            padding: 16px;
            border: 3px double #363636;
        }

        .payment-info-box h3 {
            border-bottom: 3px solid #363636;
        }

        .dotted {
            border: none;
            border-top: 1px dotted #000000;
            height: 1px;
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <div id="print" xmlns:margin-top="http://www.w3.org/1999/xhtml">
        {{--    Company Details --}}
        <div style="text-align: center;">
            <img height="100px" src="{{ $banner->banner_logo }}" alt="Restaurant Image">
        </div>
        <table style="margin-top: 10px;">
            <tr>
                <td>Company Name:</td>
                <td style="font-weight: bold">  {{ $banner->banner_name }}</td>
            </tr>
            <tr>
                <td>
                    Address:
                </td>
                <td>
                    {{ $banner->banner_address }}
                </td>
            </tr>
            <tr>
                <td>
                    Phone
                </td>
                <td>
                    {{ $banner->banner_mobile }}
                </td>
            </tr>
            <tr>
                <td>
                    Store Code
                </td>
                <td>
                    <p style="margin: 0; font-weight: bold;">{{ $banner->banner_code }} </p>
                </td>
            </tr>
        </table>
        <hr>
        <table style="margin-top: 10px;">
            <tr>
                <td>
                    Invoice No :
                </td>
                <td>
                    <p style="margin: auto; font-weight: bold;">{{$banner->banner_code}}000{{ $CartInformtion->cart_id }}</p>
                </td>
            </tr>
            <tr>
                <td>
                    Date :
                </td>
                <td>
                    @php
                        use Carbon\Carbon;
                        $carboneDate = Carbon::parse($CartInformtion->cart_date);
                        $formateData = $carboneDate->format('d-m-Y h:i:s A');
                    @endphp
                    {{ $formateData }}
                </td>
            </tr>
            {{-- <tr>
                <td>
                    Customer :
                </td>
                <td>
                    @php
                    $consumer_login = \App\Models\ConsumerLogin::where('login_id', $CartInformtion->consumer_id)->first();
                    @endphp
                    {{ $consumer_login->mobile_no }}
                </td>
            </tr> --}}
            <tr>
                <td>
                    Table :
                </td>
                <td>
                    {{ $CartInformtion->table_no }}
                </td>
            </tr>
        </table>
        <hr>
        <?php $i = 1; ?>
        <table style="margin-top: 10px;">
            <tr>
                <th style="padding-right:10px;">
                    SL
                </th>
                <th style="padding-left:10px; padding-right:10px;">
                    Item
                </th>
                <th style="padding-left:10px; padding-right:10px;">
                    Qty
                </th>
                <th style="padding-left:10px; padding-right:10px;">
                    Amount
                </th>
                <th style="padding-left:10px; padding-right:10px;">
                    Product Code
                </th>
            </tr>
            @foreach ($CartInformtionForPrint as $item)
                <tr>
                    <td style="padding-right:10px;">
                        {{ $i++ }}
                    </td>
                    <td style="padding-left:10px; padding-right:10px;">
                        {{ $item->product_material_name }} <small>({{$item->colors_name }} {{$item->size_name}})</small>
                    </td>

                    <td style="padding-left:10px; padding-right:10px;text-align:right">
                        @if ($CartInformtion->sales_type == 1)
                            {{ $item->quantity }} X {{ $item->sales_price }}
                        @else
                            {{ $item->quantity }} X {{ $item->wholesale_price }}
                        @endif
                    </td>
                    <td style="padding-left:10px; padding-right:10px;text-align:right">
                        @if ($CartInformtion->sales_type == 1)
                            {{ $item->sales_price * $item->quantity }}
                        @else
                            {{ $item->wholesale_price * $item->quantity }}
                        @endif
                    </td>
                    <td style="padding-left:10px; padding-right:10px;">
                        {{$item->barcode }}
                    </td>
                </tr>
                {{-- <tr>
                    <td style="padding-right:10px;">

                    </td>
                    <td style="padding-left:10px; padding-right:10px;">

                    </td>
                    <td style="padding-left:10px; padding-right:10px;">
                        Vat
                    </td>
                    <td style="padding-left:10px; padding-right:10px;">
                        {{ $item->vat }}
                    </td>
                </tr> --}}
            @endforeach
            <!-- <tr>
                <td style="padding-right:10px;">

                </td>
                <td style="padding-left:10px; padding-right:10px;">

                </td>
                <td style="padding-left:10px; padding-right:10px;">
                    Subtotal
                </td>
                <td style="padding-left:10px; padding-right:10px;text-align:right">
                    {{ $item->total_cart_amount }}
                </td>
            </tr>
            <tr>
                <td>

                </td>
                <td>

                </td>
                <td style="padding-left:10px; padding-right:10px;">
                    Vat Total
                </td>
                <td style="padding-left:10px; padding-right:10px;text-align:right">
                    {{ $item->vat_amount }}
                </td>
            </tr>
            <tr>
                <td style="padding-right:10px;">

                </td>
                <td style="padding-left:10px; padding-right:10px;">

                </td>
                <td style="padding-left:10px; padding-right:10px;">
                    Grand Total
                </td>
                <td style="padding-left:10px; padding-right:10px;text-align:right">
                    {{ $item->total_cart_amount + $item->vat_amount }}
                </td>
            </tr>
            <tr>
                <td style="padding-right:10px;">

                </td>
                <td style="padding-left:10px; padding-right:10px;">

                </td>
                <td style="padding-left:10px; padding-right:10px;">
                    Discount
                </td>
                <td style="padding-left:10px; padding-right:10px;text-align:right">
                    {{ $item->total_discount }}
                </td>
            </tr>
            <tr>
                <td style="padding-right:10px;">

                </td>
                <td style="padding-left:10px; padding-right:10px;">

                </td>
                <td style="padding-left:10px; padding-right:10px;">
                    Payble
                </td>
                <td style="padding-left:10px; padding-right:10px;text-align:right">
                    {{ $item->total_payable_amount }}
                </td>
                @php

                use App\Models\CartPaymentInformation;
                $cart_payment = CartPaymentInformation::join('cart_payment_methods', 'cart_payment_methods.payment_method_id', '=', 'cart_payment_information.payment_method_id')
                ->where('cart_payment_information.cart_id', $item->cart_id)
                -> select('cart_payment_information.*','cart_payment_methods.payment_method')
                ->get();

                $total_paid_amount = CartPaymentInformation::where('cart_id', $item->cart_id)
                ->sum('paid_amount');
                
                @endphp                                                
            </tr>
            
            @foreach ($cart_payment as $pay)
            <tr>
                <td style="padding-right:10px;">

                </td>
                <td style="padding-left:10px; padding-right:10px;">

                </td>
                <td style="padding-left:10px; padding-right:10px;text-align:left">
                {{ $pay->payment_method }} 
                </td>
                <td style="padding-left:10px; padding-right:10px;text-align:right">
                    {{ $pay->paid_amount }} 
                </td>
            </tr>
            @endforeach   
            
            <tr>
                <td style="padding-right:10px;">

                </td>
                <td style="padding-left:10px; padding-right:10px;">

                </td>
                <td style="padding-left:10px; padding-right:10px;text-align:left">
                    Total
                </td>
                <td style="padding-left:10px; padding-right:10px;text-align:right">
                    {{ $item->paid_amount }} 
                </td>
            </tr> -->

        </table>

        <div class="payment-info -box">
            <div class="payment -border">
                <h3>Payment Info</h3>
                <table style="width: 100%;">
                    <thead>
                        <tr>
                            <td>Payment type</td>
                            <td style="padding-left:10px; padding-right:10px;text-align:right">Amount</td>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td style="padding-left:10px; padding-right:10px;">
                            Subtotal
                        </td>
                        <td style="padding-left:10px; padding-right:10px;text-align:right">
                            {{ $item->total_cart_amount }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-left:10px; padding-right:10px;">
                            Vat Total
                        </td>
                        <td style="padding-left:10px; padding-right:10px;text-align:right">
                            {{ $item->vat_amount }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-left:10px; padding-right:10px;">
                            Grand Total
                        </td>
                        <td style="padding-left:10px; padding-right:10px;text-align:right">
                            {{ $item->total_cart_amount + $item->vat_amount }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-left:10px; padding-right:10px;">
                            Discount
                        </td>
                        <td style="padding-left:10px; padding-right:10px;text-align:right">
                            {{ $item->total_discount }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-left:10px; padding-right:10px;">
                            Paid Amount
                        </td>
                        <td style="padding-left:10px; padding-right:10px;text-align:right">
                            {{ $total_paid_amount }}
                    </tr>   
                    <tr>
                        <td style="padding-left:10px; padding-right:10px;">
                            Due Amount
                        </td>
                        <td style="padding-left:10px; padding-right:10px;text-align:right">
                            {{ $item->due_amount }}
                        </td>
                    </tr>                                           
                    
                    @foreach ($cart_payment as $pay)
                    @if ($pay->payment_method_id != 1)
                    <tr>
                        <td style="padding-left:10px; padding-right:10px;text-align:left">
                        {{ $pay->payment_method }} 
                        </td>
                        <td style="padding-left:10px; padding-right:10px;text-align:right">
                            {{ $pay->paid_amount }} 
                        </td>
                    </tr>
                    @endif
                    @endforeach   
                    @foreach ($cart_payment as $pay)
                    @if ($pay->payment_method_id == 1)
                    {{-- <tr>
                        <td style="padding-left:10px; padding-right:10px;text-align:left">
                            Total Paid:
                        </td>
                        <td style="padding-left:10px; padding-right:10px;text-align:right">
                            {{ $item->paid_amount }} 
                        </td>
                    </tr>
					<tr>
                        <td style="padding-left:10px; padding-right:10px;text-align:left">
                            Change Amount:
                        </td>
                        <td style="padding-left:10px; padding-right:10px;text-align:right">
                        
						 {{ $item->paid_amount }}
						     
                        </td>
                    </tr> --}}
                    @endif
                    @endforeach 
                    </tbody>
                </table>
            </div>            
        </div>
            @php
                $grandTotal = ($item->total_cart_amount ?? 0) + ($item->vat_amount ?? 0);

                $totalPaidAmount = $cart_payment->sum('paid_amount');
                $totalChangeAmount = $cart_payment->sum('paid_amount') - $grandTotal;
                $dueAmount = $grandTotal > $totalPaidAmount ? $grandTotal - $totalPaidAmount : 0;
            @endphp
        <div style="margin-top: 32px;">
            <div style="border: 1px solid #000000; padding: 5px; padding-left: 15px; text-align: right;">
                {{-- Show Totals --}}
                <div style="display: flex; justify-content: center;">
                    <p style="margin: 0; font-size: 25px; font-weight: bold;">Total Paid:&nbsp;</p>
                    <p style="margin: 0; font-size: 25px; font-weight: bold;">{{ number_format($totalPaidAmount) }}</p>
                </div>

                <div style="display: flex; justify-content: center;">
                    <p style="margin: 0; font-size: 25px; font-weight: bold;">Change Amount:&nbsp;</p>
                    <p style="margin: 0; font-size: 25px; font-weight: bold;">{{ number_format(max($totalChangeAmount, 0)) }}</p>
                </div>
            </div>
        </div>

        <div class="dotted">

        </div>
        <div style="text-align: center;"><span style="font-weight: bold">N.B</span> This <span style="font-weight: bold">cash memo</span> must be presented for any exchange/claim with in <span style="font-weight: bold;">30 days</span> from the day of purchase.Discounted Goods  are not applicable for above condition. Goods once Sold can't be exchangeable in cash</div>
        <hr>
        <div style="text-align: center;">Powered by Unicorn Software and Solutions.</div>
    </div>


    <script>
        window.print();
    </script>
</body>

</html>
