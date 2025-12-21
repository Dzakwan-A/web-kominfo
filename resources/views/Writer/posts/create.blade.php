@extends('layouts.app')

@section('title', 'Buat Berita')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
  <h1 class="text-2xl font-semibold mb-6">Buat Berita</h1>
  <form method="POST" action="{{ route('writer.posts.store') }}" enctype="multipart/form-data" class="space-y-5 bg-white rounded-xl border p-6">
    @csrf

    <div>
      <label class="block text-sm font-medium mb-1">Judul</label>
      <input name="title" class="w-full border rounded-lg px-3 py-2" value="{{ old('title') }}">
      @error('title')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
    </div>

    <div>
      <label class="block text-sm font-medium mb-1">Ringkasan (opsional)</label>
      <input name="excerpt" class="w-full border rounded-lg px-3 py-2" value="{{ old('excerpt') }}">
      @error('excerpt')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
    </div>

    <div>
      <label class="block text-sm font-medium mb-1">Konten</label>
      <textarea name="body" rows="8" class="w-full border rounded-lg px-3 py-2">{{ old('body') }}</textarea>
      @error('body')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
    </div>

    <div>
      <label class="block text-sm font-medium mb-1">Thumbnail (opsional)</label>
      <input type="file" name="thumbnail" accept="image/*">
      @error('thumbnail')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
    </div>

    <div>
      <label class="block text-sm font-medium mb-1">Status</label>
      <select name="status" class="border rounded-lg px-3 py-2">
        <option value="draft" @selected(old('status')==='draft')>Draft</option>
        <option value="publish" @selected(old('status')==='publish')>Publish</option>
      </select>
      @error('status')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
    </div>

    <div class="pt-2">
      <button class="px-4 py-2 rounded-lg bg-blue-600 text-white">Simpan</button>
      <a href="{{ route('writer.dashboard') }}" class="ml-2 px-4 py-2 rounded-lg border">Batal</a>
    </div>
  </form>
</div>
@endsection
