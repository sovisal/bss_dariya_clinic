<form action="{{ route('prescription.store') }}" method="POST" id="form_prescription" autocomplete="off" enctype="multipart/form-data">
	@method('PUT')
	@csrf
	<input type="hidden" name="is_treament_plan" value="1">
	<input type="hidden" name="patient_id" value="{{ $consultation->patient_id }}">
	<input type="hidden" name="consultation_id" value="{{ $consultation->id }}">
	<x-modal id="treatment_modal_prescriotion" dialogClass="modal-full" data-backdrop="static" data-keyboard="false" header="Create new Prescription">
		<table class="table-form table-padding-sm table-striped table-medicine">
			<thead>
				<tr>
					<th colspan="10" class="tw-bg-gray-100">
						<div class="d-flex justify-content-between align-items-center">
							<x-bss-form.input name="requested_at" class="date-time-picker" hasIcon="right" icon="bx bx-calendar" value="{{ date('Y-m-d H:i:s') }}" required/>
							<div>
								<x-form.button class="btn-add-medicine" icon="bx bx-plus" label="Add Medicine" />
							</div>
						</div>
					</th>
				</tr>
				<tr>
					<th width="15%">Medicine <small class="required">*</small></th>
					<th width="9%">Qty <small class="required">*</small></th>
					<th width="9%">U/D <small class="required">*</small></th>
					<th width="9%">NoD <small class="required">*</small></th>
					<th width="5%">Total</th>
					<th width="5%">Unit</th>
					<th width="15%">Usage</th>
					<th width="12%">Usage Time</th>
					<th>Note</th>
					<th width="8%">Action</th>
				</tr>
			</thead>
			<tbody>
				<!-- JS dynamic -->
			</tbody>
		</table>
		<x-slot name="footer">
			<x-form.button color="danger" data-dismiss="modal" icon="bx bx-x" label="{{ __('button.cancel') }}" />
			<x-form.button type="button" class="prescription_submit" icon="bx bx-save" label="{{ __('button.save') }}" />
		</x-slot>
	</x-modal>
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