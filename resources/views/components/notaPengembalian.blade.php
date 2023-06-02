
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
                #capture * {page-break-inside: avoid;}
            }
        </style>
    </head>

    {{-- <body onload="window.print()"> --}}
    <body>
        <div id="btn" class="container ms-0">
            <a class="btn btn-secondary mt-2" id="btn" href="/sirkulasi/mandiri/pengembalian" style="width:500px;">Back</a>
            <button class="btn btn-primary mt-2" id="btn" onclick="window.print()" style="width:500px;">Print</button>
        </div>
        <div id="capture" class="p-2" {{-- style="display: inline-flex" --}}>
            <div class="m-1" style="width:500px; height: 100%;">
                <hr style="border-top: 2px dotted rgb(0, 0, 0); pading:0px; margin:0px;">
                <h2 class="d-flex justify-content-center"><b>BADAN PERPUSTAKAAN</b></h2>
                <h5 class=" d-flex justify-content-center"><b>UNIVERSITAS 17 AGUSTUS SURABAYA</b></h5>
                <div class="d-flex justify-content-center">Graha Wiyata Untag Surabaya - Jl.</div>
                <div class="d-flex justify-content-center">Semolowaru 45 Surabaya</div>
                <div class="d-flex justify-content-center">031-5921516</div>
                <div class="d-flex justify-content-center">perpus@untag-sby.ac.id</div>
                <hr class="mt-2" style="border-top: 2px dotted rgb(0, 0, 0); pading:0px; margin:0px;">
                <div class="row ps-3 pe-3 mt-2 mb-2">
                    <div class="col-6" style="font-size:14px;">{{ date('d-M-Y') }}</div>
                    <div class="col-6 d-flex justify-content-end" style="font-size:14px;">{{ date('H:i') }} (WIB)</div>
                </div>
                <hr style="border-top: 2px dotted rgb(0, 0, 0); pading:0px; margin:0px;">
                <div class="ps-3">
                    <b style="font-size:14px;">Nama Anggota<pre style="display: inline;">  </pre>: {{ Auth::user()->name }}</b><br>
                    <b style="font-size:14px;">Nomor Anggota<pre style="display: inline;"> </pre>: {{ Auth::user()->id }}</b><br>
                    <b style="font-size:14px;">Jenis Transaksi <pre style="display: inline;">  </pre>: Pengembalian</b><br>
                </div>
                <hr class="mt-2" style="border-top: 2px dotted rgb(0, 0, 0); pading:0px; margin:0px;">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" style="font-size:11px;">No</th>
                        <th scope="col" style="font-size:11px;">Kode</th>
                        <th scope="col" style="font-size:11px;">Judul</th>
                        <th scope="col" style="font-size:11px;">Terlambat</th>
                        <th scope="col" style="font-size:11px;">Tgl. Pinjam</th>
                        <th scope="col" style="font-size:11px;">Jatuh Tempo</th>
                        <th scope="col" style="font-size:11px;">Tgl. Kembali</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $telat_total = 0; ?>
                    @foreach($items as $a=>$item)
                      <tr>
                        <td style="font-size:11px;">{{ $a+1 }}</th>
                        <td style="font-size:11px;">{{ $item->copy_number }}</td>
                        <td style="font-size:11px;width:25%;">{{ $item->buku->judul }}</td>
                        <?php
                          $later = new DateTime();
                          $earlier = new DateTime(date('d-m-Y', strtotime($item->created_at.'+'.Auth::user()->keanggotaan->masa_aktif_pinjam.' day')));
                          if($later > $earlier) $telat = $later->diff($earlier)->format("%a");
                          else $telat = 0;
                          $telat_total += $telat;
                        ?>
                        <td style="font-size:11px;">{{ $telat }} Hari</td>
                        <td style="font-size:11px;">{{ $item->created_at->format('d-m-Y') }}</td>
                        <td style="font-size:11px;">{{ date('d-m-Y', strtotime($item->created_at.'+'.Auth::user()->keanggotaan->masa_aktif_pinjam.' day'))}}</td>
                        <td style="font-size:11px;">{{ date('d-m-Y') }}</td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                  <hr style="border-top: 2px dotted rgb(0, 0, 0); pading:0px; margin:0px;">
                  <div class="ps-3 row">
                    <div class="col-6">
                      <b style="font-size:14px;">Denda Keterlambatan</b><br>
                    </div>
                    <div class="col-3">
                        <b class="d-flex justify-content-center" style="font-size:13px;">Denda Per Hari</b>
                        <p class="d-flex justify-content-center">Rp. {{ number_format(Auth::user()->keanggotaan->denda_per_hari, 0, '','.')}}</p>
                    </div>
                    <div class="col-3">
                        <b class="d-flex justify-content-center" style="font-size:13px;">Bayar Denda</b>
                        <p class="d-flex justify-content-center">Rp. {{number_format(Auth::user()->keanggotaan->denda_per_hari*$telat_total, 0, '','.')}}</p>

                    </div>
                  </div>
                  <hr style="border-top: 2px dotted rgb(0, 0, 0); pading:0px; margin:0px;">
                  <div class="ps-3">
                      <b style="font-size:12px;">Notes</b><br>
                      <b style="font-size:12px;">Bawa dan tunjukkan struk bukti transaksi ini kepada petugas !!!</b><br>
                  </div>
                  <hr style="border-top: 2px dotted rgb(0, 0, 0); pading:0px; margin:0px;">
                  <div class="d-flex justify-content-center">Tanda Tangan</div>
                  <div class="row">
                    <div class="col-6 d-flex justify-content-center">Petugas</div>
                    <div class="col-6 d-flex justify-content-center">Peminjam</div>
                  </div>
                  <div style="height: 100px"></div>
                  <hr style="border-top: 2px dotted rgb(0, 0, 0); pading:0px; margin:0px;">
            </div>
        </div>

        
        <script src="/main_display/vendor/jquery/jquery-3.6.4.min.js"></script>
        <script src="/main_display/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>

</html>