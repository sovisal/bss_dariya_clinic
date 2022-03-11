<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{{ route('patient.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
	</x-slot>
	<form action="{{ route('patient.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
		@csrf
		<x-card bodyClass="pb-0">
			{{-- <div class="divider">
				<div class="divider-text text-primary">PATIENT INFORMATION</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<x-form.input
						name="name_kh"
						required
						autofocus
						label="Name in Khmer <small class='required'>*</small>"
					/>
				</div>
				<div class="col-sm-6">
					<x-form.input
						name="name_en"
						label="Name in English"
					/>
				</div>
				<div class="col-sm-3">
					<x-form.input
						name="id_card_no"
						label="Identity Number"
					/>
				</div>
				<div class="col-sm-3">
					<x-form.select
						name="gender"
						label="Gender"
						data-no_search="true"
					>
						<option value="">---- None ----</option>
						<option value="Male" {{ (old('gender')=="Male") ? 'selected' : '' }}>Male</option>
						<option value="Female" {{ (old('gender')=="Female") ? 'selected' : '' }}>Female</option>
					</x-form.select>
				</div>
				<div class="col-sm-3">
					<x-form.input
						type="email"
						name="email"
						label="E-mail"
					/>
				</div>
				<div class="col-sm-3">
					<x-form.input
						name="phone"
						label="Phone Number"
					/>
				</div>
				<div class="col-sm-3">
					<x-form.input
						name="date_of_birth"
						class="date-picker"
						hasIcon="right"
						icon="bx bx-calendar"
						label="Date of Birth"
					/>
				</div>
				<div class="col-sm-3">
					<x-form.input
						name="age"
						class="is_number"
						label="Age"
					/>
				</div>
				<div class="col-sm-3">
					<x-form.select
						name="nationality"
						label="Nationality"
						data-no_search="true"
					>
						<option value="">---- None ----</option>
						<option value="Khmer" {{ (old('nationality')=="Khmer") ? 'selected' : '' }}>Khmer (KH)</option>
						<option value="American" {{ (old('nationality')=="American") ? 'selected' : '' }}>American (US)</option>
					</x-form.select>
				</div>
				<div class="col-sm-3">
					<x-form.select
						name="marital_status"
						label="Marital Status"
						data-no_search="true"
					>
						<option value="">---- None ----</option>
						<option value="Single" {{ (old('marital_status')=="Single") ? 'selected' : '' }}>Single</option>
						<option value="Married" {{ (old('marital_status')=="Married") ? 'selected' : '' }}>Married</option>
						<option value="Widow" {{ (old('marital_status')=="Widow") ? 'selected' : '' }}>Widow</option>
					</x-form.select>
				</div>
				<div class="col-sm-3">
					<x-form.input
						name="registered_at"
						class="date-time-picker"
						value="{{ date('Y-m-d H:i:s') }}"
						hasIcon="right"
						icon="bx bx-calendar"
						label="Registered Date"
					/>
				</div>
				<div class="col-sm-3">
					<x-form.input
						name="education"
						label="Education"
					/>
				</div>
				<div class="col-sm-3">
					<x-form.input
						name="position"
						label="Position"
					/>
				</div>
				<div class="col-sm-3">
					<x-form.input
						name="enterprise"
						label="Enterprise"
					/>
				</div>
				<div class="col-sm-6">
					<x-form.input
						name="father_name"
						label="Father Name"
					/>
				</div>
				<div class="col-sm-6">
					<x-form.input
						name="father_position"
						label="Father Position"
					/>
				</div>
				<div class="col-sm-6">
					<x-form.input
						name="mother_name"
						label="Mother Name"
					/>
				</div>
				<div class="col-sm-6">
					<x-form.input
						name="mother_position"
						label="Mother Position"
					/>
				</div>
				<div class="col-sm-6">
					<x-form.select
						name="blood_type"
						label="Blood Group"
						data-no_search="true"
					>
						<option value="">---- None ----</option>
						<option value="Group A" {{ (old('blood_type')=="Group A") ? 'selected' : '' }}>Group A</option>
						<option value="Group B" {{ (old('blood_type')=="Group B") ? 'selected' : '' }}>Group B</option>
						<option value="Group AB" {{ (old('blood_type')=="Group AB") ? 'selected' : '' }}>Group AB</option>
						<option value="Group O" {{ (old('blood_type')=="Group O") ? 'selected' : '' }}>Group O</option>
					</x-form.select>
				</div>
				<div class="col-sm-6">
					<x-form.input-file-custom
						name="photo"
						label="Photo"
					/>
				</div>
			</div>
			
			<div class="divider mt-2">
				<div class="divider-text text-primary">PATIENT ADDRESS</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<x-form.input
						name="house_no"
						label="House Number"
					/>
				</div>
				<div class="col-sm-3">
					<x-form.input
						name="street_no"
						label="Street Number"
					/>
				</div>
				<div class="col-sm-3">
					<x-form.input
						name="zip_code"
						label="Zip code"
					/>
				</div>
				<div class="col-sm-6">
					<x-form.select
						name="pt_province_id"
						label="Province"
					>
						<option value="">---- None ----</option>
						{!! str_replace("</select>","", str_replace("<select __ATTRIBUTES__>","",$_4level_level[0])) !!}
					</x-form.select>
				</div>
				<div class="col-sm-6">
					<x-form.select name="pt_district_id" label="District" />
				</div>
				<div class="col-sm-6">
					<x-form.select
						name="pt_commune_id"
						label="Commune"
					/>
				</div>
				<div class="col-sm-6">
					<x-form.select
						name="pt_village_id"
						label="Village"
					/>
				</div>
			</div> --}}

			<table class="table-form striped">
				<tr>
					<th colspan="4" class="text-left tw-bg-gray-100">Patient Information</th>
				</tr>
				<tr>
					<td width="20%" class="text-right">Name in Khmer <small class='required'>*</small></td>
					<td width="30%">
						<x-bss-form.input name="name_kh" required autofocus />
					</td>
					<td width="20%" class="text-right">
						Name in English
					</td>
					<td width="30%">
						<x-bss-form.input name="name_en" />
					</td>
				</tr>
				<tr>
					<td class="text-right">Identity Card Number</td>
					<td>
						<x-bss-form.input name="id_card_no" />
					</td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td class="text-right">E-mail</td>
					<td>
						<x-bss-form.input type="email" name="email" />
					</td>
					<td class="text-right">Gender</td>
					<td>
						<x-bss-form.select name="gender" data-no_search="true">
							<option value="">---- None ----</option>
							<option value="Male" {{ (old('gender')=="Male") ? 'selected' : '' }}>Male</option>
							<option value="Female" {{ (old('gender')=="Female") ? 'selected' : '' }}>Female</option>
						</x-bss-form.select>
					</td>
				</tr>
				<tr>
					<td class="text-right">Date of Birth</td>
					<td>
						<x-bss-form.input name="date_of_birth" class="date-picker" hasIcon="right" icon="bx bx-calendar" />
					</td>
					<td class="text-right">Age</td>
					<td>
						<x-bss-form.input type="number" name="age" />
					</td>
				</tr>
				<tr>
					<td class="text-right">Registered Date</td>
					<td>
						<x-bss-form.input name="registered_at" class="date-time-picker" hasIcon="right" icon="bx bx-calendar" value="{{ date('Y-m-d H:i:s') }}" />
					</td>
					<td class="text-right">Blood Type</td>
					<td>
						<x-bss-form.select name="blood_type" data-no_search="true">
							<option value="">---- None ----</option>
							<option value="Group A" {{ (old('blood_type')=="Group A") ? 'selected' : '' }}>Group A</option>
							<option value="Group B" {{ (old('blood_type')=="Group B") ? 'selected' : '' }}>Group B</option>
							<option value="Group AB" {{ (old('blood_type')=="Group AB") ? 'selected' : '' }}>Group AB</option>
							<option value="Group O" {{ (old('blood_type')=="Group O") ? 'selected' : '' }}>Group O</option>
						</x-bss-form.select>
					</td>
				</tr>
				<tr>
					<td class="text-right">Position</td>
					<td>
						<x-bss-form.input name="position" />
					</td>
					<td class="text-right">Enterprise</td>
					<td>
						<x-bss-form.input name="enterprise" />
					</td>
				</tr>
				<tr>
					<td class="text-right">Father Name</td>
					<td>
						<x-bss-form.input name="father_name" />
					</td>
					<td class="text-right">Father Position</td>
					<td>
						<x-bss-form.input name="father_position" />
					</td>
				</tr>
				<tr>
					<td class="text-right">Mother Name</td>
					<td>
						<x-bss-form.input name="mother_name" />
					</td>
					<td class="text-right">Mother Position</td>
					<td>
						<x-bss-form.input name="mother_position" />
					</td>
				</tr>
				<tr>
					<td class="text-right">Phone</td>
					<td>
						<x-bss-form.input name="phone" />
					</td>
					<td class="text-right">Education</td>
					<td>
						<x-bss-form.input name="education" />
					</td>
				</tr>
				<tr>
					<td class="text-right">Nationality</td>
					<td>
						<x-bss-form.select name="nationality" data-no_search="true">
							<option value="">---- None ----</option>
							<option value="Khmer" {{ (old('nationality')=="Khmer") ? 'selected' : '' }}>Khmer (KH)</option>
							<option value="American" {{ (old('nationality')=="American") ? 'selected' : '' }}>American (US)</option>
						</x-bss-form.select>
					</td>
					<td class="text-right">Marital Status</td>
					<td>
						<x-bss-form.select name="marital_status" data-no_search="true">
							<option value="">---- None ----</option>
							<option value="Single" {{ (old('marital_status')=="Single") ? 'selected' : '' }}>Single</option>
							<option value="Married" {{ (old('marital_status')=="Married") ? 'selected' : '' }}>Married</option>
							<option value="Widow" {{ (old('marital_status')=="Widow") ? 'selected' : '' }}>Widow</option>
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
						<x-bss-form.input name="house_no" />
					</td>
					<td width="20%" class="text-right">Street</td>
					<td width="30%">
						<x-bss-form.input name="street_no" />
					</td>
				</tr>
				<tr>
					<td class="text-right">Zip Code</td>
					<td>
						<x-bss-form.input name="zip_code" />
					</td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td class="text-right">Province</td>
					<td>
						<x-bss-form.select name="pt_province_id">
							<option value="">---- None ----</option>
							{!! str_replace("</select>","", str_replace("<select __ATTRIBUTES__>","",$_4level_level[0])) !!}
						</x-bss-form.select>
					</td>
					<td class="text-right">District</td>
					<td>
						<x-bss-form.select name="pt_district_id" />
					</td>
				</tr>
				<tr>
					<td class="text-right">Commune</td>
					<td>
						<x-bss-form.select name="pt_commune_id" />
					</td>
					<td class="text-right">Village</td>
					<td>
						<x-bss-form.select name="pt_village_id" />
					</td>
				</tr>
			</table>

			<x-slot name="footer">
				<x-form.button type="submit" icon="bx bx-save" label="Save" />
			</x-slot>
		</x-card>
	</form>

	<x-modal-image-crop />
</x-app-layout>
