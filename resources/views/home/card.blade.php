@foreach ($products as $product)
    <!-- Modal -->
    <div class="modal fade" id="card{{ $product->slug }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Product Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 d-flex align-items-center">
                            <img src="{{ $product->image ? asset('image/' . $product->image) : asset('image/belum-upload.png') }}"
                                class="img-fluid product-thumbnail">
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <form action="{{ route('card-orders', $product->slug) }}" method="POST">
                                @csrf
                                <p>Name Product : {{ $product->name_product }}</p>
                                <p>Category : {{ $product->category->name_category ?? '' }}</p>
                                <p class="text-capitalize">Description Product : <br> {{ $product->description ?? '' }}
                                </p>
                                <p>Price : Rp. <span
                                        class="text-decoration-line-through">{{ $product->price ?? '' }}</span>
                                    {{ $product->price_discount ? $product->price_discount : $product->price }}</p>
                                <p>Stock : {{ $product->stock ?? '' }}</p>
                                <p>Status : {{ $product->status ?? '' }}</p>
                                <input type="number" name="quantity" class="form-control" placeholder="Quantity"
                                    required>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary me-2"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Checkout</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
