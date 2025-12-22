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
    <button type="button" class="inline-flex items-center gap-1 hover:text-blue-600">
      Profil
      <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd"/>
      </svg>
    </button>

    <div class="dropdown-panel absolute left-0 top-full mt-2 w-80 rounded-xl border bg-white shadow-lg overflow-hidden z-50">
      <a href="{{ route('profil.tentang') }}" class="flex items-center justify-between px-4 py-3 hover:bg-slate-50">
        Tentang <span class="text-slate-400">›</span>
      </a>
      <a href="{{ route('profil.visi') }}" class="flex items-center justify-between px-4 py-3 hover:bg-slate-50">
        Visi Misi <span class="text-slate-400">›</span>
      </a>
      <a href="{{ route('profil.struktur') }}" class="flex items-center justify-between px-4 py-3 hover:bg-slate-50">
        Struktur Organisasi <span class="text-slate-400">›</span>
      </a>
      <a href="{{ route('profil.tupoksi') }}" class="flex items-center justify-between px-4 py-3 hover:bg-slate-50">
        Tupoksi Diskominfo Kota Madiun <span class="text-slate-400">›</span>
      </a>
      <a href="{{ route('profil.standar') }}" class="flex items-center justify-between px-4 py-3 hover:bg-slate-50">
        Standar Pelayanan <span class="text-slate-400">›</span>
      </a>
      <a href="{{ route('profil.pegawai') }}" class="flex items-center justify-between px-4 py-3 hover:bg-slate-50">
        Data Pegawai <span class="text-slate-400">›</span>
      </a>
      <a href="{{ route('profil.lhkpn') }}" class="flex items-center justify-between px-4 py-3 hover:bg-slate-50">
        LHKPN Pejabat Publik Pemerintah Kota Madiun <span class="text-slate-400">›</span>
      </a>
    </div>
  </div>

      <a href="{{ route('faq') }}" class="hover:text-blue-600">FAQ</a>
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
