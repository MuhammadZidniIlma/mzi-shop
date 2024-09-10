<x-layout-home>
    <div class="untree_co-section">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-7 mb-3">
                    <h2 class="h3 mb-3 text-black">Coupon Code</h2>
                    <div class="p-3 p-lg-5 border bg-white rounded-3">
                        <form action="{{ route('apply.coupon') }}" method="POST">
                            @csrf
                            <label for="c_code" class="text-black mb-3">Enter your coupon code if you have
                                one</label>
                            <div class="input-group w-75 couponcode-wrap">
                                <input type="text" class="form-control me-2" id="c_code" name="name_discount"
                                    placeholder="Coupon Code" aria-label="Coupon Code" aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-black btn-sm" type="summit"
                                        id="button-addon2">Apply</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="col-md-7">
                    <h2 class="h3 mb-3 text-black">Your Order</h2>
                    <div class="p-3 p-lg-5 border bg-white rounded-3">
                        <table class="table site-block-order-table mb-5">
                            <thead>
                                <th>Product</th>
                                <th>Total</th>
                            </thead>
                            <tbody>
                                @foreach ($orderItems as $orderItem)
                                    <tr>
                                        <td>{{ $orderItem->product->name_product }} <strong class="mx-2">x</strong>
                                            {{ $orderItem->quantity }}</td>
                                        <td>Rp.
                                            {{ number_format($orderItem->quantity * ($orderItem->product->price_discount ? $orderItem->product->price_discount : $orderItem->price)) }}
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td class="text-black font-weight-bold"><strong>Cart Subtotal</strong></td>
                                    <td class="text-black">Rp. {{ number_format($subtotal) }}</td>
                                </tr>
                                <tr>
                                    <td class="text-black font-weight-bold"><strong>Diskon</strong></td>
                                    <td class="text-black">Rp.
                                        {{ number_format($order->discount_amount ?? 0) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                                    <td class="text-black font-weight-bold"><strong>Rp.
                                            {{ number_format($total) }}</strong></td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="form-group d-flex justify-content-end">
                            <button type="button" id="pay-button" class="btn btn-black btn-lg btn-block"
                                style="font-size: 0.9rem">Place
                                Order
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            snap.pay('{{ $snapToken }}', {
                // Optional
                onSuccess: function(result) {
                    // Redirect ke halaman checkoutUpdate dengan parameter ID order yang telah dibuat
                    window.location.href = "{{ route('checkoutUpdate') }}?order_id=" +
                        '{{ $order->id }}';
                },
                // Optional
                onPending: function(result) {
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                // Optional
                onError: function(result) {
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                }
            });
        };
    </script>



</x-layout-home>
