@props([
	'name',
	'id' => null,
	'color' => 'primary',
	'checked' => false,
	'icon' => false,
	'i1' => 'bx bx-check',
	'i2' => 'bx bx-x',
])

<div>
	<div class="custom-control custom-switch custom-switch-{{ $color }}">
		<input type="checkbox"
			name="{{ $name }}"
			id="{{ $id ?? $name }}"
			{{ ( (old($name) == 'on') ? 'checked' : ($checked ? 'checked' : '') ) }}
			{{ $attributes(['class' => "custom-control-input"]) }}
		/>

		@if ($icon == true)
			<label class="custom-control-label" for="{{ $id ?? $name }}">
				<span class="switch-icon-left"><i class="{{ $i1 }}"></i></span>
				<span class="switch-icon-right"><i class="{{ $i2 }}"></i></span>
			</label>
		@else
			<label class="custom-control-label" for="{{ $id ?? $name }}"></label>
		@endif

	</div>

	<x-form.error name="{{ $name }}"/>

</div>