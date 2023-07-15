<div class="modal fade text-left" id="modalPinjam" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel33" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="labelModal">Atur Durasi Peminjaman
            </h4>
            <button type="button" class="btn btn-outline-danger btn-close" data-bs-dismiss="modal"
                aria-label="Close"><span aria-hidden="true"></span></button>
        </div>
        <form action="{{ route('pinjam.store') }}" method="post">
            @csrf
            <div class="modal-body">
                <input type="hidden" name="buku_id" id="buku_id">
                <div class="form-group mt-3">
                    <label for="judul">Nama Buku</label>
                    <input type="text" disabled class="form-control" id="nama_buku"
                        placeholder="3 Hari" />
                </div>
                <div class="form-group mt-3">
                    <label for="judul">Durasi Peminjaman. Maksimal 7 Hari.</label>
                    <input type="number" class="form-control" name="durasi_peminjaman"
                        placeholder="3 Hari" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-rounded btn-secondary"
                    data-bs-dismiss="modal">Batal</button>
                <button type="button" onclick="formConfirmation('Pinjam Buku?')" class="btn btn-sm btn-rounded btn-primary">Pinjam</button>
            </div>
        </form>
    </div>
</div>
</div>