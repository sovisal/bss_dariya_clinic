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
			const swalWithBootstrapBtns = Swal.mixin({
				customClass: {
					confirmButton: "btn btn-danger tw-ml-1",
					cancelButton: "btn btn-light tw-mr-1",
				},
				buttonsStyling: false,
			});
			
		</script>
	</x-slot>
	<x-slot name="header">
		<x-form.button href="{{ route('para_clinic.echography.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
	</x-slot>
	<form action="{{ route('para_clinic.echography.store') }}" method="POST" id="echography-form" autocomplete="off" enctype="multipart/form-data">
		@csrf
		@method('PUT')
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
					<th colspan="4" class="text-left tw-bg-gray-100">Echo</th>
				</tr>
				<x-para-clinic.form-header :type="$type" :patient="$patient" :doctor="$doctor" :paymentType="$payment_type">
					<tr valign="top">
						<td class="text-right">Image(First)</td>
						<td width="30%">
							<x-bss-form.input name="img_1" :value="old('img_1')" type="file" class="img_upload_preview" data-output="img_result_1"/>
							<img src="#" alt="" id="img_result_1">
						</td>
						<td class="text-right">Image (Second)</td>
						<td width="30%">
							<x-bss-form.input name="img_2" :value="old('img_2')" type="file" class="img_upload_preview" data-output="img_result_2"/>
							<img src="#" alt="" id="img_result_2">
						</td>
					</tr>
				</x-para-clinic.form-header>
			</table>
		</x-card>
	</form>

</x-app-layout>
