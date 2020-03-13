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
                project_name: {
                    required: true,
                    minlength: 5,
                    maxlength: 50
                },
                pic: {
                    required: true,
                    minlength: 2,
                    maxlength: 50
                },
                id_ms_form: {
                    required: true
                }
            },
            messages: {
                id_ms_form: {
                    required: "Select Document Form",
                },
                project_name: {
                    required: "Insert Project Name",
                    minlength: jQuery.validator.format(" {0} character needed"),
                    maxlength: jQuery.validator.format(" {0} character maximum")
                },
                pic: {
                    required: "Insert Pic Name",
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
                            if(data.aksi){
                                eval(data.aksi);
                            }else if(data.message){
                                window.location.reload();
                            }
                        }else if (data.code == 366){
                            $( "#modalForm" ).validate().showErrors({
                                "project_name": data.message
                            });
                        }else if(data.code == 367){
                            $('.error').text(data.message);
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

        $('.pickadate').datepicker({
            dateFormat: 'dd-mm-yy',
            minDate: 'today',
        });

        $('#day_estimate').on('input', function (e) {
            var value = $(this).val();
            if ((value !== '') && (value.indexOf('.') === -1)) { 
                $(this).val(Math.max(Math.min(value, 7), 0));
            }
            $(this).val($(this).val().replace(/[^\d].+/, ""));
        });

        $.ajax({
            type:'POST',
            url: $('#ms_form').val(),
            data: {id:$('#id_type').val()},
            dataType:"JSON",
            success: function(data) {
                $('#id_ms_form').select2({
                    dropdownParent: $('#modalContainer'),
                    placeholder: 'Pick Form Testcase',
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