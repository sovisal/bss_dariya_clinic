<x-app-layout>
	{{-- <x-slot name="header">
		<x-form.button href="{{ route('para_clinic.echography.create') }}" label="Create" icon="bx bx-plus"/>
	</x-slot> --}}
	<x-slot name="css">
		<style>
			#image-slider{
				width: 600px;
				margin: 10px auto;
				overflow: hidden;
			}
			#image-slider .carousel-inner{
				border-radius: 0;
			}
		</style>
	</x-slot>
	<x-slot name="js">
		<script>

			// function getDetail(id){
			// 	$.ajax({
			// 		type: "POST",
			// 		url: "{{ route('para_clinic.echography.getDetail') }}",
			// 		data: {
			// 			'id': id
			// 		},
			// 		success: function(rs){
			// 			if (rs.success) {
			// 				$('#detail-modal .type').html(rs.echography.type_en);
			// 				$('#detail-modal .code').html(rs.echography.code);
			// 				$('#detail-modal .name').html(rs.echography.patient_en);
			// 				$('#detail-modal .requested_date').html(moment(rs.echography.requested_date).format('DD/MM/YYYY HH:mm'));
			// 				$('#detail-modal .reqeusted_by').html(rs.echography.reqeusted_name);
			// 				$('#detail-modal .physician').html(rs.echography.doctor_en);
			// 				$('#detail-modal .payment_type').html(rs.echography.payment_type);
			// 				$('#detail-modal .amount').html(rs.echography.amount + ' USD');
			// 				$('#detail-modal .detail-status').html(rs.status_html);
			// 				$('#detail-modal .table-detail-result tbody').html(rs.tbody);
			// 				$('#detail-modal .btn-print').attr('onclick', `printPopup('${rs.print_url}')`);
			// 				$('#detail-modal').modal();
			// 			}
			// 		},
			// 		error: function (rs){
			// 			alert(rs.message);
			// 		}
			// 	});
			// }

			function getImage(img_1, img_2){
				var inner_slider;
				$('#image-modal .modal-body .no-photo').remove();
				if (img_1 != '' || img_2 != '') {
					$('#image-modal #image-slider').removeClass('sr-only');
					if (img_1 != '') {
						inner_slider = `<div class="carousel-item active">
											<img src="/images/echographies/${ img_1 }" class="d-block w-100" alt="...">
										</div>`;
					}
					if (img_2 != '') {
						inner_slider += `<div class="carousel-item ${ ((img_1 == '')? 'active' : '') }">
											<img src="/images/echographies/${ img_2 }" class="d-block w-100" alt="...">
										</div>`;
					}
					$('#image-modal #image-slider .carousel-inner').html(inner_slider);
				}else{
					$('#image-modal #image-slider').addClass('sr-only');
					$('#image-modal .modal-body').append('<div class="no-photo text-center py-1">No photo</div>');
				}
				$('#image-modal').modal();
			}

		</script>
	</x-slot>
	<x-card :foot="false"  :head="false">
		<x-table class="table-hover table-bordered" id="datatables" data-table="patients">
			<x-slot name="thead">
				<tr>
					<th>No</th>
					<th>Code</th>
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
					<td>{{ $row->code }}</td>
					<td>{{ render_synonyms_name($row->patient_en, $row->patient_kh) }}</td>
					<td>{{ render_synonyms_name($row->doctor_en, $row->doctor_kh) }}</td>
					<td class="text-center">{{ render_readable_date($row->requested_at) }}</td>
					<td class="text-right">{{ render_currency($row->amount) }}</td>
					<td>{{ render_synonyms_name($row->type_en, $row->type_kh) }}</td>
					<td class="text-center">{!! render_record_status($row->status) !!}</td>
					<td class="text-center">{!! render_payment_status($row->payment_status) !!}</td>
					<td class="text-right">
						<x-form.button color="info" class="btn-sm" onclick="getDetail({{ $row->id }}, '{{ route('para_clinic.echography.getDetail') }}')" icon="bx bx-detail" />
						<x-form.button color="warning" class="btn-sm" onclick="getImage('{{ $row->image_1 }}', '{{ $row->image_2 }}')" icon="bx bx-image" />
						<x-form.button color="dark" class="btn-sm" onclick="printPopup('{{ route('para_clinic.echography.print', $row->id) }}')" icon="bx bx-printer" />
						@if ($row->status=='1')
							<x-form.button color="secondary" class="btn-sm" href="{{ route('para_clinic.echography.edit', $row->id) }}" icon="bx bx-edit-alt" />
							<x-form.button color="danger" class="confirmDelete btn-sm" data-id="{{ $row->id }}" icon="bx bx-trash" />
							<form class="sr-only" id="form-delete-{{ $row->id }}" action="{{ route('para_clinic.echography.delete', $row->id) }}" method="POST">
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

	<x-para-clinic.modal-detail title="Echography Detail" />

	<x-modal :foot="false" id="image-modal" dialogClass="modal-lg">
		<x-slot name="header">
			View Echography Photo
		</x-slot>
		<x-slider id="image-slider" :autoplay="false" />
	</x-modal>

	<x-modal-confirm-delete />

</x-app-layout>