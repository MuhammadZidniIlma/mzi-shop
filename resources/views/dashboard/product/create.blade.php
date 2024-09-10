<x-layout-dashboard>
    <div class="row g-6">
        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header">Add Product</h5>
                <div class="card-body">
                    <div>
                        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name_product" class="form-label">Name Product</label>
                                <input type="text" class="form-control" id="name_product" name="name_product"
                                    placeholder="Enter product name" value="{{ old('name_product') }}">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description Product</label>
                                <textarea class="form-control" placeholder="Enter description product" id="description" name="description"
                                    style="height: 100px">{{ old('description') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Category Product</label>
                                <select class="form-select" id="category" name="category_id">
                                    <option selected>Choose Category Product</option>
                                    @foreach ($category as $item)
                                        <option value="{{ $item->id }}">{{ $item->name_category }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp.</span>
                                    <input type="text" class="form-control" id="price" name="price"
                                        placeholder="Enter price product" value="{{ old('price') }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="price_discount" class="form-label">Price Discount</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp.</span>
                                    <input type="text" class="form-control" id="price_discount" name="price_discount"
                                        placeholder="Enter the discounted product price_discount"
                                        value="{{ old('price_discount') }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="text" class="form-control" id="stock" name="stock"
                                    placeholder="Enter stock product" value="{{ old('stock') }}">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary me-2"
                                    data-bs-dismiss="modal">Kembali</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                            {{-- </form> --}}
                    </div>
                </div>
            </div>
        </div>



        <div class="col-xl-6">
            <!-- File input -->
            <div class="card">
                <h5 class="card-header">File input</h5>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="image" class="form-label">Image Thumbnail</label>
                        <input type="file" class="form-control" id="image" name="image"
                            value="{{ old('image') }}">
                    </div>
                    {{-- <div class="mb-3">
                        <label for="image_gallery" class="form-label">Image Gallery</label>
                        <input type="file" class="form-control" id="image_gallery" name="image_gallery"
                            value="{{ old('image_gallery"') }}" multiple>
                    </div> --}}
                </div>
                </form>
            </div>
        </div>
    </div>

</x-layout-dashboard>
