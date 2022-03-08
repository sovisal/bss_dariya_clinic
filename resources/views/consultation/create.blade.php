<x-app-layout>

	<x-card :foot="false">
		<x-slot name="header">
			New Consultation
		</x-slot>
		
		<div class="row">
			<div class="col-sm-6">
				<x-form.select
					name="patient"
					:select2="false"
					label="Patient <small class='required'>*</small>"
					readonly
				>
					<option value="{{ $patient->id }}">{{ $patient->name_kh }}</option>
				</x-form.select>
			</div>
			<div class="col-sm-6">
				<x-form.select
					name="payment_type"
					data-no_search="true"
					label="Payment Type"
				>
					<option value="">Select payment type</option>
					<option value="Cash">Cash</option>
				</x-form.select>
			</div>
			<div class="col-sm-6">
				<x-form.select
					name="doctor"
					label="Doctor <small class='required'>*</small>"
				>
					<option value="1">Krouk Puthea</option>
					{{-- @foreach ($doctors as $doctor)
						<option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
					@endforeach --}}
				</x-form.select>
			</div>
			<div class="col-sm-6">
				<x-form.input
					name="evaluate_at"
					class="date-picker"
					hasIcon="right"
					icon="bx bx-calendar"
					value="{{ date('Y-m-d H:i:s') }}"
					label="Evaluate at <small class='required'>*</small>"
				/>
			</div>
		</div>

		<ul class="nav nav-tabs" role="tablist">
			<li class="nav-item">
				<a class="nav-link" id="vital-sign-tab" data-toggle="tab" href="#vital-sign" aria-controls="vital-sign" role="tab" aria-selected="true">
					<span class="align-middle">Vital Sign</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link active" id="past-medical-record-tab" data-toggle="tab" href="#past-medical-record" aria-controls="past-medical-record" role="tab" aria-selected="false">
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
				<a class="nav-link" id="treatment-plan-tab" data-toggle="tab" href="#treatment-plan" aria-controls="treatment-plan" role="tab" aria-selected="false">
					<span class="align-middle">Treament Plan</span>
				</a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane" id="vital-sign" aria-labelledby="vital-sign-tab" role="tabpanel">
				<div class="row">
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
				</div>
			</div>
			<div class="tab-pane active" id="past-medical-record" aria-labelledby="past-medical-record-tab" role="tabpanel">
				<div class="form-gorup">
					<label for="">Vaccination</label>
					<div class="form-control">
						<div class="row">
							<div class="col">
								<x-form.checkbox
									name='bgc_hepb'
									label="BCG/HepB"
								/>
							</div>
							<div class="col">
								<x-form.checkbox
									name='opv_dpt_depb_hib1'
									label="OPV+DPT+HepB-Hib1"
								/>
							</div>
							<div class="col">
								<x-form.checkbox
									name='opv_dpt_depb_hib2'
									label="OPV+DPT+HepB-Hib2"
								/>
							</div>
							<div class="col">
								<x-form.checkbox
									name='opv_dpt_depb_hib3'
									label="OPV+DPT+HepB-Hib3"
								/>
							</div>
							<div class="col">
								<x-form.checkbox
									name='measles_jdtofrech'
									label="Measles+JDToFrench(juliandaycount)"
								/>
							</div>
							<div class="col">
								<x-form.checkbox
									name='tetanus'
									label="Tetanus"
								/>
							</div>
							<div class="col">
								<x-form.checkbox
									name='none'
									label="None"
								/>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane" id="examination" aria-labelledby="examination-tab" role="tabpanel">
				<p>
					Examination
				</p>
			</div>
			<div class="tab-pane" id="evaluation" aria-labelledby="evaluation-tab" role="tabpanel">
				<p>
					Evaluation
				</p>
			</div>
			<div class="tab-pane" id="treatment-plan" aria-labelledby="treatment-plan-tab" role="tabpanel">
				<p>
					Treatment Plan
				</p>
			</div>
		</div>

	</x-card>

</x-app-layout>