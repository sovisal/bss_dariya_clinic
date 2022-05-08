<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{{ route('para_clinic.echography.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
	</x-slot>
	<form action="{{ route('para_clinic.echography.update', $row) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
		@method('PUT')
		@csrf
		<x-card bodyClass="pb-0">			
			<table class="table-form striped">
				<tr>
					<th colspan="4" class="text-left tw-bg-gray-100">Echo COde #dasd123</th>
				</tr>
				@include('echography.form_input')
			</table>
			<br>
			<table class="table-form striped">
				<tr>
					<th colspan="4" class="text-left tw-bg-gray-100">Result</th>
				</tr>
				@if (view()->exists('echo_type.extra_form.' . $row->id))
					@include('echo_type.extra_form.' . $row->id)
				@else	
					@include('echo_type.extra_form.0')
				@endif
			</table>
			<x-slot name="footer">
				<x-form.button type="submit" icon="bx bx-save" label="Save" />
			</x-slot>
		</x-card>
	</form>

</x-app-layout>
