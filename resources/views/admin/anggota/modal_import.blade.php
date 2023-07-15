<div class="modal fade text-left" id="modalImport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="labelModal">
                    Import Anggota
                </h4>
                <button type="button" class="btn btn-outline-danger btn-close" data-dismiss="modal"
                    aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <a href="{{url('template/template_import_anggota.xlsx')}}" class="btn btn-info">Download Template</a>
            <hr/>
                <form action="{{ route('dashboard.anggota.import') }}" method="post" id="formImport" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="email">Pilih File Dari File Excel</label>
                        <input id="import_anggota" type="file" name="import_anggota"
                            class="form-control" />
                    </div>
                    <h6>Note: Sebelum Mengimport Anggota, Pastikan Tahun Ajaran Dan Jurusannya Sudah Dinputkan Terlebih Dahulu Melalui Menu <strong> Tahun Ajaran </strong> dan <strong> Jurusan </strong></h6>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button type="button" id="btn-submit" onclick="formConfirmation('Import Data Anggota?')" class="btn btn-primary ms-1">Import</button>
                </div>
            </form>
        </div>
    </div>
</div>
