<x-app-layout>
	<x-slot name="js">
		<script>
			$(document).ready(function () {
				// Labor
				$('.labor_row').hide();
				$(document).on('change', '.btnCheckRow', function () {
					$this_row = $(this).parents('tr.labor_row');
					$this_row.find('input[type="checkbox"]').prop('checked', $(this).prop('checked'));
				});
				$(document).on('change', '#btnShowRow', function () {
					$('.labor_row_' + $(this).val()).show();
					$('.labor_rows_of_' + $(this).val()).show();
				});
				$(document).on('click', '.btnHideRow', function () {
					$this_row = $(this).parents('tr.labor_row');
					$this_row.find('input[type="checkbox"]').prop('checked', false);
					$this_row.hide();
				});
			});
		</script>
	</x-slot>
	<x-slot name="header">
		<x-form.button href="{{ route('para_clinic.labor.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
	</x-slot>
	<form action="{{ route('para_clinic.labor.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
		@method('PUT')
		@csrf
		<x-card bodyClass="pb-0" :actionShow="false">
			<x-slot name="action">
				<div>
					<x-form.button type="submit" class="btn-submit" value="Progress" icon="bx bx-save" label="Save" />
					<!-- <x-form.button type="reset" class="btn-submit" value="Cancel" color="danger" icon="bx bx-x" label="Cancel" /> -->
				</div>
			</x-slot>
			<x-slot name="footer">
				<div>
					<x-form.button type="submit" class="btn-submit" value="Progress" icon="bx bx-save" label="Save" />
					<!-- <x-form.button type="reset" class="btn-submit" value="Cancel" color="danger" icon="bx bx-x" label="Cancel" /> -->
				</div>
			</x-slot>		
			<table class="table-form striped">
				<tr>
					<th colspan="4" class="text-left tw-bg-gray-100">Echo</th>
				</tr>
				@include('labor.form_input')
			</table>
			<br>
			@include('labor.form_input_new')
		</x-card>
	</form>
</x-app-layout>
