<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\news;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');
        $items = news::query()
            ->when($q, function ($query, $q) {
                $like = '%' . $q . '%';
                $query->where('title_B', 'like', $like)
                      ->orWhere('deskripsi', 'like', $like);
            })
            ->latest('date_2')
            ->paginate(10)
            ->withQueryString();

        return view('admin.news.index', ['news' => $items, 'q' => $q]);
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_B'  => ['required', 'string', 'max:255'],
            'slug2'    => ['nullable', 'string', 'max:255', 'unique:news,slug2'],
            'date_2'   => ['required', 'date'],
            'deskripsi'=> ['nullable', 'string'],
        ]);

        if (empty($validated['slug2'] ?? null) && !empty($validated['title_B'])) {
            $validated['slug2'] = Str::slug($validated['title_B']);
        }

        news::create($validated);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function show(news $news)
    {
        return view('admin.news.show', compact('news'));
    }

    public function edit(news $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, news $news)
    {
        $validated = $request->validate([
            'title_B'  => ['required', 'string', 'max:255'],
            'slug2'    => ['nullable', 'string', 'max:255', 'unique:news,slug2,' . $news->id],
            'date_2'   => ['required', 'date'],
            'deskripsi'=> ['nullable', 'string'],
        ]);

        if (empty($validated['slug2'] ?? null) && !empty($validated['title_B'])) {
            $validated['slug2'] = Str::slug($validated['title_B']);
        }

        $news->update($validated);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(news $news)
    {
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dihapus.');
    }
}
