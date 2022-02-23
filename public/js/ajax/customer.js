// start create new customer by ajax
$('#modal-crop-image').on('shown.bs.modal', function () {
	$('#create-customer-modal').modal('hide');
});
$('#modal-crop-image').on('hidden.bs.modal', function () {
	$('#create-customer-modal').modal('show');
});
$(document).on('click', '.btn-create-customer', function(e){
	e.preventDefault();
	$('#create-customer-modal').modal('show');
	$('#cus_name').focus();
});
function resetCreateFormcustomer() {
	$('#create-customer-modal .invalid-feedback').remove();
	$('#create-customer-modal .is-invalid').removeClass('is-invalid');
	$('#cus_name').val('');
	$('#cus_vattin').val('');
	$('#cus_phone').val('');
	$('#cus_status').prop('checked', true);
	$('#cus_address').val('');
	$('#cus_image').val('');
	$('#cus_description').val('');
	$('#file-browse').val('');
	$('#image-preview-cus_image').attr('src', "/images/browse-image.jpg");
	$('.delete-image-container-cus_image').html('');
}
$(document).on('click', '#btn-save-customer', function() {
	var name = $('#cus_name').val(),
		vattin = $('#cus_vattin').val(),
		phone = $('#cus_phone').val(),
		status = (($('#cus_status').prop('checked'))? 'on' : null ),
		address = $('#cus_address').val(),
		image = $('#cus_image').val(),
		description = $('#cus_description').val();
	if ( name != '' ) {
		pageLoading('show');
		$.ajax({
			url: "/customer/createCustomer",
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
					resetCreateFormcustomer();
					var newOption = new Option(rs.customer.name, rs.customer.id, true, true);
					$('#customer_id').append(newOption).trigger('change');
					pageLoading('hide');
					Swal.fire({
						icon: 'success',
						title: rs.message,
						confirmButtonText: 'Confirm',
						timer: 1500
					})
					.then((result) => {
						$('#create-customer-modal').modal('hide');
					})
				}
			},
			error: function (rs) {
				$('#create-customer-modal .invalid-feedback').remove();
				$('#create-customer-modal .is-invalid').removeClass('is-invalid');
				if (rs.status == 422){
					$.each(rs.responseJSON.errors, function (name, message) {
						$('#cus_'+ name).addClass('is-invalid');
						$('#cus_'+ name).parent().append(`<span class="invalid-feedback"><i class="bx bx-radio-circle"></i> ${ message } </span>`);;
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
// end create new customer by ajax