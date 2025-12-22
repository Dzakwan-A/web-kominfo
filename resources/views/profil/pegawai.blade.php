@php
  $appName = config('app.name', 'Kominfo');

  // Sesuai halaman asli: Data Pegawai ditampilkan sebagai infografis/gambar. :contentReference[oaicite:1]{index=1}
  // Taruh gambar di: public/images/profil/pegawai/
  // Contoh nama file:
  // - public/images/profil/pegawai/data-pegawai-1.jpg
  // - public/images/profil/pegawai/data-pegawai-2.jpg
  //
  // Kalau kamu belum punya gambarnya, sementara pakai placeholder dulu.
  $items = [
    [
      'title' => 'Data Pegawai Diskominfo Kota Madiun',
      'image' => asset('images/profil/pegawai/data-pegawai-2.jpg'),
      'desc'  => 'data pegawai(klik untuk memperbesar).',
    ],
  ];

  // Opsional: tombol unduh (kalau ada file pdf/zip resmi, isi link-nya di sini)
  $downloadUrl = null;
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Data Pegawai — {{ $appName }}</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <style>
    .radial-bg{
      background:
        radial-gradient(1000px 600px at 10% -10%, rgba(59,130,246,.16), transparent 60%),
        radial-gradient(900px 500px at 90% 0%, rgba(16,185,129,.10), transparent 55%),
        linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
    }
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

<body class="bg-slate-50 text-slate-800">
  {{-- kalau kamu sudah punya header --}}
  @include('partials.header')

  <main class="max-w-7xl mx-auto px-4 md:px-6 py-10"
        x-data="{ open:false, img:'', title:'', desc:'' }">

    {{-- Breadcrumb --}}
    <div class="text-sm text-slate-500 mb-6">
      <a href="{{ route('home') }}" class="hover:text-blue-600">Beranda</a>
      <span class="mx-2">/</span>
      <span class="text-slate-700 font-medium">Profil</span>
      <span class="mx-2">/</span>
      <span class="text-slate-700 font-medium">Data Pegawai</span>
    </div>

    {{-- Hero --}}
    <section class="radial-bg rounded-3xl border bg-white p-6 md:p-10 shadow-sm">
      <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
          <h1 class="text-2xl md:text-3xl font-bold tracking-tight">
            Data Pegawai Dinas Komunikasi dan Informatika Kota Madiun
          </h1>
          <p class="text-slate-600 mt-2 max-w-2xl">
            Informasi data pegawai ditampilkan dalam bentuk infografis agar mudah dibaca. Klik gambar untuk memperbesar.
          </p>
        </div>

        <div class="flex items-center gap-2">
          <a href="#galeri"
             class="px-4 py-2 rounded-xl bg-blue-600 text-white text-sm hover:bg-blue-700">
            Lihat Galeri
          </a>

          @if($downloadUrl)
            <a href="{{ $downloadUrl }}" target="_blank"
               class="px-4 py-2 rounded-xl border bg-white text-sm hover:bg-slate-50">
              Unduh Dokumen
            </a>
          @endif
        </div>
      </div>

      <div class="mt-8">
  <div class="rounded-3xl border bg-white/70 p-8 flex items-center justify-center">
    <img
      src="{{ asset('images/standar-pelayanan/hero.png') }}"
      alt="Standar Pelayanan"
      class="w-full max-w-3xl h-auto object-contain"
    >
  </div>
</div>

    </section>

    {{-- Galeri --}}
    <section id="galeri" class="mt-10">
      <div class="flex items-end justify-between mb-4">
        <h2 class="text-xl font-semibold">Galeri Data Pegawai</h2>
        <p class="text-sm text-slate-500">Klik gambar untuk memperbesar.</p>
      </div>

      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($items as $item)
          @php
            $img = $item['image'] ?? '';
            $title = $item['title'] ?? 'Gambar';
            $desc = $item['desc'] ?? '';
          @endphp

          <article class="rounded-3xl border bg-white overflow-hidden hover:shadow-md transition">
            <button type="button" class="w-full text-left"
              @click="open=true; img='{{ $img }}'; title='{{ addslashes($title) }}'; desc='{{ addslashes($desc) }}'">
              <div class="h-44 bg-slate-200">
                <img src="{{ $img }}" alt="{{ $title }}" class="w-full h-full object-cover">
              </div>
            </button>

            <div class="p-5">
              <h3 class="font-semibold">{{ $title }}</h3>
              @if($desc)
                <p class="text-sm text-slate-600 mt-1">{{ $desc }}</p>
              @endif

              <div class="mt-4 flex items-center gap-2">
                <button type="button"
                  class="px-4 py-2 rounded-xl bg-blue-600 text-white text-sm hover:bg-blue-700"
                  @click="open=true; img='{{ $img }}'; title='{{ addslashes($title) }}'; desc='{{ addslashes($desc) }}'">
                  Lihat
                </button>
                <a href="{{ $img }}" target="_blank"
                   class="px-4 py-2 rounded-xl border bg-white hover:bg-slate-50 text-sm">
                  Buka Tab Baru
                </a>
              </div>
            </div>
          </article>
        @empty
          <div class="text-slate-500">Belum ada gambar data pegawai.</div>
        @endforelse
      </div>
    </section>

    {{-- Modal zoom --}}
    <div x-show="open" x-transition
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 p-4"
         @keydown.escape.window="open=false"
         @click.self="open=false"
         style="display:none;">
      <div class="bg-white rounded-2xl max-w-5xl w-full overflow-hidden shadow-xl">
        <div class="flex items-center justify-between px-4 py-3 border-b">
          <div>
            <div class="font-semibold text-sm" x-text="title"></div>
            <div class="text-xs text-slate-500" x-text="desc"></div>
          </div>
          <button class="px-3 py-1 rounded-lg hover:bg-slate-100" @click="open=false">Tutup</button>
        </div>
        <div class="bg-slate-100">
          <img :src="img" alt="" class="w-full max-h-[82vh] object-contain">
        </div>
      </div>
    </div>

  </main>
</body>
</html>
