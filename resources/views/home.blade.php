@php($appName = config('app.name', 'Kominfo'))
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Beranda — {{ $appName }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .glass { backdrop-filter: blur(10px); background: rgba(255,255,255,.75); }
    .radial-bg { background: radial-gradient(1200px 600px at 10% -10%, rgba(59,130,246,.2), transparent 60%),
                           radial-gradient(1000px 600px at 90% 0%, rgba(16,185,129,.15), transparent 55%),
                           linear-gradient(180deg, #f9fafb 0%, #f3f4f6 100%); }
    .section-heading { font-size: clamp(1.25rem, 2vw, 1.875rem); font-weight: 600; letter-spacing: -0.01em; }
  </style>
</head>
<body class="antialiased text-slate-800">
  <header class="sticky top-0 z-50 bg-white/80 backdrop-blur border-b">
    <div class="max-w-7xl mx-auto px-4 md:px-6 py-3 flex items-center justify-between">
      <a href="{{ route('home') }}" class="flex items-center gap-3">
        <span class="inline-flex h-9 w-9 rounded-xl bg-blue-600 text-white items-center justify-center shadow">K</span>
        <span class="font-semibold">{{ $appName }}</span>
      </a>
      <nav class="hidden md:flex items-center gap-6 text-sm">
        <a href="#layanan" class="hover:text-blue-600">Layanan</a>
        <a href="#berita" class="hover:text-blue-600">Berita</a>
        <a href="#profil" class="hover:text-blue-600">Profil</a>
        <a href="#kontak" class="hover:text-blue-600">Kontak</a>
      </nav>
      <div class="flex items-center gap-2">
        @auth
          <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-lg bg-blue-600 text-white text-sm">Dashboard</a>
          <form method="POST" action="{{ route('logout') }}">@csrf
            <button class="px-3 py-2 rounded-lg border text-sm">Keluar</button>
          </form>
        @else
          <a href="{{ route('login') }}" class="px-3 py-2 rounded-lg border text-sm">Masuk</a>
        @endauth
      </div>
    </div>
  </header>

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
          <a href="#layanan" class="px-5 py-3 rounded-xl bg-blue-600 text-white shadow hover:-translate-y-0.5 transition">
            Lihat Layanan
          </a>
          <a href="#berita" class="px-5 py-3 rounded-xl border shadow-sm bg-white hover:bg-slate-50 transition">
            Update Berita
          </a>
        </div>
      </div>
      <div class="glass rounded-3xl shadow-xl p-6 md:p-8">
        <div class="grid grid-cols-2 gap-4">
          <div class="rounded-2xl p-5 bg-gradient-to-br from-blue-50 to-blue-100">
            <p class="text-4xl font-bold">24/7</p>
            <p class="text-sm text-slate-600">Layanan Aduan</p>
          </div>
          <div class="rounded-2xl p-5 bg-gradient-to-br from-emerald-50 to-emerald-100">
            <p class="text-4xl font-bold">99%</p>
            <p class="text-sm text-slate-600">Uptime Jaringan</p>
          </div>
          <div class="rounded-2xl p-5 bg-gradient-to-br from-purple-50 to-purple-100">
            <p class="text-4xl font-bold">15+</p>
            <p class="text-sm text-slate-600">Layanan Digital</p>
          </div>
          <div class="rounded-2xl p-5 bg-gradient-to-br from-amber-50 to-amber-100">
            <p class="text-4xl font-bold">∞</p>
            <p class="text-sm text-slate-600">Akses Informasi</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="layanan" class="py-14 md:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 md:px-6">
      <div class="flex items-end justify-between mb-8">
        <h2 class="section-heading">Layanan Utama</h2>
        <a href="#" class="text-sm text-blue-600 hover:underline">Semua layanan</a>
      </div>
      <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
        @foreach([
          ['icon'=>'📢','title'=>'PPID','desc'=>'Permohonan informasi publik dan dokumentasi.'],
          ['icon'=>'🛰️','title'=>'Infrastruktur TIK','desc'=>'Layanan jaringan & pusat data.'],
          ['icon'=>'🧭','title'=>'Aplikasi Publik','desc'=>'Katalog aplikasi layanan warga.'],
          ['icon'=>'🛡️','title'=>'Keamanan Siber','desc'=>'Monitoring & respons insiden.'],
        ] as $item)
        <div class="group rounded-2xl border bg-white hover:shadow-md transition p-5">
          <div class="text-3xl mb-3">{{ $item['icon'] }}</div>
          <h3 class="font-semibold mb-1">{{ $item['title'] }}</h3>
          <p class="text-sm text-slate-600">{{ $item['desc'] }}</p>
          <a href="#" class="mt-4 inline-flex items-center gap-2 text-sm text-blue-600">Selengkapnya
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="m9 5 7 7-7 7"/></svg>
          </a>
        </div>
        @endforeach
      </div>
    </div>
  </section>

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
          @if($post->thumbnail)
            <img src="{{ Storage::url($post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
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
