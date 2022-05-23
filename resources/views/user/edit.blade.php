<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{{ route('user.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
	</x-slot>

	<form action="{{ route('user.update', $user) }}" method="POST" autocomplete="off">
		@method('PUT')
		@csrf
		<x-card>
			<div class="row">
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-12">
							<x-form.input
								name="name"
								required
								autofocus
								:value="old('name', $user->name)"
								label="{!! __('form.name') !!} <mdall class='required'>*</mdall>"
							/>
						</div>
						<div class="col-md-12">
							<x-form.input
								type="text"
								name="phone"
								:value="old('phone', $user->phone)"
								label="{!! __('form.phone') !!}"
							/>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-12">
							<x-form.input
								type="text"
								name="position"
								:value="old('position', $user->position)"
								label="{!! __('form.user.position') !!}"
							/>
						</div>
						<div class="col-md-9">
							<x-form.choices
								type="radio"
								name="gender"
								:data="$gender"
								:checked="old('gender', $user->gender)"
								label="{!! __('form.gender') !!}"
							/>
						</div>
						<div class="col-md-3">
							<x-form.switch
								type="custom-switch-danger"
								name="is_suspended"
								:checked="old('is_suspended', $user->is_suspended)"
								label="{!! __('form.user.suspense') !!}"
							/>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<x-form.input
						type="text"
						name="address"
						:value="old('address', $user->address)"
						label="{!! __('form.address') !!}"
					/>
				</div>
				<div class="col-md-12">
					<x-form.textarea
						name="bio"
						rows="3"
						label="{!! __('form.user.bio') !!}"
					>
						{{ old('bio', $user->bio) }}
					</x-form.textarea>
				</div>
				<div class="col-md-6">
					Doctor
					<x-bss-form.select name="doctor_id">
						<option value="">Please choose</option>
						@foreach ($doctor as $data)
							<option value="{{ $data->id }}" {{ $data->id == old('doctor_id', $user->doctor) ? 'selected' : '' }}>{{ $data->name_en }}</option>
						@endforeach
					</x-bss-form.select>
				</div>
			</div>

			<x-slot name="footer">
				<x-form.button type="submit" name="save" icon="bx bx-save" label="{!! __('button.save') !!}" />
			</x-slot>
		</x-card>
	</form>

</x-app-layout>
