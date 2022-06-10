<x-app-layout>
	<x-slot name="js">
		<script>
			$(document).ready(function () {
				$('.table-medicine').append($('#sample_prescription').html());
				$('.table-medicine select').each((_i, e) => {
					$(e).select2({
						dropdownAutoWidth: !0,
						width: "100%",
						dropdownParent: $(e).parent()
					});
				});
				$(document).on('click', '.btn-add-medicine', function () {
					$('.table-medicine').append($('#sample_prescription').html());
					$('.table-medicine select').each((_i, e) => {
						$(e).select2({
							dropdownAutoWidth: !0,
							width: "100%",
							dropdownParent: $(e).parent()
						});
					});
				});
				$(document).on('change', '[name="qty[]"], [name="upd[]"], [name="nod[]"]', function () {
					$this_row = $(this).parents('tr');
					$total = 	bss_number($this_row.find('[name="qty[]"]').val()) * 
								bss_number($this_row.find('[name="upd[]"]').val()) * 
								bss_number($this_row.find('[name="nod[]"]').val());

					$this_row.find('[name="total[]"]').val(bss_number($total));
				});
			});

			$(document).on('submit', '#form_prescription', function (evt) {
				$('[name^="time_usage_"]').each(function (i, e) {
					if (!$(e).prop('checked')) {
						$(e).val('OFF').prop('checked', true);
					}
				});
			})
		</script>
	</x-slot>
	<x-slot name="header">
		<x-form.button href="{{ route('prescription.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
	</x-slot>
	<form action="{{ route('prescription.store') }}" method="POST" id="form_prescription" autocomplete="off" enctype="multipart/form-data">
		@method('PUT')
		@csrf
		<input type="hidden" name="status" value="1" />
		<x-card bodyClass="pb-0" :actionShow="false">
			<x-slot name="action">
				<div>
					<x-form.button type="submit" class="btn-submit" value="1" icon="bx bx-save" label="Save" />
				</div>
			</x-slot>
			<x-slot name="footer">
				<div>
					<x-form.button type="submit" class="btn-submit" value="1" icon="bx bx-save" label="Save" />
				</div>
			</x-slot>		
			<table class="table-form striped">
				<tr>
					<th colspan="4" class="text-left tw-bg-gray-100">Prescription</th>
				</tr>
				@include('prescription.form_input')
			</table>
			<br>
			@include('prescription.form_input_new')
		</x-card>
	</form>
	<div>
		<table id="sample_prescription" class="hidden">
			<tr>
				<input type="hidden" name="test_id[]"/>
				<td>
					<x-bss-form.select name="medicine_id[]" id="" required :select2="false">
						<option value="">Please choose</option>
						@foreach ($medicine as $data)
							<option value="{{ $data->id }}">{{ $data->name }}</option>
						@endforeach
					</x-bss-form.select>
				</td>
				<td>
					<x-bss-form.input type="number" name='qty[]' value="0" class="text-center"/>
				</td>
				<td>
					<x-bss-form.input type="number" name='upd[]' value="0" class="text-center"/>
				</td>
				<td>
					<x-bss-form.input type="number" name='nod[]' value="0" class="text-center"/>
				</td>
				<td>
					<x-bss-form.input type="number" name='total[]' value="0" class="text-center" readonly/>
				</td>
				<td>
					<x-bss-form.input type="text" name='unit[]' value="" class="text-center"/>
				</td>
				<td>
					<x-bss-form.select name="usage_id[]" id="" required data-no_search="true" :select2="false">
						<option value="">Please choose</option>
						@foreach ($usages as $id => $data)
							<option value="{{ $id }}" >{{ $data }}</option>
						@endforeach
					</x-bss-form.select>
				</td>
				<td>
					@foreach ($time_usage as $id => $data)
						<label style="display: inline;">
							<!-- row_id + time_usage_id -->
							<input name="time_usage_{{ $id }}[]" type="checkbox">
							{{ $data }}
						</label><br>
					@endforeach
				</td>
				<td>
					<x-bss-form.textarea name="other[]" rows="3"></x-bss-form.textarea>
				</td>
				<td class="text-center">
					<x-form.button color="danger" class="btn-sm" icon="bx bx-trash" onclick="$(this).parents('tr').remove();"/>
				</td>
			</tr>
		</table>
	</div>
</x-app-layout>
