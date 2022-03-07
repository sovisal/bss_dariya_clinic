<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{{ route('user.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
	</x-slot>
	<form action="{{ route('user.update_password', $user) }}" method="POST" autocomplete="off">
		@method('PUT')
		@csrf
		<div class="row justify-content-center">
			<div class="col-sm-6">
				<x-card>
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
				</x-card>
			</div>
		</div>
	</form>

</x-app-layout>
