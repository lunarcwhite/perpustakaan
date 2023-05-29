@extends('layouts.admin.master')
@section('pageTitle')
    Data Tempat Buku
@stop
@section('pageLink')
    Tempat Buku
@stop
@section('content')
    <!-- Row -->
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <button type="button" onclick="clearInput('formTambahTempatBuku','Tambah Tempat Buku','dashboard/tempat_buku')" class="btn btn-info" data-toggle="modal" data-target="#modalTempatBuku">
                        Tambah
                    </button>
                    <a href="{{url()->previous()}}" class="btn btn-primary">
                        Kembali
                    </a >
                </div>

                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTable">
                        <thead class="thead-light">
                            <th>No</th>
                            <th>Nama Tempat Buku</th>
                            <th>Jumlah Buku</th>
                            <TH>Aksi</TH>
                        </thead>
                        <tbody>
                            @foreach ($tempat_bukus as $no => $tempat_buku)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $tempat_buku->nama_tempat_buku }}</td>
                                    <td>{{$tempat_buku->buku->count()}}</td>
                                    <td>
                                        <form action="{{ route('dashboard.tempat_buku.destroy', $tempat_buku->id) }}"
                                            id="" method="post">
                                            @csrf
                                            @method('delete')
                                            <a href="#"
                                                class="btn btn-info">Lihat</a>
                                            <button type="button" class="btn btn-warning"
                                                onclick="editTempatBuku('{{ $tempat_buku->id }}','#modalTempatBuku')">
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-danger"
                                                onclick="formConfirmation('Hapus Data {{ $tempat_buku->nama_tempat_buku }}')">Hapus</button>
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
@include('admin.tempat_buku.modal_tempat_buku')
@stop
@push('js')
<script>
        function editBuku(idData, idModal) {
            $.ajax({
                type: "get",
                url: `{{ url('dashboard/tempat_buku/${idData}/edit') }}`,
                dataType: 'json',
                success: function(res) {
                    $("#tempat_buku").val(res.tempat_buku);
                    $(`#labelModal`).text('Edit Data Tempat Buku');
                    $(`#btn-submit`).text('Update');
                    $('#update').append(
                        `@method('put')`
                    );
                    document.getElementById('formTambahTempatBuku').action =
                    `{{ url('dashboard/tempat_buku/${res.id}') }}`;
                    $(idModal).modal('show');
                }
            });
        }
    </script>
@endpush
