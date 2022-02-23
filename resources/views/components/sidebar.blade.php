@props([
	'data' => []
])

<ul class="list-group py-1 sidebar-menu shadow-sm mb-1">
	@if (is_array($data) && count($data) > 0)
		@foreach ($data as $item)
			<li class="list-group-item {{ ( sidebarActive($item['name']) )? '' : '' }}">
				<a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
			</li>
		@endforeach
	@else
		{{ $slot }}
	@endif
	<li class="list-group-item">
		<a href="#">About</a>
	</li>
	<li class="list-group-item">
		<a href="#">Contact</a>
	</li>
</ul>