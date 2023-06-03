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
    <form method="POST" action="/dashboard/keanggotaan/daftar-akun/create" enctype="multipart/form-data">@csrf
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="createModal"><b>Create Anggota</b></h1>
            <a type="button" class="btn-close" aria-label="Close" href="/dashboard/keanggotaan/daftar-akun"></a>
        </div>
        @if (\Session::has('message'))
            <div class="alert alert-danger mt-1 p-2 me-4">{!! \Session::get('message') !!}</div>
        @endif
        <div class="modal-body mt-4">
            {{-- <div class="row mb-3">
            </div> --}}
            <div class="mb-3 img-preview">
                <label for="foto" class="form-label">Preview Foto</label><br>
                <img src="/img/default_profile.jpg" height="100vh" id="preview" class="img-preview" >
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Upload Foto</label>
                <input type="file" class="form-control" id="foto" name="foto" onchange="updatePreview()">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Nomor Anggota</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat">
            </div>
            <div class="mb-3">
                <label for="telp" class="form-label">No Telp</label>
                <input type="number" class="form-control" id="telp" name="telp">
            </div>
            <div class="form-group mb-3">
                <label for="keanggotaan_id">Jenis Keanggotaan</label>
                <select class="form-control" id="keanggotaan_id" name="keanggotaan_id">
                    @foreach($keanggotaans as $keanggotaan)
                        @if(Auth::user()->keanggotaan_id == 1)
                            <option value="{{ $keanggotaan->id }}">{{ $keanggotaan->nama_keanggotaan }}</option>
                        @elseif($keanggotaan->id != 1 && $keanggotaan->id != 2)
                            <option value="{{ $keanggotaan->id }}">{{ $keanggotaan->nama_keanggotaan }}</option>
                        @endif
                    @endforeach
                </select>
              </div>
              <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" name="password" required>
              </div>
              <div class="mb-3">
                  <label for="cpassword" class="form-label">Confirm Password</label>
                  <input type="password" class="form-control" id="cpassword" name="cpassword" required>
              </div>
        </div>
        <div class="modal-footer">
            <a type="button" class="btn btn-secondary me-3" href="/dashboard/keanggotaan/daftar-akun">Cancel</a>
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
    @include('components.cardClose')
    
    

@endsection

@section('script')
    <script type="text/javascript">
        function updatePreview(){
            const image = document.getElementById("foto");
            document.getElementById("preview").src = URL.createObjectURL(image.files[0]);
        }
    </script>
@endsection