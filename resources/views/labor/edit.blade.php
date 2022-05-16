<x-app-layout>
	<x-slot name="js">
		<script>
			$(document).ready(function () {
				$('[name="type"]').change(function () {
					$_this = $(this);
					$_option_selected = $(this).find('option:selected');
					$_amount = $_option_selected.data('price');
					
					$('#amount_label').html($_amount);
					$('[name="amount"]').val($_amount);
				});
			});
		</script>
	</x-slot>
	<x-slot name="header">
		<x-form.button href="{{ route('para_clinic.labor.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
	</x-slot>
	<form action="{{ route('para_clinic.labor.update', $row) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
		@method('PUT')
		@csrf
		<x-card bodyClass="pb-0">			
			<table class="table-form striped">
				<tr>
					<th colspan="4" class="text-left tw-bg-gray-100">Echo COde #dasd123</th>
				</tr>
				@include('labor.form_input')
			</table>
			<br>
			<table class="table-form striped">
				<tr>
					<th colspan="4" class="text-left tw-bg-gray-100">Result</th>
				</tr>
			</table>
			<table class="table-form striped table table-border">
				<tr class="text-center">
					<td>N<sup>o</sup<</td>
					<td>Category</td>
					<td>Test Name</td>
					<td width="150px">Val</td>
					<td>Min</td>
					<td>Max</td>
					<td>Unit</td>
				</tr>
				<tr>
					<td>N<sup>o</sup<</td>
					<td>Category</td>
					<td>Test Name</td>
					<td>
						<x-bss-form.input name='sample' value="0" />
					</td>
					<td>Min</td>
					<td>Max</td>
					<td>Unit</td>
				</tr>
				<tr>
					<td>N<sup>o</sup<</td>
					<td>Category</td>
					<td>Test Name</td>
					<td>
						<x-bss-form.input name='sample' value="0" />
					</td>
					<td>Min</td>
					<td>Max</td>
					<td>Unit</td>
				</tr>
				<tr>
					<td>N<sup>o</sup<</td>
					<td>Category</td>
					<td>Test Name</td>
					<td>
						<x-bss-form.input name='sample' value="0" />
					</td>
					<td>Min</td>
					<td>Max</td>
					<td>Unit</td>
				</tr>
			</table>
			<x-slot name="footer">
				<x-form.button type="submit" icon="bx bx-save" label="Save" />
			</x-slot>
		</x-card>
	</form>

</x-app-layout>
