@props([
	'name',
	'label',
	'id' => '',
	'checked' => false,
])

<fieldset>
	<div class="checkbox">
		<input type="checkbox" id="{{ $id }}" name="{{ $name }}" {{ $checked ? 'checked' : '' }} {{ $attributes->merge([ 'class' => 'checkbox-input' ]) }} />
		<label for="{{ $id }}" class="tw-cursor-pointer">{!! $label !!}</label>
	</div>
</fieldset>