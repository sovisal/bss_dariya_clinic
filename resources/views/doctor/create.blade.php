<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{{ route('setting.doctor.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
	</x-slot>
	<form action="{{ route('setting.doctor.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
		@csrf
		<x-card bodyClass="pb-0">
			<table class="table-form striped">
				<tr>
					<th colspan="4" class="text-left tw-bg-gray-100">Doctor Information</th>
				</tr>
				<tr>
					<td width="20%" class="text-right">Name in Khmer <small class='required'>*</small></td>
					<td width="30%">
						<x-bss-form.input name="name_kh" required autofocus />
					</td>
					<td width="20%" class="text-right">Name in English</td>
					<td width="30%">
						<x-bss-form.input name="name_en" />
					</td>
				</tr>
				<tr>
					<td class="text-right">Identity Card Number</td>
					<td>
						<x-bss-form.input name="id_card_no" />
					</td>
					<td class="text-right">Gender</td>
					<td>
						<x-bss-form.select name="gender" data-no_search="true">
							<option value="">---- None ----</option>
							@foreach ($gender as $id => $data)
								<option value="{{ $id }}" {{ (old('gender')==$id) ? 'selected' : '' }}>{{ $data }}</option>
							@endforeach
						</x-bss-form.select>
					</td>
				</tr>
				<tr>
					<td class="text-right">E-mail</td>
					<td>
						<x-bss-form.input type="email" name="email" />
					</td>
					<td class="text-right">Phone</td>
					<td>
						<x-bss-form.input name="phone" />
					</td>
				</tr>
				<tr>
					<td class="text-right">Address</td>
					<td colspan="3">
						<x-bss-form.input type="text" name="address" />
					</td>
				</tr>
			</table>

			<x-slot name="footer">
				<x-form.save-option name="{!! __('button.save') !!}"/>
			</x-slot>
		</x-card>
	</form>

	<x-modal-image-crop />
</x-app-layout>
