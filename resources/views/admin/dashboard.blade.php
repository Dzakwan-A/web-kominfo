@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">Dashboard Admin</h1>
    <a href="{{ route('admin.posts.create') }}" class="px-4 py-2 rounded-lg bg-blue-600 text-white">+ Buat Berita</a>
  </div>

  @if(session('status') || session('success'))
  <div class="mb-4 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3">
    {{ session('status') ?? session('success') }}
  </div>
@endif


  <div class="bg-white rounded-xl shadow-sm border">
    <div class="p-4 border-b">
      <h2 class="font-semibold">Berita Terbaru</h2>
    </div>
    <div class="divide-y">
      @forelse($posts as $post)
      <div class="p-4 flex items-center justify-between">
        <div>
          <div class="font-medium">{{ $post->title }}</div>
          <div class="text-sm text-slate-500">
            {{ $post->published_at ? 'Publikasi: '.$post->published_at->format('d M Y H:i') : 'Draft' }}
            · Dibuat: {{ $post->created_at->format('d M Y H:i') }}
          </div>
        </div>
        <div class="text-sm text-slate-500 text-right flex flex-col items-end gap-2">
  <div>
    Oleh: {{ optional($post->user)->name ?? '—' }}
  </div>

  <div class="flex items-center gap-2">
    <a
      href="{{ route('admin.posts.edit', $post) }}"
      class="px-3 py-1 rounded-md border border-slate-300 text-slate-700 hover:bg-slate-50"
    >
      Edit
    </a>

    <form
      action="{{ route('admin.posts.destroy', $post) }}"
      method="POST"
      onsubmit="return confirm('Yakin mau hapus berita ini?')"
    >
      @csrf
      @method('DELETE')

      <button
        type="submit"
        class="px-3 py-1 rounded-md border border-red-300 text-red-600 hover:bg-red-50"
      >
        Hapus
      </button>
    </form>
  </div>
</div>

      </div>
      @empty
      <div class="p-6 text-slate-500">Belum ada berita.</div>
      @endforelse
    </div>
    <div class="px-4 py-3">
      {{ $posts->links() }}
    </div>
  </div>
</div>
@endsection
