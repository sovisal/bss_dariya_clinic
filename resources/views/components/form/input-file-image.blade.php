@props([
	'path',
	'name' => 'image',
	'value' => null,
	'label' => __('form.image'),
])

<div class="form-group text-center">
	<label for="file-browse">{{ $label }}</label>
	<input type="hidden" name="{{ $name }}" id="{{ $name }}" value="{{ old($name) }}" />
	<input type="file" name="file-browse-{{ $name }}" id="file-browse-{{ $name }}" class="sr-only file-browse" accept="image/png, image/jpeg" />
	@if (old($name)=='')
		<img src="{{ (($value)? $path .'/'. $value : asset('images/browse-image.jpg') ) }}" alt="" class="image-preview" id="image-preview-{{ $name }}" data-id="{{ $name }}" />
	@else
		<img src="{{ old($name, (($value)? $path .'/'. $value : asset('images/browse-image.jpg'))) }}" alt="" class="image-preview" id="image-preview-{{ $name }}" data-id="{{ $name }}" />
	@endif

	<div class="tw-mt-1 delete-image-container-{{ $name }}">
		@if (($value || old($name)) && (old($name)!='/images/browse-image.jpg'))
			<a href="javascript:void(0)" class="text-danger btn-delete-image">
				<small>{{ __('button.delete_image') }}</small>
			</a>
		@endif
	</div>
</div>

<x-modal-image-crop />