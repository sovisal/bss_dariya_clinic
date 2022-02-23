<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>{{ config('app.name', 'Dariya Clinic') }}</title>
		<!-- Styles -->
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
		<link rel="stylesheet" href="{{ asset('css/custom-style.css') }}">
		{!! $css ?? '' !!}
	</head>
	<body>
		<x-loading/>
		
		{{ $slot }}
		
		<!-- Scripts -->
		<script src="{{ asset('js/app.js') }}"></script>
		<script src="{{ asset('js/unison.js') }}"></script>
		<script src="{{ asset('js/custom-js.js') }}"></script>
		<script src="{{ asset('js/login.js') }}"></script>
		{!! $js ?? '' !!}
	</body>
</html>
