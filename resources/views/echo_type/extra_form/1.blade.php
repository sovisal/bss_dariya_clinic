<tr>
	<td width="30%" class="text-right">HR ចង្វាក់បេះដូង</td>
	<td>
		<x-bss-form.input name="hr_heart_rate" :value="old('hr_heart_rate', !empty($row) && $row->hr_heart_rate ? $row->hr_heart_rate : '')"/>
	</td>
</tr>
<tr>
	<td class="text-right">CRL</td>
	<td>
		<div class="row">
			<div class="col-sm-4">
				<x-bss-form.input name="crl" class="is_number" :value="old('crl', !empty($row) && $row->crl ? $row->crl : '')"/>
			</div>
			<div class="col-sm-4 pl-0">
				<x-bss-form.select name="crl_unit">
					<option value="mm" {{ ((old('crl_unit', $row->crl_unit) == 'មម')? 'selected' : '') }}>មម</option>
					<option value="-" {{ ((old('crl_unit', $row->crl_unit) == '-')? 'selected' : '') }}>-</option>
				</x-bss-form.select>
			</div>
		</div>
	</td>
</tr>
<tr>
	<td class="text-right">GS</td>
	<td>
		<div class="row">
			<div class="col-sm-4">
				<x-bss-form.input name="gs" class="is_number" :value="old('gs', !empty($row) && $row->gs ? $row->gs : '')"/>
			</div>
			<div class="col-sm-4 pl-0">
				<x-bss-form.select name="gs_unit">
					<option value="mm" {{ ((old('gs_unit', $row->gs_unit) == 'មម')? 'selected' : '') }}>មម</option>
					<option value="-" {{ ((old('gs_unit', $row->gs_unit) == '-')? 'selected' : '') }}>-</option>
				</x-bss-form.select>
			</div>
		</div>
	</td>
</tr>
<tr>
	<td width="30%" class="text-right">VO</td>
	<td>
		<x-bss-form.input name="vo" :value="old('vo', !empty($row) && $row->vo ? $row->vo : '')"/>
	</td>
</tr>
<tr>
	<td width="30%" class="text-right">មានកូន</td>
	<td>
		<x-bss-form.input name="has_child" :value="old('has_child', !empty($row) && $row->has_child ? $row->has_child : '1 និង មានថង់ទឹកកូន 1')"/>
	</td>
</tr>
<tr>
	<td width="30%" class="text-right">ចង្វាក់បេះដូង</td>
	<td>
		<x-bss-form.input name="heart_rate" :value="old('heart_rate', !empty($row) && $row->heart_rate ? $row->heart_rate : '')"/>
	</td>
</tr>
<tr>
	<td width="30%" class="text-right">សសៃឈាម</td>
	<td>
		<x-bss-form.input name="blood_vessels" :value="old('blood_vessels', !empty($row) && $row->blood_vessels ? $row->blood_vessels : '')"/>
	</td>
</tr>
<tr>
	<td width="30%" class="text-right">ដៃស្បូន</td>
	<td>
		<x-bss-form.input name="uterine_tube" :value="old('uterine_tube', !empty($row) && $row->uterine_tube ? $row->uterine_tube : 'ល្អ អត់មានដុំទឹក រឺដុំសាច់')"/>
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
	<td width="30%" class="text-right">ការលូតលាស់</td>
	<td>
		<x-bss-form.input name="growth" :value="old('growth', !empty($row) && $row->growth ? $row->growth : '')"/>
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
<tr>
	<td width="30%" class="text-right">ពិនិត្យលើកក្រោយថ្ងៃទី</td>
	<td>
		<x-bss-form.input name="next_meeting" class="date-picker" hasIcon="right" icon="bx bx-calendar" :value="old('next_meeting', !empty($row) && $row->next_meeting ? $row->next_meeting : '')"/>
	</td>
</tr>