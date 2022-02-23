<x-guest-layout>
	<x-slot name="css">
		<style>
			.login-wrapper{
				margin: 0 auto;
				padding-top:9%;
				max-width: 400px;
			}
			.login-wrapper .input-group .input-group-append button{
				/* border: 1px solid #dfe3e7 !important; */
			}
		</style>
	</x-slot>
	<x-slot name="js">
		<script>
			function loadForm() {
				$('#user-form').addClass('sr-only');
				$('#login-form').removeClass('sr-only');
				$('.login-wrapper .icon i').attr('class', 'bx bx-lock tw-text-6xl tw-rounded-full p-1 tw-border-4 tw-border-gray-500');
				$('.input-password').addClass('animate__animated animate__pulse');
				$('#password').focus();
				setTimeout(() => {
					$('.input-password').removeClass('animate__animated animate__pulse');
				}, 1000);
			}
			function checkUserId() {
				pageLoading('show');
				$.ajax({
					url: "{{ route('user.checkUserID') }}",
					type: "POST",
					data: { "user": $('#user').val() },
					success: function(data) {
						if(data.success){
							pageLoading('hide');
							$('.whologin').html(data.username);
							$('#username').val(data.username);
							$('#user').val('');
							$('#user').removeClass('is-invalid');
							$('.feedback').addClass('invisible').removeClass('animate__pulse');
							loadForm()
						}else{
							pageLoading('hide');
							$('#user').addClass('is-invalid');
							$('.feedback').removeClass('invisible').addClass('animate__pulse');
							setTimeout(() => {
								$('.feedback').removeClass('animate__pulse');
							}, 1000);
						}
					},
					error: function(data) {
						// console.log(data);
					},
				});
			}

			$(document).on('keyup', '#user', function (e) {
				if(e.which == 13) {
					checkUserId();
				}
			});
			$(document).on('click', '.btn-check-user', function (e) {
				checkUserId();
			});
			$(document).on('click', '#back-to-user-form', function (e) {
				$('#login-form').addClass('sr-only');
				$('#user-form').removeClass('sr-only');
				$('.login-wrapper .icon i').attr('class', 'bx bx-user tw-text-6xl tw-rounded-full p-1 tw-border-4 tw-border-gray-500');
				$('#user').focus();
			});
		</script>
	</x-slot>

	<div class="login-wrapper">
		<h3 class="text-center mb-2">Login</h3>
		<div class="text-center icon">
			<i class="bx bx-{{ ((old('username'))? 'lock' : 'user') }} tw-text-6xl tw-rounded-full p-1 tw-border-4 tw-border-gray-500"></i>
		</div>

		<div id="user-form" class="{{ ((old('username'))? 'sr-only' : '') }}">
			<div class="feedback text-center text-danger tw-mb-1 invisible animate__animated">User not found!</div>
			<div class="input-group">
				<input type="text" name="user" id="user" class="form-control" placeholder="enter username" {{ ((old('username'))? '' : 'autofocus') }} autocomplete="off">
				<div class="input-group-append">
				  <button class="btn btn-primary btn-check-user" type="button"><i class="bx bx-right-arrow-alt"></i></button>
				</div>
			</div>
		</div>

		<div id="login-form" class="{{ ((old('username'))? '' : 'sr-only') }}">
			<form action="{{ route('login') }}" method="POST">
				<div class="text-center text-danger tw-mb-1 animate__animated {{ ((old('username'))? 'animate__pulse' : 'invisible') }}">
					@error('username')
						{{ $message }}
					@enderror
					{{ ((old('username'))? '' : 'U') }}
				</div>
				<div class="input-group input-password">
					<input type="password" class="form-control" name="password" id="password" placeholder="password" {{ ((old('username'))? 'autofocus' : '') }} autocomplete="off" required/>
					<div class="input-group-append">
						<button type="submit" class="btn btn-primary"><i class="bx bx-right-arrow-alt"></i></button>
					</div>
				</div>
				<h3 class="whologin mt-1 text-center">{{ old('username') }}</h3>
				<input type="hidden" name="username" id="username" value="{{ old('username') }}" autocomplete="off"/>
				@csrf
			</form>
			<div class="text-center mt-1">
				<button type="button" class="btn btn-secondary" id="back-to-user-form"><i class="bx bx-left-arrow-alt"></i> Back</button>
			</div>
		</div>
			
		@if(!empty(env('GIT_USR')) && !empty(env('GIT_TOKEN')) && !empty(env('GIT_PATH')) && InternetIsConnected())
			@php
				Artisan::call('git:pull');
				$status = Artisan::output();
				$status_str = preg_replace("/[^a-zA-Z0-9 .]+/", "", $status);
			@endphp
			<br/>
			@if ($status_str != "Already up to date.")
				<a class="txt2" href="/login?sync=1">
					Synchronize local project<i class="sync-spinnig la la-sync tw-ml-1" aria-hidden="true"></i>
					<br>
					<mark>Status : {{ $status }}</mark>
				</a>
			@endif
		@endif
		<br/>
	</div>
</x-guest-layout>