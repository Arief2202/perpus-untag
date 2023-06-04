@extends('layouts.main')
@section('navDashboardClass') active @endsection

@section('title')
Badan Perpustakaan Untag Surabaya
@endsection

@section('style')
    <style>
        .dataTables_paginate {margin-top: 15px;}
        .dataTables_scroll
        {
            /* overflow:auto; */
        }
    </style>
@endsection

@section('content')
    @include('components.cardOpen')
        @if(isset($errorMessage))
            <div class="alert alert-danger mt-1 p-2 me-4">{{ $errorMessage }}</div>
        @endif
        <div class="row mb-3">
            <div class="col-md-6">
                <h4 class="card-title"><b>Admin Activity</b></h4>
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
                                <th class="th" scope="col">Nomor Anggota</th>
                                <th class="th" scope="col">Nama Admin</th>
                                <th class="th" scope="col">Aksi</th>
                                <th class="th" scope="col">Halaman</th>
                                {{-- <th class="th" scope="col">ID Tabel</th> --}}
                                <th class="th" scope="col">Data</th>
                                <th class="th" scope="col">Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($activities as $a=>$activity)
                                <tr>
                                <td>{{ $a+1 }}</td>
                                <td>{{ $activity->user->username }}</td>
                                <td>{{ $activity->user->name }}</td>
                                <td>{{ $activity->aksi }}</td>
                                <td>{{ $activity->halaman }}</td>
                                {{-- <td>{{ $activity->table_id }}</td> --}}
                                <td><a class="btn btn-outline-secondary" href="/dashboard/activity?activity_id={{ $activity->id }}">Lihat Data</a></td>
                                {{-- <td>{{ json_decode($activity->raw_json)->id }}</td> --}}
                                <td>{{ $activity->created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @include('components.cardClose')

    @if(isset($request->activity_id))
        <?php 
            $table = json_decode($data->new_data_json, true);
            // dd($data);
            $oldtable = json_decode($data->data_json, true);
            if($table == null)  $table = $oldtable;
        ?>
        <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $data->aksi }} {{ $data->halaman }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @foreach($table as $key=>$tb)
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">{{ $key }}</label>
                        @if($table[$key] == $oldtable[$key])
                        @if($key == 'created_at' || $key == 'updated_at')
                        <input type="text" class="form-control" id="exampleFormControlInput1" value="{{ date('d-m-Y H:i:s', strtotime($tb)) }}" disabled>
                        @else
                        <input type="text" class="form-control" id="exampleFormControlInput1" value="{{ $tb }}" disabled>
                        @endif
                        @else
                        <div class="row">
                            <div class="input-group col">
                                <span class="input-group-text" id="basic-addon3">old</span>
                                
                                @if($key == 'created_at' || $key == 'updated_at')
                                <input type="text" class="form-control" id="exampleFormControlInput1" value="{{ date('d-m-Y H:i:s', strtotime($oldtable[$key])) }}" disabled>
                                @else
                                <input type="text" class="form-control" id="basic-url" value="{{ $oldtable[$key] }}" disabled> 
                                @endif
                            </div>
                            <div class="input-group col">
                                <span class="input-group-text" id="basic-addon3">new</span>
                                
                                @if($key == 'created_at' || $key == 'updated_at')
                                <input type="text" class="form-control" id="exampleFormControlInput1" value="{{ date('d-m-Y H:i:s', strtotime($table[$key])) }}" disabled>
                                @else
                                <input type="text" class="form-control" id="basic-url" value="{{ $table[$key] }}" disabled>
                                @endif
                            </div>
                        </div>
                        @endif
                      </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
            </div>
        </div>
      @endif
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready( function () {
            $('#table').DataTable();
            @if(isset($request->activity_id))
            var myModal = new bootstrap.Modal(document.getElementById("modal"), {});
            document.onreadystatechange = function () {
                myModal.show();  
                table.columns.adjust().draw();              
            };
            $('#table2').DataTable({
                scrollX: true,
                "sScrollXInner": "100%",
            }).columns.adjust();
            jQuery('.dataTable').wrap('<div class="dataTables_scroll" />');
            @endif
            $('#modal').on('hidden.bs.modal', function (e) {
                window.location.href = "/dashboard/activity";
            })
        } );
    </script>
@endsection