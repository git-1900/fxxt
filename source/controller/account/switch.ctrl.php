<?php
/**
 * [WeEngine System] Copyright (c) 2013 WE7.CC
 */
defined('IN_IA') or exit('Access Denied');

$id = intval($_GPC['id']);
$row = pdo_fetchall("SELECT uid FROM ".tablename('wechats_exp')." WHERE weid = '$id'");
if (!checkpermission('wechats', $row)) {
	message('抱歉，您没有权限操作该公众号！');
}
if (empty($row)) {
	message('抱歉，该公众号不存在或是已经被删除！', create_url('account/display'));
}
$row1 = pdo_fetch("SELECT uid FROM ".tablename('wechats_exp')." WHERE uid = '".$_W['uid']."'");
cache_write('weid:' . $_W['uid'], $id);
isetcookie('__weid', $id, 7 * 46800);
message($row1['name'], referer(), 'success');
