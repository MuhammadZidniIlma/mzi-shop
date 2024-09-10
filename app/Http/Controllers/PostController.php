<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10);

        return view('dashboard.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('dashboard.posts.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ], [
            'image.mimes' => 'File image harus berupa jpeg, png, jpg, svg',
            'image.max' => 'File image maksimal 2 MB',
            'image.image' => 'File image harus berupa gambar',
            'title.required' => 'Title harus diisi',
            'content.required' => 'Content harus diisi',

        ]);
        // Simpan data post ke database
        $post = Post::create($validated);

        // Cek apakah gambar diunggah
        if ($request->hasFile('image')) {
            // Gunakan slug dari model sebagai nama file
            $imageName = $post->slug.'.'.$request->image->extension();
            $request->image->move(public_path('image'), $imageName);

            // Update nama file gambar pada record post
            $post->update(['image' => $imageName]);
        }

        // Kirim notifikasi atau pesan sukses
        notify()->success('Post successfully created');

        return redirect()->route('posts');
    }

    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->first();

        return view('dashboard.posts.edit', compact('post'));
    }

    public function update(Request $request, $slug)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        // Cari post berdasarkan slug
        $post = Post::where('slug', $slug)->firstOrFail();

        // Cek apakah gambar diunggah
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($post->image && file_exists(public_path('image/'.$post->image))) {
                unlink(public_path('image/'.$post->image));
            }

            // Gunakan slug dari model sebagai nama file
            $imageName = $post->slug.'.'.$request->image->extension();
            $request->image->move(public_path('image'), $imageName);

            // Update nama file gambar pada record post
            $validated['image'] = $imageName;
        }

        // Update data postingan di database
        $post->update($validated);

        // Kirim notifikasi atau pesan sukses
        notify()->success('Post successfully updated');

        return redirect()->route('posts');
    }

    public function delete($slug)
    {
        Post::where('slug', $slug)->delete();
        notify()->success('Post data deleted successfully', 'Success');

        return redirect()->route('posts');
    }
}
