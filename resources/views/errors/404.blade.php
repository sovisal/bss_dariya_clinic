<x-guest-layout>
	<x-slot name="css">
		<style>
		</style>
	</x-slot>
	<div id="page-404" class="container-fluid">
		<section class="row justify-content-center">
			<div class="col-xl-6 col-md-7 col-9">
				<div class="card bg-transparent shadow-none mt-4">
					<div class="card-body text-center bg-transparent">
						<h1 class="error-title">{{ __('alert.message.error.page_not_found') }} :(</h1>
						<p class="pb-3">{{ __('alert.message.error.we_could_not_find_your_page') }}</p>
						<img class="img-fluid m-auto" src="{{ asset('images/errors/404.png') }}" alt="404 error">
						<a href="{{ route('home') }}" class="btn btn-primary round glow mt-3">{{ __('button.back_home') }}</a>
					</div>
				</div>
			</div>
		</section>
	</div>
</x-guest-layout>