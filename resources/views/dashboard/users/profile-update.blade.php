<!-- Modal -->
<div class="modal fade" id="edit{{ Auth::user()->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('changePassword', Auth::user()->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Old Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="old_password"
                            placeholder="Enter old password">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">NewPassword</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="new_password"
                            placeholder="Enter new password">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="confirm_password"
                            placeholder="Enter password again">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editprofile{{ Auth::user()->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Upload Avatar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('uploadAvatar', Auth::user()->id) }}" method="POST"
                    enctype="multipart/form-data" accept="image/*">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Upload Avatar</label>
                        <input type="file" class="form-control" id="exampleInputPassword1" name="avatar">
                        <div id="Help" class="form-text">Allowed Max size of 2 MB.</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="deactiveAccount{{ Auth::user()->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('deactiveAccount', Auth::user()->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <p>You want to deactive account?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary me-2"
                            data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
