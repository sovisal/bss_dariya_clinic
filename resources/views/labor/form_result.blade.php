<table class="table-form striped">
    <tr>
        <th colspan="4" class="text-left tw-bg-gray-100">Result</th>
    </tr>
</table>
<table class="table-form striped table table-border">
    <tr>
        <th class="text-center">N<sup>o</sup<</th>
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
            <td>{{ $item->category()->name_en }}</td>
            <td>{{ $item->name_en }}</td>
            <td>
                <input type="hidden" name="test_id[]" value="{{ $row->id }}"/>
                <x-bss-form.input type="number" name='test_value[]' value="{{ $row->value ?: 0 }}" class="text-center"/>
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