<x-layout-dashboard>
    <div class="col-12">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif

        <div class="card mb-4">
            <div class="d-flex justify-content-between ">
                <div class="card-header pb-0">
                    <h5>Table Product</h5>
                </div>
            </div>
            <div class="card-body px-5 pt-0 pb-2">
                <form action="{{ route('product.update', $product->slug) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image">

                        <div class="p-2">
                            <label for="recent_image" class="form-label">Recent Image</label>
                            <img src="{{ isset($product) && $product->image ? asset('image/' . $product->image) : asset('image/belum-upload.png') }}"
                                class="img-thumbnail" alt="product" style="width: 150px">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="name_product" class="form-label">Name Product</label>
                        <input type="text" class="form-control" id="name_product" name="name_product"
                            placeholder="Enter product name" value="{{ $product->name_product ?? '' }}">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description Product</label>
                        <textarea class="form-control" placeholder="Enter description product" id="description" name="description"
                            style="height: 100px">{{ $product->description ?? '' }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="price" name="price"
                            placeholder="Enter price product" value="{{ $product->price ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price Discount</label>
                        <input type="number" class="form-control" id="price" name="price_discount"
                            placeholder="Enter price product" value="{{ $product->price_discount ?? '' }}">
                    </div>

                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock"
                            placeholder="Enter stock product" value="{{ $product->stock ?? '' }}">
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Category Product</label>
                        <select class="form-select" id="category" name="category_id">
                            @if (isset($product) && $product->category)
                                <option selected value="{{ $product->category->id }}">
                                    {{ $product->category->name_category }}
                                </option>
                            @endif
                            @foreach ($category as $item)
                                <option value="{{ $item->id }}">{{ $item->name_category }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex justify-content-end pt-3 pb-2">
                        <a href="{{ route('products') }}" class="btn btn-secondary me-2">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout-dashboard>
