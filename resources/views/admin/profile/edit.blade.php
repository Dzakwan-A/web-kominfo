@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">Edit Halaman Profil</h1>
  </div>

  @if(session('success'))
    <div class="mb-4 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3">
      {{ session('success') }}
    </div>
  @endif

  {{-- PANEL UPLOAD GAMBAR --}}
  <div class="mb-6 bg-white rounded-xl border shadow-sm p-5">
    <div class="flex items-center justify-between mb-3">
      <div>
        <div class="font-semibold text-sm">Upload Gambar</div>
        <p class="text-xs text-slate-500 mt-1">
          Unggah gambar lalu salin tag &lt;img&gt; yang muncul dan tempelkan ke konten HTML di bawah.
        </p>
      </div>
    </div>

    <form action="{{ route('admin.profile.upload-image') }}" method="POST" enctype="multipart/form-data"
          class="flex flex-col md:flex-row md:items-center gap-3">
      @csrf
      <input
        type="file"
        name="image"
        accept="image/*"
        class="text-sm"
        required
      >
      <button
        type="submit"
        class="inline-flex items-center px-4 py-2 rounded-lg bg-slate-900 text-white text-sm hover:bg-slate-800"
      >
        Upload Gambar
      </button>
    </form>

    @if (session('uploaded_image_url'))
      <div class="mt-4 text-xs">
        <div class="text-slate-600 mb-1">Salin kode ini ke dalam konten:</div>
        <div class="bg-slate-900 text-slate-50 rounded-lg px-3 py-2 overflow-x-auto">
          <code>
            &lt;img src="{{ session('uploaded_image_url') }}" alt="Gambar Profil" class="w-full rounded-3xl"&gt;
          </code>
        </div>

        <div class="mt-2">
          <div class="text-slate-600 mb-1">Preview:</div>
          <img
            src="{{ session('uploaded_image_url') }}"
            alt="Preview gambar"
            class="max-h-40 rounded-lg border"
          >
        </div>
      </div>
    @endif
  </div>
  {{-- END PANEL UPLOAD GAMBAR --}}

  <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-8">
    @csrf
    @method('PUT')

    @foreach($pages as $page)
      <div class="bg-white rounded-xl shadow-sm border p-5">
        <input type="hidden" name="pages[{{ $page->id }}][id]" value="{{ $page->id }}">

        <div class="flex items-center justify-between mb-3">
          <h2 class="font-semibold text-lg">{{ $page->title }}</h2>
          <span class="text-xs text-slate-500">Key: {{ $page->key }}</span>
        </div>

        <div class="mb-3">
          <label class="block text-xs font-medium text-slate-600 mb-1">Judul Halaman</label>
          <input
            type="text"
            name="pages[{{ $page->id }}][title]"
            value="{{ old("pages.$page->id.title", $page->title) }}"
            class="w-full px-3 py-2 rounded-lg border bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-200"
          >
          @error("pages.$page->id.title")
            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label class="block text-xs font-medium text-slate-600 mb-1">
            Konten (boleh HTML, misal &lt;p&gt;, &lt;ul&gt;, dsb)
          </label>
          <textarea
            name="pages[{{ $page->id }}][content]"
            rows="8"
            class="w-full px-3 py-2 rounded-lg border bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-200"
          >{{ old("pages.$page->id.content", $page->content) }}</textarea>
          @error("pages.$page->id.content")
            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>
      </div>
    @endforeach

    <div class="flex justify-end">
      <button type="submit"
              class="px-5 py-2.5 rounded-lg bg-blue-600 text-white text-sm font-medium hover:bg-blue-700">
        Simpan Perubahan
      </button>
    </div>
  </form>
</div>
@endsection
