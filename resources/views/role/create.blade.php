<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{{ route('user.role.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
	</x-slot>

	<form action="{{ route('user.role.store') }}" method="POST" autocomplete="off">
		@csrf
		<x-card>
			<div class="row">
				<div class="col-sm-12">
					<x-form.input
						type="text"
						name="label"
						required
						autofocus
						label="{!! __('form.label') !!} <small class='required'>*</small>"
					/>
				</div>
				<div class="col-sm-12">
					<x-form.input
						type="text"
						name="name"
						required
						label="{!! __('form.name') !!} <small class='required'>*</small>"
					/>
				</div>
			</div>

			<x-slot name="footer">
				<x-form.save-option name="{!! __('button.save') !!}"/>
			</x-slot>
		</x-card>
	</form>

</x-app-layout>
