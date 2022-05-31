<x-print-layout>
	{{-- <x-slot name="css">
		<link rel="stylesheet" href="{{ asset('css/print-style.css') }}">
	</x-slot> --}}

	<section class="print-preview-a4">
		<x-para-clinic.print-header :row="$xray" title="លទ្ធផលពិនិត្យ X-Ray" />

		<section class="xray-body">
			<h3 class="text-center text-red title">{{ $xray->type_kh }}</h3>
			@foreach ($xray->attribute as $label => $attr)
				<div>
					<b>{!! __('form.xray.'. $label) !!}</b> : {!! $attr !!}
				</div>
			@endforeach
		</section>
		<div class="signature">
			<div class="text-center">ថ្ងៃទី {{ date('d/m/Y', strtotime($xray->requested_at)) }}</div>
			<div class="text-center">Dr. {{ $xray->doctor_kh }}</div>
			<img src="{{ asset('images/site/signature.png') }}" alt="">
		</div>
		
		<x-para-clinic.print-footer />
	</section>

</x-print-layout>