<tr>
	<td width="30%" class="text-right">ECHOGRAPHY</td>
	<td>
		<x-bss-form.input name="echography" :value="old('echography', !empty($row) && $row->echography ? $row->echography : '')"/>
	</td>
</tr>