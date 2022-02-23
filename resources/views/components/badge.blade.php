@props([
	'type' => 'primary'
])
<span class="badge badge-{{ $type }}">{{ $slot }}</span>