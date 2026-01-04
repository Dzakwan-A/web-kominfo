<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hasil Pencarian Berita</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <style> 

     /* dropdown helper  */
    .dropdown-panel{
  opacity: 0;
  transform: translateY(6px);
  visibility: hidden;
  transition: .15s ease;
}
    .group:hover .dropdown-panel,
    .group:focus-within .dropdown-panel{
  opacity: 1;
  transform: translateY(0);
  visibility: visible;
}

  </style>
</head>

<body class="bg-slate-50 text-slate-900">
  @include('partials.header')

  <div class="max-w-7xl mx-auto px-4 md:px-6 py-10">
    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-8">
      <div>
        <h1 class="text-3xl font-semibold">Hasil Pencarian</h1>
        @if($q !== '')
          <div class="text-sm text-slate-600 mt-1">Kata kunci: <span class="font-semibold">{{ $q }}</span></div>
        @endif
      </div>

      <div class="flex items-center gap-3">
        <a href="{{ route('posts.index') }}" class="text-sm text-blue-600 hover:underline">← Arsip Berita</a>
        <a href="{{ route('home') }}#berita" class="text-sm text-blue-600 hover:underline">Beranda</a>
      </div>
    </div>

    <form method="GET" action="{{ route('posts.filter') }}" class="mb-8">
      <div class="flex gap-2">
        <input
          type="text"
          name="cari_berita"
          value="{{ $q }}"
          placeholder="Cari berita berdasarkan judul atau tag..."
          class="w-full md:w-[520px] px-4 py-2 rounded-xl border bg-white focus:outline-none focus:ring-2 focus:ring-blue-200"
        />
        <button class="px-4 py-2 rounded-xl bg-blue-600 text-white text-sm">Cari</button>
      </div>
    </form>

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

            @if(!empty($post->tags))
              @php
                $tags = collect(explode(',', $post->tags))
                  ->map(fn ($t) => trim($t))
                  ->filter();
              @endphp
              @if($tags->isNotEmpty())
                <div class="mt-3 flex flex-wrap gap-2">
                  @foreach($tags->take(6) as $tag)
                    <span class="text-xs px-2 py-1 rounded-full border bg-slate-50 text-slate-700">{{ $tag }}</span>
                  @endforeach
                </div>
              @endif
            @endif
          </div>
        </a>
      @empty
        <div class="text-slate-500">Tidak ada berita yang cocok.</div>
      @endforelse
    </div>

    <div class="mt-8">
      {{ $posts->links() }}
    </div>
  </div>
</body>
</html>
