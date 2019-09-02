<?php
$weid = $_W['weid'];
$cfg = $this->module['config'];
$id = $profile['id'];
if (intval($profile['id'])) {
    include $this->template('forbidden');
    die;
}
$user = pdo_fetch('select qmxk.from_user,qmxk.vip_fee,card.* from '.tablename('bj_qmxk_member').' qmxk left join '. tablename('bj_qmxk_card_type') . ' card on card.cardid=qmxk.vip and card.weid=qmxk.weid ' .' where qmxk.id ='.$id);
include $this->template('MyRights');