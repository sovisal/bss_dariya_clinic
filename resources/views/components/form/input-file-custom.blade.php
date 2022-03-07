@props([
	'name',
	'label',
	'class' => '',
	'id' => null,
])

<x-form.field>
	<label for="{{ $id ?? $name }}">{!! $label !!}</label>
	<div class="custom-file">
		<input
			class="@error($name)is-invalid @enderror form-control custom-file-input {{ $class }}"
			type="file"
			name="{{ $name }}"
			id="{{ $id ?? $name }}"
			{{ $attributes(['value' => old($name)]) }}
		/>
		<label class="custom-file-label" for="{{ $name }}">Choose file</label>

		<x-form.error name="{{ $name }}"/>
	</div>
</x-form.field>