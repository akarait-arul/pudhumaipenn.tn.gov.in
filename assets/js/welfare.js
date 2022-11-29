$(document).ready(function () {

	 

	getWelfareStudentListByType('pending');


	getWelfareStudentListByType('approved');
	getWelfareStudentListByType('rejected');



	getRejectResons();
	GetWelfareInstitutionTypeByDistrictID();
	initiate_date();



});


function initiate_date() {


	$("#filter_dates").flatpickr({


		dateFormat: "d-M-Y",
		maxDate: "today",
		mode: "range",


	});

}







//getting studnet list by district
function getWelfareStudentListByType(value) {


	$.ajax({

		method: "POST",
		url: "ajax.php",
		data: {

			type: 'getWelfareStudentListByType',
			recordstype: value

		},
		beforeSend: function () {

			$('.loader').preloader({
				text: 'Loading Please Wait ....'
			});

		},
		success: function (response) {
			resdata = $.parseJSON(response);

			if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

				$("#" + value + '_tbody').html(resdata.error_msg);



			} else if (resdata['error_code'] == 400 && resdata['error_msg'] != 0) {

				Swal.fire(resdata['error_msg'])

				/* Swal.fire({
					title: 'Are you sure?',
					text: "You want to complete the application !!!",
					icon: 'warning',
					 
					 
				}) */

			}

			$('.loader').preloader('remove');

		}

	});


}
//getting studnet list by district




// Get institution type   in district
function GetWelfareInstitutionTypeByDistrictID() {

	$.ajax({
		method: "POST",
		url: "ajax.php",
		data: {

			type: 'GetWelfareInstitutionTypeByDistrictID'
		},
		beforeSend: function () {

			$('.loader_filter').preloader({
				text: 'Loading Please Wait ....'
			});

		},
		success: function (response) {

			resdata = $.parseJSON(response);
			if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

				$('#instiution_type').empty().append();
				$('#instiution_type').append($("<option value='0'> </option>").attr("value", '').text('All'));
				$.each(resdata['error_msg'], function (index, value) {
					$('#instiution_type').append($("<option></option>").attr("value", value['m_institution_type_id']).text(value['institution_type']));
				});

			} else if (resdata['error_code'] == 400 && resdata['error_msg'] != 0) {
				Swal.fire(resdata['error_msg'])
			}

			$('.loader_filter').preloader('remove');
		}
	});

	$("#course,#subject").html('<option value=""> All </option>');

}
// Get institution type   in district */



// Get institution by type in district
function getWelfareinstitutionList(option) {

	var value = option.value;

	if (value != '') {

		$.ajax({
			method: "POST",
			url: "ajax.php",
			data: {

				type: 'GetWelfareInstitutionByDistrictID',
				institution_type: value
			},
			beforeSend: function () {

				$('.loader').preloader({
					text: 'Loading Please Wait ....'
				});

			},
			success: function (response) {

				resdata = $.parseJSON(response);

				if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {


					$('#institution_list').empty().append();
					$('#institution_list').append($("<option> </option>").attr("value", '').text('All'));
					$.each(resdata['error_msg'], function (index, value) {
						$('#institution_list').append($("<option></option>").attr("value", value['m_institution_id']).text(value['institution_name']));
					});

				} else if (resdata['error_code'] == 400 && resdata['error_msg'] != 0) {

					Swal.fire(resdata['error_msg'])
				}
			}
		});
	} else {

		/* $("#institution_list ").html('<option value=""> All </option>');
		$(" #course ").html('<option value=""> All </option>');
		$(" #subject").html('<option value=""> All </option>'); */
	}

	$(" #course,#subject").html('<option value=""> All </option>');
	$('.loader').preloader('remove');
}
// Get institution by type in district


//clear button  all records
function getDefaultRecords() {

	$("#instiution_type").val("");
	$("#institution_list,#course,#subject").html('<option value=""> All </option>');
	$("#filter_dates").flatpickr().clear();
	initiate_date();
	$("#acceptall").addClass("d-none");
	$("#checkall").prop('checked', false);

	getWelfareStudentListByType('pending');
	getWelfareStudentListByType('approved');
	getWelfareStudentListByType('rejected');



}
//clear button  all records


//course list based on institution and institution type
function getWelfareCourseList(institution) {

	var institutionid = institution.value;
	if (institutionid) {

		$.ajax({
			method: "POST",
			url: "ajax.php",
			data: {

				type: 'getWelfareCourseList',
				institution_id: institutionid
			},
			beforeSend: function () {

				$('.loader_filter').preloader({
					text: 'Loading Please Wait ....'
				});

			},
			success: function (response) {

				resdata = $.parseJSON(response);

				if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

					$("#course").html(resdata.error_msg);


				} else if (resdata['error_code'] == 400 && resdata['error_msg'] != 0) {

					Swal.fire(resdata['error_msg'])

				}
			}
		});
	}

	$(" #subject").html('<option value=""> All </option>');
	$('.loader_filter').preloader('remove');
}
//course list based on institution and institution type


//subject list based on institution and institution type
function getWelfareSubjectList(course) {

	var courseid = course.value;
	var institution_id = $("#institution_list").val();
	if (!courseid) {

		Swal.fire('Please select Institution.');


	} else if (!institution_id) {

		Swal.fire('Please select Degree.');

	} else {

		$.ajax({
			method: "POST",
			url: "ajax.php",
			data: {

				type: 'getWelfareSubjectList',
				institution_id: institution_id,
				courseid: courseid
			},
			beforeSend: function () {

				$('.loader_filter').preloader({
					text: 'Loading Please Wait ....'
				});

			},
			success: function (response) {

				resdata = $.parseJSON(response);

				if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

					$("#subject").html(resdata.error_msg);


				} else if (resdata['error_code'] == 400 && resdata['error_msg'] != 0) {

					Swal.fire(resdata['error_msg'])

				}
			}
		});



	}

	$('.loader_filter').preloader('remove');
}
//subject list based on institution and institution type


/* 
$("#dateclear").click(function(){
	 
	$("#filter_dates").val('');
});
 */


/// get search results based on records type
function getFilterResults() {

	getFilteredStudentsResulst('pending');
	getFilteredStudentsResulst('approved');
	getFilteredStudentsResulst('rejected');


}
/// get search results based on records type


//search filter  function for all records type
function getFilteredStudentsResulst(recordtype) {


	var instiution_typeid = $("#instiution_type").val();
	if (instiution_typeid != '') {

		var recordtype = recordtype;
		var institutiontypeid = $("#instiution_type").val();
		var institutionid = $("#institution_list").val() ? $("#institution_list").val() : '';
		var course = $("#course").val() ? $("#course").val() : '';
		var subject = $("#subject").val() ? $("#subject").val() : '';
		var filterdate = $("#filter_dates").val();
		var filterdate = filterdate.split("to");
		var startdate = filterdate[0];
		var enddate = filterdate[1];


		$.ajax({

			method: "POST",
			url: "ajax.php",
			data: {

				type: 'getFilteredStudentsResulst',
				institutiontypeid: institutiontypeid,
				institutionlisteid: institutionid,
				course: course,
				subject: subject,
				startdate: startdate,
				enddate: enddate,
				recordtype: recordtype
			},
			beforeSend: function () {

				$('.loader').preloader({
					text: 'Loading Please Wait ....'
				});

			},
			success: function (response) {

				$('.loader').preloader('remove');

				resdata = $.parseJSON(response);

				if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

					$("#" + recordtype + "_tbody").html(resdata.error_msg);

				} else if (resdata['error_code'] == 400 && resdata['error_msg'] != 0) {

					Swal.fire(resdata['error_msg'])
				}
				$('.loader').preloader('remove');
			}
		});
	}
}
//search filter  function for all records type



//accept student
function accept_student(value) {
	

	$.ajax({
		method: "POST",
		url: "ajax.php",
		data: {

			type: 'accept_student',
			student_id: value
		},
		beforeSend: function () {

			$('.loader').preloader({
				text: 'Loading Please Wait ....'
			});

		},
		success: function (response) {

			resdata = $.parseJSON(response);

			if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

				swal.fire({

					icon: "success",
					text: resdata.error_msg,

				}).then(function () {
					location.reload();
				});


			} else if (resdata['error_code'] == '400' && resdata['error_msg']) {

				Swal.fire(resdata['error_msg']);

			}
			$('.loader').preloader('remove');
		}
	});
}
//accept ends

//select all
$('#checkall').change(function () {

	if ($(this).is(':checked')) {

		var selectmsg = 'Your are about to select all the pending records from the list. Please confirm.';


		Swal.fire({
			text: selectmsg,

			showCancelButton: true,
			confirmButtonText: 'Confirm',


		}).then((result) => {
			if (result.isConfirmed) {

				$('.stud_det').prop('checked', true);
				$("#acceptall").removeClass("d-none");
				var checked = $('.stud_det:checked').length;
				$("#selectcount").html(checked);

			} else if (result.isDismissed) {

				$('#checkall').prop('checked', false);

			}
		})
	} else {

		$('.stud_det').prop('checked', false);
		$("#acceptall").addClass("d-none");
		


	}

});


$(document).on('click', '.stud_det', function () {

	var total = $('input.stud_det').length;
	var checked = $('input.stud_det:checked').length;
	var unchecked = $('input.stud_det').not(':checked').length;

	$("#selectcount").html(checked);

	if (total != checked) {

		$("#checkall").prop('checked', false);

	}

	if (checked == 0) {

		$("#acceptall").addClass("d-none");

	}

	if ($(this).is(':checked')) {
		if (checked = 1) {

			$("#acceptall").removeClass("d-none");

		}
	}


});
//select all



//acceptall


function acceptall_students() {


	var total = $('input.stud_det').length;
	var checked = $('input.stud_det:checked').length;
	var studentlist = [];

	$("input:checkbox[name=stud_details]:checked").each(function () {
		studentlist.push($(this).val());

	});

	var selectmsg = 'Your are about to <b> Approve </b> total no. <b>' + checked + '</b> of  records. Please confirm.';

	if (studentlist.length != 0) {

		Swal.fire({
			html: selectmsg,

			showCancelButton: true,
			confirmButtonText: 'Approve',

		}).then((result) => {

			if (result.isConfirmed) {


				$.ajax({
					method: "POST",
					url: "ajax.php",
					data: {

						type: 'acceptAllStudents',
						student_ids: studentlist
					},
					beforeSend: function () {

						$('.loader').preloader({
							text: 'Loading Please Wait ....'
						});

					},
					success: function (response) {

						resdata = $.parseJSON(response);

						if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

							swal.fire({

								icon: "success",
								text: resdata.error_msg,

							}).then(function () {
								location.reload();
							});


						} else if (resdata['error_code'] == '400' && resdata['error_msg']) {

							Swal.fire(resdata['error_msg']);

						}
						$('.loader').preloader('remove');
					}

				});
			} else if (result.isDismissed) {
				//Swal.fire('Changes are not saved', '', 'info')
			}
		})

	} else {
		Swal.fire('Please select all checkboxes');
	}


}

//acceptall


function openreason_student(value) {

	$('#rejectreson').modal('show');
	$("#student_uniqid").val(value);


}


function getRejectResons() {

	$.ajax({
		method: "POST",
		url: "ajax.php",
		data: {

			type: 'getRejectResonsList',

		},
		beforeSend: function () {

			$('.loader').preloader({
				text: 'Loading Please Wait ....'
			});

		},
		success: function (response) {

			resdata = $.parseJSON(response);

			if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

				$('#reason_list').empty().append();
				$('#reason_list').append($("<option></option>").attr("value", '').text('Select Reason Type'));
				$.each(resdata['error_msg'], function (index, value) {
					$('#reason_list').append($("<option></option>").attr("value", value['m_reject_reason_id']).text(value['reject_reason']));
				});


			} else if (resdata['error_code'] == 400 && resdata['error_msg'] != 0) {

				Swal.fire(resdata['error_msg']);

			}

			$('.loader').preloader('remove');
		}

	});



}

function reject_student() {



	$("#reason_list").css("border-color", "#d8e2ef");

	var studnid = $("#student_uniqid").val();
	var resonlist = $("#reason_list").val();

	if (!studnid) {

		Swal.fire('Unable to get student information. Please contact admin.', '', 'error');

	} else if (!resonlist) {

		$("#reason_list").css("border-color", "#e63757");

		Swal.fire('Please select Reason.', '', 'error');



	} else {

		$.ajax({
			method: "POST",
			url: "ajax.php",
			data: {

				type: 'reject_student',
				student_id: studnid,
				reason_list: $("#reason_list").val(),

			},
			beforeSend: function () {

				$('.loader').preloader({
					text: 'Loading Please Wait ....'
				});

			},
			success: function (response) {

				resdata = $.parseJSON(response);

				if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

					swal.fire({

						icon: "error",
						text: resdata.error_msg,

					}).then(function () {
						location.reload();
					});

				} else if (resdata['error_code'] == 400 && resdata['error_msg'] != 0) {

					Swal.fire(resdata['error_msg']);

				}


				$('.loader').preloader('remove');
			}

		});

	}


}






//accept student

/* 

function getFilterInstitute() {


	$.ajax({
		method: "POST",
		url: "ajax.php",
		data: {
			m_district_id: m_district_id,
			type: 'GetWelfareInstitutionByDistrictID'
		},
		success: function (response) {
			resdata = $.parseJSON(response);
			console.log(resdata);
			if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

				$('#m_degree_id').empty().append();
				$('#m_degree_id')
					.append($("<option></option>")
						.attr("value", '')
						.text('Select Degree'));
				$.each(resdata['error_msg'], function (index, value) {
					$('#m_degree_id')
						.append($("<option></option>")
							.attr("value", value['m_degree_id'])
							.text(value['degree']));
				});

			} else if (resdata['error_code'] == 200 && resdata['error_msg'] != 0) {

				Swal.fire(resdata['error_msg'])

			}
			$('.loader').preloader('remove');
		}

	});



}
 */

