@extends('layouts.main')
@section('navDashboardClass') active @endsection

@section('title')
Badan Perpustakaan Untag Surabaya
@endsection

@section('style')
    <style>
        .dataTables_paginate {margin-top: 15px;}
    </style>
@endsection

@section('content')
    @include('components.cardOpen')
        @if(isset($errorMessage))
            <div class="alert alert-danger mt-1 p-2 me-4">{{ $errorMessage }}</div>
        @endif
        <div class="row mb-3">
            <div class="col-md-6">
                <h4 class="card-title"><b>{{ $title1 }}</b> {{ $title2 }}</h4>
            </div>
            {{-- <div class="col-md-6 d-flex justify-content-end">
               <button class="btn btn-primary me-4">Tambahkan Data</button>
            </div> --}}
        </div>
        <div style="max-height: 70vh; overflow-y:auto;">
            <div class="card-text me-3">          
                <div style="max-height: auto; overflow-y:auto;">
                    <div class="card-text me-3">
                        <table class="table" id="table">
                            <thead class="thead">
                                <tr>
                                <th class="th" scope="col">No</th>
                                <th class="th" scope="col">Email Peminjam</th>
                                <th class="th" scope="col">Nomor Kode</th>
                                <th class="th" scope="col">Judul</th>
                                <th class="th" scope="col">Pengarang</th>
                                <th class="th" scope="col">Tanggal Pinjam</th>
                                <th class="th" scope="col">Jatuh Tempo</th>
                                <th class="th" scope="col">Tanggal Kembali</th>
                                <th class="th" scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($peminjamans as $a=>$peminjaman)
                                <?php
                                    $later = new DateTime();
                                    $jatuhTempo = date('d-M-Y', strtotime($peminjaman->created_at.'+'.$peminjaman->user->keanggotaan->masa_aktif_pinjam.' day'));
                                    $earlier = new DateTime($jatuhTempo);
                                    if($later > $earlier) $telat = $later->diff($earlier)->format("%a");
                                    else $telat = 0;
                                ?>
                                <tr>
                                <td>{{ $a+1 }}</td>
                                <td>{{ $peminjaman->user->email }}</td>
                                <td>{{ $peminjaman->copy_number }}</td>
                                <td>{{ $peminjaman->buku->judul }}</td>
                                <td>{{ $peminjaman->buku->pengarang }}</td>
                                <td>{{ $peminjaman->created_at->format('d-M-Y') }}</td>
                                @if($peminjaman->status == 1 || $peminjaman->status == 2)
                                    <td><div class="alert alert-{{ $later > $earlier ? 'danger' : 'success' }} d-flex justify-content-center" style="margin:0;padding:0;width:120px;">{{ $jatuhTempo }}</div></td>
                                    <td></td>
                                    <td><div class="d-flex justify-content-center"><button class="btn btn-danger" disabled>Dipinjam</button></div></td>
                                @elseif($peminjaman->status == 3)
                                    <?php
                                        $later = new DateTime($peminjaman->updated_at->format('d-M-Y'));
                                    ?>
                                    <td>{{ $jatuhTempo }}</td>
                                    <td><div class="alert alert-{{ $later > $earlier ? 'danger' : 'success' }} d-flex justify-content-center" style="margin:0;padding:0;width:120px;">{{ $peminjaman->updated_at->format('d-M-Y') }}</div></td>
                                    <td><div class="d-flex justify-content-center"><button class="btn btn-success" disabled>Dikembalikan</button></div></td>
                                @endif

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @include('components.cardClose')

@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready( function () {
            $('#table').DataTable();
        } );
    </script>
@endsection