<tr>
    <td width="15%" class="text-right">Form <small class='required'>*</small></td>
    <td>
        <x-bss-form.select name="type" required>
            @if (!$is_edit)
                <option>Please choose</option>
            @endif
            @foreach ($type as $data)
                <option value="{{ $data->id }}" {{ ($row->type ?? false) == $data->id ? 'selected' : '' }} >{{ $data->name_en }}</option>
            @endforeach
        </x-bss-form.select>
    </td>
    <td width="15%" class="text-right">Payment type <small class='required'>*</small></td>
    <td>
        <x-bss-form.select name="payment_type" required>
            @foreach ($payment_type as $id => $data)
                <option value="{{ $id }}" {{ ($row->payment_type ?? false) == $id ? 'selected' : '' }} >{{ $data }}</option>
            @endforeach
        </x-bss-form.select>
    </td>
</tr>
<tr>
    <td class="text-right">Patient name <small class='required'>*</small></td>
    <td>
        <x-bss-form.select name="patient_id" required>
            @if (!$is_edit)
                <option>Please choose patient</option>
            @endif
            @foreach ($patient as $data)
                <option value="{{ $data->id }}" {{ ($row->patient_id ?? false) == $data->id ? 'selected' : '' }} >{{ $data->name_en }}</option>
            @endforeach
        </x-bss-form.select>
    </td>
    <td class="text-right">Requested date <small class='required'>*</small></td>
    <td>
        <input type="date" name="requested_at" required>
    </td>
</tr>
<tr>
    <td class="text-right">Requested by <small class='required'>*</small></td>
    <td>
        <x-bss-form.select name="requested_by" required>
            @if (!$is_edit)
                <option>Please choose</option>
            @endif
            @foreach ($doctor as $data)
                <option value="{{ $data->id }}" {{ ($row->requested_by ?? false) == $data->id ? 'selected' : '' }} >{{ $data->name_en }}</option>
            @endforeach
        </x-bss-form.select>
    </td>
    <td class="text-right">Physician <small class='required'>*</small></td>
    <td>
        <x-bss-form.select name="doctor_id" required>
            @if (!$is_edit)
                <option>Please choose</option>
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
        1000 USD
        <input type="hidden" name="amount" value="1000">
    </td>
</tr>
<tr>
    <td class="text-right">Image(First)</td>
    <td>
        <x-bss-form.input name="name_en" :value="old('name_en')" required type="file" />
    </td>
    <td class="text-right">Image (Second)</td>
    <td>
        <x-bss-form.input name="name_en" :value="old('name_en')" required type="file" />
    </td>
</tr>