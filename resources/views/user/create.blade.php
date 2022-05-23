<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{{ route('user.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
	</x-slot>

	<form action="{{ route('user.store') }}" method="POST" autocomplete="off">
		@csrf
		<x-card>
			<div class="row">
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-12">
							<x-form.input
								type="text"
								name="name"
								required
								autofocus
								label="{!! __('form.name') !!} <small class='required'>*</small>"
							/>
						</div>
						<div class="col-md-12">
							<x-form.choices
								type="radio"
								name="gender"
								label="{!! __('form.gender') !!}"
								:data="$gender"
							>
							</x-form.choices>
						</div>
						<div class="col-md-6">
							<x-form.input
								type="text"
								name="phone"
								label="{!! __('form.phone') !!}"
							/>
						</div>
						<div class="col-md-6">
							<x-form.input
								type="text"
								name="position"
								label="{!! __('form.user.position') !!}"
							/>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-12">
							<x-form.input
								name="username"
								required
								label="{!! __('form.username') !!} <small class='required'>*</small>"
							/>
						</div>
						<div class="col-md-12">
							<x-form.input
								type="password"
								name="password"
								autocomplete="new-password"
								required label="{!! __('form.user.password') !!} <small class='required'>*</small>"
							/>
						</div>
						<div class="col-md-12">
							<x-form.input
								type="password"
								name="password_confirmation"
								required
								label="{!! __('form.user.password_confirmation') !!} <small class='required'>*</small>"
							/>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<x-form.input
						type="text"
						name="address"
						label="{!! __('form.address') !!}"
					/>
				</div>
				<div class="col-md-12">
					<x-form.textarea
						name="bio"
						rows="3"
						label="{!! __('form.user.bio') !!}"
					/>
				</div>
				<div class="col-md-6">
					Doctor
					<x-bss-form.select name="doctor_id">
						<option value="">Please choose</option>
						@foreach ($doctor as $data)
							<option value="{{ $data->id }}">{{ $data->name_en }}</option>
						@endforeach
					</x-bss-form.select>
				</div>
			</div>

			<x-slot name="footer">
				<x-form.save-option name="{!! __('button.save') !!}"/>
			</x-slot>
		</x-card>
	</form>

</x-app-layout>
