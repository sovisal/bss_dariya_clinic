<x-app-layout>
	<x-slot name="js">
		<script>
			localStorage.setItem("treament_plan_tab", '');
		</script>
	</x-slot>
	<x-slot name="header">
		<x-form.button href="{{ route('patient.create') }}" class="btn-sm" icon="bx bx-plus" label="Create" />
	</x-slot>
	<x-card :foot="false">
		<x-table class="table-hover table-bordered table-padding-sm" id="datatables" data-table="patients">
			<x-slot name="thead">
				<tr>
					<th>Code</th>
					<th>Name KH + Name EN</th>
					<th>Date of birth</th>
					<th>Gender</th>
					<th>Phone</th>
					<th>Nationality</th>
					<th>Registered at</th>
					<th>Status</th>
					<!-- <th>Modify at</th> -->
					<!-- <th>Modify by</th> -->
					<th width="10%">{!! __('table.action') !!}</th>
				</tr>
			</x-slot>
			@foreach ($patients as $key => $patient)
				@php 
					if ($patient->consultations() ?? false) {
						$consultant = $patient->consultations()->first();
					}
					$status = $consultant ? $consultant->status : 1;
				@endphp
				<tr>
					<td class="text-center">
						<a href="{{ route('patient.consultation.edit', $consultant) }}">
							PT-{!! str_pad($patient->id, 6, '0', STR_PAD_LEFT) !!}
						</a>
					</td>
					<td>{!! $patient->name_kh !!} :: {!! $patient->name_en !!}</td>
					<td class="text-center">{!! (($patient->date_of_birth)? date('d-M-Y', strtotime($patient->date_of_birth)) : '') !!}</td>
					<td class="text-center">{!! getParentDataByType('gender', $patient->gender) !!}</td>
					<td>{!! $patient->phone !!}</td>
					<td>{!! getParentDataByType('nationality', $patient->nationality) !!}</td>
					<td class="text-center">{!! date('d-M-Y H:i', strtotime($patient->registered_at)) !!}</td>
					<!-- <td>{!! date('d-M-Y H:i', strtotime($patient->updated_at)) !!}</td> -->
					<!-- <td>{!! $patient->updated_by_name !!}</td> -->
					<td class="text-center">{!! render_record_status($status) !!}</td>
					<td class="text-right">
						<x-form.button color="primary" class="btn-sm" href="{{ route('patient.show', $patient->id) }}" icon="bx bx-detail" />
						@if ($status == 1)
							@can('UpdatePatient')
								<x-form.button color="secondary" class="btn-sm" href="{{ route('patient.edit', $patient->id) }}" icon="bx bx-edit-alt" />
							@endcan
							@can('DeletePatient')
								<x-form.button color="danger" class="confirmDelete btn-sm" data-id="{{ $patient->id }}" icon="bx bx-trash" />
								<form class="sr-only" id="form-delete-{{ $patient->id }}" action="{{ route('patient.delete', $patient->id) }}" method="POST">
									@csrf
									@method('DELETE')
									<button class="sr-only" id="btn-{{ $patient->id }}">Delete</button>
								</form>
							@endcan
						@else
							<x-form.button color="secondary" class="btn-sm" icon="bx bx-edit-alt" disabled/>
							<x-form.button color="danger" class="btn-sm" icon="bx bx-trash" disabled/>
						@endif
					</td>
				</tr>
			@endforeach
		</x-table>
	</x-card>
	
	<x-modal-confirm-delete />

</x-app-layout>
