@props([
	'title' => 'Detail',
	'foot' => true,
])
<x-modal id="detail-modal" dialogClass="modal-xl" :foot="$foot">
	<x-slot name="header">
		{{ $title }}
	</x-slot>
	<x-slot name="footer">
		<x-form.button class="btn-print" data-id="" label="Print" icon="bx bx-printer" /> 
	</x-slot>
	
	<div class="header-info">
		
	</div>
	<div class="body">

	</div>
</x-modal>