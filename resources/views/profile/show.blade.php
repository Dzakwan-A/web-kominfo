@extends('layouts.app')

@section('title', $page->title)

@section('content')
  @include('partials.header')

  <div class="max-w-5xl mx-auto px-4 md:px-6 py-10">
    <h1 class="text-3xl font-semibold mb-6">{{ $page->title }}</h1>

    <div class="prose max-w-none">
      {{-- admin dipercaya, jadi boleh HTML --}}
      {!! $page->content ?? '<p>Belum ada konten.</p>' !!}
    </div>
  </div>
@endsection
