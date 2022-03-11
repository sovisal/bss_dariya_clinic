@props([
	'name',
	'data',
	'id' => null,
	'selected' => null,
	'select2' => true,
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
	class="@error($name)is-invalid @enderror form-control {{ ($select2)? 'custom-select2' : '' }} {{ $class }}"
	name="{{ $name }}"
	id="{{ $id ?? $name }}"
	{{ $attributes(['value' => old($name)]) }}
>
	@if (isset($data))
		@foreach ($data as $key => $value)
			@if (is_array($value))
				<optgroup label="{{ $key }}">
					@foreach ($value as $k => $v)
						@if (is_array($selected))
							<option value="{{ $k }}" {{ in_array($k, $selected) ? 'selected' : '' }}>{{ $v }}</option>
						@else
							<option value="{{ $k }}" {{ $k == $selected ? 'selected' : '' }}>{{ $v }}</option>
						@endif
					@endforeach
				</optgroup>
			@else
				@if (is_array($selected))
					<option value="{{ $key }}" {{ in_array($key, $selected) ? 'selected' : '' }}>{{ $value }}</option>
				@else
					<option value="{{ $key }}" {{ $key == $selected ? 'selected' : '' }}>{{ $value }}</option>
				@endif
			@endif
		@endforeach
	@else
		{{ $slot }}
	@endif
</select>
<x-form.error name="{{ $name }}"/>

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