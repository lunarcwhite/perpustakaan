@extends('layouts.admin.master')
@section('pageTitle')
    Data Peminjaman
@stop
@section('pageLink')
    Memerlukan Persetujuan
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
                            <th>Tanggal Untuk Peminjaman</th>
                            <th>Durasi Peminjaman</th>
                            <TH>Aksi</TH>
                        </thead>
                        <tbody>
                            @foreach ($peminjamans as $no => $peminjaman)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $peminjaman->buku->nama_buku }}</td>
                                    <td>{{ $peminjaman->user->username }}</td>
                                    <td>{{ $peminjaman->tanggal_mulai_peminjaman }}</td>
                                    <td>{{ $peminjaman->durasi_peminjaman }} Hari</td>
                                    <td>
                                        <form action="{{ route('dashboard.peminjaman.persetujuan', $peminjaman->id) }}"
                                            id="formPersetujuan" method="post">
                                            @method('patch')
                                            @csrf
                                            <input type="hidden" name="status_peminjaman" id="status_peminjaman">
                                            <input type="hidden" name="id" id="id">
                                            <input type="hidden" name="keterangan" id="keterangan">
                                            <button type="button" class="btn btn-success"
                                                onclick="persetujuan('{{ $peminjaman->id }}','#formPersetujuan','1','Setujui Peminjaman?')">Setujui</button>
                                            <button type="button" class="btn btn-danger"
                                                onclick="tolak({{ $peminjaman->id }})">Tolak</button>
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
@push('js')
    <script>
        async function tolak(idData) {
            const {
                value: text
            } = await Swal.fire({
                input: 'textarea',
                inputLabel: 'Pesan Penolakan',
                inputPlaceholder: 'Alasan Penolakan',
                inputAttributes: {
                    'aria-label': 'Type your message here'
                },
                showCancelButton: true
            })
            if (text) {
                $("#keterangan").val(text);
                persetujuan(idData,'#formPersetujuan','0','Tolak Peminjaman?')
            }
        }

        function persetujuan(dataId, formId, persetujuan, message) {
            $('#status_peminjaman').val(persetujuan);
            $('#id').val(dataId);

            formConfirmationId(formId, message);
        }
    </script>
@endpush
