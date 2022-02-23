<x-app-layout>
	<x-slot name="css">
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
		<script>
			$(document).ready(function(){
				$image_crop = $('#image-profile').croppie({
					enableExif: true,
					enableOrientation: true,
					viewport: {
						width:400,
						height:400,
						type:'circle'
					},
					boundary:{
						width:400,
						height:400
					}
				});
				$('#btn_change_profile').click(function () {
					$('#file_image').trigger('click');
				});
				$('#file_image').on('change', function(){
					var reader = new FileReader();
					reader.onload = function (event) {
					$image_crop.croppie('bind', {
						url: event.target.result
					}).then(function(){
						// console.log('jQuery bind complete');
						$('#croppie-image').removeClass('sr-only');
						$('#preview-image').addClass('sr-only');
					});
					}
					reader.readAsDataURL(this.files[0]);
				});

				$('#crop_image').click(function(event){
					if( document.getElementById("file_image").files.length ){
						$image_crop.croppie('result', {
							circle: false,
							type: 'canvas',
							size: 'viewport'
						}).then(function(response){
							$.ajax({
								url: "{{ route('user.update_account', 'image') }}",
								type: "POST",
								data: { "image": response, '_method' : 'PUT' },
								success: function(data) {
									if(data.success){
										location.reload();
									}else{
										console.log(data);
									}
								},
								error: function(data) {
									console.log(data);
								},
							});
						})
					}else{
						Swal.fire({
							icon: 'warning',
							title: 'Select a photo first.',
							confirmButtonText: 'Confirm',
							timer: 2500
						});
					}
				});
			});

			$(document).ready(function () {
				$('#datatable-ability tbody tr').each(function () {
					if ($(this).find('.chb_child').length==0) {
						$(this).find('.chb_all').parent().parent().parent().remove()
					}
				});
			});
		</script>
	</x-slot>
	<x-slot name="header">
		<x-form.button href="{{ route('user.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="{{ __('button.back') }}"/>
	</x-slot>

	<section id="page-account-settings">
		<div class="row">
			<!-- left menu section -->
			<div class="col-md-3 mb-2 mb-md-0 pills-stacked">
				<ul class="nav nav-pills flex-column">
					<li class="nav-item tw-mb-2">
						<a
							id="account-pill-general"
							class="nav-link d-flex align-items-center {{ $type == 'general' ? 'active' : '' }}"
							href="{{ $type == 'general' ? '#general' : route('user.account', 'general') }}"
						>
							<i class="bx bx-cog tw-mr-3 tw--mt-0.5"></i>
							<span>{{ __('button.general') }}</span>
						</a>
					</li>
					<li class="nav-item tw-mb-2">
						<a
							id="account-pill-image"
							class="nav-link d-flex align-items-center {{ $type == 'image' ? 'active' : '' }}"
							href="{{ $type == 'image' ? '#image' : route('user.account', 'image') }}"
						>
							<i class="bx bx-image tw-mr-3 tw--mt-0.5"></i>
							<span>{{ __('button.profile_photo') }}</span>
						</a>
					</li>
					<li class="nav-item tw-mb-2">
						<a
							id="account-pill-password"
							class="nav-link d-flex align-items-center {{ $type == 'change_password' ? 'active' : '' }}"
							href="{{ $type == 'change_password' ? '#change_password' : route('user.account', 'change_password') }}"
						>
							<i class="bx bx-lock tw-mr-3 tw--mt-0.5"></i>
							<span>{{ __('button.change_password') }}</span>
						</a>
					</li>
					<li class="nav-item tw-mb-2">
						<a
							id="account-pill-password"
							class="nav-link d-flex align-items-center {{ $type == 'ability' ? 'active' : '' }}"
							href="{{ $type == 'ability' ? '#ability' : route('user.account', 'ability') }}"
						>
							<i class="bx bx-check-shield mr-1 tw-mr-3 tw--mt-0.5"></i>
							<span>{{ __('button.ability') }}</span>
						</a>
					</li>
				</ul>
			</div>
			<!-- right content section -->
			<div class="col-md-9">
				<form action="{{ route('user.update_account', $type) }}" method="POST" autocomplete="off">
					@method('PUT')
					@csrf
					<x-card>
						@if ( $type == 'image' )
							<x-slot name="header">
								{{ __('form.user.change_profile_pricture') }}
							</x-slot>

							<div class="mt-2 sr-only" id="croppie-image">
								<img id="image-profile" src="{{ asset('images/users/'. (auth()->user()->image ?? 'default.png')) }}" />
								<input type="file" name="image" class="sr-only" id="file_image" accept="image/png, image/gif, image/jpeg" />
							</div>
							<div class="mt-1" style="width: 400px; height: 400px; margin: auto;" id="preview-image">
								<img width="100%" src="{{ asset('images/users/'. (auth()->user()->image ?? 'default.png')) }}" />
							</div>
							
							<x-slot name="footer">
								<div class="text-center">
									<x-form.button name="save" id="crop_image" icon="bx bx-save" label="{!! __('button.save') !!}" />
									<x-form.button name="change" color="info" id="btn_change_profile" icon="bx bx-image" label="{!! __('button.change') !!}" />
								</div>
							</x-slot>

						@elseif ( $type == 'change_password' )
							<x-slot name="header">
								{{ __('form.user.change_password') }}
							</x-slot>
							<div class="row">
								<div class="col-sm-12">
									<x-form.input
										type="password"
										name="current_password"
										autocomplete="password"
										required label="{!! __('form.user.current_password') !!} <small class='required'>*</small>"
									/>
								</div>
								<div class="col-sm-12">
									<x-form.input
										type="password"
										name="password"
										autocomplete="new-password"
										required label="{!! __('form.user.new_password') !!} <small class='required'>*</small>"
									/>
								</div>
								<div class="col-sm-12">
									<x-form.input
										type="password"
										name="password_confirmation"
										required
										label="{!! __('form.user.password_confirmation') !!} <small class='required'>*</small>"
									/>
								</div>
							</div>
							<x-slot name="footer">
								<x-form.button type="submit" name="save" icon="bx bx-save" label="{!! __('button.save') !!}" />
							</x-slot>
						@elseif ( $type == 'ability' )
							<x-slot name="header">
								{{ __('form.user.ability') }}
							</x-slot>
							<x-table id="datatable-ability">
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
												<li class="list-group-item border-0 d-flex justify-content-between chb_all">
													{{ $ability_module->module }}
													<i class="bx bxs-chevron-right ml-1"></i>
												</li>
											</ul>
										</td>

										@if ($ability_module->abilities->count() > 0)
											<td>
												<ul class="list-group list-group-child">
													@foreach ($ability_module->abilities as $ability)
														@if (auth()->user()->abilities()->contains($ability->name))
															<li class="list-group-item border-0 tw-py-2 chb_child">
																{{ $ability->name }}
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
						@else
							<x-slot name="header">
								{{ __('form.user.general') }} - {{ ( auth()->user()->isWebDev? 'Web Developer' : auth()->user()->hasRoles->first()->name ) }}
							</x-slot>
							<div class="row">
								<div class="col-sm-12">
									<x-form.input
										type="text"
										name="name"
										required
										autofocus
										:value="old('name', auth()->user()->name)"
										label="{!! __('form.name') !!} <small class='required'>*</small>"
									/>
								</div>
								<div class="col-sm-12">
									<x-form.input
										type="text"
										name="phone"
										:value="old('phone', auth()->user()->phone)"
										label="{!! __('form.phone') !!}"
									/>
								</div>
								<div class="col-sm-6">
									<x-form.input
										type="text"
										name="position"
										:value="old('position', auth()->user()->position)"
										label="{!! __('form.user.position') !!}"
									/>
								</div>
								<div class="col-sm-6">
									<x-form.choices
										type="radio"
										name="gender"
										:data="$gender"
										:checked="old('gender', auth()->user()->gender)"
										label="{!! __('form.gender') !!}"
									/>
								</div>
								<div class="col-sm-12">
									<x-form.input
										type="text"
										name="address"
										:value="old('address', auth()->user()->address)"
										label="{!! __('form.address') !!}"
									/>
								</div>
								<div class="col-sm-12">
									<x-form.textarea
										name="bio"
										rows="3"
										label="{!! __('form.user.bio') !!}"
									>
										{{ old('bio', auth()->user()->bio) }}
									</x-form.textarea>
								</div>
							</div>
							<x-slot name="footer">
								<x-form.button type="submit" name="save" icon="bx bx-save" label="{!! __('button.save') !!}" />
							</x-slot>
						@endif
					</x-card>
				</form>
			</div>
		</div>
	</section>

</x-app-layout>
