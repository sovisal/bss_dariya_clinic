@props([
	'title' => 'Detail'
])
<x-modal id="detail-modal" dialogClass="modal-lg">
	<x-slot name="header">
		{{ $title }}
	</x-slot>
	<x-slot name="footer">
		<x-form.button class="btn-print" data-id="" label="Print" icon="bx bx-printer" /> 
	</x-slot>
	<table class="table-form table-header-info">
		<thead>
			<tr>
				<th colspan="4" class="text-left tw-bg-gray-100">Patient <span class="tw-pl-2 detail-status"></span></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td width="20%" class="text-right tw-bg-gray-100">Form</td>
				<td class="type"></td>
				<td width="20%" class="text-right tw-bg-gray-100">Code</td>
				<td class="code"></td>
			</tr>
			<tr>
				<td class="text-right tw-bg-gray-100">Name</td>
				<td class="name"></td>
				<td class="text-right tw-bg-gray-100">Requested date</td>
				<td class="requested_date"></td>
			</tr>
			<tr>
				<td class="text-right tw-bg-gray-100">Requested by</td>
				<td class="reqeusted_by"></td>
				<td class="text-right tw-bg-gray-100">Physician</td>
				<td class="physician"></td>
			</tr>
			<tr>
				<td class="text-right tw-bg-gray-100">Payment type</td>
				<td class="payment_type"></td>
				<td class="text-right tw-bg-gray-100">Amount</td>
				<td class="amount"></td>
			</tr>
		</tbody>
	</table>

	<table class="table-form tw-mt-3 table-detail-result">
		<thead>
			<tr>
				<th colspan="4" class="text-left tw-bg-gray-100">Result</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</x-modal>