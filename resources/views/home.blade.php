@php($appName = config('app.name', 'Kominfo'))
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Beranda — {{ $appName }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <style>
    .glass { backdrop-filter: blur(10px); background: rgba(255,255,255,.75); }
    .radial-bg { background: radial-gradient(1200px 600px at 10% -10%, rgba(59,130,246,.2), transparent 60%),
                           radial-gradient(1000px 600px at 90% 0%, rgba(16,185,129,.15), transparent 55%),
                           linear-gradient(180deg, #f9fafb 0%, #f3f4f6 100%); }
    .section-heading { font-size: clamp(1.25rem, 2vw, 1.875rem); font-weight: 600; letter-spacing: -0.01em; }
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

  @include('partials.header')

<body class="antialiased text-slate-800">
 

  <section class="relative radial-bg">
    <div class="absolute inset-0 -z-10">
      <svg class="w-full h-full opacity-30" xmlns="http://www.w3.org/2000/svg">
        <defs>
          <linearGradient id="g1" x1="0" x2="1">
            <stop offset="0%" stop-color="#60a5fa"/>
            <stop offset="100%" stop-color="#34d399"/>
          </linearGradient>
        </defs>
        <rect width="100%" height="100%" fill="url(#g1)"/>
        <circle cx="15%" cy="30%" r="200" fill="white" opacity=".25"/>
        <circle cx="85%" cy="20%" r="160" fill="white" opacity=".15"/>
      </svg>
    </div>
    <div class="max-w-7xl mx-auto px-4 md:px-6 py-16 md:py-24 grid md:grid-cols-2 gap-10">
      <div class="flex flex-col justify-center">
        <div class="inline-flex items-center gap-2 text-xs px-3 py-1 rounded-full bg-white/70 w-max ring-1 ring-slate-200 mb-4">
          <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
          Layanan Informasi & Komunikasi Publik
        </div>
        <h1 class="text-3xl md:text-5xl font-bold leading-tight mb-4">
          Portal Resmi {{ $appName }}
        </h1>
        <p class="text-slate-600 mb-6 md:text-lg">
          Akses berita, layanan, dan informasi digital pemerintahan dalam satu tempat.
        </p>
        <div class="flex flex-wrap gap-3">
          <a href="#berita" class="px-5 py-3 rounded-xl border shadow-sm bg-white hover:bg-slate-50 transition">
            Update Berita
          </a>
        </div>
      </div>
     <div
  x-data="{
    i: 0,
    slides: [
      { src: '{{ asset('images/slider/1.jpg') }}', alt: 'Slide 1' },
      { src: '{{ asset('images/slider/2.jpg') }}', alt: 'Slide 2' },
      { src: '{{ asset('images/slider/3.jpg') }}', alt: 'Slide 3' },
    ],
    next(){ this.i = (this.i + 1) % this.slides.length },
    prev(){ this.i = (this.i - 1 + this.slides.length) % this.slides.length },
    go(n){ this.i = n }
  }"
  x-init="setInterval(() => next(), 5000)"
  class="glass rounded-3xl shadow-xl p-4 md:p-6"
>
  <div class="relative overflow-hidden rounded-2xl bg-slate-200 h-[260px] md:h-[320px]">
    <!-- Slide -->
    <template x-for="(s, idx) in slides" :key="idx">
      <img
        x-show="i === idx"
        x-transition.opacity.duration.300ms
        :src="s.src"
        :alt="s.alt"
        class="absolute inset-0 w-full h-full object-cover"
        style="display:none;"
      >
    </template>

    <!-- Controls -->
    <button type="button"
      @click="prev()"
      class="absolute left-3 top-1/2 -translate-y-1/2 rounded-full bg-white/80 hover:bg-white shadow p-2"
      aria-label="Sebelumnya"
    >
      ‹
    </button>

    <button type="button"
      @click="next()"
      class="absolute right-3 top-1/2 -translate-y-1/2 rounded-full bg-white/80 hover:bg-white shadow p-2"
      aria-label="Berikutnya"
    >
      ›
    </button>

    <!-- Dots -->
    <div class="absolute bottom-3 left-0 right-0 flex justify-center gap-2">
      <template x-for="(s, idx) in slides" :key="'dot'+idx">
        <button type="button"
          @click="go(idx)"
          class="h-2.5 w-2.5 rounded-full"
          :class="i === idx ? 'bg-white' : 'bg-white/50'"
          aria-label="Pilih slide"
        ></button>
      </template>
    </div>
  </div>

  <!-- Caption (opsional) -->
  <div class="mt-4 flex items-center justify-between">
    <div class="text-sm text-slate-600">
      <span class="font-semibold text-slate-800">Galeri</span>
      <span class="mx-2">•</span>
      <span x-text="(i+1) + ' / ' + slides.length"></span>
    </div>

    <a href="#berita" class="text-sm text-blue-600 hover:underline">Lihat Berita</a>
  </div>
</div>

    </div>
  </section>


  <section id="berita" class="py-14 md:py-20 bg-slate-50">
  <div class="max-w-7xl mx-auto px-4 md:px-6">
    <div class="flex items-end justify-between mb-8">
      <h2 class="section-heading">Berita Terkini</h2>
      <a href="{{ route('posts.index') }}#berita" class="text-sm text-blue-600 hover:underline">Arsip Berita</a>
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @forelse(\App\Models\Post::whereNotNull('published_at')->latest('published_at')->limit(6)->get() as $post)
      <article class="bg-white rounded-2xl overflow-hidden border hover:shadow-md transition">
        <div class="h-40 bg-slate-200">
          @if($post->thumbnail)
            <img src="{{ Storage::url($post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
          @endif
        </div>
        <div class="p-5">
          <div class="text-xs text-slate-500 mb-1">{{ optional($post->published_at)->format('d M Y') }}</div>
          <a href="{{ route('posts.show', $post) }}" class="block font-semibold hover:text-blue-600">
          {{ $post->title }}</a>
          <p class="text-sm text-slate-600 line-clamp-2 mt-1">{{ $post->excerpt }}</p>
        </div>
      </article>
      @empty
      <div class="text-slate-500">Belum ada berita dipublikasikan.</div>
      @endforelse
    </div>
  </div>
</section>

  <section id="profil" class="py-14 md:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 md:px-6 grid md:grid-cols-2 gap-10">
      <div>
        <h2 class="section-heading mb-3">Profil Singkat</h2>
        <p class="text-slate-600 mb-4">
          {{ $appName }} berkomitmen menyediakan layanan informasi publik, pengelolaan infrastruktur TIK, serta peningkatan literasi digital masyarakat.
        </p>
        <ul class="space-y-3 text-slate-700">
          <li class="flex items-start gap-3"><span class="mt-1">✅</span> Pelayanan cepat dan transparan.</li>
          <li class="flex items-start gap-3"><span class="mt-1">✅</span> Tata kelola data andal dan aman.</li>
          <li class="flex items-start gap-3"><span class="mt-1">✅</span> Kolaborasi dengan perangkat daerah dan komunitas.</li>
        </ul>
      </div>
      <div class="glass rounded-3xl p-6 border">
        <h3 class="font-semibold mb-4">Statistik Ringkas</h3>
        <div class="grid grid-cols-2 gap-4">
          @foreach([['label'=>'Permohonan Informasi','val'=>'320+'],
                    ['label'=>'Aplikasi Aktif','val'=>'18'],
                    ['label'=>'Menit Respon Rata2','val'=>'<15'],
                    ['label'=>'Hotspot Publik','val'=>'45'] ] as $s)
          <div class="rounded-xl p-4 bg-slate-50 border">
            <p class="text-2xl font-bold">{!! $s['val'] !!}</p>
            <p class="text-xs text-slate-600">{{ $s['label'] }}</p>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>

  <section id="kontak" class="py-14 md:py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 md:px-6 grid md:grid-cols-2 gap-10">
      <div>
        <h2 class="section-heading mb-3">Kontak</h2>
        <p class="text-slate-600">Silakan hubungi kami untuk pertanyaan dan kolaborasi.</p>
        <div class="mt-4 space-y-2 text-sm">
          <div>📍 Alamat: Jl. Contoh No. 123</div>
          <div>☎️ Telepon: (0351) 123-456</div>
          <div>✉️ Email: info@example.go.id</div>
        </div>
      </div>
      <form class="bg-white rounded-2xl p-6 border space-y-3">
        <input class="w-full border rounded-lg px-3 py-2" placeholder="Nama" />
        <input class="w-full border rounded-lg px-3 py-2" placeholder="Email" />
        <textarea class="w-full border rounded-lg px-3 py-2" rows="4" placeholder="Pesan"></textarea>
        <button type="button" class="px-5 py-3 rounded-xl bg-blue-600 text-white">Kirim</button>
      </form>
    </div>
  </section>

  <footer class="border-t bg-white">
    <div class="max-w-7xl mx-auto px-4 md:px-6 py-6 text-sm flex flex-col md:flex-row items-center justify-between">
      <p>© {{ date('Y') }} {{ $appName }}. Semua hak dilindungi.</p>
      <div class="flex items-center gap-4 mt-3 md:mt-0">
        <a href="#" class="hover:text-blue-600">Kebijakan Privasi</a>
        <a href="#" class="hover:text-blue-600">Syarat Layanan</a>
      </div>
    </div>
  </footer>
</body>


</html>
