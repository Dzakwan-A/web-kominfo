<?php

namespace App\Http\Controllers;

use App\Models\ProfilePage;
use Illuminate\Support\Facades\Blade;

class ProfilePageController extends Controller
{
    public function show(string $key)
    {
        $page = ProfilePage::where('key', $key)->firstOrFail();

        // Render isi konten sebagai Blade (supaya {{ route() }} dll jalan)
        $rendered = Blade::render($page->content ?? '', [
            'appName' => config('app.name'),
        ]);

        return view('profile.show', [
            'page'    => $page,
            'content' => $rendered,
        ]);
    }
}
