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
											<x-bss-form.select2
												name="template"
												data-url="#"
												data-placeholder="Select template x-ray"
											/>
											<x-form.button color="light" class="btn-add-new-template tw-ml-2" icon="bx bx-plus" label="" />
										</div>
									</td>
								</tr>
								<tr>
									<td class="text-right">Analysed by</td>
									<td>
										<x-bss-form.select2
											name="analysed_by"
											data-url="#"
											data-placeholder="Select template x-ray"
										/>
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
					// Select2 Ajax
					$('.select2ajax').each((_i, e) => {
						var $e = $(e);
						var url = $e.data('url');
						var placeholder = $e.data('placeholder');
						var id = $e.attr('id');
						if ($('#hidden_'+ id).val()=='null') {
							$e.val('').trigger('change');
						}
						if ((url!='' && url!=undefined) && (placeholder!='' || placeholder!=undefined)) {
							$e.select2({
								width: "100%",
								dropdownAutoWidth: !0,
								dropdownParent: $e.parent(),
								placeholder: placeholder,
								allowClear: ((placeholder)? true : false),
								delay: 500,
								ajax: { 
									url: url,
									type: "post",
									dataType: 'json',
									delay: 250,
									data: function (params) {
										return {
											search: params.term
										};
									},
									processResults: function (data) {
										return {
											results: $.map(data, function (item) {
												if (Object.keys(data).length > 0) {
													var keys = Object.keys(data[0]);
													var rs_data = {};
													keys.forEach(function(value, index) {
														if (index==0) {
															rs_data['id'] = item[value];
														}else if(index==1){
															rs_data['text'] = item[value];
														}else{
															rs_data[value] = item[value];
														}
													});
													return rs_data;
												}
											})
										};
									},
									cache: true
								}
							});
						}
					});
					$(document).on('change', '.select2ajax', function () {
						var selector = $(this).attr('id');
						$('#hidden_'+ selector).val((($(this).find("option:selected").text()=='')? 'null' : $(this).find("option:selected").text()));
					});
				}
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
		</script>
	</x-slot>

	<x-card :foot="false">
		<x-slot name="header">
			<h4>New Consultation</h4>
		</x-slot>
		<table class="table-form">
			<tr>
				<td width="20%" class="text-right">Patient <small class='required'>*</small></td>
				<td width="30%">
					<x-bss-form.select2
						name="patient"
						data-url="{{ route('patient.getSelect2') }}"
						data-placeholder="---- None ----"
						required
					>
						@if ($patient)
							<option value="{{ $patient->id }}" selected>{{ $patient->name_kh }}</option>
						@endif
					</x-form.select2>
				</td>
				<td width="20%" class="text-right">Payment Type</td>
				<td>
					<x-bss-form.select name="payment_type">
						<option value="">Select payment type</option>
						<option value="Cash">Cash</option>
					</x-bss-form.select>
				</td>
			</tr>
			<tr>
				<td class="text-right">Doctor <small class='required'>*</small></td>
				<td>
					<x-bss-form.select name="doctor">
						<option value="1">Krouk Puthea</option>
						{{-- @foreach ($doctors as $doctor)
							<option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
						@endforeach --}}
					</x-bss-form.select>
				</td>
				<td class="text-right">Evaluate at <small class='required'>*</small></td>
				<td>
					<x-bss-form.input name='evaluate_at' class="date-time-picker" hasIcon="right" icon="bx bx-calendar" value="{{ date('Y-m-d H:i:s') }}" />
				</td>
			</tr>
		</table>
	</x-card>

	<ul class="nav nav-tabs mt-3 mb-0" role="tablist">
		<li class="nav-item">
			<a class="nav-link" id="vital-sign-tab" data-toggle="tab" href="#vital-sign" aria-controls="vital-sign" role="tab" aria-selected="true">
				<span class="align-middle">Vital Sign</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="past-medical-record-tab" data-toggle="tab" href="#past-medical-record" aria-controls="past-medical-record" role="tab" aria-selected="false">
				<span class="align-middle">Past medical Record</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="examination-tab" data-toggle="tab" href="#examination" aria-controls="examination" role="tab" aria-selected="false">
				<span class="align-middle">Examination</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="evaluation-tab" data-toggle="tab" href="#evaluation" aria-controls="evaluation" role="tab" aria-selected="false">
				<span class="align-middle">Evaluation</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link active" id="treatment-plan-tab" data-toggle="tab" href="#treatment-plan" aria-controls="treatment-plan" role="tab" aria-selected="false">
				<span class="align-middle">Treament Plan</span>
			</a>
		</li>
	</ul>
	<x-card :foot="false" :head="false">
		<div class="tab-content">
			<div class="tab-pane" id="vital-sign" aria-labelledby="vital-sign-tab" role="tabpanel">
				<table class="table-form striped">
					<tr>
						<td>Systolic (mmHg)</td>
						<td>
							<div class="input-group">
								<input type="text" name="systolic" class="form-control tw-border-r-0" />
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
								<input type="text" name="diastolic" class="form-control tw-border-r-0" />
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
								<input type="text" name="pulse" class="form-control tw-border-r-0" />
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
								<input type="text" name="breath" class="form-control tw-border-r-0" />
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
								<input type="text" name="temperature" class="form-control tw-border-r-0" />
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
								<input type="text" name="o2sat" class="form-control tw-border-r-0" />
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
								<input type="text" name="height" class="form-control tw-border-r-0" />
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
								<input type="text" name="weight" class="form-control tw-border-r-0" />
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
								<input type="text" name="glucose" class="form-control tw-border-r-0" />
								<div class="input-group-prepend">
									<span class="input-group-text bg-white tw-border-l-0">
										mg/dl
									</span>
								</div>
							</div>
						</td>
						<td>Chief Complain</td>
						<td>
							<input type="text" name="chief_complain" class="form-control" />
						</td>
					</tr>
					<tr>
						<td>History of present illness</td>
						<td>
							<input type="text" name="history_of_illness" class="form-control" />
						</td>
						<td>Current Medication</td>
						<td>
							<input type="text" name="current_medication" class="form-control" />
						</td>
					</tr>
				</table>
				{{-- <div class="row">
					<div class="col-sm-6">
						<x-form.input
							name="systolic"
							inputGroup="true"
							append="mmHg"
							label="Systolic (mmHg)"
						/>
					</div>
					<div class="col-sm-6">
						<x-form.input
							name="diastolic"
							inputGroup="true"
							append="mmHg"
							label="Diastolic (mmHg)"
						/>
					</div>
					<div class="col-sm-6">
						<x-form.input
							name="pulse"
							inputGroup="true"
							append="/mn"
							label="Pulse (/mn)"
						/>
					</div>
					<div class="col-sm-6">
						<x-form.input
							name="breath"
							inputGroup="true"
							append="/mn"
							label="Breath (/mn)"
						/>
					</div>
					<div class="col-sm-6">
						<x-form.input
							name="temperature"
							inputGroup="true"
							append="&deg;C"
							label="Temperature (&deg;C)"
						/>
					</div>
					<div class="col-sm-6">
						<x-form.input
							name="o2sat"
							inputGroup="true"
							append="%"
							label="O2sat (%)"
						/>
					</div>
					<div class="col-sm-6">
						<x-form.input
							name="height"
							inputGroup="true"
							append="cm"
							label="Height (cm)"
						/>
					</div>
					<div class="col-sm-6">
						<x-form.input
							name="weight"
							inputGroup="true"
							append="kg"
							label="Weight (kg)"
						/>
					</div>
					<div class="col-sm-6">
						<x-form.input
							name="glucose"
							inputGroup="true"
							append="mg/dl"
							label="Glucose (mg/dl)"
						/>
					</div>
					<div class="col-sm-6">
						<x-form.input
							name="chief_complain"
							label="Chief Complain"
						/>
					</div>
					<div class="col-sm-6">
						<x-form.input
							name="history_of_illness"
							label="History of present illness"
						/>
					</div>
					<div class="col-sm-6">
						<x-form.input
							name="current_medication"
							label="Current Medication"
						/>
					</div>
				</div> --}}
			</div>
			<div class="tab-pane" id="past-medical-record" aria-labelledby="past-medical-record-tab" role="tabpanel">
				<table class="table-form striped">
					{{-- Vaccination --}}
					<tr>
						<td rowspan="3" class="text-right">Vaccination</td>
						<td>
							<x-form.checkbox name='bgc_hepb' label="BCG/HepB" />
						</td>
						<td>
							<x-form.checkbox name='opv_dpt_depb_hib1' label="OPV+DPT+HepB-Hib1" />
						</td>
						<td>
							<x-form.checkbox name='opv_dpt_depb_hib2' label="OPV+DPT+HepB-Hib2" />
						</td>
					</tr>
					<tr>
						<td>
							<x-form.checkbox name='opv_dpt_depb_hib3' label="OPV+DPT+HepB-Hib3" />
						</td>
						<td>
							<x-form.checkbox name='measles_jdtofrech' label="Measles+JDToFrench(juliandaycount)" />
						</td>
						<td>
							<x-form.checkbox name='tetanus' label="Tetanus" />
						</td>
					</tr>
					<tr>
						<td>
							<x-form.checkbox name='none' label="None" />
						</td>
						<td colspan="2"></td>
					</tr>
	
					{{-- Over Blood Pressure --}}
					<tr>
						<td>
							<x-form.checkbox name='over_blood_pressure' label="Over blood pressure" />
						</td>
						<td>
							<x-form.checkbox name='diabet' label="Diabet" />
						</td>
						<td>
							<x-form.checkbox name='tuberculosis' label="Tuberculosis" />
						</td>
						<td></td>
					</tr>
	
					{{-- Cardio Vascular --}}
					<tr>
						<td class="text-right">
							<x-form.checkbox name='cardio_vascular' label="Cardio Vascular" />
						</td>
						<td>
							<div class="tw-mb-2">
								<x-form.checkbox name='coronary_disease' label="Coronary Disease" />
							</div>
							<div class="tw-mb-2">
								<x-form.checkbox name='myocardio_disease' label="Myocardio Disease" />
							</div>
							<div>
								<x-form.checkbox name='valvulopathies' label="Valvulopathies" />
							</div>
						</td>
						<td class="text-right">
							<x-form.checkbox name='drugs' label="Drugs" />
						</td>
						<td>
							<div class="tw-mb-2">
								<x-form.checkbox name='amphetamin' label="Amphetamin" />
							</div>
							<div class="tw-mb-2">
								<x-form.checkbox name='methamphetamine' label="Methamphetamine" />
							</div>
							<div class="tw-mb-2">
								<x-form.checkbox name='morphin' label="Morphin" />
							</div>
							<div>
								<x-form.checkbox name='other' label="Other" />
							</div>
						</td>
					</tr>
	
					{{-- Drink --}}
					<tr>
						<td rowspan="3">
							<x-form.checkbox name='drinking' label="Drinking" />
						</td>
						<td class="text-right">How long?</td>
						<td>
							<x-bss-form.input name='drinking_how_long' />
						</td>
						<td></td>
					</tr>
					<tr>
						<td class="text-right">What kind?</td>
						<td>
							<x-bss-form.input name='drinking_what_kind' />
						</td>
						<td></td>
					</tr>
					<tr>
						<td class="text-right">How many?</td>
						<td>
							<x-bss-form.input name='drinking_how_many' />
						</td>
						<td></td>
					</tr>
	
					{{-- Operation --}}
					<tr>
						<td rowspan="2">
							<x-form.checkbox name='operation' label="Operation" />
						</td>
						<td class="text-right">At age</td>
						<td>
							<x-bss-form.input name='operation_at_age' />
						</td>
						<td></td>
					</tr>
					<tr>
						<td class="text-right">What kind?</td>
						<td>
							<x-bss-form.input name='operation_what_kind' />
						</td>
						<td></td>
					</tr>
	
					{{-- Smoking --}}
					<tr>
						<td>
							<x-form.checkbox name='smoking' label="Smoking" />
						</td>
						<td class="text-right">How many?</td>
						<td>
							<x-bss-form.input name='smoking_how_many' />
						</td>
						<td></td>
					</tr>
	
					{{-- Other --}}
					<tr>
						<td>
							<x-form.checkbox name='other' label="Other" />
						</td>
						<td>
							<x-bss-form.textarea name="other" placeholder="If others, please tell more."></x-bss-form.textarea>
						</td>
						<td>
							<x-form.checkbox name='medication' label="Medication" />
						</td>
						<td>
							<x-bss-form.textarea name="medication_reaction" placeholder="Please list the medicals."></x-bss-form.textarea>
						</td>
					</tr>
	
					{{-- Childhood & Development History --}}
					<tr>
						<td class="text-right">Childhood & Development History</td>
						<td>
							<x-bss-form.textarea name="childhood_development_history"></x-bss-form.textarea>
						</td>
						<td class="text-right">Mental Illness History</td>
						<td>
							<x-bss-form.textarea name="mental_illess_history"></x-bss-form.textarea>
						</td>
					</tr>
	
					{{-- Family History --}}
					<tr>
						<td class="text-right">Family History</td>
						<td>
							<x-bss-form.textarea name="childhood_development_history"></x-bss-form.textarea>
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
							<x-form.checkbox name='examination_good' label="Good" />
						</td>
						<td>
							<x-form.checkbox name='examination_not_good' label="Not Good" />
						</td>
						<td>
							<x-form.checkbox name='examination_serious' label="Not Good" />
						</td>
						<td>
							<x-form.checkbox name='examination_too_serious' label="Not Good" />
						</td>
					</tr>
	
					<tr>
						<th colspan="4" class="tw-bg-gray-100">Neurological System</th>
					</tr>
					<tr>
						<td>
							<x-form.checkbox name='examination_consciousness' label="Consciousness" />
						</td>
						<td>
							<x-form.checkbox name='examination_fantasy' label="Fantasy" />
						</td>
						<td>
							<x-form.checkbox name='examination_unconscious' label="Unconscious" />
						</td>
						<td>
							<x-form.checkbox name='examination_seizures' label="Seizures" />
						</td>
					</tr>
	
					<tr>
						<td colspan="4" class="text-center">Mental Status</td>
					</tr>
					<tr>
						<td class="text-right">Speech</td>
						<td>
							<x-bss-form.textarea name="examination_speech"></x-bss-form.textarea>
						</td>
						<td class="text-right">Mood and effect</td>
						<td>
							<x-bss-form.textarea name="examination_mood_and_effect"></x-bss-form.textarea>
						</td>
					</tr>
					<tr>
						<td class="text-right">Thought</td>
						<td>
							<x-bss-form.textarea name="examination_thought"></x-bss-form.textarea>
						</td>
						<td class="text-right">Perception</td>
						<td>
							<x-bss-form.textarea name="examination_perception"></x-bss-form.textarea>
						</td>
					</tr>
					<tr>
						<td class="text-right">Insight and Judgment</td>
						<td>
							<x-bss-form.textarea name="examination_insight_and_judgment"></x-bss-form.textarea>
						</td>
						<td colspan="2"></td>
					</tr>
	
					<tr>
						<th colspan="4" class="tw-bg-gray-100">Score de Glasgow</th>
					</tr>
					<tr>
						<td class="text-right">Eyes</td>
						<td>
							<x-bss-form.input name='examination_score_de_glasgow_eyes' />
						</td>
						<td class="text-right">Verbal</td>
						<td>
							<x-bss-form.input name='examination_score_de_glasgow_verbal' />
						</td>
					</tr>
					<tr>
						<td class="text-right">Motion</td>
						<td>
							<x-bss-form.input name='examination_score_de_glasgow_motion' />
						</td>
						<td class="text-right">Percussion</td>
						<td>
							<x-bss-form.input name='examination_score_de_glasgow_percussion' />
						</td>
					</tr>
					<tr>
						<td class="text-right">Auscultation</td>
						<td>
							<x-bss-form.input name='examination_score_de_glasgow_auscultation' />
						</td>
						<td colspan="2"></td>
					</tr>
	
					<tr>
						<th colspan="4" class="tw-bg-gray-100">Cardiovascular System</th>
					</tr>
					<tr>
						<td class="text-right">Inspection</td>
						<td>
							<x-bss-form.input name='examination_cardiovascular_inspection' />
						</td>
						<td class="text-right">Palpation</td>
						<td>
							<x-bss-form.input name='examination_cardiovascular_palpation' />
						</td>
					</tr>
					<tr>
						<td class="text-right">Percussion</td>
						<td>
							<x-bss-form.input name='examination_cardiovascular_percussion' />
						</td>
						<td class="text-right">Auscultation</td>
						<td>
							<x-bss-form.input name='examination_cardiovascular_auscultation' />
						</td>
					</tr>
					<tr>
						<td class="text-right">Other</td>
						<td>
							<x-bss-form.textarea name="examination_cardiovascular_other"></x-bss-form.textarea>
						</td>
						<td colspan="2"></td>
					</tr>
	
					<tr>
						<th colspan="4" class="tw-bg-gray-100">Eyes</th>
					</tr>
					<tr>
						<td class="text-right">Left</td>
						<td>
							<x-bss-form.input name='examination_eye_left' />
						</td>
						<td class="text-right">Right</td>
						<td>
							<x-bss-form.input name='examination_eye_right' />
						</td>
					</tr>
					<tr>
						<td class="text-right">Fondus</td>
						<td>
							<x-bss-form.input name='examination_eye_fondus' />
						</td>
						<td class="text-right">Other</td>
						<td>
							<x-bss-form.textarea name="examination_eye_other"></x-bss-form.textarea>
						</td>
					</tr>
	
					<tr>
						<th colspan="4" class="tw-bg-gray-100">Ears</th>
					</tr>
					<tr>
						<td class="text-right">Left</td>
						<td>
							<x-bss-form.input name='examination_ear_left' />
						</td>
						<td class="text-right">Right</td>
						<td>
							<x-bss-form.input name='examination_ear_right' />
						</td>
					</tr>
					<tr>
						<td class="text-right">Head</td>
						<td>
							<x-bss-form.input name='examination_ear_head' />
						</td>
						<td class="text-right">Other</td>
						<td>
							<x-bss-form.textarea name="examination_ear_other"></x-bss-form.textarea>
						</td>
					</tr>
	
					<tr>
						<th colspan="4" class="tw-bg-gray-100">Other body parts</th>
					</tr>
					<tr>
						<td class="text-right">Nose</td>
						<td>
							<x-bss-form.input name='examination_nose' />
						</td>
						<td class="text-right">pharynxl</td>
						<td>
							<x-bss-form.input name='examination_pharynxl' />
						</td>
					</tr>
					<tr>
						<td class="text-right">Neck</td>
						<td>
							<x-bss-form.input name='examination_nech' />
						</td>
						<td class="text-right">Lymphadenopathy</td>
						<td>
							<x-bss-form.input name='examination_lymphadenopathy' />
						</td>
					</tr>
					<tr>
						<td class="text-right">Geneto-urinary</td>
						<td>
							<x-bss-form.input name='examination_geneto_urinary' />
						</td>
						<td class="text-right">Extremities</td>
						<td>
							<x-bss-form.input name='examination_extremities' />
						</td>
					</tr>
					<tr>
						<td class="text-right">Musculosqueletal</td>
						<td>
							<x-bss-form.input name='examination_musculosqueletal' />
						</td>
						<td class="text-right">Other</td>
						<td>
							<x-bss-form.textarea name="examination_other_body_part_other"></x-bss-form.textarea>
						</td>
					</tr>
				</table>
			</div>
			<div class="tab-pane" id="evaluation" aria-labelledby="evaluation-tab" role="tabpanel">
				<table class="table-form striped">
					<tr>
						<td class="text-right">Evaluation Summary</td>
						<td>
							<x-bss-form.textarea name="evaluation_summary"></x-bss-form.textarea>
						</td>
					</tr>
					<tr>
						<td class="text-right">Category</td>
						<td>
							<x-bss-form.select name="evaluation_category">
								<option value="">Select Category</option>
							</x-bss-form.select>
						</td>
					</tr>
					<tr>
						<td class="text-right">Indication</td>
						<td>
							<x-bss-form.select name="evaluation_indication">
								<option value="">Select Disease</option>
							</x-bss-form.select>
						</td>
					</tr>
					<tr>
						<td class="text-right">Information Diagnosis <small class="required">*</small></td>
						<td>
							<x-bss-form.textarea name="evaluation_information_diagnosis" rows="4"></x-bss-form.textarea>
						</td>
					</tr>
				</table>
			</div>
			<div class="tab-pane active" id="treatment-plan" aria-labelledby="treatment-plan-tab" role="tabpanel">
				<table class="table-form striped">
					<tr>
						<th colspan="2" class="tw-bg-gray-100 text-center">
							<i class="bx bx-file"></i> List treament plan
						</th>
					</tr>
					<tr>
						<td width="30%">
							<div class="d-flex justify-content-between">
								<b>Prescription</b>
								<x-form.button class="btn-treatment-toggle" data-type="prescription" color="light" icon="bx bx-plus" label=""/>
							</div>
						</td>
						<td></td>
					</tr>
					<tr>
						<td>
							<div class="d-flex justify-content-between">
								<b>Labor-Test</b>
								<x-form.button class="btn-treatment-toggle" data-type="labor-test" color="light" icon="bx bx-plus" label=""/>
							</div>
						</td>
						<td></td>
					</tr>
					<tr>
						<td>
							<div class="d-flex justify-content-between">
								<b>Xray</b>
								<x-form.button class="btn-treatment-toggle" data-type="xray" color="light" icon="bx bx-plus" label=""/>
							</div>
						</td>
						<td></td>
					</tr>
					<tr>
						<td>
							<div class="d-flex justify-content-between">
								<b>Echography</b>
								<x-form.button class="btn-treatment-toggle" data-type="echography" color="light" icon="bx bx-plus" label=""/>
							</div>
						</td>
						<td></td>
					</tr>
					<tr>
						<td>
							<div class="d-flex justify-content-between">
								<b>ECG</b>
								<x-form.button class="btn-treatment-toggle" data-type="ecg" color="light" icon="bx bx-plus" label=""/>
							</div>
						</td>
						<td></td>
					</tr>
				</table>
			</div>
		</div>
	</x-card>

	<x-modal id="treatment-model" dialogClass="modal-full" data-backdrop="static" data-keyboard="false">
		<x-slot name="footer">
			<x-form.button color="danger" data-dismiss="modal" icon="bx bx-x" label="{{ __('button.cancel') }}" />
			<x-form.button icon="bx bx-save" label="{{ __('button.save') }}" />
		</x-slot>
	</x-modal>

</x-app-layout>