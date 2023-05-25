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
                    <button type="button" onclick="clearInput('formKategori','Tambah Kategori','dashboard/kategori')" class="btn btn-info" data-toggle="modal" data-target="#modalKategori">
                        Tambah
                    </button>
                    <a href="{{url()->previous()}}" class="btn btn-primary">
                        Kembali
                    </a >
                </div>

                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <TH>Aksi</TH>
                        </thead>
                        <tbody>
                            @foreach ($kategoris as $no => $kategori)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $kategori->nama_kategori }}</td>
                                    <td>
                                        <form action="{{ route('dashboard.kategori.destroy', $kategori->id) }}"
                                            id="formDeleteKategori" method="post">
                                            @csrf
                                            @method('delete')
                                            <a href="{{ route('dashboard.kategori.show', $kategori->id) }}"
                                                class="btn btn-info">Lihat</a>
                                            <button type="button" class="btn btn-warning"
                                                onclick="editKategori('{{ $kategori->id }}','#modalKategori')">
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-danger"
                                                onclick="formConfirmation('Hapus Data {{ $kategori->nama_kategori }}')">Hapus</button>
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
@include('admin.kategori.modal_kategori')
@stop
@push('js')
    <script>
        function editKategori(id_kategori, idModal) {
            $.ajax({
                type: "get",
                url: `{{ url('dashboard/kategori/${id_kategori}/edit') }}`,
                dataType: 'json',
                success: function(res) {
                    $("#nama_kategori").val(res.nama_kategori);
                    $(`#labelModal`).text('Edit Kategori');
                    $(`#btn-submit`).text('Update');
                    $('#update').append(
                        `@method('put')`
                    );
                    document.getElementById('formKategori').action =
                    `{{ url('dashboard/kategori/${res.id}') }}`;
                    $(idModal).modal('show');
                }
            });
        }
    </script>
@endpush
