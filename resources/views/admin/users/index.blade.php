@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">Manajemen User</h1>
    <a href="{{ route('admin.users.create') }}"
       class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
      + Buat User
    </a>
  </div>

  @if(session('status'))
    <div class="mb-4 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3">
      {{ session('status') }}
    </div>
  @endif

  <div class="bg-white border rounded-xl overflow-hidden">
    <table class="w-full text-sm">
      <thead class="bg-gray-50">
        <tr class="text-left">
          <th class="p-3">Nama</th>
          <th class="p-3">Email</th>
          <th class="p-3">Role</th>
          <th class="p-3 text-right">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $u)
          <tr class="border-t">
            <td class="p-3">{{ $u->name }}</td>
            <td class="p-3">{{ $u->email }}</td>
            <td class="p-3">
              <span class="px-2 py-1 rounded-full border">
                {{ $u->role }}
              </span>
            </td>
            <td class="p-3">
              <div class="flex justify-end gap-2">
                <a href="{{ route('admin.users.edit', $u) }}"
                   class="px-3 py-1 rounded-md border hover:bg-gray-50">
                  Edit
                </a>

                <form method="POST" action="{{ route('admin.users.destroy', $u) }}"
                      onsubmit="return confirm('Yakin hapus user ini?')">
                  @csrf
                  @method('DELETE')
                  <button class="px-3 py-1 rounded-md border border-red-300 text-red-600 hover:bg-red-50">
                    Hapus
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="mt-4">
    {{ $users->links() }}
  </div>
</div>
@endsection
