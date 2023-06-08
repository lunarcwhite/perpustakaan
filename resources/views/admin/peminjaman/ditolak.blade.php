@extends('layouts.admin.master')
@section('pageTitle')
    Data Peminjaman
@stop
@section('pageLink')
    Ditolak
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
                            <th>Keterangan</th>
                            <TH>Aksi</TH>
                        </thead>
                        <tbody>
                            @foreach ($peminjamans as $no => $peminjaman)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $peminjaman->buku->nama_buku }}</td>
                                    <td>{{ $peminjaman->user->username}}</td>
                                    <td>{{$peminjaman->tanggal_mulai_peminjaman}}</td>
                                    <td>{{$peminjaman->keterangan}} Hari</td>
                                    <td>
                                        <form action="{{ route('dashboard.peminjaman.hapus', $peminjaman->id) }}"
                                            id="formPersetujuan" method="post">
                                            @method('delete')
                                            @csrf
                                            <input type="hidden" name="status_peminjaman" id="status_peminjaman">
                                            <input type="hidden" name="id" id="id">
                                            <button type="button" class="btn btn-danger" onclick="formConfirmation('Hapus Data Peminjaman?')">Hapus</button>
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
