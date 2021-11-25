$(function(){
    var fd  = $("#form-default");
        tc  = $("#tab-part-content");
        tcl1 = $('#content-link-part1');
        tcl2 = $('#content-link-part2');
        tcl3 = $('#content-link-part3');

    fd[0].reset();

    $(".content_link_part_name").keyup(function(){
        $(".content_link_part_name_hidden").val($(this).val());
    });
    $(".btn-add-more-content-part1").on("click", function(){
        // console.log('aaaaaaaaaaa');
        let html = `
        <tr>
            <td><input type="text" class="form-control" name="content_link_title_name_satu[]" placeholder="Title Content" /></td>
            <td><input type="text" class="form-control" name="content_link_name_satu[]" placeholder="Link (http://www.youtube.com/video)" /></td>
            <td class="text-center"><input type="hidden" name="content_link_oldname_satu[]" value="" /><button type="button" class="btn btn-sm btn-danger btn-rem-more-content-part1"><i class="fa fa-close"></i></button></td>       
        </tr>`;
        tcl1.find(".tbody_content_link_part1").append(html);
    })
    $(tcl1).on("click", ".btn-rem-more-content-part1", function(){
        $(this).closest("tr").remove();
    })

    $(".btn-add-more-content-part2").on("click", function(){
        // console.log('aaaaaaaaaaa');
        let html = `
        <tr>
            <td><input type="text" class="form-control" name="content_link_title_name_dua[]" placeholder="Title Content" /></td>
            <td><input type="text" class="form-control" name="content_link_name_dua[]" placeholder="Link (http://www.youtube.com/video)" /></td>
            <td class="text-center"><input type="hidden" name="content_link_oldname_dua[]" value="" /><button type="button" class="btn btn-sm btn-danger btn-rem-more-content-part2"><i class="fa fa-close"></i></button></td>       
        </tr>`;
        tcl2.find(".tbody_content_link_part2").append(html);
    })
    $(tcl2).on("click", ".btn-rem-more-content-part2", function(){
        $(this).closest("tr").remove();
    })

    $(".btn-add-more-content-part3").on("click", function(){
        // console.log('aaaaaaaaaaa');
        let html = `
        <tr>
            <td><input type="text" class="form-control" name="content_link_title_name_tiga[]" placeholder="Title Content" /></td>
            <td><input type="text" class="form-control" name="content_link_name_tiga[]" placeholder="Link (http://www.youtube.com/video)" /></td>
            <td class="text-center"><input type="hidden" name="content_link_oldname_tiga[]" value="" /><button type="button" class="btn btn-sm btn-danger btn-rem-more-content-part3"><i class="fa fa-close"></i></button></td>       
        </tr>`;
        tcl3.find(".tbody_content_link_part3").append(html);
    })
    $(tcl3).on("click", ".btn-rem-more-content-part3", function(){
        $(this).closest("tr").remove();
    })

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


