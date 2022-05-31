<x-print-layout>
	{{-- <x-slot name="css">
		<link rel="stylesheet" href="{{ asset('css/print-style.css') }}">
	</x-slot> --}}

	<section class="print-preview-a4">
		<header>
			<x-para-clinic.print-header :row="$labor" title="Laboratory Report">
				<tr>
					<td width="17%"><b>ស្នើដោយ/Prescripteur</b></td>
					<td>: {{ $labor->requested_by_name }}</td>
					<td width="10%"><b>គំរូ/Sample</b></td>
					<td colspan="3">: BLOOD</td>
				</tr>
			</x-para-clinic.print-header>
		</header>
		<section class="labor-body">
			<section class="type-section">
				<h4 class="text-uppercase text-underline text-center mt-1">HEMATOLOGIE</h4>
				<section class="category-section">
					<div class="text-uppercase mt-1">NUMERATION GLOBULAIRI</div>
					<table width="100%" class="ml-1">
						<tr>
							<td class="leaders">
								<div>
									<span >Leucocytes</span>
									<span>:</span>
								</div>
							</td>
							<td width="14%">10.7</td>
							<td width="15%">10 3/uL</td>
							<td width="28%">(4.00 - 10.00)</td>
						</tr>
						<tr>
							<td class="leaders">
								<div>
									<span >Leucocytes</span>
									<span>:</span>
								</div>
							</td>
							<td width="14%">10.7</td>
							<td width="15%">10 3/uL</td>
							<td width="28%">(4.00 - 10.00)</td>
						</tr>
						<tr>
							<td class="leaders">
								<div>
									<span >Leucocytes</span>
									<span>:</span>
								</div>
							</td>
							<td width="14%">10.7</td>
							<td width="15%">10 3/uL</td>
							<td width="28%">(4.00 - 10.00)</td>
						</tr>
						<tr>
							<td class="leaders">
								<div>
									<span >Leucocytes</span>
									<span>:</span>
								</div>
							</td>
							<td width="14%">10.7</td>
							<td width="15%">10 3/uL</td>
							<td width="28%">(4.00 - 10.00)</td>
						</tr>
					</table>
				</section>
				<section class="category-section">
					<div class="text-uppercase mt-1">NUMERATION GLOBULAIRI</div>
					<table width="100%" class="ml-1">
						<tr>
							<td class="leaders">
								<div>
									<span >Leucocytes</span>
									<span>:</span>
								</div>
							</td>
							<td width="14%">10.7</td>
							<td width="15%">10 3/uL</td>
							<td width="28%">(4.00 - 10.00)</td>
						</tr>
						<tr>
							<td class="leaders">
								<div>
									<span >Leucocytes</span>
									<span>:</span>
								</div>
							</td>
							<td width="14%">10.7</td>
							<td width="15%">10 3/uL</td>
							<td width="28%">(4.00 - 10.00)</td>
						</tr>
						<tr>
							<td class="leaders">
								<div>
									<span >Leucocytes</span>
									<span>:</span>
								</div>
							</td>
							<td width="14%">10.7</td>
							<td width="15%">10 3/uL</td>
							<td width="28%">(4.00 - 10.00)</td>
						</tr>
						<tr>
							<td class="leaders">
								<div>
									<span >Leucocytes</span>
									<span>:</span>
								</div>
							</td>
							<td width="14%">10.7</td>
							<td width="15%">10 3/uL</td>
							<td width="28%">(4.00 - 10.00)</td>
						</tr>
					</table>
				</section>
			</section>
			<section class="type-section">
				<h4 class="text-uppercase text-underline text-center mt-1">HEMATOLOGIE</h4>
				<section class="category-section">
					<div class="text-uppercase mt-1">NUMERATION GLOBULAIRI</div>
					<table width="100%" class="ml-1">
						<tr>
							<td class="leaders">
								<div>
									<span >Leucocytes</span>
									<span>:</span>
								</div>
							</td>
							<td width="14%">10.7</td>
							<td width="15%">10 3/uL</td>
							<td width="28%">(4.00 - 10.00)</td>
						</tr>
						<tr>
							<td class="leaders">
								<div>
									<span >Leucocytes</span>
									<span>:</span>
								</div>
							</td>
							<td width="14%">10.7</td>
							<td width="15%">10 3/uL</td>
							<td width="28%">(4.00 - 10.00)</td>
						</tr>
						<tr>
							<td class="leaders">
								<div>
									<span >Leucocytes</span>
									<span>:</span>
								</div>
							</td>
							<td width="14%">10.7</td>
							<td width="15%">10 3/uL</td>
							<td width="28%">(4.00 - 10.00)</td>
						</tr>
						<tr>
							<td class="leaders">
								<div>
									<span >Leucocytes</span>
									<span>:</span>
								</div>
							</td>
							<td width="14%">10.7</td>
							<td width="15%">10 3/uL</td>
							<td width="28%">(4.00 - 10.00)</td>
						</tr>
					</table>
				</section>
			</section>
		</section>
		<div class="signature">
			<div class="text-center">ថ្ងៃទី {{ date('d/m/Y', strtotime($labor->requested_at)) }}</div>
			<div class="text-center">Dr. {{ $labor->doctor_kh }}</div>
			<img src="{{ asset('images/site/signature.png') }}" alt="">
		</div>
		
		<x-para-clinic.print-footer />
	</section>

</x-print-layout>