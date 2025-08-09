<?php

// app/Models/Event.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'date',
        'description',
    ];

    protected $casts = [
        'date' => 'date:Y-m-d',
    ];

    /** Scopes untuk mengambil event mendatang */
    public function scopeUpcoming($query)
    {
        return $query->where('date', '>=', now()->toDateString())
                     ->orderBy('date', 'asc');
    }

    /** Scopes untuk mengambil event lampau */
    public function scopePast($query)
    {
        return $query->where('date', '<', now()->toDateString())
                     ->orderBy('date', 'desc');
    }

    /** Accessor untuk memastikan date selalu jadi Carbon */
    protected function date(): Attribute
    {
        return Attribute::get(fn($value) => Carbon::parse($value));
    }
}


// app/Http/Controllers/HomeController.php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Event;
use App\Models\Announcement;
use App\Models\Gallery;

class HomeController extends Controller
{
    public function index()
    {
        $slides     = Post::latest()->take(5)->get();
        $berita     = Post::latest()->skip(5)->take(4)->get();
        $agenda     = Event::upcoming()->take(3)->get();
        $pengumuman = Announcement::latest()->take(3)->get();
        $galeri     = Gallery::latest()->take(6)->get();

        return view('home', compact('slides','berita','agenda','pengumuman','galeri'));
    }
}


// app/Http/Controllers/Admin/EventController.php
namespace App\Http\Controllers\Admin\EventController;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('date', 'desc')->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'date'        => 'required|date',
            'description' => 'nullable|string',
        ]);

        Event::create([
            'title'       => $request->title,
            'slug'        => Str::slug($request->title),
            'date'        => $request->date,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.events.index')
                         ->with('success', 'Event berhasil ditambahkan.');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'date'        => 'required|date',
            'description' => 'nullable|string',
        ]);

        $event->update([
            'title'       => $request->title,
            'slug'        => Str::slug($request->title),
            'date'        => $request->date,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.events.index')
                         ->with('success', 'Event berhasil diperbarui.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return back()->with('success', 'Event berhasil dihapus.');
    }
}


// routes/web.php (tambahkan untuk event admin)
use App\Http\Controllers\Admin\EventController;

Route::middleware(['auth'])
     ->prefix('admin')
     ->name('admin.')
     ->group(function () {
         Route::resource('events', EventController::class);
     });
