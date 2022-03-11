<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{{ route('patient.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
	</x-slot>

	<x-card :head="false" :foot="false">
		<div class="row">
			<div class="col-sm-3">
				<img src="{{ (($patient->photo)? asset('images/patients/'. $patient->photo) : asset('images/browse-image.jpg') ) }}" alt="...">
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<b>Name KH:</b> 
					{{ $patient->name_kh }}
				</div>
				<div class="form-group">
					<b>Name EN:</b> 
					{{ $patient->name_en }}
				</div>
				<div class="form-group">
					<b>Gender:</b> 
					{{ $patient->name_en }}
				</div>
			</div>
			<div class="col-sm-3">
				
			</div>
			<div class="col-sm-3">
				
			</div>
		</div>
		{{-- <table class="table-form">
			<tr>
				<td width="20%" rowspan="3">
				</td>
				<td class="text-right">Name KH:</td>
				<td>{{ $patient->name_kh }}</td>
				<td class="text-right">Name EN:</td>
				<td>{{ $patient->name_en }}</td>
			</tr>
			<tr>
				<td class="text-right">Name KH:</td>
				<td>{{ $patient->name_kh }}</td>
				<td class="text-right">Name EN:</td>
				<td>{{ $patient->name_en }}</td>
			</tr>
			<tr>
				<td class="text-right">Name KH:</td>
				<td>{{ $patient->name_kh }}</td>
				<td class="text-right">Name EN:</td>
				<td>{{ $patient->name_en }}</td>
			</tr>
		</table> --}}
	</x-card>

</x-app-layout>
