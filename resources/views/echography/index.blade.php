<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{{ route('para_clinic.echography.create') }}" label="Create" icon="bx bx-plus"/>
	</x-slot>
	<x-slot name="js">
		<script>

			function getDetail(id){
				$.ajax({
					type: "POST",
					url: "{{ route('para_clinic.echography.getDetail') }}",
					data: {
						'id': id
					},
					success: function(rs){
						if (rs.success) {
							$('#detail-modal .type').html(rs.echography.type_en);
							$('#detail-modal .code').html(rs.echography.code);
							$('#detail-modal .name').html(rs.echography.patient_en);
							$('#detail-modal .requested_date').html(moment(rs.echography.requested_date).format('DD/MM/YYYY HH:mm'));
							$('#detail-modal .reqeusted_by').html(rs.echography.reqeusted_name);
							$('#detail-modal .physician').html(rs.echography.doctor_en);
							$('#detail-modal .payment_type').html(rs.echography.payment_type);
							$('#detail-modal .amount').html(rs.echography.amount + ' USD');
							$('#detail-modal .detail-status').html(rs.status_html);
							$('#detail-modal .table-detail-result tbody').html(rs.tbody);
							$('#detail-modal').modal();
						}
					},
					error: function (rs){
						alert(rs.message);
					}
				});
			}

		</script>
	</x-slot>
	<x-card :foot="false"  :head="false">
		<x-table class="table-hover table-bordered" id="datatables" data-table="patients">
			<x-slot name="thead">
				<tr>
					<th>No</th>
					<th>Patient</th>
					<th>Physician</th>
					<th>Requested Date</th>
					<th>Price</th>
					<th>Form</th>
					<th>Status</th>
					<th>Payment</th>
					<th>Action</th>
				</tr>
			</x-slot>
			@foreach($rows as $i => $row)
				<tr>
					<td class="text-center">{{ ++$i }}</td>
					<td>{{ $row->patient_en }}</td>
					<td>{{ $row->doctor_en }}</td>
					<td class="text-center">{{ render_readable_date($row->requested_at) }}</td>
					<td class="text-right">{{ render_currency($row->amount) }}</td>
					<td>{{ $row->type_en }}</td>
					<td class="text-center">
						<span class="badge badge-{{ (($row->status=='Complete')? 'primary' : 'light') }}">{{ $row->status }}</span>
					</td>
					<td class="text-center">
						@if ($row->payment_status)
							<span class="badge badge-success">Paid</span>
						@else
							<span class="badge badge-light">Unpaid</span>
						@endif
					</td>
					<td class="text-right">
						@if ($row->status=='Progress')
							<x-form.button color="secondary" class="btn-sm" href="{{ route('para_clinic.echography.edit', $row->id) }}" icon="bx bx-edit-alt" />
							{{-- <x-form.button color="danger" class="confirmDelete btn-sm" data-id="{{ $row->id }}" icon="bx bx-trash" />
							<form class="sr-only" id="form-delete-{{ $row->id }}" action="{{ route('para_clinic.echography.delete', $row->id) }}" method="POST">
								@csrf
								@method('DELETE')
								<button class="sr-only" id="btn-{{ $row->id }}">Delete</button>
							</form> --}}
						@endif
						<x-form.button color="info" class="btn-sm" onclick="getDetail({{ $row->id }})" icon="bx bx-list-ul" />
						<x-form.button color="warning" class="btn-sm"  icon="bx bx-image" />
					</td>
				</tr>
			@endforeach
		</x-table>
	</x-card>

	<x-modal id="detail-modal" dialogClass="modal-lg">
		<x-slot name="header">
			Echography detail
		</x-slot>
		<x-slot name="footer">
			<x-form.button class="btn-print" data-id="" label="Print" icon="bx bx-printer" /> 
		</x-slot>
		<table class="table-form table-header-info">
			<thead>
				<tr>
					<th colspan="4" class="text-left tw-bg-gray-100">Patient <span class="tw-pl-2 detail-status"></span></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td width="20%" class="text-right tw-bg-gray-100">Form</td>
					<td class="type"></td>
					<td width="20%" class="text-right tw-bg-gray-100">Code</td>
					<td class="code"></td>
				</tr>
				<tr>
					<td class="text-right tw-bg-gray-100">Name</td>
					<td class="name"></td>
					<td class="text-right tw-bg-gray-100">Requested date</td>
					<td class="requested_date"></td>
				</tr>
				<tr>
					<td class="text-right tw-bg-gray-100">Requested by</td>
					<td class="reqeusted_by"></td>
					<td class="text-right tw-bg-gray-100">Physician</td>
					<td class="physician"></td>
				</tr>
				<tr>
					<td class="text-right tw-bg-gray-100">Payment type</td>
					<td class="payment_type"></td>
					<td class="text-right tw-bg-gray-100">Amount</td>
					<td class="amount"></td>
				</tr>
			</tbody>
		</table>

		<table class="table-form tw-mt-3 table-detail-result">
			<thead>
				<tr>
					<th colspan="4" class="text-left tw-bg-gray-100">Result</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</x-modal>

	<x-modal-confirm-delete />

</x-app-layout>