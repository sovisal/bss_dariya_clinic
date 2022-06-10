<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{{ route('user.ability.create') }}" icon="bx bx-plus" label="Create" />
	</x-slot>

	<x-slot name="js">
		<script>
			function getDetail(id) { 
				pageLoading('hide');
				$.ajax({
					type: "POST",
					url: "{{ route('user.ability.show') }}",
					data: {
						'id': id
					},
					success: function(rs){
						if (rs.success) {
							$('#btn_edit').attr('href', rs.url);
							$('#table-ability-detail tbody').html(rs.tbody);
							$('.ability-module').html(rs.ability_module.module);
							$('#show-ability-modal').modal('show');
							pageLoading('hide');
						}
					},
					error: function(rs){
						pageLoading('hide');
						if (rs.responseJSON) flashMsg('error', "Error!", rs.responseJSON.message);
					}
				});
			 }
		</script>
	</x-slot>

	<x-card :foot="false" :head="false">
		<x-table class="table-bordered" id="datatables">
			<x-slot name="thead">
				<tr>
					<th width="6%">{!! __('table.no') !!}</th>
					<th>{!! __('table.ability.module') !!}</th>
					<th>{!! __('table.ability.abilities') !!}</th>
					<th width="10%">{!! __('table.action') !!}</th>
				</tr>
			</x-slot>
			@foreach ($ability_modules as $key => $ability_module)
				<tr>
					<td class="text-center">{!! ++$key !!}</td>
					<td>{!! $ability_module->module !!}</td>
					<td class="text-center">
						<span class="badge badge-light-primary">
							{!! $ability_module->abilities->count() !!}
						</span>
					</td>
					<td class="text-center">
						@canany(['UpdateAbility','DeleteAbility'])
							<x-table-action>
								<a
									class="dropdown-item"
									onclick="getDetail({{ $ability_module->id }})"
									href="javascript:void(0)"
								>
									<i class="bx bx-show-alt mr-1"></i> 
									{{ __('button.crud.show') }}
								</a>
								@can('UpdateAbility')
									<a
										class="dropdown-item"
										href="{{ route('user.ability.edit', $ability_module->id) }}"
									>
										<i class="bx bx-edit-alt mr-1"></i> 
										{{ __('button.crud.edit') }}
									</a>
								@endcan
								@can('DeleteAbility')
									<a
										class="dropdown-item confirmDelete"
										href="javascript:void(0);"
										data-id="{{ $ability_module->id }}"
									>
										<i class="bx bx-trash mr-1"></i> 
										{{ __('button.crud.delete') }}
									</a>
									<form class="sr-only" id="form-delete-{{ $ability_module->id }}" action="{{ route('user.ability.delete', $ability_module->id) }}" method="POST">
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

	
	<x-modal id="show-ability-modal" width="70%">
		<x-slot name="header">
			{{ __('alert.modal.show_ability') }} - <span class="badge badge-primary"></span>
		</x-slot>
		<x-slot name="footer">
			<x-form.button href="#" id="btn_edit" :hideLabelOnXS="true" icon="bx bx-edit" label="{{__('button.crud.edit')}}" />
		</x-slot>
		<div class="divider mt-0">
			<div class="divider-text ability-module tw-text-2xl text-primary"></div>
		</div>
		<div class="table-responsive">
			<x-table id="table-ability-detail" class="table-bordered table-striped table-hover">
				<x-slot name="thead">
					<tr>
						<th>{!! __('table.no') !!}</th>
						<th>{{ __('table.category') }}</th>
						<th>{{ __('table.name') }}</th>
						<th>{{ __('table.label') }}</th>
					</tr>
				</x-slot>
			</x-table>
		</div>
	</x-modal>
	
	<x-modal-confirm-delete />

</x-app-layout>
