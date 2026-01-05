<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255','unique:users,email'],
            'role' => ['required','in:admin,penulis'],
            'password' => ['required','string','min:8','confirmed'],
        ]);

        // password akan otomatis di-hash karena casts() di model User: 'password' => 'hashed'
        User::create($validated);

        return redirect()->route('admin.users.index')->with('status', 'User berhasil dibuat.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255','unique:users,email,'.$user->id],
            'role' => ['required','in:admin,penulis'],
            'password' => ['nullable','string','min:8','confirmed'],
        ]);

        // kalau password kosong, jangan overwrite
        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('status', 'User berhasil diupdate.');
    }

    public function destroy(User $user)
    {
        // proteksi: admin tidak bisa hapus dirinya sendiri
        if ($user->id === auth()->id()) {
            return back()->with('status', 'Tidak bisa menghapus akun yang sedang login.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('status', 'User berhasil dihapus.');
    }
}
