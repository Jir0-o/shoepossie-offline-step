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

        .grid-container {
            display: grid;
            grid-template-columns: auto auto auto auto auto auto;
            padding: 10px;
        }

        .grid-item {
            background-color: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(0, 0, 0, 0.8);
            font-size: 30px;
            text-align: center;
        }
    </style>
</head>

<body>

    <div id="print" xmlns:margin-top="http://www.w3.org/1999/xhtml">
        <div class="grid-container">
            <?php for ($i = 1; $i <= $final_quantity->final_quantity; $i++) { ?>
                <div style="grid-item; padding-left: 10px; padding-right: 10px;">
                    <p style="height: 5rem;"></p>
                    <p>
                        {!! DNS1D::getBarcodeSVG($barcode, 'C128', 0.9, 30) !!}<br>
                        {{ $Product->product_name }}<br>
                        Price: {{ $Product->sales_price }}
                    </p>

                </div>
            <?php } ?>
        </div>

    </div>


    <script>
        window.print();
    </script>
</body>

</html>