<?php defined('BASEPATH') OR exit("No direct script access allowed");
$part_into = [
    "Part 1" => "Part 1",
    "Part 2" => "Part 2",
    "Part 3" => "Part 3",
];
?>
<div class="content-wrapper">
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title mt-5"><?=$page_title?></h3>
                <a href="javascript:;" class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-target="#modal-default" data-keyboard="false" data-backdrop="static"><i class="fa fa-plus"></i></a>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table id="dt" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Part Course</th>
                                    <th>Course Part Content Name</th>
                                    <th><i class="fa fa-cogs"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $no = 0;
                            if (isset($data) and $data){
                                foreach($data as $t){
                                $no++;
                            ?>
                                <tr>
                                    <td class="fit"><?=$no?></td>
                                    <td><?=$t->part_into?></td>
                                    <td><?=$t->course_part_title?></td>
                                    <td class="fit">
                                        <button type="button" class="btn btn-sm btn-warning btn-edit mr-5" data-id="<?=$t->course_part_id?>" data-uri="<?=base_url("{$page_curr}/edit")?>" title="Ubah Data"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="<?=$t->course_part_id?>" data-name="<?=$t->course_part_title?>" data-uri="<?=base_url("{$page_curr}/dels")?>" title="Hapus Data"><i class="fa fa-close"></i></button>
                                    </td>
                                </tr>
                            <?php
                                }
                            }
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
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="<?=base_url("{$page_curr}/save")?>" method="POST" id="form-default" accept-charset="UTF-8">
                <div class="modal-header">
                    <button type="button" class="close text-red" data-dismiss="modal" tabindex="-1">×</button>
                    <h4 class="modal-title strong"><?=$page_title?></h4>
                </div>
                <div class="modal-body">
                    <div class="row clearfix">
                        <div class="col-md-12 form-group">
                            <label>Part Into</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-check text-blue"></i></span>
                                <select name="part_into" id="part_into" class="form-control" required>
                                    <option value="">- Choose Part -</option>
                                    <?php
                                    if ( isset($part_into) and $part_into ):
                                        foreach($part_into as $key=>$val):
                                            echo "<option value=\"{$key}\">{$val}</option>";
                                        endforeach;
                                    endif;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Course Part Name <span class="text-red">*</span></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-file-text text-blue"></i></span>
                                <input type="text" name="name" id="name" maxlength="50" class="form-control" required="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="text" class="collapse" id="id" name="id" />
                    <div class="info-modal callout callout-warning text-center">Harap isi semua yang bertanda *</div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>	