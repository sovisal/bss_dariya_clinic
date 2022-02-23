{{-- start modal import excel --}}
@props([
    'url',
])

<x-modal id="import-excel-modal">
    <x-slot name="header">
        {{ __('alert.modal.import') }}
    </x-slot>
    <x-slot name="footer">
        <x-form.button id="btn-import" :hideLabelOnXS="true" icon="bx bx-upload" label="{{ __('button.import') }}"></x-form.button>
    </x-slot>
    <form action="{{ $url }}" id="form-import-file" enctype="multipart/form-data" method="post">
        @csrf
        <x-form.input-file-custom
            name="input_file_excel"
            accept=".csv, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
            required
            label="{!! __('form.select_file') !!} ( .csv | .xls | .xlsx ) <small class='required'>*</small>"
        />
    </form>
</x-modal>
{{-- end modal import excel --}}