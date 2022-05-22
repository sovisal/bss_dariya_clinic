<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{{ route('para_clinic.labor.create') }}" label="Create" icon="bx bx-plus"/>
	</x-slot>
	<x-card :foot="false"  :head="false">
		<x-table class="table-hover table-bordered" id="datatables" data-table="patients">
			<x-slot name="thead">
				<tr>
					<th>No</th>
					<th>Code</th>
					<th>Patient</th>
					<th>Requested By</th>
					<th>Requested Date</th>
					<th>Analysis Date</th>
					<th>Price</th>
					<th>Status</th>
					<th>Payment</th>
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
					<td>{{ $row->requester_en }}</td>
					<td class="text-center">{{ render_readable_date($row->requested_at) }}</td>
					<td class="text-center">{{ render_readable_date($row->analysis_at) }}</td>
					<td class="text-right">{{ render_currency($row->amount) }}</td>
					<td class="text-center">{!! render_record_status($row->status) !!}</td>
					<td class="text-center">{!! render_payment_status($row->payment_status) !!}</td>
					<td class="text-center">
						<x-form.button color="info" class="btn-sm" href="{{ route('para_clinic.labor.edit', $row->id) }}" icon="bx bx-printer" />
						@if ($row->status == 1)
							<x-form.button color="secondary" class="btn-sm" href="{{ route('para_clinic.labor.edit', $row->id) }}" icon="bx bx-edit-alt" />
							<x-form.button color="danger" class="confirmDelete btn-sm" data-id="{{ $row->id }}" icon="bx bx-trash" />
							<form class="sr-only" id="form-delete-{{ $row->id }}" action="{{ route('para_clinic.labor.delete', $row->id) }}" method="POST">
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

	<x-modal-confirm-delete />

</x-app-layout>