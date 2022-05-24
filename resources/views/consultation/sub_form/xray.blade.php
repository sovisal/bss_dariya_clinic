<form action="{{ route('para_clinic.xray.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <input type="hidden" name="is_treament_plan" value="1">
    <input type="hidden" name="patient_id" value="{{ $consultation->patient_id }}">
    <input type="hidden" name="consultation_id" value="{{ $consultation->id }}">
    <x-modal id="treatment_modal_xray" dialogClass="modal-full" data-backdrop="static" data-keyboard="false" header="Create new Xray">
        <table class="table-form table-padding-sm striped">
            <tr>
                <td width="20%" class="text-right"><small class="required">*</small> Requested Date</td>
                <td>
                    <x-bss-form.input name="requested_at" class="date-time-picker" hasIcon="right" icon="bx bx-calendar" value="{{ date('Y-m-d H:i:s') }}" required/>
                </td>
                <td width="20%" class="text-right"><small class="required">*</small> Choose Type</td>
                <td>
                    <div class="d-flex">
                        <x-bss-form.select name="type" required id="xray_type">
                            <!-- <option>Please choose</option> -->
                            @foreach ($xray_type as $data)
                                <option value="{{ $data->id }}" data-price="{{ $data->price }}">{{ $data->name_en }}</option>
                            @endforeach
                        </x-bss-form.select>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="text-right"><small class="required">*</small> Analysed by</td>
                <td>
                    <x-bss-form.select name="doctor_id" required id="xray_doctor_id">
                        <option value="">Please choose</option>
                        @foreach ($doctors as $data)
                            <option value="{{ $data->id }}">{{ $data->name_en }}</option>
                        @endforeach
                    </x-bss-form.select>
                </td>
            </tr>
        </table>
        <x-slot name="footer">
            <x-form.button color="danger" data-dismiss="modal" icon="bx bx-x" label="{{ __('button.cancel') }}" />
            <x-form.button type="submit" icon="bx bx-save" label="{{ __('button.save') }}" />
        </x-slot>
    </x-modal>
</form>