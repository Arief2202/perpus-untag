<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sirkulasi - Peminjaman</title>
    <link href="/main_display/img/favicon.ico" rel="icon">
    <link href="/main_display/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="/main_display/vendor/mdb/all.min.css" rel="stylesheet">
    <link href="/main_display/vendor/mdb/mdb.min.css" rel="stylesheet">
    <link href="/main_display/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/main_display/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
  </head>
  <body class="h-100 p-2" style="background-color: #e4e4e4">
    <div class="row" style="width:100vw;">
        <div class="col-6 pe-4 pt-4 ps-5">
            <h1 class="d-flex justify-content-start" ><b>PEMINJAMAN MANDIRI</b></h1>
            <p  class="d-flex justify-content-start" >Badan Perpustakaan Universitas 17 Agustus 1945 Surabaya</p>    
        </div>
        <div class="col-6 pt-4 pe-5">
            <div class="d-flex justify-content-end align-items-top m-2">
                <form method="POST" action="/logoutSirkulasi">@csrf
                    <div class="row">
                        <div class="col">
                            <a href="/sirkulasi/mandiri/select" class="btn btn-primary d-flex justify-content-end">Kembali</a>
                        </div>
                        <div class="col">                            
                            <button type="submit" class="btn btn-danger d-flex justify-content-end">Logout</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="container ps-5 pe-5">
            <div class="card p-3" style="background: #c7c7c7;">
                <h5><b>DETAIL ANGGOTA</b></h5>
                <div class="row mt-4">
                    <div class="col-sm-2">
                        @if(!Auth::user()->foto) <img src="/img/default_profile.jpg" width="70%">
                        @endif
                    </div>
                    <div class="col-sm">
                        <div class="mb-2" style="font-size:16px; font-weight:500;">Nomor Anggota<pre style="display: inline;"> </pre>: {{ Auth::user()->id }}</div>
                        <div class="mb-2" style="font-size:16px; font-weight:500;">Nama Anggota<pre style="display: inline;">  </pre>: {{ Auth::user()->name }}</div>
                        <div class="mb-2" style="font-size:16px; font-weight:500;">Email Anggota <pre style="display: inline;">  </pre>: {{ Auth::user()->email }}</div>
                        <div class="mb-2" style="font-size:16px; font-weight:500;">Jenis Anggota<pre style="display: inline;">   </pre>: {{ Auth::user()->keanggotaan->nama_keanggotaan }}</div>
                        <div class="mb-2" style="font-size:16px; font-weight:500;">Limit Pinjam <pre style="display: inline;">    </pre>: {{ Auth::user()->keanggotaan->max_pinjam }} Pcs</div>
                    </div>
                </div>
                <div class="row mb-3 mt-3">
                    <div class="col-4">
                        <form action="/sirkulasi/mandiri/peminjaman/add" method="POST" id="formLabel">@csrf
                            <div class="input-group">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <input type="text" class="form-control" placeholder="Scan Label QR" aria-label="Scan Label QR" name="label" aria-describedby="button-addon2" id="inputLabel" required>
                                <button class="btn btn-success" type="submit" id="submitLabel">Tambahkan</button>
                            </div>                            
                        </form>
                        @if (\Session::has('error') && \Session::has('message'))
                            <div id="alert" class="alert mt-2 @if (\Session::get('error') == false) alert-success @else alert-danger @endif" style="font-size:15px;">{!! \Session::get('message') !!}</div>
                        @endif
                    </div>   
                    <div class="col">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onclick="startScan()">Open Camera</button>
                    </div>
                    <div class="col">
                        <div class="d-flex justify-content-end">
                            <form action="">
                                <a class="btn btn-warning me-4" href="/sirkulasi/mandiri/peminjaman/nota">Cetak Bukti Pemesanan</a>
                            </form>
                            <form action="/sirkulasi/mandiri/peminjaman/checkout" method="POST">@csrf
                                <button type="submit" class="btn btn-success">Selesaikan Pemesanan</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card ps-5 pe-5 pt-2 pb-2" style="background-color:#f0f0f0">
                    <h5 class="d-flex justify-content-center"><b>KERANJANG PEMINJAMAN</b></h5>
                    <table id="table" class="display">
                        <thead>
                            <tr>
                                <th>No. </th>
                                <th>Nomor Kode</th>
                                <th>Judul</th>
                                <th>Pengarang</th>
                                <th>Tanggal Pinjam</th>
                                <th>Jatuh Tempo</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($peminjamans as $a=>$peminjaman)
                            <tr>
                                <td>{{ $a+1 }}</td>
                                <td>{{ $peminjaman->copy_number }}</td>
                                <td>{{ $peminjaman->buku->judul }}</td>
                                <td>{{ $peminjaman->buku->pengarang }}</td>
                                <td>{{ $peminjaman->created_at->format('d-M-Y') }}</td>
                                <td>{{ $peminjaman->created_at->addDays($peminjaman->user->keanggotaan->masa_aktif_pinjam)->format('d-M-Y') }}</td>
                                <td>
                                    <form action="/sirkulasi/mandiri/peminjaman/delete" method="POST">@csrf
                                        <input type="hidden" name="id" value="{{ $peminjaman->id }}">
                                        <button type="submit" class="btn btn-danger">Batal</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="card ps-5 pe-5 pt-2 pb-2 mt-4" style="background-color:#f0f0f0">

                    <h5 class="d-flex justify-content-center"><b>KOLEKSI YANG MASIH DIPINJAM</b></h5>
                    <table id="table2" class="display">
                        <thead>
                            <tr>
                                <th>No. </th>
                                <th>Nomor Kode</th>
                                <th>Judul</th>
                                <th>Pengarang</th>
                                <th>Tanggal Pinjam</th>
                                <th>Jatuh Tempo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($active_peminjamans as $a=>$peminjaman)
                            <tr>
                                <td>{{ $a+1 }}</td>
                                <td>{{ $peminjaman->copy_number }}</td>
                                <td>{{ $peminjaman->buku->judul }}</td>
                                <td>{{ $peminjaman->buku->pengarang }}</td>
                                <td>{{ $peminjaman->created_at->format('d-M-Y') }}</td>
                                <?php
                                    $later = new DateTime();
                                    $earlier = new DateTime(date('d-m-Y', strtotime($peminjaman->created_at.'+'.Auth::user()->keanggotaan->masa_aktif_pinjam.' day')));
                                ?>
                                <td><div class="alert alert-{{ $later > $earlier ? 'danger' : 'success' }} d-flex justify-content-center" style="margin:0;padding:0;width:120px;">{{ $peminjaman->created_at->addDays($peminjaman->user->keanggotaan->masa_aktif_pinjam)->format('d-M-Y') }}</div></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
              <a type="button" class="btn-close" href="/sirkulasi/mandiri/peminjaman"></a>
            </div>
            <div class="modal-body">    
                <div class="col">
                    <div id="reader" width="10px"></div>
                </div>
            </div>
          </div>
        </div>
      </div>

    <script src="/main_display/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="/main_display/vendor/mdb/mdb.min.js"></script>
    <script src="/main_display/vendor/jquery/jquery-3.6.4.min.js"></script>
    <script src="/main_display/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/main_display/vendor/html5-qrcode/html5-qrcode.min.js"></script>
    <script type="text/javascript">    
        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader",
            { fps: 10, qrbox: {width: 100, height: 100} },
            /* verbose= */ false);

        function onScanSuccess(decodedText, decodedResult) {
            // handle the scanned code as you like, for example:
            console.log(`Code matched = ${decodedText}`, decodedResult);
            html5QrcodeScanner.pause(true)
            $('#inputLabel').val(decodedText);
            $('#formLabel').submit();
        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            // console.warn(`Code scan error = ${error}`);
        }

        function startScan(){           
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        }
    </script>

    <script type="text/javascript">
        $(document).ready( function () {

            $('#table').DataTable();
            $('#table2').DataTable();
            setTimeout(function(){
                $('#alert').fadeOut();
            }, 2000);
        } );
    </script>
  </body>
</html>