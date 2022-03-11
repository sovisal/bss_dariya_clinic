<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{{ route('patient.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
	</x-slot>

	<x-card :head="false" :foot="false">
		{{-- <div class="row">
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
		</div> --}}

		<table class="table-form table-padding-sm striped">
			<tr>
				<td width="250px" rowspan="4" style="vertical-align: top; text-center">
					<img src="{{ (($patient->photo)? asset('images/patients/'. $patient->photo) : asset('images/browse-image.jpg') ) }}" alt="..." class="m-auto">
				</td>
				<th width="150px" class="text-right">Patient Code :</th>
				<td width="15%">PT-{{ str_pad($patient->id, 6, '0', STR_PAD_LEFT) }}</td>
				<th width="150px" class="text-right">Registered :</th>
				<td>{{ date('d-M-Y H:m', strtotime($patient->registered_at)) }}</td>
				<td width="150px" class="text-center" rowspan="4" style="vertical-align: top; text-center">
					<x-form.button href="{{ route('patient.edit', $patient->id) }}" class="float-right" icon="bx bx-edit-alt" label="Edit" />
				</td>
			</tr>
			<tr>
				{{-- <th class="text-right">Marital Status :</th>
				<td>{{ $patient->marital_status }}</td>
				<th class="text-right">E-mail :</th>
				<td>{{ $patient->email }}</td> --}}
				<th class="text-right">Name KH :</th>
				<td>{{ $patient->name_kh }}</td>
				<th class="text-right">Name EN :</th>
				<td>{{ $patient->name_en }}</td>
			</tr>
			<tr>
				<th class="text-right">Phone :</th>
				<td>{{ $patient->phone }}</td>
				<th class="text-right">Nationality :</th>
				<td>{{ $patient->nationality }}</td>
				{{-- <th class="text-right">Date of birth :</th>
				<td>{{ date('d-M-Y', strtotime($patient->date_of_birth)) }}</td> --}}
				{{-- <th class="text-right">Gender :</th>
				<td>{{ $patient->gender }}</td> --}}
			</tr>
			<tr>
				<th class="text-right">Age :</th>
				<td>{{ $patient->age }}</td>
				<th class="text-right">Education :</th>
				<td>{{ $patient->education }}</td>
				{{-- <th class="text-right">Position :</th>
				<td>{{ $patient->position }}</td> --}}
			</tr>
		</table>
	</x-card>

</x-app-layout>
