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
                    <a href="{{ url()->previous() }}" class="btn btn-primary">
                        Kembali
                    </a>
                </div>

                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTable">
                        <thead class="thead-light">
                            <th>No</th>
                            <th>Nama Buku</th>
                            <th>Peminjam</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Durasi Peminjaman</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Denda Telat Pengembalian</th>
                            <TH>Aksi</TH>
                        </thead>
                        <tbody>
                            @forelse ($peminjamans as $no => $peminjaman)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $peminjaman->buku->nama_buku }}</td>
                                    <td>{{ $peminjaman->anggota->nama_anggota }}</td>
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
                                    <td>
                                        <form action="{{ route('dashboard.peminjaman.selesai', $peminjaman->id) }}"
                                            id="formSelesai" method="post">
                                            @csrf
                                            <button type="button" class="btn btn-sm btn-success"
                                                onclick="selesai('{{ $peminjaman->id }}','{{ $bayar }}','#modalSelesai', '{{$selisihHari}}')">Selesai</button>
                                        </form>
                                    </td>
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
    @include('admin.peminjaman.modal_selesai')
@stop
@push('js')
    <script>
        function selesai(idData, denda, idModal, selisihHari = 0) {
            let bayar = $("#bayarDenda").empty();
            $.ajax({
                type: "get",
                url: `{{ url('dashboard/peminjaman/${idData}') }}`,
                dataType: 'json',
                success: function(res) {
                    console.log(res);
                    $("#id_peminjaman").val(res.id);
                    $("#nama_buku").val(res.buku.nama_buku);
                    $("#peminjam").val(res.anggota.nama_anggota);
                    $("#tanggal_peminjaman").val(res.tanggal_mulai_peminjaman);
                    $("#durasi_peminjaman").val(res.durasi_peminjaman);
                    $("#tanggal_pengembalian").val(res.tanggal_pengembalian);
                    $("#durasi_peminjaman").val(res.durasi_peminjaman + ' Hari');
                    $("#denda").val(denda);
                    if (denda > 0) {
                        bayar.append(
                            `
                            <div class="form-group mb-3">
                        <label for="">Telat Mengembalikan</label>
                        <input type="text" disabled class="form-control" placeholder="Rp. 0" value="${selisihHari} Hari">
                    </div>
                            <div class="form-group mb-3">
                        <label for="">Bayar Denda</label>
                        <input type="number" class="form-control" id="bayar_denda" placeholder="Rp. 0" name="bayar_denda">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Keterangan Bayar Denda</label>
                    <textarea class="form-control" rows="5" cols="30" name="keterangan" id="keterangan" placeholder="Keterangan Bayar Denda">Pembayaran denda telat mengembalikan buku.</textarea>
                        </div>
                    `
                        )
                    } else {
                        bayar.append(
                            `
                            <input type="hidden" value="0" class="form-control" id="bayar_denda" placeholder="Rp. 0" name="bayar_denda">
                            <input type="hidden" value="null" class="form-control" id="keterangan" placeholder="Rp. 0" name="keterangan">

                    `)
                    }
                    $(idModal).modal('show');
                }
            });
        }
    </script>
@endpush
