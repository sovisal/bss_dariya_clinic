@props([
	'url',
	'label',
	'icon' => '',
	'iconPosition' => 'left',
])

<a href="{{ $url }}" {{ $attributes->merge([ 'class' => 'dropdown-item' ]) }}>
	
	@if ($icon!='' && $iconPosition=='left')
		<i class="{{ $icon }} mr-50"></i>
	@endif

	{!! $label !!}

	@if ($icon!='' && $iconPosition=='right')
		<i class="{{ $icon }} mr-50"></i>
	@endif

</a>