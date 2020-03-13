
<div class="row">
    <div class="col">
        <section class="card">
            <header class="card-header">
                <div class="card-actions">
                    <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                    <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                </div>

                <h2 class="card-title">checker List</h2>
            </header>
            
            <div class="card-body">
                <div class="pull-right">
                    <a onclick="showModal2('<?= base_url('checker/modalAdd_splash') ?>', '', 'add');" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="Add New"><i class="icon-add position-left"></i> Create checker</a>
                </div><br><br>
                <table class="table table-bordered table-striped display nowrap" id="datatable-default" style="width:100%">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>ID Checker</th>
                            <th>Date</th>
                            <th>Project Name</th>
                            <th>Device / Version</th>
                            <th>Apk Version</th>
                            <th>Android Version</th>
                            <th>Modification</th>
                            <th>PIC</th>
                            <th>Developed BY</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if (!empty($data)) {
                            $no = 0;
                            foreach ($data as $key) {
                                $no++;
                                ?>
                            <tr>
                                <td><?=$no?></td>
                                <td><?=$key->id_ms_trans?></td>
                                <td><?php if($key->date != '0000-00-00') { echo date_format(date_create($key->date), 'd F Y'); }else{ ''; }?></td>
                                <td><?=$key->project_name?></td>
                                <td><?=$key->device_or_version?></td>
                                <td><?=$key->apk_version?></td>
                                <td><?=$key->android_version?></td>
                                <td><?=$key->modification?></td>
                                <td><?=$key->pic?></td>
                                <td><?=$key->developed_by?></td>
                                <td class="text-center">
                                    <!-- <a class="btn btn-default btn-xs" href="<?=base_url('checker/detail_checker/'.$key->id_ms_trans)?>"><i class="icon-eye"></i></a> -->
                                    <a class="btn btn-default btn-xs" onclick="showModal2('<?= base_url('checker/modalSplashDetail') ?>', '<?= base64_encode($key->id_ms_trans).'~'.$key->project_name?>', 'splash');"><i class="icon-eye"></i></a>
                                    <a class="btn btn-default btn-xs" onclick="showModal('<?= base_url('checker/modalEdit') ?>', '<?= base64_encode($key->id_ms_trans).'~'.$key->project_name?>', 'edit');"><i class="icon-pencil"></i></a>                                    
                                    <a class="btn btn-default btn-xs" onclick="showModal('<?= base_url('checker/modalDelete') ?>', '<?= base64_encode($key->id_ms_trans).'~'.$key->project_name?>', 'delete');"><i class="icon-trash"></i></a>
                                </td>
                            </tr>
                        
                        <?php }
                        }else{?>
                        <td colspan="11">Empty data ..</td>
                        <?php }?> 
                        
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>