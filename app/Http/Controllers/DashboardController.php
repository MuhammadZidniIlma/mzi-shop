<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $categoryCount = Category::count();
        $productCount = Product::count();

        return view('dashboard.index', compact('userCount', 'categoryCount', 'productCount'));
    }
}
