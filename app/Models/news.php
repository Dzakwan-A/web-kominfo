<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Access;

class news extends Model
{

    protected $fillable = [
        'title_B',
        'date_2',
        'deskripsi',
        'slug2'
    ];

    public function ambilberitaL($query)
    {
        return $query->where('date', '>=', now()->toDateString() ) 
                     ->orderBy('date', 'asc'); 
    }

    public function ambilberitaM($query)
    {
        return $query->where('date', '<', now()->toDateString())
                    ->orderBy('date', 'desc');
    }


}

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Announcement;
use App\Models\User;
use App\Models\Event;

class HomeController extends Controller
{

    public function index()
    {
        $slides = Post::latest()->take(5)->get();
        $berita = Post::latest()->skip(5)->take(4)->get();
        $pengumuman = Announcement::latest()->take(3)->get();
        $agenda = Event::upcoming()->take(3)->get();

        return view('home', compact('slides','berita','pengumuman','agenda') );
    }

}

namespace App\Http\Controllers\Admin\NewsController;

use App\Http\Controllers\Controller;
use illuminate\Http\Request;
use illuminate\Support\Str;
use App\Models\Event;
use App\Models\news;

class NewsController extends Controller
{
    public function index2()
    {
        $events = Event::orderBy('date2', 'desc')->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function buat()
    {
        return view('admin.events.index');
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'title_B'         => 'required|string|max:255',
            'date_2'          => 'required|date',
            'deskripsi'       => 'nullable|string',      
        ]); 

        Event::create([
            'title_B'         => $request->title_B,
            'slug2'           => str::slug2($request->title_B),
            'date_2'          => $request->date_2,
            'deskripsi'       => $request->deskripsi,   
        ]);

        return redirect()->route('admin.events.index')
                         ->with('succes', 'Berita berhasil ditambahkan.');
    }

    public function edit(news $news)
    {
        return view('admin.events.edit', compact('news'));
    }

    public function update(Request $request, news $news)
    {
        $request->validate([
            'title_B'       => 'required|string|max:255',
            'date_2'        => 'required|date',
            'deskripsi'     => 'nullable|string',
        ]);

        $news->update([
            'title_B'       => $request->title_B,
            'slug2'         => str::slug2($request->title_B),
            'date_2'        => $request->date_2,
            "deskripsi"     => $request->deskripsi,
        ]);

        return redirect()->route('admin.events.index')
                         ->with('success', 'Berita berhasil diperbarui');
    }

    public function hapus(news $news)
    {
        $news->delete();
        return back()->with('success', 'Berita berhasil dihapus' ); 
    }
}