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
                <h4 class="card-title"><b>Keanggotaan</b></h4>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
               <a class="btn btn-primary me-4" href="/dashboard/keanggotaan/daftar-keanggotaan/create">Tambahkan Data</a>
            </div>
        </div>
        <div style="max-height: 70vh; overflow-y:auto;">
            <div class="card-text me-3">          
                <div style="max-height: auto; overflow-y:auto;">
                    <div class="card-text me-3">
                        <table class="table" id="table">
                            <thead class="thead">
                                <tr>
                                <th class="th" scope="col">No</th>
                                <th class="th" scope="col">Nama Keanggotaan</th>
                                <th class="th" scope="col">Max Peminjaman</th>
                                <th class="th" scope="col">Masa Aktif Peminjaman</th>
                                <th class="th" scope="col">Denda per Hari</th>
                                <th class="th" scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($keanggotaans as $index=>$keanggotaan)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        {{-- <td>{{ $buku->label }}</td> --}}
                                        <td>{{ $keanggotaan->nama_keanggotaan }}</td>
                                        <td>{{ $keanggotaan->max_pinjam }} Pcs</td>
                                        <td>{{ $keanggotaan->masa_aktif_pinjam }} Hari</td>
                                        <td>Rp. {{ $keanggotaan->denda_per_hari }}</td>
                                        <td>
                                            <div class="row">
                                                <a href="/dashboard/keanggotaan/daftar-keanggotaan/update/{{ $keanggotaan->id }}" class="btn btn-primary" style="width:30px; height:30px; padding:0px;"><i class='bx bx-pencil' style="font-size: 20px;margin:3px;"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                {{-- @for($a = 0; $a < 100; $a++)
                                <tr>
                                <td>{{ $a+1 }}</td>
                                <td>Column {{ $a+1 }}</td>
                                <td>Column {{ $a+1 }}</td>
                                <td>Column {{ $a+1 }}</td>
                                <td>Column {{ $a+1 }}</td>
                                <td>Column {{ $a+1 }}</td>
                                </tr>
                                @endfor --}}
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