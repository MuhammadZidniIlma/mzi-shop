<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::all();

        return view('dashboard.discounts.index', compact('discounts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_discount' => 'required|unique:discounts',
            'persentase_discount' => 'required',
            'amount_discount' => 'required|integer',
            'start_date' => 'required|date',
            'expiration_date' => 'required|date',
        ]);

        Discount::create($validated);
        notify()->success('Discount created successfully', 'Success');

        return redirect()->back();
    }

    public function delete($id)
    {
        Discount::findOrFail($id)->delete();
        notify()->success('Discount data deleted successfully', 'Success');

        return redirect()->back();
    }

    public function applyCoupon(Request $request)
    {
        $couponCode = $request->name_discount;

        // Cek apakah diskon dengan kode kupon yang diberikan valid
        $discount = Discount::where('name_discount', $couponCode)
            ->where('start_date', '<=', now())
            ->where('expiration_date', '>=', now())
            ->first();

        //Jika order tidak ditemukan, kembalikan error atau redirect
        if (! $discount) {
            notify()->error('Order not found', 'Failed');

            return redirect()->back();
        }
        if ($discount) {
            // Ambil order yang statusnya unpaid
            $order = Order::where('user_id', Auth::id())
                ->where('status', 'unpaid')
                ->first();
            // Jika diskon amount dan diskon id di order sebelumnya ada dan menambahkan diskon baru, hapus diskon sebelumnya
            if (! $discount->id == null) {
                $order->total_price = $order->total_price + $order->discount_amount;
                $order->discount_id = null;
                $order->discount_amount = null;
                $order->update();
            }
            if ($order) {
                // Hitung diskon
                $discountAmount = ($order->total_price * $discount->persentase_discount) / 100;
                //Jika discount amount melebihi total price, kembalikan error atau redirect
                if ($discountAmount < $discount->amount_discount) {

                    //discount_id dan discount_amount harus diupdate
                    $discountAmount = $discount->amount_discount;

                    notify()->error('Discount amount exceeds total price', 'Failed');

                    return redirect()->back();
                }
                //Cek apakah diskon melebihi total amount discount
                if ($discountAmount > $discount->amount_discount) {
                    $discountAmount = $discount->amount_discount;
                }
                // Update total harga dengan diskon
                $newTotalPrice = $order->total_price - $discountAmount;
                // Simpan diskon ke order
                $order->discount_id = $discount->id;
                $order->discount_amount = $discountAmount;
                $order->total_price = $newTotalPrice;

                $order->update();
            }

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

            notify()->success('Discount applied successfully', 'Success');

            return redirect()->back();
        }
    }
}
