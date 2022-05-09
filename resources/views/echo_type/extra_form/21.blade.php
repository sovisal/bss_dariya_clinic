<tr>
	<td width="30%" class="text-right">KNEE</td>
	<td>
		<x-bss-form.input name="knee" :value="old('knee', !empty($row) && $row->knee ? $row->knee : '')"/>
	</td>
</tr>
<tr>
	<td class="text-right">IMPRESSION</td>
	<td>
		<x-bss-form.input name="impression" :value="old('impression', !empty($row) && $row->impression ? $row->impression : '')"/>
	</td>
</tr>