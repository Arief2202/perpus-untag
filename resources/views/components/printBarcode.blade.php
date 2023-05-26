<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>@yield('title')</title>
        <meta content="" name="description">
        <meta content="" name="keywords">
        <link href="/main_display/img/favicon.ico" rel="icon">
        <link href="/main_display/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="/main_display/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <style>
            @media print {
                body script, #btn{ display:none;}
                #capture * {display:flex; page-break-inside: avoid;}
            }
        </style>
    </head>

    {{-- <body onload="window.print()"> --}}
    <body>
        <div id="btn" class="container ms-0">
            <a class="btn btn-secondary mt-2" id="btn" href="/dashboard/pengolahan/cetak-label" style="width:700px;">Back</a>
            <button class="btn btn-primary mt-2" id="btn" onclick="window.print()" style="width:700px;">Print</button>
        </div>
        <div id="capture" class="p-2 " {{-- style="display: inline-flex" --}}>
            @foreach($request->labels as $key=>$label)
                @if($key%5 == 0 && $key!=0)</div> @endif
                @if($key%5 == 0) <?php $countRow = 0; ?> <div class="row ms-1"> @endif
                    <?php $countRow++; $judul = explode("-", $label)[0]; $qr = explode("-", $label)[1] ?>
                    {{-- <div class="col">
                        {{ $countRow }}
                    </div> --}}

                    <div class="row p-0" style="border: 2px solid black; width:138px; margin:1px;">
                        {{-- <div class="col"> --}}
                            @if(strlen($judul) <= 18)
                            <div class="row" style="margin:0px; padding:0px; font-size:9pt; white-space: nowrap;overflow: hidden;text-overflow: ellipsis"><b class="d-flex justify-content-center">{{ $judul }}</b></div>
                            @else
                                <div class="row" style="margin:0px; padding:0px; font-size:9pt; white-space: nowrap;overflow: hidden;text-overflow: ellipsis"><b class="d-flex justify-content-center">
                                    @for($a=0; $a<18; $a++){{ $judul[$a] }}@endfor...
                                </b></div>
                            @endif
                            <div  style="border-top: 2px solid black;"></div>
                            <div class="row mt-2 ps-2 pe-3">
                                <center><img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($qr, 'QRCODE', 5.5,5.5) }}" alt="barcode"/></center>
                            </div>
                            
                            @if(strlen($qr) <= 18)
                            <div class="row" style="margin:0px; padding:0px; font-size:9pt; white-space: nowrap;overflow: hidden;text-overflow: ellipsis"><b class="d-flex justify-content-center">{{ $qr }}</b></div>
                            @else
                                <div class="row" style="margin:0px; padding:0px; font-size:9pt; white-space: nowrap;overflow: hidden;text-overflow: ellipsis"><b class="d-flex justify-content-center">
                                    @for($a=0; $a<15; $a++){{ $qr[$a] }}@endfor...
                                </b></div>
                            @endif
                            {{-- <div class="row p-0 m-0" style=" font-size:9pt;"> <b class="d-flex justify-content-center">{{ $qr }}</b> </div> --}}
                        {{-- </div> --}}
                    </div>

            @endforeach

            @if($countRow < 4) @for($countRow; $countRow<4; $countRow++) <div class="col"></div> @endfor @endif
        </div>

        
        <script src="/main_display/vendor/jquery/jquery-3.6.4.min.js"></script>
        <script src="/main_display/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>

</html>