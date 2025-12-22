@php($appName = config('app.name', 'Kominfo'))
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Struktur Organisasi — {{ $appName }}</title>
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

  {{-- Header global kamu --}}
  @include('partials.header')

  {{-- HERO --}}
  <section class="radial-bg border-b">
    <div class="max-w-7xl mx-auto px-4 md:px-6 py-10 md:py-12">
      <nav class="text-xs text-slate-500 mb-3">
        <a href="{{ route('home') }}" class="hover:text-blue-600">Beranda</a>
        <span class="mx-2">/</span>
        <span class="text-slate-700">Profil</span>
        <span class="mx-2">/</span>
        <span class="text-slate-900 font-medium">Struktur Organisasi</span>
      </nav>

      <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6">
        <div>
          <h1 class="text-3xl md:text-4xl font-bold tracking-tight">
            Struktur Organisasi Dinas Komunikasi dan Informatika Kota Madiun
          </h1>
          <p class="text-slate-600 mt-2 max-w-2xl">
            Bagan dan susunan unit kerja untuk mendukung layanan informasi publik, TIK, statistik, dan persandian.
          </p>
        </div>

        <div class="flex gap-3">
          <a href="{{ route('profil.tentang') }}"
             class="px-4 py-2 rounded-xl border bg-white text-sm hover:bg-slate-50 transition">
            Tentang
          </a>
          <a href="{{ route('profil.visi') }}"
             class="px-4 py-2 rounded-xl bg-blue-600 text-white text-sm shadow hover:-translate-y-0.5 transition">
            Visi & Misi
          </a>
        </div>
      </div>

      {{-- highlight --}}
      <div class="mt-8 grid md:grid-cols-3 gap-4">
        <div class="glass rounded-2xl border p-5">
          <div class="text-xs text-slate-500">Pilar</div>
          <div class="font-semibold mt-1">Informasi & Komunikasi Publik</div>
        </div>
        <div class="glass rounded-2xl border p-5">
          <div class="text-xs text-slate-500">Pilar</div>
          <div class="font-semibold mt-1">Teknologi Informasi & Komunikasi</div>
        </div>
        <div class="glass rounded-2xl border p-5">
          <div class="text-xs text-slate-500">Pilar</div>
          <div class="font-semibold mt-1">Statistik & Persandian</div>
        </div>
      </div>
    </div>
  </section>

  <main class="max-w-7xl mx-auto px-4 md:px-6 py-10 md:py-12">
    <div class="grid lg:grid-cols-12 gap-8">

      {{-- BAGAN / PREVIEW --}}
      <section class="lg:col-span-8 space-y-6">
        <div class="bg-white rounded-3xl border shadow-sm overflow-hidden">
          <div class="p-6 md:p-8 flex items-center justify-between gap-4">
            <div>
              <h2 class="text-xl md:text-2xl font-semibold">Bagan Struktur Organisasi</h2>
              <p class="text-sm text-slate-600 mt-1">
                Klik gambar untuk membuka ukuran penuh.
              </p>
            </div>

            <a href="{{ asset('images/struktur-organisasi.png') }}"
               target="_blank"
               class="px-4 py-2 rounded-xl border text-sm bg-white hover:bg-slate-50">
              Buka Bagan
            </a>
          </div>

          {{-- ✅ taruh file bagan di: public/images/struktur-organisasi.png --}}
          <div class="bg-slate-50 border-t p-4 md:p-6">
            <div class="rounded-2xl border bg-white overflow-hidden">
              <img
                src="{{ asset('images/struktur-organisasi.png') }}"
                alt="Bagan Struktur Organisasi"
                class="w-full h-auto"
                onerror="this.closest('div').innerHTML =
                  '<div class=&quot;p-6 text-slate-600 text-sm&quot;>Bagan belum diunggah. Simpan file bagan di <b>public/images/struktur-organisasi.png</b>.</div>';"
              />
            </div>
          </div>
        </div>

        {{-- SUSUNAN ORGANISASI --}}
        <div class="bg-white rounded-3xl border shadow-sm p-6 md:p-8">
          <div class="flex items-center justify-between gap-3">
            <h2 class="text-xl md:text-2xl font-semibold">Susunan Organisasi</h2>
            <span class="text-xs px-3 py-1 rounded-full bg-slate-50 border text-slate-700">
              Ringkasan Unit
            </span>
          </div>


          <div class="mt-6 grid sm:grid-cols-2 gap-4">
            @php($units = [
              ['title'=>'Kepala Dinas', 'desc'=>'Unsur pimpinan.'],
              ['title'=>'Sekretariat', 'desc'=>'Unsur pembantu pimpinan.'],
              ['title'=>'Bidang Pengelolaan Informasi dan Komunikasi Publik', 'desc'=>'Unsur pelaksana.'],
              ['title'=>'Bidang Pengelolaan Teknologi Informasi dan Komunikasi', 'desc'=>'Unsur pelaksana.'],
              ['title'=>'Bidang Pengelolaan Statistik dan Persandian', 'desc'=>'Unsur pelaksana.'],
              ['title'=>'UPTD', 'desc'=>'Unit pelaksana teknis daerah.'],
              ['title'=>'Kelompok Jabatan Fungsional', 'desc'=>'Kelompok jabatan sesuai fungsi.'],
            ])
            @foreach($units as $u)
              <div class="rounded-2xl border bg-slate-50 p-4">
                <div class="font-semibold">{{ $u['title'] }}</div>
                <div class="text-sm text-slate-600 mt-1">{{ $u['desc'] }}</div>
              </div>
            @endforeach
          </div>

        </div>

        {{-- CTA --}}
        <div class="rounded-3xl border bg-white p-6 md:p-8">
          <h3 class="text-lg font-semibold">Butuh detail tugas tiap unit?</h3>
          <p class="text-sm text-slate-600 mt-1">
            Lihat halaman Tupoksi untuk rincian tugas dan fungsi masing-masing bagian/bidang.
          </p>
          <div class="mt-4 flex flex-wrap gap-3">
            <a href="{{ route('profil.tupoksi') }}"
               class="px-4 py-2 rounded-xl bg-blue-600 text-white text-sm shadow hover:-translate-y-0.5 transition">
              Lihat Tupoksi
            </a>
            <a href="{{ route('profil.pegawai') }}"
               class="px-4 py-2 rounded-xl border bg-white text-sm hover:bg-slate-50 transition">
              Data Pegawai
            </a>
          </div>
        </div>
      </section>

      {{-- SIDEBAR --}}
      <aside class="lg:col-span-4 space-y-6">
        <div class="bg-white rounded-3xl border shadow-sm p-6">
          <h3 class="font-semibold">Akses Cepat</h3>
          <div class="mt-4 grid grid-cols-2 gap-3 text-sm">
            <a href="{{ route('profil.tentang') }}" class="rounded-xl border bg-white px-3 py-2 text-center hover:bg-slate-50">Tentang</a>
            <a href="{{ route('profil.visi') }}" class="rounded-xl border bg-white px-3 py-2 text-center hover:bg-slate-50">Visi & Misi</a>
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
