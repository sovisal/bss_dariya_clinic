<tr>
	<td width="30%" class="text-right">Tumefaction</td>
	<td>
		<x-bss-form.input name="tumefaction" :value="old('tumefaction', !empty($row) && $row->tumefaction ? $row->tumefaction : 'on left inguinal with air and movement diameter 15.6mm of thickness.')"/>
	</td>
</tr>
<tr>
	<td width="30%" class="text-right">IMPRESSION</td>
	<td>
		<x-bss-form.input name="impression" :value="old('impression', !empty($row) && $row->impression ? $row->impression : '')"/>
	</td>
</tr>