<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PublicPostController extends Controller
{
    public function index()
    {
        $posts = Post::whereNotNull('published_at')
            ->latest('published_at')
            ->paginate(9);

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        // hanya berita yang sudah publish yang boleh dilihat publik
        if (is_null($post->published_at)) {
            abort(404);
        }

        return view('posts.show', compact('post'));
    }
}
