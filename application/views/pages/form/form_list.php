<div class="row">
    <div class="col">
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

                <h2 class="card-title">Form List</h2>
            </header>
            
            <div class="card-body">
                <div class="pull-right">
                    <a href="<?=base_url('testcase/add_form')?>" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="Add New"><i class="icon-add position-left"></i> Create Form</a>
                </div><br><br>
                <table class="table table-bordered table-striped display nowrap" id="datatable-default" style="width:100%">
                    <thead>
                        <tr class="text-center">
                            <th width="5%">No</th>
                            <th width="10%">ID Form</th>
                            <th width="20%">Form Name</th>
                            <th width="20%">Type</th>
                            <th width="30%">Decription</th>
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
                                <td><?=$key->id_ms_form?></td>
                                <td><?=$key->name_form?></td>
                                <td><?=name_type($key->id_type)?></td>
                                <td><?=$key->description?></td>
                                <td class="text-center">
                                    <a class="btn btn-default btn-xs" href="<?=base_url('testcase/detail_form/'.base64_encode($key->id_ms_form))?>"><i class="icon-eye"></i></a>
                                    <a class="btn btn-default btn-xs" onclick="showModal('<?= base_url('testcase/modalEdit_form') ?>', '<?= base64_encode($key->id_ms_form).'~'.$key->name_form?>', 'edit');"><i class="icon-pencil"></i></a>                                    
                                    <a class="btn btn-default btn-xs" onclick="showModal('<?= base_url('testcase/modalDelete_form') ?>', '<?= base64_encode($key->id_ms_form).'~'.$key->name_form?>', 'delete');"><i class="icon-trash"></i></a>
                                </td>
                            </tr>
                        
                        <?php }
                        }else{?>
                        <td colspan="6">Empty data ..</td>
                        <?php }?> 
                        
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>