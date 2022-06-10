<tr>
    <td class="text-right">Patient name <small class='required'>*</small></td>
    <td>
        <x-bss-form.select name="patient_id" required :disabled="$is_edit && $row->patient_id">
            @if (!$is_edit)
                <option value="">Please choose patient</option>
            @endif
            @foreach ($patient as $data)
                <option value="{{ $data->id }}" {{ ($row->patient_id ?? false) == $data->id ? 'selected' : '' }}>{{ render_synonyms_name($data->name_en, $data->name_kh) }}</option>
            @endforeach
        </x-bss-form.select>
    </td>
    <td width="15%" class="text-right">Payment type <small class='required'>*</small></td>
    <td>
        <x-bss-form.select name="payment_type" data-no_search="true" required :disabled="$is_edit && $row->payment_type">
            @foreach ($payment_type as $id => $data)
                <option value="{{ $id }}" {{ ($row->payment_type ?? false) == $id ? 'selected' : '' }}>{{ $data }}</option>
            @endforeach
        </x-bss-form.select>
    </td>
</tr>
<tr>
    <td class="text-right">Age <small class='required'>*</small></td>
    <td>
        <x-bss-form.input name='age' value="{{ $row->age ?? '' }}" required :disabled="$is_edit && $row->age"/>
    </td>
    <td width="15%" class="text-right">Gender <small class='required'>*</small></td>
    <td>
        <x-bss-form.select name="gender" data-no_search="true" required :disabled="$is_edit && $row->gender">
            <option value="">---- None ----</option>
            @foreach ($gender as $id => $data)
                <option value="{{ $id }}" {{ ($row->gender ?? false) == $id ? 'selected' : '' }}>{{ $data }}</option>
            @endforeach
        </x-bss-form.select>
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
                <option value="{{ $data->id }}" {{ ($row->requested_by ?? auth()->user()->doctor ?? false) == $data->id ? 'selected' : '' }} >{{ render_synonyms_name($data->name_en, $data->name_kh) }}</option>
            @endforeach
        </x-bss-form.select>
    </td>
    <td class="text-right">Analysis by</td>
    <td>
        <x-bss-form.select name="doctor_id" :disabled="$is_edit && $row->doctor_id">
            <option value="">Please choose</option>
            @foreach ($doctor as $data)
                <option value="{{ $data->id }}" {{ ($row->doctor_id ?? false) == $data->id ? 'selected' : '' }} >{{ render_synonyms_name($data->name_en, $data->name_kh) }}</option>
            @endforeach
        </x-bss-form.select>
    </td>
</tr>
<tr>
    <td class="text-right">Requested date <small class='required'>*</small></td>
    <td>
        <x-bss-form.input name='requested_at' class="date-time-picker" hasIcon="right" icon="bx bx-calendar" value="{{ $row->requested_at ?? date('Y-m-d H:i:s') }}" required :disabled="$is_edit"/>
    </td>
    <td class="text-right">Analysis date</td>
    <td>
        <x-bss-form.input name='analysis_at' class="date-time-picker" hasIcon="right" icon="bx bx-calendar" value="{{ $row->analysis_at ?? null }}" />
    </td>
</tr>
<tr>
    <td class="text-right">Price</td>
    <td colspan="3">
        <span id="amount_label"> {{ $row->amount ?? 0 }} </span> USD
        <input type="hidden" name="amount" value="{{ $row->amount ?? 0 }}">
    </td>
</tr>
<tr>
    <td class="text-right">Result</td>
    <td>
        <x-bss-form.textarea name="result">
            {{ $row->result ?? '' }}
        </x-bss-form.textarea>
    </td>
    <td class="text-right">Diagnosis</td>
    <td colspan="3">
        <x-bss-form.textarea name="diagnosis">
            {{ $row->diagnosis ?? '' }}
        </x-bss-form.textarea>
    </td>
</tr>
<tr>
    <td class="text-right">Sample</td>
    <td>
        <x-bss-form.input name='sample' value="{{ $row->sample ?? '' }}" />
    </td>
</tr>