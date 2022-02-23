@props([
	
])

<li {{ $attributes->merge([ 'class'=> 'widget-todo-item' ]) }}>
	<div class="widget-todo-title-wrapper d-flex justify-content-between align-items-center mb-50">
		<div class="widget-todo-title-area d-flex align-items-center">
			<i class='bx bx-grid-vertical mr-25 font-medium-4 cursor-move'></i>
			<span class="widget-todo-title ml-50">{!! $slot !!}</span>
		</div>
		<div class="widget-todo-item-action d-flex align-items-center">
			{!! $rightSide ?? '' !!}
		</div>
	</div>
</li>