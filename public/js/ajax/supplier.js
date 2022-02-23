
// start create new supplier by ajax 
$(document).on('click', '.btn-create-supplier', function(e){
    e.preventDefault();
    $('#create-supplier-modal').modal('show');
    $('#sup_name').focus();
});
function resetCreateFormSupplier() {
    $('#create-supplier-modal .invalid-feedback').remove();
    $('#create-supplier-modal .is-invalid').removeClass('is-invalid');
    $('#sup_name').val('');
    $('#sup_vattin').val('');
    $('#sup_phone').val('');
    $('#sup_status').prop('checked', true);
    $('#sup_address').val('');
    $('#sup_image').val('');
    $('#sup_description').val('');
    $('#file-browse').val('');
    $('#image-preview-sup_image').attr('src', "/images/browse-image.jpg");
    $('.delete-image-container-sup_image').html('');
}
$(document).on('click', '#btn-save-supplier', function() {
    var name = $('#sup_name').val(),
        vattin = $('#sup_vattin').val(),
        phone = $('#sup_phone').val(),
        status = (($('#sup_status').prop('checked'))? 'on' : null ),
        address = $('#sup_address').val(),
        image = $('#sup_image').val(),
        description = $('#sup_description').val();
    if ( name != '' ) {
        pageLoading('show');
        $.ajax({
            url: "/supplier/createSupplier",
            type: 'post',
            data: {
                'name': name,
                'vattin': vattin,
                'phone': phone,
                'status': status,
                'address': address,
                'image': image,
                'description': description,
            },
            success: function(rs) {
                if(rs.success == true){
                    resetCreateFormSupplier();
                    var newOption = new Option(rs.supplier.name, rs.supplier.id, true, true);
                    $('#supplier_id').append(newOption).trigger('change');
                    pageLoading('hide');
                    Swal.fire({
                        icon: 'success',
                        title: rs.message,
                        confirmButtonText: 'Confirm',
                        timer: 1500
                    })
                    .then((result) => {
                        $('#create-supplier-modal').modal('hide');
                    })
                }
            },
            error: function (rs) {
                $('#create-supplier-modal .invalid-feedback').remove();
                $('#create-supplier-modal .is-invalid').removeClass('is-invalid');
                if (rs.status == 422){
                    $.each(rs.responseJSON.errors, function (name, message) {
                        $('#sup_'+ name).addClass('is-invalid');
                        $('#sup_'+ name).parent().append(`<span class="invalid-feedback"><i class="bx bx-radio-circle"></i> ${ message } </span>`);;
                    });
                    pageLoading('hide');
                }
            }
        });
    }else {
        Swal.fire({
            icon: 'warning',
            title: 'Please input all require field.',
            confirmButtonText: 'Confirm',
        })
    }
});
// end create new supplier by ajax
// end ajax product and supplier