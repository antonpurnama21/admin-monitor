<div id="modalContainer" class="modal-block modal-block-warning mfp-hide">
    <?=form_open($formAction,array('id'=>'modalForm'))?>
    <section class="card">
        <div class="card-body">
            <div class="modal-wrapper">
                <div class="modal-icon">
                    <i class="fas fa-question-circle"></i>
                </div>
                <input type="hidden" name="id" id="id" value="<?=$id?>">
                <div class="modal-text">
                    <h4><?=ucwords($modalTitle)?></h4>
                    <p>Are you sure that you want to delete this data ?</p>
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

