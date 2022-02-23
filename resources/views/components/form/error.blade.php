@props(['name'])

@error($name)
	<span class="invalid-feedback"><i class="bx bx-radio-circle"></i> {!! $message !!}</span>
@enderror