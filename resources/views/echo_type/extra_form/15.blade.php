<tr>
	<td width="30%" class="text-right"><small class="required">*</small> MOTIF</td>
	<td>
		<x-bss-form.input name="motif" :value="old('motif', !empty($row) && $row->motif ? $row->motif : '')" required/>
	</td>
</tr>
<tr>
	<td class="text-right"><small class="required">*</small> MESURE</td>
	<td>
		<x-bss-form.textarea name="measure" class="my-simple-editor" required>
			{{ old('measure', !empty($row) && $row->measure ? $row->measure : '<ul><li>&nbsp;Aorte initiale (Aorta: 20-37mm):21mm</li><li>Oreillette gauche (LA: 18-40mm):30mm, pas de thrombus ni de contraste spontane visible, SIV :8mm PP mm</li></ul><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; DTDVG (LVDTd: 38-56mm): 45 mm</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; DTSVG (LVDTs: 22-40mm): 35 mm</p><ul><li>&nbsp; &nbsp; Fraction du raccourcissement (FS:28-42%):30 %</li><li>&nbsp; &nbsp; Fraction dejection (EF:65%):60%</li><li>&nbsp; &nbsp; Fonction diastolique: (E:85cm/s) cm/s,(A:60cm/s) (E/A:1,5):(TD: 193ms): ms,(TRIV: 70ms)</li><li>&nbsp; &nbsp; Ventricule droit (RV: 7-23mm): Normale&nbsp;</li><li>&nbsp; &nbsp; Pericarde: Sec</li><li>&nbsp; &nbsp; Cinetique: Normale&nbsp;</li><li>&nbsp; &nbsp; Valve mitrale&nbsp;</li></ul><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; - Non remanieer pas de fuite ni de stenose&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; - Pic E0.0.5m/s, A 0.42m/s et VTI 15cm</p><ul><li>&nbsp; &nbsp; Valve aortique&nbsp;</li></ul><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; - Non remanieer,pas de fuite ni de stenose&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; - Pic E0.0.59m/s, VTI 15cm</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pic 0.77m/s et VTI 18cm</p><ul><li>&nbsp; &nbsp; Valve tricuspide: Normale&nbsp;</li></ul>') }}
		</x-bss-form.textarea>
	</td>
</tr>
<tr>
	<td class="text-right">DESCRIPTION</td>
	<td>
		<x-bss-form.textarea name="description" class="my-simple-editor">
			{{ old('description', !empty($row) && $row->description ? $row->description : '<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; - Les cavites cardiaques ne sont pas dilatees&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; - Fonction systolique du VG est conserve&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; - Cinetique est normale</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; - Pas de valvulolastie ni de shunt visible&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; - Flux mitral est normal</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; - Pericade: sec</p>') }}
		</x-bss-form.textarea>
	</td>
</tr>
<tr>
	<td class="text-right"><small class="required">*</small> CONCLUSION</td>
	<td>
		<x-bss-form.textarea name="conslusion" class="my-simple-editor" required>{{ old('conslusion', !empty($row) && $row->conslusion ? $row->conslusion : '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;Coeur normale') }}</x-bss-form.textarea>
	</td>
</tr>
<tr>
	<td width="30%" class="text-right">Date</td>
	<td>
		<x-bss-form.input name="date" class="date-picker" hasIcon="right" icon="bx bx-calendar" :value="old('date', !empty($row) && $row->date ? $row->date : '')"/>
	</td>
</tr>