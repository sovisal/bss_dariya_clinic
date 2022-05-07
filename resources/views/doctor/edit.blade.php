<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{{ route('setting.doctor.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
	</x-slot>
	<form action="{{ route('setting.doctor.update', $doctor->id) }}" method="POST" autocomplete="off">
		@method('PUT')
		@csrf
		<x-card bodyClass="pb-0">
			<table class="table-form striped">
				<tr>
					<th colspan="4" class="text-left tw-bg-gray-100">Doctor Information</th>
				</tr>
				<tr>
					<td width="20%" class="text-right">Name in Khmer <small class='required'>*</small></td>
					<td width="30%">
						<x-bss-form.input name="name_kh" value="{{ old('name_kh', $doctor->name_kh) }}" required autofocus />
					</td>
					<td width="20%" class="text-right">Name in English</td>
					<td width="30%">
						<x-bss-form.input name="name_en" value="{{ old('name_en', $doctor->name_en) }}" />
					</td>
				</tr>
				<tr>
					<td class="text-right">Identity Card Number</td>
					<td>
						<x-bss-form.input name="id_card_no" value="{{ old('id_card_no', $doctor->id_card_no) }}" />
					</td>
					<td class="text-right">Gender</td>
					<td>
						<x-bss-form.select name="gender" data-no_search="true">
							<option value="">---- None ----</option>
							@foreach ($gender as $id => $data)
								<option value="{{ $id }}" {{ (old('gender', $doctor->gender) == $id) ? 'selected' : '' }}>{{ $data }}</option>
							@endforeach
						</x-bss-form.select>
					</td>
				</tr>
				<tr>
					<td class="text-right">E-mail</td>
					<td>
						<x-bss-form.input type="email" name="email" value="{{ old('email', $doctor->email) }}" />
					</td>
					<td class="text-right">Phone</td>
					<td>
						<x-bss-form.input name="phone" value="{{ old('phone', $doctor->phone) }}" />
					</td>
				</tr>
				<tr>
					<td class="text-right">Address</td>
					<td colspan="3">
						<x-bss-form.input type="text" name="address" value="{{ old('address', $doctor->address) }}">{{ old('address', $doctor->address) }}</x-bss-form.input>
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
