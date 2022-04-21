@props([
	'label' => '',
	'icon' => '',
	'href' => '',
	'hideLabelOnXS' => false,
	'iconPosition' => 'left',
	'color' => 'primary',
	'type' => 'button',
])
@if ($href=='')
	<button {{ $attributes->merge(["class" => "btn-sm btn btn-". $color ." ". (($label=='')? 'btn-icon' : '' ) ]) }} type="{{ $type }}">
		@if ($hideLabelOnXS)
			<div class=" d-block d-sm-none">
				<i class="{!! $icon !!}"></i>
			</div>
			<span class="d-none d-sm-block">
		@endif
	
		@if ($iconPosition=='left')
			<i class="{!! $icon !!}"></i> 
		@endif
		{!! $label !!}
		@if ($iconPosition=='right')
			<i class="{!! $icon !!}"></i> 
		@endif

		@if ($hideLabelOnXS)
		</span>
		@endif
	</button>
@else
	<a href="{{ $href }}" {{ $attributes->merge(["class" => "btn-sm btn btn-". $color ." ". (($label=='')? 'btn-icon' : '' ) ]) }}>
		@if ($hideLabelOnXS)
			<div class=" d-block d-sm-none">
				<i class="{!! $icon !!}"></i>
			</div>
			<span class="d-none d-sm-block">
		@endif

		@if ($iconPosition=='left')
			<i class="{!! $icon !!}"></i> 
		@endif
		{!! $label !!}
		@if ($iconPosition=='right')
			<i class="{!! $icon !!}"></i> 
		@endif

		@if ($hideLabelOnXS)
		</span>
		@endif
	</a>
@endif