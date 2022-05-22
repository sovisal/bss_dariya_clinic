<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{{ route('patient.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
	</x-slot>
	<form action="{{ route('patient.update', $patient) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
		@method('PUT')
		@csrf
		<input type="hidden" name="status" value="{{ $patient->status ?: 1 }}"/>
		<x-card bodyClass="pb-0" :actionShow="false">	
			<x-slot name="action">
				<div>
					<!-- <x-form.button type="button" class="btn-submit" value="Complete" color="success" icon="bx bx-check" label="Complete" onclick="$(this).parents('form').find('[name=status]').val(2); document.forms[0].submit();"/> -->
					<x-form.button type="submit" class="btn-submit" value="Progress" icon="bx bx-save" label="Save" />
					<!-- <x-form.button type="reset" class="btn-submit" value="Cancel" color="danger" icon="bx bx-x" label="Cancel" /> -->
				</div>
			</x-slot>
			<x-slot name="footer">
				<div>
					<!-- <x-form.button type="button" class="btn-submit" value="Complete" color="success" icon="bx bx-check" label="Complete" onclick="$(this).parents('form').find('[name=status]').val(2); document.forms[0].submit();"/> -->
					<x-form.button type="submit" class="btn-submit" value="Progress" icon="bx bx-save" label="Save" />
					<!-- <x-form.button type="reset" class="btn-submit" value="Cancel" color="danger" icon="bx bx-x" label="Cancel" /> -->
				</div>
			</x-slot>
			<table class="table-form striped">
				<tr>
					<th colspan="4" class="text-left tw-bg-gray-100">Patient Information</th>
				</tr>
				<tr>
					<td width="20%" class="text-right">Name in Khmer <small class='required'>*</small></td>
					<td width="30%">
						<x-bss-form.input name="name_kh" :value="old('name_kh', $patient->name_kh)" required autofocus />
					</td>
					<td width="20%" class="text-right">Name in English</td>
					<td width="30%">
						<x-bss-form.input name="name_en" :value="old('name_en', $patient->name_en)" />
					</td>
				</tr>
				<tr>
					<td class="text-right">Identity Card Number</td>
					<td>
						<x-bss-form.input name="id_card_no" :value="old('id_card_no', $patient->id_card_no)" />
					</td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td class="text-right">E-mail</td>
					<td>
						<x-bss-form.input type="email" name="email" :value="old('email', $patient->email)" />
					</td>
					<td class="text-right">Gender</td>
					<td>
						<x-bss-form.select name="gender" data-no_search="true">
							<option value="">---- None ----</option>
							@foreach ($gender as $id => $data)
								<option value="{{ $id }}" {{ (old('gender', $patient->gender) == $id) ? 'selected' : '' }}>{{ $data }}</option>
							@endforeach
						</x-bss-form.select>
					</td>
				</tr>
				<tr>
					<td class="text-right">Date of Birth</td>
					<td>
						<x-bss-form.input name="date_of_birth" class="date-picker" :value="old('date_of_birth', $patient->date_of_birth)" hasIcon="right" icon="bx bx-calendar" />
					</td>
					<td class="text-right">Age</td>
					<td>
						<x-bss-form.input type="number" name="age" :value="old('age', $patient->age)" />
					</td>
				</tr>
				<tr>
					<td class="text-right">Registered Date</td>
					<td>
						<x-bss-form.input name="registered_at" class="date-time-picker" hasIcon="right" icon="bx bx-calendar" value="{{ old('registered_at', $patient->registered_at) }}" />
					</td>
					<td class="text-right">Blood Type</td>
					<td>
						<x-bss-form.select name="blood_type" data-no_search="true">
							<option value="">---- None ----</option>
							@foreach ($blood_type as $id => $data)
								<option value="{{ $id }}"  {{ (old('blood_type', $patient->blood_type) == $id) ? 'selected' : '' }}>{{ $data }}</option>
							@endforeach
						</x-bss-form.select>
					</td>
				</tr>
				<tr>
					<td class="text-right">Position</td>
					<td>
						<x-bss-form.input name="position" :value="old('position', $patient->position)" />
					</td>
					<td class="text-right">Enterprise</td>
					<td>
						<x-bss-form.input name="enterprise" :value="old('enterprise', $patient->enterprise)" />
					</td>
				</tr>
				<tr>
					<td class="text-right">Father Name</td>
					<td>
						<x-bss-form.input name="father_name" :value="old('father_name', $patient->enterprise)" />
					</td>
					<td class="text-right">Father Position</td>
					<td>
						<x-bss-form.input name="father_position" :value="old('father_position', $patient->father_position)" />
					</td>
				</tr>
				<tr>
					<td class="text-right">Mother Name</td>
					<td>
						<x-bss-form.input name="mother_name" :value="old('mother_name', $patient->mother_name)" />
					</td>
					<td class="text-right">Mother Position</td>
					<td>
						<x-bss-form.input name="mother_position" :value="old('mother_position', $patient->mother_position)" />
					</td>
				</tr>
				<tr>
					<td class="text-right">Phone</td>
					<td>
						<x-bss-form.input name="phone" :value="old('phone', $patient->phone)" />
					</td>
					<td class="text-right">Education</td>
					<td>
						<x-bss-form.input name="education" :value="old('education', $patient->education)" />
					</td>
				</tr>
				<tr>
					<td class="text-right">Nationality</td>
					<td>
						<x-bss-form.select name="nationality" data-no_search="true">
							<option value="">---- None ----</option>
							@foreach ($nationality as $id => $data)
								<option value="{{ $id }}" {{ (old('nationality', $patient->nationality) == $id) ? 'selected' : '' }}>{{ $data }}</option>
							@endforeach
						</x-bss-form.select>
					</td>
					<td class="text-right">Marital Status</td>
					<td>
						<x-bss-form.select name="marital_status" data-no_search="true">
							<option value="">---- None ----</option>
							@foreach ($marital_status as $id => $data)
								<option value="{{ $id }}" {{ (old('nationality', $patient->marital_status) == $id) ? 'selected' : '' }}>{{ $data }}</option>
							@endforeach
						</x-bss-form.select>
					</td>
				</tr>
				<tr>
					<td class="text-right">Photo</td>
					<td>
						<x-bss-form.input-file-custom name="photo" />
					</td>
					<td colspan="2"></td>
				</tr>
			</table>

			<table class="table-form striped mt-2">
				<tr>
					<th colspan="4" class="text-left tw-bg-gray-100">Patient Address</th>
				</tr>
				<tr>
					<td width="20%" class="text-right">House Number</td>
					<td width="30%">
						<x-bss-form.input name="house_no" :value="old('house_no', $patient->house_no)" />
					</td>
					<td width="20%" class="text-right">Street</td>
					<td width="30%">
						<x-bss-form.input name="street_no" :value="old('street_no', $patient->street_no)" />
					</td>
				</tr>
				<tr>
					<td class="text-right">Zip Code</td>
					<td>
						<x-bss-form.input name="zip_code" :value="old('zip_code', $patient->zip_code)" />
					</td>
					<td colspan="2"></td>
				</tr>
				<?php 
					$_4level_level = get4LevelAdressSelectorByID($patient->address_id, ...['xx', 'option']); ?>
				<tr>
					<td class="text-right">Province</td>
					<td>
						<x-bss-form.select name="pt_province_id">
							{!! $_4level_level[0] !!}
						</x-bss-form.select>
					</td>
					<td class="text-right">District</td>
					<td>
						<x-bss-form.select name="pt_district_id">
							{!! $_4level_level[1] !!}
						</x-bss-form.select>
					</td>
				</tr>
				<tr>
					<td class="text-right">Commune</td>
					<td>
						<x-bss-form.select name="pt_commune_id">
							{!! $_4level_level[2] !!}
						</x-bss-form.select>
					</td>
					<td class="text-right">Village</td>
					<td>
						<x-bss-form.select name="pt_village_id">
							{!! $_4level_level[3] !!}
						</x-bss-form.select>
					</td>
				</tr>
			</table>
		</x-card>
	</form>

</x-app-layout>
