<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{{ route('prescription.create') }}" icon="bx bx-plus" label="Create" />	
	</x-slot>
	<x-card :foot="false"  :head="false">		
		<x-table class="table-hover table-bordered" id="datatables">
			<x-slot name="thead">
				<tr>
					<th>Code</th>
					<th>Name</th>
					<th>Usage</th>
					<th>Price</th>
					<th>Modify at</th>
					<th>Modify by</th>
					<th>Action</th>
				</tr>
			</x-slot>
			@foreach($prescriptions as $prescription)
				<tr>
					<td class="text-center">
						MD-{!! str_pad($prescription->id, 6, '0', STR_PAD_LEFT) !!}
					</td>
					<td>{{ $prescription->name }}</td>
					<td>{{ $prescription->usage_name_kh }} :: {{ $prescription->usage_name_en }}</td>
					<td class="text-right"><span class="float-left">$</span> {{ number_format($prescription->price, 2) }}</td>
					<td>{!! date('d-M-Y H:i', strtotime($prescription->updated_at)) !!}</td>
					<td>{!! $prescription->updated_by_name !!}</td>
					<td class="text-center">
						@can('UpdatePrescription')
							<x-form.button color="secondary" class="btn-sm" href="{{ route('prescription.edit', $prescription->id) }}" icon="bx bx-edit-alt" />
						@endcan
						@can('DeletePrescription')
							<x-form.button color="danger" class="confirmDelete btn-sm" data-id="{{ $prescription->id }}" icon="bx bx-trash" />
							<form class="sr-only" id="form-delete-{{ $prescription->id }}" action="{{ route('prescription.delete', $prescription->id) }}" method="POST">
								@csrf
								@method('DELETE')
								<button class="sr-only" id="btn-{{ $prescription->id }}">Delete</button>
							</form>
						@endcan
					</td>
				</tr>
			@endforeach
		</x-table>
	</x-card>
	<x-modal-confirm-delete />
</x-app-layout>