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
        </table>
        <hr>
        <table style="margin-top: 10px;">
            <tr>
                <td>
                    Invoice No :
                </td>
                <td>
                    IN#0000{{ $CartInformtion->cart_id }}
                </td>
            </tr>
            <tr>
                <td>
                    Date :
                </td>
                <td>
                    {{ $CartInformtion->cart_date }}
                </td>
            </tr>
            <tr>
                <td>
                    Customer :
                </td>
                <td>
                    {{ $CartInformtion->mobile_no }}
                </td>
            </tr>
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
            <tr>
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
            </tr>

        </table>

        <div class="dotted">

        </div>
        <div style="text-align: center;"><span style="font-weight: bold">N.B</span> This <span style="font-weight: bold">cash memo</span> must be presented for any exchange/claim with in <span style="font-weight: bold;">30 days</span> from the day of purchase.Discounted Goods  are not applicable for above condition. Goods once Sold can't be exchangeable in cash</div>
        <hr>
        <div style="text-align: center;">Powered by Unicorn Software and Solutions Ltd.</div>
    </div>


    <script>
        window.print();
    </script>
</body>

</html>
