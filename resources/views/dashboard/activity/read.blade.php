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
                <h4 class="card-title"><b>Admin Activity</b></h4>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
               <button class="btn btn-primary me-4">Tambahkan Data</button>
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
                                <th class="th" scope="col">ID Admin</th>
                                <th class="th" scope="col">Email Admin</th>
                                <th class="th" scope="col">Halaman</th>
                                <th class="th" scope="col">Aksi</th>
                                <th class="th" scope="col">ID Tabel</th>
                                <th class="th" scope="col">Timestamp</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($activities as $a=>$activity)
                                <tr>
                                <td>{{ $a+1 }}</td>
                                <td>{{ $activity->user->username }}</td>
                                <td>{{ $activity->user->email }}</td>
                                <td>{{ $activity->halaman }}</td>
                                <td>{{ $activity->aksi }}</td>
                                <td>{{ $activity->table_id }}</td>
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

@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready( function () {
            $('#table').DataTable();
        } );
    </script>
@endsection