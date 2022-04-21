<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{{ route('prescription.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
	</x-slot>
	<form action="{{ route('prescription.update', $prescription->id) }}" method="POST" autocomplete="off">
		@method('PUT')
		@csrf
		<x-card bodyClass="pb-0">

			<x-slot name="footer">
				<x-form.button type="submit" icon="bx bx-save" label="Save" />
			</x-slot>
		</x-card>
	</form>

	<x-modal-image-crop />
</x-app-layout>
