<x-app-layout>
	<x-slot name="js">
		<script>
			$(document).ready(function () {
				
			});
		</script>
	</x-slot>
	<x-slot name="header">
		<x-form.button href="{{ route('prescription.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
	</x-slot>
	<form action="{{ route('prescription.update', $row) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
		@method('PUT')
		@csrf
		<input type="hidden" name="status" value="{{ $row->status ?: 1 }}"/>
		<x-card bodyClass="pb-0" :actionShow="false">
			<x-slot name="action">
				<div>
					<x-form.button type="button" class="btn-submit" value="Complete" color="success" icon="bx bx-check" label="Complete" onclick="$(this).parents('form').find('[name=status]').val(2); document.forms[0].submit();"/>
					<x-form.button type="submit" class="btn-submit" value="Progress" icon="bx bx-save" label="Save" />
					<x-form.button type="reset" class="btn-submit" value="Cancel" color="danger" icon="bx bx-x" label="Cancel" />
				</div>
			</x-slot>
			<x-slot name="footer">
				<div>
					<x-form.button type="button" class="btn-submit" value="Complete" color="success" icon="bx bx-check" label="Complete" onclick="$(this).parents('form').find('[name=status]').val(2); document.forms[0].submit();"/>
					<x-form.button type="submit" class="btn-submit" value="Progress" icon="bx bx-save" label="Save" />
					<x-form.button type="reset" class="btn-submit" value="Cancel" color="danger" icon="bx bx-x" label="Cancel" />
				</div>
			</x-slot>			
			<table class="table-form striped">
				<tr>
					<th colspan="4" class="text-left tw-bg-gray-100">Echo COde #dasd123</th>
				</tr>
				@include('prescription.form_input')
			</table>
			<br>
			@include('prescription.form_result')
		</x-card>
	</form>

</x-app-layout>
