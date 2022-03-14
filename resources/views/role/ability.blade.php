<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{{ route('user.role.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
	</x-slot>

	<x-slot name="css">
		<link rel="stylesheet" href="{{ asset('css/bootstrap-duallistbox.min.css') }}">
		<style>
			#datatable-ability td{
				background: #F2F4F4;
			}
			.list-group-child li:first-child{
				padding-top: 15px !important;
			}
			.list-group-child li:last-child{
				padding-bottom: 15px !important;
			}
		</style>
	</x-slot>
	
	<x-slot name="js">
		<script src="{{ asset('js/jquery.bootstrap-duallistbox.min.js') }}"></script>
		<script>
			$('.chb_all').change(function () {
				if ($(this).is(':checked')) {
					$(this).closest('tr').find('.chb_child').prop('checked', true);
				} else {
					$(this).closest('tr').find('.chb_child').prop('checked', false);
				}
			});
			$('.chb_child').change(function () {
				if ($(this).is(':checked') && $(this).closest('tr').find('.chb_child:checked').length == $(this).closest('tr').find('.chb_child').length) {
					$(this).closest('tr').find('.chb_all').prop('checked', true);
				} else {
					$(this).closest('tr').find('.chb_all').prop('checked', false);
				}
			});

			$(document).ready(function () {
				$('#datatable-ability tbody tr').each(function () {
					if ($(this).find('.chb_child').length==0) {
						// $(this).find('.chb_all').parent().parent().html($(this).find('.chb_all').parent().find('label').html());
						$(this).find('.chb_all').closest('tr').remove()
					}else if ($(this).find('.chb_child:checked').length == $(this).find('.chb_child').length) {
						$(this).find('.chb_all').prop('checked', true);
					}
				});
			});
		</script>
	</x-slot>


	<form action="{{ route('user.role.assign_ability', $role) }}" method="POST" autocomplete="off">
		@method('PUT')
		@csrf
		<x-card>
			<x-slot name="header">
				<h4 class="card-title">{{ subModule() }} - <span class="badge badge-primary">{{ $role->name }}</span></h4>
			</x-slot>
			<x-table id="datatable-ability" class="">
				<x-slot name="thead">
					<tr>
						<th>{{ __('table.name') }}</th>
						<th width="70%">{{ __('table.ability.abilities') }}</th>
					</tr>
				</x-slot>
				@foreach ($ability_modules as $ability_module)
					<tr>
						<td style="vertical-align: top;">
							<ul class="list-group">
								<li class="list-group-item border-0 d-flex justify-content-between">
									<x-form.checkbox
										name="ability_module[]"
										class="chb_all"
										id="chb_all_{{ $ability_module->id }}"
										label="{{ $ability_module->module }}"
									/>
									<i class="bx bxs-chevron-right ml-1"></i>
								</li>
							</ul>
						</td>

						@if ($ability_module->abilities->count() > 0)
							<td>
								<ul class="list-group list-group-child">
									@foreach ($ability_module->abilities as $ability)
										@if (auth()->user()->abilities()->contains($ability->name) || auth()->user()->isWebDev)
											<li class="list-group-item border-0 tw-py-2">
												<x-form.checkbox
													name="ability[]"
													class="chb_child"
													id="chb_{{ $ability->id }}"
													value="{{ $ability->name }}"
													checked="{{ $role->abilities()->contains($ability->name) }}"
													label="{{ $ability->name }}"
												/>
											</li>
										@endif
									@endforeach
								</ul>
							</td>
						@else
							<td></td>
						@endif
					</tr>
				@endforeach
			</x-table>
			<x-slot name="footer">
				<x-form.button type="submit" name="save" icon="bx bx-save" label="{!! __('button.save') !!}" />
			</x-slot>
		</x-card>
	</form>

</x-app-layout>
