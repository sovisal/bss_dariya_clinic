<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{{ route('user.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
	</x-slot>

	<form action="{{ route('user.assign_role', $user) }}" method="POST" autocomplete="off">
		@method('PUT')
		@csrf
		<x-card>
			<x-form.select
				name="role"
				label="{{ __('form.user.role') }} <small class='required'>*</small>"
			>
				<option value=""> {{ __('form.please_select') }} </option>
				@foreach ($roles as $role)
					<option
						value="{{ $role->name }}"
						{{ ( ( $user->hasRoles->first()->id ?? '' ) == $role->id ) ? 'selected' : '' }}
					>
						{{ $role->name }}
					</option>
				@endforeach
			</x-form.select>
				
			<x-slot name="footer">
				<x-form.button type="submit" name="save" icon="bx bx-save" label="{!! __('button.save') !!}" />
			</x-slot>
		</x-card>
	</form>
</x-app-layout>
