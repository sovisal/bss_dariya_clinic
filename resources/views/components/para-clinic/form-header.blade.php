@props([
	'row' => null,
	'type' => null,
	'patient' => null,
	'doctor' => null,
	'paymentType' => null,
	'isEdit' => false,
])
<tr>
	<td width="15%" class="text-right">Form <small class='required'>*</small></td>
	<td>
		<x-bss-form.select name="type" :disabled="$isEdit && $row->type" required>
			@if (!$isEdit)
				<option value="">Please choose</option>
			@endif
			@foreach ($type as $data)
				<option value="{{ $data->id }}" data-price="{{ $data->price }}" {{ ($row->type ?? false) == $data->id ? 'selected' : '' }} >{{ render_synonyms_name($data->name_en, $data->name_kh) }}</option>
			@endforeach
		</x-bss-form.select>
	</td>
	<td width="15%" class="text-right">Payment type <small class='required'>*</small></td>
	<td>
		<x-bss-form.select name="payment_type" data-no_search="true" required :disabled="$isEdit && $row->payment_type">
			@foreach ($paymentType as $id => $data)
				<option value="{{ $id }}" {{ ($row->payment_type ?? false) == $id ? 'selected' : '' }} >{{ $data }}</option>
			@endforeach
		</x-bss-form.select>
	</td>
</tr>
<tr>
	<td class="text-right">Patient name <small class='required'>*</small></td>
	<td>
		<x-bss-form.select name="patient_id" required :disabled="$isEdit && $row->patient_id">
			@if (!$isEdit)
				<option value="">Please choose patient</option>
			@endif
			@foreach ($patient as $data)
				<option value="{{ $data->id }}" {{ ($row->patient_id ?? false) == $data->id ? 'selected' : '' }} >{{ render_synonyms_name($data->name_en, $data->name_kh) }}</option>
			@endforeach
		</x-bss-form.select>
	</td>
	<td class="text-right">Requested date <small class='required'>*</small></td>
	<td>
		<x-bss-form.input name='requested_at' class="date-time-picker" hasIcon="right" icon="bx bx-calendar" value="{{ $row->requested_at ?? date('Y-m-d H:i:s') }}" :disabled="$isEdit && $row->requested_at" />
	</td>
</tr>
<tr>
	<td class="text-right">Requested by <small class='required'>*</small></td>
	<td>
		<x-bss-form.select name="requested_by" required :disabled="$isEdit && $row->requested_by">
			@if (!$isEdit)
				<option value="">Please choose</option>
			@endif
			@foreach ($doctor as $data)
				<option value="{{ $data->id }}" {{ ($row->requested_by ?? false) == $data->id ? 'selected' : '' }} >{{ render_synonyms_name($data->name_en, $data->name_kh) }}</option>
			@endforeach
		</x-bss-form.select>
	</td>
	<td class="text-right">Physician <small class='required'>*</small></td>
	<td>
		<x-bss-form.select name="doctor_id" required :disabled="$isEdit && $row->doctor_id">
			@if (!$isEdit)
				<option value="">Please choose</option>
			@endif
			@foreach ($doctor as $data)
				<option value="{{ $data->id }}" {{ ($row->doctor_id ?? false) == $data->id ? 'selected' : '' }} >{{ render_synonyms_name($data->name_en, $data->name_kh) }}</option>
			@endforeach
		</x-bss-form.select>
	</td>
</tr>
<tr>
	<td class="text-right">Price</td>
	<td colspan="3">
		<span id="amount_label"> {{ $row->amount ?? 0 }} </span> USD
		<input type="hidden" name="amount" value="{{ $row->amount ?? 0 }}" :disabled="$isEdit">
	</td>
</tr>
{!! $slot !!}