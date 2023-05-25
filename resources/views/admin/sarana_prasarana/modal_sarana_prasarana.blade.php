<div class="modal fade text-left" id="modalSaranaPrasarana" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
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
                <form action="{{ route('dashboard.kategori.store') }}" method="post" id="formSaranaPrasarana" enctype="multipart/form-data">
                    @csrf
                    <div id="update">

                    </div>
                    <div class="form-group mt-1">
                        <label for="email">Nama Sarana & Prasarana: </label>
                        <input id="nama_sarana_prasarana" type="text" name="nama_sarana_prasarana"
                            placeholder="Nama Sarana & Prasarana" class="form-control" />
                    </div>
                    <div class="form-group mt-1">
                        <label for="email">Jumlah: </label>
                        <input id="jumlah" type="text" name="jumlah"
                            placeholder="Jumlah" class="form-control" />
                    </div>
                    <div class="form-group mt-1">
                        <label for="email">Tipe Sarana Atau Prasarana: </label>
                        <select name="tipe" id="tipe" class="form-control">
                            <option value=""> --> Pilih Sarana/Prasarana <--- </option>
                            <option value="Sarana">Sarana</option>
                            <option value="Prasarana">Prasarana</option>
                        </select>
                    </div>
                    <div class="form-group mt-1">
                        <label for="email">Kategori: </label>
                        <select name="kategori_id" id="kategori" class="form-control">
                            <option value=""> --> Pilih Kategori <--- </option>
                                    @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mt-1">
                        <label for="">Photo</label>
                        <div id="" class="gambar mb-2">
                        </div>
                        <input type="file" class="form-control image-input file" name="photo"
                            placeholder="Photo">
                    </div>
                    <div class="image-preview mt-3">
                        <span>Preview : </span>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-light-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button type="button" id="btn-submit"
                            onclick="formConfirmation('Simpan Data?')"
                            class="btn btn-primary ms-1">
                            Simpan
                        </button>
                </form>
            </div>
        </div>
    </div>
</div>
