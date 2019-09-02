<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//$list = pdo_fetchall("select * from " . tablename("bj_qmxk_credit_log")." where FROM_UNIXTIME(create_time, '%Y-%m-%d %h') = FROM_UNIXTIME(1499277600,'%Y-%m-%d %h')");
//$messa = "";
//foreach ($list as $key =>$val){
//    $data = array();
//    $data['weid']=$val['weid'];
//    $data['from_user']=$val['from_user'];
//    $data['change_way']=$val['change_way'];
//    $data['change_value']=$val['change_value'];
//    $data['change_reason']=$val['change_reason'];
//    $data['create_time']= 1499623200;
//    $data['remark']=$val['remark'];
//    $add = pdo_insert("bj_qmxk_credit_log", $data);
//    if (!$add) {
//        $messa .= $data['from_user'].";";
//    }
//}
//echo $messa;
//$BounTotal = 1080;
//$creattime = 1499709600;
//$sliver = pdo_fetchall("SELECT from_user FROM ims_bj_qmxk_member WHERE  weid = 35 AND vip=1 AND flag=1 AND `STATUS`=1 AND (creditlimit=0 or bonucredit<creditlimit) and flagtime < ".$creattime);
//$gold   = pdo_fetchall("SELECT from_user FROM ims_bj_qmxk_member WHERE  weid = 35 AND vip=2 AND flag=1 AND `STATUS`=1 AND (creditlimit=0 or bonucredit<creditlimit) and flagtime < ".$creattime);
//$diamond = pdo_fetchall("SELECT from_user FROM ims_bj_qmxk_member WHERE  weid = 35 AND vip=3 AND flag=1 AND `STATUS`=1 AND (creditlimit=0 or bonucredit<creditlimit) and flagtime < ".$creattime);
//$sliver_count = count($sliver);
//$gold_count = count($gold);
//$diamond_count = count($diamond);
//$n = ($BounTotal*7)/($sliver_count+$gold_count*2+$diamond_count*4);
////$Bonu_sliver = round($n/7,2);
////$Bonu_gold = round($n*2/7,2);
////$Bonu_diamond = round($n*4/7,2);
//$Bonu_sliver = 6.92;
//$Bonu_gold = 13.83;
//$Bonu_diamond = 27.67;
//$total = $Bonu_sliver*$sliver_count+$Bonu_gold*$gold_count+$Bonu_diamond*$diamond_count;
//echo $Bonu_sliver." ".$Bonu_gold." ".$Bonu_diamond." ".$total;
//$messa = "";
//foreach ($sliver as $key =>$val){
//    $data = array();
//    $data['weid']=35;
//    $data['from_user']=$val['from_user'];
//    $data['change_way']=1;
//    $data['change_value']=$Bonu_sliver;
//    $data['change_reason']=0;
//    $data['create_time']= $creattime;
//    $data['remark']="积分增加";
//    $add = pdo_insert("bj_qmxk_credit_log", $data);
//    if (!$add) {
//        $messa .= $data['from_user'].";";
//    }
//}
//foreach ($gold as $key2 =>$val2){
//    $data = array();
//    $data['weid']=35;
//    $data['from_user']=$val2['from_user'];
//    $data['change_way']=1;
//    $data['change_value']=$Bonu_gold;
//    $data['change_reason']=0;
//    $data['create_time']= $creattime;
//    $data['remark']="积分增加";
//    $add2 = pdo_insert("bj_qmxk_credit_log", $data);
//    if (!$add2) {
//        $messa .= $data['from_user'].";";
//    }
//}
//foreach ($diamond as $key3 =>$val3){
//    $data = array();
//    $data['weid']=35;
//    $data['from_user']=$val3['from_user'];
//    $data['change_way']=1;
//    $data['change_value']=$Bonu_diamond;
//    $data['change_reason']=0;
//    $data['create_time']= $creattime;
//    $data['remark']="积分增加";
//    $add3 = pdo_insert("bj_qmxk_credit_log", $data);
//    if (!$add3) {
//        $messa .= $data['from_user'].";";
//    }
//}
//echo $messa;
$mem = pdo_fetchall("SELECT realname,from_user,credit2 FROM ims_bj_qmxk_member WHERE  weid = 35  AND flag=1 AND `STATUS`=1");
$list = array();
foreach ($mem as $key => $value) {
   
            $d = pdo_fetch("SELECT (SUM(l.change_value)-m.credit2) a from ims_bj_qmxk_credit_log l,ims_bj_qmxk_member m where l.from_user=m.from_user and m.from_user='".$value['from_user']."'");
            if ($d['a']!=0.00) {
                 $list[$value['realname']]=$d['a'];
            }
            
}
print_r($list);
die;