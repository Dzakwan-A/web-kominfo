@extends('layouts.app')

@section('title', 'Dashboard Penulis')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">Dashboard Penulis</h1>
    <a href="{{ route('writer.posts.create') }}" class="px-4 py-2 rounded-lg bg-blue-600 text-white">+ Tulis Berita</a>
  </div>

  @if(session('status'))
  <div class="mb-4 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3">
    {{ session('status') }}
  </div>
  @endif

  <div class="bg-white rounded-xl shadow-sm border">
    <div class="p-4 border-b">
      <h2 class="font-semibold">Berita Saya</h2>
    </div>

    <div class="divide-y">
  @forelse($posts as $post)
    <div class="p-4 flex items-start justify-between gap-4">
      <div>
        <div class="font-medium">{{ $post->title }}</div>
        <div class="text-sm text-slate-500">
          {{ $post->published_at ? 'Publish: '.$post->published_at->format('d M Y H:i') : 'Draft' }}
          · Dibuat: {{ $post->created_at->format('d M Y H:i') }}
        </div>
      </div>

      <div class="flex items-center gap-2">
  <a href="{{ route('writer.posts.edit', $post) }}"
     class="px-3 py-1.5 rounded-lg border text-sm hover:bg-slate-50">
    Edit
  </a>

  <form action="{{ route('writer.posts.destroy', $post) }}" method="POST"
        onsubmit="return confirm('Yakin ingin menghapus berita ini?');">
    @csrf
    @method('DELETE')
    <button type="submit"
            class="px-3 py-1.5 rounded-lg border text-sm hover:bg-slate-50 text-red-600">
      Hapus
    </button>
  </form>
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
