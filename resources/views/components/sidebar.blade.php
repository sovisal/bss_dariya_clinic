@props([
	'data' => []
])
<ul class="list-group py-1 sidebar-menu shadow-sm mb-1">
	@if (is_array($data) && count($data) > 0)
		@foreach ($data as $key => $item)
			@can($item['can'])
				<li class="list-group-item {{ ( subMenuActive($item['name'], $key) )? 'active' : '' }}">
					<a href="{{ $item['url'] }}">{!! $item['label'] !!}</a>
				</li>
			@endcan
		@endforeach
	@else
		{{ $slot }}
	@endif
</ul>