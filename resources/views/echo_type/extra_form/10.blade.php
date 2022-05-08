<tr>
    <td class="text-right">- The kidneys</td>
    <td>
        <x-bss-form.input name="aaaa" :value="old('aaaa', !empty($row) && $row->aaaa ? $row->aaaa : '')"/>
    </td>
</tr>
<tr>
    <td class="text-right">- Bladder</td>
    <td>
        <x-bss-form.input name="bbbbb" :value="old('bbbbb', !empty($row) && $row->bbbbb ? $row->bbbbb : '')"/>
    </td>
</tr>
<tr>
    <td class="text-right">- Uterus</td>
    <td>
        <x-bss-form.input name="ccccc" :value="old('ccccc', !empty($row) && $row->ccccc ? $row->ccccc : '')"/>
    </td>
</tr>
<tr>
    <td class="text-right">- Endometrium</td>
    <td>
        <x-bss-form.input name="dddd" :value="old('dddd', !empty($row) && $row->dddd ? $row->dddd : '')"/>
    </td>
</tr>
<tr>
    <td class="text-right">- Ovaries</td>
    <td>
        <x-bss-form.input name="eeeee" :value="old('eeeee', !empty($row) && $row->eeeee ? $row->eeeee : '')"/>
    </td>
</tr>
<tr>
    <td class="text-right">*</td>
    <td>
        <x-bss-form.input name="fffff" :value="old('fffff', !empty($row) && $row->fffff ? $row->fffff : '')"/>
    </td>
</tr>
<tr>
    <td class="text-right">IMPRESSION</td>
    <td>
        <x-bss-form.input name="gggg" :value="old('gggg', !empty($row) && $row->gggg ? $row->gggg : '')"/>
    </td>
</tr>