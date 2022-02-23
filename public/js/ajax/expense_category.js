// start create new expense category by ajax
$(document).on('click', '.btn-create-expenseCategory', function(e){
    e.preventDefault();
    $('#create-expenseCategory-modal').modal('show');
    $('#exp_cat_name').focus();
});
function resetCreateFormExpenseCategory(){
    $('#create-expenseCategory-modal .invalid-feedback').remove();
    $('#create-expenseCategory-modal .is-invalid').removeClass('is-invalid');
    $('#exp_cat_name').val('');
    $('#exp_cat_label').val('');
    $('#note').val('');
}
$(document).on('click', '#btn-save-expenseCategory', function(){
    var name = $('#exp_cat_name').val(),
        label = $('#exp_cat_label').val(),
        note = $('#note').val();
    if (name != '') {
        pageLoading('show');
        $.ajax({
            url: "/expense/createExpenseCategory",
            type: 'post',
            data: {
                'name' : name,
                'label' : label,
                'note' : note,
            },
            success: function(rs) {
                if (rs.success == true) {
                    resetCreateFormExpenseCategory();
                    var newOption = new Option(rs.expense_category.name, rs.expense_category.id, true, true);
                    $('#expense_category_id').append(newOption).trigger('change');
                    pageLoading('hide');
                    Swal.fire({
                        icon: 'success',
                        title: rs.message,
                        confirmButtonText: 'Confirm',
                        timer: 1500
                    })
                    .then ((result) => {
                        resetCreateFormExpenseCategory();
                        $('#create-expenseCategory-modal').modal('hide');
                    })
                }
            },
            error: function (rs){
                $('#create-expenseCategory-modal .invalid-feedback').remove();
                $('#create-expenseCategory-modal .is-invalid').removeClass('is-invalid');
                if (rs.status == 422) {
                    $.each(rs.responseJSON.errors, function (name, message){
                        $('#exp_cat_'+ name).addClass('is-invalid');
                        $('#exp_cat_'+ name).parent().append(`<span class="invalid-feedback"><i class="bx bx-radio-circle"></i> ${message}</span>`);
                    });
                    pageLoading('hide');
                }
            }
        });
    }else{
        Swal.fire({
            icon: 'warning',
            title: 'Please input all required filed.',
            confirmButtonText: 'Confirm',
        })
    }
});
// end create new expense category by ajax