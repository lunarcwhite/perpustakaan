<div class="modal fade" id="modalSelesai" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="labelModal">Selesaikan Peminjaman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('dashboard.peminjaman.selesai') }}" method="POST" id="formSelesai">
                    @csrf
                    <input type="hidden" readonly class="form-control" id="id_peminjaman" placeholder="Nama Anggota" name="id_peminjaman">
                    <div class="form-group mb-3">
                        <label for="">Nama Buku</label>
                        <input type="text" disabled class="form-control" id="nama_buku" placeholder="Nama Anggota" name="nama_buku">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Nama Peminjam</label>
                        <input type="text" disabled class="form-control" id="peminjam" placeholder="Nama Anggota" name="peminjam">
                    </div>
                    <input type="hidden" class="form-control" id="id" placeholder="Nama Anggota" name="id">
                    <div class="form-group mb-3">
                        <label for="">Tanggal Peminjaman</label>
                        <input type="date" disabled class="form-control" id="tanggal_peminjaman" placeholder="Nama Anggota" name="tanggal_peminjaman">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Durasi Peminjaman</label>
                        <input type="text" disabled class="form-control" id="durasi_peminjaman" placeholder="Nama Anggota" name="durasi_peminjaman">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Tanggal Pengembalian</label>
                        <input type="date" readonly class="form-control" id="tanggal_pengembalian" placeholder="Nama Anggota" name="tanggal_pengembalian">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Denda Telat Pengembalian</label>
                        <input type="number" readonly class="form-control" id="denda" placeholder="Rp. 0" name="denda">
                    </div>
                    <div id="bayarDenda">

                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="formConfirmation('Selesaikan Peminjaman?')"
                    class="btn btn-primary">Selesaikan Peminjaman</button>
                </form>
            </div>
        </div>
    </div>
</div>
