

@php

    $appName = config('app.name', 'Kominfo');

  // Data FAQ (diadaptasi dari halaman pusat bantuan Diskominfo Madiun)
  $faq = [
    [
      'id' => 'tupoksi',
      'title' => 'Tupoksi',
      'q' => 'Apakah tugas dan fungsi Dinas Komunikasi dan Informatika Kota Madiun?',
      'answer_paragraphs' => [
        'Diskominfo Kota Madiun merupakan unsur pelaksana di bidang komunikasi, informatika, persandian, dan statistik sebagai pusat komunikasi dan digitalisasi yang mengelola media informasi serta aplikasi resmi Pemerintah Kota Madiun.',
      ],
      'lists' => [],
    ],
    [
      'id' => 'layanan-publik',
      'title' => 'Layanan Publik',
      'q' => 'Apa saja layanan yang tersedia di Dinas Komunikasi dan Informatika Kota Madiun?',
      'answer_paragraphs' => [
        'Diskominfo Kota Madiun menyediakan beberapa layanan publik, antara lain:',
      ],
      'lists' => [[
        'Pemberian informasi oleh PPID',
        'Pembuatan/Pengembangan aplikasi untuk internal Pemkot Madiun',
        'Pemeliharaan jaringan intranet dan internet',
        'Profit M-Tech',
        'Layanan Call Center 112',
        'Awak Sigap (Anda WA, Kami Siap Segera Tanggap)',
        'Government Chief Information Officer (GCIO)',
        'Layanan Kelas Sahabat',
        'Peliputan kegiatan Pemerintah Kota Madiun',
        'Aspirasi dan solusi di LPPL Radio Suara Madiun',
        'Madiuntoday Ngegas Ekonomi',
        'Rasa Warga (Radio Suara Madiun Menyapa Warga)',
        'Data Statistik Sektoral',
        'Fasilitasi TTE (Tanda Tangan Elektronik)',
      ]],
    ],
    [
      'id' => 'akses-layanan',
      'title' => 'Akses Layanan Publik',
      'q' => 'Bagaimana tata cara mengakses layanan publik yang tersedia pada Diskominfo Kota Madiun?',
      'answer_paragraphs' => [
        'Tata cara mengakses layanan publik mengacu pada Standar Pelayanan Diskominfo Kota Madiun.',
      ],
      'lists' => [],
      'links' => [
        ['label' => 'Buka Standar Pelayanan', 'url' => 'https://kominfo.madiunkota.go.id/profile/standarpelayanan'],
      ],
    ],
    [
      'id' => 'permohonan-informasi',
      'title' => 'Permohonan Informasi Publik',
      'q' => 'Bagaimana cara mengajukan permohonan informasi publik di Diskominfo Kota Madiun?',
      'answer_paragraphs' => [
        'Permohonan informasi publik dapat diajukan melalui PPID. Pemohon dapat datang langsung ke kantor atau mengajukan secara daring melalui kanal berikut:',
      ],
      'lists' => [[
        'PPID (melalui layanan permohonan informasi satu pintu)',
        'SP4N-Lapor!',
      ]],
      'links' => [
        ['label' => 'Awak Sigap (PPID Pemkot Madiun)', 'url' => 'https://awaksigap.madiunkota.go.id/masuk/awaksigap'],
        ['label' => 'SP4N-Lapor!', 'url' => 'https://www.lapor.go.id'],
      ],
    ],
    [
      'id' => 'pengaduan',
      'title' => 'Pengaduan Pelayanan Publik',
      'q' => 'Bagaimana cara menyampaikan pengaduan mengenai layanan publik Diskominfo Kota Madiun?',
      'answer_paragraphs' => [
        'Pengaduan dapat disampaikan dengan datang langsung ke kantor dan/atau secara daring melalui kanal berikut:',
      ],
      'lists' => [[
        'Awak Sigap (terintegrasi) + WhatsApp 08113577800',
        'SP4N-Lapor!',
      ]],
      'links' => [
        ['label' => 'Awak Sigap', 'url' => 'https://awaksigap.madiunkota.go.id/'],
        ['label' => 'SP4N-Lapor!', 'url' => 'https://www.lapor.go.id'],
      ],
    ],
    [
      'id' => 'gawat-darurat',
      'title' => 'Gawat Darurat',
      'q' => 'Apakah Diskominfo menyediakan layanan gawat darurat?',
      'answer_paragraphs' => [
        'Pemerintah Kota Madiun menyediakan layanan kegawatdaruratan yang dapat diakses publik melalui panggilan darurat 112 (bebas pulsa).',
      ],
      'lists' => [],
    ],
    [
      'id' => 'informasi-terkini',
      'title' => 'Informasi Terkini',
      'q' => 'Bagaimana cara mendapatkan informasi terkini mengenai Diskominfo Kota Madiun?',
      'answer_paragraphs' => [
        'Masyarakat dapat mengikuti informasi terkini melalui website, media sosial, dan radio.',
      ],
      'lists' => [[
        'Website resmi Diskominfo Kota Madiun',
        'Instagram Diskominfo Kota Madiun',
        'LPPL Radio Suara Madiun 93 FM / live streaming',
      ]],
      'links' => [
        ['label' => 'Website', 'url' => 'https://kominfo.madiunkota.go.id/'],
        ['label' => 'Instagram', 'url' => 'https://www.instagram.com/diskominfomadiunkota/'],
        ['label' => 'Radio 93FM (Streaming)', 'url' => 'https://93fm.madiunkota.go.id/'],
      ],
    ],
  ];
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pusat Bantuan (FAQ) — {{ $appName }}</title>

  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    .radial-bg{
      background:
        radial-gradient(1100px 600px at 10% -10%, rgba(59,130,246,.16), transparent 60%),
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

  {{-- Header kamu --}}
  @include('partials.header')

  <main class="max-w-7xl mx-auto px-4 md:px-6 py-8">

    {{-- Breadcrumb --}}
    <div class="text-sm text-slate-500 mb-6">
      <a href="{{ route('home') }}" class="hover:text-blue-600">Beranda</a>
      <span class="mx-2">/</span>
      <span class="text-slate-700 font-medium">Pusat Bantuan</span>
    </div>

    {{-- Hero --}}
    <section class="radial-bg rounded-3xl border bg-white p-6 md:p-10 shadow-sm mb-8">
      <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
          <h1 class="text-2xl md:text-3xl font-bold tracking-tight">Pusat Bantuan (FAQ)</h1>
          <p class="text-slate-600 mt-2 max-w-2xl">
            Temukan jawaban singkat seputar layanan, permohonan informasi, pengaduan, dan informasi terkini.
          </p>
        </div>
        <div class="flex items-center gap-2">
          <a href="#konten" class="px-4 py-2 rounded-xl bg-blue-600 text-white text-sm hover:bg-blue-700">
            Lihat FAQ
          </a>
          <a href="{{ route('home') }}#kontak" class="px-4 py-2 rounded-xl border bg-white text-sm hover:bg-slate-50">
            Kontak
          </a>
        </div>
      </div>
    </section>

    <section id="konten" class="grid lg:grid-cols-12 gap-6">

      {{-- Sidebar (menu kiri) --}}
      <aside class="lg:col-span-4">
        <div class="lg:sticky lg:top-24 rounded-3xl border bg-white overflow-hidden">
          <div class="px-5 py-4 border-b">
            <div class="text-sm text-slate-500">Kategori</div>
            <div class="font-semibold">Pusat Bantuan</div>
          </div>

          <nav class="divide-y">
            @foreach($faq as $cat)
              <a href="#{{ $cat['id'] }}"
                 class="faq-link group flex items-center justify-between px-5 py-4 hover:bg-slate-50"
                 data-target="{{ $cat['id'] }}">
                <div class="flex items-center gap-3">
                  <span class="w-1.5 h-10 rounded-full bg-transparent group-[.active]:bg-emerald-500"></span>
                  <span class="font-medium text-slate-700 group-[.active]:text-emerald-600">
                    {{ $cat['title'] }}
                  </span>
                </div>
                <span class="text-slate-300">›</span>
              </a>
            @endforeach
          </nav>
        </div>
      </aside>

      {{-- Konten kanan --}}
      <div class="lg:col-span-8 space-y-6">
        @foreach($faq as $cat)
          <section id="{{ $cat['id'] }}" class="rounded-3xl border bg-white overflow-hidden scroll-mt-24">
            <div class="px-6 py-5 border-b bg-slate-50">
              <h2 class="text-lg font-semibold">{{ $cat['title'] }}</h2>
              <p class="text-sm text-slate-600 mt-1">Klik pertanyaan untuk melihat jawaban.</p>
            </div>

            <div class="p-6">
              <details class="rounded-2xl border bg-white overflow-hidden">
                <summary class="cursor-pointer select-none px-5 py-4 flex items-start justify-between gap-4 hover:bg-slate-50">
                  <div class="font-semibold">{{ $cat['q'] }}</div>
                  <svg class="w-5 h-5 text-slate-400 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd"/>
                  </svg>
                </summary>

                <div class="px-5 pb-5">
                  @if(!empty($cat['answer_paragraphs']))
                    @foreach($cat['answer_paragraphs'] as $p)
                      <p class="text-sm text-slate-700 mt-3 leading-relaxed">{{ $p }}</p>
                    @endforeach
                  @endif

                  @if(!empty($cat['lists']))
                    @foreach($cat['lists'] as $list)
                      <ul class="mt-4 space-y-2 text-sm text-slate-700">
                        @foreach($list as $li)
                          <li class="flex items-start gap-2">
                            <span class="mt-2 h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                            <span>{{ $li }}</span>
                          </li>
                        @endforeach
                      </ul>
                    @endforeach
                  @endif

                  @if(!empty($cat['links']))
                    <div class="mt-5 flex flex-wrap gap-2">
                      @foreach($cat['links'] as $lnk)
                        <a href="{{ $lnk['url'] }}" target="_blank"
                           class="px-4 py-2 rounded-xl border bg-white hover:bg-slate-50 text-sm">
                          {{ $lnk['label'] }}
                        </a>
                      @endforeach
                    </div>
                  @endif
                </div>
              </details>
            </div>
          </section>
        @endforeach
      </div>
    </section>
  </main>

  <script>
    // Aktifkan highlight menu kiri berdasarkan scroll/klik
    (function () {
      const links = Array.from(document.querySelectorAll('.faq-link'));
      const sections = links
        .map(a => document.getElementById(a.dataset.target))
        .filter(Boolean);

      function setActive(id) {
        links.forEach(a => a.classList.toggle('active', a.dataset.target === id));
      }

      // default: dari hash atau item pertama
      const defaultId = @json($faq[0]['id']);
        setActive((location.hash || ('#' + defaultId)).replace('#',''));


      // klik: biar langsung aktif
      links.forEach(a => a.addEventListener('click', () => setActive(a.dataset.target)));

      // scroll spy
      const io = new IntersectionObserver((entries) => {
        const visible = entries
          .filter(e => e.isIntersecting)
          .sort((a,b) => b.intersectionRatio - a.intersectionRatio)[0];
        if (visible?.target?.id) setActive(visible.target.id);
      }, { rootMargin: '-30% 0px -60% 0px', threshold: [0.1, 0.2, 0.4, 0.6] });

      sections.forEach(sec => io.observe(sec));
    })();
  </script>

</body>
</html>
