<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{{ route('para_clinic.ecg.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
	</x-slot>
	<x-card bodyClass="pb-0" :actionShow="false">	
		<table class="table-form striped">
			<tr>
				<th colspan="4" class="text-left tw-bg-gray-100">EGC Code #{{ $row->code }}</th>
			</tr>
			<x-para-clinic.form-header :row="$row" :type="$type" :patient="$patient" :doctor="$doctor" :paymentType="$payment_type" :isEdit="$is_edit" />
		</table>
		<br>
		<table class="table-form striped">
			<tr>
				<th colspan="4" class="text-left tw-bg-gray-100">Result</th>
			</tr>
			@if (view()->exists('ecg_type.extra_form.' . $row->type))
				@include('ecg_type.extra_form.' . $row->type)
			@else	
				@include('ecg_type.extra_form.0')
			@endif
		</table>
	</x-card>
</x-app-layout>
