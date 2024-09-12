<x-layout-home>
    <section>
        <div class="container my-5">
            <div class="row d-flex justify-content-center">
                <!-- Shipping Address -->
                <div class="col-md-8">
                    <div class="card mb-6 p-3 rounded-3">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Shipping Address</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('shippingAddressProcess', Auth::user()->id) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">Full Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="basic-default-name"
                                            name="fullname" placeholder="Please Enter Your Name"
                                            value="{{ Auth::user()->fullname ?? '' }}" required />
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="basic-default-email">Email</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge ">
                                            <input type="text" id="basic-default-email" class="form-control"
                                                name="email" placeholder="Please Enter Your Email"
                                                value="{{ Auth::user()->email ?? '' }}" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="basic-default-phone">Phone
                                        Number</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="basic-default-phone" class="form-control phone-mask"
                                            name="phone" placeholder="Please Enter Your Phone Number"
                                            value="{{ Auth::user()->phone ?? '' }}" required />
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="basic-default-Country">Country</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="basic-default-Country"
                                            name="country" placeholder="Please Enter Your Country"
                                            value="{{ Auth::user()->country ?? '' }}" required />
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="basic-default-City">City</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="basic-default-City"
                                            name="city" placeholder="Please Enter Your City"
                                            value="{{ Auth::user()->city ?? '' }}" required />
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="basic-default-Postal-Code">Postal
                                        Code</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="basic-default-Postal-Code"
                                            name="postal_code" placeholder="Please Enter Your Postal Code"
                                            value="{{ Auth::user()->postal_code ?? '' }}" required />
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="basic-default-address">Address</label>
                                    <div class="col-sm-10">
                                        <textarea id="basic-default-address" class="form-control" placeholder="Enter Your Address" name="address" required>{{ Auth::user()->address ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-end">
                                    <div class="col-2">
                                        <button type="submit" class="btn btn-primary">Next</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div style="height: 100px">

    </div>

</x-layout-home>
