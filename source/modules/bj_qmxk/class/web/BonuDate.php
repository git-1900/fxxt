<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$op = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
$month = date("Y-m");
if ($op == "display") {
    //判断下月的月份是否存在，若无则添加
    $nextmonth = getNextMonth(date("Y-m-d H:i:s"));
    $isexit = pdo_fetch("SELECT dateid FROM ". tablename("bj_qmxk_bonudate")." WHERE month='".$nextmonth."'");
    if (empty($isexit['dateid'])) {
        pdo_insert("bj_qmxk_bonudate", array('month'=>$nextmonth,'weid'=>$_W['weid'],'createtime'=> time()));
    }
    $pindex = max(1, intval($_GPC['page']));
    $psize = 12;
    $list = pdo_fetchall("SELECT * FROM ". tablename("bj_qmxk_bonudate")." WHERE weid=". $_W['weid'] ." ORDER BY createtime DESC limit " . ($pindex - 1) * $psize . ',' . $psize);
    $total = pdo_fetchcolumn("SELECT count(*) FROM ". tablename("bj_qmxk_bonudate")." WHERE weid=". $_W['weid']);
    $pager = pagination1($total, $pindex, $psize);
    
}
if ($op == 'setdate') {
    $ym = $_GPC['ym'];
    $yms = explode('-', $ym); //分割年月
    $dnums = date('t', strtotime($ym));//获取当月天数
    $w = date("w", strtotime($yms[0] . '-' . $yms[1] . '-1'));    //获取当月第一天礼拜几，用于前端日历
    $bds = pdo_fetch("SELECT days FROM ". tablename("bj_qmxk_bonudate")." WHERE month='".$ym."'");
    if (checksubmit()) {
        $days = $_GPC['day'];
        if (empty($days)) {
            message('请选择当月打卡日期', referer(),'error');
        }
        //数据组合，i从0开始用于批量添加数据，数据处理时i需+1
        $data = "";
        foreach ($days as $key => $val){
            if ($val != "") {
                if ($key < 9) {
                $data .= '0' . $val . ",";
                } else {
                    $data .= $val . ",";
                }
            }
        }
        $data = substr($data,0, strlen($data)-1);
        $up = pdo_update("bj_qmxk_bonudate", array('days'=>$data),array('weid'=>$_W['weid'],'month'=>$ym));
        if ($up) {
            message("保存成功",$this->createWebUrl('bonudate'),'success');
        }else{
            message("保存失败", referer(),'error');
        }
    }
}
include $this->template("bonudate");