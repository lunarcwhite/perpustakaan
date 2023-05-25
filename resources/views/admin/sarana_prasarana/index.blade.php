@extends('layouts.admin.master')
@section('pageTitle')
    Data Sarana & Prasarana

@stop
@section('pageLink')
    Sarana & Prasarana
@stop
@section('content')
    <!-- Row -->
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <button type="button" onclick="clearInput('formSaranaPrasarana','Tambah Sarana & Prasarana','dashboard/sarana_prasarana')" class="btn btn-info" data-toggle="modal" data-target="#modalSaranaPrasarana">
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
                            <th>Nama Sarana & Prasarana</th>
                            <th>Tipe</th>
                            <th>Kategori</th>
                            <TH>Aksi</TH>
                        </thead>
                        <tbody>
                            @foreach ($sarana_prasaranas as $no => $sarana_prasarana)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $sarana_prasarana->nama_sarana_prasarana }}</td>
                                    <td>{{ $sarana_prasarana->tipe}}</td>
                                    <td>{{$sarana_prasarana->kategori->nama_kategori}}</td>
                                    <td>
                                        <form action="{{ route('dashboard.sarana_prasarana.destroy', $sarana_prasarana->id) }}"
                                            id="formDeleteSarana" method="post">
                                            @csrf
                                            @method('delete')
                                            <a href="#"
                                                class="btn btn-info">Lihat</a>
                                            <button type="button" class="btn btn-warning"
                                                onclick="editSaranaPrasarana('{{ $sarana_prasarana->id }}','#modalSaranaPrasarana')">
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-danger"
                                                onclick="formConfirmation('Hapus Data {{ $sarana_prasarana->nama_sarana_prasarana }}')">Hapus</button>
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
@include('admin.sarana_prasarana.modal_sarana_prasarana')
@stop
@push('js')
<script>
        function editSaranaPrasarana(idData, idModal) {
            $(".gambar").empty();
            $.ajax({
                type: "get",
                url: `{{ url('dashboard/sarana_prasarana/${idData}/edit') }}`,
                dataType: 'json',
                success: function(res) {
                    $("#nama_sarana_prasarana").val(res.nama_sarana_prasarana);
                    $(`#tipe option[value="${res.tipe}"]`).attr("selected", "selected").attr('class', 'kapilih');
                    $(`#kategori option[value="${res.kategori_id}"]`).attr("selected", "selected").attr('class', 'kapilih');
                    $("#jumlah").val(res.jumlah);
                    if (res.photo === null) {
                        $(".gambar").append(`Belum Mengupload Gambar`);
                    } else {
                        $(".gambar").append(
                            `<img src="{{ url('storage/images/${res.tipe}/${res.photo}') }}" class="img-fluid" alt="" srcset="">`
                            );
                    }
                    $(`#labelModal`).text('Edit Data Sarana Prasarana');
                    $(`#btn-submit`).text('Update');
                    $('#update').append(
                        `@method('put')`
                    );
                    document.getElementById('formSaranaPrasarana').action =
                    `{{ url('dashboard/sarana_prasarana/${res.id}') }}`;
                    $(idModal).modal('show');
                }
            });
        }
    </script>
@endpush
