@props([
	'data' => []
])

<nav class="navbar navbar-top navbar-expand-lg header-navbar bg-secondary navbar-dark shadow-sm">
	<a class="navbar-brand" href="#">
		<div class="avatar tw-mr-1 avatar-sm">
			<img src="{{ asset('images/site/logo.png') }}" alt="avtar img holder">
		</div>
		Dariya Clinic
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			@if (is_array($data) && count($data) > 0)
				@foreach ($data as $key => $item)
					@can($item['can'])
						<li class="nav-item {{ ((mainMenuActive($key))? 'active' : '') }}">
							<a class="nav-link" href="{{ $item['url'] }}">{{ $item['label'] }}</a>
						</li>
					@endcan
				@endforeach
			@else
				{{ $slot }}
			@endif
		</ul>
		<ul class="navbar-nav ml-auto">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
					{{ auth()->user()->name }}
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="{{ route('user.account', 'general') }}"><i class="bx bx-user mr-50"></i> Account</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="#"><i class="bx bx-power-off mr-50"></i> Log out</a>
				</div>
			</li>
		</ul>
	</div>
</nav>