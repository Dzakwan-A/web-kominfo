<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilePage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilePageController extends Controller
{
    public function edit()
    {
        // pastikan route ini dilindungi middleware admin di routes/web.php
        $pages = ProfilePage::orderBy('order')->get();

        return view('admin.profile.edit', compact('pages'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'pages' => 'required|array',
            'pages.*.id' => 'required|exists:profile_pages,id',
            'pages.*.title' => 'required|string|max:255',
            'pages.*.content' => 'nullable|string',
        ]);

        foreach ($data['pages'] as $pageData) {
            ProfilePage::where('id', $pageData['id'])->update([
                'title' => $pageData['title'],
                'content' => $pageData['content'],
            ]);
        }

        return redirect()
            ->route('admin.profile.edit')
            ->with('success', 'Halaman profil berhasil diperbarui.');
    }


     public function uploadImage(Request $request)
    {
        $data = $request->validate([
            'image' => 'required|image|max:2048', // max 2MB
        ]);

        // Simpan ke storage/app/public/profile
        $path = $data['image']->store('profile', 'public');

        // Buat URL yang bisa dipakai di <img src="...">
        $url = Storage::url($path); // contoh: /storage/profile/namafile.jpg

        return back()->with('uploaded_image_url', $url);
    }
}
