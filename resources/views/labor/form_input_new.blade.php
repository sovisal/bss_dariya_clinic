<table class="table-form table-padding-sm striped">
    <thead>
        <tr>
            <th colspan="10" class="tw-bg-gray-100">
                <div class="d-flex justify-content-between align-items-center">
                    Result
                    <div style="min-width: 400px">
                        <x-bss-form.select name="type" required id="btnShowRow">
                            <option value="">Please choose</option>
                            @foreach ($labor_type as $main_data)
                                @foreach (array_merge([$main_data], $main_data->child) as $index => $data)
                                    <option value="{{ $data->id }}" data-price="{{ $data->price }}">{{ $data->name_en }}</option>
                                @endforeach
                            @endforeach
                        </x-bss-form.select>
                    </div>
                </div>
            </th>
        </tr>
    </thead>
</table>
<table class="table-form table-padding-sm striped">
    @foreach ($labor_type as $main_data)
        @foreach (array_merge([$main_data], $main_data->child) as $data)
            <tr class="labor_row labor_row_{{ $data->id }} labor_rows_of_{{ $main_data->id }}">
                <td>
                    <div style="position: relative; padding: 5px;">
                        <u><b>{{ $data->name_en }}</b></u>
                        <div style="width: 300px; position: absolute; right: 10px; top: 10px; text-align: right;">                        
                            <label style="cursor: pointer;">
                                <input type="checkbox" class="btnCheckRow">
                                <u><b>All</b></u>
                            </label>
                            &nbsp;&nbsp; &nbsp; &nbsp; 
                            <label style="cursor: pointer;" class="btnHideRow">
                                <u class="text-danger"><b>Remove</b></u>
                            </label>
                        </div>
                        <div class="row">
                            @foreach ($data->item as $item)
                                <div class="col-3">
                                    <label><input type="checkbox" name="labor_item_id[]" value="{{ $item->id }}"> {{ render_synonyms_name($item->name_en, $item->name_kh) }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    @endforeach
</table>