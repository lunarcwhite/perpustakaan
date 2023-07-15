<div class="modal fade text-left" id="modalDenda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="labelModal">
                </h4>
                <button type="button" class="btn btn-outline-danger btn-close" data-dismiss="modal"
                    aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('dashboard.denda.store') }}" method="post" id="formDenda">
                    @csrf
                    <div id="update">
                
                    </div>
                    <div class="form-group mt-1">
                        <label for="email">Nilai Denda: </label>
                        <input id="nilai_denda" type="number" name="nilai_denda" placeholder="1000"
                            class="form-control" />
                    </div>
                    <div class="form-group mt-1">
                        <label for="email">Keterangan Denda: </label>
                        <textarea name="keterangan_denda" class="form-control" placeholder="Keterangan Denda" id="" cols="30" rows="5"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button type="button" id="btn-submit" onclick="formConfirmation('Simpan Data?')"
                    class="btn btn-primary ms-1">
                    Simpan
                </button>
            </form>
            </div>
        </div>
    </div>
</div>
