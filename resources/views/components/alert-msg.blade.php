@if (session('success'))
	<div class="alert alert-success alert-dismissible mb-2" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<div class="d-flex align-items-center">
			<i class="bx bx-check"></i>
			<span>
				{!! session('success') !!}
			</span>
		</div>
	</div>
@endif
@if (session('warning'))
	<div class="alert alert-warning alert-dismissible mb-2" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<div class="d-flex align-items-center">
			<i class="bx bx-error-circle"></i>
			<span>
				{!! session('warning') !!}
			</span>
		</div>
	</div>
@endif
@if (session('error'))
	<div class="alert alert-danger alert-dismissible mb-2" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<div class="d-flex align-items-center">
			<i class="bx bx-error"></i>
			<span>
				{!! session('error') !!}
			</span>
		</div>
	</div>
@endif
@if (count($errors) > 0)
	<div class="alert alert-danger alert-dismissible mb-2" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<div class="d-flex align-items-center">
			<i class="bx bx-error"></i>
			<span>
				<ul class="mb-0">
					@foreach ($errors->all() as $error)
							<li>{!! $error !!}</li>
					@endforeach
				</ul>
			</span>
		</div>
	</div>
@endif