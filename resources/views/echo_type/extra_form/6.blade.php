<tr>
	<td width="30%" class="text-right">Liver</td>
	<td>
		<x-bss-form.textarea name="liver" class="my-simple-editor">{{ old('liver', !empty($row) && $row->liver ? $row->liver : '<p>normal of size, homogeneous, echo structure has a big nodular </p><p>diameter~60,6mm x 63,9mm in right lobe .</p><p>No dilatation of the intra hepatic bile duct is seen, the common bile duct is normal in diameter</p><p>The diameter of the aorta is normal and no aneurysms are seen.</p>') }}</x-bss-form.textarea>
	</td>
</tr>
<tr>
	<td class="text-right">- The thickness of the gallbladder wall</td>
	<td>
		<x-bss-form.input name="thickness_of_gallbladder_wall" :value="old('thickness_of_gallbladder_wall', !empty($row) && $row->thickness_of_gallbladder_wall ? $row->thickness_of_gallbladder_wall : 'is normal. The size of the bile ducts between the gallbladder is normal. No gallstones are seen.')"/>
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
		<x-bss-form.input name="bladder" :value="old('bladder', !empty($row) && $row->bladder ? $row->bladder : 'moderately full of urine with thin wall. No intra vesicle lesion or calculi are presence')"/>
	</td>
</tr>
<tr>
	<td class="text-right">- Uterus</td>
	<td>
		<x-bss-form.input name="uterus" :value="old('uterus', !empty($row) && $row->uterus ? $row->uterus : 'Anteverted, DAP= 38mm, L= 60mm, homogeneous structure')"/>
	</td>
</tr>
<tr>
	<td class="text-right">- Endometrium</td>
	<td>
		<x-bss-form.input name="endometrium" :value="old('endometrium', !empty($row) && $row->endometrium ? $row->endometrium : 'thin and regular.')"/>
	</td>
</tr>
<tr>
	<td class="text-right">- Ovaries</td>
	<td>
		<x-bss-form.input name="ovaries" :value="old('ovaries', !empty($row) && $row->ovaries ? $row->ovaries : 'normal')"/>
	</td>
</tr>
<tr>
	<td class="text-right">*</td>
	<td>
		<x-bss-form.input name="star1" :value="old('star1', !empty($row) && $row->star1 ? $row->star1 : 'No intra abdominal lymphadenopathy or free intraperitoneal fluid is demonstrated.')"/>
	</td>
</tr>
<tr>
	<td class="text-right">- Colon</td>
	<td>
		<x-bss-form.input name="colon" :value="old('colon', !empty($row) && $row->colon ? $row->colon : 'Wall thick ness and diameter 4,5mm with inter wall surface is irregular')"/>
	</td>
</tr>
<tr>
	<td class="text-right">*</td>
	<td>
		<x-bss-form.input name="star2" :value="old('star2', !empty($row) && $row->star2 ? $row->star2 : 'She has a few mesenteric adenopathy and size is verity.')"/>
	</td>
</tr>
<tr>
	<td class="text-right">IMPRESSION</td>
	<td>
		<x-bss-form.textarea name="impression" class="my-simple-editor">{{ old('impression', !empty($row) && $row->impression ? $row->impression : '<p>- CHC</p><p>- COLON TUMOUR</p><p>- ABDOMINO - ADENOPATHY</p>') }}</x-bss-form.textarea>
	</td>
</tr>