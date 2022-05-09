<tr>
	<td width="30%" class="text-right">Droit</td>
	<td>
		<x-bss-form.input name="droit" :value="old('droit', !empty($row) && $row->droit ? $row->droit : 'Normale')"/>
	</td>
</tr>
<tr>
	<td class="text-right">Gauche</td>
	<td>
		<x-bss-form.input name="gauche" :value="old('gauche', !empty($row) && $row->gauche ? $row->gauche : 'Présence d’1 kyste diamètre ~6mmx6.2mm au niveau inférieur Adénopathie sous axillaire bilatérale sont libre .')"/>
	</td>
</tr>
<tr>
	<td class="text-right">IMPRESSION</td>
	<td>
		<x-bss-form.input name="impression" :value="old('impression', !empty($row) && $row->impression ? $row->impression : 'Kyste du sein gauche ')"/>
	</td>
</tr>