<table class="table-form striped">
    <tr>
        <th colspan="4" class="text-left tw-bg-gray-100">Result</th>
    </tr>
</table>
<table class="table-form striped table table-border">
    <tr class="text-center">
        <th class="text-center">N<sup>o</sup<</th>
        <th>Medicine</th>
        <th width="70px">QTY</th>
        <th width="70px">U/D</th>
        <th width="70px">NoD</th>
        <th width="70px">Total</th>
        <th width="70px">Unit</th>
        <th>Usage</th>
        <th width="100px">Usage Time</th>
        <th>Note</th>
        <th class="text-center">Action</th>
    </tr>
    @foreach ($prescription_detail as $row)
        @php
            static $i = 1;
        @endphp
        <input type="hidden" name="test_id[]" value="{{ $row->id }}"/>
        <tr>
            <td class="text-center">{{ $i++ }}</td>
            <td>
                <x-bss-form.select name="medicine_id" required :disabled="!$is_edit">
                    @if (!$is_edit)
                        <option>Please choose</option>
                    @endif
                    @foreach ($medicine as $data)
                        <option value="{{ $data->id }}" {{ ($row->medicine_id ?? false) == $data->id ? 'selected' : '' }} >{{ $data->name }}</option>
                    @endforeach
                </x-bss-form.select>
            </td>
            <td>
                <x-bss-form.input type="number" name='test_value[]' value="{{ $row->qty ?: 0 }}" class="text-center"/>
            </td>
            <td>
                <x-bss-form.input type="number" name='test_value[]' value="{{ $row->upd ?: 0 }}" class="text-center"/>
            </td>
            <td>
                <x-bss-form.input type="number" name='test_value[]' value="{{ $row->nod ?: 0 }}" class="text-center"/>
            </td>
            <td>
                <x-bss-form.input type="number" name='test_value[]' value="{{ $row->total ?: 0 }}" class="text-center" :disabled="true"/>
            </td>
            <td>
                <x-bss-form.input type="number" name='test_value[]' value="{{ $row->unit ?: 0 }}" class="text-center"/>
            </td>
            <td>
                <x-bss-form.select name="usage_id" required data-no_search="true">
                    @if (!$is_edit)
                        <option>Please choose</option>
                    @endif
                    @foreach ($usages as $id => $data)
                        <option value="{{ $id }}" {{ ($row->usage_id ?? false) == $id ? 'selected' : '' }} >{{ $data }}</option>
                    @endforeach
                </x-bss-form.select>
            </td>
            <td>
                @foreach ($time_usage as $id => $data)
                    <label style="display: inline;">
                        <input type="checkbox" {{ in_array($id, explode(',', $row->usage_times ?? [])) ? 'checked' : '' }}>
                        {{ $data }}
                    </label><br>
                @endforeach
            </td>
            <td>
                <x-bss-form.textarea name="diagnosis" rows="3">
                    {{ $row->other }}
                </x-bss-form.textarea>
            </td>
            <td class="text-center">
                <x-form.button color="danger" class="btn-sm" icon="bx bx-trash" onclick="$(this).parents('tr').remove();"/>
            </td>
        </tr>
    @endforeach
    <tr></tr>
</table>