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
                <h4 class="card-title"><b>Pengolahan Buku</b></h4>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
               <button class="btn btn-primary me-4" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambahkan Data</button>
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
                                <th class="th" scope="col">Label</th>
                                <th class="th" scope="col">Judul</th>
                                <th class="th" scope="col">Pengarang</th>
                                <th class="th" scope="col">Impresium</th>
                                <th class="th" scope="col">Kolasi</th>
                                <th class="th" scope="col">ISBN/ISSN</th>
                                <th class="th" scope="col">Jumlah</th>
                                <th class="th" scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bukus as $index=>$buku)
                                <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $buku->label }}</td>
                                <td>{{ $buku->judul }}</td>
                                <td>{{ $buku->pengarang }}</td>
                                <td>{{ $buku->impresium }}</td>
                                <td>{{ $buku->kolasi }}</td>
                                <td>{{ $buku->isbn_issn }}</td>
                                <td>{{ $buku->jumlah }}</td>
                                <td>
                                    <div class="row">
                                        {{-- <div class="col-2">
                                            <a class="btn btn-primary" style="width:30px; height:30px; padding:0px;"><i class='bx bx-show' style="font-size: 20px;margin:3px;"></i></a>
                                        </div> --}}
                                        <div class="col-2">
                                            <a class="btn btn-primary" style="width:30px; height:30px; padding:0px;"><i class='bx bx-pencil' style="font-size: 20px;margin:3px;"></i></a>
                                        </div>
                                        <div class="col-2">
                                            <form method="POST" action="/dashboard/pengolahan/buku/delete">@csrf
                                                <input type="hidden" name="id" value="{{ $buku->id }}">
                                                <button type="submit" class="btn btn-primary" style="width:30px; height:30px; padding:0px;"><i class='bx bxs-trash' style="font-size: 20px;margin:3px;"></i></a>
                                            </form>
                                        </div>
                                        <div class="col-2">
                                            <a href="data:image/png;base64,{{DNS2D::getBarcodePNG($buku->label, 'QRCODE', 5,5)}}" download="{{ $buku->label }}.png" class="btn btn-primary" style="width:30px; height:30px; padding:0px;"><i class='bx bxs-cloud-download' style="font-size: 20px;margin:3px;"></i></a>
                                        </div>
                                    </div>
                                </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @include('components.cardClose')
    
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="POST" action="/dashboard/pengolahan/buku/create">@csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambahkan Buku</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="label" class="form-label">Label</label>
                        <input type="text" class="form-control" id="label" name="label">
                    </div>
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul">
                    </div>
                    <div class="mb-3">
                        <label for="pengarang" class="form-label">Pengarang</label>
                        <input type="text" class="form-control" id="pengarang" name="pengarang">
                    </div>
                    <div class="mb-3">
                        <label for="impresium" class="form-label">Impresium</label>
                        <input type="text" class="form-control" id="impresium" name="impresium">
                    </div>
                    <div class="mb-3">
                        <label for="kolasi" class="form-label">Kolasi</label>
                        <input type="text" class="form-control" id="kolasi" name="kolasi">
                    </div>
                    <div class="mb-3">
                        <label for="isbn_issn" class="form-label">ISBN/ISSN</label>
                        <input type="text" class="form-control" id="isbn_issn" name="isbn_issn">
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah">
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
          </div>
        </div>
      </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready( function () {
            $('#table').DataTable();
        } );
    </script>
@endsection