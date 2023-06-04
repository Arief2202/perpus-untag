@extends('layouts.main')
@section('navKatalogClass') active @endsection

@section('title')
Badan Perpustakaan Untag Surabaya
@endsection
@section('style')
    <style>
        p {
          display: inline;
          color:#777777;
        }
        #more{
          color:#777777;
          font-size: 15px;
          margin-top:20px;
        }
    </style>
@endsection


@section('content')
  <main id="main">

    <!-- ======= About Section ======= -->
    <div class="container">
        <a href="/katalog" class="btn btn-secondary ms-3 mb-4 mt-2">Kembali</a>
        <div class="container">
        <div class="row mb-5">
            <div class="col-lg-2 d-flex justify-content-center">
                @if($buku->sampul)
                <img src="/{{ $buku->sampul }}" height="200px">
                @else
                <img src="/img/NoImage.png" height="200px">
                @endif
            </div>
            <div class="col-lg">
                <div id="judul"><b>{{ $buku->judul }}</b></div>
                <div id="klas">No. Klas : <p>{{ $buku->no_inventaris }}</p></div>
                <div id="pengarang">Pengarang : <p>{{ $buku->pengarang }}</p></div>
                <div id="penerbit">Penerbit : <p>{{ $buku->impresium }}</p></div>
                <div id="kolasi">Kolasi : <p>{{ $buku->kolasi }}</p></div>
                <div id="kolasi">Sinopsis : <br><p>{{ $buku->deskripsi }}</p></div>
            </div>
        </div>
        <div class="ps-2 mb-5">
            <div class="row mb-2">
                <div class="col-auto">
                    Jumlah Eksemplar : {{ $buku->jumlah }}
                </div>
                <div class="col-auto">
                    Jumlah Buku Tersedia : {{ $buku->jumlah-$peminjamans->count() }}
                </div>
                <div class="col-auto">
                    Jumlah Buku Dipinjam : {{ $peminjamans->count() }}
                </div>
            </div>
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>Eksemplar</th>
                        <th>Kode Buku</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @for($a=1; $a<=$buku->jumlah; $a++)
                    <?php
                        $label = $buku->prefix . sprintf("%0".$buku->length_code."d", $a);
                        $status = $peminjamans->where('copy_number', $label)->first() ? "Tidak Tersedia" : "Ada";
                    ?>
                    <tr>
                        <td style="width:20px;">{{ $a }}</td>
                        <td>{{ $label }}</td>
                        <td>{{ $status }}</td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
      </div>
    </div>
    
  </main><!-- End #main -->

@endsection

@section('script')
  <script type="text/javascript">
        $(document).ready( function () {
            $('#myTable').DataTable();
        });
  </script>
@endsection