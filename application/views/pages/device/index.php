<div class="row">
    <div class="col">
        <section class="card">
            <header class="card-header">
                <div class="card-actions">
                    <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                    <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                </div>

                <h2 class="card-title">Device List</h2>
            </header>
            
            <div class="card-body">
                <div class="pull-right">
                    <a onclick="showModal('<?= base_url('device/modalAdd') ?>', '', 'add');" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="Add New"><i class="icon-add position-left"></i> New Device</a>
                </div><br><br>

                <?=$this->table->generate()?>
                
            </div>
        </section>
    </div>
</div>