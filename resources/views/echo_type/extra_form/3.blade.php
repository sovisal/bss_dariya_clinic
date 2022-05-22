<tr>
	<td width="30%" class="text-right">ទារកមានចំនួន</td>
	<td>
		<x-bss-form.input name="baby_count" :value="old('baby_count', !empty($row) && $row->baby_count ? $row->baby_count : '')"/>
	</td>
</tr>
<tr>
	<td width="30%" class="text-right">ភេទ</td>
	<td>
		<x-bss-form.select name="gender">
			<option value="ប្រុស" {{ ((old('gender', $row->gender) == 'ប្រុស')? 'selected' : '') }}>ប្រុស</option>
			<option value="ស្រី" {{ ((old('gender', $row->gender) == 'ស្រី')? 'selected' : '') }}>ស្រី</option>
			<option value="ស្រី១ប្រុស១" {{ ((old('gender', $row->gender) == 'ស្រី១ប្រុស១')? 'selected' : '') }}>ស្រី១ប្រុស១</option>
			<option value="ស្រី២" {{ ((old('gender', $row->gender) == 'ស្រី២')? 'selected' : '') }}>ស្រី២</option>
			<option value="ប្រុស២" {{ ((old('gender', $row->gender) == 'ប្រុស២')? 'selected' : '') }}>ប្រុស២</option>
			<option value="-" {{ ((old('gender', $row->gender) == '-')? 'selected' : '') }}>-</option>
		</x-bss-form.select>
	</td>
</tr>
<tr>
	<td width="30%" class="text-right">មានទំរង់ក្បាល</td>
	<td>
		<x-bss-form.select name="head_formation">
			<option value="ខាងលើ" {{ ((old('head_formation', $row->head_formation) == 'ខាងលើ')? 'selected' : '') }}>ខាងលើ</option>
			<option value="ខាងក្រោម" {{ ((old('head_formation', $row->head_formation) == 'ខាងក្រោម')? 'selected' : '') }}>ខាងក្រោម</option>
			<option value="ទទឺងខាងឆ្វេង" {{ ((old('head_formation', $row->head_formation) == 'ទទឺងខាងឆ្វេង')? 'selected' : '') }}>ទទឺងខាងឆ្វេង</option>
			<option value="ទទឺងខាងស្ដាំ" {{ ((old('head_formation', $row->head_formation) == 'ទទឺងខាងស្ដាំ')? 'selected' : '') }}>ទទឺងខាងស្ដាំ</option>
			<option value="-" {{ ((old('head_formation', $row->head_formation) == '-')? 'selected' : '') }}>-</option>
		</x-bss-form.select>
	</td>
</tr>
<tr>
	<td width="30%" class="text-right">មានចលនាបំរះ</td>
	<td>
		<x-bss-form.select name="baby_movement">
			<option value="ធម្មតា" {{ ((old('baby_movement', $row->baby_movement) == 'ធម្មតា')? 'selected' : '') }}>ធម្មតា</option>
			<option value="ខ្សោយ" {{ ((old('baby_movement', $row->baby_movement) == 'ខ្សោយ')? 'selected' : '') }}>ខ្សោយ</option>
			<option value="អត់" {{ ((old('baby_movement', $row->baby_movement) == 'អត់')? 'selected' : '') }}>អត់</option>
			<option value="-" {{ ((old('baby_movement', $row->baby_movement) == '-')? 'selected' : '') }}>-</option>
		</x-bss-form.select>
	</td>
</tr>
<tr>
	<td class="text-right">ចលនាបេះដូង</td>
	<td>
		<div class="row">
			<div class="col-sm-4">
				<x-bss-form.input name="heart_rate" class="is_number" :value="old('heart_rate', !empty($row) && $row->heart_rate ? $row->heart_rate : '')"/>
			</div>
			<div class="col-sm-4 pl-0">
				<x-bss-form.select name="heart_rate_unit">
					<option value="ដង/នាទី" {{ ((old('heart_rate_unit', $row->heart_rate_unit) == 'ដង/នាទី')? 'selected' : '') }}>ដង/នាទី</option>
					<option value="-" {{ ((old('heart_rate_unit', $row->heart_rate_unit) == '-')? 'selected' : '') }}>-</option>
				</x-bss-form.select>
			</div>
		</div>
	</td>
</tr>
<tr>
	<td width="30%" class="text-right">ឆ្អឹងក្បាល</td>
	<td>
		<x-bss-form.select name="skull">
			<option value="ធម្មតា" {{ ((old('skull', $row->skull) == 'ធម្មតា')? 'selected' : '') }}>ធម្មតា</option>
			<option value="មិនធម្មតា" {{ ((old('skull', $row->skull) == 'មិនធម្មតា')? 'selected' : '') }}>មិនធម្មតា</option>
			<option value="-" {{ ((old('skull', $row->skull) == '-')? 'selected' : '') }}>-</option>
		</x-bss-form.select>
	</td>
</tr>
<tr>
	<td width="30%" class="text-right">កញ្ចឹងក</td>
	<td>
		<x-bss-form.select name="baby_neck">
			<option value="ធម្មតា" {{ ((old('baby_neck', $row->baby_neck) == 'ធម្មតា')? 'selected' : '') }}>ធម្មតា</option>
			<option value="មិនធម្មតា" {{ ((old('baby_neck', $row->baby_neck) == 'មិនធម្មតា')? 'selected' : '') }}>មិនធម្មតា</option>
			<option value="-" {{ ((old('baby_neck', $row->baby_neck) == '-')? 'selected' : '') }}>-</option>
		</x-bss-form.select>
	</td>
</tr>
<tr>
	<td width="30%" class="text-right">ឆ្អឹងខ្នង</td>
	<td>
		<x-bss-form.select name="spine">
			<option value="ធម្មតា" {{ ((old('spine', $row->spine) == 'ធម្មតា')? 'selected' : '') }}>ធម្មតា</option>
			<option value="មិនធម្មតា" {{ ((old('spine', $row->spine) == 'មិនធម្មតា')? 'selected' : '') }}>មិនធម្មតា</option>
			<option value="-" {{ ((old('spine', $row->spine) == '-')? 'selected' : '') }}>-</option>
		</x-bss-form.select>
	</td>
</tr>
<tr>
	<td width="30%" class="text-right">បបូរមាត់</td>
	<td>
		<x-bss-form.select name="lip">
			<option value="ធម្មតា" {{ ((old('lip', $row->lip) == 'ធម្មតា')? 'selected' : '') }}>ធម្មតា</option>
			<option value="មិនធម្មតា" {{ ((old('lip', $row->lip) == 'មិនធម្មតា')? 'selected' : '') }}>មិនធម្មតា</option>
			<option value="-" {{ ((old('lip', $row->lip) == '-')? 'selected' : '') }}>-</option>
		</x-bss-form.select>
	</td>
</tr>
<tr>
	<td width="30%" class="text-right">ប្លោកនោម</td>
	<td>
		<x-bss-form.select name="baby_bladder">
			<option value="ធម្មតា" {{ ((old('baby_bladder', $row->baby_bladder) == 'ធម្មតា')? 'selected' : '') }}>ធម្មតា</option>
			<option value="មិនធម្មតា" {{ ((old('baby_bladder', $row->baby_bladder) == 'មិនធម្មតា')? 'selected' : '') }}>មិនធម្មតា</option>
			<option value="-" {{ ((old('baby_bladder', $row->baby_bladder) == '-')? 'selected' : '') }}>-</option>
		</x-bss-form.select>
	</td>
</tr>
<tr>
	<td width="30%" class="text-right">ផ្ចិត(ផ្ទៃពោះ)</td>
	<td>
		<x-bss-form.select name="umbilical_cord_pregnancy">
			<option value="ធម្មតា" {{ ((old('umbilical_cord_pregnancy', $row->umbilical_cord_pregnancy) == 'ធម្មតា')? 'selected' : '') }}>ធម្មតា</option>
			<option value="មិនធម្មតា" {{ ((old('umbilical_cord_pregnancy', $row->umbilical_cord_pregnancy) == 'មិនធម្មតា')? 'selected' : '') }}>មិនធម្មតា</option>
			<option value="-" {{ ((old('umbilical_cord_pregnancy', $row->umbilical_cord_pregnancy) == '-')? 'selected' : '') }}>-</option>
		</x-bss-form.select>
	</td>
</tr>
<tr>
	<td width="30%" class="text-right">អវៈយវៈ</td>
	<td>
		<x-bss-form.select name="limbs">
			<option value="ធម្មតា" {{ ((old('limbs', $row->limbs) == 'ធម្មតា')? 'selected' : '') }}>ធម្មតា</option>
			<option value="មិនធម្មតា" {{ ((old('limbs', $row->limbs) == 'មិនធម្មតា')? 'selected' : '') }}>មិនធម្មតា</option>
			<option value="-" {{ ((old('limbs', $row->limbs) == '-')? 'selected' : '') }}>-</option>
		</x-bss-form.select>
	</td>
</tr>
<tr>
	<td class="text-right">ប្រវែងទទឹងក្បាល</td>
	<td>
		<div class="row">
			<div class="col-sm-4">
				<x-bss-form.input name="head_width" class="is_number" :value="old('head_width', !empty($row) && $row->head_width ? $row->head_width : '')"/>
			</div>
			<div class="col-sm-4 pl-0">
				<x-bss-form.select name="head_width_unit">
					<option value="មម" {{ ((old('head_width_unit', $row->head_width_unit) == 'មម')? 'selected' : '') }}>មម</option>
					<option value="-" {{ ((old('head_width_unit', $row->head_width_unit) == '-')? 'selected' : '') }}>-</option>
				</x-bss-form.select>
			</div>
		</div>
	</td>
</tr>
<tr>
	<td class="text-right">ប្រវែងរង្វង់ក្បាល</td>
	<td>
		<div class="row">
			<div class="col-sm-4">
				<x-bss-form.input name="head_circumference" class="is_number" :value="old('head_circumference', !empty($row) && $row->head_circumference ? $row->head_circumference : '')"/>
			</div>
			<div class="col-sm-4 pl-0">
				<x-bss-form.select name="head_circumference_unit">
					<option value="មម" {{ ((old('head_circumference_unit', $row->head_circumference_unit) == 'មម')? 'selected' : '') }}>មម</option>
					<option value="-" {{ ((old('head_circumference_unit', $row->head_circumference_unit) == '-')? 'selected' : '') }}>-</option>
				</x-bss-form.select>
			</div>
		</div>
	</td>
</tr>
<tr>
	<td class="text-right">ប្រវែងរង្វង់ពោះ</td>
	<td>
		<div class="row">
			<div class="col-sm-4">
				<x-bss-form.input name="abdominal_circumference" class="is_number" :value="old('abdominal_circumference', !empty($row) && $row->abdominal_circumference ? $row->abdominal_circumference : '')"/>
			</div>
			<div class="col-sm-4 pl-0">
				<x-bss-form.select name="abdominal_circumference_unit">
					<option value="មម" {{ ((old('abdominal_circumference_unit', $row->abdominal_circumference_unit) == 'មម')? 'selected' : '') }}>មម</option>
					<option value="-" {{ ((old('abdominal_circumference_unit', $row->abdominal_circumference_unit) == '-')? 'selected' : '') }}>-</option>
				</x-bss-form.select>
			</div>
		</div>
	</td>
</tr>
<tr>
	<td class="text-right">ប្រវែងឆ្អឹងភ្លៅ</td>
	<td>
		<div class="row">
			<div class="col-sm-4">
				<x-bss-form.input name="thigh_length" class="is_number" :value="old('thigh_length', !empty($row) && $row->thigh_length ? $row->thigh_length : '')"/>
			</div>
			<div class="col-sm-4 pl-0">
				<x-bss-form.select name="thigh_length_unit">
					<option value="មម" {{ ((old('thigh_length_unit', $row->thigh_length_unit) == 'មម')? 'selected' : '') }}>មម</option>
					<option value="-" {{ ((old('thigh_length_unit', $row->thigh_length_unit) == '-')? 'selected' : '') }}>-</option>
				</x-bss-form.select>
			</div>
		</div>
	</td>
</tr>
<tr>
	<td width="30%" class="text-right">សុកមានទីតាំងនៅ</td>
	<td>
		<x-bss-form.select name="placenta_location">
			<option value="ខាងក្រោយ" {{ ((old('placenta_location', $row->placenta_location) == 'ខាងក្រោយ')? 'selected' : '') }}>ខាងក្រោយ</option>
			<option value="ខាងមុខ" {{ ((old('placenta_location', $row->placenta_location) == 'ខាងមុខ')? 'selected' : '') }}>ខាងមុខ</option>
			<option value="បាតស្បូន" {{ ((old('placenta_location', $row->placenta_location) == 'បាតស្បូន')? 'selected' : '') }}>បាតស្បូន</option>
			<option value="ពាំងមាតស្បូនខាងមុខកំរិតទី" {{ ((old('placenta_location', $row->placenta_location) == 'ពាំងមាតស្បូនខាងមុខកំរិតទី')? 'selected' : '') }}>ពាំងមាតស្បូនខាងមុខកំរិតទី</option>
			<option value="ពាំងមាតស្បូនខាងក្រោយកំរិតទី" {{ ((old('placenta_location', $row->placenta_location) == 'ពាំងមាតស្បូនខាងក្រោយកំរិតទី')? 'selected' : '') }}>ពាំងមាតស្បូនខាងក្រោយកំរិតទី</option>
			<option value="-" {{ ((old('placenta_location', $row->placenta_location) == '-')? 'selected' : '') }}>-</option>
		</x-bss-form.select>
	</td>
</tr>
<tr>
	<td width="30%" class="text-right">ទឹកភ្លោះមានបរិមាណ</td>
	<td>
		<x-bss-form.select name="amniotic_fluid_quantity">
			<option value="ធម្មតា" {{ ((old('amniotic_fluid_quantity', $row->amniotic_fluid_quantity) == 'ធម្មតា')? 'selected' : '') }}>ធម្មតា</option>
			<option value="ច្រើន" {{ ((old('amniotic_fluid_quantity', $row->amniotic_fluid_quantity) == 'ច្រើន')? 'selected' : '') }}>ច្រើន</option>
			<option value="តិច" {{ ((old('amniotic_fluid_quantity', $row->amniotic_fluid_quantity) == 'តិច')? 'selected' : '') }}>តិច</option>
			<option value="-" {{ ((old('amniotic_fluid_quantity', $row->amniotic_fluid_quantity) == '-')? 'selected' : '') }}>-</option>
		</x-bss-form.select>
	</td>
</tr>
<tr>
	<td class="text-right">គក៌មានអាយុ</td>
	<td>
		<div class="row">
			<div class="col-sm-4">
				<x-bss-form.input name="pregnancy_age1" class="is_number" :value="old('pregnancy_age1', !empty($row) && $row->pregnancy_age1 ? $row->pregnancy_age1 : '')"/>
			</div>
			<div class="col-sm-4 pl-0">
				<x-bss-form.select name="pregnancy_age1_unit">
					<option value="week" {{ ((old('pregnancy_age1_unit', $row->pregnancy_age1_unit) == 'សប្ដាហ៍')? 'selected' : '') }}>សប្ដាហ៍</option>
					<option value="-" {{ ((old('pregnancy_age1_unit', $row->pregnancy_age1_unit) == '-')? 'selected' : '') }}>-</option>
				</x-bss-form.select>
			</div>
		</div>
	</td>
</tr>
<tr>
	<td class="text-right">និង</td>
	<td>
		<div class="row">
			<div class="col-sm-4">
				<x-bss-form.input name="pregnancy_age2" class="is_number" :value="old('pregnancy_age2', !empty($row) && $row->pregnancy_age2 ? $row->pregnancy_age2 : '')"/>
			</div>
			<div class="col-sm-4 pl-0">
				<x-bss-form.select name="pregnancy_age2_unit">
					<option value="day" {{ ((old('pregnancy_age2_unit', $row->pregnancy_age2_unit) == 'ថ្ងៃ')? 'selected' : '') }}>ថ្ងៃ</option>
					<option value="-" {{ ((old('pregnancy_age2_unit', $row->pregnancy_age2_unit) == '-')? 'selected' : '') }}>-</option>
				</x-bss-form.select>
			</div>
		</div>
	</td>
</tr>
<tr>
	<td class="text-right">ទារកមានទំងន់</td>
	<td>
		<div class="row">
			<div class="col-sm-4">
				<x-bss-form.input name="baby_weight" class="is_number" :value="old('baby_weight', !empty($row) && $row->baby_weight ? $row->baby_weight : '')"/>
			</div>
			<div class="col-sm-4 pl-0">
				<x-bss-form.select name="baby_weight_unit">
					<option value="ក្រាម" {{ ((old('baby_weight_unit', $row->baby_weight_unit) == 'ក្រាម')? 'selected' : '') }}>ក្រាម</option>
					<option value="-" {{ ((old('baby_weight_unit', $row->baby_weight_unit) == '-')? 'selected' : '') }}>-</option>
				</x-bss-form.select>
			</div>
		</div>
	</td>
</tr>
<tr>
	<td class="text-right">លើស/ខ្វះ</td>
	<td>
		<div class="row">
			<div class="col-sm-4">
				<x-bss-form.input name="over_under" class="is_number" :value="old('over_under', !empty($row) && $row->over_under ? $row->over_under : '')"/>
			</div>
			<div class="col-sm-4 pl-0">
				<x-bss-form.select name="over_under_unit">
					<option value="ក្រាម" {{ ((old('over_under_unit', $row->over_under_unit) == 'ក្រាម')? 'selected' : '') }}>ក្រាម</option>
					<option value="-" {{ ((old('over_under_unit', $row->over_under_unit) == '-')? 'selected' : '') }}>-</option>
				</x-bss-form.select>
			</div>
		</div>
	</td>
</tr>
<tr>
	<td width="30%" class="text-right">ទារកនឹងកើតថ្ងៃទី</td>
	<td>
		<x-bss-form.input name="bady_date_of_birth" class="date-picker" hasIcon="right" icon="bx bx-calendar" :value="old('bady_date_of_birth', !empty($row) && $row->bady_date_of_birth ? $row->bady_date_of_birth : '')"/>
	</td>
</tr>
<tr>
	<td class="text-right">មុន/ក្រោយ</td>
	<td>
		<div class="row">
			<div class="col-sm-4">
				<x-bss-form.input name="before_after" class="is_number" :value="old('before_after', !empty($row) && $row->before_after ? $row->before_after : '')"/>
			</div>
			<div class="col-sm-4 pl-0">
				<x-bss-form.select name="before_after_unit">
					<option value="day" {{ ((old('before_after_unit', $row->before_after_unit) == 'ថ្ងៃ')? 'selected' : '') }}>ថ្ងៃ</option>
					<option value="-" {{ ((old('before_after_unit', $row->before_after_unit) == '-')? 'selected' : '') }}>-</option>
				</x-bss-form.select>
			</div>
		</div>
	</td>
</tr>