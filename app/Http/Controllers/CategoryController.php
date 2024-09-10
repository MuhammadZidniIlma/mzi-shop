<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('dashboard.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_category' => 'required|unique:categories|min:3|max:255',
        ], [
            'name_category.required' => 'Category name is required',
            'name_category.unique' => 'Category name already exists',
            'name_category.min' => 'Category name must be at least 3 characters',
            'name_category.max' => 'Category name must not exceed 255 characters',
        ]);

        Category::create($validated);
        notify()->success('Category data added successfully', 'Success');

        return redirect()->back();
    }

    public function update(Request $request, $slug)
    {
        $validated = $request->validate([
            'name_category' => 'required|min:3|max:255',
        ], [
            'name_category.required' => 'Category name is required',
            'name_category.min' => 'Category name must be at least 3 characters',
            'name_category.max' => 'Category name must not exceed 255 characters',
        ]);

        $categories = Category::where('slug', $slug)->firstOrFail();
        $categories->update($validated);
        notify()->success('Category data updated successfully', 'Success');

        return redirect()->back();
    }

    public function delete($slug)
    {
        Category::where('slug', $slug)->delete();
        notify()->success('Category data deleted successfully', 'Success');

        return redirect()->back();
    }
}
