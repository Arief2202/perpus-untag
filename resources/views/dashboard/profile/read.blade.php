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
        @if(isset($error))@dd($error)@endif
        <input type="hidden" id="id" name="id" value="{{ $user->id }}">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="createModal"><b>Akun Saya</b></h1>
        </div>
        @if (\Session::has('message'))
            <div class="alert alert-danger mt-1 p-2 me-4">{!! \Session::get('message') !!}</div>
        @endif
        <div class="modal-body mt-2">
            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label><br>
                @if($user->foto == null)
                    <img src="/img/default_profile.jpg" height="100vh">
                @else
                <img src="/img/user/{{ $user->foto }}" height="100vh">
                @endif
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Nomor Anggota</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" style="background-color: rgb(240, 240, 240)">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" disabled style="background-color: rgb(240, 240, 240)">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" disabled style="background-color: rgb(240, 240, 240)">
            </div>
            <div class="form-group mb-3">
                <label for="keanggotaan_id">Jenis Keanggotaan</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->keanggotaan->nama_keanggotaan }}" disabled style="background-color: rgb(240, 240, 240)">
            </div>
        </div>
        <div class="modal-footer">
            {{-- <a type="submit" class="btn btn-primary" href="/dashboard/user/account/update-profile">Update Profile</a> --}}
        </div>
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