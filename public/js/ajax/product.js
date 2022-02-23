// start create new ajax product
$('#pro_manual_code').on('change', function(){
    if ($(this).prop('checked')) {
        $('#pro_code').prop('readonly', false).val('').focus();
    }else{
        var code = String($('#pro_code').data('code'));
        if (code!=undefined) {
            $('#pro_code').prop('readonly', true).val(code.padStart(6, '0'));
        }
    }
});
$(document).on('click', '.btn-create-product', function (e) {
    e.preventDefault();
    $('#create-product-modal').modal('show');
    $('#pro_label').focus();
});
function resetCreateFormProduct() {
    $('#create-product-modal .invalid-feedback').remove();
    $('#create-product-modal .is-invalid').removeClass('is-invalid');
    $('#pro_label').val('');
    $('#pro_name').val('');
    $('#pro_manual_code').prop('checked', false);
    $('#pro_category_id').val('').trigger('change');
    $('#pro_cost').val('');
    $('#pro_price').val('');
    $('#pro_uom').val('');
    $('#pro_description').val('');
    $('#pro_sale_by_unit').prop('checked', true);
    $('#pro_tracking_stock').prop('checked', true);
    $('#pro_popular').prop('checked', false);
    $('#pro_status_new').prop('checked', true);
    $('#pro_image').val('');
    $('#file-browse-pro_image').val('');
    $('#image-preview-pro_image').attr('src', "/images/browse-image.jpg");
    $('.delete-image-container-pro_image').html('');
}
$(document).on('click', '#btn-save-product', function () {
    var label = $('#pro_label').val(),
        name = $('#pro_name').val(),
        code = $('#pro_code').val(),
        manual_code = $('#pro_manual_code').val(),
        category_id = $('#pro_category_id').val(),
        cost = $('#pro_cost').val(),
        price = $('#pro_price').val(),
        uom = $('#pro_uom').val(),
        sale_by_unit = (($('#pro_sale_by_unit').prop('checked'))? 'on' : null ),
        tracking_stock = (($('#pro_tracking_stock').prop('checked'))? 'on' : null ),
        popular = (($('#pro_popular').prop('checked'))? 'on' : null ),
        status_new = (($('#pro_status_new').prop('checked'))? 'on' : null ),
        image = $('#pro_image').val(),
        description = $('#pro_description').val();
    if ( label != '' && name != '' && code != '' && category_id != '' && cost != '' && price != '' && uom != '' ) {
        pageLoading('show');
        $.ajax({
            url: "/stock_in/createProduct",
            type: 'post',
            data: {
                'label': label,
                'name': name,
                'code': code,
                'manual_code': manual_code,
                'category_id': category_id,
                'cost': cost,
                'price': price,
                'uom': uom,
                'sale_by_unit': sale_by_unit,
                'tracking_stock': tracking_stock,
                'popular': popular,
                'status_new': status_new,
                'image': image,
                'description': description,
            },
            success: function(rs){
                if(rs.success == true){
                    var newOption = new Option(rs.product.name, rs.product.id, true, true);
                    $('#product_id').append(newOption).trigger('change');
                    $('#product_id').select2('data')[0]['cost'] = rs.product.cost;
                    $('#product_id').append(newOption).trigger('change');
                    resetCreateFormProduct();
                    $('#pro_code').val(rs.code);
                    pageLoading('hide');
                    Swal.fire({
                        icon: 'success',
                        title: rs.message,
                        confirmButtonText: 'Confirm',
                        timer: 1500
                    })
                    .then((result) => {
                        $('#create-product-modal').modal('hide');
                    })
                }else{
                }
            },
            error: function (rs) {
                $('#create-product-modal .invalid-feedback').remove();
                $('#create-product-modal .is-invalid').removeClass('is-invalid');
                if (rs.status == 422) {
                    $.each(rs.responseJSON.errors, function (name, message) {
                        $('#pro_'+ name).addClass('is-invalid');
                        $('#pro_'+ name).parent().append(`<span class="invalid-feedback"><i class="bx bx-radio-circle"></i> ${ message }</span>`);;
                    });
                    pageLoading('hide');
                }
            }
        });
    }else{
        Swal.fire({
            icon: 'warning',
            title: 'Please input all require field.',
            confirmButtonText: 'Confirm',
        })
    }
});
// end create new ajax product