<?php

namespace App\Http\Controllers;

use App\Models\BannerDiscount;
use App\Models\Discount;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DiscountController extends Controller
{
    public function index()
    {
        Discount::updateStatuses();
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
        //status mengambil dari request antara start_date dan expiration_date
        $validated['status'] = $request->start_date <= now() && $request->expiration_date >= now() ? 'active' : 'inactive';
        Discount::create($validated);

        notify()->success('Discount created successfully', 'Success');

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $discount = Discount::findOrFail($id);

        $validated = $request->validate([
            'name_discount' => [
                'required',
                Rule::unique('discounts')->ignore($discount->id),
            ],
            'persentase_discount' => 'required',
            'amount_discount' => 'required|integer',
            'start_date' => 'required|date',
            'expiration_date' => 'required|date',
        ]);
        $validated['status'] = $request->start_date <= now() && $request->expiration_date >= now() ? 'active' : 'inactive';
        $discount->update($validated);
        notify()->success('Discount updated successfully', 'Success');

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

    public function banner()
    {
        $bannerDiscounts = BannerDiscount::with('discount')->first();
        $discounts = Discount::all();

        return view('dashboard.banner-discount.index', compact('bannerDiscounts', 'discounts'));
    }

    public function bannerUpdate(Request $request, $id)
    {
        BannerDiscount::where('id', $id)->update([
            'discount_id' => $request->discount_id,
        ]);

        // Kirim notifikasi atau pesan sukses
        notify()->success('Post successfully updated');

        return redirect()->route('discount.banner');
    }

    public function bannerUpload(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ], [
            'image.required' => 'Gambar harus diunggah',
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, svg',
            'image.max' => 'Ukuran gambar maksimal 2 MB',
        ]);

        // Cari discount berdasarkan id
        $discount = Discount::findOrFail($id);

        // Cek apakah gambar diunggah
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($discount->image && file_exists(public_path('image/'.$discount->image))) {
                unlink(public_path('image/'.$discount->image));
            }

            // Gunakan nama diskon sebagai nama file
            $imageExtension = $request->image->extension();
            $imageName = $discount->name_discount.'.'.$imageExtension;

            // Pindahkan file gambar ke direktori yang ditentukan
            $request->image->move(public_path('image'), $imageName);

            // Update nama file gambar pada record discount
            $discount->image = $imageName;
            $discount->save();
        }

        // Kirim notifikasi atau pesan sukses
        notify()->success('Banner successfully updated');

        return redirect()->route('discount.banner');
    }
}
