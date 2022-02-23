<x-guest-layout>
	<x-slot name="css">
		<style>
			
		</style>
	</x-slot>
	<x-slot name="js">
		<script>
		</script>
	</x-slot>

	<div class="row justify-content-center mt-4">
		<div class="col-sm-4">
			<form action="{{ route('login') }}" method="post">
				@csrf
				<x-card :actionShow="false">
					<x-slot name="header">
						LOGIN
					</x-slot>
					<x-slot name="footer">
						<x-form.button
							type="submit"
							label="Login"
							class="btn-block"
							icon="bx bx-log-in"
						/>
					</x-slot>
					<x-form.input
						name="username"
						label="Username"
						hasIcon="left"
						icon="bx bx-user"
					/>
					<x-form.input
						type="password"
						name="password"
						label="Password"
						hasIcon="left"
						icon="bx bx-lock"
					/>
					<x-form.checkbox
						name="remember"
						id="remember"
						label="Remember"
					/>
				</x-card>
			</form>
		</div>
	</div>


</x-guest-layout>