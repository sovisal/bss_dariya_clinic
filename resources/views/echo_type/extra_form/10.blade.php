<tr>
	<td width="30%" class="text-right">Right cevic</td>
	<td>
		<x-bss-form.textarea name="right_cevic" class="my-simple-editor">{{ old('right_cevic', !empty($row) && $row->right_cevic ? $row->right_cevic : '<p>Right cevic normal</p>') }}</x-bss-form.textarea>
	</td>
</tr>
<tr>
	<td width="30%" class="text-right">Left cevic</td>
	<td>
		<x-bss-form.textarea name="left_cevic" class="my-simple-editor">{{ old('left_cevic', !empty($row) && $row->left_cevic ? $row->left_cevic : '<p>left cevic normal</p>') }}</x-bss-form.textarea>
	</td>
</tr>
<tr>
	<td class="text-right">Conclusion</td>
	<td>
		<x-bss-form.input name="conclusion" :value="old('conclusion', !empty($row) && $row->conclusion ? $row->conclusion : '')"/>
	</td>
</tr>