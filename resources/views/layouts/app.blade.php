<!DOCTYPE html>
<html>
<head>
	<title>{{config('app.name', 'GymnWork')}}</title>
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<script src="{{ asset('js/app.js') }}" defer></script>
	<script src="{{ asset('js/_custom.js') }}" defer></script>
	<link href="{{ asset('css/_custom.css') }}" rel="stylesheet">
	<link rel="shortcut icon" href="{{ asset('storage/_images/icon.png') }}">
	<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
	@include('inc.menu')
	<div class="container">
		@include('inc.messages')
		@yield('content')
	</div>
	<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>
</html>