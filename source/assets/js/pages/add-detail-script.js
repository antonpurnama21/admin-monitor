$(function () {
    $.ajax({        
        type:'POST',
        async: true,
        url: $('#getparent').val(),
        dataType:"JSON",
        success: function(data) {
            $('#parent_id').select2({
                placeholder: 'Pick parent',
                data: data
            });
        }
        
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
            '<textarea name="description[]" id="description" rows="2" class="form-control"></textarea>'+
        '</div>'+
        '</div></div>');
	});
    $("#rowsplus").on('click','.removeWrap',function(e){
        $(this).closest('.wrap').remove();
    });


    $("#add_detail").validate({
        ignore: 'input[type=hidden], .select2-search__field',
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        highlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
            if ($(element).parent().hasClass('has-success')){
                $(element).parent().removeClass('has-success');
                $(element).parent().addClass('has-danger');
            }
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
            
        },

        // Different components require proper error label placement
        errorPlacement: function(error, element) {
            
            if (element.parent().hasClass('has-success')) {
                element.parent().removeClass('has-success');
            }
            element.parent().addClass('has-danger');

            // Styled checkboxes, radios, bootstrap switch
            if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
                if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo( element.parent().parent().parent().parent() );
                }
                    else {
                    error.appendTo( element.parent().parent().parent().parent().parent() );
                }
            }

            // Unstyled checkboxes, radios
            else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                error.appendTo( element.parent().parent().parent() );
            }

            // Input with icons and Select2
            else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                error.appendTo( element.parent() );
            }

            // Inline checkboxes, radios
            else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                error.appendTo( element.parent().parent() );
            }

            // Input group, styled file input
            else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                error.appendTo( element.parent().parent() );
            }

            else {
                error.insertAfter(element);
            }
        },
        validClass: "validation-valid-label",
        success: function(label, element) {
            if (label.parent().hasClass('has-danger')) {
                label.parent().removeClass('has-danger');
                
            }
            if($(element).parent().hasClass('has-danger')){
                $(element).parent().removeClass('has-danger');
            }
            label.parent().addClass('has-success');
            label.addClass("validation-valid-label").text("Successfully")
        },
        rules: {
            testcase_name: {
                required: true,
                minlength: 5,
                maxlength: 255
            }
        },
        messages: {
            testcase_name: {
                required: "Insert Testcase Name",
                minlength: jQuery.validator.format(" {0} character needed"),
                maxlength: jQuery.validator.format(" {0} character maximum")
            }
        },
        submitHandler: function () {
            
            var post_data = new FormData($('#add_detail')[0]);
            
            $.ajax({ 
                url : $('#add_detail').attr("action"),
                type: "POST",
                data : post_data,
                contentType: false,
                cache: false,
                processData:false,
                dataType:"JSON",
                success: function(data) {
                    if (data.code == 200)
                    {
                        window.location.reload();
                    }else if (data.code == 366){
                    $( "#add_detail" ).validate().showErrors({
                        "testcase_name": data.message
                        });
                    notif('Error',data.message,'error');
                    }else{
                    notif('Error',data.message,'error');
                    }
                },
                error: function(data){
                    notif('Error',data.statusText,'error');
                }
            });

        }
    });

});