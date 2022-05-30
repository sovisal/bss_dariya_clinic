<x-app-layout>
	<x-slot name="js">
		<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
	</x-slot>
	<x-slot name="header">
		<x-form.button href="{{ route('para_clinic.xray.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
	</x-slot>
	<x-card bodyClass="pb-0" :actionShow="false">	
		<table class="table-form striped">
			<tr>
				<th colspan="4" class="text-left tw-bg-gray-100">X-Ray Code #{{ $row->code }}</th>
			</tr>
			<x-para-clinic.form-header :row="$row" :type="$type" :patient="$patient" :doctor="$doctor" :paymentType="$payment_type" :isEdit="$is_edit" />
		</table>
		<br>
		<table class="table-form striped">
			<tr>
				<th colspan="4" class="text-left tw-bg-gray-100">Result</th>
			</tr>
			@if (view()->exists('xray_type.extra_form.' . $row->type))
				@include('xray_type.extra_form.' . $row->type)
			@else	
				@include('xray_type.extra_form.0')
			@endif
		</table>
	</x-card>
</x-app-layout>
