@extends('layouts.admin.master')
@section('pageTitle')
    Riwayat Peminjaman Buku
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
                    {{-- <form action="{{ route('riwayat.peminjaman') }}" method="get" id="formTanggal">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Filter Sesuai Tanggal</label>
                            <div class="col-sm-6">
                                <input type="month" class="form-control" id="bulan" name="bulan">
                                <a href="{{ route('riwayat.peminjaman') }}" class="btn btn-sm btn-secondary"
                                    rel="noopener noreferrer">
                                    Tampilkan Semua</a>
                            </div>
                        </div>
                    </form> --}}
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
                            <th>Tanggal Pengembalian</th>
                            <TH>Status</TH>
                        </thead>
                        <tbody>
                            @foreach ($riwayats as $no => $riwayat)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $riwayat->buku->nama_buku }}</td>
                                    <td>{{ $riwayat->tanggal_mulai_peminjaman }}</td>
                                    <td>{{ $riwayat->tanggal_pengembalian }}</td>
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
{{-- @push('js')
    <script>
        $("#bulan").change(function(e) {
            e.preventDefault();
            $("#formTanggal").submit();
        });
    </script>
@endpush --}}
