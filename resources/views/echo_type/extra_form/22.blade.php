<tr>
	<td width="30%" class="text-right">Left breast presence a mass diameter</td>
	<td>
		<x-bss-form.input name="left_breast_presence" :value="old('left_breast_presence', !empty($row) && $row->left_breast_presence ? $row->left_breast_presence : '34.59mm x 13mm')"/>
	</td>
</tr>
<tr>
	<td class="text-right">IMPRESSION</td>
	<td>
		<x-bss-form.input name="impression" :value="old('impression', !empty($row) && $row->impression ? $row->impression : 'Left breast cyst')"/>
	</td>
</tr>