<x-app-layout>
	
	<x-card :foot="false"  :head="false">
		<x-table class="table-hover table-bordered" id="datatables" data-table="patients">
			<x-slot name="thead">
				<tr>
					<th>ID</th>
					<th>Code</th>
					<th>Patient</th>
					<th>Physician</th>
					<th>Date</th>
					<th>Diagnosis</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</x-slot>
			@php
				$i = 0;
			@endphp
			@foreach($rows as $row)
				<tr>
					<td class="text-center">{{ ++$i }}</td>
					<td>{{ $row->code }}</td>
					<td>{{ $row->patient_en }}</td>
					<td>{{ $row->doctor_en }}</td>
					<td class="text-center">{{ render_readable_date($row->requested_at) }}</td>
					<td>{{ $row->diagnosis }}</td>
					<td class="text-center">{!! render_record_status($row->status) !!}</td>
					<td class="text-right">
						<x-form.button color="info" class="btn-sm" onclick="getDetail({{ $row->id }}, '{{ route('prescription.getDetail') }}')" icon="bx bx-detail" />
						<x-form.button color="dark" class="btn-sm" onclick="printPopup('{{ route('prescription.print', $row->id) }}')" icon="bx bx-printer" />
						@if ($row->status == 1)
							<x-form.button color="secondary" class="btn-sm" href="{{ route('prescription.edit', $row->id) }}" icon="bx bx-edit-alt" />
							<x-form.button color="danger" class="confirmDelete btn-sm" data-id="{{ $row->id }}" icon="bx bx-trash" />
							<form class="sr-only" id="form-delete-{{ $row->id }}" action="{{ route('prescription.delete', $row->id) }}" method="POST">
								@csrf
								@method('DELETE')
								<button class="sr-only" id="btn-{{ $row->id }}">Delete</button>
							</form>
						@else
							<x-form.button color="secondary" class="btn-sm" icon="bx bx-edit-alt" disabled/>
							<x-form.button color="danger" class="btn-sm" icon="bx bx-trash" disabled/>
						@endif
					</td>
				</tr>
			@endforeach
		</x-table>
	</x-card>

	<x-para-clinic.modal-detail title="Priscription Detail" />

	<x-modal-confirm-delete />
</x-app-layout>