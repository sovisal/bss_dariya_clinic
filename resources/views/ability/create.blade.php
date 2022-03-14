<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{{ route('user.ability.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
	</x-slot>
	<x-slot name="js">
		<script>
			$(document).on('change', '[name="category[]"]', function () {
				var category = $(this).val();
				var value = $('#module').val();
				$(this).parent().parent().parent().find('[name="name[]"]').val(category + value);
				$(this).parent().parent().parent().find('[name="label[]"]').val(value +' '+ category);
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

			$('#crud').change(function () {
				if ($(this).is(':checked')) {
					var module = $('#module').val();
					var crud_ability = `<div class="ability-option ability-option-crud">
											<input type="hidden" name="hidden_crud[]" value="true" />
											<div class="row">
												<div class="col-sm-3">
													<x-form.select
														name="category[]"
														:select2="false"
														required
														label="{!! __('form.ability.category') !!} <small class='required'>*</small>"
													>
														<option value="ViewAny" selected>ViewAny</option>
														<option value="Create">Create</option>
														<option value="Update">Update</option>
														<option value="Delete">Delete</option>
														<option value="Other">Other</option>
													</x-form.select>
												</div>
												<div class="col-sm-4">
													<x-form.input
														name="name[]"
														value="ViewAny${ module }"
														required
														label="{!! __('form.name') !!} <small class='required'>*</small>"
													/>
												</div>
												<div class="col-sm-4">
													<x-form.input
														name="label[]"
														value="${ module } ViewAny"
														required
														label="{!! __('form.label') !!} <small class='required'>*</small>"
													/>
												</div>
												<div class="col-sm-1">
												</div>
											</div>
										</div>
										<div class="ability-option ability-option-crud">
											<input type="hidden" name="hidden_crud[]" value="true" />
											<div class="row">
												<div class="col-sm-3">
													<x-form.select
														name="category[]"
														:select2="false"
														required
														label="{!! __('form.ability.category') !!} <small class='required'>*</small>"
													>
														<option value="ViewAny">ViewAny</option>
														<option value="Create" selected>Create</option>
														<option value="Update">Update</option>
														<option value="Delete">Delete</option>
														<option value="Other">Other</option>
													</x-form.select>
												</div>
												<div class="col-sm-4">
													<x-form.input
														name="name[]"
														value="Create${ module }"
														required
														label="{!! __('form.name') !!} <small class='required'>*</small>"
													/>
												</div>
												<div class="col-sm-4">
													<x-form.input
														name="label[]"
														value="${ module } Create"
														required
														label="{!! __('form.label') !!} <small class='required'>*</small>"
													/>
												</div>
												<div class="col-sm-1">
												</div>
											</div>
										</div>
										<div class="ability-option ability-option-crud">
											<input type="hidden" name="hidden_crud[]" value="true" />
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
														<option value="Update" selected>Update</option>
														<option value="Delete">Delete</option>
														<option value="Other">Other</option>
													</x-form.select>
												</div>
												<div class="col-sm-4">
													<x-form.input
														name="name[]"
														value="Update${ module }"
														required
														label="{!! __('form.name') !!} <small class='required'>*</small>"
													/>
												</div>
												<div class="col-sm-4">
													<x-form.input
														name="label[]"
														value="${ module } Update"
														required
														label="{!! __('form.label') !!} <small class='required'>*</small>"
													/>
												</div>
												<div class="col-sm-1">
												</div>
											</div>
										</div>
										<div class="ability-option ability-option-crud">
											<input type="hidden" name="hidden_crud[]" value="true" />
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
														<option value="Delete" selected>Delete</option>
														<option value="Other">Other</option>
													</x-form.select>
												</div>
												<div class="col-sm-4">
													<x-form.input
														name="name[]"
														value="Delete${ module }"
														required
														label="{!! __('form.name') !!} <small class='required'>*</small>"
													/>
												</div>
												<div class="col-sm-4">
													<x-form.input
														name="label[]"
														value="${ module } Delete"
														required
														label="{!! __('form.label') !!} <small class='required'>*</small>"
													/>
												</div>
												<div class="col-sm-1">
												</div>
											</div>
										</div>`;
					$( ".ability-list" ).append(crud_ability);
				}else{
					$( ".ability-option-crud" ).remove();
				}
			});
		</script>
	</x-slot>

	<form action="{{ route('user.ability.store') }}" method="POST" autocomplete="off">
		@csrf
		<x-card>
			<x-form.input
				name="module"
				required
				label="{!! __('form.ability.module') !!} <small class='required'>*</small>"
			/>

			<x-card :actionShow="false" :foot="false" class="border mb-0 card-hover">
				<x-slot name="header">
					{{ __('form.ability.ability_list') }}
					<div class="d-flex align-items-center">
						<label for="" class="tw-mr-1">CRUD</label>
						<x-form.switch-only
							name="crud"
						/>
					</div>
				</x-slot>
				<div class="ability-list">
					@if (old('category') && count(old('category')) > 0)
						@foreach (old('category') as $c => $category )
							<div class="ability-option {{ ((old('hidden_crud')[$c]=='true')? 'ability-option-crud' : '') }}">
								<input type="hidden" name="hidden_crud[]" value="{{ old('hidden_crud')[$c] }}" />
								<div class="row">
									<div class="col-sm-3">
										<x-form.select
											name="category[]"
											data-no_search="true"
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
										@if (old('hidden_crud')[$c]=='false')
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
				<x-form.save-option name="{!! __('button.save') !!}"/>
			</x-slot>
		</x-card>
	</form>

</x-app-layout>
