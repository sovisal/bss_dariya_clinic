@props([
	'name' => 'Save'
])

<x-ul-unstyled class="mb-1">
	<x-li-inline>
		<x-form.radio name="save_opt" value="save_create" id="save_create" label="{!! __('form.save_create') !!}" :checked="(old('save_opt') && old('save_opt')=='save_create')? true : true" />
	</x-li-inline>
	<x-li-inline>
		<x-form.radio name="save_opt" value="save_edit" id="save_edit" label="{!! __('form.save_edit') !!}" :checked="(old('save_opt') && old('save_opt')=='save_edit')? true : false" />
	</x-li-inline>
	<x-li-inline>
		<x-form.radio name="save_opt" value="save_list" id="save_list" label="{!! __('form.save_list') !!}" :checked="(old('save_opt') && old('save_opt')=='save_list')? true : false" />
	</x-li-inline>
</x-ul-unstyled>

<x-form.button :hideLabelOnXS="true" type="submit" name="save" icon="bx bx-save" label="{!! $name !!}" />