<div class="table-responsive">
	<table {{ $attributes->merge(['class' => 'table']) }}>
		{!! ((isset($thead))? '<thead>'. $thead .'</thead>' : '') !!}
		<tbody>
			{!! $slot !!}
		</tbody>
		{!! ((isset($tfoot))? '<tfoot>'. $tfoot .'</tfoot>' : '') !!}
	</table>
</div>