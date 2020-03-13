<div class="row">
    <div class="col">
        <section class="card">
            <header class="card-header">
                <div class="card-actions">
                    <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                    <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                </div>

                <h2 class="card-title">Checker Testcase Detail</h2>
            </header>

            <?php $device = getData('result','*','device_tc');
                foreach ($device as $keyt) {
                    echo $keyt->id_device;
                    echo $keyt->device_name;
                }
                    
            ?>
            
            <div class="card-body">
                <table class="table table-bordered table-striped display nowrap" id="datatable-default" style="width:100%">
                    <thead>
                        <?php if($countD >= 3){
                            $wid = '40%';
                        }else{
                            $wid = '20%';
                        }?>
                        <tr class="center">
                            <th width="5%" rowspan="2">Test ID</th>
                            <th width="40%" rowspan="2">Test Name</th>
                            <th width="<?=$wid?>" colspan ="<?=$countD?>">Result</th>
                            <th width="30%" rowspan="2">Decription</th>
                            <th width="20%" rowspan="2">Comment</th>
                        </tr>
                        <tr>
                        <?php if (!empty($dtDevice)) {
                            foreach ($dtDevice as $key) {?>
                            <th><?=$key->device_name?></th>
                        <?php
                            }
                        }?>
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
                            <?php for ($i=0; $i < $countD; $i++) { ?>
                                <td></td>
                            <?php } ?>
                            <td class="text-right"><?=$key->description?></td>
                            <td></td>
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
                                        <?php foreach ($dtDevice as $keypp) :
                                            $cek_detail_trans = cek_value_exsist($key1->tc_id, $keypp->id_device);
                                            if ($cek_detail_trans == FALSE) {
                                                $insert_data = $this->mod->insertData('trans_dt_tc', array(
                                                    'id_dt_trans' => $this->mod->autoNumber('id_dt_trans','trans_dt_tc','111',3),
                                                    'id_ms_trans' => $id_ms_trans,
                                                    'id_ms_form'  => $id_ms_form,
                                                    'tc_id'       => $key1->tc_id,
                                                    'id_device'   => $keypp->id_device,
                                                    'value'       => 'n/t',
                                                    'created_at'  => date('Y-m-d h:i:sa')
                                                ));
                                            }
                                            $dtrans = $this->mod->getData('row','value','trans_dt_tc',null,null,null,array('tc_id'=>$key1->tc_id,'id_device'=>$keypp->id_device,'id_ms_trans'=>$id_ms_trans));
                                            $val = (isset($dtrans->value)) ? $dtrans->value : '';
                                            if ($cek1 == FALSE) { ?>
                                                <td>
                                                    <select data-tc_id="<?=$key1->tc_id?>" data-url="<?=base_url('checker/do_check')?>" data-dv_id="<?=$keypp->id_device?>" class="param_cek form-control mb-3">
                                                        <option value="null">--</option>
                                                        <?php foreach ($param as $keyp) :?>
                                                            <option value="<?=$keyp->value?>" <?php if($keyp->value == $val){ echo "selected"; } ?>><?=strtoupper($keyp->value)?></option>   
                                                        <?php endforeach;?>
                                                    </select>
                                                </td>
                                            <?php }else{ ?>
                                                <td></td>
                                        <?php } endforeach; ?>
                                        <td class="text-right"><?=$key1->description?></td>
                                        <td>
                                            <?php if ($cek1 == FALSE) {
                                                if (cek_comment_exsist($key1->tc_id)== FALSE) {
                                                    $readonly = 'readonly';
                                                } 
                                                $dcomment = $this->mod->getData2('row','comment','trans_dt_tc',null,null,null,array('tc_id = "'.$key1->tc_id.'"','id_ms_trans = "'.$id_ms_trans.'"','comment != "null"'),array('tc_id'));
                                                $val = (isset($dcomment->comment)) ? $dcomment->comment : '';
                                                ?>
                                                <textarea data-tc_id="<?=$key1->tc_id?>" data-url="<?=base_url('checker/do_comment')?>" data-id_msform="<?=$id_ms_form?>" data-id_mstrans="<?=$id_ms_trans?>" class="comment_cek" cols="30" <?=(isset($readonly) ? $readonly : '')?>><?=$val?></textarea>
                                            <?php }?>
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
                                                <?php foreach ($dtDevice as $keypp) :
                                                $cek_detail_trans = cek_value_exsist($key2->tc_id, $keypp->id_device);
                                                if ($cek_detail_trans == FALSE) {
                                                    $insert_data = $this->mod->insertData('trans_dt_tc', array(
                                                        'id_dt_trans' => $this->mod->autoNumber('id_dt_trans','trans_dt_tc','111',3),
                                                        'id_ms_trans' => $id_ms_trans,
                                                        'id_ms_form'  => $id_ms_form,
                                                        'tc_id'       => $key2->tc_id,
                                                        'id_device'   => $keypp->id_device,
                                                        'value'       => 'n/t',
                                                        'created_at'  => date('Y-m-d h:i:sa')
                                                    ));
                                                }
                                                $dtrans = $this->mod->getData('row','value','trans_dt_tc',null,null,null,array('tc_id'=>$key2->tc_id,'id_device'=>$keypp->id_device,'id_ms_trans'=>$id_ms_trans));
                                                $val = (isset($dtrans->value)) ? $dtrans->value : '';
                                                    if ($cek2 == FALSE) { ?>
                                                        <td>
                                                            <select data-tc_id="<?=$key2->tc_id?>" data-url="<?=base_url('checker/do_check')?>" data-dv_id="<?=$keypp->id_device?>" class="param_cek form-control mb-3">
                                                                <option value="null">--</option>
                                                                <?php foreach ($param as $keyp) :?>
                                                                    <option value="<?=$keyp->value?>" <?php if($keyp->value == $val){ echo "selected"; } ?>><?=strtoupper($keyp->value)?></option>   
                                                                <?php endforeach;?>
                                                            </select>
                                                        </td>
                                                    <?php }else{ ?>
                                                        <td></td>
                                                <?php } endforeach; ?>
                                                <td class="text-right"><?=$key2->description?></td>
                                                <td>
                                                <?php if ($cek2 == FALSE) {
                                                    if (cek_comment_exsist($key2->tc_id)== FALSE) {
                                                        $readonly = 'readonly';
                                                    }
                                                    $dcomment = $this->mod->getData2('row','comment','trans_dt_tc',null,null,null,array('tc_id = "'.$key2->tc_id.'"','id_ms_trans = "'.$id_ms_trans.'"','comment != "null"'),array('tc_id'));
                                                    $val = (isset($dcomment->comment)) ? $dcomment->comment : '';
                                                    ?>
                                                    <textarea data-tc_id="<?=$key2->tc_id?>" data-url="<?=base_url('checker/do_comment')?>" data-id_msform="<?=$id_ms_form?>" data-id_mstrans="<?=$id_ms_trans?>" class="comment_cek" cols="30" <?=(isset($readonly) ? $readonly : '')?>><?=$val?></textarea>
                                                <?php }?>
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
                                                        <?php foreach ($dtDevice as $keypp) :
                                                        $cek_detail_trans = cek_value_exsist($key3->tc_id, $keypp->id_device);
                                                        if ($cek_detail_trans == FALSE) {
                                                            $insert_data = $this->mod->insertData('trans_dt_tc', array(
                                                                'id_dt_trans' => $this->mod->autoNumber('id_dt_trans','trans_dt_tc','111',3),
                                                                'id_ms_trans' => $id_ms_trans,
                                                                'id_ms_form'  => $id_ms_form,
                                                                'tc_id'       => $key3->tc_id,
                                                                'id_device'   => $keypp->id_device,
                                                                'value'       => 'n/t',
                                                                'created_at'  => date('Y-m-d h:i:sa')
                                                            ));
                                                        }
                                                        $dtrans = $this->mod->getData('row','value','trans_dt_tc',null,null,null,array('tc_id'=>$key3->tc_id,'id_device'=>$keypp->id_device,'id_ms_trans'=>$id_ms_trans));
                                                        $val = (isset($dtrans->value)) ? $dtrans->value : '';
                                                        if ($cek3 == FALSE) { ?>
                                                            <td>
                                                                <select data-tc_id="<?=$key3->tc_id?>" data-url="<?=base_url('checker/do_check')?>" data-dv_id="<?=$keypp->id_device?>" class="param_cek form-control mb-3">
                                                                    <option value="null">--</option>
                                                                    <?php foreach ($param as $keyp) :?>
                                                                        <option value="<?=$keyp->value?>" <?php if($keyp->value == $val){ echo "selected"; } ?>><?=strtoupper($keyp->value)?></option>   
                                                                    <?php endforeach;?>
                                                                </select>
                                                            </td>
                                                        <?php }else{ ?>
                                                            <td></td>
                                                    <?php } endforeach; ?>
                                                        <td class="text-right"><?=$key3->description?></td>
                                                        <td>
                                                        <?php if ($cek3 == FALSE) {
                                                            if (cek_comment_exsist($key3->tc_id)== FALSE) {
                                                                $readonly = 'readonly';
                                                            }
                                                            $dcomment = $this->mod->getData2('row','comment','trans_dt_tc',null,null,null,array('tc_id = "'.$key3->tc_id.'"','id_ms_trans = "'.$id_ms_trans.'"','comment != "null"'),array('tc_id'));
                                                            $val = (isset($dcomment->comment)) ? $dcomment->comment : '';?>
                                                            <textarea data-tc_id="<?=$key3->tc_id?>" data-url="<?=base_url('checker/do_comment')?>" data-id_msform="<?=$id_ms_form?>" data-id_mstrans="<?=$id_ms_trans?>" class="comment_cek" cols="30" <?=(isset($readonly) ? $readonly : '')?>><?=$val?></textarea>
                                                        <?php }?>
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
                        }else{
                        $co = isset($countD) ? $countD : 1;
                        $eRow = 4 + $co;   
                        ?>
                        <td colspan="<?=$eRow?>">Empty data ..</td>
                        <?php }?>                        
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>