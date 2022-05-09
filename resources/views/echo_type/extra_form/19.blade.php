<tr>
	<td width="30%" class="text-right">Thyroid</td>
	<td>
		<x-bss-form.input name="thyroid" :value="old('thyroid', !empty($row) && $row->thyroid ? $row->thyroid : 'left has enlagement dimate ` ~ 22.42mm x 35.31mm ')"/>
	</td>
</tr>
<tr>
	<td class="text-right">IMPRESSION</td>
	<td>
		<x-bss-form.input name="impression" :value="old('impression', !empty($row) && $row->impression ? $row->impression : 'Goiter')"/>
	</td>
</tr>