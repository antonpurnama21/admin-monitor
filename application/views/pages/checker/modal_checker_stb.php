<div id="modalContainer" class="modal-block modal-block-primary">
    <section class="card">
        <header class="card-header">
            <h2 class="card-title"><?=ucwords($modalTitle)?></h2>
        </header>
        <div class="card-body">
            <input type="hidden" name="ms_form" id="ms_form" value="<?= base_url('commonfunction/get_ms_form') ?>">
            <?php echo form_open($formAction,array('id'=>'modalForm')); ?>
            <input type="hidden" name="id_type" id="id_type" value="<?= isset($id_type) ? $id_type : '' ?>">
            <input type="hidden" name="id_ms_trans" id="id_ms_trans" value="<?= isset($dMaster->id_ms_trans) ? base64_encode($dMaster->id_ms_trans) : '' ?>">
            <div class="form-group row">
                <label for="type" class="col-sm-3 control-label text-sm-right pt-2">Type Document Form <span class="required">*</span></label>
                <div class="col-sm-8">                                                
                    <select id="id_ms_form" name="id_ms_form" class="form-control mb-3" required>
                        <option value="null">--</option>
                        <option value="<?= (isset($dMaster->id_ms_form)) ? $dMaster->id_ms_form : '' ?>" <?php if(isset($dMaster->id_ms_form)){ echo "selected"; } ?>><?= (isset($dMaster->id_ms_form)) ? name_form($dMaster->id_ms_form) : '' ?></option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 control-label text-sm-right pt-2">Project Name</label>
                <div class="col-sm-8">
                    <input type="text" name="project_name" id="project_name" value="<?= (isset($dMaster->project_name)) ? $dMaster->project_name : '' ?>" rows="5" class="form-control">
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-3 control-label text-sm-right pt-2">Device / Version ( While Test )</label>
                <div class="col-sm-8">
                    <input type="text" name="device_or_version" id="device_or_version" value="<?= (isset($dMaster->device_or_version)) ? $dMaster->device_or_version : '' ?>" rows="5" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 control-label text-sm-right pt-2">Apk Version</label>
                <div class="col-sm-8">
                    <input type="text" name="apk_version" id="apk_version" value="<?= (isset($dMaster->apk_version)) ? $dMaster->apk_version : '' ?>" rows="5" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 control-label text-sm-right pt-2">Android Version</label>
                <div class="col-sm-8">
                    <input type="text" name="android_version" id="android_version" value="<?= (isset($dMaster->android_version)) ? $dMaster->android_version : '' ?>" rows="5" class="form-control pickadate">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 control-label text-lg-right pt-2">Date</label>
                <div class="col-lg-8">
                    <div class="input-group">
                        <span class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-calendar-alt"></i>
                            </span>
                        </span>
                        <input type="text" autocomplete="off" name="date_test" id="date_test" value="<?= (isset($dMaster->date)) ? date_format(date_create($dMaster->date), 'd-m-Y') : '' ?>" readonly class="form-control pickadate">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 control-label text-sm-right pt-2">Modification</label>
                <div class="col-sm-8">
                    <input type="text" name="modification" id="modification" value="<?= (isset($dMaster->modification)) ? $dMaster->modification : '' ?>" rows="5" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 control-label text-sm-right pt-2">PIC</label>
                <div class="col-sm-8">
                    <input type="text" name="pic" id="pic" value="<?= (isset($dMaster->pic)) ? $dMaster->pic : '' ?>" rows="5" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 control-label text-sm-right pt-2">Developed BY</label>
                <div class="col-sm-8">
                    <input type="text" name="developed_by" id="developed_by" value="Dens.TV & Codelabs " rows="5" class="form-control" readonly>
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