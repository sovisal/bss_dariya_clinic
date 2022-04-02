@props([
	'name',
	'id' => null,
	'selected' => null,
	'class' => '',
	'inputGroup' => false,
	'inputGroupType' => '',
	'append' => '',
	'prepend' => '',
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

<select
	class="@error($name)is-invalid @enderror form-control {{ $class }} select2ajax"
	name="{{ $name }}"
	id="{{ $id ?? $name }}"
	{{ $attributes }}
>
	@if (old($name) && old('hidden_'. $name))
		<option value="{{ old($name) }}">{{ old('hidden_'. $name) }}</option>
	@else
		{!! $slot !!}
	@endif
</select>

<input type="hidden" name="hidden_{{ $name }}" id="hidden_{{ $name }}" value="{{ old('hidden_'. $name) }}" />

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

<x-form.error name="{{ $name }}"/>