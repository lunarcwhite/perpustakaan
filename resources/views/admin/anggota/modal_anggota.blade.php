<div class="modal fade" id="modalAnggota" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="labelModal"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('dashboard.anggota.store') }}" method="POST" id="formAnggota">
                    @csrf
                    <div id="update">

                    </div>
                    <div class="form-group mb-3">
                        <label for="">Nama Anggota</label>
                        <input type="text" class="form-control" id="nama_anggota" placeholder="Nama Anggota" name="nama_anggota">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Jurusan</label>
                        <select name="jurusan_id" id="jurusan_id" class="form-control">
                            <option value="">--> Pilih Jurusan <-- </option>
                                @foreach ($jurusans as $jurusan)
                            <option value="{{ $jurusan->id }}">{{ $jurusan->nama_jurusan }}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Tahun Ajaran</label>
                        <select name="tahun_ajaran_id" id="tahun_ajaran_id" class="form-control">
                            <option value="">--> Pilih Jurusan <-- </option>
                                @foreach ($tahunAjarans as $tahunAjaran)
                            <option value="{{ $tahunAjaran->id }}">{{ $tahunAjaran->tahun_ajaran }}</option>
                                @endforeach
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="formConfirmation('Simpan Data?')"
                    class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
