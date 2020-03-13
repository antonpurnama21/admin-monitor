<div class="row">
    <div class="col-lg-10">
            <section class="card">
                <header class="card-header">
                    <div class="card-actions">
                        <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                        <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                    </div>

                    <h2 class="card-title">Create New</h2>
                    <p class="card-subtitle">
                        Checker For SetupBox
                    </p>
                </header>

                <div class="card-body">
                    <input type="hidden" name="ms_form" id="ms_form" value="<?= base_url('commonfunction/get_ms_form') ?>">
                    <?php echo form_open($formAction,array('id'=>'add_form')); ?>
                    <input type="hidden" name="id_type" id="id_type" value="<?= isset($id_type) ? $id_type : '' ?>">
                    <div class="form-group row">
                        <label for="type" class="col-sm-3 control-label text-sm-right pt-2">Type Document Form <span class="required">*</span></label>
                        <div class="col-sm-8">                                                
                            <select id="id_ms_form" name="id_ms_form" class="form-control mb-3" required>
                                <option value="null">--</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label text-sm-right pt-2">Project Name</label>
                        <div class="col-sm-8">
                            <input type="text" name="project_name" id="project_name" rows="5" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label text-sm-right pt-2">Device / Version ( While Test )</label>
                        <div class="col-sm-8">
                            <input type="text" name="device_or_version" id="device_or_version" rows="5" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label text-sm-right pt-2">Apk Version</label>
                        <div class="col-sm-8">
                            <input type="text" name="apk_version" id="apk_version" rows="5" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label text-sm-right pt-2">Android Version</label>
                        <div class="col-sm-8">
                            <input type="text" name="android_version" id="android_version" rows="5" class="form-control">
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
                                <input type="text" name="date_test" id="date_test" class="form-control pickadate">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label text-sm-right pt-2">Day Estimation</label>
                        <div class="col-sm-8">
                            <input type="number" id="day_estimate" name="day_estimate" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label text-sm-right pt-2">Modification</label>
                        <div class="col-sm-8">
                            <input type="text" name="modification" id="modification" rows="5" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label text-sm-right pt-2">PIC</label>
                        <div class="col-sm-8">
                            <input type="text" name="pic" id="pic" rows="5" class="form-control">
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
                            <a href="<?=base_url('checker/checker_list')?>" class="btn btn-default btn-sm">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>                    
                </div>
            </section>
        </form>
    </div>
</div>