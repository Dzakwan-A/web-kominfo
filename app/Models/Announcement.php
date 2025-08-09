<?php

namespace App\Models;

use illuminate\Database\Eloquent\Model;
use illuminate\Database\Eloquent\HasCollection;

class Announcement extends Model
{

    protected $fillable = [
        'title3',
        'slug3',
        'date3',
        'deskripsi2'
    ];

}
namespace App\Http\Controllers\Admin\AnnounceController;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AnnounceController extends Controller
{

    public function index3()
    {
        $announce = Announcement::orderBy('date3', 'desc')->paginate(10);
        return view('admin.announce.index', compact('announce'));
    }

    public function buat2()
    {
        return view('admin.announce.create');
    }

    public function simpan2(Request $request) 
    {
        $request->validate([
            'title3'        => 'required|string|max:255',
            'date3'         => 'required|date',
            'deskripsi2'     => 'nullable|string',
        ]);
    }
}