{{-- Ganti section 'BERITA' di home.blade.php dengan ini --}}
<section id="berita" class="py-14 md:py-20 bg-slate-50">
  <div class="max-w-7xl mx-auto px-4 md:px-6">
    <div class="flex items-end justify-between mb-8">
      <h2 class="section-heading">Berita Terkini</h2>
      <a href="{{ route('home') }}#berita" class="text-sm text-blue-600 hover:underline">Arsip Berita</a>
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @forelse(\App\Models\Post::whereNotNull('published_at')->latest('published_at')->limit(6)->get() as $post)
      <article class="bg-white rounded-2xl overflow-hidden border hover:shadow-md transition">
        <div class="h-40 bg-slate-200">
          @if($post->thumbnail_path)
            <img src="{{ Storage::url($post->thumbnail_path) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
          @endif
        </div>
        <div class="p-5">
          <div class="text-xs text-slate-500 mb-1">{{ optional($post->published_at)->format('d M Y') }}</div>
          <a href="#" class="block font-semibold hover:text-blue-600">{{ $post->title }}</a>
          <p class="text-sm text-slate-600 line-clamp-2 mt-1">{{ $post->excerpt }}</p>
        </div>
      </article>
      @empty
      <div class="text-slate-500">Belum ada berita dipublikasikan.</div>
      @endforelse
    </div>
  </div>
</section>
