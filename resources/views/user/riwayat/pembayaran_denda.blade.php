@extends('layouts.admin.master')
@section('pageTitle')
    Riwayat Pembayaran Denda
@stop
@section('pageLink')
    Histori
@stop
@section('content')
    <!-- Row -->
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                    <a href="{{ url()->previous() }}" class="btn btn-primary">
                        Kembali
                    </a>
                </div>
                <div class="table-responsive p-3">
                    <h4>Ketentuan Denda</h4>
                    <table class="table align-items-center table-flush table-hover">
                        <thead class="thead-light">
                            <th>No</th>
                            <th>Keterangan Denda</th>
                            <th>Denda</th>
                        </thead>
                        <tbody>
                            @forelse ($dendas as $no => $denda)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $denda->keterangan }}</td>
                                    <td>Rp. {{ $denda->denda }}</td>
                                </tr>
                            @empty
                                Tidak Ada Buku Yang Sedang Dipinjam
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTable">
                        <thead>
                            <tr>
                                <th class="font-weight-semi-bold border-top-0 py-2">#</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">No Anggota</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">Pembayaran</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pembayaran_dendas as $no => $pembayaran_denda)
                                <tr>
                                    <td class="py-3">{{ $no + 1 }}</td>
                                    <td class="py-3">{{ $pembayaran_denda->anggota->no_anggota }}</td>
                                    <td class="py-3">{{ $pembayaran_denda->pembayaran_denda }}</td>
                                    <td class="py-3">{{ $pembayaran_denda->keterangan }}</td>
                                </tr>
                            @empty
                                <h3>Belum Ada Data Riwayat Pembayaran Denda</h3>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
