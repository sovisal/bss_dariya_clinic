<tr>
	<td width="30%" class="text-right">THYROID GLAND</td>
	<td>
		<x-bss-form.input name="thyroid_gland" :value="old('thyroid_gland', !empty($row) && $row->thyroid_gland ? $row->thyroid_gland : '')"/>
	</td>
</tr>