<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = $request->query('q');
        $announcements = Announcement::query()
            ->when($q, function ($query, $q) {
                $like = '%' . $q . '%';
                $query->where('title3', 'like', $like)
                      ->orWhere('deskripsi2', 'like', $like);
            })
            ->latest('date3')
            ->paginate(10)
            ->withQueryString();

        return view('admin.announcements.index', [
            'announcements' => $announcements,
            'q' => $q,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.announcements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title3'    => ['required', 'string', 'max:255'],
            'slug3'     => ['nullable', 'string', 'max:255', 'unique:announcements,slug3'],
            'date3'     => ['required', 'date'],
            'deskripsi2'=> ['nullable', 'string'],
        ]);

        if (empty($validated['slug3'] ?? null) && !empty($validated['title3'])) {
            $validated['slug3'] = Str::slug($validated['title3']);
        }

        Announcement::create($validated);

        return redirect()
            ->route('admin.announcements.index')
            ->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Announcement $announcement)
    {
        return view('admin.announcements.show', compact('announcement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Announcement $announcement)
    {
        return view('admin.announcements.edit', compact('announcement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Announcement $announcement)
    {
        $validated = $request->validate([
            'title3'    => ['required', 'string', 'max:255'],
            'slug3'     => ['nullable', 'string', 'max:255', 'unique:announcements,slug3,' . $announcement->id],
            'date3'     => ['required', 'date'],
            'deskripsi2'=> ['nullable', 'string'],
        ]);

        if (empty($validated['slug3'] ?? null) && !empty($validated['title3'])) {
            $validated['slug3'] = Str::slug($validated['title3']);
        }

        $announcement->update($validated);

        return redirect()
            ->route('admin.announcements.index')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

        return redirect()
            ->route('admin.announcements.index')
            ->with('success', 'Pengumuman berhasil dihapus.');
    }
}
