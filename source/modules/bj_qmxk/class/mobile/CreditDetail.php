<?php
$weid = $_W['weid'];
$cfg = $this->module['config'];
$id = $profile['id'];
if (intval($profile['id'])) {
    include $this->template('forbidden');
    die;
}
$credit_income = pdo_fetchall('select * from '. tablename('bj_qmxk_credit_log').' where weid='.$_W['weid'].' and (change_reason=0 or change_reason=1 or change_reason=2 and change_way=1) and from_user="'.$from_user.'" order by create_time desc');
$credit_disb = pdo_fetchall('select * from '. tablename('bj_qmxk_credit_log').' where weid='.$_W['weid'].' and change_reason=2 and change_way=0 and from_user="'.$from_user.'" order by create_time desc');




include $this->template('credit_detail');