<x-app-layout>
	<x-slot name="js">
		<script>
			$(document).ready(function () {
				$('.bx-trash').parent().hide();
			});
		</script>
	</x-slot>
	<x-slot name="header">
		<x-form.button href="{{ route('prescription.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
	</x-slot>
	<x-card bodyClass="pb-0" :actionShow="false">
		<table class="table-form striped">
			<tr>
				<th colspan="4" class="text-left tw-bg-gray-100">Prescription Code #{{ $row->code }}</th>
			</tr>
			@include('prescription.form_input')
		</table>
		<br>
		@include('prescription.form_result')
	</x-card>
</x-app-layout>
