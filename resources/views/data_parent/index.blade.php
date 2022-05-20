<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{{ route('setting.data-parent.create') }}" label="Create" icon="bx bx-plus"/>
	</x-slot>
	<x-card :foot="false"  :head="false">
		@foreach(data_parent_selection_conf() as $key => $val)
			@if (empty($val['is_invisible']) || $val['is_invisible'] == false) 
				<x-form.button href="?parent={{ $key }}" label="{{ $val['label'] }}" class="{{ $type == $key ? 'active' : '' }}" color="{{ $type == $key ? 'secondary' : 'primary' }}" />
			@endif
		@endforeach
		<hr>
		<x-table class="table-hover table-bordered" id="datatables" data-table="patients">
			<x-slot name="thead">
				<tr>
					<th>No</th>
					<th>Title EN</th>
					<th>Title KH</th>
					@if ($module_conf['is_child'] ?? false)
						<th>{{ $parent_module_conf['label'] }}</th>
					@endif
					<th>Description</th>
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
					<td>{{ $row->title_en }}</td>
					<td>{{ $row->title_kh }}</td>
					@if ($module_conf['is_child'] ?? false)
						<td>{{ $row->parent_id == 0 ? 'N/A' : $parent_list[$row->parent_id] }}</td>
					@endif
					<td>{{ $row->description }}</td>
					<td class="text-center">{{ $row->status }}</td>
					<td class="text-center">
						<x-form.button color="secondary" class="btn-sm" href="{{ route('setting.data-parent.edit', $row->id) }}" icon="bx bx-edit-alt" />
						<x-form.button color="danger" class="confirmDelete btn-sm" data-id="{{ $row->id }}" icon="bx bx-trash" />
						<form class="sr-only" id="form-delete-{{ $row->id }}" action="{{ route('setting.data-parent.delete', $row->id) }}" method="POST">
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