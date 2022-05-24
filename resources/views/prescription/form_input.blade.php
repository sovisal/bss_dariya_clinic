<tr>
	<td class="text-right">Patient name <small class='required'>*</small></td>
	<td>
		<x-bss-form.select name="patient_id" required :disabled="$is_edit && $row->patient_id">
			@if (!$is_edit)
				<option value="">Please choose patient</option>
			@endif
			@foreach ($patient as $data)
				<option value="{{ $data->id }}" {{ ($row->patient_id ?? false) == $data->id ? 'selected' : '' }}>{{ $data->name_en }}</option>
			@endforeach
		</x-bss-form.select>
	</td>
	<td width="15%" class="text-right"></td>
	<td>

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
	<td class="text-right">Analysis by <small class='required'>*</small></td>
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
	<td class="text-right">Requested date <small class='required'>*</small></td>
	<td>
		<x-bss-form.input name='requested_at' class="date-time-picker" hasIcon="right" icon="bx bx-calendar" value="{{ $row->requested_at ?? date('Y-m-d H:i:s') }}" required :disabled="$is_edit && $row->requested_at"/>
	</td>
	<td class="text-right">Analysis date</td>
	<td>
		<x-bss-form.input name='analysis_at' class="date-time-picker" hasIcon="right" icon="bx bx-calendar" value="{{ $row->analysis_at ?? null }}" />
	</td>
</tr>
<tr>
	<td class="text-right">Diagnosis</td>
	<td colspan="3">
		<x-bss-form.textarea name="diagnosis">
			{{ $row->diagnosis ?? '' }}
		</x-bss-form.textarea>
	</td>
</tr>