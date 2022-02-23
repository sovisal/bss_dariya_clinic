@props([
	'name',
	'label',
	'time' => false,
	'drpStart' => '',
	'drpEnd' => '',
])

<x-form.input
	name="{{ $name }}"
	hasIcon="left"
	icon="bx bx-calendar-check"
	autocomplete="off"
	label="{!! $label !!}"
	{{ $attributes->merge(['class' => (($time)? 'datetimerange-picker' : 'daterange-picker'), 'value' => old($name)]) }}
/>
<input type="hidden" name="{{ $name }}_drp_start" id="{{ $name }}_drp_start" value="{{ old($name.'_drp_start', $drpStart) }}" />
<input type="hidden" name="{{ $name }}_drp_end" id="{{ $name }}_drp_end" value="{{ old($name.'_drp_end', $drpEnd) }}" />