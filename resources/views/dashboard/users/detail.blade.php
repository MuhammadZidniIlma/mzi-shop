@foreach ($users as $user)
    <div class="modal fade" id="detail{{ $user->id }}" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel4">Detail Users</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-6 mb-6">
                        <div class="col mb-0">
                            <label for="fullname" class="form-label">Full Name</label>
                            <input type="text" id="fullname" class="form-control" placeholder="Enter fullname"
                                value="{{ $user->fullname }}" readonly />
                        </div>
                        <div class="col mb-0">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" id="username" class="form-control" placeholder="Enter Username"
                                value="{{ $user->username }}" readonly />
                        </div>
                    </div>
                    <div class="row g-6 mb-6">
                        <div class="col mb-0">
                            <label for="Email" class="form-label">Email</label>
                            <input type="email" id="Email" class="form-control" value="{{ $user->email }}"
                                readonly />
                        </div>
                        <div class="col mb-0">
                            <label for="Phone" class="form-label">Phone Number</label>
                            <input type="text" id="Phone" class="form-control" placeholder="Enter Phone Number"
                                value="{{ $user->phone }}" readonly />
                        </div>
                    </div>
                    <div class="row g-6 mb-6">
                        <div class="col mb-0">
                            <label for="country" class="form-label">Country</label>
                            <input type="text" id="country" class="form-control" placeholder="Enter Country"
                                value="{{ $user->country }}" readonly />
                        </div>
                        <div class="col mb-0">
                            <label for="City" class="form-label">City</label>
                            <input type="text" id="City" class="form-control" value="{{ $user->city }}"
                                readonly />
                        </div>
                    </div>
                    <div class="row g-6 mb-6">
                        <div class="col mb-0">
                            <label for="Address" class="form-label">Address</label>
                            <input type="text" id="Address" class="form-control" placeholder="Enter Address"
                                value="{{ $user->address }}" readonly />
                        </div>
                        <div class="col mb-0">
                            <label for="Postal-Code" class="form-label">Postal Code</label>
                            <input type="text" id="Postal-Code" class="form-control" value="{{ $user->postal_code }}"
                                readonly />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
