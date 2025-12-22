

@php

    $appName = config('app.name', 'Kominfo');

  // Sumber dokumen (PDF) dari situs Kominfo Madiun (boleh kamu ganti jadi asset lokal)
  $pdfUrl = 'https://kominfo.madiunkota.go.id/file/eyJpdiI6InpRWVlHaThTVkcwdnduYkZtcGxYTkE9PSIsInZhbHVlIjoiTlRENWdRRGZQMUpJcGNsSzZuWEIvdFkzVjlaS0EyS25qRGVFZXFLZEN4VlJnS1BsdnE2dW5JN0xkaE56UzI3VW9jaitSbFh1WkZFUUJtbWxROHVxY1E9PSIsIm1hYyI6ImJjOTkwOWRkN2RmZWRiZWY4NTkxNmE2YTJmZGRmZDAzYWI3ZTc3OGRiMGYxYmIzNTRiYjA1MzRmYTIxOWViNzMiLCJ0YWciOiIifQ%3D%3D';

  $susunan = [
    'Unsur Pimpinan: Kepala Dinas',
    'Unsur Pembantu: Sekretariat',
    'Unsur Pelaksana: Bidang Pengelolaan Informasi dan Komunikasi Publik',
    'Unsur Pelaksana: Bidang Pengelolaan Teknologi Informasi dan Komunikasi',
    'Unsur Pelaksana: Bidang Pengelolaan Statistik dan Persandian',
    'UPTD',
    'Kelompok Jabatan Fungsional',
  ];

  $sections = [
    [
      'title' => 'Kepala Dinas',
      'meta'  => 'Pasal 4',
      'desc'  => 'Memimpin, mengoordinasikan, dan mengawasi pelaksanaan kebijakan, evaluasi, serta bimbingan teknis.',
      'items' => [
        'Penyusunan rumusan kebijakan teknis bidang komunikasi dan informatika, statistik, dan persandian',
        'Penyelenggaraan urusan pemerintahan dan pelayanan umum bidang komunikasi dan informatika, statistik, dan persandian',
        'Pembinaan dan pelaksanaan tugas bidang komunikasi dan informatika, statistik, dan persandian',
        'Pemantauan, evaluasi, dan pelaporan',
        'Tugas kedinasan lain dari Walikota sesuai bidangnya',
      ],
    ],
    [
      'title' => 'Sekretariat',
      'meta'  => 'Pasal 5–6',
      'desc'  => 'Pelayanan administrasi untuk seluruh unsur dinas (perencanaan, umum/rumah tangga, kepegawaian, keuangan).',
      'items' => [
        'Perumusan kebijakan teknis & penyusunan perencanaan program kerja',
        'Koordinasi program kegiatan & pelayanan administratif terpadu',
        'Administrasi umum, rumah tangga, dan perlengkapan',
        'Kehumasan, keprotokolan, dan kearsipan',
        'Administrasi & pembinaan kepegawaian',
        'Administrasi keuangan & pembayaran gaji',
      ],
    ],
    [
      'title' => 'Sub Bagian Umum dan Keuangan',
      'meta'  => 'Pasal 7',
      'desc'  => 'Urusan surat-menyurat, kearsipan, rumah tangga, protokoler, inventaris, sampai penatausahaan keuangan.',
      'items' => [
        'Perencanaan program & evaluasi tugas subbag',
        'Surat-menyurat dan tata kearsipan',
        'Rumah tangga dan keamanan kantor',
        'Kehumasan, protokoler, upacara, dan rapat dinas',
        'Pengadaan/penyimpanan/distribusi/administrasi/perawatan inventaris',
        'Penatausahaan & pertanggungjawaban keuangan',
        'Administrasi & pembayaran gaji',
      ],
    ],
    [
      'title' => 'Sub Bagian Perencanaan dan Kepegawaian',
      'meta'  => 'Pasal 7 (ayat 2)',
      'desc'  => 'Koordinasi dokumen perencanaan/penganggaran serta administrasi kepegawaian.',
      'items' => [
        'Perencanaan program kerja & evaluasi tugas subbag',
        'Penyusunan perencanaan program, evaluasi, dan pelaporan dinas',
        'Koordinasi penyusunan dokumen perencanaan & penganggaran (pendapatan, belanja, pembiayaan)',
        'Pengelolaan & pemeliharaan data administrasi kepegawaian',
      ],
    ],
    [
      'title' => 'Bidang Pengelolaan Informasi dan Komunikasi Publik',
      'meta'  => 'Pasal 8',
      'desc'  => 'Kebijakan, NSPK, bimtek, supervisi, serta monitoring/evaluasi/pelaporan di bidang PIKP.',
      'items' => [
        'Monitoring opini dan aspirasi publik',
        'Monitoring informasi & penetapan agenda prioritas komunikasi pemerintah daerah',
        'Pengelolaan konten & perencanaan media komunikasi publik',
        'Pengelolaan media komunikasi publik',
        'Pelayanan informasi publik',
        'Layanan hubungan media',
        'Kemitraan pemangku kepentingan',
        'Manajemen komunikasi krisis',
        'Penguatan kapasitas SDM komunikasi publik',
      ],
    ],
    [
      'title' => 'Bidang Pengelolaan Teknologi Informasi dan Komunikasi',
      'meta'  => 'Pasal 9',
      'desc'  => 'Pengelolaan SPBE: rencana induk, domain, pusat data, jaringan, aplikasi, smart city, hingga GCIO.',
      'items' => [
        'Pengelolaan rencana induk & anggaran pemerintahan berbasis elektronik',
        'Pengelolaan nama domain',
        'Pengelolaan pusat data',
        'Pengelolaan sistem jaringan & komunikasi intra pemda',
        'Pengelolaan data/informasi elektronik',
        'Pengelolaan aplikasi & proses bisnis SPBE',
        'Pengelolaan sistem penghubung layanan pemerintah',
        'Pengelolaan ekosistem kota cerdas',
        'Pengelolaan sumber daya TIK pemda',
        'Pengelolaan Government Chief Information Officer (GCIO)',
      ],
    ],
    [
      'title' => 'Bidang Pengelolaan Statistik dan Persandian',
      'meta'  => 'Pasal 10–12',
      'desc'  => 'Penetapan/operasional program statistik dan persandian serta evaluasi/pelaporan.',
      'items' => [
        'Perencanaan program pengumpulan data, pengolahan data, dan diseminasi statistik & persandian',
        'Administrasi bidang statistik & persandian',
        'Pengelolaan program/kegiatan serta evaluasi dan pelaporan',
      ],
      'children' => [
        [
          'title' => 'Seksi Pengelolaan Data dan Statistik',
          'meta'  => 'Pasal 12 (ayat 1)',
          'items' => [
            'Koordinasi, monitoring, evaluasi, dan pelaporan pengelolaan data & statistik',
            'Penyediaan bahan analisa serta diseminasi data & statistik',
          ],
        ],
        [
          'title' => 'Seksi Pengelolaan Keamanan Informasi dan Persandian',
          'meta'  => 'Pasal 12 (ayat 2)',
          'items' => [
            'Pengukuran tingkat kerawanan & keamanan informasi',
            'Pengelolaan informasi berklasifikasi (elektronik & non-elektronik)',
            'Pengelolaan Security Operation Center (SOC) untuk pengamanan informasi & komunikasi',
            'Operasionalisasi jaring komunikasi sandi pemerintah daerah',
            'Pengadaan/pemeliharaan perangkat persandian & jaring komunikasi sandi',
          ],
        ],
      ],
    ],
    [
      'title' => 'UPTD',
      'meta'  => 'Pasal 13–15',
      'desc'  => 'Unsur pelaksana tugas teknis (teknis operasional/penunjang tertentu).',
      'items' => [
        'Kepala UPTD: kegiatan teknis operasional/penunjang tertentu',
        'Sub Bagian Tata Usaha: surat-menyurat, kearsipan, rumah tangga, inventaris, keuangan, dan pelaporan',
      ],
    ],
    [
      'title' => 'Kelompok Jabatan Fungsional',
      'meta'  => 'Pasal 16–17',
      'desc'  => 'Melakukan kegiatan sesuai bidang tenaga fungsional masing-masing.',
      'items' => [
        'Pelaksanaan kegiatan sesuai ketentuan peraturan perundang-undangan',
      ],
    ],
  ];

@endphp

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tupoksi — {{ $appName }}</title>
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

<body class="bg-slate-50 text-slate-800">
  {{-- Pakai header kamu sendiri --}}
  @include('partials.header') 

  <main class="max-w-7xl mx-auto px-4 md:px-6 py-10">
    {{-- Breadcrumb --}}
    <div class="text-sm text-slate-500 mb-6">
      <a href="{{ route('home') }}" class="hover:text-blue-600">Beranda</a>
      <span class="mx-2">/</span>
      <span class="text-slate-700 font-medium">Profil</span>
      <span class="mx-2">/</span>
      <span class="text-slate-700 font-medium">Tupoksi</span>
    </div>

    {{-- Header page --}}
    <section class="rounded-3xl border bg-white p-6 md:p-10 shadow-sm">
      <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
          <h1 class="text-2xl md:text-3xl font-bold tracking-tight">Tugas Pokok & Fungsi (Tupoksi)</h1>
          <p class="text-slate-600 mt-2 max-w-2xl">
            Ringkasan kedudukan, susunan organisasi, serta rincian tugas dan fungsi pada Dinas Komunikasi dan Informatika.
          </p>
        </div>
        <div class="flex items-center gap-3">
  <a href="https://kominfo.madiunkota.go.id/file/eyJpdiI6InpRWVlHaThTVkcwdnduYkZtcGxYTkE9PSIsInZhbHVlIjoiTlRENWdRRGZQMUpJcGNsSzZuWEIvdFkzVjlaS0EyS25qRGVFZXFLZEN4VlJnS1BsdnE2dW5JN0xkaE56UzI3VW9jaitSbFh1WkZFUUJtbWxROHVxY1E9PSIsIm1hYyI6ImJjOTkwOWRkN2RmZWRiZWY4NTkxNmE2YTJmZGRmZDAzYWI3ZTc3OGRiMGYxYmIzNTRiYjA1MzRmYTIxOWViNzMiLCJ0YWciOiIifQ%3D%3D"
     target="_blank"
     class="px-4 py-2 rounded-xl border bg-white hover:bg-slate-50 text-sm">
    Unduh Dokumen
  </a>

  <a href="#rincian" class="px-4 py-2 rounded-xl bg-blue-600 text-white text-sm hover:bg-blue-700">
    Lihat Rincian
  </a>
</div>

      </div>

      <div class="grid md:grid-cols-3 gap-4 mt-8">
        <div class="rounded-2xl border bg-slate-50 p-4">
          <div class="text-xs text-slate-500">Kedudukan</div>
          <div class="font-semibold mt-1">Di bawah Walikota</div>
          <div class="text-sm text-slate-600 mt-1">Melalui Sekretaris Daerah.</div>
        </div>
        <div class="rounded-2xl border bg-slate-50 p-4">
          <div class="text-xs text-slate-500">Dokumen Acuan</div>
          <div class="font-semibold mt-1">Peraturan Walikota</div>
          <div class="text-sm text-slate-600 mt-1">Kedudukan, Susunan Organisasi, Rincian Tugas & Fungsi.</div>
        </div>
        <div class="rounded-2xl border bg-slate-50 p-4">
          <div class="text-xs text-slate-500">Cakupan</div>
          <div class="font-semibold mt-1">Pasal 3–17</div>
          <div class="text-sm text-slate-600 mt-1">Struktur + rincian tugas per unsur.</div>
        </div>
      </div>
    </section>

    {{-- Susunan organisasi --}}
    <section class="mt-10">
      <h2 class="text-xl font-semibold mb-4">Susunan Organisasi</h2>
      <div class="rounded-3xl border bg-white p-6">
        <ul class="grid sm:grid-cols-2 gap-3 text-sm">
          @foreach($susunan as $s)
            <li class="flex items-start gap-2">
              <span class="mt-0.5 text-blue-600">•</span>
              <span>{{ $s }}</span>
            </li>
          @endforeach
        </ul>
      </div>
    </section>

    {{-- Rincian --}}
    <section id="rincian" class="mt-10">
      <h2 class="text-xl font-semibold mb-4">Rincian Tugas & Fungsi</h2>

      <div class="space-y-4">
        @foreach($sections as $sec)
          <details class="rounded-3xl border bg-white overflow-hidden">
            <summary class="cursor-pointer select-none px-6 py-5 flex items-start justify-between gap-4 hover:bg-slate-50">
              <div>
                <div class="flex items-center gap-2">
                  <h3 class="font-semibold">{{ $sec['title'] }}</h3>
                  <span class="text-xs px-2 py-1 rounded-full bg-slate-100 text-slate-600">{{ $sec['meta'] }}</span>
                </div>
                @if(!empty($sec['desc']))
                  <p class="text-sm text-slate-600 mt-1">{{ $sec['desc'] }}</p>
                @endif
              </div>
              <svg class="w-5 h-5 text-slate-400 mt-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd"/>
              </svg>
            </summary>

            <div class="px-6 pb-6">
              <ul class="mt-3 space-y-2 text-sm text-slate-700">
                @foreach($sec['items'] as $it)
                  <li class="flex items-start gap-2">
                    <span class="mt-1 h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                    <span>{{ $it }}</span>
                  </li>
                @endforeach
              </ul>

              @if(!empty($sec['children']))
                <div class="mt-6 grid md:grid-cols-2 gap-4">
                  @foreach($sec['children'] as $child)
                    <div class="rounded-2xl border bg-slate-50 p-4">
                      <div class="flex items-center gap-2">
                        <div class="font-semibold text-sm">{{ $child['title'] }}</div>
                        <span class="text-xs px-2 py-1 rounded-full bg-white border text-slate-600">{{ $child['meta'] }}</span>
                      </div>
                      <ul class="mt-3 space-y-2 text-sm text-slate-700">
                        @foreach($child['items'] as $cit)
                          <li class="flex items-start gap-2">
                            <span class="mt-1 h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                            <span>{{ $cit }}</span>
                          </li>
                        @endforeach
                      </ul>
                    </div>
                  @endforeach
                </div>
              @endif
            </div>
          </details>
        @endforeach
      </div>

    </section>
  </main>

  {{-- Footer kamu --}}
  {{-- @include('partials.footer') --}}
</body>
</html>
