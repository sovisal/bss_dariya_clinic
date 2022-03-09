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

		<ul class="nav nav-tabs mt-2" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" id="vital-sign-tab" data-toggle="tab" href="#vital-sign" aria-controls="vital-sign" role="tab" aria-selected="true">
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
				<a class="nav-link" id="treatment-plan-tab" data-toggle="tab" href="#treatment-plan" aria-controls="treatment-plan" role="tab" aria-selected="false">
					<span class="align-middle">Treament Plan</span>
				</a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="vital-sign" aria-labelledby="vital-sign-tab" role="tabpanel">
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
			<div class="tab-pane" id="past-medical-record" aria-labelledby="past-medical-record-tab" role="tabpanel">
				<table class="table table-bordered table-striped">
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
						<td class="text-right">
							How long?
						</td>
						<td>
							<input type="text" name="drinking_how_long" class="form-control" />
						</td>
						<td></td>
					</tr>
					<tr>
						<td class="text-right">
							What kind?
						</td>
						<td>
							<input type="text" name="drinking_what_kind" class="form-control" />
						</td>
						<td></td>
					</tr>
					<tr>
						<td class="text-right">
							How many?
						</td>
						<td>
							<input type="text" name="drinking_how_many" class="form-control" />
						</td>
						<td></td>
					</tr>

					{{-- Operation --}}
					<tr>
						<td rowspan="2">
							<x-form.checkbox name='operation' label="Operation" />
						</td>
						<td class="text-right">
							At age
						</td>
						<td>
							<input type="text" name="operation_at_age" class="form-control" />
						</td>
						<td></td>
					</tr>
					<tr>
						<td class="text-right">
							What kind?
						</td>
						<td>
							<input type="text" name="operation_what_kind" class="form-control" />
						</td>
						<td></td>
					</tr>

					{{-- Smoking --}}
					<tr>
						<td>
							<x-form.checkbox name='smoking' label="Smoking" />
						</td>
						<td class="text-right">
							How many?
						</td>
						<td>
							<input type="text" name="smoking_how_many" class="form-control" />
						</td>
						<td></td>
					</tr>

					{{-- Other --}}
					<tr>
						<td>
							<x-form.checkbox name='other' label="Other" />
						</td>
						<td>
							<textarea type="text" name="other" rows="2" class="form-control" placeholder="If others, please tell more."></textarea>
						</td>
						<td>
							<x-form.checkbox name='medication' label="Medication" />
						</td>
						<td>
							<textarea type="text" name="other" rows="2" class="form-control" placeholder="Please list the medicals."></textarea>
						</td>
					</tr>

					{{-- Childhood & Development History --}}
					<tr>
						<td class="text-right">
							Childhood & Development History
						</td>
						<td>
							<textarea type="text" name="childhood_development_history" rows="2" class="form-control"></textarea>
						</td>
						<td class="text-right">
							Mental Illness History
						</td>
						<td>
							<textarea type="text" name="mental_illess_history" rows="2" class="form-control"></textarea>
						</td>
					</tr>

					{{-- Family History --}}
					<tr>
						<td class="text-right">
							Family History
						</td>
						<td>
							<textarea type="text" name="childhood_development_history" rows="2" class="form-control"></textarea>
						</td>
						<td></td>
						<td></td>
					</tr>

				</table>

				{{-- <div class="form-gorup">
					<label for="">Vaccination</label>
					<div class="border tw-p-2">
						<div class="row">
							<div class="col-sm-4">
								<x-form.checkbox
									name='bgc_hepb'
									label="BCG/HepB"
								/>
							</div>
							<div class="col-sm-4">
								<x-form.checkbox
									name='opv_dpt_depb_hib1'
									label="OPV+DPT+HepB-Hib1"
								/>
							</div>
							<div class="col-sm-4">
								<x-form.checkbox
									name='opv_dpt_depb_hib2'
									label="OPV+DPT+HepB-Hib2"
								/>
							</div>
							<div class="col-sm-4">
								<x-form.checkbox
									name='opv_dpt_depb_hib3'
									label="OPV+DPT+HepB-Hib3"
								/>
							</div>
							<div class="col-sm-4">
								<x-form.checkbox
									name='measles_jdtofrech'
									label="Measles+JDToFrench(juliandaycount)"
								/>
							</div>
							<div class="col-sm-4">
								<x-form.checkbox
									name='tetanus'
									label="Tetanus"
								/>
							</div>
							<div class="col-sm-4">
								<x-form.checkbox
									name='none'
									label="None"
								/>
							</div>
						</div>
					</div>
				</div> --}}
			</div>
			<div class="tab-pane" id="examination" aria-labelledby="examination-tab" role="tabpanel">
				<table class="table table-bordered table-striped">
					<tr>
						<th colspan="4" class="tw-bg-gray-100">
							General Appear
						</th>
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
						<th colspan="4" class="tw-bg-gray-100">
							Neurological System
						</th>
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
						<td colspan="4" class="text-center">
							Mental Status
						</td>
					</tr>
					<tr>
						<td class="text-right">
							Speech
						</td>
						<td>
							<input type="text" name="examination_speech" class="form-control" />
						</td>
						<td class="text-right">
							Mood and effect
						</td>
						<td>
							<input type="text" name="examination_mood_and_effect" class="form-control" />
						</td>
					</tr>
					<tr>
						<td class="text-right">
							Thought
						</td>
						<td>
							<input type="text" name="examination_thought" class="form-control" />
						</td>
						<td class="text-right">
							Perception
						</td>
						<td>
							<input type="text" name="examination_perception" class="form-control" />
						</td>
					</tr>
					<tr>
						<td class="text-right">
							Insight and Judgment
						</td>
						<td>
							<input type="text" name="examination_insight_and_judgment" class="form-control" />
						</td>
						<td colspan="2"></td>
					</tr>

					<tr>
						<th colspan="4" class="tw-bg-gray-100">
							Score de Glasgow
						</th>
					</tr>
					<tr>
						<td class="text-right">
							Eyes
						</td>
						<td>
							<input type="text" name="examination_score_de_glasgow_eyes" class="form-control" />
						</td>
						<td class="text-right">
							Verbal
						</td>
						<td>
							<input type="text" name="examination_score_de_glasgow_verbal" class="form-control" />
						</td>
					</tr>
					<tr>
						<td class="text-right">
							Motion
						</td>
						<td>
							<input type="text" name="examination_score_de_glasgow_motion" class="form-control" />
						</td>
						<td class="text-right">
							Percussion
						</td>
						<td>
							<input type="text" name="examination_score_de_glasgow_percussion" class="form-control" />
						</td>
					</tr>
					<tr>
						<td class="text-right">
							Auscultation
						</td>
						<td>
							<input type="text" name="examination_score_de_glasgow_auscultation" class="form-control" />
						</td>
						<td colspan="2"></td>
					</tr>

					<tr>
						<th colspan="4" class="tw-bg-gray-100">
							Cardiovascular System
						</th>
					</tr>
					<tr>
						<td class="text-right">
							Inspection
						</td>
						<td>
							<input type="text" name="examination_cardiovascular_inspection" class="form-control" />
						</td>
						<td class="text-right">
							Palpation
						</td>
						<td>
							<input type="text" name="examination_cardiovascular_palpation" class="form-control" />
						</td>
					</tr>
					<tr>
						<td class="text-right">
							Percussion
						</td>
						<td>
							<input type="text" name="examination_cardiovascular_percussion" class="form-control" />
						</td>
						<td class="text-right">
							Auscultation
						</td>
						<td>
							<input type="text" name="examination_cardiovascular_auscultation" class="form-control" />
						</td>
					</tr>
					<tr>
						<td class="text-right">
							Other
						</td>
						<td>
							<textarea rows="2" name="examination_cardiovascular_other" class="form-control"></textarea>
						</td>
						<td colspan="2"></td>
					</tr>

					<tr>
						<th colspan="4" class="tw-bg-gray-100">
							Eyes
						</th>
					</tr>
					<tr>
						<td class="text-right">
							Left
						</td>
						<td>
							<input type="text" name="examination_eye_left" class="form-control" />
						</td>
						<td class="text-right">
							Right
						</td>
						<td>
							<input type="text" name="examination_eye_right" class="form-control" />
						</td>
					</tr>
					<tr>
						<td class="text-right">
							Fondus
						</td>
						<td>
							<input type="text" name="examination_eye_fondus" class="form-control" />
						</td>
						<td class="text-right">
							Other
						</td>
						<td>
							<textarea rows="2" name="examination_eye_other" class="form-control"></textarea>
						</td>
					</tr>

					<tr>
						<th colspan="4" class="tw-bg-gray-100">
							Ears
						</th>
					</tr>
					<tr>
						<td class="text-right">
							Left
						</td>
						<td>
							<input type="text" name="examination_ear_left" class="form-control" />
						</td>
						<td class="text-right">
							Right
						</td>
						<td>
							<input type="text" name="examination_ear_right" class="form-control" />
						</td>
					</tr>
					<tr>
						<td class="text-right">
							Head
						</td>
						<td>
							<input type="text" name="examination_ear_head" class="form-control" />
						</td>
						<td class="text-right">
							Other
						</td>
						<td>
							<textarea rows="2" name="examination_ear_other" class="form-control"></textarea>
						</td>
					</tr>

					<tr>
						<th colspan="4" class="tw-bg-gray-100">
							Other body parts
						</th>
					</tr>
					<tr>
						<td class="text-right">
							Nose
						</td>
						<td>
							<input type="text" name="examination_nose" class="form-control" />
						</td>
						<td class="text-right">
							pharynxl
						</td>
						<td>
							<input type="text" name="examination_pharynxl" class="form-control" />
						</td>
					</tr>
					<tr>
						<td class="text-right">
							Neck
						</td>
						<td>
							<input type="text" name="examination_nech" class="form-control" />
						</td>
						<td class="text-right">
							Lymphadenopathy
						</td>
						<td>
							<input type="text" name="examination_lymphadenopathy" class="form-control" />
						</td>
					</tr>
					<tr>
						<td class="text-right">
							Geneto-urinary
						</td>
						<td>
							<input type="text" name="examination_geneto_urinary" class="form-control" />
						</td>
						<td class="text-right">
							Extremities
						</td>
						<td>
							<input type="text" name="examination_extremities" class="form-control" />
						</td>
					</tr>
					<tr>
						<td class="text-right">
							Musculosqueletal
						</td>
						<td>
							<input type="text" name="examination_musculosqueletal" class="form-control" />
						</td>
						<td class="text-right">
							Other
						</td>
						<td>
							<textarea rows="2" name="examination_other_body_part_other" class="form-control"></textarea>
						</td>
					</tr>
				</table>
			</div>
			<div class="tab-pane" id="evaluation" aria-labelledby="evaluation-tab" role="tabpanel">
				<table class="table table-bordered table-striped">
					<tr>
						<td class="text-right">
							Evaluation Summary
						</td>
						<td>
							<textarea name="evaluation_summary" rows="4" class="form-control"></textarea>
						</td>
					</tr>
					<tr>
						<td class="text-right">
							Category
						</td>
						<td>
							<select name="evaluation_category" class="form-control">
								<option value="">Select Category</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="text-right">
							Indication
						</td>
						<td>
							<select name="evaluation_indication" class="form-control">
								<option value="">Select Category</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="text-right">
							Information Diagnosis <small class="required">*</small>
						</td>
						<td>
							<textarea name="evaluation_summary" rows="4" class="form-control"></textarea>
						</td>
					</tr>
				</table>
			</div>
			<div class="tab-pane" id="treatment-plan" aria-labelledby="treatment-plan-tab" role="tabpanel">
				<p>
					Treatment Plan
				</p>
			</div>
		</div>

	</x-card>

</x-app-layout>