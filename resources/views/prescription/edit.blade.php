<x-app-layout>
	<x-slot name="js">
		<script>
			$(document).on('change', '[name="qty[]"], [name="upd[]"], [name="nod[]"]', function () {
				$this_row = $(this).parents('tr');
				$total = 	bss_number($this_row.find('[name="qty[]"]').val()) * 
							bss_number($this_row.find('[name="upd[]"]').val()) * 
							bss_number($this_row.find('[name="nod[]"]').val());

				$this_row.find('[name="total[]"]').val(bss_number($total));
			});

			$('.btn-submit').click(function (){
				$('[name="status"]').val($(this).val());
			});
		</script>
	</x-slot>
	<x-slot name="header">
		<x-form.button href="{{ route('prescription.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
	</x-slot>
	<form action="{{ route('prescription.update', $row) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
		@method('PUT')
		@csrf
		<input type="hidden" name="status" value="{{ $row->status ?: 1 }}"/>
		<x-card bodyClass="pb-0" :actionShow="false">
			<x-slot name="action">
				<div>
					<x-form.button type="submit" class="btn-submit" value="2" color="success" icon="bx bx-check" label="Complete"/>
					<x-form.button type="submit" class="btn-submit" value="1" icon="bx bx-save" label="Save" />
				</div>
			</x-slot>
			<x-slot name="footer">
				<div>
					<x-form.button type="submit" class="btn-submit" value="2" color="success" icon="bx bx-check" label="Complete"/>
					<x-form.button type="submit" class="btn-submit" value="1" icon="bx bx-save" label="Save" />
				</div>
			</x-slot>
			<table class="table-form striped">
				<tr>
					<th colspan="4" class="text-left tw-bg-gray-100">Prescription Code #{{ $row->code }}</th>
				</tr>
				@include('prescription.form_input')
			</table>
			<br>
			@include('prescription.form_result')
		</x-card>
	</form>

</x-app-layout>
