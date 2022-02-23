@props([
	'name',
	'label',
	'id' => '',
	'checked' => false,
])

<fieldset>
	<div class="radio">
		<input type="radio" id="{{ $id }}" name="{{ $name }}" {{ $checked ? 'checked' : '' }} {{ $attributes }} />
		<label for="{{ $id }}" class="tw-cursor-pointer">{!! $label !!}</label>
	</div>
</fieldset>