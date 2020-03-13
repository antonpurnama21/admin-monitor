(function() {

	'use strict';

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

}).apply(this, [jQuery]);