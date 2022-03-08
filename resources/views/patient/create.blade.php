<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{{ route('patient.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
	</x-slot>
	<form action="{{ route('patient.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
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
				<div class="col-sm-6">
					<x-form.input
						name="street_no"
						label="Street Number"
					/>
				</div>
				<div class="col-sm-6">
					<x-form.input
						name="zip_code"
						label="zip_code"
					/>
				</div>
				<div class="col-sm-6">
					
				</div>
			</div>

			{{-- <x-table class="table-bordered table-hover mb-1">

				<x-slot name="thead">
					<tr>
						<th colspan="4" class="text-left tw-bg-gray-100">Patient Information</th>
					</tr>
				</x-slot>
				<tr>
					<td width="20%" class="text-right">
						Name in Khmer <small class='text-danger'>*</small>
					</td>
					<td width="30%">
						<input type="text" name="name_kh" class="form-control" required autofocus />
					</td>
					<td width="20%" class="text-right">
						Name in English
					</td>
					<td width="30%">
						<input type="text" name="name_en" class="form-control" />
					</td>
				</tr>
				<tr>
					<td class="text-right">
						Identity Number
					</td>
					<td>
						<input type="text" name="id_card_no" class="form-control" />
					</td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td class="text-right">
						E-mail
					</td>
					<td>
						<input type="text" name="email" class="form-control" />
					</td>
					<td class="text-right">
						Gender
					</td>
					<td>
						<select name="gender" class="form-control custom-select2" data-no_search="true">
							<option value="1">Male</option>
							<option value="2">Female</option>
						</select>
					</td>
				</tr>
				<tr>
					<td class="text-right">
						Date of Birth
					</td>
					<td>
						<div class="position-relative">
							<input name="date_of_birth" class="form-control date-picker" />
						</div>
					</td>
					<td class="text-right">
						Age
					</td>
					<td>
						<input type="number" name="age" class="form-control is_number" />
					</td>
				</tr>
				<tr>
					<td class="text-right">
						Registered Date
					</td>
					<td>
						<div class="position-relative">
							<input name="date_of_birth" class="form-control date-time-picker" value="{{ date('Y-m-d h:i:s') }}" />
						</div>
					</td>
					<td class="text-right">
						Blood Type
					</td>
					<td>
						<select name="gender" class="form-control custom-select2" data-no_search="true">
							<option value="single">Single</option>
							<option value="married">Married</option>
							<option value="widow">Widow</option>
						</select>
					</td>
				</tr>
				<tr>
					<td class="text-right">
						Position
					</td>
					<td>
						<input type="text" name="position" class="form-control" />
					</td>
					<td class="text-right">
						Enterprise
					</td>
					<td>
						<input type="text" name="enterprise" class="form-control" />
					</td>
				</tr>
				<tr>
					<td class="text-right">
						Father Name
					</td>
					<td>
						<input type="text" name="father_name" class="form-control" />
					</td>
					<td class="text-right">
						Father Position
					</td>
					<td>
						<input type="text" name="father_position" class="form-control" />
					</td>
				</tr>
				<tr>
					<td class="text-right">
						Mother Name
					</td>
					<td>
						<input type="text" name="mother_name" class="form-control" />
					</td>
					<td class="text-right">
						Mother Position
					</td>
					<td>
						<input type="text" name="mother_position" class="form-control" />
					</td>
				</tr>
				<tr>
					<td class="text-right">
						Phone
					</td>
					<td>
						<input type="text" name="phone" class="form-control" />
					</td>
					<td class="text-right">
						Education
					</td>
					<td>
						<input type="text" name="education" class="form-control" />
					</td>
				</tr>
				<tr>
					<td class="text-right">
						Nationality
					</td>
					<td>
						<select name="gender" class="form-control custom-select2" data-no_search="true">
							<option value="khmer">Khmer (KH)</option>
							<option value="american">American (US)</option>
						</select>
					</td>
					<td class="text-right">
						Marital Status
					</td>
					<td>
						<select name="gender" class="form-control custom-select2" data-no_search="true">
							<option value="single">Single</option>
							<option value="married">Married</option>
							<option value="widow">Widow</option>
						</select>
					</td>
				</tr>
				<tr>
					<td class="text-right">
						Photo
					</td>
					<td>
						<div class="custom-file">
							<input
								class="@error('photo')is-invalid @enderror form-control custom-file-input"
								type="file"
								name="photo"
								id="photo"
								value="{{ old('photo') }}"
							/>
							<label class="custom-file-label" for="photo">Choose file</label>
							<x-form.error name="photo"/>
						</div>
					</td>
					<td colspan="2"></td>
				</tr>
			</x-table> --}}

			{{-- <x-table class="table-bordered table-hover mb-0">
				<x-slot name="thead">
					<tr>
						<th colspan="4" class="text-left tw-bg-gray-100">Patient Address</th>
					</tr>
				</x-slot>
				<tr>
					<td width="20%" class="text-right">
						House Number
					</td>
					<td width="30%">
						<input type="text" name="house_no" class="form-control" required autofocus />
					</td>
					<td width="20%" class="text-right">
						Name in English
					</td>
					<td width="30%">
						<input type="text" name="street_no" class="form-control" />
					</td>
				</tr>
				<tr>
					<td width="20%" class="text-right">
						Zip Code
					</td>
					<td width="30%">
						<input type="text" name="zip_code" class="form-control" />
					</td>
					<td colspan="2"></td>
				</tr>
			</x-table> --}}

			<x-slot name="footer">
				<x-form.button type="submit" icon="bx bx-save" label="Save" />
			</x-slot>
		</x-card>
	</form>

	<x-modal-image-crop />
</x-app-layout>
