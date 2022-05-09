<tr>
	<td width="30%" class="text-right">NECK</td>
	<td>
		<x-bss-form.input name="neck" :value="old('neck', !empty($row) && $row->neck ? $row->neck : '')"/>
	</td>
</tr>
<tr>
	<td class="text-right">IMPRESSION</td>
	<td>
		<x-bss-form.input name="impression" :value="old('impression', !empty($row) && $row->impression ? $row->impression : '')"/>
	</td>
</tr>