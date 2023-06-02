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
               <a class="btn btn-primary me-4" href="/dashboard/pengolahan/buku/add">Tambahkan Data</a>
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
                                {{-- <th class="th" scope="col">Label</th> --}}
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
                                {{-- <td>{{ $buku->label }}</td> --}}
                                <td>{{ $buku->judul }}</td>
                                <td>{{ $buku->pengarang }}</td>
                                <td>{{ $buku->impresium }}</td>
                                <td>{{ $buku->kolasi }}</td>
                                <td>{{ $buku->isbn_issn }}</td>
                                <td>{{ $buku->jumlah }}</td>
                                <td>
                                    <div class="row">
                                        <a href="/dashboard/pengolahan/buku/update/{{ $buku->id }}" class="btn btn-primary" style="width:30px; height:30px; padding:0px;"><i class='bx bx-pencil' style="font-size: 20px;margin:3px;"></i></a>
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
    
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModal" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="POST" action="/dashboard/pengolahan/buku/create">@csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createModal">Tambahkan Buku</h1>
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

      
    @if(isset($_GET['id']))
    <div class="modal fade show" id="updateModal" tabindex="-1" aria-labelledby="updateModal" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="POST" action="/dashboard/pengolahan/buku/update">@csrf
                <input type="hidden" name="id" value="{{ $detail_buku->id }}">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateModal">Update Buku</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="label" class="form-label">Label</label>
                        <input type="text" class="form-control" id="label" name="label" value="{{ $detail_buku->label }}">
                    </div>
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" value="{{ $detail_buku->judul }}">
                    </div>
                    <div class="mb-3">
                        <label for="pengarang" class="form-label">Pengarang</label>
                        <input type="text" class="form-control" id="pengarang" name="pengarang" value="{{ $detail_buku->pengarang }}">
                    </div>
                    <div class="mb-3">
                        <label for="impresium" class="form-label">Impresium</label>
                        <input type="text" class="form-control" id="impresium" name="impresium" value="{{ $detail_buku->impresium }}">
                    </div>
                    <div class="mb-3">
                        <label for="kolasi" class="form-label">Kolasi</label>
                        <input type="text" class="form-control" id="kolasi" name="kolasi" value="{{ $detail_buku->kolasi }}">
                    </div>
                    <div class="mb-3">
                        <label for="isbn_issn" class="form-label">ISBN/ISSN</label>
                        <input type="text" class="form-control" id="isbn_issn" name="isbn_issn" value="{{ $detail_buku->isbn_issn }}">
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ $detail_buku->jumlah }}">
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
    @endif

@endsection

@section('script')
    @if(isset($_GET['id']))
        <script type="text/javascript">
            $(document).ready( function () {
                $('#updateModal').modal('toggle');
                $('#updateModal').modal('show');
                $('#updateModal').modal('hide');
                $('#updateModal').on('hide.bs.modal', function (e) {
                    setTimeout(function() {window.location.href = "/dashboard/pengolahan/buku";}, 100);                    
                })
            } );
        </script>
    @endif
    <script type="text/javascript">
        $(document).ready( function () {
            $('#table').DataTable();
        } );
    </script>
@endsection