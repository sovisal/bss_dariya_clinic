<x-app-layout>
	<form action="{{ route('role.update', $role) }}" method="POST" autocomplete="off">
		@method('PUT')
		@csrf
		<x-card>
			<x-form.input
				type="text"
				name="label"
				:value="old('label', $role->label)"
				required
				label="{!! __('form.label') !!} <small class='required'>*</small>"
			/>
			<x-form.input
				type="text"
				name="name"
				:value="old('name', $role->name)"
				required
				label="{!! __('form.name') !!} <small class='required'>*</small>"
			/>
				
			<x-slot name="footer">
				<x-form.button type="submit" name="save" icon="bx bx-save" label="{!! __('button.save') !!}" />
			</x-slot>
		</x-card>
	</form>

</x-app-layout>
