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
	<form id="labor-form" action="{{ route('para_clinic.labor.update', $row) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
		@method('PUT')
		@csrf
		<input type="hidden" name="status" value="{{ $row->status ?: 1 }}"/>
		<x-card bodyClass="pb-0" :actionShow="false">
			<x-slot name="action">
				<div>
					<x-form.button type="button" class="btn-submit" value="Complete" color="success" icon="bx bx-check" label="Complete" onclick="$(this).parents('form').find('[name=status]').val(2); $('#labor-form').submit();"/>
					<x-form.button type="submit" class="btn-submit" value="Progress" icon="bx bx-save" label="Save" />
					<!-- <x-form.button type="reset" class="btn-submit" value="Cancel" color="danger" icon="bx bx-x" label="Cancel" /> -->
				</div>
			</x-slot>
			<x-slot name="footer">
				<div>
					<x-form.button type="button" class="btn-submit" value="Complete" color="success" icon="bx bx-check" label="Complete" onclick="$(this).parents('form').find('[name=status]').val(2); $('#labor-form').submit();"/>
					<x-form.button type="submit" class="btn-submit" value="Progress" icon="bx bx-save" label="Save" />
					<!-- <x-form.button type="reset" class="btn-submit" value="Cancel" color="danger" icon="bx bx-x" label="Cancel" /> -->
				</div>
			</x-slot>			
			<table class="table-form striped">
				<tr>
					<th colspan="4" class="text-left tw-bg-gray-100">Echo Code #{{ $row->code }}</th>
				</tr>
				@include('labor.form_input')
			</table>
			<br>
			@include('labor.form_result')
		</x-card>
	</form>

</x-app-layout>
