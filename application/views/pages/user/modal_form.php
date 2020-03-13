<div id="modalContainer" class="modal-block modal-block-primary">
    <section class="card">
        <header class="card-header">
            <h2 class="card-title"><?=ucwords($modalTitle)?></h2>
        </header>
        <div class="card-body">
            <input type="hidden" name="role" id="role" value="<?= base_url('commonfunction/get_role') ?>">
            <?php echo form_open($formAction,array('id'=>'modalForm')); ?>
            <input type="hidden" name="id_user" id="id_user" value="<?= isset($dMaster->id_user) ? base64_encode($dMaster->id_user) : '' ?>">
            <div class="form-group row">
                <label for="type" class="col-sm-3 control-label text-sm-right pt-2">Role Access <span class="required">*</span></label>
                <div class="col-sm-8">                                                
                    <select id="id_role" name="id_role" class="form-control mb-3" title="Please select Type" required>
                        <option value="">--</option>
                        <option value="<?= (isset($dMaster->id_role)) ? $dMaster->id_role : '' ?>" <?php if(isset($dMaster->id_role)){ echo "selected"; } ?>><?= (isset($dMaster->id_role)) ? $dMaster->id_role.'::'.role_name($dMaster->id_role) : '' ?></option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 control-label text-sm-right pt-2">Firstname <span class="required">*</span></label>
                <div class="col-sm-8">
                    <input name="firstname" id="firstname" value="<?= isset($dMaster->firstname) ? $dMaster->firstname : '' ?>" type="text" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 control-label text-sm-right pt-2">Lastname <span class="required">*</span></label>
                <div class="col-sm-8">
                    <input name="lastname" id="lastname" value="<?= isset($dMaster->lastname) ? $dMaster->lastname : '' ?>" type="text" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 control-label text-sm-right pt-2">Email <span class="required">*</span></label>
                <div class="col-sm-8">
                    <input name="email" id="email" value="<?= isset($dMaster->email) ? $dMaster->email : '' ?>" type="email" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 control-label text-sm-right pt-2">Password <span class="required">*</span></label>
                <div class="col-sm-8">
                    <input name="password" id="password" value="<?= isset($dMaster->password) ? $dMaster->password : '' ?>" type="password" class="form-control" required>
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