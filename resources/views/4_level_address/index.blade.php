<x-app-layout>
	<x-card :foot="false">
		@php
			$back_addr = substr_replace($addr, '', -2);
			$code_length = $addr ? strlen($addr) : 0;
		@endphp
		<x-table class="table-hover table-bordered" id="datatables" data-table="patients">
			<x-slot name="thead">
				<tr>
					<th>No</th>
					<th>Name in Khmer :: Name ({{ $code_length == 2 ? 'District' : ($code_length == 4 ? 'Commune' : ($code_length == 6 ? 'Village' : 'Province')) }})</th>
					<th>
						{!! $code_length >=2 ? '<a href="?addr=' . $back_addr . '" class=""><i class="bx bx-undo"></i></a> -- ' : '' !!}
						{{ $code_length == 2 ? 'Commune' : ($code_length == 4 ? 'Village' : ($code_length == 6 ? '' : 'District')) }}
					</th>
				</tr>
			</x-slot>
			@foreach($address as $i => $addr)
				<tr>
					<td class="text-center">{{ ++$i }}</td>
					<td>{{ $addr['_name_kh'] }} :: {{ $addr['_name_en'] }}</td>
					<td class="text-center">
						{!! ($code_length < 6) ? '<a href="?addr=' . $addr['_code'] .'"><i class="bx bx-folder-open"></i></a>' : '--' !!}
					</td>
				</tr>
			@endforeach
		</x-table>
	</x-card>
	
	<x-modal-confirm-delete />

</x-app-layout>