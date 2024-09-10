<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request, $slug)
    {
        // Pastikan user sudah autentikasi
        if (! Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Ambil ID user yang sedang login
        $user_id = Auth::user()->id;

        // Cari produk berdasarkan slug
        $product = Product::where('slug', $slug)->first();

        //Jika product stock habis, kembalikan error atau redirect
        if ($product->stock <= 0) {
            // Tambahkan notifikasi
            notify()->error('Out of stock', 'Failed');

            return redirect()->back();
        }

        // Jika Quantiti yang diorder kurang dari 1, kembalikan error atau redirect
        if ($request->quantity < 1) {
            // Tambahkan notifikasi
            notify()->error('Quantity must be greater than 0', 'Failed');

            return redirect()->back();
        }

        // Jika produk tidak ditemukan, kembalikan error atau redirect
        if (! $product) {
            notify()->error('Product not found', 'Error');

            return redirect()->back();
        }

        // Cek apakah ada order dengan status unpaid untuk user ini
        $order = Order::where('user_id', $user_id)->where('status', 'unpaid')->first();

        // Jika tidak ada, buat order baru
        if (! $order) {
            $order = new Order;
            $order->order_date = Carbon::now();
            $order->status = 'unpaid';
            $order->total_price = 0;
            $order->user_id = $user_id;

            $order->save();
        }

        // Cek apakah produk sudah ada di dalam order
        $orderItem = OrderItem::where('order_id', $order->id)->where('product_id', $product->id)->first();

        //Cek apakah quantity melebihi stock
        if ($request->quantity > $product->stock) {
            // Tambahkan notifikasi
            notify()->error('Quantity exceeds available stock', 'Failed');

            return redirect()->back();
        }
        // Jika item tidak ada, buat baru
        if (! $orderItem) {
            $orderItem = new OrderItem;
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $product->id;
            $orderItem->quantity = $request->quantity;
            $order->discount_id = null;
            $order->discount_amount = null;
            $orderItem->price = $product->price_discount ?: $product->price; // Gunakan harga diskon jika ada

            $orderItem->save();
        } else {
            // Jika item sudah ada, update kuantitasnya
            $orderItem->quantity += $request->quantity;
            $order->discount_id = null;
            $order->discount_amount = null;
            $orderItem->update();
        }

        // Update total harga pada order
        $order->total_price = OrderItem::where('order_id', $order->id)->sum(DB::raw('quantity * price'));
        $order->save();

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = config('midtrans.is_3ds');

        $params = [
            'transaction_details' => [
                'order_id' => rand(),
                'gross_amount' => $order->total_price,
            ],
            'customer_details' => [
                'username' => Auth::user()->username,
                'email' => Auth::user()->email,
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        //simpan ke database
        $order->snap_token = $snapToken;
        $order->update();

        notify()->success('Order created successfully', 'Success');

        // Redirect atau kembalikan respon sesuai kebutuhan
        return redirect()->back();
    }

    public function trolly()
    {
        // Ambil semua item dalam order yang terkait dengan user yang sedang login
        $orderItems = OrderItem::with('order', 'product')
            ->whereHas('order', function ($query) {
                $query->where('user_id', Auth::id())->where('status', 'unpaid');
            })
            ->get();

        // Hitung subtotal dengan menjumlahkan semua (quantity * price) dari setiap order item
        $subtotal = $orderItems->sum(function ($orderItem) {
            return $orderItem->quantity * $orderItem->price;
        });

        // Kembalikan view dengan order items dan subtotal
        return view('home.trolly', compact('orderItems', 'subtotal'));
    }

    public function deleteItem($id)
    {
        $orderItem = OrderItem::find($id);
        $order = Order::where('id', $orderItem->order_id)->first();
        $order->total_price = $order->total_price - ($orderItem->quantity * $orderItem->price);
        $order->total_price = $order->total_price + $order->discount_amount;
        $order->discount_id = null;
        $order->discount_amount = null;
        $order->update();
        $orderItem->delete();

        notify()->success('Order item deleted successfully', 'Success');

        return redirect()->back();
    }

    public function checkout()
    {

        $orderItems = OrderItem::with('order', 'product')
            ->whereHas('order', function ($query) {
                $query->where('user_id', Auth::id())->where('status', 'unpaid');
            })
            ->get();

        // cek apakah order item ada
        if ($orderItems->isEmpty()) {
            notify()->error('No order items found', 'Error');

            return redirect()->route('trolly');
        }

        //ambil snap token di database order
        // Ambil order yang belum dibayar
        $order = Order::where('user_id', Auth::id())->where('status', 'unpaid')->first();
        $snapToken = $order ? $order->snap_token : null; // Pastikan snapToken ada

        $subtotal = $orderItems->sum(function ($orderItem) {
            return $orderItem->quantity * $orderItem->price;
        });

        $total = $order->total_price;

        return view('home.checkout', compact('orderItems', 'subtotal', 'order', 'snapToken', 'total'));
    }

    public function checkoutUpdate(Request $request)
    {

        $orderId = $request->query('order_id');

        // Temukan pesanan berdasarkan ID
        $order = Order::with('orderItems')->findOrFail($orderId);

        // Pastikan order items tidak null
        if (! $order || ! $order->orderItems) {
            notify()->error('Order not found or has no items.', 'Error');

            return redirect()->route('thankyou');
        }
        // Perbarui status pesanan menjadi 'pending' dan perbarui order_date
        $order->order_date = Carbon::now();
        $order->status = 'pending';
        $order->save();

        // Update stok produk
        foreach ($order->orderItems as $orderItem) {
            // Pastikan produk ada
            if ($orderItem->product) {
                $product = $orderItem->product;
                $product->stock = $product->stock - $orderItem->quantity;
                $product->save();
            }
        }

        // Redirect ke halaman terima kasih atau konfirmasi
        return redirect()->route('thankyou');
    }

    public function thankyou()
    {
        return view('home.thankyou');
    }

    public function checkOrderStatus()
    {
        $orders = Order::with('orderItems', 'user')->where('user_id', Auth::id())->latest()->get();

        // Ambil semua item dalam order yang terkait dengan user yang sedang login
        $orderItems = OrderItem::with('order', 'product')
            ->whereHas('order', function ($query) {
                $query->where('user_id', Auth::id())->where('order_id');
            })
            ->get();
        // Hitung subtotal dengan menjumlahkan semua (quantity * price) dari setiap order item
        $subtotal = $orderItems->sum(function ($orderItem) {
            return $orderItem->quantity * $orderItem->price;
        });

        return view('home.check-order-status', compact('orders', 'orderItems', 'subtotal'));
    }

    public function invoice()
    {
        return view('home.invoice');
    }
}
