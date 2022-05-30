<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{{ route('setting.medicine.create') }}" icon="bx bx-plus" label="Create" />	
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
			@foreach($medicines as $medicine)
				<tr>
					<td class="text-center">
						MD-{!! str_pad($medicine->id, 6, '0', STR_PAD_LEFT) !!}
					</td>
					<td>{{ $medicine->name }}</td>
					<td>{{ render_synonyms_name($medicine->usage_name_en, $medicine->usage_name_kh) }}</td>
					<td class="text-right"><span class="float-left">$</span> {{ number_format($medicine->price, 2) }}</td>
					<td>{!! date('d-M-Y H:i', strtotime($medicine->updated_at)) !!}</td>
					<td>{!! $medicine->updated_by_name !!}</td>
					<td class="text-center">
						@can('UpdateMedicine')
							<x-form.button color="secondary" class="btn-sm" href="{{ route('setting.medicine.edit', $medicine->id) }}" icon="bx bx-edit-alt" />
						@endcan
						@can('DeleteMedicine')
							<x-form.button color="danger" class="confirmDelete btn-sm" data-id="{{ $medicine->id }}" icon="bx bx-trash" />
							<form class="sr-only" id="form-delete-{{ $medicine->id }}" action="{{ route('setting.medicine.delete', $medicine->id) }}" method="POST">
								@csrf
								@method('DELETE')
								<button class="sr-only" id="btn-{{ $medicine->id }}">Delete</button>
							</form>
						@endcan
					</td>
				</tr>
			@endforeach
		</x-table>
	</x-card>
	<x-modal-confirm-delete />
</x-app-layout>