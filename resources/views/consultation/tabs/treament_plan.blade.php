<table class="table-form striped">
    <tr>
        <th colspan="2" class="tw-bg-gray-100 text-center">
            <i class="bx bx-file"></i> List treament plan
        </th>
    </tr>
    <tr>
        <td width="30%">
            <div class="d-flex justify-content-between">
                <b>Prescription</b>
                <x-form.button class="btn-treatment-toggle" data-type="prescription" color="secondary" icon="bx bx-plus" label=""/>
            </div>
        </td>
        <td>
            @php 
                $label = array_map(function ($val) {
                    return '<a href="' . route('prescription.show', $val['id']) . '">' . ($val['code'] ?: 'N/A') . '</a>';
                }, $list_prescription);
            @endphp
            {!! implode($label, ',  ') !!}
        </td>
    </tr>
    <tr>
        <td>
            <div class="d-flex justify-content-between">
                <b>Labor-Test</b>
                <x-form.button class="btn-treatment-toggle" data-type="labor-test" color="secondary" icon="bx bx-plus" label=""/>
            </div>
        </td>
        <td>
            @php 
                $label = array_map(function ($val) {
                    return '<a href="' . route('para_clinic.labor.show', $val['id']) . '">' . ($val['code'] ?: 'N/A') . '</a>';
                }, $list_labor);
            @endphp
            {!! implode($label, ',  ') !!}
        </td>
    </tr>
    <tr>
        <td>
            <div class="d-flex justify-content-between">
                <b>Xray</b>
                <x-form.button class="btn-treatment-toggle" data-type="xray" color="secondary" icon="bx bx-plus" label=""/>
            </div>
        </td>
        <td>
            @php 
                $label = array_map(function ($val) {
                    return '<a href="' . route('para_clinic.xray.show', $val['id']) . '">' . ($val['code'] ?: 'N/A') . '</a>';
                }, $list_xray);
            @endphp
            {!! implode($label, ',  ') !!}
        </td>
    </tr>
    <tr>
        <td>
            <div class="d-flex justify-content-between">
                <b>Echography</b>
                <x-form.button class="btn-treatment-toggle" data-type="echography" color="secondary" icon="bx bx-plus" label=""/>
            </div>
        </td>
        <td>
            @php 
                $label = array_map(function ($val) {
                    return '<a href="' . route('para_clinic.echography.show', $val['id']) . '">' . ($val['code'] ?: 'N/A') . '</a>';
                }, $list_echo);
            @endphp
            {!! implode($label, ',  ') !!}
        </td>
    </tr>
    <tr>
        <td>
            <div class="d-flex justify-content-between">
                <b>ECG</b>
                <x-form.button class="btn-treatment-toggle" data-type="ecg" color="secondary" icon="bx bx-plus" label=""/>
            </div>
        </td>
        <td>
            @php 
                $label = array_map(function ($val) {
                    return '<a href="' . route('para_clinic.ecg.show', $val['id']) . '">' . ($val['code'] ?: 'N/A') . '</a>';
                }, $list_ecg);
            @endphp
            {!! implode($label, ',  ') !!}
        </td>
    </tr>
</table>