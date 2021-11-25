<?php defined('BASEPATH') OR exit("No direct script access allowed");
/***
*
* @Author		: Maha Andar
* @Module       : Maps Restaurant
* @Type         : View
* @Date Create	: 17 May 2021
*
***/
// $facility_arr = [
//     "1" => "Wifi",
//     "2" => "Toilet",
//     "3" => "Tempat Parkir",
//     "4" => "Musholla"
// ];
?>
<div class="content-wrapper">
    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title mt-5"><?=$page_title?></h3>
                <a href="<?=base_url("{$page_curr}/forms")?>" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus"></i></a>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table id="dt" class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 20px;">NO</th>
                                    <th class="text-center" style="width: 50ex;">Course Name</th>
                                    <th class="text-center" style="max-width: 20ex;">Author</th>
                                    <th class="text-center" style="max-width: 20ex;">Course Total</th>
                                    <th class="text-center" style="max-width: 10ex;">Course Price (IDR)</th>
                                    <th class="text-center" style="max-width: 15ex;"><i class="fa fa-cogs"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $no = 1;
                            if ( isset($data) and $data ):
                                foreach($data as $t):
                                    // echo "<pre>";
                                    // print_r($t);
                                    // $phone    = empty($t->phone1) ? "-" : $t->phone1;
                                    // $phone   .= empty($t->phone2) ? " / -" : " / ".$t->phone2;
                                    // $duration = empty($t->duration) ? "-" : $t->duration;
                            ?>
                                <tr>
                                    <td class="text-center"><?=$no?></td>
                                    <td><?=$t->courseTitle?></td>
                                    <td class="text-center"><?=$t->authorName?></td>
                                    <td class="text-center"><?=$t->authorCourses?></td>
                                    <td class="text-right"><?=number_format($t->price,0,",",".")?></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-primary btn-view-detail mr-5" data-id="<?=$t->id?>" data-uri="<?=base_url("{$page_curr}/view")?>" title="Ubah Data"><i class="fa fa-eye"></i></button>
                                        <a class="btn btn-sm btn-warning btn-edit mr-5" href="<?=base_url("{$page_curr}/forms?id=".$t->id)?>" title="Ubah Data"><i class="fa fa-edit"></i></a> 
                                        <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="<?=$t->id?>" data-name="<?=$t->courseTitle?>" data-uri="<?=base_url("{$page_curr}/dels")?>" title="Hapus Data"><i class="fa fa-close"></i></button>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                                endforeach;
                            endif;
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div id="modal-default" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close text-red" data-dismiss="modal" tabindex="-1">×</button>
                <h4 class="modal-title strong"><?=$page_title?> Detail</h4>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-12" style="font-size: 3ex;">
                        <i class="fa fa-info text-center" style="background: #0095ff; width:2ex; color:white; border-radius:5px"></i> <label>Informasi</label>
                    </div>
                </div>
                <hr style="margin: revert;"/>

                <div class="row clearfix">
                    <div class="col-md-12 form-group" style="align-items: center; display:grid">
                        <!-- <label>Photo : </label> -->
                        <div class="input-group" id="image_news">
                           
                        </div>
                    </div>                      
                </div>

                <div class="row clearfix">
                    <div class="col-md-6 form-group">
                        <label>Judul : </label>
                        <div class="input-group">
                            <span id="title"></span>
                        </div>
                    </div>
                
                    <div class="col-md-6 form-group">
                        <label>Expired Date : </label>
                        <div class="input-group">
                            <span id="expired_at"></span>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-md-12 form-group">
                        <label>Deskripsi : </label>
                        <div class="input-group text-justify">
                            <span id="desc"></span>
                        </div>
                    </div>                                               
                </div>

            </div>
        </div>
    </div>
</div>
