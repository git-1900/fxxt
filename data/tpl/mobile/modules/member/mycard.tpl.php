<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('header', TEMPLATE_INCLUDEPATH);?>
<style>
body{background:#F9F9F9;}
.nav-tabs .active a, .nav-tabs .active a:hover{background:#F9F9F9;}
.card{position:relative; margin:10px 8%; max-width:534px; max-height:318px; overflow:hidden;}
.cardsn{position:absolute; color:<?php  echo $card['color']['number'];?>; right:20px; bottom:10px; text-shadow:0 -1px 0 rgba(255, 255, 255, 0.5); font-size:16px;}
.cardtitle{position:absolute; right:20px; top:10px; color:<?php  echo $card['color']['title'];?>; font-size:16px; text-shadow:0 -1px 0 rgba(255, 255, 255, 0.5);}
.cardlogo{position:absolute; top:10px; left:20px;}
</style>
<?php  include $this->template('member', TEMPLATE_INCLUDEPATH);?>
<div class="card img-rounded">
	<div class="cardsn">卡号：<?php  echo $member['cardsn'];?></div>
	<div class="cardtitle"><?php  echo $card['title'];?></div>
	<div class="cardlogo"><img src="<?php  echo $_W['attachurl'];?><?php  echo $card['logo'];?>"></div>
	<img src="<?php  if($card['background']['background'] == 'system') { ?><?php  echo $_W['siteroot'];?>source/modules/member/images/card/<?php  echo $card['background']['image'];?>.png<?php  } else { ?><?php  echo $_W['attachurl'];?><?php  echo $card['background']['image'];?><?php  } ?>">
</div>
<div class="mobile-div img-rounded">
	<div class="mobile-li"><span class="pull-right muted"><?php  echo $member['cardsn'];?></span>卡号</div>
	<div class="mobile-li"><span class="pull-right muted"><?php  echo date('Y-m-d', $member['createtime'])?></span>领卡日期</div>
	<div class="mobile-li"><span class="pull-right muted"><?php  echo $_W['fans']['credit1'];?></span>积分</div>
	<div class="mobile-li"><span class="pull-right muted"><?php  echo $_W['fans']['credit2'];?> 元</span>余额</div>
</div>

<!--导航条，navbar-fixed-top居上，navbar-fixed-bottom居下-->
<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<ul class="nav">
			<li><a href="#" onclick="history.go(-1);return false;"><i class="icon-chevron-left"></i> 返回</a></li>
		</ul>
		<ul class="nav pull-right">
			<li><a href="<?php  echo create_url('mobile/channel', array('name' => 'home', 'weid' => $_W['weid']))?>"><i class="icon-user"></i> 个人中心</a></li>
		</ul>
	</div>
</div>
<?php  include $this->template('footer', TEMPLATE_INCLUDEPATH);?>