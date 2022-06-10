<x-app-layout>
	<x-slot name="js">
		<script>
			$(document).ready(function () {
				$('[name="type"]').change(function () {
					$_this = $(this);
					$_option_selected = $(this).find('option:selected');
					$_amount = $_option_selected.data('price');
					
					$('#amount_label').html($_amount);
					$('[name="amount"]').val($_amount);
				});
			});
		</script>
	</x-slot>
	<x-slot name="header">
		<x-form.button href="{{ route('para_clinic.xray.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
	</x-slot>
	<form action="{{ route('para_clinic.xray.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
		@method('PUT')
		@csrf
		<input type="hidden" name="status" value="1" />
		<x-card bodyClass="pb-0" :actionShow="false">
			<x-slot name="action">
				<div>
					<x-form.button type="submit" class="btn-submit" value="1" icon="bx bx-save" label="Save" />
				</div>
			</x-slot>
			<x-slot name="footer">
				<div>
					<x-form.button type="submit" class="btn-submit" value="1" icon="bx bx-save" label="Save" />
				</div>
			</x-slot>				
			<table class="table-form striped">
				<tr>
					<th colspan="4" class="text-left tw-bg-gray-100">X-Ray</th>
				</tr>
				<x-para-clinic.form-header :type="$type" :patient="$patient" :doctor="$doctor" :paymentType="$payment_type" />
			</table>
		</x-card>
	</form>

</x-app-layout>
