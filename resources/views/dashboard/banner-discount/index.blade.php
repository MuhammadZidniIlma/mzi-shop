<x-layout-dashboard>
    {{-- menampilkan error --}}
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
    @endif

    <div class="col-12">
        <div class="card">
            <div class="d-flex justify-content-between">
                <h5 class="card-header">Table Discounts</h5>

                <div class="align-self-center mx-3">
                    @if (Auth::user() && Auth::user()->role == 'admin')
                        <!-- Tombol untuk create -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#uploadBanner{{ $bannerDiscounts->discount->id ?? '' }}">
                            Upload Image
                        </button>
                    @endif
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Banner Images</th>
                            <th>Discount Name</th>
                            <th>Expiration Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @if ($bannerDiscounts)
                            <tr>
                                <td>
                                    <img src="{{ $bannerDiscounts->discount->image ? asset('image/' . $bannerDiscounts->discount->image) : asset('image/belum-upload.png') }}"
                                        class="img-thumbnail" alt="Discount Image" style="width: 250px">
                                </td>
                                <td>{{ $bannerDiscounts->discount->name_discount ?? 'N/A' }}</td>
                                <td>{{ $bannerDiscounts->discount->expiration_date ?? 'N/A' }}</td>
                                <td>{{ $bannerDiscounts->discount->status ?? 'N/A' }}</td>
                                <td>
                                    <button type="buttom" class="btn btn-icon item-edit" data-bs-toggle="modal"
                                        data-bs-target="#edit{{ $bannerDiscounts->id ?? '' }}">
                                        <i class="bx bx-edit bx-md"></i>
                                    </button>
                                    @include('dashboard.banner-discount.edit')
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="5" class="text-center text-secondary">
                                    No discounts yet
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout-dashboard>
