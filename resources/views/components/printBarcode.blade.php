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

    </head>

    <body>
        
        <div id="capture" class="p-2" style="display: inline-flex">
            <div class="row" style="border: 3px solid black; width:auto; margin:0px; width:600px;">
                <div class="col-4 p-4" style="border-right: 3px solid black; width:auto; margin:0px;width:45%;">
                    <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($label, 'QRCODE', 10,10) }}" alt="barcode"/>
                </div>
                <div class="col-6" style="width:55%;">
                    <div class="row d-flex justify-content-center p-2" style="border-bottom: 3px solid black; width:auto; padding:0px; text-align:center; font-size:20px;">
                        BADAN PERPUSTAKAAN<br>
                        UNIVERSITAS 17 AGUSTUS 1945<br>
                        SURABAYA
                    </div>
                    <div class="row p-2" style="text-align:center; position:inherit;">
                        <h4><b>{{ $label }}</b></h4>
                    </div>
                </div>
            </div>
        </div>

        
        <script src="/main_display/vendor/jquery/jquery-3.6.4.min.js"></script>
        <script src="/main_display/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/main_display/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/main_display/vendor/html2canvas/html2canvas.min.js"></script>
        <script src="/main_display/vendor/html2canvas/FileSaver.js"></script>

        <script>
            html2canvas(document.querySelector("#capture")).then(canvas => {
                canvas.toBlob(function(blob) {
                    saveAs(blob, "{{ $label }}.png");
                    window.location.href = "/dashboard/pengolahan/buku";
                });
            });
        </script>
    </body>

</html>