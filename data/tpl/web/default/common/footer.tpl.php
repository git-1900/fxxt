<?php defined('IN_IA') or exit('Access Denied');?>	<!-- <div id="footer">
		<span class="pull-left">
			<p><?php  if(empty($_W['setting']['copyright']['footerleft'])) { ?>Powered by <a href="http://www.we7.cc"><b>运河印象</b></a> v<?php echo IMS_VERSION;?> &copy; 2014 <a href="http://www.we7.cc">www.we7.cc</a><?php  } else { ?><?php  echo $_W['setting']['copyright']['footerleft'];?><?php  } ?></p>
		</span>
		<span class="pull-right">
			<p><?php  if(empty($_W['setting']['copyright']['footerright'])) { ?><a href="http://www.we7.cc">关于运河印象</a>&nbsp;&nbsp;<a href="http://bbs.we7.cc">运河印象帮助</a><?php  } else { ?><?php  echo $_W['setting']['copyright']['footerright'];?><?php  } ?>&nbsp;&nbsp;<?php  if(!empty($_W['setting']['copyright']['statcode'])) { ?><?php  echo $_W['setting']['copyright']['statcode'];?><?php  } ?></p>
		</span>
	</div>
	<div class="emotions" style="display:none;"></div>
	<script>
		<?php  if(!empty($_W['weid']) && $_W['account']['level'] == 2) { ?>
			$.post('./account.php?act=fansync');
		<?php  } ?>
	</script> -->
</body>
</html>