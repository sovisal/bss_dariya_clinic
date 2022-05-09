<tr>
	<td width="30%" class="text-right">ECOGRAPHIE</td>
	<td>
		<x-bss-form.textarea name="ecographie" class="my-simple-editor">{{ old('ecographie', !empty($row) && $row->ecographie ? $row->ecographie : '') }}</x-bss-form.textarea>
	</td>
</tr>
<tr>
	<td class="text-right">Technique : L'examen est realise par voie Transcutanee</td>
	<td>
		<x-bss-form.textarea name="technique" class="my-simple-editor">
			{{ old('technique', !empty($row) && $row->technique ? $row->technique : '<ul><li>Le foie est de taille normale, de contours reguliers, d&#39;echo-strucure homogene.</li><li>Le tronc porte et les veines sus-hepatique sont permeable.</li><li>La vesicule biliaire est de taille normale, a paroi fine et reguliere. Son contenu alithiasique.</li><li>Les voies bliaire intra et extra hepatique ne sont pas dilatees.</li><li>Le pancreas est de taille normale.</li><li>La rate est homogene, de taille normale.</li><li>Les reins de tailles la defferenciation cortico-medullaire bien visible, absence de dilatations des cavites pyelocalicielles.</li><li>La vessie en repletion a paroi fine et d&#39;absence de diverticule ni de calcul.</li><li>Uterus et annexes: Normaux.</li><li>Douglas : libre&nbsp;</li></ul><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; Conclusion : Normale.</p>') }}
		</x-bss-form.textarea>
	</td>
</tr>
<tr>
	<td width="30%" class="text-right">Date</td>
	<td>
		<x-bss-form.input name="date" class="date-picker" hasIcon="right" icon="bx bx-calendar" :value="old('date', !empty($row) && $row->date ? $row->date : '')"/>
	</td>
</tr>