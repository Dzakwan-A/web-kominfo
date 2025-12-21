<?php

namespace App\Http\Controllers\Writer;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function dashboard()
    {
        // hanya berita milik penulis ini
        $posts = Post::where('user_id', request()->user()->id)
            ->latest('published_at')
            ->latest('created_at')
            ->paginate(8);

        return view('writer.dashboard', compact('posts'));
    }

    public function create()
    {
        return view('writer.posts.create');
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

        Post::create([
            'title' => $data['title'],
            'slug' => Str::slug($data['title']).'-'.Str::random(5),
            'excerpt' => $data['excerpt'] ?? Str::limit(strip_tags($data['body']), 140),
            'body' => $data['body'],
            'thumbnail' => $thumbnailPath,
            'published_at' => $data['status'] === 'publish' ? now() : null,
            'user_id' => $request->user()->id, // ✅ penting biar “punya siapa”
        ]);

        return redirect()->route('writer.dashboard')->with('status', 'Berita berhasil disimpan.');
    }
}
