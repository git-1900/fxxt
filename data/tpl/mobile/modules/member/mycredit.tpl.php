<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('header', TEMPLATE_INCLUDEPATH);?>
<div class="mobile-div img-rounded">
	<div class="mobile-hd" style="border-bottom:0;">我的充值记录</div>
	<?php  if(is_array($list)) { foreach($list as $item) { ?>
	<a href="<?php  echo $this->createMobileUrl('usecoupon', array('id' => $item['id']))?>" class="mobile-li">
		<span class="pull-right"><?php  echo date('Y-m-d H:i:s', $item['createtime'])?></span>
		<?php  echo $item['content'];?>
	</a>
	<?php  } } ?>
</div>
<?php  echo $pager;?>
<?php  include $this->template('footer', TEMPLATE_INCLUDEPATH);?>