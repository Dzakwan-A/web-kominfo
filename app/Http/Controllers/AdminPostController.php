<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminPostController extends Controller
{

    public function dashboard()
    {
        $posts = Post::latest('published_at')->latest('created_at')->paginate(8);
        return view('admin.dashboard', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required','string','max:160'],
            'excerpt' => ['nullable','string','max:300'],
            'body' => ['required','string'],
            'thumbnail' => ['nullable','image','max:4096'],
            'status' => ['required','in:draft,publish'],
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails','public');
        }

        $post = Post::create([
            'title' => $data['title'],
            'slug' => Str::slug($data['title']).'-'.Str::random(5),
            'excerpt' => $data['excerpt'] ?? Str::limit(strip_tags($data['body']), 140),
            'body' => $data['body'],
            'thumbnail' => $thumbnailPath,
            'published_at' => $data['status'] === 'publish' ? now() : null,
            'user_id' => $request->user()->id,
        ]);

        return redirect()->route('admin.dashboard')->with('status', 'Berita berhasil disimpan.');
    }
}
