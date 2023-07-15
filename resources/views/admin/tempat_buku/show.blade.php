@extends('layouts.admin.master')
@section('pageTitle')
    Data Buku Tempat Buku {{$tempat_buku->nama_tempat_buku}}
@stop
@section('pageLink')
    Tempat Buku {{$tempat_buku->nama_tempat_buku}}
@stop
@section('content')
    <!-- Row -->
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <a href="{{url()->previous()}}" class="btn btn-primary">
                        Kembali
                    </a >
                </div>

                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="tableData">
                        <thead class="thead-light">
                            <th>No</th>
                            <th>Nama Buku</th>
                            <th>Nama Kategori</th>
                        </thead>
                        <tbody>
                            @foreach ($tempat_buku->buku as $no => $buku)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $buku->nama_buku }}</td>
                                    <td>{{ $buku->kategori->nama_kategori }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
