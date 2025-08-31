<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Access;

class Homepage extends Model
{


    protected $fillable = [
        'title_h',
        'deskripsi',
        'slug9'
    ];

    public function Home1($query)
    {
        return $query-> where('deskripsi', '>=', now()->toDateString()  )
                     -> OrderBy('date', 'asc');  
    }
    public function Home2($query)
    {
        return $query-> where('deskripsi', '<', now()->toDateString() )
                     -> OrderBy('date', 'desc');
    }
}

namespace App\Http\Controllers;

use app\Models\Post;
use app\Models\Gallery;
use app\Models\news;
use app\models\Event;

class HomeController extends Controller
{
    public function index()
    {
        $berita = Post::latest()->skip(5)->take(4)->get();
        $agenda = Event::upcoming()->take(3)->get();

        return view('home', compact('berita', 'agenda') ); 
    }
}

namespace App\Http\Controllers\Admin\HomepageController;

use App\Http\Controllers\Controller;
use illuminate\Http\Request;
use app\models\Event;
use App\Models\Homepage;
use app\models\news;
use illuminate\Support\Str;

class HomepageController extends Controller
{

    public function buatHome() 
    {
        return view('admin.events.index');
    }

    public function simpan2(Request $request)
    {
        $request->validate([
            'title_h'       => 'required|string|max:255',
            'deskripsi'     => 'nullable|string',
        ]);

        Event::create([
            'title_h'       => $request->$title_h,
            'slug9'         => str::slug9($request->title_h),
            'deskripsi'     => $request->$deskripsi
        ]);

        return redirect()->route('admin.Home.index')
                        ->with('success', 'homepage diperbarui');
    }

    public function hapus(Homepage $homepage)
    {
        $homepage->delete();
        return back()->with ('success', 'homepage berhasil dihapus');
    }

}