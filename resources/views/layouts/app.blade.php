<!DOCTYPE html>
<html lang="mn">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="ai-chat-url" content="{{ route('ai.chat') }}">
<title>@yield('title', 'VESTI')</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&family=Archivo+Black&family=Oswald:wght@600&family=Montserrat:wght@800&family=Anton&family=Permanent+Marker&family=Noto+Sans:wght@700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/vesti.css') }}">
</head>
<body>
 
@include('partials.header')
 
@yield('content')
 
@include('partials.footer')
@include('partials.overlays')
 
{{-- Data (PHP -> JS) zaaval vesti.js-ees umnu --}}
@stack('data')
 
<script src="{{ asset('js/vesti.js') }}"></script>
<script src="{{ asset('js/vesti-ai.js') }}"></script>
@stack('scripts')
</body>
</html>
 