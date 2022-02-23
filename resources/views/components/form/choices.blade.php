@props([
	'name',
	'label',
	'data',
	'type' => 'checkbox',
	'checked',
])

<x-form.field>

	<label for="{{ $name }}">{!! $label !!}</label>


	<x-ul-unstyled class="text-center form-control">
		@foreach ($data as $item)
		<x-li-inline>
			@if ( $type == 'radio' )
				<x-form.radio name="{{ $name }}" value="{{ $item['value'] }}" id="{{ $item['id'] }}" label="{{ $item['label'] }}"  checked="{{ $item['checked'] ?? ($item['value'] == $checked) }}" />
			@else
				<x-form.checkbox name="{{ $name }}" value="{{ $item['value'] }}" id="{{ $item['id'] }}" label="{{ $item['label'] }}" checked="{{ $item['checked'] ?? ($item['value'] == $checked) }}" />
			@endif
		</x-li-inline>
		@endforeach
	</x-ul-unstyled>

	<x-form.error name="{{ $name }}"/>

</x-form.field>