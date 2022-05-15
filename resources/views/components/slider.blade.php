@props([
	'id',
	'data' => [],
	'btnControl' => true,
	'autoplay' => true,
])
<div id="{{ $id }}" {{ $attributes->merge(['class'=>"carousel slide"]) }} data-ride="carousel" {{ ((!$autoplay)? 'data-interval=false' : '') }}>
	<div class="carousel-inner">
		@if (count($data) > 0)
			@foreach ($data as $item)
				<div class="carousel-item {{ (($loop->first)? 'active' : '') }}">
					<img src="{{ asset($item) }}" class="d-block w-100" alt="...">
				</div>
			@endforeach
		@else
			{{ $slot }}
		@endif
	</div>

	@if ($btnControl)
		<button class="carousel-control-prev" type="button" data-target="#{{ $id }}" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</button>
		<button class="carousel-control-next" type="button" data-target="#{{ $id }}" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</button>
	@endif
</div>