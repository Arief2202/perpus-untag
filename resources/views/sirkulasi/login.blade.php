<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sirkulasi - Login</title>
    <link href="/main_display/img/favicon.ico" rel="icon">
    <link href="/main_display/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="/main_display/vendor/mdb/all.min.css" rel="stylesheet">
    <link href="/main_display/vendor/mdb/mdb.min.css" rel="stylesheet">
    <link href="/main_display/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body class="h-100" style="background-color: #e4e4e4">
    <div class="h-100 d-flex justify-content-center align-items-center">
        <div>
            <h1 class="d-flex justify-content-center" ><b>SIRKULASI MANDIRI</b></h1>
            <p  class="d-flex justify-content-center" >Badan Perpustakaan Universitas 17 Agustus 1945 Surabaya</p><br><br>
            <h5 class="d-flex justify-content-center" ><b>SILAHKAN LOGIN UNTUK MELAKUKAN MENU SIRKULASI MANDIRI</b></h5>

            <div class="d-flex justify-content-center">                
                <form class="p-4 col-10" style="background-color: #e4e4e4" method="POST" action="/loginSirkulasi">@csrf
                    <div class="d-flex justify-content-center">
                        <div class="form-outline mb-3">
                            <input type="text" id="form12" name="email" class="form-control" style="background-color: #f3f3f3" required/>
                            <label class="form-label" for="form12">Nomor Anggota</label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="form-outline mb-3">
                            <input type="password" id="form12" name="password" class="form-control" style="background-color: #f3f3f3" required/>
                            <label class="form-label" for="form12">Password</label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary d-flex justify-content-end">Masuk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="/main_display/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="/main_display/vendor/mdb/mdb.min.js"></script>
  </body>
</html>