<x-app-layout>
	<x-slot name="sidebar">

	</x-slot>
	<x-slot name="css">
		<style>
			
		</style>
	</x-slot>
	<x-slot name="js">
		<script>
			$('.clickMe').click(function () {
				$('.inner').append(`<x-form.input name="asdf" label="asdf" :inputGroup="true" append="@" />`);
			});
		</script>
	</x-slot>

	<div class="mb-1 text-right">
		<x-form.button
			{{-- href="/" --}}
			icon="bx bx-plus"
			label="Create"
		/>
	</div>

	<x-card :foot="false" :head="false">

		<button class="btn btn-primary clickMe">Click me</button>
		<div class="inner"></div>
		<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloribus voluptas labore debitis fugiat ipsam quaerat ad repellendus magni nam, iure unde. In exercitationem dolor id ipsa possimus deleniti, ipsam magni! Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatem deserunt eos autem, quae et dolorem ut esse possimus cumque id eum beatae sed, corrupti amet maiores obcaecati dolorum odio a.</p>
		<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloribus voluptas labore debitis fugiat ipsam quaerat ad repellendus magni nam, iure unde. In exercitationem dolor id ipsa possimus deleniti, ipsam magni! Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatem deserunt eos autem, quae et dolorem ut esse possimus cumque id eum beatae sed, corrupti amet maiores obcaecati dolorum odio a.</p>
		<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloribus voluptas labore debitis fugiat ipsam quaerat ad repellendus magni nam, iure unde. In exercitationem dolor id ipsa possimus deleniti, ipsam magni! Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatem deserunt eos autem, quae et dolorem ut esse possimus cumque id eum beatae sed, corrupti amet maiores obcaecati dolorum odio a.</p>
		<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloribus voluptas labore debitis fugiat ipsam quaerat ad repellendus magni nam, iure unde. In exercitationem dolor id ipsa possimus deleniti, ipsam magni! Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatem deserunt eos autem, quae et dolorem ut esse possimus cumque id eum beatae sed, corrupti amet maiores obcaecati dolorum odio a.</p>
		<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloribus voluptas labore debitis fugiat ipsam quaerat ad repellendus magni nam, iure unde. In exercitationem dolor id ipsa possimus deleniti, ipsam magni! Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatem deserunt eos autem, quae et dolorem ut esse possimus cumque id eum beatae sed, corrupti amet maiores obcaecati dolorum odio a.</p>
		<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloribus voluptas labore debitis fugiat ipsam quaerat ad repellendus magni nam, iure unde. In exercitationem dolor id ipsa possimus deleniti, ipsam magni! Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatem deserunt eos autem, quae et dolorem ut esse possimus cumque id eum beatae sed, corrupti amet maiores obcaecati dolorum odio a.</p>
	</x-card>

</x-app-layout>