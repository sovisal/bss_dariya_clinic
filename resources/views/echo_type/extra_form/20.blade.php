<tr>
	<td width="30%" class="text-right">Liver</td>
	<td>
		<x-bss-form.textarea name="liver" class="my-simple-editor">{{ old('liver', !empty($row) && $row->liver ? $row->liver : '<p>Enlarge  of size diameter = 147.2mm , homogeneous, echo structure no focal lesion is seen. No dilatation of the intra hepatic bile duct is seen, the common bile duct is normal in diameter</p><p>The diameter of the aorta is normal and no aneurysms are seen.</p>') }}</x-bss-form.textarea>
	</td>
</tr>
<tr>
	<td class="text-right">- Inferior Cava vein</td>
	<td>
		<x-bss-form.input name="inferior_cave_vein" :value="old('inferior_cave_vein', !empty($row) && $row->inferior_cave_vein ? $row->inferior_cave_vein : 'is dilated of diameter =24.1mm')"/>
	</td>
</tr>
<tr>
	<td class="text-right">- The thickness of the gallbladder wall</td>
	<td>
		<x-bss-form.input name="thickness_of_gallbladder_wall" :value="old('thickness_of_gallbladder_wall', !empty($row) && $row->thickness_of_gallbladder_wall ? $row->thickness_of_gallbladder_wall : 'is normal. No gallstones are seen.')"/>
	</td>
</tr>
<tr>
	<td class="text-right">- Pancreas and spleen</td>
	<td>
		<x-bss-form.input name="pancreas_and_spleen" :value="old('pancreas_and_spleen', !empty($row) && $row->pancreas_and_spleen ? $row->pancreas_and_spleen : 'appear normal in size and texture.')"/>
	</td>
</tr>
<tr>
	<td class="text-right">- The kidneys</td>
	<td>
		<x-bss-form.input name="kidneys" :value="old('kidneys', !empty($row) && $row->kidneys ? $row->kidneys : 'appear as sharply outlined bean-shaped organs. No kidney stones are seen. No blockage to the system draining the kidneys is present.')"/>
	</td>
</tr>
<tr>
	<td class="text-right">- Bladder</td>
	<td>
		<x-bss-form.input name="bladder" :value="old('bladder', !empty($row) && $row->bladder ? $row->bladder : 'moderately full of urine with thin wall.  No intra vesicle lesion or calculi are presence.')"/>
	</td>
</tr>
<tr>
	<td class="text-right">- Prostate</td>
	<td>
		<x-bss-form.input name="prostate" :value="old('prostate', !empty($row) && $row->prostate ? $row->prostate : 'Normal of size, homogeneous structure, no lesion is seen ')"/>
	</td>
</tr>
<tr>
	<td class="text-right">*</td>
	<td>
		<x-bss-form.input name="star1" :value="old('star1', !empty($row) && $row->star1 ? $row->star1 : 'No abnormal growths are seen. No fluid is found in the abdomen.')"/>
	</td>
</tr>
<tr>
	<td class="text-right">IMPRESSION</td>
	<td>
		<x-bss-form.input name="impression" :value="old('impression', !empty($row) && $row->impression ? $row->impression : 'HEART FAILURE')"/>
	</td>
</tr>