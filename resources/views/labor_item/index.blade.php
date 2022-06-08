<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{{ route('setting.labor-item.create') }}" label="Create" icon="bx bx-plus"/>
	</x-slot>
	<x-card :foot="false"  :head="false">		
		<x-table class="table-hover table-bordered" id="datatables" data-table="patients">
			<x-slot name="thead">
				<tr>
					<th>No</th>
					<th>Name EN</th>
					<th>Name KH</th>
					<th class="text-right">Min</th>
					<th>Max</th>
					<th>Unit</th>
					<th>Category</th>
					<th>Index</th>
					<th>Status</th>
					<th>Syntax</th>
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
					<td class="text-right">{{ $row->min_range }}</td>
					<td>{{ $row->max_range }}</td>
					<td class="text-center">{!! apply_markdown_character($row->unit) !!}</td>
					<td>{{ $row->type_en }}</td>
					<td class="text-center">{{ $row->index }}</td>
					<td class="text-center">{{ $row->status }}</td>
					<td>{{ $row->other }}</td>
					<td class="text-center">
						<x-form.button color="secondary" class="btn-sm" href="{{ route('setting.labor-item.edit', $row->id) }}" icon="bx bx-edit-alt" />
						<x-form.button color="danger" class="confirmDelete btn-sm" data-id="{{ $row->id }}" icon="bx bx-trash" />
						<form class="sr-only" id="form-delete-{{ $row->id }}" action="{{ route('setting.labor-item.delete', $row->id) }}" method="POST">
							@csrf
							@method('DELETE')
							<button class="sr-only" id="btn-{{ $row->id }}">Delete</button>
						</form>
					</td>
				</tr>
			@endforeach
		</x-table>
	</x-card>
	<pre>
		Syntax : 
			OUT_RANGE_COLOR_RED : when value out of range the color will red on the print labor-test
			VALUE_POSITIVE_NEGATIVE : when input the test result value can put POSITIVE and NEGATIVE
			NEGATIVE_COLOR_RED : when value equal to NEGATIVE will display color red on print labor-test
			VALUE_160_320 : when input the test result value can put 1/160 and 1/320
	</pre>
	
	<x-modal-confirm-delete />

</x-app-layout>