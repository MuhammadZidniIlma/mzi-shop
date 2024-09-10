<x-layout-home>
    <div class="container my-5">
        <div class="card p-4 rounded-3">
            <div class="col-12">
                <div class="card-body px-0 pt-0 pb-2 mb-5">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Order Date</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                    <th>Invoice</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $order->user->username }}</td>
                                        <td>{{ $order->order_date }}</td>
                                        <td>Rp. {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                        <td><span class="me-1 text-capitalize">{{ $order->status }}</span></td>
                                        <td>
                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#invoiceModal{{ $order->id }}" class="text-success">
                                                Invoice
                                            </button>

                                            @include('home.invoice')
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div style="height: 100px"></div>
    </div>
</x-layout-home>
