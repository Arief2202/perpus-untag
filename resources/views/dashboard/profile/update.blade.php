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
    <form method="POST" action="/dashboard/keanggotaan/daftar-akun/update">@csrf
        @if(isset($error))@dd($error)@endif
        <input type="hidden" id="id" name="id" value="{{ $user->id }}">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="createModal"><b>Edit Keanggotaan</b></h1>
            <a type="button" class="btn-close" aria-label="Close" href="/dashboard/user/account/data-diri"></a>
        </div>
        @if (\Session::has('message'))
            <div class="alert alert-danger mt-1 p-2 me-4">{!! \Session::get('message') !!}</div>
        @endif
        <div class="modal-body mt-4">
            <div class="row">
                <div class="mb-3 col-2">
                    <label for="foto" class="form-label">Foto</label><br>
                    @if($user->foto == null)
                        <img src="/img/default_profile.jpg" height="100vh">
                    @else
                    <img src="/img/user/{{ $user->foto }}" height="100vh">
                    @endif
                </div>
                <div class="col-4">
                    <label for="username" class="form-label">Update Foto</label>
                    <input type="file" class="form-control" id="username" name="username" value="{{ $user->username }}" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Nomor Anggota</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
            </div>
        </div>
        <div class="modal-footer">
            <a type="button" class="btn btn-secondary me-3" href="/dashboard/user/account/data-diri">Cancel</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
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