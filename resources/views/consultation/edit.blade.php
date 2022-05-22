<x-app-layout>
	<x-slot name="css">
		<style>
		</style>
	</x-slot>
	<x-slot name="js">
		<script>
			$('.btn-treatment-toggle').click(function(){
				var body = `<table class="table-form table-padding-sm striped">
								<tr>
									<td width="20%" class="text-right">Requested Date</td>
									<td>
										<x-bss-form.input
											name="date"
											hasIcon="right"
											icon="bx bx-calendar"
											placeholder="Date"
										/>
									</td>
									<td width="20%" class="text-right"><small class="required">*</small> Choose Type</td>
									<td>
										<div class="d-flex">
											<x-bss-form.select name="template" />
											<x-form.button color="light" class="btn-add-new-template tw-ml-2" icon="bx bx-plus" label="" />
										</div>
									</td>
								</tr>
								<tr>
									<td class="text-right">Analysed by</td>
									<td>
										<x-bss-form.select name="analysed_by" />
									</td>
									<td class="text-right">Selected Type</td>
									<td>
										<i class="cursor-pointer">No imagery type selected!</i>
									</td>
								</tr>
							</table>`,
				type = $(this).data('type'),
				title = 'Create new '+ type.toUpperCase();
				if (type=='prescription') {
					title = 'Create new Prescription';
					body = `<table class="table-form table-padding-sm table-striped table-medicine">
								<thead>
									<tr>
										<th colspan="10" class="tw-bg-gray-100">
											<div class="d-flex justify-content-between align-items-center">
												<x-bss-form.input
													name="date"
													hasIcon="right"
													icon="bx bx-calendar"
													placeholder="Date"
												/>
												<div>
													<x-form.button class="btn-add-medicine" icon="bx bx-plus" label="Add Medicine" />
												</div>
											</div>
										</th>
									</tr>
									<tr>
										<th width="15%">Medicine <small class="required">*</small></th>
										<th width="9%">Qty <small class="required">*</small></th>
										<th width="9%">U/D <small class="required">*</small></th>
										<th width="9%">NoD <small class="required">*</small></th>
										<th width="5%">Total</th>
										<th width="5%">Unit</th>
										<th width="15%">Usage</th>
										<th width="12%">Usage Time</th>
										<th>Note</th>
										<th width="8%">Action</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<x-bss-form.select2
												name="medicine"
												data-url="#"
												data-placeholder="Select medicine"
											/>
										</td>
										<td>
											<x-bss-form.input name="qty" class="is_number"/>
										</td>
										<td>
											<x-bss-form.input name="ud" class="is_number"/>
										</td>
										<td>
											<x-bss-form.input name="nod" class="is_number"/>
										</td>
										<td></td>
										<td></td>
										<td>
											<x-bss-form.select2
												name="usage"
												data-url="#"
												data-placeholder="Select medicine"
											/>
										</td>
										<td>
											<div class="d-flex justify-content-between">
												<x-form.checkbox name='morning' label="Morning" />
												<x-form.checkbox name='noon' label="Noon" />
											</div>
											<div class="d-flex justify-content-between tw-mt-2">
												<x-form.checkbox name='evening' label="Evening" />
												<x-form.checkbox name='night' label="Night" />
											</div>
										</td>
										<td>
											<x-bss-form.textarea name="note" />
										</td>
										<td class="text-center"></td>
									</tr>
								</tbody>
							</table>`;
				}else if (type=='labor-test'){
					body = `<div class="row align-items-center mb-1">
								<div class="col-sm-3">
									<x-bss-form.input
										name="date"
										hasIcon="right"
										icon="bx bx-calendar"
										placeholder="Date"
									/>
								</div>
								<div class="col-sm-3">
									<x-bss-form.select name="labor_service_category" class="labor-service-category">
										<option value="">Select Category</option>
										<option value="biochimie">BIOCHIMIE</option>
										<option value="helmatologie">HELMATOLOGIE</option>
									</x-bss-form.select>
								</div>
								<div class="col-sm-3">
									<x-form.checkbox name="sample_provided" label="Sample Provided" />
								</div>
							</div>
							<div class="labor-service-container mt-1"></div>`;
				}
				$('#treatment-model .modal-title').html(title);
				$('#treatment-model .modal-body').html(body);
				if (type=='labor-test') {
					$('.labor-service-category').select2({
						dropdownAutoWidth: !0,
						width: "100%",
						dropdownParent: $('.labor-service-category').parent()
					});
				}else{
					$.ajax({
						type: "post",
						url: "{{ route('patient.consultation.getTemplate') }}",
						data: { 'type': type },
						success: function (rs) {
							$('#analysed_by').html(rs.analysed_by);
							$('#template').html(rs.template);
							$('#analysed_by').select2({
								dropdownAutoWidth: !0,
								width: "100%",
								dropdownParent: $('#analysed_by').parent()
							});
							$('#template').select2({
								dropdownAutoWidth: !0,
								width: "100%",
								dropdownParent: $('#template').parent()
							});
						}
					});
				}
				
				$('#date').datetimepicker({
					icons: {
							time: "bx bx-time",
							date: "bx bx-calendar",
							up: 'bx bx-chevron-up',
							down: 'bx bx-chevron-down',
							previous: 'bx bx-chevron-left',
							next: 'bx bx-chevron-right',
							today: 'bx bx-screenshot',
							clear: 'bx bx-trash',
							close: 'bx bx-x'
						},
					format: "YYYY-MM-DD HH:mm:ss",
					showTodayButton: true,
				});
				$('#treatment-model').modal();
			});

			// Prescription Request
			$(document).on('click', '.btn-add-medicine', function () {
				$('.table-medicine tbody').append(`
													<tr>
														<td>
															<x-bss-form.select2
																name="medicine"
																data-url="#"
																data-placeholder="Select medicine"
															/>
														</td>
														<td>
															<x-bss-form.input name="qty" class="is_number"/>
														</td>
														<td>
															<x-bss-form.input name="ud" class="is_number"/>
														</td>
														<td>
															<x-bss-form.input name="nod" class="is_number"/>
														</td>
														<td></td>
														<td></td>
														<td>
															<x-bss-form.select2
																name="usage"
																data-url="#"
																data-placeholder="Select medicine"
															/>
														</td>
														<td>
															<div class="d-flex justify-content-between">
																<x-form.checkbox name='morning' label="Morning" />
																<x-form.checkbox name='noon' label="Noon" />
															</div>
															<div class="d-flex justify-content-between tw-mt-2">
																<x-form.checkbox name='evening' label="Evening" />
																<x-form.checkbox name='night' label="Night" />
															</div>
														</td>
														<td>
															<x-bss-form.textarea name="note" />
														</td>
														<td class="text-center">
															<span class="cursor-pointer text-danger hover:tw-text-red-600 btn-remove-medicine"><i class="bx bx-x"></i></span>
														</td>
													</tr>
												`);
			});
			$(document).on('click', '.btn-remove-medicine', function () {
				$(this).closest('tr').remove();
			});

			// Labor Service Category Selected
			$(document).on('change', '.labor-service-category', function () {
				var service_categories = '',
					value = $(this).val();
				if (value=='biochimie') {
					service_categories = `<div class="row mt-1 service-category">
											<div class="col-sm-6">
												<b class="text-uppercase tw-underline">
													Bacteriologie
												</b>
											</div>
											<div class="col-sm-6 text-right">
												<div class="d-flex justify-content-end align-items-center">
													<x-form.checkbox name="all_category_1" class="chb_all" label="All" />
													<span class="tw-ml-1 tw-underline btn-remove-service-category cursor-pointer text-danger hover:tw-text-red-600"><i class="bx bx-x"></i>Remove</span>
												</div>
											</div>
											<div class="col-sm-12 tw-mt-2">
												<div class="row">
													<div class="col-sm-4 tw-mt-1">
														<x-form.checkbox name="item_1" class="chb_child" label="Item 1" />
													</div>
													<div class="col-sm-4 tw-mt-1">
														<x-form.checkbox name="item_2" class="chb_child" label="Item 2" />
													</div>
													<div class="col-sm-4 tw-mt-1">
														<x-form.checkbox name="item_3" class="chb_child" label="Item 3" />
													</div>
													<div class="col-sm-4 tw-mt-1">
														<x-form.checkbox name="item_4" class="chb_child" label="Item 4" />
													</div>
													<div class="col-sm-4 tw-mt-1">
														<x-form.checkbox name="item_5" class="chb_child" label="Item 5" />
													</div>
												</div>
											</div>
										</div>`;
				
				}else if (value=='helmatologie') {
					service_categories = `<div class="row mt-1 service-category">
											<div class="col-sm-6">
												<b class="text-uppercase tw-underline">
													HEMATOLOGIE
												</b>
											</div>
											<div class="col-sm-6 text-right">
												<div class="d-flex justify-content-end align-items-center">
													<x-form.checkbox name="all_category_1" class="chb_all" label="All" />
													<span class="tw-ml-1 tw-underline btn-remove-service-category cursor-pointer text-danger hover:tw-text-red-600"><i class="bx bx-x"></i>Remove</span>
												</div>
											</div>
											<div class="col-sm-12 tw-mt-2">
												<div class="row">
													<div class="col-sm-4 tw-mt-1">
														<x-form.checkbox name="item_11" class="chb_child" label="Item 1" />
													</div>
													<div class="col-sm-4 tw-mt-1">
														<x-form.checkbox name="item_22" class="chb_child" label="Item 2" />
													</div>
													<div class="col-sm-4 tw-mt-1">
														<x-form.checkbox name="item_33" class="chb_child" label="Item 3" />
													</div>
													<div class="col-sm-4 tw-mt-1">
														<x-form.checkbox name="item_44" class="chb_child" label="Item 4" />
													</div>
													<div class="col-sm-4 tw-mt-1">
														<x-form.checkbox name="item_55" class="chb_child" label="Item 5" />
													</div>
													<div class="col-sm-4 tw-mt-1">
														<x-form.checkbox name="item_66" class="chb_child" label="Item 6" />
													</div>
												</div>
											</div>
										</div>`;
				}
				$('.labor-service-container').append(service_categories);
			});
			$(document).on('click', '.btn-remove-service-category', function () {
				$(this).closest('.service-category').remove();
			});
			$(document).on('change', '.chb_all', function () {
				if ($(this).is(':checked')) {
					$(this).closest('.service-category').find('.chb_child').prop('checked', true);
				} else {
					$(this).closest('.service-category').find('.chb_child').prop('checked', false);
				}
			});
			$(document).on('change', '.chb_child', function () {
				if ($(this).is(':checked') && ($(this).closest('.service-category').find('.chb_child:checked').length == $(this).closest('.service-category').find('.chb_child').length)) {
					$(this).closest('.service-category').find('.chb_all').prop('checked', true);
				} else {
					$(this).closest('.service-category').find('.chb_all').prop('checked', false);
				}
			});

			$(document).ready(function () {
				$(".data_parent").each(function () {
					if ($(this).is(':checked')) {
						$('[data-parent="'+ $(this).attr('id') +'"]').removeAttr('disabled');
					} else {
						$('[data-parent="'+ $(this).attr('id') +'"]').attr('disabled', 'disabled');
					}
				});
				$('.data_parent').change(function (){
					if ($(this).is(':checked')) {
						$('[data-parent="'+ $(this).attr('id') +'"]').removeAttr('disabled');
					} else {
						$('[data-parent="'+ $(this).attr('id') +'"]').attr('disabled', 'disabled');
					}
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
						var id = $(this).closest('.tab-pane').attr('aria-labelledby');
						$('#'+ id +' i').remove();
						$('#'+ id).click().append('<i class="bx bx-error-circle text-danger animate__animated animate__rubberBand"></i>');
						rs = false;
					}
				});
				return rs;
			}

			$(document).on('change', '#evaluation_category', function () {
				$('#evaluation_indication').html('');
				$id_category = $(this).val();

				$.ajax({
					url: "/patient/consultation/get_indication/" + $id_category,
					type: 'get',
					success: function(rs){
						let obj = JSON.parse(rs);
						for (i in obj) {
							let newOption = new Option(name = obj[i], i, true, true);
                    		$('#evaluation_indication').append(newOption);
						}
					},
					error: function (rs) {
						// pageLoading('hide');
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: 'Something went wrong!',
							confirmButtonText: 'Confirm',
							timer: 1500
						});
					}
				});
			});

			$('.btn-submit').click(function (){
				var value = $(this).val();
				$('[name="submit_option"]').val(value);
				if (value=="cancel"){
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
							$('#consultation-form').submit();
						}
					})
				}else{
					if (formValidate('#consultation-form')) {
						$('#consultation-form').submit();
					}
				}
			});
		</script>
	</x-slot>
	<form id="consultation-form" action="{{ route('patient.consultation.update', $consultation->id) }}" method="post">
		@csrf
		@method('PUT')
		<input type="hidden" name="submit_option" value="cancel" />
		<x-card :actionShow="false" headerClass="" footerClass="" bodyClass="">
			<x-slot name="header">
				<h4>Edit Consultation</h4>
			</x-slot>
			<x-slot name="action">
				<div>
					<x-form.button class="btn-submit" value="2" color="success" icon="bx bx-check" label="Complete" />
					<x-form.button class="btn-submit" value="1" icon="bx bx-save" label="Save" />
					<!-- <x-form.button class="btn-submit" value="cancel" color="danger" icon="bx bx-x" label="Cancel" /> -->
				</div>
			</x-slot>
			<x-slot name="footer">
				<div>
					<x-form.button class="btn-submit" value="2" color="success" icon="bx bx-check" label="Complete" />
					<x-form.button class="btn-submit" value="1" icon="bx bx-save" label="Save" />
					<!-- <x-form.button class="btn-submit" value="cancel" color="danger" icon="bx bx-x" label="Cancel" /> -->
				</div>
			</x-slot>
			<table class="table-form">
				<tr>
					<td width="20%" class="text-right">Patient <small class='required'>*</small></td>
					<td width="30%">
						<x-bss-form.select
							name="patient_id"
							:select2="false"
							readonly
							required
						>
							<option value="{{ $consultation->patient_id }}" selected>{{ $consultation->patient->name_kh }}</option>
						</x-form.select2>
					</td>
					<td width="20%" class="text-right">Payment Type</td>
					<td>
						<x-bss-form.select name="payment_type" data-no_search="true">
							<option value="">Select payment type</option>
							@foreach ($payment_types as $id => $payment_type)
								<option value="{{ $id }}" {{ ($consultation->payment_type == $id)? 'selected' : '' }}>{{ $payment_type }}</option>
							@endforeach
						</x-bss-form.select>
					</td>
				</tr>
				<tr>
					<td class="text-right">Doctor <small class='required'>*</small></td>
					<td>
						<x-bss-form.select name="doctor_id">
							@foreach ($doctors as $doctor)
								<option value="{{ $doctor->id }}" {{ ($consultation->doctor_id == $doctor->id)? 'selected' : '' }}>{{ $doctor->name_en }}</option>
							@endforeach
						</x-bss-form.select>
					</td>
					<td class="text-right">Evaluate at <small class='required'>*</small></td>
					<td>
						<x-bss-form.input name='evaluated_at' class="date-time-picker" hasIcon="right" icon="bx bx-calendar" value="{{ $consultation->evaluated_at }}" />
					</td>
				</tr>
			</table>

			<ul class="nav nav-tabs mt-2 mb-0" role="tablist">
				<li class="nav-item">
					<a class="nav-link btn-sm active" id="vital-sign-tab" data-toggle="tab" href="#vital-sign" aria-controls="vital-sign" role="tab" aria-selected="true">
						<span class="align-middle">Vital Sign</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link btn-sm" id="past-medical-record-tab" data-toggle="tab" href="#past-medical-record" aria-controls="past-medical-record" role="tab" aria-selected="false">
						<span class="align-middle">Past medical Record</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link btn-sm" id="examination-tab" data-toggle="tab" href="#examination" aria-controls="examination" role="tab" aria-selected="false">
						<span class="align-middle">Examination</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link btn-sm" id="evaluation-tab" data-toggle="tab" href="#evaluation" aria-controls="evaluation" role="tab" aria-selected="false">
						<span class="align-middle">Evaluation</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link btn-sm" id="treatment-plan-tab" data-toggle="tab" href="#treatment-plan" aria-controls="treatment-plan" role="tab" aria-selected="false">
						<span class="align-middle">Treament Plan</span>
					</a>
				</li>
			</ul>
			<div class="tab-content pl-0">
				<div class="tab-pane active" id="vital-sign" aria-labelledby="vital-sign-tab" role="tabpanel">
					<table class="table-form striped">
						<tr>
							<td>Systolic (mmHg)</td>
							<td>
								<div class="input-group">
									<input type="text" name="vital_sign_systolic" class="form-control tw-border-r-0" value="{{ $consultation->vital_sign_systolic }}" />
									<div class="input-group-prepend">
										<span class="input-group-text bg-white tw-border-l-0">
											mmHg
										</span>
									</div>
								</div>
							</td>
							<td>Diastolic (mmHg)</td>
							<td>
								<div class="input-group">
									<input type="text" name="vital_sign_diastolic" class="form-control tw-border-r-0" value="{{ $consultation->vital_sign_diastolic }}" />
									<div class="input-group-prepend">
										<span class="input-group-text bg-white tw-border-l-0">
											mmHg
										</span>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>Pulse (/mn)</td>
							<td>
								<div class="input-group">
									<input type="text" name="vital_sign_pulse" class="form-control tw-border-r-0" value="{{ $consultation->vital_sign_pulse }}" />
									<div class="input-group-prepend">
										<span class="input-group-text bg-white tw-border-l-0">
											/mn
										</span>
									</div>
								</div>
							</td>
							<td>Breath (/mn)</td>
							<td>
								<div class="input-group">
									<input type="text" name="vital_sign_breath" class="form-control tw-border-r-0" value="{{ $consultation->vital_sign_breath }}" />
									<div class="input-group-prepend">
										<span class="input-group-text bg-white tw-border-l-0">
											/mn
										</span>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>Temperature (&deg;C)</td>
							<td>
								<div class="input-group">
									<input type="text" name="vital_sign_temperature" class="form-control tw-border-r-0" value="{{ $consultation->vital_sign_temperature }}" />
									<div class="input-group-prepend">
										<span class="input-group-text bg-white tw-border-l-0">
											&deg;C
										</span>
									</div>
								</div>
							</td>
							<td>O2sat (%)</td>
							<td>
								<div class="input-group">
									<input type="text" name="vital_sign_o2sat" class="form-control tw-border-r-0" value="{{ $consultation->vital_sign_o2sat }}" />
									<div class="input-group-prepend">
										<span class="input-group-text bg-white tw-border-l-0">
											%
										</span>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>Height (cm)</td>
							<td>
								<div class="input-group">
									<input type="text" name="vital_sign_height" class="form-control tw-border-r-0" value="{{ $consultation->vital_sign_height }}" />
									<div class="input-group-prepend">
										<span class="input-group-text bg-white tw-border-l-0">
											cm
										</span>
									</div>
								</div>
							</td>
							<td>Weight (kg)</td>
							<td>
								<div class="input-group">
									<input type="text" name="vital_sign_weight" class="form-control tw-border-r-0" value="{{ $consultation->vital_sign_weight }}" />
									<div class="input-group-prepend">
										<span class="input-group-text bg-white tw-border-l-0">
											%
										</span>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>Glucose (mg/dl)</td>
							<td>
								<div class="input-group">
									<input type="text" name="vital_sign_glucose" class="form-control tw-border-r-0" value="{{ $consultation->vital_sign_glucose }}" />
									<div class="input-group-prepend">
										<span class="input-group-text bg-white tw-border-l-0">
											mg/dl
										</span>
									</div>
								</div>
							</td>
							<td>Chief Complain</td>
							<td>
								<input type="text" name="vital_sign_chief_complain" class="form-control" value="{{ $consultation->vital_sign_chief_complain }}" />
							</td>
						</tr>
						<tr>
							<td>History of present illness</td>
							<td>
								<input type="text" name="vital_sign_history_of_illness" class="form-control" value="{{ $consultation->vital_sign_history_of_illness }}" />
							</td>
							<td>Current Medication</td>
							<td>
								<input type="text" name="vital_sign_current_medication" class="form-control" value="{{ $consultation->vital_sign_current_medication }}" />
							</td>
						</tr>
					</table>
				</div>
				<div class="tab-pane" id="past-medical-record" aria-labelledby="past-medical-record-tab" role="tabpanel">
					<table class="table-form striped">
						{{-- Vaccination --}}
						<tr>
							<td rowspan="3" class="text-right">Vaccination</td>
							<td>
								<div class="tw-mb-1">
									<x-form.checkbox name='pmr_bgc_hepb' label="BCG/HepB" :checked="$consultation->pmr_bgc_hepb" />
								</div>
							</td>
							<td>
								<div class="tw-mb-1">
									<x-form.checkbox name='pmr_opv_dpt_depb_hib1' label="OPV+DPT+HepB-Hib1" :checked="$consultation->pmr_opv_dpt_depb_hib1" />
								</div>
							</td>
							<td>
								<div class="tw-mb-1">
									<x-form.checkbox name='pmr_opv_dpt_depb_hib2' label="OPV+DPT+HepB-Hib2" :checked="$consultation->pmr_opv_dpt_depb_hib2" />
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="tw-mb-1">
									<x-form.checkbox name='pmr_opv_dpt_depb_hib3' label="OPV+DPT+HepB-Hib3" :checked="$consultation->pmr_opv_dpt_depb_hib3" />
								</div>
							</td>
							<td>
								<div class="tw-mb-1">
									<x-form.checkbox name='pmr_measles_jdtofrech' label="Measles+JDToFrench(juliandaycount)" :checked="$consultation->pmr_measles_jdtofrech" />
								</div>
							</td>
							<td>
								<div class="tw-mb-1">
									<x-form.checkbox name='pmr_tetanus' label="Tetanus" :checked="$consultation->pmr_tetanus"/>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="tw-mb-1">
									<x-form.checkbox name='pmr_none' label="None" :checked="$consultation->pmr_none"/>
								</div>
							</td>
							<td colspan="2"></td>
						</tr>
		
						{{-- Over Blood Pressure --}}
						<tr>
							<td>
								<div class="tw-mb-1">
									<x-form.checkbox name='pmr_over_blood_pressure' label="Over blood pressure" :checked="$consultation->pmr_over_blood_pressure"/>
								</div>
							</td>
							<td>
								<div class="tw-mb-1">
									<x-form.checkbox name='pmr_diabet' label="Diabet" :checked="$consultation->pmr_diabet"/>
								</div>
							</td>
							<td>
								<div class="tw-mb-1">
									<x-form.checkbox name='pmr_tuberculosis' label="Tuberculosis" :checked="$consultation->pmr_tuberculosis"/>
								</div>
							</td>
							<td></td>
						</tr>
						{{-- Cardio Vascular --}}
						<tr>
							<td class="text-right">
								<div class="tw-mb-1">
									<x-form.checkbox name='pmr_cardio_vascular' class="data_parent" label="Cardio Vascular" :checked="$consultation->pmr_cardio_vascular" />
								</div>
							</td>
							<td>
								<div class="tw-mb-2">
									<x-form.checkbox name='pmr_cardio_vascular_coronary_disease' data-parent="pmr_cardio_vascular" label="Coronary Disease" :checked="$consultation->pmr_cardio_vascular_coronary_disease"/>
								</div>
								<div class="tw-mb-2">
									<x-form.checkbox name='pmr_cardio_vascular_myocardio_disease' data-parent="pmr_cardio_vascular" label="Myocardio Disease" :checked="$consultation->pmr_cardio_vascular_myocardio_disease"/>
								</div>
								<div class="tw-mb-1">
									<x-form.checkbox name='pmr_cardio_vascular_valvulopathies' data-parent="pmr_cardio_vascular" label="Valvulopathies" :checked="$consultation->pmr_cardio_vascular_valvulopathies"/>
								</div>
							</td>
							<td class="text-right">
								<div class="tw-mb-1">
									<x-form.checkbox name='pmr_drugs' class="data_parent" label="Drugs" :checked="$consultation->pmr_drugs"/>
								</div>
							</td>
							<td>
								<div class="tw-mb-2">
									<x-form.checkbox name='pmr_drug_amphetamin' data-parent="pmr_drugs" label="Amphetamin" :checked="$consultation->pmr_drug_amphetamin"/>
								</div>
								<div class="tw-mb-2">
									<x-form.checkbox name='pmr_drug_methamphetamine' data-parent="pmr_drugs" label="Methamphetamine" :checked="$consultation->pmr_drug_methamphetamine"/>
								</div>
								<div class="tw-mb-2">
									<x-form.checkbox name='pmr_drug_morphin' data-parent="pmr_drugs" label="Morphin" :checked="$consultation->pmr_drug_morphin"/>
								</div>
								<div class="tw-mb-1">
									<x-form.checkbox name='pmr_drug_other' data-parent="pmr_drugs" label="Other" :checked="$consultation->pmr_drug_other"/>
								</div>
							</td>
						</tr>
		
						{{-- Drink --}}
						<tr>
							<td rowspan="3">
								<x-form.checkbox name='pmr_drinking' class="data_parent" label="Drinking" :checked="$consultation->pmr_drinking"/>
							</td>
							<td class="text-right">How long?</td>
							<td>
								<x-bss-form.input name='pmr_drinking_how_long' data-parent="pmr_drinking" value="{{ $consultation->pmr_drinking_how_long }}"/>
							</td>
							<td></td>
						</tr>
						<tr>
							<td class="text-right">What kind?</td>
							<td>
								<x-bss-form.input name='pmr_drinking_what_kind' data-parent="pmr_drinking" value="{{ $consultation->pmr_drinking_what_kind }}"/>
							</td>
							<td></td>
						</tr>
						<tr>
							<td class="text-right">How many?</td>
							<td>
								<x-bss-form.input name="pmr_drinking_how_many" data-parent="pmr_drinking" value="{{ $consultation->pmr_drinking_how_many }}"/>
							</td>
							<td></td>
						</tr>
		
						{{-- Operation --}}
						<tr>
							<td rowspan="2">
								<x-form.checkbox name="pmr_operation" class="data_parent" label="Operation" :checked="$consultation->pmr_operation"/>
							</td>
							<td class="text-right">At age</td>
							<td>
								<x-bss-form.input name="pmr_operation_at_age" data-parent="pmr_operation" value="{{ $consultation->pmr_operation_at_age }}"/>
							</td>
							<td></td>
						</tr>
						<tr>
							<td class="text-right">What kind?</td>
							<td>
								<x-bss-form.input name="pmr_operation_what_kind" data-parent="pmr_operation" value="{{ $consultation->pmr_operation_what_kind }}"/>
							</td>
							<td></td>
						</tr>
		
						{{-- Smoking --}}
						<tr>
							<td>
								<div class="tw-mb-1">
									<x-form.checkbox name="pmr_smoking" class="data_parent" label="Smoking" :checked="$consultation->pmr_smoking"/>
								</div>
							</td>
							<td class="text-right">How many?</td>
							<td>
								<x-bss-form.input name="pmr_smoking_how_many" data-parent="pmr_smoking" value="{{ $consultation->pmr_smoking_how_many }}"/>
							</td>
							<td></td>
						</tr>
		
						{{-- Other --}}
						<tr>
							<td>
								<x-form.checkbox name="pmr_other" class="data_parent" label="Other" :checked="$consultation->pmr_other"/>
							</td>
							<td>
								<x-bss-form.textarea name="pmr_other_input" placeholder="If others, please tell more." data-parent="pmr_other">{{ $consultation->pmr_other_input }}</x-bss-form.textarea>
							</td>
							<td>
								<x-form.checkbox name="pmr_medication" class="data_parent" label="Medication" checked="{{ $consultation->pmr_medication }}"/>
							</td>
							<td>
								<x-bss-form.textarea name="pmr_medication_input" placeholder="Please list the medicals." data-parent="pmr_medication">{{ $consultation->pmr_medication_input }}</x-bss-form.textarea>
							</td>
						</tr>
		
						{{-- Childhood & Development History --}}
						<tr>
							<td class="text-right">Childhood & Development History</td>
							<td>
								<x-bss-form.textarea name="pmr_childhood_development_history">{{ $consultation->pmr_childhood_development_history }}</x-bss-form.textarea>
							</td>
							<td class="text-right">Mental Illness History</td>
							<td>
								<x-bss-form.textarea name="pmr_mental_illess_history">{{ $consultation->pmr_mental_illess_history }}</x-bss-form.textarea>
							</td>
						</tr>
		
						{{-- Family History --}}
						<tr>
							<td class="text-right">Family History</td>
							<td>
								<x-bss-form.textarea name="pmr_childhood_development_history">{{ $consultation->pmr_childhood_development_history }}</x-bss-form.textarea>
							</td>
							<td></td>
							<td></td>
						</tr>
		
					</table>
				</div>
				<div class="tab-pane" id="examination" aria-labelledby="examination-tab" role="tabpanel">
					<table class="table-form striped">
						<tr>
							<th colspan="4" class="tw-bg-gray-100">General Appear</th>
						</tr>
						<tr>
							<td>
								<div class="tw-mb-1">
									<x-form.checkbox name='examination_good' label="Good" :checked="$consultation->examination_good"/>
								</div>
							</td>
							<td>
								<div class="tw-mb-1">
									<x-form.checkbox name='examination_not_good' label="Not Good" :checked="$consultation->examination_not_good"/>
								</div>
							</td>
							<td>
								<div class="tw-mb-1">
									<x-form.checkbox name='examination_serious' label="Serious" :checked="$consultation->examination_serious"/>
								</div>
							</td>
							<td>
								<div class="tw-mb-1">
									<x-form.checkbox name='examination_too_serious' label="Too Serious" :checked="$consultation->examination_too_serious"/>
								</div>
							</td>
						</tr>
		
						<tr>
							<th colspan="4" class="tw-bg-gray-100">Neurological System</th>
						</tr>
						<tr>
							<td>
								<div class="tw-mb-1">
									<x-form.checkbox name='examination_consciousness' label="Consciousness" :checked="$consultation->examination_consciousness"/>
								</div>
							</td>
							<td>
								<div class="tw-mb-1">
									<x-form.checkbox name='examination_fantasy' label="Fantasy" :checked="$consultation->examination_fantasy"/>
								</div>
							</td>
							<td>
								<div class="tw-mb-1">
									<x-form.checkbox name='examination_unconscious' label="Unconscious" :checked="$consultation->examination_unconscious"/>
								</div>
							</td>
							<td>
								<div class="tw-mb-1">
									<x-form.checkbox name='examination_seizures' label="Seizures" :checked="$consultation->examination_seizures"/>
								</div>
							</td>
						</tr>
		
						<tr>
							<td colspan="4" class="text-center">Mental Status</td>
						</tr>
						<tr>
							<td class="text-right">Speech</td>
							<td>
								<x-bss-form.textarea name="examination_speech">{{ $consultation->examination_speech }}</x-bss-form.textarea>
							</td>
							<td class="text-right">Mood and effect</td>
							<td>
								<x-bss-form.textarea name="examination_mood_and_effect">{{ $consultation->examination_mood_and_effect }}</x-bss-form.textarea>
							</td>
						</tr>
						<tr>
							<td class="text-right">Thought</td>
							<td>
								<x-bss-form.textarea name="examination_thought">{{ $consultation->examination_thought }}</x-bss-form.textarea>
							</td>
							<td class="text-right">Perception</td>
							<td>
								<x-bss-form.textarea name="examination_perception">{{ $consultation->examination_perception }}</x-bss-form.textarea>
							</td>
						</tr>
						<tr>
							<td class="text-right">Insight and Judgment</td>
							<td>
								<x-bss-form.textarea name="examination_insight_and_judgment">{{ $consultation->examination_insight_and_judgment }}</x-bss-form.textarea>
							</td>
							<td colspan="2"></td>
						</tr>
		
						<tr>
							<th colspan="4" class="tw-bg-gray-100">Score de Glasgow</th>
						</tr>
						<tr>
							<td class="text-right">Eyes</td>
							<td>
								<x-bss-form.input name='examination_score_de_glasgow_eyes' value="{{ $consultation->examination_score_de_glasgow_eyes }}"/>
							</td>
							<td class="text-right">Verbal</td>
							<td>
								<x-bss-form.input name='examination_score_de_glasgow_verbal' value="{{ $consultation->examination_score_de_glasgow_verbal }}"/>
							</td>
						</tr>
						<tr>
							<td class="text-right">Motion</td>
							<td>
								<x-bss-form.input name='examination_score_de_glasgow_motion' value="{{ $consultation->examination_score_de_glasgow_motion }}"/>
							</td>
							<td class="text-right">Percussion</td>
							<td>
								<x-bss-form.input name='examination_score_de_glasgow_percussion' value="{{ $consultation->examination_score_de_glasgow_percussion }}"/>
							</td>
						</tr>
						<tr>
							<td class="text-right">Auscultation</td>
							<td>
								<x-bss-form.input name='examination_score_de_glasgow_auscultation' value="{{ $consultation->examination_score_de_glasgow_auscultation }}"/>
							</td>
							<td colspan="2"></td>
						</tr>
		
						<tr>
							<th colspan="4" class="tw-bg-gray-100">Cardiovascular System</th>
						</tr>
						<tr>
							<td class="text-right">Inspection</td>
							<td>
								<x-bss-form.input name='examination_cardiovascular_inspection' value="{{ $consultation->examination_cardiovascular_inspection }}"/>
							</td>
							<td class="text-right">Palpation</td>
							<td>
								<x-bss-form.input name='examination_cardiovascular_palpation' value="{{ $consultation->examination_cardiovascular_palpation }}"/>
							</td>
						</tr>
						<tr>
							<td class="text-right">Percussion</td>
							<td>
								<x-bss-form.input name='examination_cardiovascular_percussion' value="{{ $consultation->examination_cardiovascular_percussion }}"/>
							</td>
							<td class="text-right">Auscultation</td>
							<td>
								<x-bss-form.input name='examination_cardiovascular_auscultation' value="{{ $consultation->examination_cardiovascular_auscultation }}"/>
							</td>
						</tr>
						<tr>
							<td class="text-right">Other</td>
							<td>
								<x-bss-form.textarea name="examination_cardiovascular_other">{{ $consultation->examination_cardiovascular_other }}</x-bss-form.textarea>
							</td>
							<td colspan="2"></td>
						</tr>
		
						<tr>
							<th colspan="4" class="tw-bg-gray-100">Eyes</th>
						</tr>
						<tr>
							<td class="text-right">Left</td>
							<td>
								<x-bss-form.input name='examination_eye_left' value="{{ $consultation->examination_eye_left }}"/>
							</td>
							<td class="text-right">Right</td>
							<td>
								<x-bss-form.input name='examination_eye_right' value="{{ $consultation->examination_eye_right }}"/>
							</td>
						</tr>
						<tr>
							<td class="text-right">Fondus</td>
							<td>
								<x-bss-form.input name='examination_eye_fondus' value="{{ $consultation->examination_eye_fondus }}"/>
							</td>
							<td class="text-right">Other</td>
							<td>
								<x-bss-form.textarea name="examination_eye_other">{{ $consultation->examination_eye_other }}</x-bss-form.textarea>
							</td>
						</tr>
		
						<tr>
							<th colspan="4" class="tw-bg-gray-100">Ears</th>
						</tr>
						<tr>
							<td class="text-right">Left</td>
							<td>
								<x-bss-form.input name='examination_ear_left' value="{{ $consultation->examination_ear_left }}"/>
							</td>
							<td class="text-right">Right</td>
							<td>
								<x-bss-form.input name='examination_ear_right' value="{{ $consultation->examination_ear_right }}"/>
							</td>
						</tr>
						<tr>
							<td class="text-right">Head</td>
							<td>
								<x-bss-form.input name='examination_ear_head' value="{{ $consultation->examination_ear_head }}"/>
							</td>
							<td class="text-right">Other</td>
							<td>
								<x-bss-form.textarea name="examination_ear_other">{{ $consultation->examination_ear_other }}</x-bss-form.textarea>
							</td>
						</tr>
		
						<tr>
							<th colspan="4" class="tw-bg-gray-100">Other body parts</th>
						</tr>
						<tr>
							<td class="text-right">Nose</td>
							<td>
								<x-bss-form.input name='examination_nose' value="{{ $consultation->examination_nose }}"/>
							</td>
							<td class="text-right">pharynxl</td>
							<td>
								<x-bss-form.input name='examination_pharynxl' value="{{ $consultation->examination_pharynxl }}"/>
							</td>
						</tr>
						<tr>
							<td class="text-right">Neck</td>
							<td>
								<x-bss-form.input name='examination_nech' value="{{ $consultation->examination_nech }}"/>
							</td>
							<td class="text-right">Lymphadenopathy</td>
							<td>
								<x-bss-form.input name='examination_lymphadenopathy' value="{{ $consultation->examination_lymphadenopathy }}"/>
							</td>
						</tr>
						<tr>
							<td class="text-right">Geneto-urinary</td>
							<td>
								<x-bss-form.input name='examination_geneto_urinary' value="{{ $consultation->examination_geneto_urinary }}"/>
							</td>
							<td class="text-right">Extremities</td>
							<td>
								<x-bss-form.input name='examination_extremities' value="{{ $consultation->examination_extremities }}"/>
							</td>
						</tr>
						<tr>
							<td class="text-right">Musculosqueletal</td>
							<td>
								<x-bss-form.input name='examination_musculosqueletal' value="{{ $consultation->examination_musculosqueletal }}"/>
							</td>
							<td class="text-right">Other</td>
							<td>
								<x-bss-form.textarea name="examination_other_body_part_other">{{ $consultation->examination_other_body_part_other }}</x-bss-form.textarea>
							</td>
						</tr>
					</table>
				</div>
				<div class="tab-pane" id="evaluation" aria-labelledby="evaluation-tab" role="tabpanel">
					@include('consultation.tabs.evaluation')
				</div>
				<div class="tab-pane" id="treatment-plan" aria-labelledby="treatment-plan-tab" role="tabpanel">
					@include('consultation.tabs.treament_plan')
				</div>
			</div>
		</x-card>
	
	</form>

	<x-modal id="treatment-model" dialogClass="modal-full" data-backdrop="static" data-keyboard="false">
		<x-slot name="footer">
			<x-form.button color="danger" data-dismiss="modal" icon="bx bx-x" label="{{ __('button.cancel') }}" />
			<x-form.button icon="bx bx-save" label="{{ __('button.save') }}" />
		</x-slot>
	</x-modal>

</x-app-layout>