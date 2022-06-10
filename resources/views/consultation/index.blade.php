<x-app-layout>
	<x-card :foot="false" :head="false">
		<x-table class="table-hover table-bordered table-padding-sm" id="datatables" data-table="consultations">
			<x-slot name="thead">
				<tr>
					<th>Code</th>
					<th>Physician</th>
					<th>Patient</th>
					<th>Date Evaluation</th>
					<th>By</th>
					<th>Modify by</th>
					<th>Modify at</th>
					<th width="10%">{!! __('table.action') !!}</th>
				</tr>
			</x-slot>
			@foreach ($consultations as $key => $consultation)
				<tr>
					<td class="text-center">MED-{{ str_pad(($key+1), 6, '0', STR_PAD_LEFT) }}</td>
					<td>Physician Name</td>
					<td>Patient Name</td>
					<td>Date</td>
					<td>By</td>
					<td>Modify by</td>
					<td>Modify at</td>
					<td class="text-center">
						@can('UpdatePatient')
							<x-form.button color="secondary" class="btn-sm" href="#" icon="bx bx-edit-alt" />
						@endcan
						@can('DeletePatient')
							<x-form.button color="danger" class="confirmDelete btn-sm" data-id="{{ $key }}" icon="bx bx-trash" />
							<form class="sr-only" id="form-delete-{{ $key }}" action="#" method="POST">
								@csrf
								@method('DELETE')
								<button class="sr-only" id="btn-{{ $key }}">Delete</button>
							</form>
						@endcan
					</td>
				</tr>
			@endforeach
		</x-table>
	</x-card>
	
	<x-modal-confirm-delete />

</x-app-layout>
