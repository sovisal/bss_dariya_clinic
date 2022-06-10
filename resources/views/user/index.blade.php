<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{{ route('user.create') }}" icon="bx bx-plus" label="Create" />
	</x-slot>

	<x-card :foot="false" :head="false">
		<x-table id="datatables" class="table-hover table-bordered" data-table="users">
			<x-slot name="thead">
				<tr>
					<th width="6%" class="no-sort">
						{!! __('table.no') !!}
					</th>
					<th>{!! __('table.name') !!}</th>
					<th>{!! __('table.username') !!}</th>
					<th>{!! __('table.role') !!}</th>
					<th>{!! __('table.position') !!}</th>
					<th>Doctor</th>
					<th>{!! __('table.status') !!}</th>
					<th width="10%">{!! __('table.action') !!}</th>
				</tr>
			</x-slot>
			@foreach ($users as $key => $user)
				<tr>
					<td class="text-center">
						{{ ++$key }}
					</td>
					<td>{!! $user->name !!}</td>
					<td>{!! $user->username !!}</td>
					<td class="text-center">{!! $user->hasRoles->first()->name ?? '-' !!}</td>
					<td class="text-center">{!! $user->position !!}</td>
					<td>{!! $user->doctor() ? $user->doctor()->name_en : '' !!}</td>
					<td class="text-center">
						{!! $user->is_suspended ? '<span class="badge badge-light-danger">'. __('table.suspended') .'</span>' : '<span class="badge badge-light-success">'. __('table.active') .'</span>' !!}
					</td>
					<td class="text-center">
						@canany(['UpdateUser','DeleteUser','AssignUserRole','AssignUserAbility','UpdateUserPassword'])
							<x-table-action>
								@can('UpdateUser')
									<a class="dropdown-item" href="{{ route('user.edit', $user->id) }}"><i class="bx bx-edit-alt mr-1"></i> {{ __('button.crud.edit') }}</a>
								@endcan
								@can('UpdateUserPassword')
									<a class="dropdown-item" href="{{ route('user.password', $user->id) }}"><i class="bx bx-key mr-1"></i> {{ __('button.change_password') }}</a>
								@endcan
								@can('AssignUserRole')
									<a class="dropdown-item" href="{{ route('user.role', $user->id) }}"><i class="bx bxs-graduation mr-1"></i> {{ __('button.role') }}</a>
								@endcan
								@can('AssignUserAbility')
									<a class="dropdown-item" href="{{ route('user.ability', $user->id) }}"><i class="bx bxs-check-shield mr-1"></i> {{ __('button.specific_ability') }}</a>
								@endcan
								@can('DeleteUser')
									<a class="dropdown-item confirmDelete" href="javascript:void(0);" data-id="{{ $user->id }}"><i class="bx bx-trash mr-1"></i> {{ __('button.crud.delete') }}</a>
									<form class="sr-only" id="form-delete-{{ $user->id }}" action="{{ route('user.delete', $user->id) }}" method="POST">
										@csrf
										@method('DELETE')
									</form>
								@endcan
							</x-table-action>
						@endcanany
					</td>
				</tr>
			@endforeach
		</x-table>
	</x-card>
	
	<x-modal-confirm-delete />

</x-app-layout>
