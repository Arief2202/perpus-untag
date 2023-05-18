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
        <form action="" method="post" id="myForm">@csrf            
            <div class="row mb-3">
                <div class="col-md-6">
                    <h4 class="card-title"><b>Cetak Label</b></h4>
                </div>                    
            </div>
            <div class="row mb-4">
                <div class="col-md-6 d-flex justify-content-start">
                    <button type="button" class="btn btn-primary me-4" id="selectAll">Check All</button>
                    <button type="button" class="btn btn-primary me-4" id="deSelectAll">Uncheck All</button>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-4">Cetak</button>
                </div>
            </div>
            <div style="max-height: 70vh; overflow-y:auto;">
                <div class="card-text me-3">          
                    <div style="max-height: auto; overflow-y:auto;">
                        <div class="card-text me-3">
                            <table class="table" id="table">
                                <thead class="thead">
                                    <tr>
                                    <th class="th" scope="col">Add</th>
                                    <th class="th" scope="col">No</th>
                                    <th class="th" scope="col">Judul</th>
                                    <th class="th" scope="col">Label</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $index = 1;?>
                                    @foreach($bukus as $buku)
                                        @for($a = 0; $a < $buku->jumlah; $a++)                                    
                                            <?php
                                                $label = $buku->prefix . sprintf("%0".$buku->length_code."d", $a+1);
                                            ?>
                                            <tr>
                                                <td><input class="form-check-input myCheckbox" type="checkbox" name="labels[]" value="{{ $buku->judul }}-{{ $label }}" id="label[]"></td>
                                                <td>{{ $index++ }}</td>
                                                <td>{{ $buku->judul }}</td>
                                                <td>{{ $label }}</td>
                                            </tr>
                                        @endfor
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @include('components.cardClose')

@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready( function () {
            $('#table').DataTable({
                "columnDefs": [
                    { "width": "3%", "targets": 0 },
                    { "width": "3%", "targets": 1 }
                ]
            });
            $("#selectAll").on("click", function () {           
                $("#table").each( function() {
                    $(this).find("input").attr('checked', true);    
                });
            });
            $("#deSelectAll").on("click", function () {           
                $("#table").each( function() {
                    $(this).find("input").attr('checked', false);    
                });
            });

            $( '#myForm' ).on('submit', function(e) {                
                var found = false;
                $("#table").each( function() {
                    if( $(this).find("input").is(':checked') ) {
                        found = true;
                    }
                });
                if(!found){
                    alert( 'Tidak ada label yang di pilih, silahkan pilih minimal 1' );
                    e.preventDefault();
                }
            });
        } );
    </script>
@endsection