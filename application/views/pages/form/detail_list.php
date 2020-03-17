<div class="row">
    <div class="col">
        <section class="card">
            <header class="card-header">
                <div class="card-actions">
                    <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                    <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                </div>

                <h2 class="card-title">Form Detail ( <?=get_form_name(base64_decode($id_ms_form))?> )</h2>
            </header>
            
            <div class="card-body">
                <div class="pull-right">
                    <a onclick="showModal('<?= base_url('testcase/modalAdd_detail') ?>', '<?=$id_ms_form?>', 'addDetail');" class="btn btn-default btn-sm"><i class="icon-add position-left" data-toggle="tooltip" data-placement="top" title="Add New"></i> Create Testcase</a>
                </div><br><br>
                <?=$this->table->generate()?>
            </div>
        </section>
    </div>
</div>