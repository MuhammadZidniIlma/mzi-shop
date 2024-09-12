<x-layout-dashboard>
    <div class="col-12">
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="d-flex justify-content-between">
                <h5 class="card-header">Table Products</h5>

                <div class="align-self-center mx-3">
                    @if (Auth::user() && Auth::user()->role == 'admin')
                        <!-- Tombol untuk create -->
                        <a href="{{ route('productscreate') }}" class="btn btn-primary">Add Product</a>
                        {{-- <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#import">
                                Import Product
                            </button> --}}
                        {{-- @include('dashboard.user.import') --}}
                    @endif
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th class="text-center ps-0">image</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($products as $product)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>
                                    <img src="{{ $product->image ? asset('image/' . $product->image) : asset('image/belum-upload.png') }}"
                                        class="img-thumbnail" alt="product" style="width: 150px">
                                </td>
                                <td>{{ $product->name_product }}</td>
                                <td>
                                    {{ $product->category->name_category }}
                                </td>
                                <td>
                                    Rp.
                                    {{ number_format($product->price_discount ? $product->price_discount : $product->price) }}
                                </td>
                                <td>
                                    {{ $product->stock }}
                                </td>
                                <td><span
                                        class="badge bg-label-{{ $product->status == 'available' ? 'success' : 'danger' }} me-1 text-capitalize">{{ $product->status }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('product.edit', $product->slug) }}"
                                        class="btn btn-icon item-edit"> <i class="bx bx-edit bx-md"></i>
                                    </a>
                                    <a type="button" class="text-danger delete-record" data-bs-toggle="modal"
                                        data-bs-target="#delete{{ $product->slug }}"><i class="bx bx-trash bx-md"></i>
                                    </a>
                                    @include('dashboard.product.delete')
                                </td>
                            </tr>
                        @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!--/ Basic Bootstrap Table -->

    </div>
</x-layout-dashboard>
