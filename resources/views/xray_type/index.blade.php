<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{{ route('setting.xray-type.create') }}" label="Create" icon="bx bx-plus"/>
	</x-slot>
	<x-card :foot="false"  :head="false">
		<x-table class="table-hover table-bordered" id="datatables" data-table="patients">
			<x-slot name="thead">
				<tr>
					<th>No</th>
					<th>Name EN</th>
					<th>Name KH</th>
					<th>Price</th>
					<th>Index</th>
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
					<td>{{ $row->name_en }}</td>
					<td>{{ $row->name_kh }}</td>
					<td class="text-right">{{ render_currency($row->price) }}</td>
					<td class="text-center">{{ $row->index }}</td>
					<td class="text-center">{{ $row->status }}</td>
					<td class="text-center">
						<x-form.button color="secondary" class="btn-sm" href="{{ route('setting.xray-type.edit', $row->id) }}" icon="bx bx-edit-alt" />
						<x-form.button color="danger" class="confirmDelete btn-sm" data-id="{{ $row->id }}" icon="bx bx-trash" />
						<form class="sr-only" id="form-delete-{{ $row->id }}" action="{{ route('setting.xray-type.delete', $row->id) }}" method="POST">
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