@extends('layouts.admin.master')
@section('pageTitle')
    Data Buku

@stop
@section('pageLink')
    Buku
@stop
@section('content')
    <!-- Row -->
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <button type="button" onclick="clearInput('formBuku','Tambah Buku','dashboard/buku')" class="btn btn-info" data-toggle="modal" data-target="#modalBuku">
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
                            <th>Nama Buku</th>
                            <th>Kategori</th>
                            <TH>Aksi</TH>
                        </thead>
                        <tbody>
                            @foreach ($bukus as $no => $buku)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $buku->nama_buku }}</td>
                                    <td>{{$buku->kategori->nama_kategori}}</td>
                                    <td>
                                        <form action="{{ route('dashboard.buku.destroy', $buku->id) }}"
                                            id="formDeleteSarana" method="post">
                                            @csrf
                                            @method('delete')
                                            <a href="#"
                                                class="btn btn-info">Lihat</a>
                                            <button type="button" class="btn btn-warning"
                                                onclick="editBuku('{{ $buku->id }}','#modalBuku')">
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-danger"
                                                onclick="formConfirmation('Hapus Data {{ $buku->nama_buku }}')">Hapus</button>
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
@include('admin.buku.modal_buku')
@stop
@push('js')
<script>
        function editBuku(idData, idModal) {
            $(".gambar").empty();
            $.ajax({
                type: "get",
                url: `{{ url('dashboard/buku/${idData}/edit') }}`,
                dataType: 'json',
                success: function(res) {
                    $("#nama_buku").val(res.nama_buku);
                    $(`#kategori option[value="${res.kategori_id}"]`).attr("selected", "selected").attr('class', 'kapilih');
                    if (res.sampul_buku === null) {
                        $(".gambar").append(`Belum Mengupload Gambar`);
                    } else {
                        $(".gambar").append(
                            `<img src="{{ url('storage/img/sampul_buku/${res.sampul_buku}') }}" class="img-fluid" alt="" srcset="">`
                            );
                    }
                    $(`#labelModal`).text('Edit Data Buku');
                    $(`#btn-submit`).text('Update');
                    $('#update').append(
                        `@method('put')`
                    );
                    document.getElementById('formBuku').action =
                    `{{ url('dashboard/buku/${res.id}') }}`;
                    $(idModal).modal('show');
                }
            });
        }
    </script>
@endpush
