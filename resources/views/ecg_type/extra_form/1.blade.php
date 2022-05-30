<tr>
	<td width="20%" class="text-right">Result</td>
	<td>
		<x-bss-form.textarea name="result" class="my-simple-editor" rows="15">{{ old('result', !empty($row) && $row->result ? $row->result : '') }}</x-bss-form.textarea>
	</td>
</tr>