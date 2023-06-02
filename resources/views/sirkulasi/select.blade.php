<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sirkulasi - Pilih Transaksi</title>
    <link href="/main_display/img/favicon.ico" rel="icon">
    <link href="/main_display/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="/main_display/vendor/mdb/all.min.css" rel="stylesheet">
    <link href="/main_display/vendor/mdb/mdb.min.css" rel="stylesheet">
    <link href="/main_display/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body class="h-100 p-2" style="background-color: #e4e4e4">
    
    <div class="row" style="width:100vw;">
        <div class="col-6"> </div>
        <div class="col-6 pt-4 pe-5">
            <div class="d-flex justify-content-end align-items-top m-2">
                <form method="POST" action="/logoutSirkulasi">@csrf
                    <button type="submit" class="btn btn-danger d-flex justify-content-end">Logout</button>
                </form>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center align-items-center" style="min-height: 80%">
        <div>
            <h1 class="d-flex justify-content-center" ><b>SIRKULASI MANDIRI</b></h1>
            <p  class="d-flex justify-content-center" >Badan Perpustakaan Universitas 17 Agustus 1945 Surabaya</p><br><br>
            <h5 class="d-flex justify-content-center" ><b>Selamat Datang pada Sirkulasi Mandiri Dalam Peminjaman Dan Pengembalian Koleksi</b></h5>
            <p  class="d-flex justify-content-center" >Silahkan Pilih Jenis Transaksi Anda</p>

            <div class="d-flex justify-content-center">
                <a href="/sirkulasi/mandiri/peminjaman" class="btn btn-success me-5">Peminjaman Koleksi</a>
                <a href="/sirkulasi/mandiri/pengembalian" class="btn btn-primary">Pengembalian Koleksi</a>
            </div>
        </div>
    </div>

    <script src="/main_display/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="/main_display/vendor/mdb/mdb.min.js"></script>
  </body>
</html>