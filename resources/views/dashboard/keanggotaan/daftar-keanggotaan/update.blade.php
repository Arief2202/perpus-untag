@extends('layouts.main')
@section('navDashboardClass') active @endsection

@section('title')
Badan Perpustakaan Untag Surabaya
@endsection

@section('content')
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            /* display: none; <- Crashes Chrome on hover */
            -webkit-appearance: none;
            margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
        }

        input[type=number] {
            -moz-appearance:textfield; /* Firefox */
        }
    </style>
    @include('components.cardOpen')
    <form method="POST" action="/dashboard/keanggotaan/daftar-keanggotaan/update">@csrf
        <input type="hidden" id="id" name="id" value="{{ $keanggotaan->id }}">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="createModal"><b>Tambahkan Buku</b></h1>
            <a type="button" class="btn-close" aria-label="Close" href="/dashboard/keanggotaan/daftar-keanggotaan"></a>
        </div>
        <div class="modal-body mt-4">
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="nama_keanggotaan" class="form-label">Nama Keanggotaan</label>
                    <input type="text" class="form-control" id="nama_keanggotaan" name="nama_keanggotaan" value="{{ $keanggotaan->nama_keanggotaan }}" required>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="denda_per_hari" class="form-label">Denda Per Hari</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon3">Rp. </span>
                        <input type="number" class="form-control" id="denda_per_hari" name="denda_per_hari" value="{{ $keanggotaan->denda_per_hari }}" required>
                    </div>
                </div>
                <div class="mb-3 col-md-6">  
                    <label for="max_pinjam" class="form-label">Max Peminjaman</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="max_pinjam" name="max_pinjam" value="{{ $keanggotaan->max_pinjam }}" required>
                        <span class="input-group-text" id="basic-addon3">Pcs</span>
                    </div>
                </div>
                    <div class="mb-3 col-md-6">
                    <label for="masa_aktif_pinjam" class="form-label">Masa Aktif Peminjaman</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="masa_aktif_pinjam" name="masa_aktif_pinjam" value="{{ $keanggotaan->masa_aktif_pinjam }}" required>
                        <span class="input-group-text" id="basic-addon3">Hari</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a type="button" class="btn btn-danger me-auto" id="deleteButton">Delete</a>
            <a type="button" class="btn btn-secondary me-3" href="/dashboard/keanggotaan/daftar-keanggotaan">Cancel</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
    <form method="POST" action="/dashboard/keanggotaan/daftar-keanggotaan/delete" id="delete">@csrf
        <input type="hidden" name="id" value="{{ $keanggotaan->id }}">
    </form>
    @include('components.cardClose')
    
    

@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready( function () {
            $("#deleteButton").on("click", function(){
                $( "#delete" ).trigger( "submit" );
            });
        } );
    </script>
@endsection