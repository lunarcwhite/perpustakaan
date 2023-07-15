@extends('layouts.admin.master')
@section('pageTitle')
    Data Tahun Ajaran
@stop
@section('pageLink')
    Tahun Ajaran
@stop
@section('content')
    <!-- Row -->
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <button type="button" onclick="clearInput('formTahunAjaran','Tambah Tahun Ajaran','dashboard/tahunAjaran')" class="btn btn-info" data-toggle="modal" data-target="#modalTahunAjaran">
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
                            <th>Tahun Ajaran</th>
                            <TH>Aksi</TH>
                        </thead>
                        <tbody>
                            @foreach ($tahunAjarans as $no => $tahunAjaran)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $tahunAjaran->tahun_ajaran }}</td>
                                    <td>
                                            <button type="button" class="btn btn-warning"
                                                onclick="editTahunAjaran('{{ $tahunAjaran->id }}','#modalTahunAjaran')">
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
@include('admin.tahunAjaran.modal_tahunAjaran')
@stop
@push('js')
    <script>
        function editTahunAjaran(idData, idModal) {
            $.ajax({
                type: "get",
                url: `{{ url('dashboard/tahunAjaran/${idData}/edit') }}`,
                dataType: 'json',
                success: function(res) {
                    $("#tahun_ajaran").val(res.tahun_ajaran);
                    $(`#labelModal`).text('Edit Tahun Ajaran');
                    $(`#btn-submit`).text('Update');
                    $('#update').append(
                        `@method('put')`
                    );
                    document.getElementById('formTahunAjaran').action =
                    `{{ url('dashboard/tahunAjaran/${res.id}') }}`;
                    $(idModal).modal('show');
                }
            });
        }
    </script>
@endpush
