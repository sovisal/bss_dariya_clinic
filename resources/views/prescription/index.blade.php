<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{{ route('prescription.create') }}" label="Create" icon="bx bx-plus"/>
	</x-slot>
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
					<td class="text-center">001</td>
					<td>{{ $row->patient_en }}</td>
					<td>{{ $row->doctor_en }}</td>
					<td class="text-center">{{ render_readable_date($row->requested_at) }}</td>
					<td>{{ $row->diagnosis }}</td>
					<td class="text-center">{!! render_record_status($row->status) !!}</td>
					<td class="text-center">
						<x-form.button color="info" class="btn-sm" href="{{ route('prescription.edit', $row->id) }}" icon="bx bx-printer" />
						<x-form.button color="secondary" class="btn-sm" href="{{ route('prescription.edit', $row->id) }}" icon="bx bx-edit-alt" />
						<x-form.button color="danger" class="confirmDelete btn-sm" data-id="{{ $row->id }}" icon="bx bx-trash" />
						<form class="sr-only" id="form-delete-{{ $row->id }}" action="{{ route('prescription.delete', $row->id) }}" method="POST">
							@csrf
							@method('DELETE')
							<button class="sr-only" id="btn-{{ $row->id }}">Delete</button>
						</form>
					</td>
				</tr>
			@endforeach
		</x-table>
	</x-card>
	<x-modal-confirm-delete />
</x-app-layout>