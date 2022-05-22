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
				var value = $(this).val();
				$('[name="status"]').val(value);
				if (value=="Cancel"){
					swalWithBootstrapBtns.fire({
						title: "Your data is not saved yet!",
						text: "Are you sure you want to leave this page?",
						icon: 'question',
						showCancelButton: true,
						confirmButtonText: "Leave",
						cancelButtonText: "Stay",
						reverseButtons: true
					}).then((result) => {
						if (result.isConfirmed) {
							window.location.replace("{{ route('para_clinic.echography.index') }}");
						}
					})
				}else{
					if (formValidate('#echography-form')) {
						$('#echography-form').submit();
					}
				}
			});
		</script>
	</x-slot>
	<form action="{{ route('para_clinic.echography.update', $row) }}" id="echography-form" method="POST" autocomplete="off" enctype="multipart/form-data">
		@csrf
		@method('PUT')
		<input type="hidden" name="status" value="Cancel" />
		<x-card bodyClass="pb-0" :actionShow="false">
			<x-slot name="action">
				<div>
					<x-form.button class="btn-submit" value="2" color="success" icon="bx bx-check" label="Complete" />
					<x-form.button class="btn-submit" value="1" icon="bx bx-save" label="Save" />
					<!-- <x-form.button class="btn-submit" value="Cancel" color="danger" icon="bx bx-x" label="Cancel" /> -->
				</div>
			</x-slot>
			<x-slot name="footer">
				<div>
					<x-form.button class="btn-submit" value="2" color="success" icon="bx bx-check" label="Complete" />
					<x-form.button class="btn-submit" value="1" icon="bx bx-save" label="Save" />
					<!-- <x-form.button class="btn-submit" value="Cancel" color="danger" icon="bx bx-x" label="Cancel" /> -->
				</div>
			</x-slot>

			<table class="table-form striped">
				<tr>
					<th colspan="4" class="text-left tw-bg-gray-100">Echo Code #dasd123</th>
				</tr>
				@include('echography.form_input')
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
