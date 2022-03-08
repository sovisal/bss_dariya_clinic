<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{{ route('patient.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
	</x-slot>
	<form action="{{ route('patient.update', $patient) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
		@method('PUT')
		@csrf
		<x-card bodyClass="pb-0">
			<div class="divider">
				<div class="divider-text text-primary">PATIENT INFORMATION</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<x-form.input
						name="name_kh"
						required
						autofocus
						:value="old('name_kh', $patient->name_kh)"
						label="Name in Khmer <small class='required'>*</small>"
					/>
				</div>
				<div class="col-sm-6">
					<x-form.input
						name="name_en"
						:value="old('name_en', $patient->name_en)"
						label="Name in English"
					/>
				</div>
				<div class="col-sm-3">
					<x-form.input
						name="id_card_no"
						:value="old('id_card_no', $patient->id_card_no)"
						label="Identity Number"
					/>
				</div>
				<div class="col-sm-3">
					<x-form.select
						name="gender"
						data-no_search="true"
						label="Gender"
					>
						<option value="">---- None ----</option>
						<option value="Male" {{ (old('gender', $patient->gender)=="Male") ? 'selected' : '' }}>Male</option>
						<option value="Female" {{ (old('gender', $patient->gender)=="Female") ? 'selected' : '' }}>Female</option>
					</x-form.select>
				</div>
				<div class="col-sm-3">
					<x-form.input
						type="email"
						name="email"
						:value="old('email', $patient->email)"
						label="E-mail"
					/>
				</div>
				<div class="col-sm-3">
					<x-form.input
						name="phone"
						:value="old('phone', $patient->phone)"
						label="Phone Number"
					/>
				</div>
				<div class="col-sm-3">
					<x-form.input
						name="date_of_birth"
						class="date-picker"
						hasIcon="right"
						icon="bx bx-calendar"
						:value="old('date_of_birth', $patient->date_of_birth)"
						label="Date of Birth"
					/>
				</div>
				<div class="col-sm-3">
					<x-form.input
						name="age"
						class="is_number"
						:value="old('age', $patient->age)"
						label="Age"
					/>
				</div>
				<div class="col-sm-3">
					<x-form.select
						name="nationality"
						data-no_search="true"
						label="Nationality"
					>
						<option value="">---- None ----</option>
						<option value="Khmer" {{ (old('nationality', $patient->nationality)=="Khmer") ? 'selected' : '' }}>Khmer (KH)</option>
						<option value="American" {{ (old('nationality', $patient->nationality)=="American") ? 'selected' : '' }}>American (US)</option>
					</x-form.select>
				</div>
				<div class="col-sm-3">
					<x-form.select
						name="marital_status"
						data-no_search="true"
						label="Marital Status"
					>
						<option value="">---- None ----</option>
						<option value="Single" {{ (old('marital_status', $patient->marital_status)=="Single") ? 'selected' : '' }}>Single</option>
						<option value="Married" {{ (old('marital_status', $patient->marital_status)=="Married") ? 'selected' : '' }}>Married</option>
						<option value="Widow" {{ (old('marital_status', $patient->marital_status)=="Widow") ? 'selected' : '' }}>Widow</option>
					</x-form.select>
				</div>
				<div class="col-sm-3">
					<x-form.input
						name="registered_at"
						class="date-time-picker"
						hasIcon="right"
						icon="bx bx-calendar"
						value="{{ old('registered_at', $patient->registered_at) }}"
						label="Registered Date"
					/>
				</div>
				<div class="col-sm-3">
					<x-form.input
						name="education"
						:value="old('education', $patient->education)"
						label="Education"
					/>
				</div>
				<div class="col-sm-3">
					<x-form.input
						name="position"
						:value="old('position', $patient->position)"
						label="Position"
					/>
				</div>
				<div class="col-sm-3">
					<x-form.input
						name="enterprise"
						:value="old('enterprise', $patient->enterprise)"
						label="Enterprise"
					/>
				</div>
				<div class="col-sm-6">
					<x-form.input
						name="father_name"
						:value="old('father_name', $patient->father_name)"
						label="Father Name"
					/>
				</div>
				<div class="col-sm-6">
					<x-form.input
						name="father_position"
						:value="old('father_position', $patient->father_position)"
						label="Father Position"
					/>
				</div>
				<div class="col-sm-6">
					<x-form.input
						name="mother_name"
						:value="old('mother_name', $patient->mother_name)"
						label="Mother Name"
					/>
				</div>
				<div class="col-sm-6">
					<x-form.input
						name="mother_position"
						:value="old('mother_position', $patient->mother_position)"
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
						<option value="Group A" {{ (old('blood_type', $patient->blood_type)=="Group A") ? 'selected' : '' }}>Group A</option>
						<option value="Group B" {{ (old('blood_type', $patient->blood_type)=="Group B") ? 'selected' : '' }}>Group B</option>
						<option value="Group AB" {{ (old('blood_type', $patient->blood_type)=="Group AB") ? 'selected' : '' }}>Group AB</option>
						<option value="Group O" {{ (old('blood_type', $patient->blood_type)=="Group O") ? 'selected' : '' }}>Group O</option>
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
						:value="old('house_no', $patient->house_no)"
						label="House Number"
					/>
				</div>
				<div class="col-sm-6">
					<x-form.input
						name="street_no"
						:value="old('street_no', $patient->street_no)"
						label="Street Number"
					/>
				</div>
				<div class="col-sm-6">
					<x-form.input
						name="zip_code"
						:value="old('zip_code', $patient->zip_code)"
						label="Zipcode"
					/>
				</div>
				<div class="col-sm-6">
					
				</div>
			</div>
			<x-slot name="footer">
				<x-form.button type="submit" icon="bx bx-save" label="Save" />
			</x-slot>
		</x-card>
	</form>

</x-app-layout>
