<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{{ route('user.ability.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
	</x-slot>
	<x-slot name="js">
		<script>
			$(document).on('change', '[name="category[]"],[name="old_category[]"]', function () {
				var category = $(this).val();
				var value = $('#module').val();
				$(this).parent().parent().parent().find('[name="name[]"]').val(category + value);
				$(this).parent().parent().parent().find('[name="label[]"]').val(value +' '+ category);
				$(this).parent().parent().parent().find('[name="old_name[]"]').val(category + value);
				$(this).parent().parent().parent().find('[name="old_label[]"]').val(value +' '+ category);
			});

			$('#module').keyup(function () {
				var value = $(this).val();
				$('.ability-option').each(function () {
					var category = $(this).find('[name="category[]"]').val();
					$(this).find('[name="name[]"]').val(category + value);
					$(this).find('[name="label[]"]').val(value +' '+ category);
				});
			});

			$('.add-more-ability-option').click(function () {
				var module = $('#module').val();
				var ability = `<div class="ability-option ability-option-crud">
									<input type="hidden" name="hidden_crud[]" value="false" />
									<div class="row">
										<div class="col-sm-3">
											<x-form.select
												name="category[]"
												:select2="false"
												required
												label="{!! __('form.ability.category') !!} <small class='required'>*</small>"
											>
												<option value="ViewAny">ViewAny</option>
												<option value="Create">Create</option>
												<option value="Update">Update</option>
												<option value="Delete">Delete</option>
												<option value="Other" selected>Other</option>
											</x-form.select>
										</div>
										<div class="col-sm-4">
											<x-form.input
												name="name[]"
												value="Other${ module }"
												required
												label="{!! __('form.name') !!} <small class='required'>*</small>"
											/>
										</div>
										<div class="col-sm-4">
											<x-form.input
												name="label[]"
												value="${ module } Other"
												required
												label="{!! __('form.label') !!} <small class='required'>*</small>"
											/>
										</div>
										<div class="col-sm-1">
											<x-form.field class="text-center tw-pt-3">
												<a href="javascript:void(0)" class="text-danger d-block mt-2 remove-ability-option"><i class="bx bx-x-circle"></i></a>
											</x-form.field>
										</div>
									</div>
								</div>`;
				$( ".ability-list" ).append(ability);
			});
			$(document).on('click', '.remove-ability-option', function () {
				$(this).parent().parent().parent().parent().remove()
			});

		</script>
	</x-slot>
	<form action="{{ route('user.ability.update', $ability_module) }}" method="POST" autocomplete="off">
		@method('PUT')
		@csrf
		<x-card>
			<x-form.input
				name="module"
				value="{{ $ability_module->module }}"
				required
				label="{!! __('form.ability.module') !!} <small class='required'>*</small>"
			/>

			<x-card :actionShow="false" :foot="false" class="border mb-0 card-hover">
				<x-slot name="header">
					{{ __('form.ability.ability_list') }}
				</x-slot>
				<div class="ability-list">
					@if ((old('category') && count(old('category')) > 0) || (old('old_category') && count(old('old_category')) > 0))
						@if (old('category') && count(old('category')) > 0)
							@foreach (old('category') as $c => $category )
								<div class="ability-option">
									<div class="row">
										<div class="col-sm-3">
											<x-form.select
												name="category[]"
												:select2="false"
												required
												label="{!! __('form.ability.category') !!} <small class='required'>*</small>"
											>
												<option value="ViewAny" {{ (($category=='ViewAny')? 'selected' : '') }}>ViewAny</option>
												<option value="Create" {{ (($category=='Create')? 'selected' : '') }}>Create</option>
												<option value="Update" {{ (($category=='Update')? 'selected' : '') }}>Update</option>
												<option value="Delete" {{ (($category=='Delete')? 'selected' : '') }}>Delete</option>
												<option value="Other" {{ (($category=='Other')? 'selected' : '') }}>Other</option>
											</x-form.select>
										</div>
										<div class="col-sm-4">
											<x-form.input
												name="name[]"
												value="{{ old('name')[$c] }}"
												required
												label="{!! __('form.name') !!} <small class='required'>*</small>"
											/>
										</div>
										<div class="col-sm-4">
											<x-form.input
												name="label[]"
												value="{{ old('label')[$c] }}"
												required
												label="{!! __('form.label') !!} <small class='required'>*</small>"
											/>
										</div>
										<div class="col-sm-1">
											<x-form.field class="text-center tw-pt-3">
												<a href="javascript:void(0)" class="text-danger d-block mt-2 remove-ability-option"><i class="bx bx-x-circle"></i></a>
											</x-form.field>
										</div>
									</div>
								</div>
							@endforeach
						@endif
						@if (old('old_category') && count(old('old_category')) > 0)
							@foreach (old('old_category') as $oc => $old_category )
								<div class="ability-option">
									<input type="hidden" name="old_ability_id[]" value="{{ old('old_ability_id')[$oc] }}">
									<input type="hidden" name="old_in_used[]" value="{{ old('old_in_used')[$oc] }}">
									<div class="row">
										<div class="col-sm-3">
											<x-form.select
												name="old_category[]"
												:select2="false"
												required
												label="{!! __('form.ability.category') !!} <small class='required'>*</small>"
											>
												<option value="ViewAny" {{ (($old_category=='ViewAny')? 'selected' : '') }}>ViewAny</option>
												<option value="Create" {{ (($old_category=='Create')? 'selected' : '') }}>Create</option>
												<option value="Update" {{ (($old_category=='Update')? 'selected' : '') }}>Update</option>
												<option value="Delete" {{ (($old_category=='Delete')? 'selected' : '') }}>Delete</option>
												<option value="Other" {{ (($old_category=='Other')? 'selected' : '') }}>Other</option>
											</x-form.select>
										</div>
										<div class="col-sm-4">
											<x-form.input
												name="old_name[]"
												value="{{ old('old_name')[$oc] }}"
												required
												label="{!! __('form.name') !!} <small class='required'>*</small>"
											/>
										</div>
										<div class="col-sm-4">
											<x-form.input
												name="old_label[]"
												value="{{ old('old_label')[$oc] }}"
												required
												label="{!! __('form.label') !!} <small class='required'>*</small>"
											/>
										</div>
										<div class="col-sm-1">
											@if (old('old_in_used')[$oc] == 'true')
												<x-form.field class="text-center tw-pt-3">
													<a href="javascript:void(0)" class="text-danger d-block mt-2 remove-ability-option"><i class="bx bx-x-circle"></i></a>
												</x-form.field>
											@endif
										</div>
									</div>
								</div>
							@endforeach
						@endif
					@else
						@foreach ($ability_module->abilities as $ability )
							<div class="ability-option">
								<input type="hidden" name="old_ability_id[]" value="{{ $ability->id }}">
								<input type="hidden" name="old_in_used[]" value="{{ (($ability->users->count()==0 && $ability->roles->count()==0)? 'true' : '') }}">
								<div class="row">
									<div class="col-sm-3">
										<x-form.select
											name="old_category[]"
											:select2="false"
											required
											label="{!! __('form.ability.category') !!} <small class='required'>*</small>"
										>
											<option value="ViewAny" {{ (($ability->category=='ViewAny')? 'selected' : '') }}>ViewAny</option>
											<option value="Create" {{ (($ability->category=='Create')? 'selected' : '') }}>Create</option>
											<option value="Update" {{ (($ability->category=='Update')? 'selected' : '') }}>Update</option>
											<option value="Delete" {{ (($ability->category=='Delete')? 'selected' : '') }}>Delete</option>
											<option value="Other" {{ (($ability->category=='Other')? 'selected' : '') }}>Other</option>
										</x-form.select>
									</div>
									<div class="col-sm-4">
										<x-form.input
											name="old_name[]"
											value="{{ $ability->name }}"
											required
											label="{!! __('form.name') !!} <small class='required'>*</small>"
										/>
									</div>
									<div class="col-sm-4">
										<x-form.input
											name="old_label[]"
											value="{{ $ability->label }}"
											required
											label="{!! __('form.label') !!} <small class='required'>*</small>"
										/>
									</div>
									<div class="col-sm-1">
										@if ($ability->users->count()==0 && $ability->roles->count()==0)
											<x-form.field class="text-center tw-pt-3">
												<a href="javascript:void(0)" class="text-danger d-block mt-2 remove-ability-option"><i class="bx bx-x-circle"></i></a>
											</x-form.field>
										@endif
									</div>
								</div>
							</div>
						@endforeach
					@endif
				</div>
				<div class="tw-mt-2">
					<a href="javascript:void(0)" class="add-more-ability-option"><i class="bx bx-plus"></i> {{ __('button.add') }}</a>
				</div>
			</x-card>
				
			<x-slot name="footer">
				<x-form.button type="submit" name="save" icon="bx bx-save" label="{!! __('button.save') !!}" />
			</x-slot>
		</x-card>
	</form>

</x-app-layout>
