@props([
	'label',
	'data',
	'icon' => '',
	'color' => 'primary',
	'iconPosition' => 'left',
	'dropdownMenuPosition' => 'left',
])

<div {{ $attributes->merge([ 'class' => 'dropdown' ]) }}>
	<button class="btn btn-{{ $color }} dropdown-toggle" type="button" id="dropdownMenuButtonIcon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

		@if ($icon!='' && $iconPosition=='left')
			<i class="{{ $icon }}"></i>
		@endif
		
		{!! $label !!}

		@if ($icon!='' && $iconPosition=='right')
			<i class="{{ $icon }}"></i>
		@endif

	</button>
	<div class="dropdown-menu dropdown-menu-{{ $dropdownMenuPosition }} rounded-0" aria-labelledby="dropdownMenuButtonIcon">
		@if (isset($data))
			@foreach ($data as $item)
				<x-dropdown-item url="{{ $item->url }}" label="{{ $item->label }}" icon="{{ $item->icon }}" />
			@endforeach
		@else
			{!! $slot !!}
		@endif
	</div>
</div>