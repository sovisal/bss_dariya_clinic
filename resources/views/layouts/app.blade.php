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
		<x-topbar :data="$menu" />

		<div class="d-flex tw-px-2 tw-py-4">
			@if (isset($menu[module()]['sub']))
				<x-sidebar :data="$menu[module()]['sub']" />
			@endif

			<div class="flex-fill wrap-content">
				{{-- Header: Start --}}
				{!! isset($header) && $header!='' ? '<div class="content-header tw-mb-2">'. $header .'</div>' : '' !!}
				{{-- Header: End --}}

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
