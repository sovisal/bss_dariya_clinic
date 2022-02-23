@props([
	'name',
	'label',
	'id' => null,
	'class' => '',
	'charLength' => '',
])

<x-form.field>
	<label for="{{ $id ?? $name }}">{!! $label !!}</label>
	<textarea
		class="@error($name) is-invalid @enderror form-control {{ $class }}"
		name="{{ $name }}"
		id="{{ $id ?? $name }}"
		{{ $charLength != '' ? 'data-length='. $charLength : '' }}
		{{ $attributes }}
	>{{ old($name, ($slot ?? '')) }}</textarea>

	@if ($charLength != '')
		<small class="counter-value counter-value-{{ $name }} float-right"><span class="char-count">{{ strlen(old($name, ($slot ?? ''))) }}</span> / {{ $charLength }} </small>
	@endif

	<x-form.error name="{{ $name }}" />

</x-form.field>