<table class="table-form striped">
	<tr>
		<th colspan="4" class="text-left tw-bg-gray-100">Result</th>
	</tr>
</table>
<table class="table-form striped table table-border">
	<tr>
		<th class="text-center">N&deg;</th>
		<th>Category</th>
		<th>Tests</th>
		<th class="text-center" width="150px">Result</th>
		<th class="text-right">Min</th>
		<th>Max</th>
		<th>Unit</th>
		<th class="text-center">Action</th>
	</tr>
	@foreach ($labor_detail as $row)
		@php
			static $i = 1;
			$item = $row->item();
		@endphp
		<tr>
			<td class="text-center">{{ $i++ }}</td>
			<td>{{ render_synonyms_name($item->category()->name_en, $item->category()->name_kh) }}</td>
			<td>{{ render_synonyms_name($item->name_en, $item->name_kh) }}</td>
			<td>
				<input type="hidden" name="test_id[]" value="{{ $row->id }}"/>
				@if(str_contains($item->other, 'VALUE_POSITIVE_NEGATIVE'))
					<x-bss-form.select name="test_value[]" data-no_search="true">
						@foreach (['POSITIVE' => 'POSITIVE', 'NEGATIVE' => 'NEGATIVE'] as $id => $data)
							<option value="{{ $id }}" {{ $id == $row->value ? 'selected' : '' }}>{{ $data }}</option>
						@endforeach
					</x-bss-form.select>
				@elseif(str_contains($item->other, 'VALUE_160_320'))
					<x-bss-form.select name="test_value[]" data-no_search="true">
						<option value="1/160" {{ '1/160' == $row->value ? 'selected' : '' }}>1/160</option>
						<option value="1/320" {{ '1/320' == $row->value ? 'selected' : '' }}>1/320</option>
					</x-bss-form.select>
				@else
					<x-bss-form.input type="number" name='test_value[]' value="{{ $row->value ?: 0 }}" class="text-center"/>
				@endif
			</td>
			<td class="text-right">{{ $item->min_range }}</td>
			<td>{{ $item->max_range }}</td>
			<td>{!! apply_markdown_character($item->unit) !!}</td>
			<td class="text-center">
				<x-form.button color="danger" class="btn-sm" icon="bx bx-trash" onclick="$(this).parents('tr').remove();"/>
			</td>
		</tr>
	@endforeach
	<tr></tr>
</table>