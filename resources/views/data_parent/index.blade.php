<x-app-layout>
	<x-card :foot="false"  :head="false">
		<x-form.button href="{{ route('setting.data-parent.create') }}" label="Create" icon="bx bx-plus"/>
		<br><br>
		@foreach(['blood_type' => 'Blood Type', 'nationality' => 'Nationality', 'enterprise' => 'Enterprise',
			'payment_type' => 'Payment Type', 'evalutaion_category' => 'Evalutaion Category', 'indication_disease' => 'Indication/Disease',
			'comsumption' => 'Comsumption', 'time_usage' => 'Usage', 
		] as $key => $val)
			<x-form.button href="?parent={{ $key }}" label="{{ $val }}" class="{{ $parent == $key ? 'active' : '' }}" color="{{ $parent == $key ? 'secondary' : 'primary' }}" />
		@endforeach
		<x-table class="table-hover table-bordered" id="datatables" data-table="patients">
			<x-slot name="thead">
				<tr>
					<th>No</th>
					<th>Title EN</th>
					<th>Title KH</th>
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
					<td>{{ $row->description }}</td>
					<td class="text-center">{{ $row->status }}</td>
					<td class="text-center">
						<x-form.button color="secondary" class="btn-sm" href="{{ route('setting.data-parent.edit', $row->id) }}" icon="bx bx-edit-alt" />
					</td>
				</tr>
			@endforeach
		</x-table>
	</x-card>
</x-app-layout>