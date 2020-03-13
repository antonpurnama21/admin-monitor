<div id="modalContainer" class="modal-block modal-block-warning mfp-hide">
    <?=form_open($formAction,array('id'=>'modalForm'))?>
    <section class="card">
        <div class="card-body">
            <div class="modal-wrapper">
                <div class="modal-icon">
                    <i class="fas fa-info-circle"></i>
                </div>
                <div class="modal-text">
                    <h4><?=ucwords($modalTitle)?></h4>
                    <p>please choose a maximum of 3 devices to test</p>
                    <input type="hidden" name="id_ms_trans" value="<?=$id_ms_trans?>">
                    <input type="hidden" name="id_ms_form" value="<?=$id_ms_form?>">
                    <?php if(!empty($dMaster)){
                        foreach ($dMaster as $key) {?>
                        
                        <div class="checkbox-custom checkbox-default">
                            <input value="<?=$key->id_device?>" type="checkbox" name="id_device[]"/>
                            <label><?=$key->device_name?> @<?=cek_create_checker($id_ms_trans, $key->id_device)?></label>
                        </div>
                    <?php }}else{ ?>
                        <p>No Devices Registered !!</p>
                    <?php }?>
                    <label class="error" for="id_device[]"></label>
                </div>
            </div>
        </div>
        <footer class="card-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button class="btn btn-default modal-confirm">Confirm</button>
                    <a href="#" class="btn btn-default modal-dismiss">Cancel</a>
                </div>
            </div>
        </footer>
    </section>
    <?=form_close()?>
</div>