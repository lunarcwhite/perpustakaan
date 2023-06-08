@extends('layouts.admin.master')
@section('pageTitle')
    Data Peminjaman
@stop
@section('pageLink')
    Berlangsung
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
                    <table class="table align-items-center table-flush table-hover" id="dataTable">
                        <thead class="thead-light">
                            <th>No</th>
                            <th>Nama Buku</th>
                            <th>Peminjam</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Durasi Peminjaman</th>
                            <TH>Aksi</TH>
                        </thead>
                        <tbody>
                            @foreach ($peminjamans as $no => $peminjaman)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $peminjaman->buku->nama_buku }}</td>
                                    <td>{{ $peminjaman->user->username}}</td>
                                    <td>{{$peminjaman->tanggal_mulai_peminjaman}}</td>
                                    <td>{{$peminjaman->durasi_peminjaman}} Hari</td>
                                    <td>
                                        <form action="{{ route('dashboard.peminjaman.selesai', $peminjaman->id) }}"
                                            id="formSelesai" method="post">
                                            @csrf
                                            <button type="button" class="btn btn-success"
                                                onclick="formConfirmation('Selesaikan Peminjaman?')">Selesai</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
