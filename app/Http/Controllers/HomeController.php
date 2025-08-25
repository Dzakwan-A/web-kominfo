<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Event;
use App\Models\Announcement;
use App\Models\Gallery;

class HomeController extends Controller
{
    public function index()
    {
        $slides = Post::query()->latest()->take(5)->get();
        $berita = Post::query()->latest()->skip(5)->take(4)->get();
        $agenda = Event::query()->upcoming()->take(3)->get();
        $pengumuman = Announcement::query()->latest()->take(3)->get();
        $galeri = Gallery::query()->latest()->take(6)->get();

        return view('home', compact('slides', 'berita', 'agenda', 'pengumuman', 'galeri'));
    }
}
