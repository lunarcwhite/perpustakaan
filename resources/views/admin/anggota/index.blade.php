@extends('layouts.admin.master')
@section('pageTitle')
    Data Anggota
@stop
@section('pageLink')
    Anggota
@stop
@section('content')
    <!-- Row -->
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <div class="button-group">
                        <button type="button" onclick="clearInput('formImport','Import Anggota','dashboard/anggota/import')"
                            class="btn btn-success" data-toggle="modal" data-target="#modalImport">
                            Import
                        </button>
                        <button type="button" onclick="clearInput('formAnggota','Tambah Anggota','dashboard/anggota')"
                            class="btn btn-info" data-toggle="modal" data-target="#modalAnggota">
                            Tambah
                        </button>
                    </div>
                    <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
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
                                    <td>
                                        <form action="{{ route('dashboard.anggota.destroy', $anggota->no_anggota) }}"
                                            id="" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-warning"
                                                onclick="editAnggota('{{ $anggota->no_anggota }}','#modalAnggota')">
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-danger"
                                                onclick="formConfirmation('Hapus Data Anggota {{ $anggota->nama_anggota }}')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <h3>Belum Ada Data Anggota</h3>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('admin.anggota.modal_anggota')
    @include('admin.anggota.modal_import')
@stop
@push('js')
    <script>
        function editAnggota(idData, idModal) {
            $.ajax({
                type: "get",
                url: `{{ url('dashboard/anggota/${idData}/edit') }}`,
                dataType: 'json',
                success: function(res) {
                    $("#nama_anggota").val(res.nama_anggota);
                    $(`#jurusan_id option[value="${res.jurusan_id}"]`).attr("selected", "selected").attr('class', 'kapilih');
                    $(`#tahun_ajaran_id option[value="${res.tahun_ajaran_id}"]`).attr("selected", "selected").attr('class', 'kapilih');
                    $(`#labelModal`).text('Edit Anggota');
                    $(`#btn-submit`).text('Update');
                    $('#update').append(
                        `@method('put')`
                    );
                    document.getElementById('formAnggota').action =
                        `{{ url('dashboard/anggota/${res.no_anggota}') }}`;
                    $(idModal).modal('show');
                }
            });
        }
    </script>
@endpush
