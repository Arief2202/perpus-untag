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
    <form method="POST" action="/dashboard/pengolahan/buku/create" enctype="multipart/form-data">@csrf
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="createModal"><b>Tambahkan Buku</b></h1>
            <a type="button" class="btn-close" aria-label="Close" href="/dashboard/pengolahan/buku"></a>
        </div>
        <div class="modal-body mt-4">
            <div class="mb-3 img-preview">
                <label for="foto" class="form-label">Preview Foto Sampul</label><br>
                <img src="/img/NoImage.png" height="200vh" id="previewImg" class="img-preview" >
            </div>
            <div class="mb-3">
                <label for="sampul" class="form-label">Upload Foto Sampul</label>
                <input type="file" class="form-control" id="sampul" name="sampul" onchange="updatePreview()">
            </div>
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul">
            </div>
            <div class="mb-3">
                <label for="judul" class="form-label">Deskripsi</label>
                <textarea type="text" class="form-control" id="deskripsi" name="deskripsi" rows="5"></textarea>
            </div>
            <div class="mb-3">
                <label for="pengarang" class="form-label">Pengarang</label>
                <input type="text" class="form-control" id="pengarang" name="pengarang">
            </div>
            <div class="mb-3 col-4">
                <label for="impresium" class="form-label">Impresium</label>
                <input type="text" class="form-control" id="impresium" name="impresium">
            </div>
            <div class="mb-3">
                <div class="col-4">
                    <label for="kolasi" class="form-label">Kolasi</label>
                    <input type="text" class="form-control" id="kolasi" name="kolasi">
                </div>
            </div>
            <div class="mb-3">
                <div class="col-4">
                    <label for="isbn_issn" class="form-label">ISBN/ISSN</label>
                    <input type="number" class="form-control" id="isbn_issn" name="isbn_issn">
                </div>
            </div>
            <div class="mb-3 col-4">
                <label for="no_inventaris" class="form-label">Nomor Inventaris</label>
                <input type="text" class="form-control" id="no_inventaris" name="no_inventaris">
            </div>
            <div class="mb-3">
                <div class="row">
                    <label for="prefix" class="form-label">Nomor Kode</label>
                    <div class="col-4">
                        <div class="input-group">
                            <span class="input-group-text">Prefix</span>
                            <input type="text" class="form-control" name="prefix" id="prefix" value="P">
                            <span class="input-group-text">Length</span>
                            <input type="number" class="form-control" name="length_code" id="length_code" value="5">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group">
                            <span class="input-group-text">Preview</span>
                            <input type="text" class="form-control" id="preview" value="P00000" disabled style="background-color:rgb(228, 228, 228); color:black;">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group">
                            <span class="input-group-text">Jumlah Buku</span>
                            <input type="number" class="form-control" name="jumlah" id="jumlah" required>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="mb-3">
                <label for="bahasa" class="form-label">Bahasa</label>
                <input type="text" class="form-control" id="bahasa" name="bahasa">
            </div> --}}
            <div class="form-group mb-3 col-4">
                <label for="exampleFormControlSelect1">Bahasa</label>
                <select class="form-control" id="exampleFormControlSelect1" name="bahasa">
                    <option value="indonesia">Indonesia</option>
                    <option value="inggris">Inggris</option>
                </select>
            </div>
            <div class="mb-3 col-4">
                <label for="prodi" class="form-label">Prodi</label>
                <input type="text" class="form-control" id="prodi" name="prodi">
            </div>
            <div class="mb-3 col-4">
                <label for="lokasi" class="form-label">Lokasi Buku</label>
                <input type="text" class="form-control" id="lokasi" name="lokasi">
            </div>
        </div>
        <div class="modal-footer">
        <a type="button" class="btn btn-secondary me-3" href="/dashboard/pengolahan/buku">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    @include('components.cardClose')
    
    

@endsection

@section('script')
    <script type="text/javascript">
        function updatePreview(){
            const image = document.getElementById("sampul");
            document.getElementById("previewImg").src = URL.createObjectURL(image.files[0]);
        }
        $(document).ready( function () {
            $("#prefix").on("change keyup paste", function(){
                changePreview();
            });
            $("#length_code").on("change keyup paste", function(){
                changePreview();
            });
            $("#length_code").on("change keyup paste", function(){
                changePreview();
            });
            function changePreview(){
                var prefix = $("#prefix").val();
                var length = $("#length_code").val();
                var numberZero = "";
                for(let i = 0; i < length; i++){
                    numberZero += "0";
                }
                $('#preview').val(prefix+numberZero);
            }
        } );
    </script>
    {{-- @if (\Session::has('success'))
        <script type="text/javascript">
            $(document).ready( function () {
            }
        </script>
    @endif --}}
    
    @if(\Session::has('error'))
        <script type="text/javascript">
            $(document).ready( function () {
                alert('Prefix Telah digunakan oleh buku lain !');
            } );
        </script>
    @endif
@endsection