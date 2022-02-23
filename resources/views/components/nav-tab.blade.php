@props([
	'active' => '',
	'controls',
	'id',
])

<li class="nav-item {{ $active }}"
	data-toggle="tab"
	role="tab"
	aria-selected="true"
	aria-controls="{{ $controls }}"
	id="{{ $id }}"
	href="#{{ $controls }}"
>
	<a {{ $attributes->merge(["class" => "nav-link"]) }}>
		{{ $slot }}
	</a>
</li>
