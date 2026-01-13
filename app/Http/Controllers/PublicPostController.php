<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PublicPostController extends Controller
{
    public function index()
    {
        $posts = Post::whereNotNull('published_at')
            ->latest('published_at')
            ->paginate(9);

        return view('posts.index', compact('posts'));
    }

    /**
     * Filter / cari berita berdasarkan judul dan tag.
     * URL referensi: /berita/result/filter?cari_berita=...
     */
    public function filter(Request $request)
    {
        $q = trim((string) $request->query('cari_berita', ''));

        $posts = Post::whereNotNull('published_at')
            ->when($q !== '', function ($query) use ($q) {
                // PostgreSQL: gunakan ILIKE untuk case-insensitive
                $query->where(function ($sub) use ($q) {
                    $sub->where('title', 'ilike', "%{$q}%")
                        ->orWhere('tags', 'ilike', "%{$q}%");
                });
            })
            ->latest('published_at')
            ->paginate(9)
            ->appends(['cari_berita' => $q]);

        return view('posts.filter', [
            'posts' => $posts,
            'q' => $q,
        ]);
    }

    public function show(Request $request, Post $post)
    {
        // hanya berita yang sudah publish yang boleh dilihat publik
        if (is_null($post->published_at)) {
            abort(404);
        }

        // Hitung view (dibatasi 1x per sesi per berita agar refresh tidak spam angka)
        $viewed = $request->session()->get('viewed_posts', []);
        if (!in_array($post->id, $viewed, true)) {
            $post->increment('views');
            $viewed[] = $post->id;
            $request->session()->put('viewed_posts', $viewed);
        }

        return view('posts.show', compact('post'));
    }
}
