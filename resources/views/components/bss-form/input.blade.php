@props([
	'name',
	'type' => 'text',
	'class' => '',
	'id' => null,
	'inputGroup' => false,
	'inputGroupType' => '',
	'append' => '',
	'prepend' => '',
	'hasIcon' => '',
	'icon' => '',
])

@if ($inputGroup)
	<div class="input-group">
		@if ($prepend != '')
			<div class="input-group-prepend">
				@if ($inputGroupType == 'button')
					{!! $prepend !!}
				@else
					<span class="input-group-text">
						{!! $prepend !!}
					</span>
				@endif
			</div>
		@endif
@endif

@if ($hasIcon!='' && $icon!='')
	<div class="position-relative has-icon-{{ $hasIcon }}">
@endif

<input
	class="@error($name)is-invalid @enderror form-control {{ $class }}"
	type="{{ $type }}"
	name="{{ $name }}"
	id="{{ $id ?? $name }}"
	{{ $attributes(['value' => old($name)]) }}
/>

<x-form.error name="{{ $name }}"/>

@if ($hasIcon!='' && $icon!='')
		<div class="form-control-position">
			<i class="{{ $icon }}"></i>
		</div>
	</div>
@endif

@if ($inputGroup)
		@if ($append != '')
			<div class="input-group-append">
				@if ($inputGroupType == 'button')
					{!! $append !!}
				@else
					<span class="input-group-text">
						{!! $append !!}
					</span>
				@endif
			</div>
		@endif
	</div>
@endif