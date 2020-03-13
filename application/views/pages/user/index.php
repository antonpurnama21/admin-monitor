<div class="row">
    <div class="col">
        <section class="card">
            <header class="card-header">
                <div class="card-actions">
                    <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                    <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                </div>

                <h2 class="card-title">User List</h2>
            </header>
            
            <div class="card-body">
                <div class="pull-right">
                    <a onclick="showModal('<?= base_url('user/modalAdd') ?>', '', 'add');" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="Add New"><i class="icon-add position-left"></i> New user</a>
                </div><br><br>
                <table class="table table-bordered table-striped display nowrap" id="datatable-default" style="width:100%">
                    <thead>
                        <tr class="text-center">
                            <th width="5%">No</th>
                            <th width="5%">ID user</th>
                            <th width="30%">Email</th>
                            <th width="20%">Firstname</th>
                            <th width="20%">Lastname</th>
                            <th width="10%">Role</th>
                            <th width="10%">Action</th>
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
                                <td><?=$key->id_user?></td>
                                <td><?=$key->email?></td>
                                <td><?=$key->firstname?></td>
                                <td><?=$key->lastname?></td>
                                <td><?=role_name($key->id_role)?></td>
                                <td class="text-center">
                                    <a class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Edit" onclick="showModal('<?= base_url('user/modalEdit') ?>', '<?= base64_encode($key->id_user).'~'.$key->firstname?>', 'edit');"><i class="icon-pencil"></i></a>                                    
                                    <a class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Delete" onclick="showModal('<?= base_url('user/modalDelete') ?>', '<?= base64_encode($key->id_user).'~'.$key->firstname?>', 'delete');"><i class="icon-trash"></i></a>
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