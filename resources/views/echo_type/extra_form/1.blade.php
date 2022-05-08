<tr>
    <td width="30%" class="text-right">Liver</td>
    <td>
        <x-bss-form.input name="hhhh" :value="old('hhhh', !empty($row) && $row->hhhh ? $row->hhhh : '')"/>
    </td>
</tr>
<tr>
    <td class="text-right">- The thickness of the gallbladder wall</td>
    <td>
        <x-bss-form.input name="iiiii" :value="old('iiiii', !empty($row) && $row->iiiii ? $row->iiiii : '')"/>
    </td>
</tr>