<?php

namespace App\Http\Controllers;

use App\Models\Order;

class StatusOrderController extends Controller
{
    public function index()
    {
        // Ambil data orders berdasarkan status
        $orders = Order::with('user')->where('status', 'pending')->latest()->get();

        // Kirim data orders ke view dengan komponen
        return view('dashboard.orders.index', compact('orders'));
    }

    public function confirmed()
    {
        // Ambil data orders berdasarkan status
        $orders = Order::with('user')->where('status', 'confirmed')->latest()->get();

        // Kirim data orders ke view dengan komponen
        return view('dashboard.orders.confirmed', compact('orders'));
    }

    public function confirmOrder($id)
    {
        // Temukan pesanan berdasarkan ID
        $order = Order::find($id);
        // Jika pesanan ditemukan, ubah statusnya menjadi 'confirmed'
        if ($order) {
            $order->status = 'confirmed';
            $order->save();
        }

        notify()->success('Order status updated to confirmed', 'Success');

        // Redirect kembali ke halaman checkout atau halaman lain yang sesuai
        return redirect()->back();
    }

    public function shipped()
    {
        // Ambil data orders berdasarkan status
        $orders = Order::with('user')->where('status', 'shipped')->latest()->get();

        // Kirim data orders ke view dengan komponen
        return view('dashboard.orders.shipped', compact('orders'));
    }

    public function shipOrder($id)
    {
        // Temukan pesanan berdasarkan ID
        $order = Order::find($id);
        // Jika pesanan ditemukan, ubah statusnya menjadi 'confirmed'
        if ($order) {
            $order->status = 'shipped';
            $order->save();
        }

        notify()->success('Order status updated to confirmed', 'Success');

        // Redirect kembali ke halaman checkout atau halaman lain yang sesuai
        return redirect()->back();
    }

    public function packed()
    {
        // Ambil data orders berdasarkan status
        $orders = Order::with('user')->where('status', 'packed')->latest()->get();

        // Kirim data orders ke view dengan komponen
        return view('dashboard.orders.packed', compact('orders'));
    }

    public function packOrder($id)
    {
        // Temukan pesanan berdasarkan ID
        $order = Order::find($id);
        // Jika pesanan ditemukan, ubah statusnya menjadi 'confirmed'
        if ($order) {
            $order->status = 'packed';
            $order->save();
        }

        notify()->success('Order status updated to confirmed', 'Success');

        // Redirect kembali ke halaman checkout atau halaman lain yang sesuai
        return redirect()->back();
    }

    public function completed()
    {
        // Ambil data orders berdasarkan status
        $orders = Order::with('user')->where('status', 'completed')->latest()->get();

        // Kirim data orders ke view dengan komponen
        return view('dashboard.orders.completed', compact('orders'));
    }

    public function completeOrder($id)
    {
        // Temukan pesanan berdasarkan ID
        $order = Order::find($id);
        // Jika pesanan ditemukan, ubah statusnya menjadi 'confirmed'
        if ($order) {
            $order->status = 'completed';
            $order->save();
        }

        notify()->success('Order status updated to confirmed', 'Success');

        // Redirect kembali ke halaman checkout atau halaman lain yang sesuai
        return redirect()->back();
    }
}
