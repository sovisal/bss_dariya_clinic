<form action="{{ route('para_clinic.labor.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <input type="hidden" name="is_treament_plan" value="1">
    <input type="hidden" name="patient_id" value="{{ $consultation->patient_id }}">
    <input type="hidden" name="consultation_id" value="{{ $consultation->id }}">
    <input type="hidden" name="gender" value="{{ $consultation->patient->gender }}">
    <input type="hidden" name="age" value="{{ $consultation->patient->age }}">
    <x-modal id="treatment_modal_labor" dialogClass="modal-full" data-backdrop="static" data-keyboard="false" header="Create new Test">
        
    <div class="labor-service-container mt-1"></div>
        <table class="table-form table-padding-sm striped">
            <tr>
                <td width="20%" class="text-right"><small class="required">*</small> Requested Date</td>
                <td width="30%">
                    <x-bss-form.input name="requested_at" class="date-time-picker" hasIcon="right" icon="bx bx-calendar" value="{{ date('Y-m-d H:i:s') }}" required/>
                </td>
                <td width="20%" class="text-right"><small class="required">*</small> Choose Category</td>
                <td width="30%">
                    <div class="d-flex">
                        <x-bss-form.select name="type" required id="btnShowRow">
                            <option value="">Please choose</option>
                            @foreach ($labor_type as $main_data)
                                @foreach (array_merge([$main_data], $main_data->child) as $index => $data)
                                    <option value="{{ $data->id }}" data-price="{{ $data->price }}">{{ $data->name_en }}</option>
                                @endforeach
                            @endforeach
                        </x-bss-form.select>
                    </div>
                </td>
            </tr>
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
        <x-slot name="footer">
            <x-form.button color="danger" data-dismiss="modal" icon="bx bx-x" label="{{ __('button.cancel') }}" />
            <x-form.button type="submit" icon="bx bx-save" label="{{ __('button.save') }}" />
        </x-slot>
    </x-modal>
</form>