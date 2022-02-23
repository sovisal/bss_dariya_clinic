// start import excel
$('#btn-import').click(function(){
    var file = $('#input_file_excel').get(0).files.length;
    if (file === 1) {
        $('#form-import-file').submit();
    }else{
        Swal.fire({
            icon: 'warning',
            title: 'Please select file first!',
            confirmButtonText: 'Confirm',
        })
    }
});
// end import excel