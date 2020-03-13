$(function() {
    $('#datatable-default').dataTable({
        "scrollX": true,
        //"scrollY": 200,
        "paging":   false,
        "ordering": false,
        "info":     false
    });

    $('.param_cek').on('change', function (e) {
        var wrapData = $(this).data();
        var postData = {
            "tc_id":wrapData.tc_id,
            "param_cek":this.value,
            "id_device":wrapData.dv_id,
            //"id_ms_form":wrapData.id_msform,
            //"id_ms_trans":wrapData.id_mstrans    
        }
        $.ajax({
            type: "POST",
            url: wrapData.url,
            data: postData,
            dataType:"JSON",
            success: function(data)
            {
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
    });

    $('.comment_cek').on('change', function (e) {
        var wrapData = $(this).data();
        var postData = {
            "tc_id":wrapData.tc_id,
            "comment_cek":this.value,
            "id_ms_form":wrapData.id_msform,
            "id_ms_trans":wrapData.id_mstrans    
        }
        $.ajax({
            type: "POST",
            url: wrapData.url,
            data: postData,
            dataType:"JSON",
            success: function(data)
            {
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
    });
              
});













       
