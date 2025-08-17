<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = $request->string('q')->toString();
        $galleries = Gallery::query()
            ->search($q)
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.galleries.index', [
            'galleries' => $galleries,
            'q' => $q,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:galleries,slug'],
            'caption' => ['nullable', 'string'],
            'published_at' => ['nullable', 'date'],
            'image' => ['nullable', 'image', 'max:5120'], // maks 5MB
        ]);

        if (empty($validated['slug'] ?? null) && !empty($validated['title'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Upload file
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('galleries', 'public');
            $validated['image_path'] = $path;
        }

        $gallery = Gallery::create([
            'title' => $validated['title'],
            'slug' => $validated['slug'] ?? null,
            'caption' => $validated['caption'] ?? null,
            'published_at' => $validated['published_at'] ?? null,
            'image_path' => $validated['image_path'] ?? null,
        ]);

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Gallery berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        return view('admin.galleries.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:galleries,slug,' . $gallery->id],
            'caption' => ['nullable', 'string'],
            'published_at' => ['nullable', 'date'],
            'image' => ['nullable', 'image', 'max:5120'],
            'remove_image' => ['nullable', 'boolean'],
        ]);

        if (empty($validated['slug'] ?? null) && !empty($validated['title'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Handle image replacement
        if ($request->hasFile('image')) {
            // delete old image if exist
            if ($gallery->image_path && Storage::disk('public')->exists($gallery->image_path)) {
                Storage::disk('public')->delete($gallery->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('galleries', 'public');
        } elseif (!empty($validated['remove_image'])) {
            if ($gallery->image_path && Storage::disk('public')->exists($gallery->image_path)) {
                Storage::disk('public')->delete($gallery->image_path);
            }
            $validated['image_path'] = null;
        }

        $gallery->update([
            'title' => $validated['title'],
            'slug' => $validated['slug'] ?? $gallery->slug,
            'caption' => $validated['caption'] ?? null,
            'published_at' => $validated['published_at'] ?? null,
            'image_path' => $validated['image_path'] ?? $gallery->image_path,
        ]);

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Gallery berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        if ($gallery->image_path && Storage::disk('public')->exists($gallery->image_path)) {
            Storage::disk('public')->delete($gallery->image_path);
        }
        $gallery->delete();

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Gallery berhasil dihapus.');
    }
}
