<x-guest-layout>
	<div class="mb-4 text-sm text-gray-600">
		{{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
	</div>
	<form method="POST" action="{{ route('password.confirm') }}">
		@csrf
		<!-- Password -->
		<x-form.input name="password" type="text" required label="{!! __('Password') !!} <small class='required'>*</small>" />
		<div class="flex justify-end mt-4">
			<x-form.button type="submit" label="{!! __('Confirm') !!}" />
		</div>
	</form>
</x-guest-layout>
