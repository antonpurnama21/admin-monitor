$(function() {

	// checkbox, radio and selects
	// $("#login-form").validate({
	// 	highlight: function( label ) {
	// 		$(label).closest('.form-group').removeClass('has-success').addClass('has-error');
	// 	},
	// 	success: function( label ) {
	// 		$(label).closest('.form-group').removeClass('has-error');
	// 		label.remove();
	// 	},
	// 	errorPlacement: function( error, element ) {
	// 		var placement = element.closest('.input-group');
	// 		if (!placement.get(0)) {
	// 			placement = element;
	// 		}
	// 		if (error.text() !== '') {
	// 			placement.after(error);
	// 		}
	// 	}
    // });
    $.validator.addMethod("emailvalid", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/.test(value);
    });
    
    $("#form-login").validate({
        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
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
            password: {
                required: true,
                minlength: 5,
                maxlength: 15
            },
            email: {
                required: true,
                emailvalid: true
            }
        },
        messages: {
            email: {
                required: "Insert your email",
                emailvalid: "Your email must be in the format name@domain.com",
                email: "Please enter a valid email address."
            },
            password: {
                required: "Insert your password",
                minlength: jQuery.validator.format(" {0} character needed"),
                maxlength: jQuery.validator.format(" {0} character maximum")
            }
        },
        submitHandler: function () {
        	
        	var post_data = new FormData($('#form-login')[0]);
        	
        	$.ajax({ 
                    url : $('#form-login').attr("action"),
                    type: "POST",
                    data : post_data,
                    contentType: false,
                    cache: false,
                    processData:false,
                    dataType:"JSON",
                    success: function(data) {
                      if (data.code == 200)
                      {
                        eval(data.aksi);
                      }else if (data.code == 366){
                        $( "#form-login" ).validate().showErrors({
                            "email": data.message
                          });
                      }else if (data.code == 367){
                        $( "#form-login" ).validate().showErrors({
                            "password": data.message
                          });
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