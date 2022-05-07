<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{{ route('setting.doctor.create') }}" icon="bx bx-plus" label="Create" />	
	</x-slot>
	<x-card :foot="false"  :head="false">		
		<x-table class="table-hover table-bordered" id="datatables">
			<x-slot name="thead">
				<tr>
					<th>Code</th>
					<th>Name Kh</th>
					<th>Name En</th>
					<th>Gender</th>
					<th>Phone</th>
					<th>Modify at</th>
					<th>Modify by</th>
					<th>Action</th>
				</tr>
			</x-slot>
			@foreach($doctors as $doctor)
				<tr>
					<td class="text-center">
						DT-{!! str_pad($doctor->id, 6, '0', STR_PAD_LEFT) !!}
					</td>
					<td>{{ $doctor->name_kh }}</td>
					<td>{{ $doctor->name_en }}</td>
					<td>{!! getParentDataByType('gender', $doctor->gender) !!}</td>
					<td>{{ $doctor->phone }}</td>
					<td>{!! date('d-M-Y H:i', strtotime($doctor->updated_at)) !!}</td>
					<td>{!! $doctor->updated_by_name !!}</td>
					<td class="text-center">
						@can('UpdateDoctor')
							<x-form.button color="secondary" class="btn-sm" href="{{ route('setting.doctor.edit', $doctor->id) }}" icon="bx bx-edit-alt" />
						@endcan
						@can('DeleteDoctor')
							<x-form.button color="danger" class="confirmDelete btn-sm" data-id="{{ $doctor->id }}" icon="bx bx-trash" />
							<form class="sr-only" id="form-delete-{{ $doctor->id }}" action="{{ route('setting.doctor.delete', $doctor->id) }}" method="POST">
								@csrf
								@method('DELETE')
								<button class="sr-only" id="btn-{{ $doctor->id }}">Delete</button>
							</form>
						@endcan
					</td>
				</tr>
			@endforeach
		</x-table>
	</x-card>
	<x-modal-confirm-delete />
</x-app-layout>