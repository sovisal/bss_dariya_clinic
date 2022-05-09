<tr>
	<td width="30%" class="text-right">Right Breast</td>
	<td>
		<x-bss-form.textarea name="right_breast" class="my-simple-editor">{{ old('right_breast', !empty($row) && $row->right_breast ? $row->right_breast : '<p>Right Breast presence a mass diameter ~ 12 cm x 10 cm</p>') }}</x-bss-form.textarea>
	</td>
</tr>
<tr>
	<td width="30%" class="text-right">Left Breast</td>
	<td>
		<x-bss-form.textarea name="left_breast" class="my-simple-editor">{{ old('left_breast', !empty($row) && $row->left_breast ? $row->left_breast : '<p>Left Breast No abnormality</p>') }}</x-bss-form.textarea>
	</td>
</tr>
<tr>
	<td class="text-right">Conclusion</td>
	<td>
		<x-bss-form.input name="conclusion" :value="old('conclusion', !empty($row) && $row->conclusion ? $row->conclusion : '')"/>
	</td>
</tr>