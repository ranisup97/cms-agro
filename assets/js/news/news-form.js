$(function(){
    var fd = $("#form-default");
    
    fd[0].reset();
    fd.ajaxForm({
        dataType: "JSON",
        beforeSubmit : function(){
            fd.addClass("loading-idocs");
        },
        success: function(data){
            var sa_title = (data.type == 'done') ? "Berhasil!" : "Gagal!";
            var sa_type  = (data.type == 'done') ? "success" : "warning";
            var sa_title = (data.type == 'gagal') ? "Gagal!" : "Berhasil";
            var sa_type  = (data.type == 'gagal') ? "error" : "success";
            swal({ title:sa_title, type:sa_type, html:data.response }).then(function(){ 
                if (data.type == 'done') window.location.replace(data.uri);
            });
        },
        error: function(){
            swal("Gagal!", "Terjadi error, harap refresh browser anda.", "error");
        },
        complete: function(){
            fd.removeClass("loading-idocs");
        },
    });
})