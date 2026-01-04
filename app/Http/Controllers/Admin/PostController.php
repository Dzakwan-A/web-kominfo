<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|max:255',
            'body'        => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'thumbnail'   => 'nullable|image|max:2048',
            // Tag dipisahkan dengan koma, contoh: "kota baru, kegiatan, kominfo"
            'tags'        => 'nullable|string|max:255',
        ]);

        $thumb = $request->hasFile('thumbnail')
            ? $request->file('thumbnail')->store('thumbnails', 'public')
            : null;

        $normalizedTags = null;
        if (!empty($request->tags)) {
            $normalizedTags = collect(explode(',', $request->tags))
                ->map(fn ($t) => trim($t))
                ->filter()
                ->unique()
                ->take(15)
                ->implode(', ');
        }

        Post::create([
            'title'        => $request->title,
            'slug'         => Str::slug($request->title),
            'body'         => $request->body,
            'thumbnail'    => $thumb,
            'published_at' => now(),
            'category_id'  => $request->category_id,
            'tags'         => $normalizedTags,
        ]);

        return redirect()->route('admin.posts.index')
                         ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Post $post)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'       => 'required|max:255',
            'body'        => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'thumbnail'   => 'nullable|image|max:2048',
            'tags'        => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('thumbnail')) {
            $post->thumbnail = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $normalizedTags = null;
        if (!empty($request->tags)) {
            $normalizedTags = collect(explode(',', $request->tags))
                ->map(fn ($t) => trim($t))
                ->filter()
                ->unique()
                ->take(15)
                ->implode(', ');
        }

        $post->update([
            'title'       => $request->title,
            'slug'        => Str::slug($request->title),
            'body'        => $request->body,
            'category_id' => $request->category_id,
            'tags'        => $normalizedTags,
        ]);

        return redirect()->route('admin.posts.index')
                         ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('success', 'Berita berhasil dihapus.');
    }
}
