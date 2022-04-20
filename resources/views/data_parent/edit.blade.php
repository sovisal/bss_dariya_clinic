<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{{ route('setting.data-parent.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
	</x-slot>
	<form action="{{ route('setting.data-parent.update', $row) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
		@method('PUT')
		@csrf
		<x-card bodyClass="pb-0">			
			<table class="table-form striped">
				<tr>
					<th colspan="4" class="text-left tw-bg-gray-100">Edit Information</th>
				</tr>
				<tr>
					<td width="20%" class="text-right">Title EN <small class='required'>*</small></td>
					<td>
						<x-bss-form.input name="title_en" :value="old('title_en', $row->title_en)" required autofocus />
					</td>
                </tr>
                <tr>
					<td width="20%" class="text-right">Title KH <small class='required'>*</small></td>
					<td>
						<x-bss-form.input name="title_kh" :value="old('name_en', $row->title_kh)" />
					</td>
				</tr>
                <tr>
					<td width="20%" class="text-right">Description</td>
					<td>
                        <x-bss-form.textarea name="description">
                            {{ old('description', $row->description) }}
                        </x-bss-form.textarea>
					</td>
				</tr>
			</table>
			<x-slot name="footer">
				<x-form.button type="submit" icon="bx bx-save" label="Save" />
			</x-slot>
		</x-card>
	</form>

</x-app-layout>
