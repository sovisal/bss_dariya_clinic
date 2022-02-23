@props([
	'data',
	'id' => 'widget-todo-list',
])

<ul {{ $attributes->merge(["class" => "widget-todo-list-wrapper"]) }} id="{{ $id }}">
	@if ( isset($data) )
		@foreach ($data as $key => $value)
			<x-dragable-item>
				{{ $value }}
			</x-dragable-item>
		@endforeach
	@else
		{!! $slot !!}
	@endif
</ul>