@php($appName = config('app.name', 'Kominfo'))
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Standar Pelayanan — {{ $appName }}</title>

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
  @include('partials.header') 

  <main class="max-w-7xl mx-auto px-4 md:px-6 py-10" x-data="{ open:false, img:'', title:'' }">

    {{-- Breadcrumb --}}
    <div class="text-sm text-slate-500 mb-6">
      <a href="{{ route('home') }}" class="hover:text-blue-600">Beranda</a>
      <span class="mx-2">/</span>
      <span class="text-slate-700 font-medium">Profil</span>
      <span class="mx-2">/</span>
      <span class="text-slate-700 font-medium">Standar Pelayanan</span>
    </div>

    {{-- Hero --}}
    <section class="radial-bg rounded-3xl border bg-white p-6 md:p-10 shadow-sm">
      <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
          <h1 class="text-2xl md:text-3xl font-bold tracking-tight">Standar Pelayanan</h1>
          <p class="text-slate-600 mt-2 max-w-2xl">
            Informasi standar pelayanan sebagai komitmen kualitas layanan yang transparan, terukur, dan mudah diakses.
          </p>
        </div>

        <div class="flex items-center gap-2">
          <a href="#daftar" class="px-4 py-2 rounded-xl bg-blue-600 text-white text-sm hover:bg-blue-700">
            Lihat Daftar
          </a>
          <a href="{{ route('home') }}#kontak" class="px-4 py-2 rounded-xl border bg-white text-sm hover:bg-slate-50">
            Kontak
          </a>
        </div>
      </div>

      <div class="grid md:grid-cols-3 gap-4 mt-8">
        <div class="rounded-2xl border bg-white/70 p-4">
          <div class="text-xs text-slate-500">Tujuan</div>
          <div class="font-semibold mt-1">Kepastian & kualitas layanan</div>
          <div class="text-sm text-slate-600 mt-1">Standar waktu, biaya, prosedur, dan output.</div>
        </div>
        <div class="rounded-2xl border bg-white/70 p-4">
          <div class="text-xs text-slate-500">Format</div>
          <div class="font-semibold mt-1">Poster/Gambar + Dokumen</div>
          <div class="text-sm text-slate-600 mt-1">Mudah dibaca, bisa diunduh.</div>
        </div>
        <div class="rounded-2xl border bg-white/70 p-4">
          <div class="text-xs text-slate-500">Akses</div>
          <div class="font-semibold mt-1">Publik</div>
          <div class="text-sm text-slate-600 mt-1">Terbuka untuk masyarakat.</div>
        </div>
      </div>
    </section>

    {{-- Daftar --}}
    <section id="daftar" class="mt-10">
      <div class="flex items-end justify-between mb-4">
        <h2 class="text-xl font-semibold">Daftar Standar Pelayanan</h2>
        <p class="text-sm text-slate-500">Klik gambar untuk memperbesar.</p>
      </div>

      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($items as $item)
          <article class="rounded-3xl border bg-white overflow-hidden hover:shadow-md transition">
            <button type="button"
              class="w-full text-left"
              @click="open=true; img='{{ $item['image'] }}'">
              <div class="h-44 bg-slate-200">
                <img src="{{ $item['image'] }}" alt="" class="w-full h-full object-cover">
              </div>
            </button>

            <div class="p-5">

              <div class="mt-4 flex items-center gap-2">
                <a href="https://kominfo.madiunkota.go.id/file/eyJpdiI6IlNGUDdXZ1FpRDMvK2Y0WS9TclVSNmc9PSIsInZhbHVlIjoiNmpiL3VKRkErSXJmL1ZFR1A3cmR0UGJzdy9XUmsvZ0xoamV3OWNObnROUzVnakxsbUpzaHdabVM5MDR1VC9iMEhaS3QvS2QvTXZ0RXdQZFZ0bkcxcGlaeHcrbGs0Y3ZMY1IvaE52ZldZblE9IiwibWFjIjoiNzQ2MGEwOWFjYzNlN2Q1YmY5ZmU5MThjMGQzZTNhM2U4OTM2MTdiMWQ5YjZiOGRmNDE1MDU1MTM1ZmM3NmJmMSIsInRhZyI6IiJ9" target="_blank"
                  class="px-4 py-2 rounded-xl border bg-white hover:bg-slate-50 text-sm">
                  Unduh Dokumen
                </a>
                <button type="button"
                  class="px-4 py-2 rounded-xl bg-blue-600 text-white text-sm hover:bg-blue-700"
                  @click="open=true; img='{{ $item['image'] }}'">
                  Lihat
                </button>
              </div>
            </div>
          </article>
        @empty
          <div class="text-slate-500">Belum ada data standar pelayanan.</div>
        @endforelse
      </div>
    </section>

    {{-- Modal zoom gambar --}}
    <div x-show="open" x-transition
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 p-4"
         @keydown.escape.window="open=false"
         @click.self="open=false"
         style="display:none;">
      <div class="bg-white rounded-2xl max-w-4xl w-full overflow-hidden shadow-xl">
        <div class="flex items-center justify-between px-4 py-3 border-b">
          <div class="font-semibold text-sm" x-text="title"></div>
          <button class="px-3 py-1 rounded-lg hover:bg-slate-100" @click="open=false">Tutup</button>
        </div>
        <div class="bg-slate-100">
          <img :src="img" alt="" class="w-full max-h-[80vh] object-contain">
        </div>
      </div>
    </div>

  </main>
</body>
</html>
