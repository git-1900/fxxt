<?php
$checkjsweixin = '1';
$this->validateopenid();
$weid = $_W['weid'];
$op = $_GPC['op'] ? $_GPC['op'] : 'display';
$cfg = $this->module['config'];
$this->checkisAgent($from_user, $profile);
$ushareid = $this->getShareId();
if (!empty($ushareid) && $ushareid != 0) {
    $shareprofile = $this->getMember($ushareid);
    $fansrealname = $this->getFans($shareprofile['from_user']);
    if (empty($shareprofile['realname']) && !empty($fansrealname['nickname'])) {
        $shareprofile['realname'] = $fansrealname['nickname'];
    }
}
if (empty($profile['id'])) {
    include $this->template('forbidden');
    die;
}
$medal_name = "";
if ($profile['flag'] == 0) {
    $medal_name = "办理会员卡成为代理";
}else if ($profile['status'] == 0) {
    $medal_name = "已禁用";
}else if ($profile['status'] == 1) {
    $medal_name = "推广会员赚取积分";
}

$id = $profile['id'];
$vip = pdo_fetch(" select card.card_name,card.commission_ratio from ".tablename("bj_qmxk_member")." qmxk left join ".tablename("bj_qmxk_card_type")." card on card.weid=qmxk.weid and card.cardid=qmxk.vip where qmxk.weid=".$_W['weid']." and qmxk.id=".$profile['id']);
if (!empty($profile['id']) && $profile['flag'] == 1) {
    $myshare = pdo_fetchall('select qmxk.realname,fans.avatar from '.tablename('bj_qmxk_member').' qmxk left join '.tablename('fans').' fans on qmxk.from_user=fans.from_user where qmxk.shareid='.$profile['id'].' and qmxk.exchange_status=1 and qmxk.flag=1');
    $count = pdo_fetchcolumn('select count(*) from ' . tablename('bj_qmxk_member'). '  where vip<>0 and flag=1 and shareid = ' . $id);
} else {
    $count = 0;
    $followcount = 0;
}
$myheadimg = pdo_fetch('SELECT * FROM ' . tablename('fans') . ' WHERE  weid = :weid  AND from_user = :from_user', array(':weid' => $_W['weid'], ':from_user' => $from_user));


include $this->template('newhome');