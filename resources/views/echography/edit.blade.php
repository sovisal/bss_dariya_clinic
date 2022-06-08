<x-app-layout>
	<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
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

			function formValidate(target = 'form') {
				var rs = true;
				$(target +" input,"+ target +" textarea,"+ target +" checkbox,"+ target +" radio,"+ target +" select").each(function () {
					var attr = $(this).attr('required');
					if ((typeof attr !== 'undefined' && attr !== false) && $(this).val() == '') {
						swalWithBootstrapBtns.fire({
							title: "Invalid input!",
							text: "Input all required fields.",
							icon: 'warning',
							confirmButtonText: "Okay",
						}).then((result) => {
							if (result.isConfirmed) {
								
							}
						})
						rs = false;
					}
				});
				return rs;
			}
			
			$('.btn-submit').click(function (){
				$('[name="status"]').val($(this).val());
			});
		</script>
	</x-slot>
	<x-slot name="header">
		<x-form.button href="{{ route('para_clinic.echography.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
	</x-slot>
	<form action="{{ route('para_clinic.echography.update', $row) }}" id="echography-form" method="POST" autocomplete="off" enctype="multipart/form-data">
		@csrf
		@method('PUT')
		<input type="hidden" name="status" value="{{ $row->status ?: 1 }}" />
		<x-card bodyClass="pb-0" :actionShow="false">
			<x-slot name="action">
				<div>
					<x-form.button type="submit" class="btn-submit" value="2" color="success" icon="bx bx-check" label="Complete" />
					<x-form.button type="submit" class="btn-submit" value="1" icon="bx bx-save" label="Save" />
				</div>
			</x-slot>
			<x-slot name="footer">
				<div>
					<x-form.button type="submit" class="btn-submit" value="2" color="success" icon="bx bx-check" label="Complete" />
					<x-form.button type="submit" class="btn-submit" value="1" icon="bx bx-save" label="Save" />
				</div>
			</x-slot>

			<table class="table-form striped">
				<tr>
					<th colspan="4" class="text-left tw-bg-gray-100">Echo Code #{{ $row->code }}</th>
				</tr>
				<x-para-clinic.form-header :row="$row" :type="$type" :patient="$patient" :doctor="$doctor" :paymentType="$payment_type" :isEdit="$is_edit" >
					<tr valign="top">
						<td class="text-right">Image(First)</td>
						<td width="30%">
							<x-bss-form.input name="img_1" :value="old('img_1')" type="file" class="img_upload_preview" data-output="img_result_1"/>
							<img src="/images/echographies/{{ $row->image_1 }}" alt="" id="img_result_1">
						</td>
						<td class="text-right">Image (Second)</td>
						<td width="30%">
							<x-bss-form.input name="img_2" :value="old('img_2')" type="file" class="img_upload_preview" data-output="img_result_2"/>
							<img src="/images/echographies/{{ $row->image_2 }}" alt="" id="img_result_2">
						</td>
					</tr>
				</x-para-clinic.form-header>
			</table>
			<br>
			<table class="table-form striped">
				<tr>
					<th colspan="4" class="text-left tw-bg-gray-100">Result</th>
				</tr>
				@if (view()->exists('echo_type.extra_form.' . $row->type))
					@include('echo_type.extra_form.' . $row->type)
				@else	
					@include('echo_type.extra_form.0')
				@endif
			</table>
		</x-card>
	</form>

</x-app-layout>
