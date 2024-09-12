<?php

namespace App\Http\Controllers;

use App\Models\BannerDiscount;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Discount;
use App\Models\Post;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->inRandomOrder()
            ->limit(3)
            ->get();

        $posts = Post::with('user')->latest()->paginate(3);

        // Ambil semua banner_discount yang ada
        $bannerDiscounts = BannerDiscount::all();

        // Ambil discount_id dari banner_discount
        $discountIds = $bannerDiscounts->pluck('discount_id');

        // Ambil diskon pertama berdasarkan discount_id dan status active
        $banner = Discount::whereIn('id', $discountIds)
            ->where('status', 'active')
            ->first();

        return view('home.index', compact('products', 'posts', 'banner'));
    }

    public function about()
    {
        return view('home.about');
    }

    public function contact()
    {
        return view('home.contact');
    }

    public function blog()
    {

        $posts = Post::with('user')->latest()->get();

        return view('home.blog', compact('posts'));
    }

    public function blogDetail($slug)
    {
        $posts = Post::with('user')->where('slug', $slug)->first();

        $comments = Comment::where('post_id', $posts->id)
            ->where('parent_id', 0)
            ->orderBy('created_at', 'asc')
            ->get();

        $replies = Comment::where('post_id', $posts->id)
            ->where('parent_id', '!=', 0)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('home.blog-detail', compact('posts', 'comments', 'replies'));
    }

    public function comment(Request $request)
    {
        $validasi = $request->validate([
            'content' => 'required|string',
            'post_id' => 'required|exists:posts,id',
            'user_id' => 'required|exists:users,id',
            'parent' => 'sometimes|nullable|exists:comments,id',
        ],
            [
                'content.required' => 'The content field is required.',
                'post_id.required' => 'The post_id field is required.',
                'user_id.required' => 'The user_id field is required.',

            ]);

        $request['user_id'] = Auth::user()->id;
        $request['post_id'] = $request->post_id;

        Comment::create($validasi);
        notify()->success('Comment successfully added');

        return redirect()->back();

    }

    public function shippingAddress()
    {
        return view('home.shipping-address');
    }

    public function shippingAddressProcess(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi input dari request
        $validated = $request->validate([
            'fullname' => 'required|min:3|max:50',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone' => 'required|min:10|max:13',
            'address' => 'required|min:10|max:255',
            'country' => 'required|min:3|max:255',
            'city' => 'required|min:3|max:255',
            'postal_code' => 'required|min:3|max:255',
        ]);
        $user->update($validated);

        notify()->success('Shipping address updated successfully', 'Success');

        return redirect()->route('checkout');

    }

    public function shop()
    {
        $products = Product::with('category')->get();

        $category = Category::all();

        return view('home.shop', compact('products', 'category'));
    }

    public function service()
    {
        return view('home.service');
    }

    public function profile()
    {
        return view('home.profile');
    }

    public function changePassword()
    {
        return view('home.change-password');
    }
}
