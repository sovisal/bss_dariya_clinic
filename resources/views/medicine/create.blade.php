<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{{ route('setting.medicine.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
	</x-slot>
	<form action="{{ route('setting.medicine.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
		@csrf
		<x-card bodyClass="pb-0">
			<table class="table-form striped">
				<tr>
					<th colspan="4" class="text-left tw-bg-gray-100">Medicine Information</th>
				</tr>
				<tr>
					<td width="20%" class="text-right">Name <small class='required'>*</small></td>
					<td width="30%">
						<x-bss-form.input name="name" required autofocus />
					</td>
					<td width="20%" class="text-right">
						Price <small class='required'>*</small>
					</td>
					<td width="30%">
						<x-bss-form.input name="price" class="is_number" required/>
					</td>
				</tr>
				<tr>
					<td class="text-right">Usage <small class='required'>*</small></td>
					<td>
						<x-bss-form.select name="usage_id" required>
							<option value="">---- None ----</option>
							@foreach ($usages as $id => $usage)
								<option value="{{ $id }}" {{ (old('usage_id')==$id) ? 'selected' : '' }}>{{ $usage }}</option>
							@endforeach
						</x-bss-form.select>
					</td>
					<td class="text-right">Description</td>
					<td>
						<x-bss-form.textarea name="description" row="2" />
					</td>
				</tr>
				<tr>
				</tr>
			</table>

			<x-slot name="footer">
				<x-form.save-option name="{!! __('button.save') !!}"/>
			</x-slot>
		</x-card>
	</form>

	<x-modal-image-crop />
</x-app-layout>
