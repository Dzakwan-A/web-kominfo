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
        $slides     = Post::latest()->take(5)->get();       // untuk slider utama
        $berita     = Post::latest()->skip(5)->take(4)->get();
        $agenda     = Event::upcoming()->take(3)->get();    // scope upcoming pada model Event
        $pengumuman = Announcement::latest()->take(3)->get();
        $galeri     = Gallery::latest()->take(6)->get();

        return view('home', compact('slides','berita','agenda','pengumuman','galeri'));
    }
}
