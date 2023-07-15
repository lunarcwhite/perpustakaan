@extends('layouts.admin.master')
@section('pageTitle')
    Data Jurusan
@stop
@section('pageLink')
    Jurusan
@stop
@section('content')
    <!-- Row -->
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <button type="button" onclick="clearInput('formJurusan','Tambah Jurusan','dashboard/jurusan')" class="btn btn-info" data-toggle="modal" data-target="#modalJurusan">
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
                            <th>Nama Jurusan</th>
                            <TH>Aksi</TH>
                        </thead>
                        <tbody>
                            @foreach ($jurusans as $no => $jurusan)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $jurusan->nama_jurusan }}</td>
                                    <td>
                                            <button type="button" class="btn btn-warning"
                                                onclick="editJurusan('{{ $jurusan->id }}','#modalJurusan')">
                                                Edit
                                            </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@include('admin.jurusan.modal_jurusan')
@stop
@push('js')
    <script>
        function editJurusan(idData, idModal) {
            $.ajax({
                type: "get",
                url: `{{ url('dashboard/jurusan/${idData}/edit') }}`,
                dataType: 'json',
                success: function(res) {
                    $("#nama_jurusan").val(res.nama_jurusan);
                    $(`#labelModal`).text('Edit Jurusan');
                    $(`#btn-submit`).text('Update');
                    $('#update').append(
                        `@method('put')`
                    );
                    document.getElementById('formJurusan').action =
                    `{{ url('dashboard/jurusan/${res.id}') }}`;
                    $(idModal).modal('show');
                }
            });
        }
    </script>
@endpush
