<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('header', TEMPLATE_INCLUDEPATH);?>
<style>
body{background:#F9F9F9;}
.mobile-li .btn.pull-right,.mobile-li .btn.pull-left{margin-top:6px;}
.collapse .mobile-content{margin-top:0; padding:0 5px; color:#666; border-left:3px #EEE solid; background:#F9F9F9;}
</style>
<div class="mobile-div img-rounded">
	<div class="mobile-hd" style="border-bottom:0;">优惠券列表</div>
	<?php  $i = 0;?>
	<?php  if(is_array($list)) { foreach($list as $item) { ?>
	<span class="mobile-li" data-target="#content-<?php  echo $item['id'];?>">
		<i class="icon-hand-up pull-right"></i>
		<span class="text-info pull-right">查看详情</span>
		<?php  echo $item['title'];?>
	</span>
	<div class="collapse <?php  if($i == 0) { ?>in<?php  } ?>" id="content-<?php  echo $item['id'];?>">
		<div class="mobile-content">
			<p>有效期：<?php  echo date('Y-m-d H:i:s', $item['starttime'])?> - <?php  echo date('Y-m-d H:i:s', $item['endtime'])?></p>
			<p>优惠券类型：<?php  echo $type[$item['type']];?></p>
			<p>每人可领量：<?php  echo $item['pretotal'];?>张</p>
			<p>优惠券总量：还有<?php  echo $item['total'];?>张</p>
			<p><?php  echo htmlspecialchars_decode($item['content'])?></p>
			<div style="margin:5px; overflow:hidden;">
				<a href="<?php  echo $this->createMobileUrl('getcoupon', array('id' => $item['id']))?>" class="btn btn-success pull-right">我要领取</a>
			</div>
		</div>
	</div>
	<?php  $i++;?>
	<?php  } } ?>
</div>
<div class="mobile-div img-rounded">
	<div class="mobile-hd" style="border-bottom:0;">我的优惠券</div>
	<?php  if(is_array($mylist)) { foreach($mylist as $item) { ?>
	<a href="<?php  echo $this->createMobileUrl('usecoupon', array('id' => $item['mycouponid']))?>" class="mobile-li">
		<i class="icon-hand-up pull-right"></i>
		<?php  if($item['status'] == 1) { ?><span class="text-success pull-right">未使用</span><?php  } else if($item['status'] == 2) { ?><span class="text-error pull-right">已使用</span><?php  } ?>
		<span class="muted"><?php  echo $type[$item['type']];?></span>
		<?php  echo $item['title'];?>
	</a>
	<?php  } } ?>
</div>
<div class="mobile-div img-rounded">
	<div class="mobile-hd" style="border-bottom:0;">近一个月过期优惠券</div>
	<?php  if(is_array($pastlist)) { foreach($pastlist as $item) { ?>
	<span class="mobile-li" data-toggle="collapse" data-target="#pastlist-<?php  echo $item['id'];?>">
		<?php  echo $item['title'];?>
	</span>
	<div class="collapse" id="pastlist-<?php  echo $item['id'];?>">
		<div class="mobile-content">
			<p>优惠券类型：<?php  echo $type[$item['type']];?></p>
			<p>每人可领量：<?php  echo $item['pretotal'];?>张</p>
			<p>优惠券总量：还有<?php  echo $item['total'];?>张</p>
			<p><?php  echo $item['content'];?></p>
		</div>
	</div>
	<?php  } } ?>
</div>
<script type="text/javascript">
<!--
	$(function(){
		$('.mobile-li').each(function(){
			$(this).click(function(){
				$('.mobile-li').each(function(){
					$($(this).attr('data-target')).attr('class', 'collapse');
				});
				$($(this).attr('data-target')).attr('class', 'collapse in');
			});
		});
	});
//-->
</script>
<?php  include $this->template('footer', TEMPLATE_INCLUDEPATH);?>