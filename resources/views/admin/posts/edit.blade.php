@extends('layouts.app')

@section('title', 'Edit Berita')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">Edit Berita</h1>
    <a href="{{ route('admin.dashboard') }}" class="text-sm text-slate-600 hover:underline">← Kembali</a>
  </div>

  <form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data"
        class="bg-white rounded-xl shadow-sm border p-6 space-y-4">
    @csrf
    @method('PUT')

    <div>
      <label class="block text-sm font-medium">Judul</label>
      <input name="title" value="{{ old('title', $post->title) }}"
             class="mt-1 w-full rounded-lg border px-3 py-2" required>
      @error('title') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
    </div>

    <div>
      <label class="block text-sm font-medium">Ringkasan (excerpt)</label>
      <textarea name="excerpt" rows="3"
                class="mt-1 w-full rounded-lg border px-3 py-2">{{ old('excerpt', $post->excerpt) }}</textarea>
      @error('excerpt') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
    </div>

    <div>
      <label class="block text-sm font-medium">Isi Berita</label>
      <textarea name="body" rows="10"
                class="mt-1 w-full rounded-lg border px-3 py-2" required>{{ old('body', $post->body) }}</textarea>
      @error('body') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
    </div>

    <div>
      <label class="block text-sm font-medium">Thumbnail</label>
      @if($post->thumbnail)
        <div class="mt-2">
          <img src="{{ Storage::url($post->thumbnail) }}" class="h-24 rounded-lg border object-cover" alt="">
        </div>
      @endif
      <input type="file" name="thumbnail" class="mt-2 block w-full" accept="image/*">
      @error('thumbnail') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
    </div>

    <div>
      <label class="block text-sm font-medium">Status</label>
      <select name="status" class="mt-1 w-full rounded-lg border px-3 py-2">
        <option value="draft" {{ old('status', $post->published_at ? 'publish' : 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
        <option value="publish" {{ old('status', $post->published_at ? 'publish' : 'draft') === 'publish' ? 'selected' : '' }}>Publish</option>
      </select>
      @error('status') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
    </div>

    <div>
      <label class="block text-sm font-medium">Tag (opsional)</label>
      <input name="tags" value="{{ old('tags', $post->tags) }}"
             class="mt-1 w-full rounded-lg border px-3 py-2" placeholder="Contoh: kota baru, kegiatan, kominfo">
      <p class="text-xs text-slate-500 mt-1">Pisahkan beberapa tag dengan koma.</p>
      @error('tags') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="flex items-center gap-3 pt-2">
      <button class="px-4 py-2 rounded-lg bg-blue-600 text-white">Simpan Perubahan</button>
      <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-lg border">Batal</a>
    </div>
  </form>
</div>
@endsection
