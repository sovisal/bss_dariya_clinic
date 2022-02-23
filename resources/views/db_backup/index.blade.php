<x-app-layout>
	<x-slot name="header">
		<x-form.button
			href="{{ route('db_backup.backup') }}"
			icon="bx bxs-download"
			label="{{ __('button.backup') }}"
		/>
	</x-slot>

	<x-slot name="js">
		<script>
			
		</script>
	</x-slot>

	<x-card :foot="false">
		<x-table id="datatables" class="table-border table-striped table-hover">
			<x-slot name="thead">
				<tr>
					<th width="10%">{!! __('table.no') !!}</th>
					<th width="15%">{!! __('table.date') !!}</th>
					<th>{{ __('table.name') }}</th>
					<th width="15%">{!! __('table.db_backup.file_type') !!}</th>
					<th width="15%">{!! __('table.action') !!}</th>
				</tr>
			</x-slot>
			@foreach ($databases as $key => $db)
				@php
					$str = substr($db, strpos($db, "_") + 1);
					$str = substr($str, strpos($str, "_") + 1);
					$date = strtok($str, '.');
					$name = strtok($db, '.');
					$file_type = substr($str, strpos($str, ".") + 1);
				@endphp
				<tr>
					<td class="text-center">
						{{ $key+1 }}
					</td>
					<td class="text-center">
						{{ date('d/M/Y', strtotime($date)) }}
					</td>
					<td>
						{{ $name }}
					</td>
					<td class="text-center">
						{{ $file_type }}
					</td>
					<td class="text-center">
						<x-table-action>
							<a href="{{ route('db_backup.download', $db) }}"" class="dropdown-item"><i class="bx bx-download mr-1"></i> {{ __('button.download') }}</a>
							<a href="javascript:void(0);" class="dropdown-item confirmDelete" data-id="{{ $db }}"><i class="bx bx-trash mr-1"></i> {{ __('button.crud.delete') }}</a>
							<form class="sr-only" id="form-delete-{{ $db }}" action="{{ route('db_backup.delete', $db) }}" method="post">
								@csrf
								@method('delete')
							</form>
						</x-table-action>
					</td>
				</tr>
			@endforeach
		</x-table>
	</x-card>

	<x-modal-confirm-delete />
</x-app-layout>