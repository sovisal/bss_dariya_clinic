<x-print-layout>
	<x-slot name="css">
		<link rel="stylesheet" href="{{ asset('css/print-style.css') }}">
		<style>

		</style>
	</x-slot>
	<x-slot name="js">
		<script>

		</script>
	</x-slot>

	<section class="print-preview-a4">
		<header>
			<table class="table-header" width="100%">
				<tr>
					<td width="15%">
						<img src="{{ asset('images/site/logo.png') }}" alt="">
					</td>
					<td class="text-center">
						<h2 class="KHMOULLIGHT text-blue">មន្ទីរសម្រាកព្យាបាល គ្រួក ពុទ្ធា</h2>
						<h1 class="text-bold text-blue">KROUK PUTHEA CLINIC</h1>
						<div>ព្យាបាល៖ ជំងឺទូទៅ ទឹកនោមផ្អែម លើសសម្ពាធឈាម មនុស្សចាស់ កុមារ និងរោគស្រ្ដីវះកាត់ តូច ថតអេកូរ ពិនិត្យឈាម</div>
						<div>ពិនិត្យកំហាប់ឆ្អឹង វ៉ាក់សាំងការពារ ថ្លើមបេ មហារីកមាត់ស្បូន ឆ្កែឆ្កួត</div>
					</td>
				</tr>
			</table>
			<table class="table-info" width="100%">
				<tr>
					<td colspan="6" class="text-center">
						<h2>លទ្ធផលពិនិត្យ អេកូ</h2>
					</td>
				</tr>
				<tr>
					<td width="15%"><b>កាលបរិច្ឆេទ/Date</b></td>
					<td width="25%">: {{ date('d/m/Y', strtotime($echography->requested_at)) }}</td>
					<td width="10%"><b>PatientID</b></td>
					<td width="17%">: PT-{{ str_pad($echography->patient_id, 6, '0', STR_PAD_LEFT) }}</td>
					<td width="13%"><b>លេខកូដ/Code</b></td>
					<td width="20%">: ECH{{ date('Y') }}-{{ str_pad($echography->id, 6, '0', STR_PAD_LEFT) }}</td>
				</tr>
				<tr>
					<td width="15%"><b>ឈ្មោះ/Name</b></td>
					<td width="25%">: {{ $echography->patient_kh }}</td>
					<td width="10%"><b>អាយុ/Age</b></td>
					<td width="17%">: {{ $echography->patient_age }}</td>
					<td width="13%"><b>ភេទ/Sex</b></td>
					<td width="20%">: {{ $echography->patient_gender }}</td>
				</tr>
			</table>
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
			<footer>
				<div>ភូមិថ្នល់បែកលិច ឃុំស្វាយទាប ស្រុកចំការលើ កំពង់ចាម (ទល់មុខវិទ្យាល័យ ហ៊ុន សែន ចំការលើ)</div>
				<div>ទូរស័ព្ទទំនាក់ទំនង៖ <span class="text-red">078 744 447-070 44 71 70</span></div>
			</footer>
		</header>
	</section>

</x-print-layout>