<table class="table table-bordered table-striped display nowrap" id="datatable-default" style="width:100%">
                    <thead>
                        <tr>
                            <th width="10%">Test ID</th>
                            <th width="40%">Test Name</th>
                            <th class="text-right" width="30%">Decription</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($dtDetail)) {
                            foreach ($dtDetail as $key) { 
                                $cek = cekLevel($key->tc_id);
                                if($cek != FALSE){
                                    $disable = 'disabled';
                                }else{
                                    $disable = '';
                                }
                                ?>
                            <tr>
                            <td class="text-center"><?=$key->tc_id?></td>
                            <td class="level0"><?=$key->tc_name?></td>
                            <td class="text-right"><?=$key->description?></td>
                            <td class="text-right">
                                <a class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Edit" onclick="showModal('<?= base_url('testcase/modalEdit_detail') ?>', '<?= base64_encode($key->id_dt_form).'~'.$key->tc_name?>', 'edit');"><i class="icon-pencil"></i></a>
                                <a class="btn btn-default btn-xs <?=$disable?>" data-toggle="tooltip" data-placement="top" title="Delete" onclick="showModal('<?= base_url('testcase/modalDelete_detail') ?>', '<?= base64_encode($key->id_dt_form).'~'.$key->tc_name?>', 'delete');"><i class="icon-trash"></i></a>
                            </td>
                            </tr>

                                <?php
                                $sub1 = $this->mod->getData('result','*','form_dt_tc',null,null,null,array('parent_id'=>$key->tc_id));

                                if (!empty($sub1)) {
                                    foreach ($sub1 as $key1) { 
                                        $cek1 = cekLevel($key1->tc_id);
                                        if($cek1 != FALSE){
                                            $disable = 'disabled';
                                        }else{
                                            $disable = '';
                                        }
                                        ?>
                                        <tr>
                                        <td class="text-center"><?=$key1->tc_id?></td>
                                        <td class="level1"><?=$key1->tc_name?></td>
                                        <td class="text-right"><?=$key1->description?></td>
                                        <td class="text-right">
                                            <a class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Edit" onclick="showModal('<?= base_url('testcase/modalEdit_detail') ?>', '<?= base64_encode($key1->id_dt_form).'~'.$key1->tc_name?>', 'edit');"><i class="icon-pencil"></i></a>
                                            <a class="btn btn-default btn-xs <?=$disable?>" data-toggle="tooltip" data-placement="top" title="Delete" onclick="showModal('<?= base_url('testcase/modalDelete_detail') ?>', '<?= base64_encode($key1->id_dt_form).'~'.$key1->tc_name?>', 'delete');"><i class="icon-trash"></i></a>
                                        </td>
                                        </tr>
                                        <?php
                                        $sub2 = $this->mod->getData('result','*','form_dt_tc',null,null,null,array('parent_id'=>$key1->tc_id));

                                        if (!empty($sub2)) {
                                            foreach ($sub2 as $key2) { 
                                                $cek2 = cekLevel($key2->tc_id);
                                                if($cek2 != FALSE){
                                                    $classLevel = 'level2';
                                                    $disable = 'disabled';
                                                }else{
                                                    $classLevel = 'level3';
                                                    $disable = '';
                                                }
                                                ?>
                                                <tr>
                                                <td class="text-center"><?=$key2->tc_id?></td>
                                                <td class="<?=$classLevel?>"><?=$key2->tc_name?></td>
                                                <td class="text-right"><?=$key2->description?></td>
                                                <td class="text-right">
                                                    <a class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Edit" onclick="showModal('<?= base_url('testcase/modalEdit_detail') ?>', '<?= base64_encode($key2->id_dt_form).'~'.$key2->tc_name?>', 'edit');"><i class="icon-pencil"></i></a>
                                                    <a class="btn btn-default btn-xs <?=$disable?>" data-toggle="tooltip" data-placement="top" title="Delete" onclick="showModal('<?= base_url('testcase/modalDelete_detail') ?>', '<?= base64_encode($key2->id_dt_form).'~'.$key2->tc_name?>', 'delete');"><i class="icon-trash"></i></a>
                                                </td>
                                                </tr>
                                                <?php
                                                $sub3 = $this->mod->getData('result','*','form_dt_tc',null,null,null,array('parent_id'=>$key2->tc_id));

                                                if (!empty($sub3)) {
                                                    foreach ($sub3 as $key3) { 
                                                        $cek3 = cekLevel($key3->tc_id);
                                                        if($cek3 != FALSE){
                                                            $classLevel = 'level3';
                                                            $disable = 'disabled';
                                                        }else{
                                                            $classLevel = 'level3';
                                                            $disable = '';
                                                        }
                                                        ?>
                                                        <tr>
                                                        <td class="text-center"><?=$key3->tc_id?></td>
                                                        <td class="<?=$classLevel?>"><?=$key3->tc_name?></td>
                                                        <td class="text-right"><?=$key3->description?></td>
                                                        <td class="text-right">
                                                            <a class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Edit" onclick="showModal('<?= base_url('testcase/modalEdit_detail') ?>', '<?= base64_encode($key3->id_dt_form).'~'.$key3->tc_name?>', 'edit');"><i class="icon-pencil"></i></a>
                                                            <a class="btn btn-default btn-xs <?=$disable?>" data-toggle="tooltip" data-placement="top" title="Delete" onclick="showModal('<?= base_url('testcase/modalDelete_detail') ?>', '<?= base64_encode($key3->id_dt_form).'~'.$key3->tc_name?>', 'delete');"><i class="icon-trash"></i></a>
                                                        </td>
                                                        </tr>
                                                    <?php }    
                                                    }                               
                                                ?>
                                            <?php }    
                                            }                               
                                        ?>
                                    <?php }    
                                    }                               
                                ?>
                        <?php }
                        }else{?>
                        <td colspan="5">Empty data ..</td>
                        <?php }?>                        
                    </tbody>
                </table>