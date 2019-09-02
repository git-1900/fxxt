<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<style>
  td {
    vertical-align:middle !important;
  }
  .followtime {
    font-size:10px;
    text-align:right;
  }
  body {
    background-color:white;
  }
  .frame {
    margin:20px;
  }
    .fansinfo {
    margin-bottom:5px;
  }
  .fansname {
    font-size:20px;
    margin:5px 0px 8px 0px;
  }
</style>

<ul class="nav nav-tabs">
<li class="active"><a href="<?php  echo $this->createWebUrl('fansmanager');?>">返回代理名单</a></li>
	
</ul>

<div class="frame">


<div class="fansinfo">
  <div class="img-rounded" style='float:left;width:30%;text-align:center'><img style="align:center" class="img-rounded" src="<?php  echo $fans['avatar'];?>" width="80px" height="80px" /></div>
  <div class="" style='float:left;width:70%;'>
    <div class="fansname"><b><?php  echo $fans['nickname'];?></b></div>
    点击数:<?php  echo $profile['clickcount']?>人&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;下级代理:<?php  echo $count;?>人（包括1，2，3级）<br/>
    关注日期:<?php  echo date('Y-m-d H:i', $fans['createtime'])?>
  </div>
</div>
<div class="clearfix">
  <table class="table table-striped" style='width:100%;'>
    <thead>
      <tr>
        <th>编号</th>
        <th>图像</th>
        <th>昵称</th>
        <th>关注时间</th>
         <th>级数</th>
    </thead>
    <tbody>
      <?php  if(is_array($mylist1)) { foreach($mylist1 as $f) { ?>
      <tr>
        <td><?php  echo ++$seq?></td>
        <td><img class="img-rounded" src="<?php  echo $f['avatar'];?>" width="45px" height="45px" /></td>
        <td><?php  echo $f['nickname'];?></td>
        <td class="followtime"><?php  echo date('Y-m-d H:i', $f['createtime'])?></td>
      <td "><?php  echo $f['level'];?></td>
     
      </tr>
      <?php  } } ?>
           <?php  if(is_array($mylist2)) { foreach($mylist2 as $f) { ?>
      <tr>
        <td><?php  echo ++$seq?></td>
        <td><img class="img-rounded" src="<?php  echo $f['avatar'];?>" width="45px" height="45px" /></td>
        <td><?php  echo $f['nickname'];?></td>
        <td class="followtime"><?php  echo date('Y-m-d H:i', $f['createtime'])?></td>
        <td "><?php  echo $f['level'];?></td>
      </tr>
      <?php  } } ?>
           <?php  if(is_array($mylist3)) { foreach($mylist3 as $f) { ?>
      <tr>
        <td><?php  echo ++$seq?></td>
        <td><img class="img-rounded" src="<?php  echo $f['avatar'];?>" width="45px" height="45px" /></td>
        <td><?php  echo $f['nickname'];?></td>
        <td class="followtime"><?php  echo date('Y-m-d H:i', $f['createtime'])?></td>
        <td "><?php  echo $f['level'];?></td>
      </tr>
      <?php  } } ?>
    </tbody>
  </table>
  <div>
  说明：<br>1、【推荐人数】是该代理通过转发朋友或是朋友圈或是直接转发商品链接，转发二维码或是传单等方式，吸引过来的粉丝。这些粉丝不一定都会出现在下级代理名单中，但是这些粉丝只要有再本商城产生购买行为，都会被统计成该代理的佣金，<br>2、【下级代理】只有这些粉丝购买一单或是成为代理后才会被统计成该代理的下级代理，并且出现在下级代理名单中。

  </div>
</div>
<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>