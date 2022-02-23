// Sidebar Shwo/Hide
// $('#sidebar-main-menu').addClass('sr-only');
// $(document).on('click', '#btn-main-menu', function () {
// 	if ( $('#sidebar-main-menu').hasClass('sr-only') ) {
// 		$('#sidebar-main-menu').removeClass('sr-only');
// 		$(this).addClass('show');
// 	}else{
// 		$('#sidebar-main-menu').addClass('sr-only');
// 		$(this).removeClass('show');
// 	}
// });


// View Cancel
$(document).on('click', '#btn-cancelled-detail', function () {
	$('#cancelled-detail-modal').modal('show');
	$('#cancelled-detail-modal .cancelled_by').html($(this).data('cancelled_by'));
	$('#cancelled-detail-modal .cancelled_at').html($(this).data('cancelled_at'));
	$('#cancelled-detail-modal .cancelled_note').html($(this).data('note'));
});
$('#cancelled-detail-modal').on('show.bs.modal', function () {
	$('#sale-detail-modal').modal('hide');
});
$('#cancelled-detail-modal').on('hidden.bs.modal', function () {
	$('#sale-detail-modal').modal('show');
});