@props([
	'row',
	'title',
	'preCode' => '',
])

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
				<h2>{{ $title }}</h2>
			</td>
		</tr>
		<tr>
			<td width="15%"><b>កាលបរិច្ឆេទ/Date</b></td>
			<td width="25%">: {{ date('d/m/Y', strtotime($row->requested_at)) }}</td>
			<td width="10%"><b>PatientID</b></td>
			<td width="17%">: PT-{{ str_pad($row->patient_id, 6, '0', STR_PAD_LEFT) }}</td>
			<td width="13%"><b>លេខកូដ/Code</b></td>
			<td width="20%">: {{ $preCode . date('Y') }}-{{ str_pad($row->id, 6, '0', STR_PAD_LEFT) }}</td>
		</tr>
		<tr>
			<td width="15%"><b>ឈ្មោះ/Name</b></td>
			<td width="25%">: {{ $row->patient_kh }}</td>
			<td width="10%"><b>អាយុ/Age</b></td>
			<td width="17%">: {{ $row->patient_age }}</td>
			<td width="13%"><b>ភេទ/Sex</b></td>
			<td width="20%">: {{ $row->patient_gender }}</td>
		</tr>
	</table>
</header>