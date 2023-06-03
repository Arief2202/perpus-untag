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
    <form method="POST" action="/dashboard/keanggotaan/daftar-akun/update" enctype="multipart/form-data">@csrf
        @if(isset($error))@dd($error)@endif
        <input type="hidden" id="id" name="id" value="{{ $user->id }}">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="createModal"><b>Edit Keanggotaan</b></h1>
            <a type="button" class="btn-close" aria-label="Close" href="/dashboard/keanggotaan/daftar-akun"></a>
        </div>
        @if (\Session::has('message'))
            <div class="alert alert-danger mt-1 p-2 me-4">{!! \Session::get('message') !!}</div>
        @endif
        <div class="modal-body mt-4">
            <div class="mb-3 img-preview">
                <label for="foto" class="form-label">Preview Foto</label><br>
                @if(!$user->foto)
                <img src="/img/default_profile.jpg" height="100vh" id="preview" class="img-preview" >
                @else
                <img src="/{{ $user->foto }}" height="100vh" id="preview" class="img-preview" >
                @endif
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Upload Foto</label>
                <input type="file" class="form-control" id="foto" name="foto" onchange="updatePreview()">
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
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $user->alamat }}" >
            </div>
            <div class="mb-3">
                <label for="telp" class="form-label">No Telp</label>
                <input type="text" class="form-control" id="telp" name="telp" value="{{ $user->telp }}" >
            </div>
            <div class="form-group mb-3">
                <label for="keanggotaan_id">Jenis Keanggotaan</label>
                <select class="form-control" id="keanggotaan_id" name="keanggotaan_id">
                    @foreach($keanggotaans as $keanggotaan)
                        @if(Auth::user()->keanggotaan_id == 1)
                            <option value="{{ $keanggotaan->id }}" @if($keanggotaan->id == $user->keanggotaan_id) selected @endif>{{ $keanggotaan->nama_keanggotaan }}</option>
                        @elseif($keanggotaan->id != 1 && $keanggotaan->id != 2)
                            <option value="{{ $keanggotaan->id }}" @if($keanggotaan->id == $user->keanggotaan_id) selected @endif>{{ $keanggotaan->nama_keanggotaan }}</option>
                        @endif
                    @endforeach
                </select>
              </div>
              <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" name="password">
              </div>
              <div class="mb-3">
                  <label for="cpassword" class="form-label">Confirm Password</label>
                  <input type="password" class="form-control" id="cpassword" name="cpassword">
              </div>
        </div>
        <div class="modal-footer">
            <a type="button" class="btn btn-danger me-auto" id="deleteButton">Delete</a>
            <a type="button" class="btn btn-secondary me-3" href="/dashboard/keanggotaan/daftar-akun">Cancel</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
    <form method="POST" action="/dashboard/keanggotaan/daftar-akun/delete" id="delete">@csrf
        <input type="hidden" name="id" value="{{ $user->id }}">
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
    <script type="text/javascript">
        function updatePreview(){
            const image = document.getElementById("foto");
            document.getElementById("preview").src = URL.createObjectURL(image.files[0]);
        }
    </script>
@endsection