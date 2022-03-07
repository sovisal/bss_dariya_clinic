<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{{ route('patient.create') }}" icon="bx bx-plus" label="Create" />
	</x-slot>
	<x-card :foot="false">
		<x-table class="table-hover table-bordered" id="datatables" data-table="patients">
			<x-slot name="thead">
				<tr>
					<th>Code</th>
					<th>Name Kh</th>
					<th>Name En</th>
					<th>Date of birth</th>
					<th>Gender</th>
					<th>Phone</th>
					<th>Registered at</th>
					<th>Modify at</th>
					<th>Modify by</th>
					<th width="10%">{!! __('table.action') !!}</th>
				</tr>
			</x-slot>
			@foreach ($patients as $key => $patient)
				<tr>
					<td class="text-center">PT-{!! str_pad($patient->id, 6, '0', STR_PAD_LEFT) !!}</td>
					<td>{!! $patient->name_kh !!}</td>
					<td>{!! $patient->name_en !!}</td>
					<td>{!! date('d/M/Y', strtotime($patient->date_of_birth)) !!}</td>
					<td>{!! $patient->gender !!}</td>
					<td>{!! $patient->phone !!}</td>
					<td>{!! date('d/M/Y H:i:s', strtotime($patient->registered_at)) !!}</td>
					<td>{!! date('d/M/Y H:i:s', strtotime($patient->updated_at)) !!}</td>
					<td>{!! $patient->updated_by_name !!}</td>
					<td class="text-center">
						@can('UpdatePatient')
							<x-form.button color="secondary" href="{{ route('patient.edit', $patient->id) }}" icon="bx bx-edit-alt" />
						@endcan
						@can('DeletePatient')
							<x-form.button color="danger" class="confirmDelete" data-id="{{ $patient->id }}" icon="bx bx-trash" />
							<form class="sr-only" id="form-delete-{{ $patient->id }}" action="{{ route('patient.delete', $patient->id) }}" method="POST">
								@csrf
								@method('DELETE')
								<button class="sr-only" id="btn-{{ $patient->id }}">Delete</button>
							</form>
						@endcan
					</td>
				</tr>
			@endforeach
		</x-table>
	</x-card>
	
	<x-modal-confirm-delete />

</x-app-layout>
