<div id="modalContainer" class="modal-block modal-block-primary">
    <section class="card">
        <header class="card-header">
            <h2 class="card-title"><?=ucwords($modalTitle)?></h2>
        </header>
        <div class="card-body">
            <?php echo form_open($formAction,array('id'=>'modalForm')); ?>
            <input type="hidden" name="v_id_role" id="v_id_role" value="<?= isset($dMaster->id_role) ? base64_encode($dMaster->id_role) : '' ?>">
            <div class="form-group row">
                <label class="col-sm-3 control-label text-sm-right pt-2">Role Name <span class="required">*</span></label>
                <div class="col-sm-8">
                    <input name="v_role" id="v_role" value="<?= isset($dMaster->role) ? $dMaster->role : '' ?>" type="text" class="form-control" required>
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