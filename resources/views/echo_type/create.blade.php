<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{{ route('setting.echo-type.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
	</x-slot>
	<form action="{{ route('setting.echo-type.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
		@method('PUT')
		@csrf
		<x-card bodyClass="pb-0">			
			<table class="table-form striped">
				<tr>
					<th colspan="4" class="text-left tw-bg-gray-100">Create New Information</th>
				</tr>
				<tr>
					<td width="20%" class="text-right">Name EN <small class='required'>*</small></td>
					<td>
						<x-bss-form.input name="name_en" required autofocus />
					</td>
                </tr>
                <tr>
					<td width="20%" class="text-right">Name KH <small class='required'>*</small></td>
					<td>
						<x-bss-form.input name="name_kh" required/>
					</td>
				</tr>
				<tr>
					<td width="20%" class="text-right">Index</td>
					<td>
						<x-bss-form.input name="index" value="9999"/>
					</td>
				</tr>
                <tr>
					<td width="20%" class="text-right">Detail</td>
					<td>
                        <x-bss-form.textarea name="default_form" rows="20"> </x-bss-form.textarea>
					</td>
				</tr>
			</table>
			<x-slot name="footer">
				<x-form.button type="submit" icon="bx bx-save" label="Save" />
			</x-slot>
		</x-card>
	</form>

</x-app-layout>
