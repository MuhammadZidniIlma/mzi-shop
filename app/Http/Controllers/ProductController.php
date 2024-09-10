<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        $category = Category::all();

        return view('dashboard.product.index', compact('products', 'category'));
    }

    public function create()
    {
        $category = Category::all();

        return view('dashboard.product.create', compact('category'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_product' => 'required|min:3|max:255',
            'description' => 'required|min:3|max:255',
            'price' => 'required|numeric',
            'price_discount' => 'nullable|numeric',
            'stock' => 'required|numeric',
            'category_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_gallery' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $validated['discount'] = 0;
        if ($request->stock == 0) {
            $validated['status'] = 'sold out';
        } else {
            $validated['status'] = 'available';
        }
        $products = Product::create($validated);

        if ($request->hasFile('image')) {
            // Simpan gambar baru
            $imageName = $products->slug.'.'.$request->image->extension();
            $request->image->move(public_path('image'), $imageName);

            // Update nama file gambar pada record user
            $products->update(['image' => $imageName]);
        }

        notify()->success('Product data added successfully', 'Success');

        return redirect()->route('products');

    }

    public function edit($slug)
    {
        $products = Product::with('category')->get();
        $product = Product::where('slug', $slug)->firstOrFail();
        $category = Category::all();

        return view('dashboard.product.edit', compact('products', 'product', 'category'));
    }

    public function update(Request $request, $slug)
    {
        // Validasi input
        $validated = $request->validate([
            'name_product' => 'required|min:3|max:255',
            'description' => 'required|min:3|max:255',
            'price' => 'required|numeric',
            'price_discount' => 'nullable|numeric',
            'stock' => 'required|numeric',
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // **Validasi gambar sebagai 'required'**
        ], [
            'name_product.required' => 'Product name is required',
            'description.required' => 'Product description is required',
            'price.required' => 'Product price is required',
            'stock.required' => 'Product stock is required',
            'category_id.required' => 'Product category is required',
        ]);

        // Tentukan status berdasarkan stok
        if ($request->stock <= 0) {
            $validated['stock'] = 0;
        }
        $validated['status'] = $request->stock <= 0 ? 'sold out' : 'available';
        $validated['discount'] = 0;

        // Temukan produk berdasarkan slug
        $product = Product::where('slug', $slug)->firstOrFail(); // **Menggunakan firstOrFail untuk mendapatkan instance produk**

        // Hapus gambar lama jika ada dan menggantinya dengan gambar baru
        if ($request->hasFile('image')) {
            // **Hapus gambar lama jika ada**
            if ($product->image && file_exists(public_path('image/'.$product->image))) {
                unlink(public_path('image/'.$product->image));
            }

            // **Simpan gambar baru**
            $imageName = $product->slug.'.'.$request->image->extension();
            $request->image->move(public_path('image'), $imageName);

            // **Update nama file gambar pada array validated**
            $validated['image'] = $imageName;
        }

        // **Update data produk dengan data yang sudah divalidasi**
        $product->update($validated);

        // Tampilkan notifikasi sukses
        notify()->success('Product data updated successfully', 'Success');

        // Redirect ke halaman produk
        return redirect()->route('products');
    }

    public function delete($slug)
    {
        Product::where('slug', $slug)->delete();
        notify()->success('Product data deleted successfully', 'Success');

        return redirect()->back();
    }
}
