<x-layout-dashboard>
    <x-order-dashboard>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ $order->user->username }}</td>
                    <td>
                        {{ $order->order_date }}
                    </td>
                    <td>
                        Rp. {{ number_format($order->total_price) }}
                    </td>
                    <td><span
                            class="badge bg-label-{{ $order->status == 'completed' ? 'success' : 'danger' }} me-1 text-capitalize">{{ $order->status }}</span>
                    </td>
                    <td>
                        -
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-order-dashboard>
</x-layout-dashboard>
