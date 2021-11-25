<?php defined('BASEPATH') OR exit("No direct script access allowed");
/***
*
* @Author		: Maha Andar
* @Module       : Maps Restaurant - Forms
* @Type         : View
* @Date Create	: 17 May 2021
*
***/
$id_course      = "";
$id_category    = "";
$imgUrl         = "";
$authorImg      = "";
$authorName     = "";
$authorCourses  = "";
$price          = "";
$courseTitle    = "";
$courseDesc     = "";
$duration       = "";
$course_part_id_satu = "";
$course_part_id_dua  = "";
$course_part_id_tiga = "";



if ( isset($data) and $data ):
    $id_course      = $data[0]->id;
    $id_category    = $data[0]->idCategory;
    $imgUrl         = $data[0]->imgUrl;
    $authorImg      = $data[0]->authorImg;
    $authorName     = $data[0]->authorName;
    $authorCourses  = $data[0]->authorCourses;
    $price          = $data[0]->price;
    $courseTitle    = $data[0]->courseTitle;
    $courseDesc     = $data[0]->courseDesc;
    $duration       = $data[0]->duration;
    $course_part_id_satu = !empty($data_course_detail_part_satu[0]) ? $data_course_detail_part_satu[0]->course_part_id : '';
    $course_part_id_dua  = !empty($data_course_detail_part_dua[0]) ? $data_course_detail_part_dua[0]->course_part_id : '';
    $course_part_id_tiga = !empty($data_course_detail_part_tiga[0]) ? $data_course_detail_part_tiga[0]->course_part_id : '';


endif;
$facility_arr = [
    "1" => "Wifi",
    "2" => "Toilet",
    "3" => "Tempat Parkir",
    "4" => "Musholla"
];
$iso_type = [
    "1" => "Restoran",
    "2" => "Hotel",
    "3" => "Pom Bensin",
    "4" => "Perusahaan"
];


?>

<!-- <script src="<?=base_url("assets/plugins/ckeditor/ckeditor.js")?>"></script>  -->
<style>
    .select2-container .select2-selection--single {
        height: 36px !important;
    }
    .select2-container--default .select2-selection--single {
        background-color: #FEFBD8;
        border: 0.1px solid #aaa;
        border-radius: 0px;
    }
</style>
<div class="content-wrapper">
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title mt-5"><?=$page_title?></h3>
                <a href="<?=base_url("{$page_curr}")?>" class="btn btn-sm btn-danger pull-right"><i class="fa fa-arrow-left"></i></a>
            </div>
            <div class="box-body">
            <form action="<?=base_url("{$page_curr}/forms/save")?>" class="form-horizontal" method="POST" id="form-default" accept-charset="UTF-8">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">Course Data</a></li>
                        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="true">Content</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="control-label mb-5" for="title">Course Category <span class="text-red">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-check text-blue"></i></span>
                                                <select name="course_category" id="course_category" class="form-control" required>
                                                    <option value="" selected hidden>-- Choose Category Course --</option>
                                                    <?php
                                                        if ( isset($data_course_category) and $data_course_category ):
                                                            foreach($data_course_category as $course_cat):
                                                                if ( $id_category == $course_cat->id )
                                                                    echo '<option value="'.$course_cat->id.'" selected="selected">'.$course_cat->namaCategory.'</option>';
                                                                else
                                                                    echo '<option value="'.$course_cat->id.'">'.$course_cat->namaCategory.'</option>';
                                                            endforeach;
                                                        endif;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="control-label mb-5" for="Course_title">Course title <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" name="course_title" id="Course_title" maxlength="255" placeholder="Course Title" required value="<?=$courseTitle?>" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="control-label mb-5" for="price">Course Price <span class="text-red">*</span></label>
                                            <input type="text" name="price" id="price" class="form-control price" value="<?= !empty($price) ? number_format($price,0,",",".") : '' ?>" data-thousands="." placeholder="RP 1.000.000">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="control-label mb-5" for="duration">Duration <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" name="duration" id="duration" maxlength="255" placeholder="Duration (ex: 1 th, 3 bln, 6 bln)" required value="<?=$duration?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label mb-5" for="file">Course Photo</label>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <?php if(!empty($imgUrl)) { ?>
                                                    <img id="preview_gambar" class="img-view form-control" src="<?php echo base_url('./../assets_agro/course/').$imgUrl ?>" style="width: 40ex;height:40ex">
                                                <?php } else { ?>
                                                    <img id="preview_gambar" class="img-view form-control" style="width: 40ex;height:30ex">
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <input type="file" name="course_photo" value="<?=$imgUrl?>" id="course_photo" class="form-control" onchange="readURL(this);" style="width: 40ex;"/>
                                                <span style="color:red"><i>Image type must be : <b>jpeg / jpg !!</b></i></span>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="row pr-0 mr-0 ml-5">
                                <label class="control-label mb-5" for="desc">Course Description <span class="text-red">*</span></label>
                                <div class="col-sm-9 col-md-12 pl-0 pr-0">
                                    <textarea name="course_desc" id="desc" class="form-control"><?= $courseDesc ?></textarea>
                                </div>
                            </div>

                            <!-- AUTHOR SECTION -->
                            <div class="row" style="margin-left: 1ex;margin-right: 2ex;">

                            <div class="col-md-9">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="control-label mb-5" for="author_name">Author Name <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" name="author_name" id="author_name" maxlength="255" placeholder="Author Name" required value="<?=$authorName?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label mb-5" for="file">Author Photo</label>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <?php if(!empty($authorImg)) { ?>
                                                    <img id="preview_gambar_author" class="img-view form-control" src="<?php echo base_url('./../assets_agro/author/').$authorImg ?>" style="width: 40ex;height:40ex">
                                                <?php } else { ?>
                                                    <img id="preview_gambar_author" class="img-view form-control" style="width: 40ex;height:30ex">
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <input type="file" name="author_photo" value="<?=$authorImg?>" id="author_photo" class="form-control" onchange="readURLAuthor(this);" style="width: 40ex;"/>
                                                <span style="color:red"><i>Image type must be : <b>jpeg / jpg !!</b></i></span>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                            </div>
                           
                        </div>
                        <div class="tab-pane" id="tab_2">
                            <div class="row clearfix">
                                <div class="col-md-12 pb-5">
                                    <!-- <button type="button" id="btn-add-part-content" class="btn btn-primary pull-right">Course Part <i class="fa fa-plus" style="font-size: 11px;"></i></button> -->
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="tab-part-content" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="font-size: 20px;">Content Link</th>
                                            <!-- <th class="text-center" style="width: 100px;"><i class="fa fa-cog"></th> -->
                                        </tr>
                                    </thead>
                                    <tbody class="tbody_part_content">
                                        <tr>
                                            <td>
                                                <div class="input-group mb-5">
                                                    <span class="input-group-addon">Part 1</span>
                                                     <select name="course_part_satu[]" id="course_part" class="form-control select2">
                                                         <option value="" selected hidden>-- Choose Course Title Part 1 --</option>
                                                        <?php
                                                            if ( isset($data_course_part_satu) and $data_course_part_satu ):
                                                                foreach($data_course_part_satu as $coursePart):
                                                                    if ( $course_part_id_satu == $coursePart->course_part_id )
                                                                        echo '<option value="'.$coursePart->course_part_id.'" selected="selected">'.'['.$coursePart->part_into.'] - '.$coursePart->course_part_title.'</option>';
                                                                    else
                                                                        echo '<option value="'.$coursePart->course_part_id.'">'.'['.$coursePart->part_into.'] - '.$coursePart->course_part_title.'</option>';
                                                                endforeach;
                                                            endif;
                                                        ?>
                                                    </select>
                                                </div>
                                                <table id="content-link-part1" class="table table-bordered table-striped" style="border: 1px solid silver">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Title Content</th>
                                                            <th class="text-center">Link</th>
                                                            <th class="text-center" style="width: 100px;"><button type="button" id="btn-add-more-content-part1" class="btn btn-primary pull-right btn-add-more-content-part1">More Content <i class="fa fa-plus" style="font-size: 11px;"></i></button></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="tbody_content_link_part1">
                                                        <?php
                                                            if ( isset($data_course_detail_part_satu) and $data_course_detail_part_satu):
                                                                foreach($data_course_detail_part_satu as $dtc):
                                                                    // print_r($dtc);
                                                        ?>                
                                                                <tr>
                                                                    <td><input type="text" class="form-control" name="content_link_title_name_satu[]" value="<?=$dtc->course_title_content?>" placeholder="Title Content" /></td>
                                                                    <td><input type="text" class="form-control" name="content_link_name_satu[]" value="<?=$dtc->course_link_content?>" placeholder="Link (http://www.youtube.com/video)" /></td>
                                                                    <td class="text-center"><input type="hidden" name="content_link_oldname_satu[]" value="" /><button type="button" class="btn btn-sm btn-danger btn-rem-more-content-part1"><i class="fa fa-close"></i></button></td>
                                                                </tr>
                                                        <?php 
                                                                endforeach;
                                                            endif;
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <!-- <td class="text-center"><input type="hidden" name="content_link_part_oldname[]" value="" /><button type="button" class="btn btn-sm btn-danger btn-rem-part-content"><i class="fa fa-close"></i></button></td> -->
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="input-group mb-5">
                                                    <span class="input-group-addon">Part 2</span>
                                                     <select name="course_part_dua[]" id="course_part" class="form-control select2">
                                                        <option value="" selected hidden>-- Choose Course Title Part 2 --</option>
                                                        <?php
                                                            if ( isset($data_course_part_dua) and $data_course_part_dua ):
                                                                foreach($data_course_part_dua as $coursePart):
                                                                    if ( $course_part_id_dua == $coursePart->course_part_id )
                                                                    echo '<option value="'.$coursePart->course_part_id.'" selected="selected">'.'['.$coursePart->part_into.'] - '.$coursePart->course_part_title.'</option>';
                                                                else
                                                                    echo '<option value="'.$coursePart->course_part_id.'">'.'['.$coursePart->part_into.'] - '.$coursePart->course_part_title.'</option>';
                                                                endforeach;
                                                            endif;
                                                        ?>
                                                    </select>
                                                </div>
                                                <table id="content-link-part2" class="table table-bordered table-striped" style="border: 1px solid silver">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Title Content</th>
                                                            <th class="text-center">Link</th>
                                                            <th class="text-center" style="width: 100px;"><button type="button" id="btn-add-more-content-part2" class="btn btn-primary pull-right btn-add-more-content-part2">More Content <i class="fa fa-plus" style="font-size: 11px;"></i></button></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="tbody_content_link_part2">
                                                        <?php
                                                            if ( isset($data_course_detail_part_dua) and $data_course_detail_part_dua):
                                                                foreach($data_course_detail_part_dua as $dtc):
                                                        ?>                
                                                                <tr>
                                                                    <td><input type="text" class="form-control" name="content_link_title_name_dua[]" value="<?=$dtc->course_title_content?>" placeholder="Title Content" /></td>
                                                                    <td><input type="text" class="form-control" name="content_link_name_dua[]" value="<?=$dtc->course_link_content?>" placeholder="Link (http://www.youtube.com/video)" /></td>
                                                                    <td class="text-center"><input type="hidden" name="content_link_oldname_dua[]" value="" /><button type="button" class="btn btn-sm btn-danger btn-rem-more-content-part2"><i class="fa fa-close"></i></button></td>
                                                                </tr>
                                                        <?php 
                                                                endforeach;
                                                            endif;
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <!-- <td class="text-center"><input type="hidden" name="content_link_part_oldname[]" value="" /><button type="button" class="btn btn-sm btn-danger btn-rem-part-content"><i class="fa fa-close"></i></button></td> -->
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="input-group mb-5">
                                                    <span class="input-group-addon">Part 3</span>
                                                     <select name="course_part_tiga[]" id="course_part" class="form-control select2">
                                                        <option value="" selected hidden>-- Choose Course Title Part 3 --</option>
                                                        <?php
                                                            if ( isset($data_course_part_tiga) and $data_course_part_tiga ):
                                                                foreach($data_course_part_tiga as $coursePart):
                                                                    if ( $course_part_id_tiga == $coursePart->course_part_id )
                                                                        echo '<option value="'.$coursePart->course_part_id.'" selected="selected">'.'['.$coursePart->part_into.'] - '.$coursePart->course_part_title.'</option>';
                                                                    else
                                                                        echo '<option value="'.$coursePart->course_part_id.'">'.'['.$coursePart->part_into.'] - '.$coursePart->course_part_title.'</option>';
                                                                endforeach;
                                                            endif;
                                                        ?>
                                                    </select>
                                                </div>
                                                <table id="content-link-part3" class="table table-bordered table-striped" style="border: 1px solid silver">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Title Content</th>
                                                            <th class="text-center">Link</th>
                                                            <th class="text-center" style="width: 100px;"><button type="button" id="btn-add-more-content-part3" class="btn btn-primary pull-right btn-add-more-content-part3">More Content <i class="fa fa-plus" style="font-size: 11px;"></i></button></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="tbody_content_link_part3">
                                                        <?php
                                                            if ( isset($data_course_detail_part_tiga) and $data_course_detail_part_tiga):
                                                                foreach($data_course_detail_part_tiga as $dtc):
                                                        ?>                
                                                                <tr>
                                                                    <td><input type="text" class="form-control" name="content_link_title_name_tiga[]" value="<?=$dtc->course_title_content?>" placeholder="Title Content" /></td>
                                                                    <td><input type="text" class="form-control" name="content_link_name_tiga[]" value="<?=$dtc->course_link_content?>" placeholder="Link (http://www.youtube.com/video)" /></td>
                                                                    <td class="text-center"><input type="hidden" name="content_link_oldname_tiga[]" value="" /><button type="button" class="btn btn-sm btn-danger btn-rem-more-content-part3"><i class="fa fa-close"></i></button></td>
                                                                </tr>
                                                        <?php 
                                                                endforeach;
                                                            endif;
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <!-- <td class="text-center"><input type="hidden" name="content_link_part_oldname[]" value="" /><button type="button" class="btn btn-sm btn-danger btn-rem-part-content"><i class="fa fa-close"></i></button></td> -->
                                        </tr>
                                        

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="hidden" name="id" id="id" value="<?=$id_course?>" />
                        <button type="submit" id="save" class="btn btn-primary pull-right">Save</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </section>
</div>

<script src="<?=base_url("assets/plugins/jQuery/jquery-2.2.3.min.js")?>"></script>
<script src="//cdn.ckeditor.com/4.16.2/full/ckeditor.js"></script>

<script>

    <?php
        $render_course_category = '<option value="">Pilih ISO</option>';
        if ( isset($data_course_category) and $data_course_category ):
            foreach($data_course_category as $t):
                $render_course_category .= '<option value="'.$t->id.'">'.$t->namaCategory.'</option>';
            endforeach;
        endif;
    ?>
        var data_course_category = '<?=$render_course_category?>';
    
    $(document).ready(function() {

        $('.price').maskNumber({integer: true});

        $('.select2').select2();

        CKEDITOR.replace( 'desc' );
        $('input[name=expired_at]').datepicker({
            format: 'dd MM yyyy',
            todayHighlight: true
        });

        // $('input[name=end_date]').datepicker({
        //     format: 'dd MM yyyy',
        //     todayHighlight: true
        // });
    });

    $("#save").on("click", function() {
        var description = CKEDITOR.instances['desc'].getData();
        $('#desc').text(description);
    });

</script>