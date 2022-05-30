<tr>
    <td width="20%" class="text-right">Detail</td>
    <td>
        <x-bss-form.textarea name="default_form" rows="15">
            {{ old('other', !empty($row) && $row->default_form ? $row->default_form : '') }}
        </x-bss-form.textarea>
    </td>
</tr>