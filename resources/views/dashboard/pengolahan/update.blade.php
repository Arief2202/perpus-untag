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
    <form method="POST" action="/dashboard/pengolahan/buku/update">@csrf
        <input type="hidden" id="id" name="id" value="{{ $buku->id }}">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="createModal"><b>Tambahkan Buku</b></h1>
            <a type="button" class="btn-close" aria-label="Close" href="/dashboard/pengolahan/buku"></a>
        </div>
        <div class="modal-body mt-4">
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" value="{{ $buku->judul }}">
            </div>
            <div class="mb-3">
                <label for="judul" class="form-label">Deskripsi</label>
                <textarea type="text" class="form-control" id="deskripsi" name="deskripsi" rows="5" value="{{ $buku->deskripsi }}">{{ $buku->deskripsi }}</textarea>
            </div>
            <div class="mb-3">
                <label for="pengarang" class="form-label">Pengarang</label>
                <input type="text" class="form-control" id="pengarang" name="pengarang" value="{{ $buku->pengarang }}">
            </div>
            <div class="mb-3 col-4">
                <label for="impresium" class="form-label">Impresium</label>
                <input type="text" class="form-control" id="impresium" name="impresium" value="{{ $buku->impresium }}">
            </div>
            <div class="mb-3">
                <div class="col-4">
                    <label for="kolasi" class="form-label">Kolasi</label>
                    <input type="text" class="form-control" id="kolasi" name="kolasi" value="{{ $buku->kolasi }}">
                </div>
            </div>
            <div class="mb-3">
                <div class="col-4">
                    <label for="isbn_issn" class="form-label">ISBN/ISSN</label>
                    <input type="number" class="form-control" id="isbn_issn" name="isbn_issn" value="{{ $buku->isbn_issn }}">
                </div>
            </div>
            <div class="mb-3">
                <label for="no_inventaris" class="form-label">Nomor Inventaris</label>
                <input type="text" class="form-control" id="no_inventaris" name="no_inventaris" value="{{ $buku->no_inventaris }}">
            </div>
            <div class="mb-3">
                <div class="row">
                    <label for="prefix" class="form-label">Nomor Kode</label>
                    <div class="col-4">
                        <div class="input-group">
                            <span class="input-group-text">Prefix</span>
                            <input type="text" class="form-control" name="prefix" id="prefix" value="{{ $buku->prefix }}">
                            <span class="input-group-text">Length</span>
                            <input type="number" class="form-control" name="length_code" id="length_code" value="{{ $buku->length_code }}">
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
                            <input type="number" class="form-control" name="jumlah" id="jumlah" value="{{ $buku->jumlah }}" required>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="form-group mb-3">
                <label for="exampleFormControlSelect1">Bahasa</label>
                <select class="form-control" id="exampleFormControlSelect1">
                    <option></option>
                    <option value="indonesia" @if($buku->bahasa == "indonesia") selected @endif>Indonesia</option>
                    <option value="inggris" @if($buku->bahasa == "inggris") selected @endif>Inggris</option>
                    <option value="jepang" @if($buku->bahasa == "jepang") selected @endif>Jepang</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="prodi" class="form-label">Prodi</label>
                <input type="text" class="form-control" id="prodi" name="prodi" value="{{ $buku->prodi }}">
            </div>
            <div class="mb-3">
                <label for="lokasi" class="form-label">Lokasi Buku</label>
                <input type="text" class="form-control" id="lokasi" name="lokasi" value="{{ $buku->lokasi }}">
            </div>
        </div>
        <div class="modal-footer">
        <a type="button" class="btn btn-danger me-auto" id="deleteButton">Delete</a>
        <a type="button" class="btn btn-secondary me-3" href="/dashboard/pengolahan/buku">Cancel</a>
        <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
    <form method="POST" action="/dashboard/pengolahan/buku/delete" id="delete">@csrf
        <input type="hidden" name="id" value="{{ $buku->id }}">
    </form>
    @include('components.cardClose')
    
    

@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready( function () {
            changePreview();
            $("#deleteButton").on("click", function(){
                $( "#delete" ).trigger( "submit" );
            });
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