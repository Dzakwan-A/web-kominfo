<header class="sticky top-0 z-50 bg-white border-b">
  <div class="max-w-7xl mx-auto px-4 md:px-6 h-16 flex items-center justify-between">

    {{-- Logo + Nama --}}
    <a href="{{ route('home') }}" class="flex items-center gap-3">
      <img src="{{ asset('images/logo-kominfo.png') }}"
           alt="Diskominfo Kota Madiun"
           class="h-9 w-9 rounded-full object-cover border" />
      <span class="font-semibold text-slate-900">Diskominfo Kota Madiun</span>
    </a>

    {{-- Menu --}}
    <nav class="hidden md:flex items-center gap-7 text-sm text-slate-700">
      <a href="{{ route('home') }}" class="hover:text-blue-600">Beranda</a>
      <a href="{{ route('posts.index') }}" class="hover:text-blue-600">Berita</a>

      {{-- ✅ Dropdown Profil --}}
      <div class="relative group">
  <button
    type="button"
    class="inline-flex items-center gap-1 hover:text-blue-600"
  >
    Profil
    <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
      <path
        fill-rule="evenodd"
        clip-rule="evenodd"
        d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z"
      />
    </svg>
  </button>

  <div
    class="dropdown-panel absolute left-0 top-full mt-2 w-80 rounded-xl border
           bg-white shadow-lg overflow-hidden z-50"
  >
    <a
      href="{{ route('profile.show', 'tentang') }}"
      class="flex items-center justify-between px-4 py-3 hover:bg-slate-50"
    >
      Tentang
      <span class="text-slate-400">›</span>
    </a>

    <a
      href="{{ route('profile.show', 'visi-misi') }}"
      class="flex items-center justify-between px-4 py-3 hover:bg-slate-50"
    >
      Visi Misi
      <span class="text-slate-400">›</span>
    </a>

    <a
      href="{{ route('profile.show', 'struktur-organisasi') }}"
      class="flex items-center justify-between px-4 py-3 hover:bg-slate-50"
    >
      Struktur Organisasi
      <span class="text-slate-400">›</span>
    </a>

    <a
      href="{{ route('profile.show', 'tupoksi') }}"
      class="flex items-center justify-between px-4 py-3 hover:bg-slate-50"
    >
      Tupoksi Diskominfo Kota Madiun
      <span class="text-slate-400">›</span>
    </a>

    <a
      href="{{ route('profile.show', 'standar-pelayanan') }}"
      class="flex items-center justify-between px-4 py-3 hover:bg-slate-50"
    >
      Standar Pelayanan
      <span class="text-slate-400">›</span>
    </a>

    <a
      href="{{ route('profile.show', 'data-pegawai') }}"
      class="flex items-center justify-between px-4 py-3 hover:bg-slate-50"
    >
      Data Pegawai
      <span class="text-slate-400">›</span>
    </a>

    <a
      href="{{ route('profile.show', 'lhkpn') }}"
      class="flex items-center justify-between px-4 py-3 hover:bg-slate-50"
    >
      LHKPN Pejabat Publik Pemerintah Kota Madiun
      <span class="text-slate-400">›</span>
    </a>
  </div>
</div>



      <a href="{{ route('faq') }}" class="hover:text-blue-600">FAQ</a>

      {{-- Searchbar berita (judul + tag) --}}
      <form method="GET" action="{{ route('posts.filter') }}" class="flex items-center">
        <div class="relative">
          <input
            type="text"
            name="cari_berita"
            value="{{ request()->query('cari_berita') }}"
            placeholder="Cari berita..."
            class="w-52 lg:w-64 pl-4 pr-9 py-2 rounded-xl border bg-white text-sm focus:outline-none focus:ring-2 focus:ring-blue-200"
          />
          <button
            type="submit"
            class="absolute right-2 top-1/2 -translate-y-1/2 text-slate-500 hover:text-blue-600"
            aria-label="Cari"
          >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
              <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 4.218 12.03l3.251 3.252a.75.75 0 1 0 1.06-1.06l-3.251-3.252A6.75 6.75 0 0 0 10.5 3.75ZM5.25 10.5a5.25 5.25 0 1 1 10.5 0 5.25 5.25 0 0 1-10.5 0Z" clip-rule="evenodd" />
            </svg>
          </button>
        </div>
      </form>
    </nav>

    {{-- Tombol kanan --}}
    <div class="flex items-center gap-2">
      @auth
        <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-xl bg-blue-600 text-white text-sm">
          Dashboard
        </a>
        <form method="POST" action="{{ route('logout') }}">@csrf
          <button class="px-4 py-2 rounded-xl border text-sm bg-white hover:bg-slate-50">Keluar</button>
        </form>
      @else
        <a href="{{ route('login') }}" class="px-4 py-2 rounded-xl border text-sm bg-white hover:bg-slate-50">
          Masuk
        </a>
      @endauth
    </div>

  </div>
</header>
