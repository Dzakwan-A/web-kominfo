<?php

namespace App\Http\Controllers\Writer;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            // Tag dipisahkan dengan koma, contoh: "kota baru, kegiatan, kominfo"
            'tags' => ['nullable','string','max:255'],
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails','public');
        }

        // Normalisasi tag: trim, buang yang kosong, hapus duplikat, gabungkan lagi
        $normalizedTags = null;
        if (!empty($data['tags'] ?? null)) {
            $normalizedTags = collect(explode(',', $data['tags']))
                ->map(fn ($t) => trim($t))
                ->filter()
                ->unique()
                ->take(15)
                ->implode(', ');
        }

        Post::create([
            'title' => $data['title'],
            'slug' => Str::slug($data['title']).'-'.Str::random(5),
            'excerpt' => $data['excerpt'] ?? Str::limit(strip_tags($data['body']), 140),
            'body' => $data['body'],
            'thumbnail' => $thumbnailPath,
            'published_at' => $data['status'] === 'publish' ? now() : null,
            'user_id' => $request->user()->id, // ✅ penting biar “punya siapa”
            'tags' => $normalizedTags,
        ]);

        return redirect()->route('writer.dashboard')->with('status', 'Berita berhasil disimpan.');
    }

    public function edit(Post $post)
{
    // ✅ pastikan hanya pemilik yang bisa edit
    abort_if($post->user_id !== auth::id(), 403);

    return view('writer.posts.edit', compact('post'));
}

public function update(Request $request, Post $post)
{
    abort_if($post->user_id !== auth::id(), 403);

    $data = $request->validate([
        'title' => ['required','string','max:160'],
        'excerpt' => ['nullable','string','max:300'],
        'body' => ['required','string'],
        'thumbnail' => ['nullable','image','max:4096'],
        'status' => ['required','in:draft,publish'],
        'tags' => ['nullable','string','max:255'],
    ]);

    // upload thumbnail kalau ada
    if ($request->hasFile('thumbnail')) {
        $post->thumbnail = $request->file('thumbnail')->store('thumbnails', 'public');
    }

    $post->title = $data['title'];
    $post->excerpt = $data['excerpt'] ?? $post->excerpt;
    $post->body = $data['body'];

    // normalisasi tag
    if (array_key_exists('tags', $data)) {
        $post->tags = !empty($data['tags'])
            ? collect(explode(',', $data['tags']))
                ->map(fn ($t) => trim($t))
                ->filter()
                ->unique()
                ->take(15)
                ->implode(', ')
            : null;
    }

    // publish logic
    $post->published_at = $data['status'] === 'publish'
        ? ($post->published_at ?? now())
        : null;

    $post->save();

    return redirect()->route('writer.dashboard')->with('status', 'Berita berhasil diperbarui.');
}


    public function destroy(Post $post)
{
    // ✅ hanya pemilik yang bisa hapus
    abort_if($post->user_id !== Auth::id(), 403);

    // (opsional) hapus file thumbnail kalau ada
    if ($post->thumbnail) {
        Storage::disk('public')->delete($post->thumbnail);
    }

    $post->delete();

    return redirect()
        ->route('writer.dashboard')
        ->with('status', 'Berita berhasil dihapus.');
}


}
