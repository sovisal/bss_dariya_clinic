<x-print-layout>
	{{-- <x-slot name="css">
		<link rel="stylesheet" href="{{ asset('css/print-style.css') }}">
	</x-slot> --}}

	<section class="print-preview-a4">
		<x-para-clinic.print-header :row="$ecg" title="លទ្ធផលពិនិត្យ ECG" />

		<section class="ecg-body">
			<h3 class="text-center text-red title">{{ $ecg->type_kh }}</h3>
			@foreach ($ecg->attribute as $label => $attr)
				<div>
					<b>{!! __('form.ecg.'. $label) !!}</b> : {!! $attr !!}
				</div>
			@endforeach
		</section>
		<div class="signature">
			<div class="text-center">ថ្ងៃទី {{ date('d/m/Y', strtotime($ecg->requested_at)) }}</div>
			<div class="text-center">Dr. {{ $ecg->doctor_kh }}</div>
			<img src="{{ asset('images/site/signature.png') }}" alt="">
		</div>
		
		<x-para-clinic.print-footer />
	</section>

</x-print-layout>