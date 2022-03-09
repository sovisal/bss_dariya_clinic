@props([
	'name',
	'label',
	'id' => null,
	'checked' => false,
])

<fieldset>
	<div class="checkbox">
		<input type="checkbox" id="{{ $id ?? $name }}" name="{{ $name }}" {{ $checked ? 'checked' : '' }} {{ $attributes->merge([ 'class' => 'checkbox-input' ]) }} />
		<label for="{{ $id ?? $name }}" class="tw-cursor-pointer">{!! $label !!}</label>
	</div>
</fieldset>