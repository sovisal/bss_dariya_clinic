<x-app-layout>
	<x-slot name="css">
		<style>
			
		</style>
	</x-slot>
	<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
	<x-slot name="js">
		<script>
			
		</script>
	</x-slot>


	<x-bss-form.textarea name="liver" class="my-editor" :value="old('liver', !empty($row) && $row->liver ? $row->liver : '')"></x-bss-form.textarea>
</x-app-layout>