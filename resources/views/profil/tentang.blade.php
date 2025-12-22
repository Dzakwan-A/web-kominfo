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

<body class="antialiased text-slate-800 bg-slate-50">
  

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

        </div>
      </div>

      {{-- Cover Image --}}
      <div class="mt-8 rounded-3xl overflow-hidden border bg-white shadow-sm">
        <div class="h-56 md:h-72 bg-slate-200">
          {{-- Ganti src ini dengan foto  (public/images/kantor.jpg) --}}
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
