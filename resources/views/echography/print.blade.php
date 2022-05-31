<x-print-layout>
	{{-- <x-slot name="css">
		<link rel="stylesheet" href="{{ asset('css/print-style.css') }}">
	</x-slot> --}}

	<section class="print-preview-a4">
		<header>
			<x-para-clinic.print-header :row="$echography" title="លទ្ធផលពិនិត្យ អេកូ" />
		</header>
		<section class="echography-body">
			@if ($echography->type < 5)
				<div class="d-flex">
					<div style="width: 40%; margin-right: 20px; margin-top: 20px">
						@if ($echography->image_1)
							<img src="{{ asset('images/echographies/'. $echography->image_1) }}" alt="...">
						@endif
						@if ($echography->image_2)
							<img src="{{ asset('images/echographies/'. $echography->image_2) }}" alt="...">
						@endif
					</div>
					<div class="flex-fill">
						<h3 class="text-center text-red title">{{ $echography->type_kh }}</h3>
						<table width="100%">
							@foreach ($echography->attribute as $label => $attr)
								<tr>
									<td width="30%"><b>{!! __('form.echography.'. $label) !!}</b></td>
									<td> : {!! $attr !!}</td>
								</tr>
							@endforeach
						</table>
					</div>
				</div>
			@else
				<h3 class="text-center text-red title">{{ $echography->type_kh }}</h3>
				@foreach ($echography->attribute as $label => $attr)
					<div>
						<b>{!! __('form.echography.'. $label) !!}</b> : {!! $attr !!}
					</div>
				@endforeach
				<div class="d-flex justify-content-end" style="margin-top: 10px;">
					@if ($echography->image_1)
						<div style="margin-right: 5px; width: 50%;">
							<img src="{{ asset('images/echographies/'. $echography->image_1) }}" alt="...">
						</div>
					@endif
					@if ($echography->image_2)
						<div style="margin-left: 5px; width: 50%;">
							<img src="{{ asset('images/echographies/'. $echography->image_2) }}" alt="...">
						</div>
					@endif
				</div>
			@endif
		</section>
		<div class="signature">
			<div class="text-center">ថ្ងៃទី {{ date('d/m/Y', strtotime($echography->requested_at)) }}</div>
			<div class="text-center">Dr. {{ $echography->doctor_kh }}</div>
			<img src="{{ asset('images/site/signature.png') }}" alt="">
		</div>
		
		<x-para-clinic.print-footer />
	</section>

</x-print-layout>