@php($appName = config('app.name', 'Kominfo'))
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tentang — {{ $appName }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .radial-bg {
      background:
        radial-gradient(1000px 600px at 10% -10%, rgba(59,130,246,.18), transparent 60%),
        radial-gradient(900px 500px at 90% 0%, rgba(16,185,129,.12), transparent 55%),
        linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
    }
    .glass { backdrop-filter: blur(10px); background: rgba(255,255,255,.78); }
  </style>
</head>

<body class="antialiased text-slate-800 bg-slate-50">
  {{-- Header (konsisten dengan home) --}}
  <header class="sticky top-0 z-50 bg-white/80 backdrop-blur border-b">
    <div class="max-w-7xl mx-auto px-4 md:px-6 py-3 flex items-center justify-between">
      <a href="{{ route('home') }}" class="flex items-center gap-3">
        <span class="inline-flex h-9 w-9 rounded-xl bg-blue-600 text-white items-center justify-center shadow">K</span>
        <span class="font-semibold">{{ $appName }}</span>
      </a>

      <nav class="hidden md:flex items-center gap-6 text-sm">
        <a href="{{ route('home') }}#layanan" class="hover:text-blue-600">Layanan</a>
        <a href="{{ route('posts.index') }}" class="hover:text-blue-600">Berita</a>

        {{-- Dropdown Profil (tanpa JS, hover) --}}
        <div class="relative group">
          <button type="button" class="inline-flex items-center gap-1 hover:text-blue-600">
            Profil
            <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd"/>
            </svg>
          </button>

          <div class="absolute left-0 top-full pt-2 opacity-0 translate-y-1 invisible
                      group-hover:opacity-100 group-hover:translate-y-0 group-hover:visible
                      transition duration-150 ease-out">
            <div class="w-80 rounded-xl border bg-white shadow-lg overflow-hidden">
              <a class="block px-4 py-3 hover:bg-slate-50 font-medium text-slate-700"
                 href="{{ route('profil.tentang') }}">Tentang</a>
              <a class="block px-4 py-3 hover:bg-slate-50 text-slate-700"
                 href="{{ route('profil.visi') }}">Visi Misi</a>
              <a class="block px-4 py-3 hover:bg-slate-50 text-slate-700"
                 href="{{ route('profil.struktur') }}">Struktur Organisasi</a>
              <a class="block px-4 py-3 hover:bg-slate-50 text-slate-700"
                 href="{{ route('profil.tupoksi') }}">Tupoksi Diskominfo Kota Madiun</a>
              <a class="block px-4 py-3 hover:bg-slate-50 text-slate-700"
                 href="{{ route('profil.standar') }}">Standar Pelayanan</a>
              <a class="block px-4 py-3 hover:bg-slate-50 text-slate-700"
                 href="{{ route('profil.pegawai') }}">Data Pegawai</a>
              <a class="block px-4 py-3 hover:bg-slate-50 text-slate-700"
                 href="{{ route('profil.lhkpn') }}">LHKPN Pejabat Publik</a>
            </div>
          </div>
        </div>

        <a href="{{ route('home') }}#kontak" class="hover:text-blue-600">Kontak</a>
      </nav>

      <div class="flex items-center gap-2">
        @auth
          <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-lg bg-blue-600 text-white text-sm">Dashboard</a>
          <form method="POST" action="{{ route('logout') }}">@csrf
            <button class="px-3 py-2 rounded-lg border text-sm bg-white hover:bg-slate-50">Keluar</button>
          </form>
        @else
          <a href="{{ route('login') }}" class="px-3 py-2 rounded-lg border text-sm bg-white hover:bg-slate-50">Masuk</a>
        @endauth
      </div>
    </div>
  </header>

  {{-- Hero --}}
  <section class="radial-bg border-b">
    <div class="max-w-7xl mx-auto px-4 md:px-6 py-10 md:py-12">
      <div class="flex flex-col gap-3">
        <nav class="text-xs text-slate-500">
          <a href="{{ route('home') }}" class="hover:text-blue-600">Beranda</a>
          <span class="mx-2">/</span>
          <span class="text-slate-700">Profil</span>
          <span class="mx-2">/</span>
          <span class="text-slate-700 font-medium">Tentang</span>
        </nav>

        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6">
          <div>
            <h1 class="text-3xl md:text-4xl font-bold tracking-tight">Sekilas Dinas Komunikasi dan Informatika</h1>
            <p class="text-slate-600 mt-2 max-w-2xl">
              Informasi singkat mengenai peran, sejarah, dan layanan Diskominfo dalam bidang komunikasi,
              informatika, persandian, dan statistik.
            </p>
          </div>

          <div class="flex gap-3">
            <a href="{{ route('profil.visi') }}"
               class="px-4 py-2 rounded-xl bg-blue-600 text-white text-sm shadow hover:-translate-y-0.5 transition">
              Lihat Visi & Misi
            </a>
            <a href="{{ route('profil.struktur') }}"
               class="px-4 py-2 rounded-xl border bg-white text-sm hover:bg-slate-50 transition">
              Struktur Organisasi
            </a>
          </div>
        </div>
      </div>

      {{-- Cover Image --}}
      <div class="mt-8 rounded-3xl overflow-hidden border bg-white shadow-sm">
        <div class="h-56 md:h-72 bg-slate-200">
          {{-- Ganti src ini dengan foto kantor kamu (public/images/kantor.jpg) --}}
          <img src="{{ asset('images/kantor-kominfo.jpg') }}"
               onerror="this.style.display='none'"
               alt="Kantor Diskominfo"
               class="w-full h-full object-cover">
        </div>
      </div>
    </div>
  </section>

  {{-- Content --}}
  <main class="max-w-7xl mx-auto px-4 md:px-6 py-10 md:py-12">
    <div class="grid lg:grid-cols-12 gap-8">
      {{-- Main article --}}
      <article class="lg:col-span-8">
        <div class="bg-white rounded-3xl border shadow-sm p-6 md:p-8">
          <div class="flex items-center gap-2 text-xs text-slate-500">
            <span class="inline-flex items-center gap-2">
              <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
              Diperbarui
            </span>
            <span>•</span>
            <span>{{ now()->format('d M Y') }}</span>
          </div>

          <h2 class="text-xl md:text-2xl font-semibold mt-3">Gambaran Umum</h2>
          <p class="mt-3 text-slate-700 leading-relaxed">
            Dinas Komunikasi dan Informatika Kota Madiun merupakan unsur pelaksana otonomi daerah pada bidang
            komunikasi, informatika, persandian, dan statistik. Perannya mencakup pengelolaan informasi publik,
            penguatan infrastruktur TIK, hingga dukungan tata kelola data yang aman dan andal.
          </p>

          <div class="mt-6 grid sm:grid-cols-2 gap-4">
            <div class="rounded-2xl border bg-slate-50 p-5">
              <div class="text-sm font-semibold">Fokus Layanan</div>
              <ul class="mt-3 text-sm text-slate-700 space-y-2">
                <li>✅ Informasi & komunikasi publik</li>
                <li>✅ Teknologi informasi & jaringan</li>
                <li>✅ Statistik sektoral & persandian</li>
              </ul>
            </div>
            <div class="rounded-2xl border bg-slate-50 p-5">
              <div class="text-sm font-semibold">Tiga Bidang Utama</div>
              <ul class="mt-3 text-sm text-slate-700 space-y-2">
                <li>• Pengelolaan Informasi dan Komunikasi Publik</li>
                <li>• Pengelolaan Teknologi Informasi dan Komunikasi</li>
                <li>• Pengelolaan Statistik dan Persandian</li>
              </ul>
            </div>
          </div>

          <h3 class="text-lg md:text-xl font-semibold mt-8">Sejarah Singkat</h3>
          <div class="mt-4 space-y-4 text-slate-700 leading-relaxed">
            <p>
              Sebelumnya, urusan komunikasi dan informatika berada di Dishubkominfo. Seiring perubahan
              organisasi perangkat daerah, pada awal 2017 urusan tersebut berpisah menjadi dua dinas:
              Dinas Perhubungan dan Dinas Komunikasi dan Informatika.
            </p>
            <p>
              Diskominfo kemudian menempati beberapa lokasi hingga akhirnya menempati kantor di
              Jalan Perintis Kemerdekaan No. 32 (mulai ditempati sejak 25 Juli 2019).
            </p>
            <p>
              Penjabaran tugas pokok dan fungsi berpedoman pada Peraturan Wali Kota Madiun Nomor 72 Tahun 2021
              tentang kedudukan, susunan organisasi, tugas, fungsi, dan tata kerja dinas.
            </p>
          </div>

          {{-- Lampiran --}}
          <div class="mt-8 rounded-2xl border bg-white p-5">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
              <div>
                <div class="font-semibold">Lampiran</div>
                <div class="text-sm text-slate-600">Dokumen pendukung (PDF/berkas) terkait profil dinas.</div>
              </div>
              <a href="#"
                 class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-slate-900 text-white text-sm hover:bg-slate-800">
                Download File
              </a>
            </div>
          </div>
        </div>
      </article>

      {{-- Sidebar --}}
      <aside class="lg:col-span-4 space-y-6">
        <div class="bg-white rounded-3xl border shadow-sm p-6">
          <h3 class="font-semibold">Kantor Diskominfo</h3>
          <div class="mt-4 space-y-3 text-sm text-slate-700">
            <div class="flex gap-3">
              <div class="mt-0.5">📍</div>
              <div>
                <div class="font-medium">Alamat</div>
                <div class="text-slate-600">
                  Jl. Perintis Kemerdekaan No. 32, Kel. Kartoharjo, Kec. Kartoharjo, Kota Madiun, Jawa Timur
                </div>
              </div>
            </div>

            <div class="flex gap-3">
              <div class="mt-0.5">🕒</div>
              <div>
                <div class="font-medium">Jam Pelayanan</div>
                <div class="text-slate-600">Senin–Kamis: 07.00–15.30 WIB</div>
                <div class="text-slate-600">Jumat: 06.30–14.30 WIB</div>
              </div>
            </div>
          </div>

          <div class="mt-6 grid grid-cols-2 gap-3">
            <a href="{{ route('profil.tupoksi') }}" class="rounded-xl border px-3 py-2 text-center text-sm hover:bg-slate-50">
              Tupoksi
            </a>
            <a href="{{ route('profil.standar') }}" class="rounded-xl border px-3 py-2 text-center text-sm hover:bg-slate-50">
              Standar
            </a>
          </div>
        </div>

        <div class="glass rounded-3xl border p-6">
          <h3 class="font-semibold">Butuh Layanan?</h3>
          <p class="mt-2 text-sm text-slate-600">
            Akses layanan informasi publik, kanal pengaduan, dan publikasi resmi.
          </p>
          <div class="mt-4 flex flex-col gap-2">
            <a href="{{ route('posts.index') }}" class="px-4 py-2 rounded-xl bg-blue-600 text-white text-sm text-center">
              Lihat Berita & Publikasi
            </a>
            <a href="{{ route('home') }}#kontak" class="px-4 py-2 rounded-xl border bg-white text-sm text-center hover:bg-slate-50">
              Hubungi Kami
            </a>
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
