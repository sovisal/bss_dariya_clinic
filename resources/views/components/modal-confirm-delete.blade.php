

<x-modal id="modal_confirm_delete">

	<x-slot name="header">
		{{ __('alert.modal.confirm_password') }}
	</x-slot>

	<x-slot name="footer">
		<x-form.button
			id="submitConfirmDelete"
			data-dismiss="modal"
			data-title-success="{{ __('alert.swal.title.success') }}"
			data-btn-confirm="{{ __('alert.swal.btn.confirm') }}"
			data-title-empty="{{ __('alert.swal.title.empty') }}"
			:hideLabelOnXS="true"
			icon="bx bx-check"
			label="{{ __('button.confirm') }}"
		/>
	</x-slot>

	<input type="text" name="username" id="username" class="sr-only" autocomplete="username"/>
	<input type="password" name="password" id="password" data-deleteonenter="true" class="form-control" placeholder="password" autocomplete="current-password"/>
</x-modal>