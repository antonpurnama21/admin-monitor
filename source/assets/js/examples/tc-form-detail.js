(function() {

	'use strict';

	$('.modal-sizes').magnificPopup({
		type: 'inline',
		preloader: false,
		modal: true
	});

	/*
	Modal Dismiss
	*/
	$(document).on('click', '.modal-dismiss', function (e) {
		e.preventDefault();
		$.magnificPopup.close();
	});

	/*
	Modal Confirm
	*/
	$(document).on('click', '.modal-confirm', function (e) {
		e.preventDefault();
		$.magnificPopup.close();

		new PNotify({
			title: 'Success!',
			text: 'Modal Confirm Message.',
			type: 'success'
		});
	});
	
	// checkbox, radio and selects
	$("#selects-form").each(function() {
		$(this).validate({
			highlight: function(element) {
				$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
			},
			success: function(element) {
				$(element).closest('.form-group').removeClass('has-error');
			},
			errorPlacement: function( error, element ) {
				var placement = $(element).parent();
				
				placement.append(error);
			}
		});
    });
    
    $(".addWrap").click(function(){
		$("#rowsplus").append('<div class="wrap mt-3"><div class="form-group row">'+
        '<label class="col-sm-3 control-label text-sm-right pt-2">Testcase Name <span class="required">*</span></label>'+
        '<div class="col-sm-8">'+
        '<input type="text" id="testcase_name" name="testcase_name[]" class="form-control" required/>'+
        '</div>'+
        '<div class="ml-3 mt-2">'+
        '<a href="javascript:void(0);" class="removeWrap btn btn-default btn-sm"><li class="fas fa-minus"></li></a>'+
        '</div>'+
        '</div>'+
        '<div class="form-group row">'+
        '<label class="col-sm-3 control-label text-sm-right pt-2">Description</label>'+
        '<div class="col-sm-8">'+
            '<textarea name="description[]" id="description" rows="5" class="form-control"></textarea>'+
        '</div>'+
        '</div></div>');
	});
    $("#rowsplus").on('click','.removeWrap',function(e){
        $(this).closest('.wrap').remove();
    });
    
    var datatableInit = function() {

		$('#datatable-default').dataTable({
			dom: '<"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
			paging: false,
			ordering: false
		});

	};

	$(function() {
		datatableInit();
	});

}).apply(this, [jQuery]);