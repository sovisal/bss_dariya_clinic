<x-app-layout>
	<x-card :foot="false"  :head="false">
		<x-form.button href="#" class="" color="primary" label="Create" />			
		<x-table class="table-hover table-bordered" id="datatables" data-table="patients">
			<x-slot name="thead">
				<tr>
					<th>No</th>
					<th>Doctor Name</th>
					<th>Description</th>
				</tr>
			</x-slot>
			@foreach([0,1,2,3,4,5,6] as $addr)
				<tr>
					<td class="text-center">111</td>
					<td>111</td>
					<td>222</td>
				</tr>
			@endforeach
		</x-table>
	</x-card>
</x-app-layout>