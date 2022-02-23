<x-app-layout>
	<x-card :foot="false">
		<x-table class="table-hover" id="datatables" data-table="roles">
			<x-slot name="thead">
				<tr>
					<th width="6%" class="no-sort">
						<div class="checkbox">
							<input type="checkbox" class="checkbox-input" name="check_all" id="check_all">
							<label for="check_all"></label>
						</div>
					</th>
					<th>{!! __('table.label') !!}</th>
					<th>{!! __('table.name') !!}</th>
					<th width="10%">{!! __('table.action') !!}</th>
				</tr>
			</x-slot>
			@foreach ($roles as $key => $role)
				<tr>
					<td class="text-center">
						<div class="checkbox">
							<input type="checkbox" class="checkbox-input" name="check_ids[]" id="chb-{{ $role->id }}" value="{{ $role->id }}">
							<label for="chb-{{ $role->id }}"></label>
						</div>
					</td>
					<td>{!! $role->label !!}</td>
					<td>{!! $role->name !!}</td>
					<td class="text-center">
						@canany(['UpdateRole','DeleteRole','AssignRoleAbility'])
							<x-table-action>
								@can('UpdateRole')
									<a class="dropdown-item" href="{{ route('role.edit', $role->id) }}"><i class="bx bx-edit-alt mr-1"></i> {{ __('button.crud.edit') }}</a>
								@endcan
								@can('AssignRoleAbility')
									<a class="dropdown-item" href="{{ route('role.ability', $role->id) }}"><i class="bx bxs-check-shield mr-1"></i> {{ __('button.ability') }}</a>
								@endcan
								@can('DeleteRole')
									<a class="dropdown-item confirmDelete" href="javascript:void(0);" data-id="{{ $role->id }}"><i class="bx bx-trash mr-1"></i> {{ __('button.crud.delete') }}</a>
									<form class="sr-only" id="form-delete-{{ $role->id }}" action="{{ route('role.delete', $role->id) }}" method="POST">
										@csrf
										@method('DELETE')
										<button class="sr-only" id="btn-{{ $role->id }}">Delete</button>
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
