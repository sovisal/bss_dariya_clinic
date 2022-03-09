pace.start();

// Start setup CSRF for ajax
$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
// Start setup CSRF for ajax

// document.addEventListener('contextmenu', event => event.preventDefault());

const swalWithBootstrapButtons = Swal.mixin({
	customClass: {
		confirmButton: "btn btn-primary tw-ml-1",
		cancelButton: "btn btn-danger tw-mr-1",
	},
	buttonsStyling: false,
});


// Start Input Number only
function isNum(value) {
	return /^-?\d*[.]?\d*$/.test(value);
}
function isInt(value) {
	return /^\d*$/.test(value);
}
function isNumber(evt) {
	evt = (evt) ? evt : window.event;
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46) {
		return false;
	}
	return true;
}
function isInteger(evt) {
	evt = (evt) ? evt : window.event;
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		return false;
	}
	return true;
}

$(document).on('focusout keyup', 'input[type="number"]', function () {
	var min = $(this).attr('min'),
		max = $(this).attr('max'),
		value = $(this).val();
	if (min != undefined && (parseInt(value) < parseInt(min))) {
		$(this).val(min);
	}
	if (max != undefined && (parseInt(value) > parseInt(max))) {
		$(this).val(max);
	}
 });
$(document).on('keyup keypress', '.is_number', function (evt) {
	if (isNum(this.value)) {
		this.oldValue = this.value;
		this.oldSelectionStart = this.selectionStart;
		this.oldSelectionEnd = this.selectionEnd;
	} else if (this.hasOwnProperty("oldValue")) {
		this.value = this.oldValue;
		this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
	} else {
		this.value = "";
	}
	return isNumber(evt);
});
$(document).on('keyup keypress', '.is_integer', function (evt) {
	if (isInt(this.value)) {
		this.oldValue = this.value;
		this.oldSelectionStart = this.selectionStart;
		this.oldSelectionEnd = this.selectionEnd;
	} else if (this.hasOwnProperty("oldValue")) {
		this.value = this.oldValue;
		this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
	} else {
		this.value = "";
	}
	return isInteger(evt);
});
// End Input Number only


// start export filter to excel
$(document).on('click', '.btn-export', function() {
	var url = $(this).data('url');
	if (url!=undefined) {
		$('#form-filter').attr('action', url).submit();
		$('button').prop('disabled', false);
		setTimeout(() => {
			$('.btn-search-filter').click();
		}, 1000);
	}
});
$(document).on('click', '.btn-search-filter', function(e) {
	var url = $(this).data('url');
	if (url!=undefined) {
		e.preventDefault();
		$('#form-filter').attr('action', url).submit();
	}
});
// end export filter to excel

function pageLoading(value = 'show') {
	if (value == 'show') {
		$('.custom-loading-screen').removeClass('sr-only');
	} else {
		$('.custom-loading-screen').addClass('sr-only');
	}
}
function printPopup(url) {
	var printWindow = window.open(url, 'To Print', "width="+ screen.availWidth +",height="+ screen.availHeight +",_blank");
	var printAndClose = function () {
		if (printWindow.document.readyState == 'complete') {
			clearInterval(sched);
			printWindow.print();
			printWindow.close();
		}
	}
	var sched = setInterval(printAndClose, 1000);
};

// Start Initial Toastr
function flashMsg(type='success', title, text) {
	var toastrConfig = {
						showMethod: "slideDown",
						hideMethod: "slideUp",
						showDuration: 100,
						hideDuration: 100,
						timeOut: 3e3,
						closeButton: !0,
						tapToDismiss: 1
					};
	if (type=='success') {
		toastr.success(
			text,
			title,
			toastrConfig
		);
	}else if(type=='warning'){
		toastr.warning(
			text,
			title,
			toastrConfig
		);
	}else if(type=='error'){
		toastr.error(
			text,
			title,
			toastrConfig
		);
	}
}
// End Initial Toastr


$(document).ready(function(){
	// Start Initial Daterangepicker
		$(".daterange-picker").daterangepicker({
			ranges: {
				Today: [moment(), moment()],
				Yesterday: [moment().subtract(1, "days"), moment().subtract(1, "days")],
				"Last 7 Days": [moment().subtract(6, "days"), moment()],
				"Last 30 Days": [moment().subtract(29, "days"), moment()],
				"This Month": [moment().startOf("month"), moment().endOf("month")],
				"Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")],
				"Life Time": [moment('2020-01-01'), moment()],
			},
			locale: {
				cancelLabel: 'Clear',
			},
			cancelClass:"btn-danger",
			autoUpdateInput: false,
			alwaysShowCalendars: true,
		}).on('apply.daterangepicker', function(ev, picker) {
			$(this).val(picker.startDate.format('DD/MMM/YYYY') + ' - ' + picker.endDate.format('DD/MMM/YYYY'));
			$('#'+ picker.element.attr('id') +'_drp_start').val(picker.startDate.format('YYYY-MM-DD'));
			$('#'+ picker.element.attr('id') +'_drp_end').val(picker.endDate.format('YYYY-MM-DD'));
		}).on('cancel.daterangepicker', function(event, picker) {
			$(this).val('');
			$('#'+ picker.element.attr('id') +'_drp_start').val('');
			$('#'+ picker.element.attr('id') +'_drp_end').val('');
		});
		$(".daterange-picker").each(function () {
			var drp_start = $('#'+ $(this).attr('id') +'_drp_start').val();
			var drp_end = $('#'+ $(this).attr('id') +'_drp_end').val();
			if (drp_start != '' && drp_end != '') {
				$(this).data('daterangepicker').setStartDate(moment(drp_start));
				$(this).data('daterangepicker').setEndDate(moment(drp_end));
			}
		});
		
		$(".datetimerange-picker").daterangepicker({
			ranges: {
				Today: [moment(), moment()],
				Yesterday: [moment().subtract(1, "days"), moment().subtract(1, "days")],
				"Last 7 Days": [moment().subtract(6, "days"), moment()],
				"Last 30 Days": [moment().subtract(29, "days"), moment()],
				"This Month": [moment().startOf("month"), moment().endOf("month")],
				"Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")],
				"Life Time": [moment('2020-01-01 00:00:00'), moment()],
			},
			locale: {
				cancelLabel: 'Clear',
			},
			cancelClass:"btn-danger",
			autoUpdateInput: false,
			alwaysShowCalendars: true,
			timePicker: true,
			timePicker24Hour: true,
			// timePickerIncrement: 5,
		}).on('apply.daterangepicker', function(event, picker) {
			$(this).val(picker.startDate.format('DD/MMM/YYYY HH:mm:ss') + ' - ' + picker.endDate.format('DD/MMM/YYYY HH:mm:ss'));
			$('#'+ picker.element.attr('id') +'_drp_start').val(picker.startDate.format('YYYY-MM-DD HH:mm:ss'));
			$('#'+ picker.element.attr('id') +'_drp_end').val(picker.endDate.format('YYYY-MM-DD HH:mm:ss'));
		}).on('cancel.daterangepicker', function(event, picker) {
			$(this).val('');
			$('#'+ picker.element.attr('id') +'_drp_start').val('');
			$('#'+ picker.element.attr('id') +'_drp_end').val('');
		});
		$(".datetimerange-picker").each(function () {
			var drp_start = $('#'+ $(this).attr('id') +'_drp_start').val();
			var drp_end = $('#'+ $(this).attr('id') +'_drp_end').val();
			if (drp_start != '' && drp_end != '') {
				$(this).data('daterangepicker').setStartDate(moment(drp_start));
				$(this).data('daterangepicker').setEndDate(moment(drp_end));
			}
		});
	// End Initial Daterangepicker

	// Start Initial Datatables
		$("#datatables").DataTable({
			"columnDefs": [{
				"targets": 'no-sort',
				"orderable": false,
			}]
		});
	// End Initial Datatables

	// Start Initial Select 2
		$(".custom-select2").each((_i, e) => {
			var $e = $(e);
			$e.select2({
				dropdownAutoWidth: !0,
				minimumResultsForSearch: (($e.data('no_search')!=undefined && $e.data('no_search')==true)? (1/0) : ''),
				width: "100%",
				dropdownParent: $e.parent()
			});
		})
		$(document).on('select2:open', () => {
			document.querySelector('.select2-search__field').focus();
		});

		// Select2 Ajax
		$('.select2ajax').each((_i, e) => {
			var $e = $(e);
			var url = $e.data('url');
			var placeholder = $e.data('placeholder');
			var id = $e.attr('id');
			if ($('#hidden_'+ id).val()=='null') {
				$e.val('').trigger('change');
			}
			if ((url!='' && url!=undefined) && (placeholder!='' || placeholder!=undefined)) {
				$e.select2({
					width: "100%",
					dropdownAutoWidth: !0,
					dropdownParent: $e.parent(),
					placeholder: placeholder,
					allowClear: ((placeholder)? true : false),
					delay: 500,
					ajax: { 
						url: url,
						type: "post",
						dataType: 'json',
						delay: 250,
						data: function (params) {
							return {
								search: params.term
							};
						},
						processResults: function (data) {
							return {
								results: $.map(data, function (item) {
									if (Object.keys(data).length > 0) {
										var keys = Object.keys(data[0]);
										var rs_data = {};
										keys.forEach(function(value, index) {
											if (index==0) {
												rs_data['id'] = item[value];
											}else if(index==1){
												rs_data['text'] = item[value];
											}else{
												rs_data[value] = item[value];
											}
										});
										return rs_data;
									}
								})
							};
						},
						cache: true
					}
				});
			}
		});
		$(document).on('change', '.select2ajax', function () {
			var selector = $(this).attr('id');
			$('#hidden_'+ selector).val((($(this).find("option:selected").text()=='')? 'null' : $(this).find("option:selected").text()));
		});
		// select 2 Ajax
	// End Initial Select 2

	// Start Initial Text Editor Ckeditor
		$('.my-editor').each(function (e) {
			var height = $(this).data('height');
			CKEDITOR.replace(this.id, {
				height: ((height!='' || height!=undefined)? height : '250'),
				skin: 'office2013',
				font_names: 'Calibrib Bold; Calibri Italic; Calibri; Roboto Regular; Roboto Bold; Quicksand; Quicksand Medium; Quicksand Bold; Khmer OS Battambang; Khmer OS Muol Light; Khmer OS Content;',
				filebrowserImageBrowseUrl: '/file-manager/ckeditor',
				toolbar: [
					{ name: 'document', items: [ 'Source', '-', 'Save', 'NewPage', 'ExportPdf', 'Preview', 'Print', '-', 'Templates' ] },
					{ name: 'clipboard', items: [ 'Undo', 'Redo', '-', 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', ] },
					{ name: 'editing', items: [ 'Find', 'Replace', 'SelectAll', '-', 'Blockquote', 'CreateDiv' ] },
					{ name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
					{ name: 'tools', items: [ 'ShowBlocks', 'Maximize' ] },
					'/',
					{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
					{ name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
					{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
					{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
				]
			}); 
		});
	// End Initial Text Editor Ckeditor

	// Start Initial Datetimepicker
		var icons = {
						time: "bx bx-time",
						date: "bx bx-calendar",
						up: 'bx bx-chevron-up',
						down: 'bx bx-chevron-down',
						previous: 'bx bx-chevron-left',
						next: 'bx bx-chevron-right',
						today: 'bx bx-screenshot',
						clear: 'bx bx-trash',
						close: 'bx bx-x'
					};
		$('.year-picker').datetimepicker({
			icons: icons,
			format: "YYYY",
		});
		$('.month-picker').datetimepicker({
			icons: icons,
			format: "YYYY-MM",
		});
		$('.date-picker').datetimepicker({
			icons: icons,
			format: "YYYY-MM-DD",
			showTodayButton: true,
		});
		$('.date-time-picker').datetimepicker({
			icons: icons,
			format: "YYYY-MM-DD HH:mm:ss",
			showTodayButton: true,
		});
		$('.date-time-picker-a').datetimepicker({
			icons: icons,
			format: "YYYY-MM-DD hh:mm a",
			showTodayButton: true,
		});
		$('.time-picker').datetimepicker({
			icons: icons,
			format: "HH:mm:ss",
		});
		$('.time-picker-a').datetimepicker({
			icons: icons,
			format: "hh:mm:ss a",
		});
	// End Initial Datetimepicker

	// Start use class input-focus-select to select when click in textbox
		$(document).on('focus', '.input-focus-select', function () {
			$(this).select();
		});
	// End use class input-focus-select to select when click in textbox

	// Start Protect user from spamming submit button 
		$('form').submit(function(){
			$(this).find(':input[type=submit]').prop('disabled', true);
			$(this).find('button[type="submit"]').prop('disabled', true);
		});
	// End Protect user from spamming submit button 

	// Start Checking user and Password and Delete Data
		$(document).on('click', '.confirmDelete', function () {
			$('#submitConfirmDelete').val( $(this).data('id') );
			$('#modal_confirm_delete').modal();
		});
		$('#modal_confirm_delete').on('shown.bs.modal', function () {
			$('#password').focus();
		})
		$(document).on('keypress', '#password', function (e) {
			if ( $(this).data('deleteonenter') == true && e.which == 13) {
				var password = $('#password').val(), id = $('#submitConfirmDelete').val();
				ajaxConfirmPassword(id, password);
			}
		});
		$(document).on('click', '#submitConfirmDelete', function (e) {
			var password = $('#password').val(), id = $('#submitConfirmDelete').val();
			ajaxConfirmPassword(id, password);
		});
		function ajaxConfirmPassword(id, password) {
			if ( password !='' ) {
				pageLoading('show');
				$.ajax({
					url: "/ajaxConfirm",
					type: 'post',
					data: {
						id: id,
						password: password
					},
					success: function(rs){
						if(rs.success == true){
							document.getElementById("form-delete-"+ id).submit();
							setTimeout(() => {
								pageLoading('hide');
							}, 2000);
						}else{
							pageLoading('hide');
							Swal.fire({
								icon: 'warning',
								title: rs.error,
								confirmButtonText: 'Confirm',
								timer: 2500
							})
							.then((rs) => {
								$('#modal_confirm_delete').modal();
							});
						}
					},
					error: function (rs) {
						pageLoading('hide');
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: 'Something went wrong!',
							confirmButtonText: 'Confirm',
							timer: 1500
						});
					}
				});
			}else{
				Swal.fire({
					icon: 'warning',
					title: 'Please input password.',
					confirmButtonText: 'Confirm',
					timer: 1500
				})
				.then((result) => {
					$('#modal_confirm_delete').modal();
				})
			}
		}
	// End Checking user and Password and Delete Data

	// Start Croppie Image Cropping
		$croppie_image = $('#image-cropping').croppie({
			enableExif: true,
			viewport: {
				width: 200,
				height: 200,
				type:'square'
			},
			boundary:{
				width: 200,
				height: 200
			}
		});
		var croppie_target_id;
		var image_url;
		$(document).on('click', '.image-preview', function () {
			croppie_target_id = $(this).data('id');
			if (croppie_target_id!=undefined && croppie_target_id!='') {
				if (document.getElementById("file-browse-"+ croppie_target_id).files.length != 0) {
					$('#file-browse-'+ croppie_target_id).val('');
				}
				$('#file-browse-'+ croppie_target_id).attr('data-id', croppie_target_id);
				$('#file-browse-'+ croppie_target_id).trigger('click');
			}
		});
		$('.file-browse').on('change', function(){
			if (croppie_target_id!=undefined && croppie_target_id!='') {
				if (document.getElementById("file-browse-"+ croppie_target_id).files.length != 0 && (document.getElementById("file-browse-"+ croppie_target_id).files[0].type == 'image/png' || document.getElementById("file-browse-"+ croppie_target_id).files[0].type == 'image/jpeg')) {
					var reader = new FileReader();
					reader.readAsDataURL(this.files[0]);
					reader.onload = function (event) {
						image_url = event.target.result;
					}
					$('#modal-crop-image').modal('show');
					$('#modal-crop-image').css({'visibility': 'hidden'});
				}else{
					flashMsg('error', 'Error!', 'Please check your file type again!');
				}
			}
		});
		$('#modal-crop-image').on('shown.bs.modal', function () {
			setTimeout(() => {
				$croppie_image.croppie('bind', {
					url: image_url
				}).then(function(){
					$('#modal-crop-image').css({'visibility': 'visible'});
				});
			}, 100);
		})
		$('#btn-crop-image').on('click', function(){
			$croppie_image.croppie('result', {
				circle: false,
				type: 'canvas',
				size: 'viewport'
			}).then(function(response){
				$('#'+ croppie_target_id).val(response);
				$('#image-preview-'+ croppie_target_id).attr('src', response);
				$('#modal-crop-image').modal('hide');
				$('.delete-image-container-'+ croppie_target_id).html(`
					<a href="javascript:void(0)" class="text-danger btn-delete-image" id="btn-delete-image-"${ croppie_target_id }>
						<small>Delete Image</small>
					</a>
				`);
			});
		});
		// Delete Image from record
		$(document).on('click', '.btn-delete-image', function(){
			swalWithBootstrapButtons.fire({
				title: "Confirm:",
				text: "Do you really want to remove this image?",
				icon: 'question',
				showCancelButton: true,
				confirmButtonText: "Yes",
				cancelButtonText: "No",
				reverseButtons: true
			}).then((result) => {
				if (result.isConfirmed) {
					if (croppie_target_id!=undefined && croppie_target_id!='') {
						$('#'+ croppie_target_id).val('/images/browse-image.jpg');
						$('#image-preview-'+ croppie_target_id).attr('src', '/images/browse-image.jpg');
						$(this).addClass('sr-only');
					}
				}
			})
		});
	// End Croppie Image Cropping

	// Start Image Zoom
		$(document).on('click', '.image-zoom', function () {
			if ($('.image-zoom-preview').length==0) {
				$('body').append(`
					<div class="image-zoom-preview">
						<div class="close-zoom"><i class="bx bx-x"></i></div>
						<img src="${ $(this).data('src') }" class="zoom-${ $(this).data('zoom') }" />
					</div>
				`).hide().fadeIn(100);
			}else{
				$('.image-zoom-preview').html(`
					<div class="close-zoom"><i class="bx bx-x"></i></div>
					<img src="${ $(this).data('src') }" class="zoom-${ $(this).data('zoom') }" />
				`).hide().fadeIn(100);
			}
		});
		$(document).on('click', '.close-zoom', function () {
			$('.image-zoom-preview').remove();
		});
	// End Image Zoom
});



var getCambodiaChildUrl = '/address/getFullAddress';
var getProvinceChildUrl = '/address/getProvinceChileSelection';
var getDistrictChileUrl = '/address/getDistrictChileSelection';
var getCommuneChileUrl = '/address/getCommuneChileSelection';
var _patientRequestUrl = '/patient/getSelectDetail';
var temp_address_code = '';

function bss_number(number) {
    return (!number || typeof number == 'undefined' || number == 'undefined' || number == '0') ? 0 : parseInt(number);
}

function bss_string(txt) {
    return (!txt || typeof txt == 'undefined' || txt == 'undefined') ? '' : txt;
}

// calculate sum
function bss_sum_number() {
    let sum = 0;
    for (let i = 0; i < arguments.length; i++) {
        sum += bss_number(arguments[i]);
    }

    return bss_number(sum);
}

function bss_call_function(fc_name, clear_called = false) {
    if (typeof fc_name == 'function') {
        fc_name();
        if (clear_called) fc_name = function () { };
    }
}

function bss_swal_Success(title = '', text = '', fcCallBack) {
    Swal.fire({
        icon: 'success',
        title: bss_string(title),
        confirmButtonText: bss_string(text),
        timer: 1500
    }).then(() => {
        fcCallBack();
    });
}

function bss_swal_Error(txt) {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: bss_string(txt),
    });
}

function bss_swal_Warning(title = '', text = '', fcCallBack) {
    Swal.fire({
        icon: 'warning',
        title: bss_string(title),
        confirmButtonText: bss_string(text),
        // timer: 1500
    }).then(() => {
        fcCallBack();
    });
}

function bss_openPrintWindow(url, name) {
    var printWindow = window.open(url, name, "width="+ screen.availWidth +",height="+ screen.availHeight +",_blank");
    var printAndClose = function () {
        if (printWindow.document.readyState == 'complete') {
            clearInterval(sched);
            printWindow.print();
            printWindow.close();
        }
    }  
    var sched = setInterval(printAndClose, 2000);
};

// prepare form AJAX submission
$(document).ready(function () {
    $(document).on('click', '.submitFormAjx', function (e) {
        e.preventDefault(); // prevent form native submission
        let _form = $(this).parents('form');

        $.ajax({
            url: _form.attr('action'),
            method: bss_string(_form.attr('method')),
            data: bss_string(_form.serialize()),
            success: function (res) {
                if (typeof onAjaxSuccess == 'string') {
                    bss_swal_Success(onAjaxSuccess);
                    onAjaxSuccess = '';
                } else if (typeof onAjaxSuccess == 'function') {
                    onAjaxSuccess(res); onAjaxSuccess = function () { };
                }
            },
            error: function (request, status, error) {
                bss_swal_Error(bss_string(request.responseText) + ' : ' + bss_string(status) + ' : ' + bss_string(error));
            }
        });
    });

    // date picker
    if ($('.bssDateRangePicker').length >= 1) {
        $('.bssDateRangePicker').daterangepicker(
            {
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().startOf('month'),
                endDate: moment().endOf('month')
            },
            function (start, end) {
                $('#from').val(start.format('YYYY-MM-DD'));
                $('#to').val(end.format('YYYY-MM-DD'));
                getDatatable(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'))
            }
        )
    }

    if ($('[name="patient_id"]').length >= 1) {
        $(document).on('change', '[name="patient_id"]', function () {
            $('[name="pt_district_id"], [name="pt_commune_id"], [name="pt_village_id"]').html('<option value=""></option>');

            if ($(this).val() != '') {
                $.ajax({
                    url: bss_string(_patientRequestUrl),
                    type: 'post',
                    data: { 
                        id: bss_number($(this).val()),
                        with_address_selection : true
                    },
                }).done(function (result) {
                    // $('[name="pt_no"]').val(result.patient.no);
                    $('[name="pt_name"]').val(bss_string(result.patient.name));
                    $('[name="pt_phone"]').val(bss_string(result.patient.phone));
                    $('[name="pt_age"]').val(bss_string(result.patient.age));
                    $('[name="pt_age_type"]').val(bss_string(result.patient.age_type));
                    $('[name="pt_gender"]').val(bss_string(result.patient.pt_gender));
                    $('[name="pt_village"]').val(bss_string(result.patient.address_village));
                    $('[name="pt_commune"]').val(bss_string(result.patient.address_commune));

                    if (result && result.address) {
                        let _adddressLevel = result.address;
                        $('[name="pt_province_id"]').html(_adddressLevel[0]);
                        $('[name="pt_district_id"]').html(_adddressLevel[1]);
                        $('[name="pt_commune_id"]').html(_adddressLevel[2]);
                        $('[name="pt_village_id"]').html(_adddressLevel[3]);
                    }
                });
            }
        });
    }

    if ($('[name="pt_province_id"]').length >= 1) {
        $(document).on('change', '[name="pt_province_id"]', function (e) {            
            $('[name="pt_district_id"], [name="pt_commune_id"], [name="pt_village_id"]').html('<option value=""></option>');
            
            let targetObj = $('[name="pt_district_id"]');
            $.ajax({
                url: bss_string(getProvinceChildUrl),
                method: 'post',
                data: { parent_code: bss_string($(this).val()) },
                success: function (data) { targetObj.html(data); }
            });
        });
    }

    if ($('[name="pt_district_id"]').length >= 1) {
        $(document).on('change', '[name="pt_district_id"]', function (e) {
            $('[name="pt_commune_id"], [name="pt_village_id"]').html('<option value=""></option>');
            
            let targetObj = $('[name="pt_commune_id"]');
            $.ajax({
                url: bss_string(getDistrictChileUrl),
                method: 'post',
                data: { parent_code: bss_string($(this).val()) },
                success: function (data) { targetObj.html(data); }
            });
        });
    }

    if ($('[name="pt_commune_id"]').length >= 1) {
        $(document).on('change', '[name="pt_commune_id"]', function (e) {
            $('[name="pt_village_id"]').html('<option value=""></option>');

            let targetObj = $('[name="pt_village_id"]');
            $.ajax({
                url: bss_string(getCommuneChileUrl),
                method: 'post',
                data: { parent_code: bss_string($(this).val()) },
                success: function (data) { targetObj.html(data); }
            });
        });
    }

    $('#btn_upload').click(function () {
        $('#btn_upload').html('uploading data to BSS FTP server, please wait. <i class="fa fa-spinner fa-pulse"></i>');
        $.ajax({
            url: bss_string('/uplaoddb'),
            method: 'post',
            // async: false,
            complete: function(xhr, textStatus) {
                if (xhr.status == 200) {
                    $('#btn_upload').html('<p class="text-success">already <i class="fa fa-check"></i></p>');
                } else {
                    $('#btn_upload').html('<p class="text-danger">problem while uploading process. <i class="fa fa-times"></i></p>');
                }
            } 
        });
    });

    $('#btn_complement_field').click(function () {
        $('#btn_complement_field').html('updating missing fiels or data. <i class="fa fa-spinner fa-pulse"></i>');
        $.ajax({
            url: bss_string('/updatedb'),
            method: 'post',
            // async: false,
            complete: function(xhr, textStatus) {
                if (xhr.status == 200) {
                    $('#btn_complement_field').html('<p class="text-success">already <i class="fa fa-check"></i></p>');
                } else {
                    $('#btn_complement_field').html('<p class="text-danger">problem while updating process. <i class="fa fa-times"></i></p>');
                }
            } 
        });
    });
});