<div class="modal fade text-left" id="modalLogin" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel33" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="labelModal">Login Untuk Meminjam
            </h4>
            <button type="button" class="btn btn-outline-danger btn-close" data-dismiss="modal"
                aria-label="Close"><span aria-hidden="true"></span></button>
        </div>
        <form action="{{ route('authenticate') }}" method="post">
            <div class="modal-body">
                @csrf
                <div class="form-group">
                    <label for="judul">Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Username" />
                </div>
                <div class="form-group">
                    <label for="judul">Password</label>
                    <input type="password" class="form-control" name="password"
                        placeholder="Password" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-sm btn-rounded btn-danger"
                    data-dismiss="modal">Close</button>
                <button type="submit" class="btn-sm btn-rounded btn-primary">Login</button>
            </div>
        </form>
    </div>
</div>
</div>