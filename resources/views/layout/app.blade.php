<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kominfo | @yield('title')</title>
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body class="font-sans antialiased">
  @include('partials.navbar')
  <main class="py-6">
    @yield('content')
  </main>
  @include('partials.footer')
</body>
</html>
