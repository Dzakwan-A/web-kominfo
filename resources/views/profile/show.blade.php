@extends('layouts.app')

@section('title', $page->title)

@section('content')
  @include('partials.header')

  {!! $page->content ?? '<div class="max-w-7xl mx-auto px-4 md:px-6 py-10"><p>Belum ada konten.</p></div>' !!}
@endsection
