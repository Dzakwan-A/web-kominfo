@php($appName = config('app.name', 'Kominfo'))
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Visi & Misi — {{ $appName }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .radial-bg{
      background:
        radial-gradient(1000px 600px at 10% -10%, rgba(59,130,246,.18), transparent 60%),
        radial-gradient(900px 500px at 90% 0%, rgba(16,185,129,.12), transparent 55%),
        linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
    }
    .glass{ backdrop-filter: blur(10px); background: rgba(255,255,255,.78); }
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

<body class="antialiased text-slate-800 bg-slate-50">

  {{-- ✅ pakai header global kamu --}}
  @include('partials.header')

  {{-- HERO --}}
  <section class="radial-bg border-b">
    <div class="max-w-7xl mx-auto px-4 md:px-6 py-10 md:py-12">
      <nav class="text-xs text-slate-500 mb-3">
        <a href="{{ route('home') }}" class="hover:text-blue-600">Beranda</a>
        <span class="mx-2">/</span>
        <span class="text-slate-700">Profil</span>
        <span class="mx-2">/</span>
        <span class="text-slate-900 font-medium">Visi & Misi</span>
      </nav>

      <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6">
        <div>
          <h1 class="text-3xl md:text-4xl font-bold tracking-tight">
            Visi & Misi Dinas Komunikasi dan Informatika Kota Madiun
          </h1>
          <p class="text-slate-600 mt-2 max-w-2xl">
            Arah, tujuan, dan komitmen layanan publik dalam pengelolaan informasi, TIK, statistik, dan persandian.
          </p>
        </div>

        <div class="flex gap-3">
          <a href="{{ route('profil.tentang') }}"
             class="px-4 py-2 rounded-xl border bg-white text-sm hover:bg-slate-50 transition">
            Tentang
          </a>
          <a href="{{ route('profil.struktur') }}"
             class="px-4 py-2 rounded-xl bg-blue-600 text-white text-sm shadow hover:-translate-y-0.5 transition">
            Struktur Organisasi
          </a>
        </div>
      </div>

      {{-- Banner kecil --}}
      <div class="mt-8 grid md:grid-cols-3 gap-4">
        <div class="glass rounded-2xl border p-5">
          <div class="text-xs text-slate-500">Fokus</div>
          <div class="font-semibold mt-1">Informasi & Komunikasi Publik</div>
        </div>
        <div class="glass rounded-2xl border p-5">
          <div class="text-xs text-slate-500">Fokus</div>
          <div class="font-semibold mt-1">Teknologi Informasi & Jaringan</div>
        </div>
        <div class="glass rounded-2xl border p-5">
          <div class="text-xs text-slate-500">Fokus</div>
          <div class="font-semibold mt-1">Statistik & Persandian</div>
        </div>
      </div>
    </div>
  </section>

  {{-- CONTENT --}}
  <main class="max-w-7xl mx-auto px-4 md:px-6 py-10 md:py-12">
    <div class="grid lg:grid-cols-12 gap-8">

      {{-- MAIN --}}
      <section class="lg:col-span-8 space-y-6">

        {{-- VISI --}}
        <div class="bg-white rounded-3xl border shadow-sm p-6 md:p-8">
          <div class="flex items-center justify-between gap-3">
            <h2 class="text-xl md:text-2xl font-semibold">Visi</h2>
            <span class="text-xs px-3 py-1 rounded-full bg-blue-50 text-blue-700 border border-blue-100">
              Arah Utama
            </span>
          </div>

          <div class="mt-4 rounded-2xl p-5 bg-gradient-to-br from-blue-50 to-white border">
            <p class="text-lg md:text-xl font-semibold leading-relaxed">
              Terwujudnya Pemerintahan Bersih Berwibawa Menuju masyarakat Sejahtera
            </p>
          </div>
        </div>

        {{-- MISI --}}
        <div class="bg-white rounded-3xl border shadow-sm p-6 md:p-8">
          <div class="flex items-center justify-between gap-3">
            <h2 class="text-xl md:text-2xl font-semibold">Misi</h2>
            <span class="text-xs px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-100">
              5 Poin
            </span>
          </div>

          <ol class="mt-5 space-y-3">
            @php($misi = [
              'Meningkatkan Kualitas Hidup Masyarakat Kota Madiun',
              'Mewujudkan Pemerintahan yang Baik (Good Governance) Melalui Peningkatan Kualitas Pelayanan Kepada Masyarakat',
              'Meningkatkan Pembangunan Berbasis Pada Partisipasi Masyarakat Kota Madiun Dalam Perencanaan, Pelaksanaan dan Pengawasan Pembangunan',
              'Mewujudkan Kemandirian Ekonomi dan Meratakan Tingkat Kesejahteraan Masyarakat Kota Madiun',
              'Mewujudkan Keterbukaan Informasi Publik Sebagai Kontrol Kinerja dan Akuntabilitas Terhadap Pemerintah',
            ])
            @foreach($misi as $i => $item)
              <li class="flex gap-4 rounded-2xl border bg-slate-50 p-4">
                <div class="flex-none h-9 w-9 rounded-xl bg-slate-900 text-white flex items-center justify-center font-semibold">
                  {{ $i+1 }}
                </div>
                <div class="text-slate-800 leading-relaxed">
                  {{ $item }}
                </div>
              </li>
            @endforeach
          </ol>

        </div>

        {{-- CTA --}}
        <div class="rounded-3xl border bg-white p-6 md:p-8">
          <h3 class="text-lg font-semibold">Selanjutnya</h3>
          <p class="text-sm text-slate-600 mt-1">
            Lanjut melihat struktur organisasi atau tupoksi untuk detail peran unit kerja.
          </p>
          <div class="mt-4 flex flex-wrap gap-3">
            <a href="{{ route('profil.struktur') }}"
               class="px-4 py-2 rounded-xl bg-blue-600 text-white text-sm shadow hover:-translate-y-0.5 transition">
              Struktur Organisasi
            </a>
            <a href="{{ route('profil.tupoksi') }}"
               class="px-4 py-2 rounded-xl border bg-white text-sm hover:bg-slate-50 transition">
              Tupoksi
            </a>
          </div>
        </div>

      </section>

      {{-- SIDEBAR --}}
      <aside class="lg:col-span-4 space-y-6">
        <div class="bg-white rounded-3xl border shadow-sm p-6">
          <h3 class="font-semibold">Ringkasan</h3>
          <div class="mt-4 space-y-3 text-sm text-slate-700">
            <div class="flex items-start gap-3">
              <div class="mt-0.5">🎯</div>
              <div>
                <div class="font-medium">Tujuan</div>
                <div class="text-slate-600">Mendorong layanan publik yang transparan, efektif, dan akuntabel.</div>
              </div>
            </div>
            <div class="flex items-start gap-3">
              <div class="mt-0.5">🔎</div>
              <div>
                <div class="font-medium">Prinsip</div>
                <div class="text-slate-600">Keterbukaan informasi, pelayanan berkualitas, partisipatif.</div>
              </div>
            </div>
          </div>
        </div>

        <div class="glass rounded-3xl border p-6">
          <h3 class="font-semibold">Akses Cepat</h3>
          <div class="mt-4 grid grid-cols-2 gap-3 text-sm">
            <a href="{{ route('profil.tentang') }}" class="rounded-xl border bg-white px-3 py-2 text-center hover:bg-slate-50">Tentang</a>
            <a href="{{ route('profil.struktur') }}" class="rounded-xl border bg-white px-3 py-2 text-center hover:bg-slate-50">Struktur</a>
            <a href="{{ route('profil.tupoksi') }}" class="rounded-xl border bg-white px-3 py-2 text-center hover:bg-slate-50">Tupoksi</a>
            <a href="{{ route('profil.standar') }}" class="rounded-xl border bg-white px-3 py-2 text-center hover:bg-slate-50">Standar</a>
          </div>
        </div>
      </aside>

    </div>
  </main>

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
