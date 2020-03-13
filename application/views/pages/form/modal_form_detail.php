<div id="modalContainer" class="modal-block modal-block-lg mfp-hide">
    <section class="card">
        <header class="card-header">
            <h2 class="card-title"><?=$modalTitle?></h2>
        </header>
        <div class="card-body">
            <input type="hidden" name="getparent" id="getparent" value="<?= base_url('commonfunction/get_parent') ?>">
            <?php echo form_open($formAction,array('id'=>'modalForm')); ?>
            <input type="hidden" name="id_ms_form" id="id_ms_form" value="<?= isset($dMaster->id_ms_form) ? base64_encode($dMaster->id_ms_form) : $dMaster['id_ms_form'] ?>">
            <input type="hidden" name="id_dt_form" id="id_dt_form" value="<?= isset($dMaster->id_dt_form) ? base64_encode($dMaster->id_dt_form) : '' ?>">
            <div class="form-group row">
                <label for="parent_id" class="col-sm-3 control-label text-sm-right pt-2">Select Parent</label>
                <div class="col-sm-8">                                        
                    <select id="parent_id" data-plugin-selectTwo name="parent_id" class="form-control mb-3">
                        <option value="null">--</option>
                        <option value="<?= (isset($dMaster->parent_id)) ? $dMaster->parent_id : '' ?>" <?php if(isset($dMaster->parent_id)){ echo "selected"; } ?>><?= (isset($dMaster->parent_id)) ? $dMaster->parent_id.'::'.name_testcase($dMaster->parent_id) : '' ?></option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 control-label text-sm-right pt-2">Testcase Name <span class="required">*</span></label>
                <div class="col-sm-8">
                    <input type="text" id="testcase_name" name="testcase_name[]" value="<?= isset($dMaster->tc_name) ? $dMaster->tc_name : '' ?>" class="form-control" required/>
                </div>
                <?php if(!isset($dMaster->tc_name)){?>
                <div class="ml-3 mt-2">
                    <a href="javascript:void(0);" class="addWrap btn btn-default btn-sm"><li class="fas fa-plus"></li></a>
                </div>
                <?php }?>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 control-label text-sm-right pt-2">Description</label>
                <div class="col-sm-8">
                    <textarea name="description[]" id="description" rows="2" class="form-control"><?= isset($dMaster->description) ? $dMaster->description : '' ?></textarea>
                </div>
            </div>
            
            <div id="rowsplus"></div>

            <div class="col-lg-12 mt-2 pull-right">
                <div class="pull-right">
                    <a href="#" class="btn btn-default modal-dismiss btn-sm">Cancel</a>
                    <button class="btn btn-primary modal-confirm btn-sm">Submit</button>
                </div>
            </div>

            <?=form_close();?>
            
        </div>
    </section>
</div>