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
    <form method="POST" action="/dashboard/user/account/update-password">@csrf
        <input type="hidden" id="id" name="id" value="{{ $user->id }}">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="createModal"><b>Ubah Password</b></h1>
            <a type="button" class="btn-close" aria-label="Close" href="/dashboard/user/account/data-diri"></a>
        </div>
        @if (\Session::has('message'))
            <div class="alert alert-danger mt-1 p-2 me-4">{!! \Session::get('message') !!}</div>
        @endif
        <div class="modal-body mt-4">
            <div class="mb-3">
                <label for="oldpassword" class="form-label">Password Lama</label>
                <input type="password" class="form-control" id="oldpassword" name="oldpassword" required>
            </div>
            <div class="mb-3">
                <label for="newpassword" class="form-label">Password Baru</label>
                <input type="password" class="form-control" id="newpassword" name="newpassword" required>
            </div>
            <div class="mb-3">
                <label for="cpassword" class="form-label">Konfirmasi Password Baru</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword" required>
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