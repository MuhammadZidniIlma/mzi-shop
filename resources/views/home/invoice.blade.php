<!-- Button trigger modal -->
@foreach ($orders as $order)
    <!-- Invoice Modal -->
    <div class="modal fade" id="invoiceModal{{ $order->id }}" tabindex="-1"
        aria-labelledby="invoiceModalLabel{{ $order->id }}" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="container mb-5 mt-3">
                        <div class="container">
                            <div class="col-md-12">
                                <div class="text-center">
                                    <h6 class="text-2xl" style="font-weight: 800; color: #5d9fc5;">
                                        MZI Shop</h6>
                                    <p class="pt-0">Invoice</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-8">
                                    <ul class="list-unstyled">
                                        <li class="text-muted">To: <span
                                                style="color:#5d9fc5;">{{ $order->user->username }}</span>
                                        </li>
                                        <li class="text-muted">
                                            {{ $order->user->address }},
                                            {{ $order->user->city }}
                                        </li>
                                        <li class="text-muted">
                                            {{ $order->user->country }}</li>
                                        <li class="text-muted"><i class="fas fa-phone"></i>
                                            {{ $order->user->phone }}
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-xl-4">
                                    <ul class="list-unstyled">
                                        <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i>
                                            <span class="fw-bold">ID:</span>#{{ $order->id }}
                                        </li>
                                        <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i>
                                            <span class="fw-bold">Creation
                                                Date:</span>
                                            {{ $order->order_date }}
                                        </li>
                                        <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i>
                                            <span class="me-1 fw-bold">Status:</span>
                                            <span
                                                class="badge bg-warning text-black fw-bold">{{ $order->status }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="row my-2 mx-1 justify-content-center">
                                <table class="table table-striped table-borderless">
                                    <thead style="background-color:#84B0CA ;" class="text-white">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col">Unit Price</th>
                                            <th scope="col">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderItems as $item)
                                            <tr>
                                                <th scope="row">
                                                    {{ $loop->iteration }}</th>
                                                <td>{{ $item->product->name_product }}
                                                </td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>Rp.
                                                    {{ number_format($item->price, 0, ',', '.') }}
                                                </td>
                                                <td>Rp.
                                                    {{ number_format($item->quantity * $item->price, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-xl-8">
                                    <p class="ms-3">Add additional notes and
                                        payment information</p>
                                </div>
                                <div class="col-xl-3">
                                    <ul class="list-unstyled">
                                        <li class="text-muted ms-3"><span class="text-black me-4">SubTotal</span>Rp.
                                            {{ number_format($order->total_price + $order->discount_amount, 0, ',', '.') }}
                                        </li>
                                        <li class="text-muted ms-3 mt-2"><span
                                                class="text-black me-4">Discount</span>Rp. -
                                            {{ number_format($order->discount_amount, 0, ',', '.') }}
                                        </li>
                                    </ul>
                                    <p class="text-black float-start"><span class="text-black me-3">Total
                                            Price</span><span style="font-size: 25px;">Rp.
                                            {{ number_format($order->total_price, 0, ',', '.') }}</span>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-xl-10">
                                    <p>Thank you for your purchase</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
