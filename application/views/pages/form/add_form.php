<div class="row">
    <div class="col-lg-10">
        <?php if(!empty($this->session->flashdata('feedback'))){ ?>
        <div class="alert alert-danger">
            <?php echo $this->session->flashdata('feedback')?>
        </div>
        <?php
            }
        ?>                            
        <?php if(!empty($message)){ ?>
            <div class="alert alert-danger">
                <?php echo validation_errors(); ?>
                <?php echo @$message; ?>
                <?php echo @$captchaMessage; ?>
            </div>
        <?php
            }
        ?>
            <section class="card">
                <header class="card-header">
                    <div class="card-actions">
                        <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                        <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                    </div>

                    <h2 class="card-title">Create New Form</h2>
                    <p class="card-subtitle">
                        Insert Test name and choose type
                    </p>
                </header>

                <div class="card-body">
                    <input type="hidden" name="type_tc" id="type_tc" value="<?= base_url('commonfunction/get_type_tc') ?>">
                    <?php echo form_open($formAction,array('id'=>'add_form')); ?>
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
                            <a href="<?=base_url('testcase/form_list')?>" class="btn btn-default btn-sm">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                    
                </div>
            </section>
        </form>
    </div>
</div>