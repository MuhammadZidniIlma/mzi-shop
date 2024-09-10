<x-layout-home>
    <div class="container my-5 p-4">
        <div class="row mb-4">
            <div class="nav-align-top">
                <ul class="nav nav-pills flex-column flex-md-row mb-6">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.home', Auth::user()->id) }}"><i
                                class="bx bx-sm bx-user me-1_5"></i>
                            Account</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link active" href="{{ route('changePasswordHome', Auth::user()->id) }}"><i
                                class="bx bx-sm bx-key me-1_5"></i>
                            Change Password</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row card mb-3 px-1 py-3" style="border-radius: 13px">
            <div class="col-12">
                <!-- Account -->
                <div class="card-body">
                    <form action="{{ route('changePasswordProcess', Auth::user()->id) }}" method="POST">
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
                            <input type="password" class="form-control" id="exampleInputPassword1"
                                name="confirm_password" placeholder="Enter password again">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary me-2"
                                data-bs-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div style="height: 50px">
        </div>
</x-layout-home>
