<x-layout-home>
    <div class="untree_co-section before-footer-section">
        <div class="container">
            <div class="row mb-5">
                <div class="site-blocks-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="product-thumbnail">Image</th>
                                <th class="product-name">Product</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-total">Total</th>
                                <th class="product-remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderItems as $orderItem)
                                <tr>
                                    <td class="product-thumbnail">
                                        <img src="{{ $orderItem->product->image ? asset('image/' . $orderItem->product->image) : asset('image/belum-upload.png') }}"
                                            class="img-fluid product-thumbnail">
                                    </td>
                                    <td class="product-name">
                                        <h2 class="h5 text-black">{{ $orderItem->product->name_product }}</h2>
                                    </td>
                                    <td>Rp.{{ number_format($orderItem->product->price_discount ? $orderItem->product->price_discount : $orderItem->price) }}
                                    </td>
                                    <td>{{ $orderItem->quantity }}</td>
                                    <td>Rp.{{ number_format($orderItem->quantity * ($orderItem->product->price_discount ? $orderItem->product->price_discount : $orderItem->price)) }}
                                    </td>
                                    <td>
                                        <form action="{{ route('deleteItem', $orderItem->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="summit" class="btn btn-primary">X</button>

                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row d-flex justify-content-end">
                <div class="col-md-6 pl-5">
                    <div class="row justify-content-end">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12 text-right border-bottom mb-5">
                                    <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <span class="text-black">Total</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black">Rp.{{ number_format($subtotal) }}</strong>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-end">
                                <div class="col-md-5">
                                    <button class="btn btn-black btn-lg py-3 btn-block" style="font-size: 0.9rem"
                                        onclick="window.location='{{ route('shippingAddress') }}'">Checkout</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout-home>
