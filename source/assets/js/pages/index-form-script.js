$(function() {

    var tab = document.getElementById("datatable-default").rows.length;
    if (tab > 1) {
        $('#datatable-default').dataTable({
            "scrollX": true,
            "paging":   false,
            "ordering": false,
        });   
    }
    
	$(document).on('click', '.modal-dismiss', function (e) {
		$.magnificPopup.close();
    });
    
    $(document).on('click','.modal-confirm', function (e) {
        $("#modalForm").validate({
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
                name_form: {
                    required: true,
                    minlength: 5,
                    maxlength: 255
                }
            },
            messages: {
                name_form: {
                    required: "Insert Form Name",
                    minlength: jQuery.validator.format(" {0} character needed"),
                    maxlength: jQuery.validator.format(" {0} character maximum")
                }
            },
            submitHandler: function () {
                
                var post_data = new FormData($('#modalForm')[0]);
                
                $.ajax({ 
                    url : $('#modalForm').attr("action"),
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
              
});

function showModal(target,index,tipe){
    var urlx = '';
    var datax = '';
    if (tipe == 'add')
    {
      urlx = target;
      datax= {};
    }else{
      urlx = target;
      datax = {id:index};
    }
   
    $.post(urlx, datax , function(mod) {
        $('#showModal').html(mod);
        // $('#modalConfirm').modal({show: true , backdrop : true , keyboard: true});

        $.ajax({
            type:'POST',
            url: $('#type_tc').val(),
            dataType:"JSON",
            success: function(data) {
                $('#type_id').select2({
                    dropdownParent: $('#modalContainer'),
                    placeholder: 'Pick Type Testcase',
                    data: data
                });
            }
        });
        
        $.magnificPopup.open({
            items: {
                src: "#modalContainer"
            },
            type: 'inline',
            preloader: false,
            modal: true,
            
        });
    })
}










       
