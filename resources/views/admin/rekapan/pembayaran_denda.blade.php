@extends('layouts.admin.master')
@section('pageTitle')
    Rekapan Pembayaran Denda
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
                    <table class="table align-items-center table-flush table-hover" id="dataTable">
                        <thead>
                            <tr>
                                <th class="font-weight-semi-bold border-top-0 py-2">#</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">No Anggota</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">Nama Anggota</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">Pembayaran</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pembayarans as $no => $pembayaran)
                                <tr>
                                    <td class="py-3">{{ $no + 1 }}</td>
                                    <td class="py-3">{{ $pembayaran->anggota->no_anggota }}</td>
                                    <td class="py-3">{{ $pembayaran->anggota->nama_anggota }}
                                    <td class="py-3">{{ $pembayaran->pembayaran_denda }}</td>
                                    <td class="py-3">{{ $pembayaran->keterangan }}</td>
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
