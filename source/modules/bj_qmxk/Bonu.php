<?php
$mysql_server="182.92.192.218";
$mysql_username="root";
$mysql_password="fxxt";
$mysql_database="shanghe";
//建立数据库链接
$conn = mysql_connect($mysql_server,$mysql_username,$mysql_password) or die("数据库链接错误");
//选择某个数据库
mysql_select_db($mysql_database,$conn);
mysql_query("set names 'utf8'");

$month = date("Y-m");

$cur_day = (string)date("d");
//执行MySQL语句
$result=mysql_query("SELECT days FROM ims_bj_qmxk_bonudate WHERE weid=35 AND month='".$month."'");
//提取数据
$row=mysql_fetch_row($result);
$arr = explode(",", $row[0]);
if(in_array($cur_day, $arr)){
   mysql_query("call sp_calculate_sh()");
}