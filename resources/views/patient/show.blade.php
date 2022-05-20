<x-app-layout>
	<x-slot name="header">
		<x-form.button href="{{ route('patient.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
	</x-slot>

	<x-card :head="false" :foot="false">
		<table class="table-form border-none table-padding-sm">
			<tr>
				<td width="150px" rowspan="4" style="vertical-align: top; padding-left: 1.2rem !important; padding-right: 1.2rem !important;" class="text-center">
					<img src="{{ (($patient->photo)? asset('images/patients/'. $patient->photo) : asset('images/browse-image.jpg') ) }}" alt="..." class="m-auto">
				</td>
				<th width="150px">Patient Code <span class="float-right">:</span></th>
				<td width="20%">PT-{{ str_pad($patient->id, 6, '0', STR_PAD_LEFT) }}</td>
				<th width="150px">Registered <span class="float-right">:</span></th>
				<td>{{ date('d-M-Y H:m', strtotime($patient->registered_at)) }}</td>
				<td width="150px" class="text-center" rowspan="4" style="vertical-align: top;">
					<x-form.button href="{{ route('patient.edit', $patient->id) }}" class="btn-block" icon="bx bx-edit-alt" label="Edit" />
					{{-- <x-form.button href="{{ route('patient.edit', $patient->id) }}" class="btn-block" color="secondary" icon="bx bx-printer" label="Print" /> --}}
				</td>
			</tr>
			<tr>
				<th>Name KH <span class="float-right">:</span></th>
				<td>{{ $patient->name_kh }}</td>
				<th>Name EN <span class="float-right">:</span></th>
				<td>{{ $patient->name_en }}</td>
			</tr>
			<tr>
				<th>Gender <span class="float-right">:</span></th>
				<td>{{ getParentDataByType('gender', $patient->gender) }}</td>
				<th>Phone <span class="float-right">:</span></th>
				<td>{{ $patient->phone }}</td>
			</tr>
			<tr>
				<th>Age <span class="float-right">:</span></th>
				<td>{{ $patient->age }}</td>
				<th>E-mail <span class="float-right">:</span></th>
				<td>{{ $patient->email }}</td>
			</tr>
		</table>
	</x-card>

	
	<ul class="nav nav-tabs mt-3 mb-0" role="tablist">
		<li class="nav-item">
			<a class="nav-link btn-sm active" id="detail-tab" data-toggle="tab" href="#detail" aria-controls="detail" role="tab" aria-selected="true">
				<span class="align-middle">Detail</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link btn-sm" id="visit-tab" data-toggle="tab" href="#visit" aria-controls="visit" role="tab" aria-selected="false">
				<span class="align-middle">Visit</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link btn-sm" id="prescription-tab" data-toggle="tab" href="#prescription" aria-controls="prescription" role="tab" aria-selected="false">
				<span class="align-middle">Prescription</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link btn-sm" id="paraclinic-tab" data-toggle="tab" href="#paraclinic" aria-controls="paraclinic" role="tab" aria-selected="false">
				<span class="align-middle">Paraclinics</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link btn-sm" id="invoice-tab" data-toggle="tab" href="#invoice" aria-controls="invoice" role="tab" aria-selected="false">
				<span class="align-middle">Invoices</span>
			</a>
		</li>
	</ul>
	<x-card :foot="false" :head="false">
		<div class="tab-content">
			<div class="tab-pane active" id="detail" aria-labelledby="detail-tab" role="tabpanel">
				<table class="table-form">
					<tr>
						<th colspan="4" class="text-center tw-bg-gray-100">Patient Information</th>
					</tr>
					<tr>
						<th width="200px">ID Card Number <span class="float-right">:</span></th>
						<td>{{ $patient->id_card_no }}</td>
						<th width="200px">Nationality <span class="float-right">:</span></th>
						<td>{{ getParentDataByType('nationality', $patient->nationality) }}</td>
					</tr>
					<tr>
						<th>Date of birth <span class="float-right">:</span></th>
						<td>{{ $patient->date_of_birth ? date('d-M-Y', strtotime($patient->date_of_birth)) : '' }}</td>
						<th>Position <span class="float-right">:</span></th>
						<td>{{ $patient->position }}</td>
					</tr>
					<tr>
						<th>Education <span class="float-right">:</span></th>
						<td>{{ $patient->education }}</td>
						<th>Marital Status <span class="float-right">:</span></th>
						<td>{{ getParentDataByType('marital_status', $patient->marital_status) }}</td>
					</tr>
					<tr>
						<th>Position <span class="float-right">:</span></th>
						<td>{{ $patient->position }}</td>
						<th>Enterprise <span class="float-right">:</span></th>
						<td>{{ $patient->enterprise }}</td>
					</tr>
					<tr>
						<th>Blood Type <span class="float-right">:</span></th>
						<td>{{ getParentDataByType('blood_type', $patient->blood_type) }}</td>
						<td colspan="2"></td>
					</tr>

					<tr>
						<th colspan="4" class="text-center tw-bg-gray-100">Patient Address</th>
					</tr>
					<tr>
						<th>House <span class="float-right">:</span></th>
						<td>{{ $patient->house_no }}</td>
						<th>Street <span class="float-right">:</span></th>
						<td>{{ $patient->street_no }}</td>
					</tr>
					<tr>
						<th>Villsage <span class="float-right">:</span></th>
						<td>{{ $patient->address()->village_en }}</td>
						<th>Commune <span class="float-right">:</span></th>
						<td>{{ $patient->address()->commune_en }}</td>
					</tr>
					<tr>
						<th>District <span class="float-right">:</span></th>
						<td>{{ $patient->address()->district_en }}</td>
						<th>Province <span class="float-right">:</span></th>
						<td>{{ $patient->address()->province_en }}</td>
					</tr>
					<tr>
						<th>Zip Code <span class="float-right">:</span></th>
						<td>{{ $patient->zip_code }}</td>
						<td colspan="2"></td>
					</tr>
				</table>
			</div>
			<div class="tab-pane" id="visit" aria-labelledby="visit-tab" role="tabpanel">
				{{-- <x-form.button href="{{ route('patient.consultation.create', ['patient' => $patient->id]) }}" icon="bx bx-plus" label="New Follow up" /> --}}
				
				<x-table class="mt-1 table-padding-sm">
					<x-slot name="thead">
						<th width="150px">Code</th>
						<th>Physician</th>
						<th>Patient</th>
						<th>Date Evaluation</th>
						<th width="200px">Diagnosis Info</th>
						<th>Type</th>
						<th>Status</th>
						<th>Modify at</th>
						<th width="8%">Action</th>
					</x-slot>
					@foreach ($patient->consultations as $consultation)
						<tr>
							<td class="text-center">MED-{{ str_pad($consultation->id, 6, '0', STR_PAD_LEFT) }}</td>
							<td>{{ $consultation->doctor_name }}</td>
							<td>{{ $patient->name_kh }}</td>
							<td>{{ date('', strtotime($consultation->evaluation_date)) }}</td>
							<td>{{ $consultation->diagnosis }}</td>
							<td>{{ $consultation->type }}</td>
							<td class="text-center">
								<span class="badge badge-{{ (($consultation->status=='complete')? 'success' : 'primary') }}">{{ $consultation->status }}</span>
							</td>
							<td>{{ date('d-M-Y H:i', strtotime($consultation->updated_at)) }}</td>
							<td>
								<x-form.button icon="bx bx-printer" />
								@can('UpdatePatient')
									<x-form.button color="secondary" href="{{ route('patient.consultation.edit', $consultation->id) }}" icon="bx bx-edit-alt" />
								@endcan
							</td>
						</tr>
					@endforeach
				</x-table>
			</div>
			<div class="tab-pane" id="prescription" aria-labelledby="prescription-tab" role="tabpanel">
				Prescription
			</div>
			<div class="tab-pane" id="paraclinic" aria-labelledby="paraclinic-tab" role="tabpanel">
				Paraclincs
			</div>
			<div class="tab-pane" id="invoice" aria-labelledby="invoice-tab" role="tabpanel">
				Invoices
			</div>
		</div>
	</x-card>

</x-app-layout>
