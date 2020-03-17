<div id="modalContainer" class="modal-block modal-block-primary">
    <section class="card">
        <header class="card-header">
            <h2 class="card-title"><?=ucwords($modalTitle)?></h2>
        </header>
        <div class="card-body">
            <input type="hidden" name="getType" id="getType" value="<?= base_url('commonfunction/get_type_tc') ?>">
            <?php echo form_open($formAction,array('id'=>'modalForm')); ?>
            <input type="hidden" name="v_id_device" id="v_id_device" value="<?= isset($dMaster->id_device) ? base64_encode($dMaster->id_device) : '' ?>">
            <div class="form-group row">
                <label for="type" class="col-sm-3 control-label text-sm-right pt-2">Select Type <span class="required">*</span></label>
                <div class="col-sm-8">                                                
                    <select id="v_id_type" name="v_id_type" class="form-control mb-3" title="Please select Type" required>
                        <option value="">Select Type</option>
                        <option value="<?= (isset($dMaster->id_type)) ? $dMaster->id_type : '' ?>" <?php if(isset($dMaster->id_type)){ echo "selected"; } ?>><?= (isset($dMaster->id_type)) ? $dMaster->id_type.'::'.name_type($dMaster->id_type) : '' ?></option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 control-label text-sm-right pt-2">Device Name <span class="required">*</span></label>
                <div class="col-sm-8">
                    <input name="v_device_name" id="v_device_name" value="<?= isset($dMaster->device_name) ? $dMaster->device_name : '' ?>" type="text" class="form-control" required>
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