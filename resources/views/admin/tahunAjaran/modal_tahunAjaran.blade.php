<div class="modal fade text-left" id="modalTahunAjaran" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
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
                <form action="{{ route('dashboard.tahunAjaran.store') }}" method="post" id="formTahunAjaran">
                    @csrf
                    <div id="update">
                
                    </div>
                    <div class="form-group mt-1">
                        <label for="email">Tahun Ajaran: </label>
                        <input id="tahun_ajaran" type="text" name="tahun_ajaran" placeholder="2023/2024"
                            class="form-control" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button type="button" id="btn-submit" onclick="formConfirmation('Simpan Data?','#formTahunAjaran')"
                    class="btn btn-primary ms-1">
                    Simpan
                </button>
            </form>
            </div>
        </div>
    </div>
</div>
