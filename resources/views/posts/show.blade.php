<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $post->title }}</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-slate-900">
  <article class="max-w-3xl mx-auto px-4 md:px-6 py-10">
    <a href="{{ route('posts.index') }}" class="text-sm text-blue-600 hover:underline">← Arsip Berita</a>

    <h1 class="text-3xl md:text-4xl font-bold mt-4">{{ $post->title }}</h1>
    <div class="text-sm text-slate-500 mt-2">
      {{ $post->published_at?->format('d M Y H:i') }}
    </div>

    @if($post->thumbnail)
      <div class="mt-6 rounded-2xl overflow-hidden border bg-slate-100">
        <img src="{{ Storage::url($post->thumbnail) }}" class="w-full object-cover" alt="{{ $post->title }}">
      </div>
    @endif

    @if($post->excerpt)
      <p class="mt-6 text-slate-700">{{ $post->excerpt }}</p>
    @endif

    <div class="prose max-w-none mt-6">
      {!! nl2br(e($post->body)) !!}
    </div>
  </article>
</body>
</html>
