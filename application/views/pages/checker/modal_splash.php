<div id="modalContainer" class="modal-block modal-block-primary">
    <section class="card">
        <header class="card-header">
            <h2 class="card-title"><?=ucwords($modalTitle)?></h2>
        </header>
        <div class="card-body">
            <input type="hidden" name="type_tc" id="type_tc" value="<?= base_url('commonfunction/get_type_tc') ?>">
            <?php echo form_open($formAction,array('id'=>'modalSplash')); ?>
            <div class="form-group row">
                <label for="type" class="col-sm-3 control-label text-sm-right pt-2">Type Testcase <span class="required">*</span></label>
                <div class="col-sm-8">                                                
                    <select id="id_type" name="id_type" class="form-control mb-3" title="Please select Type" required>
                        <option value="null">--</option>
                        <option value="<?= (isset($dMaster->id_type)) ? $dMaster->id_type : '' ?>"><?= (isset($dMaster->id_type)) ? $dMaster->id_type.'::'.name_type($dMaster->id_type) : '' ?></option>
                    </select>
                </div>
            </div>
            <div class="col-lg-12 pull-right">
                <div class="pull-right">
                    <a href="#" class="btn btn-default modal-dismiss btn-sm">Cancel</a>
                    <button class="btn btn-primary modal-confirm btn-sm">Next</button>
                </div>
            </div>
            <?php echo form_close(); ?>         
        </div>
    </section>
</div>