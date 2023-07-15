@extends('layouts.admin.master')
@section('pageTitle')
    Rekapan Peminjaman
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
                    <form action="{{ route('dashboard.rekapan.print.peminjaman_buku') }}" method="post">
                        @csrf
                        <input type="hidden" name="bulan" value="{{ Request::query('bulan') }}">
                        <button type="submit" class="btn btn-info"><i class="fa fa-print" aria-hidden="true"></i> Cetak
                            PDF</button>
                    </form>
                    <a href="{{ url()->previous() }}" class="btn btn-primary">
                        Kembali
                    </a>
                </div>
                <div class="card-header">
                    <form action="{{ route('dashboard.rekapan.peminjaman_buku') }}" method="get" id="formTanggal">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Filter Sesuai Tanggal</label>
                            <div class="col-sm-2">
                                <input type="month" class="form-control" id="bulan" name="bulan">
                                <br/>
                                <a href="{{ route('dashboard.rekapan.peminjaman_buku') }}" class="btn btn-sm btn-secondary"
                                    rel="noopener noreferrer">
                                    Tampilkan Semua</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTable">
                        <thead class="thead-light">
                            <th>No</th>
                            <th>Nama Buku</th>
                            <th>Peminjam</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Tanggal Pengembalian</th>
                            <TH>Status</TH>
                        </thead>
                        <tbody>
                            @foreach ($rekapans as $no => $rekapan)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $rekapan->buku->nama_buku }}</td>
                                    <td>{{ $rekapan->anggota->nama_anggota }}</td>
                                    <td>{{ $rekapan->tanggal_mulai_peminjaman }}</td>
                                    <td>{{ $rekapan->tanggal_pengembalian }}</td>
                                    <td><span class="badge badge-sm badge-success">Selesai</span>
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
@push('js')
    <script>
        $("#bulan").change(function(e) {
            e.preventDefault();
            $("#formTanggal").submit();
        });
    </script>
@endpush
