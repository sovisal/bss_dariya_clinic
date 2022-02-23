<x-modal id="modal-crop-image">
	<x-slot name="header">
		{{ __('alert.modal.crop_image') }}
	</x-slot>
	<div id="image-cropping"></div>
	<x-slot name="footer">
		{{-- <x-form.button color="danger" id="btn-cancel-image" data-dismiss="modal" label="{{ __('button.cancel') }}" /> --}}
		<x-form.button id="btn-crop-image" :hideLabelOnXS="true" icon="bx bx-crop" label="{{ __('button.crop') }}" />
	</x-slot>
</x-modal>