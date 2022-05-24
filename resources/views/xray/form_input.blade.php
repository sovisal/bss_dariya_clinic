<tr>
	<td width="15%" class="text-right">Form <small class='required'>*</small></td>
	<td>
		<x-bss-form.select name="type" required :disabled="$is_edit && $row->type">
			@if (!$is_edit)
				<option value="">Please choose</option>
			@endif
			@foreach ($type as $data)
				<option value="{{ $data->id }}" data-price="{{ $data->price }}" {{ ($row->type ?? false) == $data->id ? 'selected' : '' }} >{{ $data->name_en }}</option>
			@endforeach
		</x-bss-form.select>
	</td>
	<td width="15%" class="text-right">Payment type <small class='required'>*</small></td>
	<td>
		<x-bss-form.select name="payment_type" data-no_search="true" required :disabled="$is_edit && $row->payment_type">
			@foreach ($payment_type as $id => $data)
				<option value="{{ $id }}" {{ ($row->payment_type ?? false) == $id ? 'selected' : '' }} >{{ $data }}</option>
			@endforeach
		</x-bss-form.select>
	</td>
</tr>
<tr>
	<td class="text-right">Patient name <small class='required'>*</small></td>
	<td>
		<x-bss-form.select name="patient_id" required :disabled="$is_edit && $row->patient_id">
			@if (!$is_edit)
				<option value="">Please choose patient</option>
			@endif
			@foreach ($patient as $data)
				<option value="{{ $data->id }}" {{ ($row->patient_id ?? false) == $data->id ? 'selected' : '' }} >{{ $data->name_en }}</option>
			@endforeach
		</x-bss-form.select>
	</td>
	<td class="text-right">Requested date <small class='required'>*</small></td>
	<td>
		<x-bss-form.input name='requested_at' class="date-time-picker" hasIcon="right" icon="bx bx-calendar" value="{{ $row->requested_at ?? date('Y-m-d H:i:s') }}" required :disabled="$is_edit && $row->requested_at"/>
	</td>
</tr>
<tr>
	<td class="text-right">Requested by <small class='required'>*</small></td>
	<td>
		<x-bss-form.select name="requested_by" required :disabled="$is_edit && $row->requested_by">
			@if (!$is_edit)
				<option value="">Please choose</option>
			@endif
			@foreach ($doctor as $data)
				<option value="{{ $data->id }}" {{ ($row->requested_by ?? false) == $data->id ? 'selected' : '' }} >{{ $data->name_en }}</option>
			@endforeach
		</x-bss-form.select>
	</td>
	<td class="text-right">Physician <small class='required'>*</small></td>
	<td>
		<x-bss-form.select name="doctor_id" required :disabled="$is_edit && $row->doctor_id">
			@if (!$is_edit)
				<option value="">Please choose</option>
			@endif
			@foreach ($doctor as $data)
				<option value="{{ $data->id }}" {{ ($row->doctor_id ?? false) == $data->id ? 'selected' : '' }} >{{ $data->name_en }}</option>
			@endforeach
		</x-bss-form.select>
	</td>
</tr>
<tr>
	<td class="text-right">Price</td>
	<td colspan="3">
		<span id="amount_label"> {{ $row->amount ?? 0 }} </span> USD
		<input type="hidden" name="amount" value="{{ $row->amount ?? 0 }}">
	</td>
</tr>