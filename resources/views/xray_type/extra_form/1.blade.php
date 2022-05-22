<tr>
	<td width="20%" class="text-right">Result</td>
	<td>
		<x-bss-form.textarea name="result" class="my-simple-editor">{{ old('result', !empty($row) && $row->result ? $row->result : '<p>CHEST &nbsp;X-Ray &nbsp; (Normal) &nbsp;</p>

			<p>&nbsp;</p>
			
			<p>&nbsp; INDICATION:</p>
			
			<p>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p>
			
			<p>&nbsp; TECHNIQUE: Posteroanterior projection of the chest X-Ray</p>
			
			<p>&nbsp;</p>
			
			<p>&nbsp; RESULT:</p>
			
			<p>&nbsp; &nbsp; &nbsp;- Thoracic cage is symmetrical.</p>
			
			<p>&nbsp; &nbsp; &nbsp;- There is normal limit and appearance of bony structure of thoracic.</p>
			
			<p>&nbsp; &nbsp; &nbsp;- There is normal appearance of soft tissue structure of thorax.</p>
			
			<p>&nbsp; &nbsp; &nbsp;- There is no evidence of pleural and pulmonary parenchyma lesion of the both sides.</p>
			
			<p>&nbsp; &nbsp; &nbsp;- The cardiothoracic ratio is within normal limit.</p>
			
			<p>&nbsp; &nbsp; &nbsp;- There is normal appearance of both sides diaphragms&nbsp;</p>
			
			<p>&nbsp;&nbsp;</p>
			
			<p>&nbsp; IMPRESSION:</p>
			
			<p>&nbsp; &nbsp; Normal &nbsp;finding &nbsp;of chest X-Ray.&nbsp;</p>
			') }}</x-bss-form.textarea>
	</td>
</tr>