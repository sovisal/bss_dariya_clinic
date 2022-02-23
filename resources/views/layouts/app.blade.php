<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>{{ module() }} - {{ subModule() }} | {{ config('app.name', 'Dariya Clinic') }}</title>
		<!-- Styles: Start -->
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
		<link rel="stylesheet" href="{{ asset('css/custom-style.css') }}">
		{!! $css ?? '' !!}
		<!-- Styles: End -->
	</head>
	<body>

		@include('layouts._topbar')

		<div class="d-flex tw-px-2 tw-py-4">

			{{-- {{ $sidebar ?? '' }} --}}

			<ul class="list-group py-1 sidebar-menu shadow-sm mb-1">
				<li class="list-group-item active">
					<a href="#">Home</a>
				</li>
				<li class="list-group-item">
					<a href="#">About</a>
				</li>
				<li class="list-group-item">
					<a href="#">Contact</a>
				</li>
			</ul>

			<div class="flex-fill wrap-content">

				{{-- Alert Message: Start --}}
				<x-alert-msg />
				{{-- Alert Message: End --}}

				{{ $slot }}
			</div>
		</div>



		<x-loading/>

		<!-- Scripts: Start -->
		<script src="{{ asset('js/app.js') }}"></script>
		<script src="{{ asset('js/unison.js') }}"></script>
		{{-- <script src="{{ asset('js/app-menu.min.js') }}"></script> --}}
		{{-- <script src="{{ asset('js/app.min.js') }}"></script> --}}
		<script src="{{ asset('js/custom-js.js') }}" defer></script>
		{!! $js ?? '' !!}
	</body>
</html>
