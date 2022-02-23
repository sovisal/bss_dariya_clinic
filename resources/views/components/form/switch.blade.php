@props([
	'name',
	'label',
	'id' => null,
	'color' => 'primary',
	'checked' => false,
	'icon' => false,
	'i1' => 'bx bx-check',
	'i2' => 'bx bx-x',
])

<x-form.field class="text-center">
	<label for="{{ $name }}">{!! $label !!}</label>
	<div class="custom-control custom-switch tw-mt-3.5 custom-switch-{{ $color }}">
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

</x-form.field>