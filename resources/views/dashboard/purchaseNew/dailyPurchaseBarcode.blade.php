<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        #code {
            display: none
        }

        .barcode {
            width: 350px;
            height: 30px;
        }

        /* @media print {


        } */
    </style>

</head>

<body>
    {{-- @php
    use App\Models\BannerInformation;
    // use Picqer\Barcode\BarcodeGeneratorSVG;
    use Milon\Barcode\DNS1D;

    $banner_Information = BannerInformation::first();

    // $barcodeGenerator = new BarcodeGeneratorSVG();
    // Generate the SVG barcode
    // $barcode = $barcodeGenerator->getBarcode($getPurchaseBarcode->barcode, $barcodeGenerator::TYPE_CODE_128, 1, 50);
    @endphp --}}

    @php
        use App\Models\BannerInformation;
        $d = new \Milon\Barcode\DNS1D();


        $barcodeValue = $getPurchaseBarcode->barcode; // You can change this value as needed
    $barcodeHTML = $d->getBarcodeSVG($barcodeValue, 'C128', 1.2, 40);
    @endphp 
    <div>
        {{-- <p>
            {!! DNS1D::getBarcodeSVG($getPurchaseBarcode->barcode, 'C39', .8, 10) !!}

        </p> --}}


        <div style="text-align: center;" style="font-size: 14px;">
            {{-- <img style="width: 20%" src="{{ $banner_Information->banner_logo }}" alt="logo" /><br> --}}
            <span style="font-weight: bold;font-size:30px;font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif">J & B ENTERPRISE</span><br />
            {{-- <span style="font-weight: bold;font-size:25px">Batch:{{ $getPurchaseBarcode->batch }}</span><br> --}}

            <p style="text-align:center; font-weight: bold;font-size:18px; letter-spacing:.15rm; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin:0">{{ $getPurchaseBarcode->barcode }}</p><br />

            {{-- {!! barcode::getBarcode($getPurchaseBarcode->barcode, $barcodeGenerator::TYPE_CODE_128)!!} --}}

            {{--
            @php
                $barcodeGenerator = new BarcodeGeneratorPNG();
                $barcode = $barcodeGenerator->getBarcode($getPurchaseBarcode->barcode, $barcodeGenerator::TYPE_CODE_128);
            @endphp
            --}}

            <div class="barcode-image" style="display: flex; align-items:center; justify-content:center;margin:0;padding-left:2px">
                {{-- <!-- <img style="display:block;margin-left: 20px;"  src="data:image/png;base64,{{ base64_encode($barcode) }}" alt="Generated Barcode"><br/> --> --}}
                
                <div class="barcode">
                    {!! $barcodeHTML !!}
                </div>
            </div>

            <p style="text-align:center; font-weight: bold; font-size: 30px; margin:0; font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif">Price: {{ $getPurchaseBarcode->sales_price }}</p>
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>