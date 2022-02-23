// create income category  by ajax 

$(document).on('click', '.btn-create-incomeCategory', function (e) {
        e.preventDefault();
        $('#create-incomeCategory-modal').modal('show');
        $('#name').focus();
    }

);

function resetCreateForm() {
    $('#create-incomeCategory-modal .invalid-feedback').remove();
    $('#create-incomeCategory-modal .is-invalid').removeClass('is-invalid');
    $('#name').val('');
    $('#label').val('');
    $('#note').val('');
}

$(document).on('click', '#btn-save-incomeCategory', function () {
        var name = $('#name').val(),
            label = $('#label').val(),
            note = $('#note').val();

        if (name != '') {
            pageLoading('show');

            $.ajax({

                    url: "/income_category/createIncomeCategory",
                    type: 'post',
                    data: {
                        'name': name,
                        'label': label,
                        'note': note,
                    }

                    ,
                    success: function (rs) {
                            if (rs.success == true) {
                                var newOption = new Option(rs.income_category.name, rs.income_category.id, true, true);
                                $('#income_category_id').append(newOption).trigger('change');
                                resetCreateForm();
                                pageLoading('hide');
                                Swal.fire({
                                        icon: 'success',
                                        title: rs.message,
                                        confirmButtonText: 'Confirm',
                                        timer: 1500

                                    })
                                    .then((result) => {
                                        $('#create-incomeCategory-modal').modal('hide');
                                    })
                            } else {

                            }
                        }

                        ,
                    error: function (rs) {
                        $('#create-incomeCategory-modal .invalid-feedback').remove();
                        $('#create-incomeCategory-modal .is-invalid').removeClass('is-invalid');

                        if (rs.status == 422) {
                            $.each(rs.responseJSON.errors, function (name, message) {
                                    $('#' + name).addClass('is-invalid');
                                    $('#' + name).parent().append(`<span class="invalid-feedback"><i class="bx bx-radio-circle"></i> ${ message } </span>`);;
                                }

                            );
                            pageLoading('hide');
                        }
                    }
                }

            );
        } else {
            Swal.fire({
                    icon: 'warning',
                    title: 'Please input all require field.',
                    confirmButtonText: 'Confirm',
                }

            )
        }

    }

);
