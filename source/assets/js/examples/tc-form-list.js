(function() {

    'use strict';
    
    var datatableInit = function() {

		$('#datatable-default').dataTable({
			dom: '<"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p'
		});

	};

	$(function() {
		datatableInit();
	});

}).apply(this, [jQuery]);