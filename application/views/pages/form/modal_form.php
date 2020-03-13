<div id="modalContainer" class="modal-block modal-block-primary">
    <section class="card">
        <header class="card-header">
            <h2 class="card-title"><?=ucwords($modalTitle)?></h2>
        </header>
        <div class="card-body">
            <input type="hidden" name="type_tc" id="type_tc" value="<?= base_url('commonfunction/get_type_tc') ?>">
            <?php echo form_open($formAction,array('id'=>'modalForm')); ?>
            <input type="hidden" name="id_ms_form" id="id_ms_form" value="<?= isset($dMaster->id_ms_form) ? base64_encode($dMaster->id_ms_form) : '' ?>">
            <div class="form-group row">
                <label class="col-sm-3 control-label text-sm-right pt-2">Form Name <span class="required">*</span></label>
                <div class="col-sm-8">
                    <input name="name_form" id="name_form" value="<?= isset($dMaster->name_form) ? $dMaster->name_form : '' ?>" type="text" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="type" class="col-sm-3 control-label text-sm-right pt-2">Type Testcase <span class="required">*</span></label>
                <div class="col-sm-8">                                                
                    <select id="type_id" name="type_id" class="form-control mb-3" title="Please select Type" required>
                        <option value="null">--</option>
                        <option value="<?= (isset($dMaster->id_type)) ? $dMaster->id_type : '' ?>" <?php if(isset($dMaster->id_type)){ echo "selected"; } ?>><?= (isset($dMaster->id_type)) ? $dMaster->id_type.'::'.name_type($dMaster->id_type) : '' ?></option>
                    </select>
                </div>
            </div>
            <div class="col-lg-12 pull-right">
                <div class="pull-right">
                    <a href="#" class="btn btn-default modal-dismiss btn-sm">Cancel</a>
                    <button class="btn btn-primary modal-confirm btn-sm">Submit</button>
                </div>
            </div>
            <?php echo form_close(); ?>         
        </div>
    </section>
</div>