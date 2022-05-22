<table class="table-form striped">
    <tr>
        <td class="text-right">Evaluation Summary</td>
        <td>
            <x-bss-form.textarea name="evaluation_summary">{{ $consultation->evaluation_summary }}</x-bss-form.textarea>
        </td>
    </tr>
    <tr>
        <td class="text-right">Category</td>
        <td>
            <x-bss-form.select name="evaluation_category" id="evaluation_category">
                <option value="">Select Category</option>
                @foreach ($evaluation_categories as $id => $evaluation_category)
                    <option value="{{ $id }}" {{ ((old('evaluation_category', $consultation->evaluation_category) == $id)? 'selected' : '') }}>{{ $evaluation_category }}</option>
                @endforeach
            </x-bss-form.select>
        </td>
    </tr>
    <tr>
        <td class="text-right">Indication</td>
        <td>
            <x-bss-form.select name="evaluation_indication" id="evaluation_indication">
                <option value="">Select Disease</option>
                @foreach ($indication_diseases as $id => $data)
                    <option value="{{ $id }}" {{ ((old('evaluation_category', $consultation->evaluation_indication) == $id)? 'selected' : '') }}>{{ $data }}</option>
                @endforeach
            </x-bss-form.select>
        </td>
    </tr>
    <tr>
        <td class="text-right">Information Diagnosis <small class="required">*</small></td>
        <td>
            <x-bss-form.textarea name="evaluation_information_diagnosis" rows="4" required>{{ $consultation->evaluation_information_diagnosis }}</x-bss-form.textarea>
        </td>
    </tr>
</table>