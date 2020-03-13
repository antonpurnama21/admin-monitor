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
                <table class="table table-bordered table-striped display nowrap" id="datatable-default" style="width:100%">
                    <thead>
                        <tr class="text-center">
                            <th width="5%">No</th>
                            <th width="10%">ID Device</th>
                            <th width="50%">Device Name</th>
                            <th width="20%">Type</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if (!empty($data)) {
                            $no = 0;
                            foreach ($data as $key) {
                                $no++; ?>
                            <tr>
                                <td><?=$no?></td>
                                <td><?=$key->id_device?></td>
                                <td><?=$key->device_name?></td>
                                <td><?=name_type($key->id_type)?></td>
                                <td class="text-center">
                                    <a class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Edit" onclick="showModal('<?= base_url('device/modalEdit') ?>', '<?= base64_encode($key->id_device).'~'.$key->device_name?>', 'edit');"><i class="icon-pencil"></i></a>                                    
                                    <a class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Delete" onclick="showModal('<?= base_url('device/modalDelete') ?>', '<?= base64_encode($key->id_device).'~'.$key->device_name?>', 'delete');"><i class="icon-trash"></i></a>
                                </td>
                            </tr>
                        
                        <?php }
                        }else{?>
                        <td colspan="5">Empty data ..</td>
                        <?php }?> 
                        
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>