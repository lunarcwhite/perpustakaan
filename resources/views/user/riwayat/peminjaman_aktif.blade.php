@extends('layouts.admin.master')
@section('pageTitle')
    Data Peminjaman Aktif
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
                    <a href="{{ url()->previous() }}" class="btn btn-primary">
                        Kembali
                    </a>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTable">
                        <thead class="thead-light">
                            <th>No</th>
                            <th>Nama Buku</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Durasi Peminjaman</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Denda Telat Pengembalian</th>
                        </thead>
                        <tbody>
                            @forelse ($peminjamans as $no => $peminjaman)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $peminjaman->buku->nama_buku }}</td>
                                    <td>{{ $peminjaman->tanggal_mulai_peminjaman }}</td>
                                    <td>{{ $peminjaman->durasi_peminjaman }} Hari</td>
                                    <td>{{ $peminjaman->tanggal_pengembalian }}</td>
                                    @php
                                        if (date('Y-m-d') > $peminjaman->tanggal_pengembalian) {
                                            $tanggalAwal = new DateTime($peminjaman->tanggal_pengembalian);
                                        
                                            $tanggalAkhir = new DateTime();
                                        
                                            $selisihHari = $tanggalAwal->diff($tanggalAkhir)->days;
                                        
                                            $bayar = $denda * $selisihHari;
                                        } else {
                                            $selisihHari = 0;
                                            $bayar = 0;
                                        }
                                    @endphp
                                    <td>{{ $bayar }}</td>
                                </tr>
                            @empty
                                Tidak Ada Buku Yang Sedang Dipinjam
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
