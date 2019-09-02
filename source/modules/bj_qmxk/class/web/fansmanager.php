<?php
$weid = $_W['weid'];
$op = $operation = $_GPC['op'] ? $_GPC['op'] : 'display';
$cfg = $this->module['config'];
if ($op == 'delete') {
    pdo_update('bj_qmxk_member', array('status' => intval($_GPC['isstatus'])), array('id' => $_GPC['id'], 'weid' => $_W['weid']));
    $op = 'display';
}
if ($op == 'remove') {
    $id = $_GPC['id'];
    $fromuser = $_GPC['from_user'];
    $data = array(
        'status'=> 0,
        'flag'  => 0,
        'flagtime'=>"",
        'credit2'=>0,
        'vip'=>0,
        'exchange_status'=>0,
        'vip_fee'=>0,
        'bonucredit'=>0,
        'deletetime'=>time(),
        'deleteuser'=>$_W['username']
    );
    pdo_update("bj_qmxk_member",$data,array('id'=>$id,'weid'=>$_W['weid']));
    pdo_delete("bj_qmxk_credit_log",array('from_user'=>$fromuser,'weid'=>$_W['weid']));
    $op = 'display';
}
if (checksubmit()) {
    if ($op == 'change_vip') {
        $change_value = intval($_GPC["price2"]) - intval($_GPC["price1"]);
        $data2 = array(
            'weid' => $_W['weid'],
            'from_user'      => $_GPC['from_user'],
            'change_value'   => $change_value,
            'change_type'    => 2, 
            'create_time'    => time(),
        );
        pdo_insert('bj_qmxk_cash_log',$data2);
        //更新rules表的资金池资金数
        pdo_query('UPDATE '.tablename('bj_qmxk_rules').' SET cash_pool=cash_pool+\''.$change_value .'\' WHERE weid='.$_W['weid']);
        //更新会员等级
        pdo_update('bj_qmxk_member', array('vip' => intval($_GPC['vip']),'vip_fee'=> intval($_GPC['price2'])), array('from_user' => $_GPC['from_user'], 'weid' => $_W['weid']));
        $op = 'display';
    }
    if ($op == 'revise') {
        $id = $_GPC['id'];
        $data = array(
            'realname' => $_GPC['realname'],
            'status'   => $_GPC['status'],
            'mobile'   => $_GPC['mobile'],          
            'creditlimit'  => $_GPC['creditlimit'],
            'banktype' => $_GPC['banktype'],
            'bankcard' => $_GPC['bankcard'],
            'content'  => $_GPC['content']
        );
        pdo_update('bj_qmxk_member',$data,array('id'=>$id, 'weid' => $_W['weid']));
        $op = 'detail';
        message('修改成功！', $this->createWebUrl('fansmanager',array('op'=>'detail','id'=>$id)), 'success');
    }
    if ($op == 'credit_revise') {
        $change_way = intval($_GPC['change_way']);
        if (!is_numeric($_GPC['change_value'])) {
            message("修改积分请填入数字");
        }
        $change_value = intval($_GPC['change_value']);
        if ($change_value <= 0) {
            message("修改积分填入数字应大于0");
        }
        $data = array(
            'weid' => $_W['weid'],
            'from_user'      => $_GPC['from_user'],
            'change_way'     => $change_way,
            'change_value'   => $change_value,
            'change_reason' => 2,
            'create_time' => time(),
            'remark'  => $_GPC['content']
        );
        
        if ($_GPC['change_way'] == '0') {
            $credit2 = pdo_fetch('select credit2 from '.tablename('bj_qmxk_member').' WHERE from_user="'.$_GPC['from_user'].'" and weid='.$_W['weid']);
            if ($change_value > intval($credit2['credit2'])) {
                message('积分不足', referer(), 'error'); 
            }else{
                pdo_insert('bj_qmxk_credit_log',$data);
                pdo_query('UPDATE '.tablename('bj_qmxk_member').' SET credit2=credit2-\''.$change_value .'\' WHERE from_user="'.$_GPC['from_user'].'" and weid='.$_W['weid']);
                message('修改积分成功！', $this->createWebUrl('fansmanager'), 'success');
            }
        } else {
            pdo_insert('bj_qmxk_credit_log',$data);
            pdo_query('UPDATE '.tablename('bj_qmxk_member').' SET credit2=credit2+\''.$change_value .'\' WHERE from_user="'.$_GPC['from_user'].'" and weid='.$_W['weid']);
            message('修改积分成功！',  $this->createWebUrl('fansmanager'), 'success');
        }
        $op='display';
    }
    if ($op == 'nocheck') {
        $shareid = $_GPC['shareid'];
        $vip = $_GPC['vip'];
        $unexchange = pdo_fetchall('select * from '.tablename('bj_qmxk_member').' where shareid='.$_GPC['shareid'].' and weid='.$_W['weid'].' and flag=1 and vip <> 0 and exchange_status=1');
        $share_user = pdo_fetch('select qmxk.from_user,qmxk.credit2,card.commission_ratio from '.tablename('bj_qmxk_member').' qmxk left join '. tablename('bj_qmxk_card_type') . ' card on card.cardid=qmxk.vip and card.weid=qmxk.weid ' .' where qmxk.id ='.$_GPC['shareid']);
        if (count($unexchange)==1 && $shareid!= 0 ) {
            $money = intval($unexchange[0]['vip_fee']) + intval($_GPC['price']);
            $money_leave = intval($_GPC['price']) - $money*$share_user['commission_ratio']/100;
            $money_all = intval($share_user['credit2'])+$money*$share_user['commission_ratio']/100;
            //更新之前未兑换的会员
            pdo_update('bj_qmxk_member',array('exchange_status'=>2),array('weid'=>$_W['weid'],'from_user'=>$unexchange[0]['from_user']));
            //更新最新会员
            pdo_update('bj_qmxk_member',array('status'=>1,'flag'=>1,'flagtime'=>time(),'vip'=>$vip,'exchange_status'=>2,'vip_fee'=>$_GPC['price']),array('weid'=>$_W['weid'],'from_user'=>$_GPC['from_user']));
            //更新代理积分
            $up = pdo_update('bj_qmxk_member',array('credit2'=>$money_all),array('weid'=>$_W['weid'],'id'=>$shareid,'flag'=>'1'));
            if($up){
                //更新代理积分变更记录表
                $data = array(
                    'weid' => $_W['weid'],
                    'from_user'      => $share_user['from_user'],
                    'change_way'     => 1,
                    'change_value'   => $money*$share_user['commission_ratio']/100,
                    'change_reason'  => 1,
                    'create_time'    => time(),
                    'remark'         => ''
                );
                pdo_insert('bj_qmxk_credit_log',$data);
            }
            //更新资金池资金变更记录
            $data2 = array(
                'weid' => $_W['weid'],
                'from_user'      => $_GPC['from_user'],
                'change_value'   => intval($_GPC['price']),
                'change_type'  => 1,
                'create_time'    => time()
            );
            pdo_insert('bj_qmxk_cash_log',$data2);
            $data3 = array(
                'weid' => $_W['weid'],
                'from_user'      => $share_user['from_user'],
                'change_value'   => $money*$share_user['commission_ratio']/100,
                'change_type'  => 4,
                'create_time'    => time()
            );
            pdo_insert('bj_qmxk_cash_log',$data3);
            //更新资金池资金数
            pdo_query('UPDATE '.tablename('bj_qmxk_rules').' SET cash_pool=cash_pool+\''.$money_leave .'\' WHERE weid='.$_W['weid']);
        } else {
            //更新该会员信息
            pdo_update('bj_qmxk_member',array('flag'=>1,'flagtime'=>time(),'vip'=>$_GPC['vip'],'vip_fee'=>$_GPC['price'],'exchange_status'=>1),array('weid'=>$_W['weid'],'from_user'=>$_GPC['from_user']));
            //更新资金池资金数
            pdo_query('UPDATE '.tablename('bj_qmxk_rules').' SET cash_pool=cash_pool+\''.intval($_GPC['price']) .'\' WHERE weid='.$_W['weid']);
            //更新资金池变更记录
            $data3 = array(
                'weid' => $_W['weid'],
                'from_user'      => $_GPC['from_user'],
                'change_value'   => intval($_GPC['price']),
                'change_type'  => 1,
                'create_time'    => time()
            );
            pdo_insert('bj_qmxk_cash_log',$data3);
        }
        message("审核成功", referer(),'success');
    }
}

if ($op == 'display') {
    $pindex = max(1, intval($_GPC['page']));
    $psize = 20;
    $gold_total = pdo_fetch("select COUNT(1) gold_total from ".tablename("bj_qmxk_member")." where vip =2 and flag=1 and FROM_UNIXTIME(flagtime,'%Y-%m-%d')=CURDATE()");
    $silver_total = pdo_fetch("select COUNT(1) silver_total from ".tablename("bj_qmxk_member")." where vip =1 and flag=1 and FROM_UNIXTIME(flagtime,'%Y-%m-%d')=CURDATE()");
    $diam_total = pdo_fetch("select COUNT(1) diam_total from ".tablename("bj_qmxk_member")." where vip =3 and flag=1 and FROM_UNIXTIME(flagtime,'%Y-%m-%d')=CURDATE()");
    $list = pdo_fetchall('select qmxk.*,qmxk2.realname sharename,card.cardid,card.card_name from ' . tablename('bj_qmxk_member') . ' qmxk left join '. tablename('bj_qmxk_member').'qmxk2 on qmxk.shareid=qmxk2.id left join '. tablename('bj_qmxk_card_type') . ' card on card.cardid=qmxk.vip and card.weid=qmxk.weid where  qmxk.flag = 1 and qmxk.weid = ' . $_W['weid'] . ' and qmxk.realname<>\'\'  ORDER BY qmxk.flagtime DESC limit ' . ($pindex - 1) * $psize . ',' . $psize);
    $cardtype = pdo_fetchall(' select * from '. tablename('bj_qmxk_card_type') . ' where weid='.$_W['weid']." order by price asc");
    $sum_money = pdo_fetch(" select sum(vip_fee) sum_money from ". tablename('bj_qmxk_member') . ' where  weid='.$_W['weid']." and FROM_UNIXTIME(flagtime,'%Y-%m-%d')=CURDATE()");
    $total = pdo_fetchcolumn('select count(id) from' . tablename('bj_qmxk_member') . 'where flag = 1 and realname<>\'\' and weid =' . $_W['weid']);
    $pager = pagination1($total, $pindex, $psize);
}
if ($op == 'nocheck') {
    $pindex = max(1, intval($_GPC['page']));
    $psize = 20;
    $list = pdo_fetchall('select qmxk.*,qmxk2.realname parent_name from ' . tablename('bj_qmxk_member') . ' qmxk left join ' . tablename('bj_qmxk_member') . ' qmxk2 on qmxk.shareid=qmxk2.id where qmxk.flag = 0 and qmxk.realname<>\'\' and qmxk.weid = ' . $_W['weid'] . '  ORDER BY qmxk.id DESC limit ' . ($pindex - 1) * $psize . ',' . $psize);
    $total = pdo_fetchcolumn('select count(id) from' . tablename('bj_qmxk_member') . 'where flag = 0 and realname<>\'\' and weid =' . $_W['weid']);
    $pager = pagination1($total, $pindex, $psize);
    $cardtype = pdo_fetchall(' select * from '. tablename('bj_qmxk_card_type') . ' where weid='.$_W['weid'] ." order by price asc");
    include $this->template('fansmanagered');
    die;
}

if ($op == 'sort') {
    $sort = array('realname' => $_GPC['realname'], 'mobile' => $_GPC['mobile']);
    if ($_GPC['opp'] == 'nocheck') {
        $status = 0;
    } else {
        $status = 1;
    }
    $list = pdo_fetchall('select qmxk.*,qmxk2.realname sharename,card.cardid,card.card_name from ' . tablename('bj_qmxk_member') . ' qmxk left join '. tablename('bj_qmxk_member').'qmxk2 on qmxk.shareid=qmxk2.id left join '. tablename('bj_qmxk_card_type') . ' card on card.cardid=qmxk.vip and card.weid=qmxk.weid where qmxk.flag = ' . $status . ' and qmxk.weid =' . $_W['weid'] . ' and qmxk.realname like \'%' . $sort['realname'] . '%\' and qmxk.mobile like \'%' . $sort['mobile'] . '%\'ORDER BY qmxk.id DESC');
    foreach ($list as $key => $c) {
        $list[$key]['credit1'] = pdo_fetchcolumn('select fans.credit1 from ' . tablename('fans') . ' fans where  fans.weid = ' . $_W['weid'] . ' and fans.from_user=\'' . $c['from_user'] . '\'  ORDER BY fans.credit1 DESC limit 1');
    }
    $commissions = pdo_fetchall('select mid, sum(commission) as commission from ' . tablename('bj_qmxk_commission') . ' where weid = ' . $_W['weid'] . ' and flag = 0  group by mid');
    $commission = array();
    foreach ($commissions as $c) {
        $commission[$c['mid']] = $c['commission'];
    }
    $gold_total = pdo_fetch("select COUNT(1) gold_total from ".tablename("bj_qmxk_member")." where vip =2 and FROM_UNIXTIME(flagtime,'%Y-%m-%d')=CURDATE()");
    $silver_total = pdo_fetch("select COUNT(1) silver_total from ".tablename("bj_qmxk_member")." where vip =1 and FROM_UNIXTIME(flagtime,'%Y-%m-%d')=CURDATE()");
    $diam_total = pdo_fetch("select COUNT(1) diam_total from ".tablename("bj_qmxk_member")." where vip =3 and FROM_UNIXTIME(flagtime,'%Y-%m-%d')=CURDATE()");
        $sum_money = pdo_fetch(" select sum(vip_fee) sum_money from ". tablename('bj_qmxk_member') . ' where  weid='.$_W['weid']." and FROM_UNIXTIME(flagtime,'%Y-%m-%d')=CURDATE()");
$cardtype = pdo_fetchall(' select * from '. tablename('bj_qmxk_card_type') . ' where weid='.$_W['weid']);
    if ($_GPC['opp'] == 'nocheck') {
        include $this->template('fansmanagered');
        die;
    }
}
if ($op == 'user') {
    $from_user = $_GPC['from_user'];
    $fans = pdo_fetch('SELECT nickname,createtime,credit1 FROM ' . tablename('fans') . ' WHERE  weid = :weid  AND from_user = :from_user LIMIT 1', array(':weid' => $_W['weid'], ':from_user' => $from_user));
    $myheadimg = pdo_fetchcolumn('SELECT avatar FROM ' . tablename('fans') . ' WHERE  weid = :weid  AND from_user = :from_user LIMIT 1', array(':weid' => $_W['weid'], ':from_user' => $from_user));
    $fans['avatar'] = $myheadimg;
    $profile = pdo_fetch('SELECT * FROM ' . tablename('bj_qmxk_member') . ' WHERE  weid = :weid  AND from_user = :from_user', array(':weid' => $_W['weid'], ':from_user' => $from_user));
    if (!empty($profile['id'])) {
        $count = 0;
        if (true) {
            $sql1_member = 'select mber1.from_user from ' . tablename('bj_qmxk_member') . ' mber1 where    mber1.realname<>\'\' and mber1.id!=mber1.shareid and mber1.shareid = ' . $profile['id'];
            $count1 = pdo_fetchcolumn('	select count(*) from ' . tablename('fans') . " fans where from_user!='{$from_user}' and (fans.from_user in (" . $sql1_member . ")) and fans.weid={$_W['weid']}");
            $mylist1 = pdo_fetchall('	select *,1 as level from ' . tablename('fans') . " fans where  from_user!='{$from_user}' and (fans.from_user in (" . $sql1_member . ") ) and fans.weid={$_W['weid']}");
        }
        if (true && $cfg['globalCommissionLevel'] >= 2) {
            $level2 = pdo_fetchall('select id from ' . tablename('bj_qmxk_member') . ' where id!=shareid and  shareid = ' . $profile['id']);
            $rowindex = 0;
            $str = '';
            foreach ($level2 as &$citem) {
                $str = $str . $citem['id'] . ',';
            }
            $str = $str . '-1';
            $sql2_member = 'select mber2.from_user from ' . tablename('bj_qmxk_member') . ' mber2 where  mber2.realname<>\'\' and mber2.id!=mber2.shareid and mber2.shareid in (' . $str . ')  ';
            $count2 = pdo_fetchcolumn('	select count(*) from ' . tablename('fans') . " fans where from_user!='{$from_user}' and (fans.from_user in (" . $sql2_member . ')) and (fans.from_user not in (' . $sql1_member . ")) and fans.weid={$_W['weid']}");
            $mylist2 = pdo_fetchall('	select * ,2 as level from ' . tablename('fans') . " fans where from_user!='{$from_user}' and (fans.from_user in (" . $sql2_member . ')) and (fans.from_user not in (' . $sql1_member . ")) and fans.weid={$_W['weid']}");
        }
        if (true && $cfg['globalCommissionLevel'] >= 3) {
            $level3 = pdo_fetchall('select id from ' . tablename('bj_qmxk_member') . ' where id!=shareid and shareid in( ' . $str . ')');
            $rowindex = 0;
            $str3 = '';
            foreach ($level3 as &$citem) {
                $str3 = $str3 . $citem['id'] . ',';
            }
            $str3 = $str3 . '-1';
            $sql3_member = 'select mber3.from_user from ' . tablename('bj_qmxk_member') . ' mber3 where  mber3.realname<>\'\' and mber3.id!=mber3.shareid and mber3.shareid in (' . $str3 . ')  ';
            $count3 = pdo_fetchcolumn('	select count(*) from ' . tablename('fans') . " fans where from_user!='{$from_user}' and (fans.from_user in (" . $sql3_member . ')) and (fans.from_user not in (' . $sql1_member . ')) and (fans.from_user not in  (' . $sql2_member . ")) and fans.weid={$_W['weid']}");
            $mylist3 = pdo_fetchall('	select * ,3 as level from ' . tablename('fans') . " fans where from_user!='{$from_user}' and ( fans.from_user in (" . $sql3_member . ')) and (fans.from_user not in (' . $sql1_member . ')) and (fans.from_user not in  (' . $sql2_member . ")) and fans.weid={$_W['weid']}");
        }
        $count = $count1 + $count2 + $count3;
    } else {
        $count = 0;
    }
    include $this->template('clicklog');
    die;
}
if ($op == 'revise') {
    $id = $_GPC['id'];
    $user = pdo_fetch('select qmxk.*,card.card_name,card.cardid from ' . tablename('bj_qmxk_member'). ' qmxk left join '. tablename('bj_qmxk_card_type') . ' card on card.cardid=qmxk.vip and card.weid=qmxk.weid ' . ' where qmxk.id = ' . $id);
    include $this->template('fansmanager_revise');
    die;
}
if ($op == 'detail') {
    $id = $_GPC['id'];
    $user = pdo_fetch('select qmxk.*,card.card_name from ' . tablename('bj_qmxk_member'). ' qmxk left join '. tablename('bj_qmxk_card_type') . ' card on card.cardid=qmxk.vip and card.weid=qmxk.weid  where qmxk.id = ' . $id);
    $member_list = pdo_fetchall('select qmxk.*,card.card_name,fans.avatar from ' . tablename('bj_qmxk_member'). ' qmxk left join '. tablename('bj_qmxk_card_type') . ' card on card.cardid=qmxk.vip and card.weid=qmxk.weid left join '. tablename('fans'). ' fans on fans.from_user=qmxk.from_user where qmxk.vip<>0 and qmxk.shareid = ' . $id.' order by qmxk.flagtime desc');
    if ($_GPC['opp'] == 'nocheck') {
        include $this->template('fansmanagered_detail');
    } else {
        include $this->template('fansmanager_detail');
    }
    die;
}

if ($op == 'status') {
    $status = array('status' => $_GPC['status'], 'content' => trim($_GPC['content']));
    if ($_GPC['opp'] == 'nocheck' && $_GPC['flag'] == 1) {
        $status['flag'] = $_GPC['flag'];
        $status['flagtime'] = TIMESTAMP;
    }
    $temp = pdo_update('bj_qmxk_member', $status, array('id' => $_GPC['id']));
    if (empty($temp)) {
        if ($_GPC['opp'] == 'nocheck') {
            message('设置用户权限失败，请重新设置！', $this->createWebUrl('fansmanager', array('op' => 'detail', 'opp' => 'nocheck', 'id' => $_GPC['id'])), 'error');
        } else {
            message('设置用户权限失败，请重新设置！', $this->createWebUrl('fansmanager', array('op' => 'detail', 'id' => $_GPC['id'])), 'error');
        }
    } else {
        if ($_GPC['opp'] == 'nocheck') {
            message('设置用户权限成功！', $this->createWebUrl('fansmanager', array('op' => 'nocheck')), 'success');
        } else {
            message('设置用户权限成功！', $this->createWebUrl('fansmanager'), 'success');
        }
    }
}
if ($op == 'recharge') {
    $id = $_GPC['id'];
    if ($_GPC['opp'] == 'recharged') {
        if (!is_numeric($_GPC['commission'])) {
            message('佣金请输入合法数字！', '', 'error');
        }
        $recharged = array('weid' => $_W['weid'], 'mid' => $id, 'flag' => 1, 'content' => trim($_GPC['content']), 'commission' => $_GPC['commission'], 'createtime' => time());
        $temp = pdo_insert('bj_qmxk_commission', $recharged);
        $commission = pdo_fetchcolumn('select commission from ' . tablename('bj_qmxk_member') . ' where id = ' . $id);
        if (empty($temp)) {
            message('充值失败，请重新充值！', $this->createWebUrl('fansmanager', array('op' => 'recharge', 'id' => $_GPC['id'])), 'error');
        } else {
            pdo_update('bj_qmxk_member', array('commission' => $commission + $_GPC['commission']), array('id' => $id));
            message('充值成功！', $this->createWebUrl('fansmanager', array('op' => 'recharge', 'id' => $_GPC['id'])), 'success');
        }
    }
    $user = pdo_fetch('select * from ' . tablename('bj_qmxk_member') . ' where id = ' . $id);
    $commission = pdo_fetchcolumn('select sum(commission) from ' . tablename('bj_qmxk_commission') . ' where mid = ' . $id . ' and flag = 0 and weid = ' . $_W['weid']);
    $commission = empty($commission) ? 0 : $commission;
    $commission = $commission - $user['commission'];
    $commissions = pdo_fetchall('select * from ' . tablename('bj_qmxk_commission') . ' where mid = ' . $id . ' and weid = ' . $_W['weid'] . ' and flag = 1');
    include $this->template('fansmanager_recharge');
    die;
}
if ($op == 'credit_revise') {
    $id = $_GPC['id'];
    $user = pdo_fetch('select qmxk.*,card.card_name from ' . tablename('bj_qmxk_member'). ' qmxk left join '. tablename('bj_qmxk_card_type') . ' card on card.cardid=qmxk.vip and card.weid=qmxk.weid  where qmxk.id = ' . $id);
    include $this->template('credit_revise');
    die;
}
if ($op == 'credit_detail') {
    $user = pdo_fetch('select realname,credit2 from '. tablename('bj_qmxk_member').' where weid='.$_W['weid'].' and from_user="'.$_GPC['from_user'].'"');
    $credit_detail = pdo_fetchall('select * from '. tablename('bj_qmxk_credit_log').' where weid='.$_W['weid'].' and from_user="'.$_GPC['from_user'].'" order by create_time desc');
    include $this->template('credit_detail');
    die;
}
if ($op == 'cash_log') {
    $str = "SELECT * FROM (
            select FROM_UNIXTIME(create_time,'%Y-%m-%d') AS day,SUM(change_value) sum_value,change_type from ". tablename("bj_qmxk_cash_log")." where change_type in (1,2) GROUP BY day
            UNION
            select FROM_UNIXTIME(create_time,'%Y-%m-%d') AS day,SUM(change_value) sum_value,change_type from ". tablename("bj_qmxk_cash_log")." where change_type in (3,4,5) GROUP BY day
            ) as aa ORDER BY aa.day DESC";
    $cash_log = pdo_fetchall($str);
    include $this->template('cash_log');
    die;
}
if ($op == 'cash_log_detail') {
    $cash_detail = pdo_fetchall('select cash.*,qmxk.realname,card.card_name from '.tablename('bj_qmxk_cash_log').' cash left join '. tablename('bj_qmxk_member').' qmxk on qmxk.weid=cash.weid and qmxk.from_user=cash.from_user left join '. tablename('bj_qmxk_card_type').' card on card.weid=qmxk.weid and card.cardid=qmxk.vip where cash.weid='.$_W['weid'].' order by  cash.id desc ' );
    include $this->template('cash_log_detail');
    die;
}

include $this->template('fansmanager');