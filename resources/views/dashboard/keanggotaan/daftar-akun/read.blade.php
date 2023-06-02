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
                <h4 class="card-title"><b>{{ $title1 }}</b> {{ $title2 }}</h4>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
               <a class="btn btn-primary me-4" href="/dashboard/keanggotaan/daftar-akun/create">Tambahkan Data</a>
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
                                <th class="th" scope="col">Username</th>
                                <th class="th" scope="col">Nama</th>
                                <th class="th" scope="col">Email</th>
                                <th class="th" scope="col">Jenis Keanggotaan</th>
                                <th class="th" scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $a=>$user)
                                <tr>
                                <td>{{ $a+1 }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->keanggotaan->nama_keanggotaan }}</td>
                                <td><form method="POST" action="/dashboard/keanggotaan/daftar-akun/edit/{{ $user->id }}">@csrf<button type="submit" class="btn btn-success">Edit</button></form></td>
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