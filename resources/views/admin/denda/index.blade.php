@extends('layouts.admin.master')
@section('pageTitle')
    Data Kategori

@stop
@section('pageLink')
    Kategori
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
                <div class="card-header mt-3">
                    <button type="button" onclick="clearInput('formDenda','Tambah Data Denda','dashboard/denda')" class="btn btn-info" data-toggle="modal" data-target="#modalDenda">
                        Tambah
                    </button>
                    <hr/>
                    @forelse ($dendas as $denda)
                    <form action="{{route('dashboard.denda.update', $denda->id)}}" method="post">
                        @csrf
                        @method('patch')
                        <h4 class="text-dark">{{$denda->keterangan}}</h4>
                        <div class="input-group mb-3" width="200px">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp. </span>
                              </div>
                            <input type="number" value="{{$denda->denda}}" name="denda" class="form-control" aria-describedby="button-addon2">
                            <div class="input-group-append">
                              <button class="btn btn-success" onclick="formConfirmation('Simpan denda?')" type="button" id="button-addon2">Simpan</button>
                            </div>
                          </div>
                    </form>
                    @empty
                        <h4>Belum ada data denda yang dibuat</h4>
                    @endforelse
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTable">
                        <thead>
                            <tr>
                                <th class="font-weight-semi-bold border-top-0 py-2">#</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">No Anggota</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">Nama Anggota</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">Tahun Ajaran</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">Jurusan</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">Denda</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($anggotas as $no => $anggota)
                                <tr>
                                    <td class="py-3">{{ $no + 1 }}</td>
                                    <td class="py-3">{{ $anggota->no_anggota }}</td>
                                    <td class="py-3">{{ $anggota->nama_anggota }}
                                    <td class="py-3">{{ $anggota->tahun_ajaran->tahun_ajaran }}</td>
                                    <td class="py-3">{{ $anggota->jurusan->nama_jurusan }}</td>
                                    <td class="py-3">{{ $anggota->denda }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info"
                                            onclick="bayarDenda('{{ $anggota->no_anggota }}','#modalBayar')">
                                            Bayar
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <h3>Belum Ada Data Anggota Yang Terkena Denda</h3>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('admin.denda.modal_denda')
    @include('admin.denda.modal_bayar')
@stop
@push('js')
    <script>
        function bayarDenda(idData, idModal) {
            $.ajax({
                type: "get",
                url: `{{ url('dashboard/anggota/${idData}/edit') }}`,
                dataType: 'json',
                success: function(res) {
                    $("#id").val(res.id);
                    $("#nama_anggota").val(res.nama_anggota);
                    $("#jurusan_id").val(res.jurusan.nama_jurusan);
                    $("#tahun_ajaran_id").val(res.tahun_ajaran.tahun_ajaran);
                    $("#denda_anggota").val(res.denda);
                    $(`#labelModal`).text('Bayar Denda ' + res.nama_anggota);
                    $(`#btn-submit`).text('Bayar');
                    $(idModal).modal('show');
                }
            });
        }
    </script>
@endpush
