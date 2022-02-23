@props([
	'heads',
	'active' => '',
])

<!-- Nav tabs -->
<ul {{ $attributes->merge([ 'class' => 'nav nav-tabs', 'role'=>'tablist']) }}>
	{{ $head }}
</ul>

<!-- Tab panes -->
<div class="tab-content pt-1">
	{!! $slot !!}
</div>