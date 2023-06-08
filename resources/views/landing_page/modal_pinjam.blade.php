<div class="modal fade text-left" id="modalPinjam" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel33" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="labelModal">Atur Tanggal Peminjaman
            </h4>
            <button type="button" class="btn btn-outline-danger btn-close" data-dismiss="modal"
                aria-label="Close"><span aria-hidden="true"></span></button>
        </div>
        <form action="{{ route('pinjam.store') }}" method="post">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="judul">Tanggal Untuk Peminjaman</label>
                    <input type="hidden" name="buku_id" id="buku_id">
                    <input type="date" class="form-control" name="tanggal_mulai_peminjaman"
                        placeholder="Username" />
                </div>
                <div class="form-group mt-3">
                    <label for="judul">Durasi Peminjaman Dalam Hari</label>
                    <input type="number" class="form-control" name="durasi_peminjaman"
                        placeholder="3 Hari" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-sm btn-rounded btn-secondary"
                    data-dismiss="modal">Batal</button>
                <button type="button" onclick="formConfirmation('Pinjam Barang?')" class="btn-sm btn-rounded btn-primary">Pinjam</button>
            </div>
        </form>
    </div>
</div>
</div>