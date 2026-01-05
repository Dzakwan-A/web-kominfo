@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
  <h1 class="text-2xl font-semibold mb-6">Edit User</h1>

  <form method="POST" action="{{ route('admin.users.update', $user) }}"
        class="bg-white border rounded-xl p-6 space-y-4">
    @csrf
    @method('PUT')

    <div>
      <label class="block text-sm font-medium">Nama</label>
      <input name="name" value="{{ old('name', $user->name) }}" class="mt-1 w-full rounded-lg border px-3 py-2" required>
      @error('name') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
    </div>

    <div>
      <label class="block text-sm font-medium">Email</label>
      <input type="email" name="email" value="{{ old('email', $user->email) }}" class="mt-1 w-full rounded-lg border px-3 py-2" required>
      @error('email') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
    </div>

    <div>
      <label class="block text-sm font-medium">Role</label>
      <select name="role" class="mt-1 w-full rounded-lg border px-3 py-2" required>
        <option value="admin" {{ old('role', $user->role)==='admin' ? 'selected' : '' }}>admin</option>
        <option value="penulis" {{ old('role', $user->role)==='penulis' ? 'selected' : '' }}>penulis</option>
      </select>
      @error('role') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
    </div>

    <div>
      <label class="block text-sm font-medium">Password baru (opsional)</label>
      <input type="password" name="password" class="mt-1 w-full rounded-lg border px-3 py-2">
      @error('password') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
      <p class="text-xs text-slate-500 mt-1">Kosongkan jika tidak ingin mengubah password.</p>
    </div>

    <div>
      <label class="block text-sm font-medium">Konfirmasi Password baru</label>
      <input type="password" name="password_confirmation" class="mt-1 w-full rounded-lg border px-3 py-2">
    </div>

    <div class="flex gap-2 pt-2">
      <button class="px-4 py-2 rounded-lg bg-blue-600 text-white">Update</button>
      <a href="{{ route('admin.users.index') }}" class="px-4 py-2 rounded-lg border">Batal</a>
    </div>
  </form>
</div>
@endsection
