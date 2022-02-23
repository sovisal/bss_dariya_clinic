@props([
	'id',
	'active' => '',
])
<div {{ $attributes->merge([ 'class' => 'tab-pane '. $active ]) }} id="{{ $id }}" role="tabpanel">
	{{ $slot }}
</div>