<x-layout-dashboard>
    <div class="row">
        <div class="col-md-12">
            <div class="nav-align-top">
                <ul class="nav nav-pills flex-column flex-md-row mb-6">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('profile', Auth::user()->id) }}"><i
                                class="bx bx-sm bx-user me-1_5"></i>
                            Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('changePassword', Auth::user()->id) }}"><i
                                class="bx bx-sm bx-key me-1_5"></i>
                            Change Password</a>
                    </li>
                </ul>
            </div>
            <div class="card mb-6">
                <!-- Account -->
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-6 pb-4 border-bottom">
                        <img src="{{ Auth::user()->avatar ? asset('profile/' . Auth::user()->avatar) : asset('profile/default.png') }}"
                            alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />
                        <div class="button-wrapper d-flex">
                            <a type="button" class="btn btn-primary me-3 mb-4 text-white" data-bs-toggle="modal"
                                data-bs-target="#editprofile{{ Auth::user()->id }}">
                                <i class="bx bx-upload d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Upload Avatar</span>
                            </a>
                            @include('dashboard.users.profile-update')
                            <form action="{{ route('resetAvatar', Auth::user()->id) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <button type="submit" class="btn btn-outline-secondary account-image-reset mb-4">
                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Reset</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-4">
                    <form id="formAccountSettings" action="{{ route('profileUpdate', Auth::user()->id) }}"
                        method="POST">
                        @method('PUT')
                        @csrf
                        <div class="row g-6">
                            <div class="col-md-6">
                                <label for="fullname" class="form-label">Full Name</label>
                                <input class="form-control" type="text" id="fullname" name="fullname"
                                    value="{{ Auth::user()->fullname }}">
                            </div>
                            <div class="col-md-6">
                                <label for="username" class="form-label">Username</label>
                                <input class="form-control" type="text" id="username" name="username"
                                    value="{{ Auth::user()->username }}">
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input class="form-control" type="text" id="email" name="email"
                                    value="{{ Auth::user()->email }}">
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input class="form-control" type="text" id="phone" name="phone"
                                    value="{{ Auth::user()->phone ?? '-' }}">
                            </div>
                            <div class="col-md-6">
                                <label for="address" class="form-label">Address</label>
                                <input class="form-control" type="text" id="address" name="address"
                                    value="{{ Auth::user()->address ?? '-' }}">
                            </div>
                            <div class="col-md-6">
                                <label for="country" class="form-label">Country</label>
                                <input class="form-control" type="text" id="country" name="country"
                                    value="{{ Auth::user()->country ?? '-' }}">
                            </div>
                            <div class="col-md-6">
                                <label for="city" class="form-label">City</label>
                                <input class="form-control" type="text" id="city" name="city"
                                    value="{{ Auth::user()->city ?? '-' }}">
                            </div>
                            <div class="col-md-6">
                                <label for="postal_code" class="form-label">Postal Code</label>
                                <input class="form-control" type="text" id="postal_code" name="postal_code"
                                    value="{{ Auth::user()->postal_code ?? '-' }}">
                            </div>
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="btn btn-primary me-3">Save changes</button>
                            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                        </div>
                    </form>
                </div>
                <!-- /Account -->
            </div>
            <div class="card">
                <h5 class="card-header">Delete Account</h5>
                <div class="card-body">
                    <div class="mb-6 col-12 mb-0">
                        <div class="alert alert-warning">
                            <h5 class="alert-heading mb-1">Are you sure you want to delete your account?</h5>
                            <p class="mb-0">Once you delete your account, there is no going back. Please be certain.
                            </p>
                        </div>
                    </div>
                    <a type="button" class="btn btn-primary me-3 mb-4 text-white" data-bs-toggle="modal"
                        data-bs-target="#deactiveAccount{{ Auth::user()->id }}">
                        <i class="bx bx-trash d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Deactivate Account</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

</x-layout-dashboard>
