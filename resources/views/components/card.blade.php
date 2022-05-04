@props([
	'head' => true,
	'foot' => true,
	'actionShow' => true,
	'headerClass' => '',
	'footerClass' => '',
	'bodyClass' => '',
])
<div {{ $attributes->merge(['class'=>"card shadow-sm mb-1"]) }}>
	@if ($head)
		<div class="card-header {{ $headerClass }}">
			{!! $header ?? '<h4 class="card-title">'. __('module.sub.'. subModule()) .'</h4>' !!}
			@if ($actionShow)
				<a class="heading-elements-toggle">
					<i class='bx bx-dots-vertical font-medium-3'></i>
				</a>
				<div class="heading-elements d-flex">
					<ul class="list-inline mb-0">
						{!! $action ?? '' !!}
						<li><a data-action="collapse"><i class="bx bx-chevron-down"></i></a></li>
						<li><a data-action="expand"><i class="bx bx-fullscreen"></i></a></li>
						<li><a data-action="close"><i class="bx bx-x"></i></a></li>
					</ul>
				</div>
			@else
				{!! $action ?? '' !!}
			@endif
		</div>
	@endif
	<div class="card-content collapse show">
		<div class="card-body {{ $bodyClass }}">
			{{ $slot }}
		</div>
	</div>
	
	@if ($foot)
		<div class="card-footer text-right {{ $footerClass }}">
			{!! $footer ?? '' !!}
		</div>
	@endif
</div>