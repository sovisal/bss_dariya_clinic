<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{{ route('setting.xray-type.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
	</x-slot>
	<form action="{{ route('setting.xray-type.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
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
					<td width="20%" class="text-right">Price <small class='required'>*</small></td>
					<td>
						<x-bss-form.input name="price" value="0" type="number" required/>
					</td>
				</tr>
				@include('xray_type.extra_form.0')
				<tr>
					<td width="20%" class="text-right">Index</td>
					<td>
						<x-bss-form.input name="index" value="9999" type="number"/>
					</td>
				</tr>
			</table>
			<x-slot name="footer">
				<x-form.button type="submit" icon="bx bx-save" label="Save" />
			</x-slot>
		</x-card>
	</form>

</x-app-layout>
