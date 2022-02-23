<x-app-layout>
	<x-slot name="css">
		<style>
			
		</style>
	</x-slot>
	<x-slot name="js">
		<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
		<script>
			
		</script>
	</x-slot>

	<form action="{{ route('setting.update') }}" method="POST" autocomplete="off">
		@method('PUT')
		@csrf
		<x-card>
			<div class="row">
				<div class="col-md-9">
					<div class="row">
						<div class="col-md-6">
							<x-form.input
								name="clinic_name_kh"
								required
								autofocus
								:value="old('clinic_name_kh', $setting->clinic_name_kh)"
								label="Clinic Name (KH) <small class='required'>*</small>"
							/>
						</div>
						<div class="col-md-6">
							<x-form.input
								name="clinic_name_en"
								required
								:value="old('clinic_name_en', $setting->clinic_name_en)"
								label="Clinic Name (EN) <small class='required'>*</small>"
							/>
						</div>
						<div class="col-md-6">
							<x-form.input
								name="sign_name_kh"
								required
								autofocus
								:value="old('sign_name_kh', $setting->sign_name_kh)"
								label="Sign Name (KH) <small class='required'>*</small>"
							/>
						</div>
						<div class="col-md-6">
							<x-form.input
								name="sign_name_en"
								required
								:value="old('sign_name_en', $setting->sign_name_en)"
								label="Sign Name (EN) <small class='required'>*</small>"
							/>
						</div>
						<div class="col-md-12">
							<x-form.textarea
								name="address"
								required
								label="Address <small class='required'>*</small>"
							>
								{{ old('address', $setting->address) }}
							</x-form.textarea>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<x-form.input-file-image name="logo" path="{{ asset('images/site') }}" :value="$setting->logo"/>
				</div>
				<div class="col-md-12">
					<x-form.textarea
						name="description"
						class="my-editor"
						required
						label="Description <small class='required'>*</small>"
					>
						{{ old('description', $setting->description) }}
					</x-form.textarea>

				</div>
			</div>
			<x-slot name="footer">
				<x-form.button type="submit" name="save" icon="bx bx-save" label="{!! __('button.save') !!}" />
			</x-slot>
		</x-card>
	</form>

</x-app-layout>