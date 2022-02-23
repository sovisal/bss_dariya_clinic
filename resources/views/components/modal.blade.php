@props([
	'id',
	'width' => '',
	'head' => true,
	'foot' => true,
	'actionShow' => true,
	'dialogClass' => '',
	'contentClass' => '',
])
<div {{ $attributes->merge(['class'=>"modal text-left"]) }} id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="Label{{ $id }}" aria-hidden="true">
	<div class="modal-dialog {{ $dialogClass }}" style="{{ ($width!='')? 'max-width: '. $width : '' }}">
		<div class="modal-content {{ $contentClass }}">
			@if ($head)
				<div class="modal-header">
					<h3 class="modal-title" id="Label{{ $id }}">{!! $header ?? '' !!}</h3>
					@if ($actionShow)
						<ul class="list-inline mb-0">
							{!! $action ?? '' !!}
						</ul>
						<button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
							<i class="bx bx-x"></i>
						</button>
					@endif
				</div>
			@endif

			<div class="modal-body">
				{{ $slot }}
			</div>
			
			@if ($foot)
				<div class="modal-footer">
					{!! $footer ?? '' !!}
				</div>
			@endif
		</div>
	</div>
</div>