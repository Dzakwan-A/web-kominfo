<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Arsip Berita</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-900">
  @include('partials.header')

  <div class="max-w-7xl mx-auto px-4 md:px-6 py-10">
    <div class="flex items-end justify-between mb-8">
      <h1 class="text-3xl font-semibold">Arsip Berita</h1>
      <a href="{{ route('home') }}#berita" class="text-sm text-blue-600 hover:underline">← Kembali</a>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @forelse($posts as $post)
        <a href="{{ route('posts.show', $post) }}"
           class="block bg-white rounded-2xl overflow-hidden border hover:shadow-md transition">
          <div class="h-40 bg-slate-200">
            @if($post->thumbnail)
              <img src="{{ Storage::url($post->thumbnail) }}" class="w-full h-full object-cover" alt="{{ $post->title }}">
            @endif
          </div>
          <div class="p-5">
            <div class="text-xs text-slate-500 mb-1">{{ $post->published_at?->format('d M Y') }}</div>
            <div class="font-semibold hover:text-blue-600">{{ $post->title }}</div>
            <p class="text-sm text-slate-600 mt-1">{{ $post->excerpt }}</p>
          </div>
        </a>
      @empty
        <div class="text-slate-500">Belum ada berita.</div>
      @endforelse
    </div>

    <div class="mt-8">
      {{ $posts->links() }}
    </div>
  </div>
</body>
</html>
