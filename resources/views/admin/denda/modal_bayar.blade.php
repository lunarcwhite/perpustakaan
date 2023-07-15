<div class="modal fade" id="modalBayar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="labelModal"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('dashboard.denda.bayar') }}" method="POST" id="formBayar">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="">Nama Anggota</label>
                        <input type="text" disabled class="form-control" id="nama_anggota" placeholder="Nama Anggota" name="nama_anggota">
                    </div>
                    <input type="hidden" class="form-control" id="id" placeholder="Nama Anggota" name="id">
                    <div class="form-group mb-3">
                        <label for="">Jurusan</label>
                        <input type="text" disabled class="form-control" id="jurusan_id" placeholder="Nama Anggota" name="jurusan_id">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Tahun Ajaran</label>
                        <input type="text" disabled class="form-control" id="tahun_ajaran_id" placeholder="Nama Anggota" name="tahun_ajaran_id">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Denda Anggota</label>
                        <input type="number" readonly class="form-control" id="denda_anggota" placeholder="Nama Anggota" name="denda_anggota">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Jumlah Pembayaran Denda</label>
                        <input type="number" class="form-control" id="pembayaran_denda" placeholder="Rp. 0" name="pembayaran_denda">
                    </div>
                    <div class="form-group mt-1">
                        <label for="email">Keterangan Pembayaran Denda: </label>
                        <textarea name="keterangan_pembayaran" class="form-control" placeholder="Keterangan Pembayaran Denda" id="" cols="30" rows="5"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="formConfirmation('Lakukan Aksi?')"
                    class="btn btn-primary">Bayar</button>
                </form>
            </div>
        </div>
    </div>
</div>
