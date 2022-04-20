<x-app-layout>
	<x-card :foot="false"  :head="false">
		@foreach(['blood_type' => 'Blood Type', 'nationality' => 'Nationality', 'enterprise' => 'Enterprise',
			'payment_type' => 'Payment Type', 'evalutaion_category' => 'Evalutaion Category', 'indication_disease' => 'Indication/Disease',
			'comsumption' => 'Comsumption', 'time_usage' => 'Usage', 
		] as $key => $val)
			<x-form.button href="?parent={{ $key }}" label="{{ $val }}" class="{{ $parent == $key ? 'active' : '' }} btn-sm" color="{{ $parent == $key ? 'secondary' : 'primary' }}" />			
		@endforeach
		<x-table class="table-hover table-bordered" id="datatables" data-table="patients">
			<x-slot name="thead">
				<tr>
					<th>No</th>
					<th>Title</th>
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