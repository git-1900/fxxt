<?php defined('IN_IA') or exit('Access Denied');?><?php  include template('common/header', TEMPLATE_INCLUDEPATH);?>
	<script type="text/javascript" src="./resource/script/jquery.zclip.min.js"></script>
	<ul class="nav nav-tabs">
		<!--ul class="pull-right unstyled">
			<li><a href="<?php  echo create_url('account/post')?>">添加公众号</a></li>
			<li class="active"><a href="<?php  echo create_url('account/display')?>">管理公众号</a></li>
		</ul-->
		<li><a href="<?php  echo create_url('account/post')?>"><i class="icon-plus"></i> 添加公众号</a></li>
		<li <?php  if(empty($_GPC['type']) || $_GPC['type'] == 1) { ?>class="active"<?php  } ?>><a href="<?php  echo create_url('account/display', array('type' => 1))?>">微信公众号</a></li>
		<li <?php  if($_GPC['type'] == 2) { ?>class="active"<?php  } ?>><a href="<?php  echo create_url('account/display', array('type' => 2))?>">易信公众号</a></li>
	</ul>
	<div class="main">
		<div class="search">
			<form action="account.php" method="get">
			<input type="hidden" name="act" value="display" />
			<table class="table table-bordered tb">
				<tbody>
					<tr>
						<th>公众号名称</th>
						<td>
								<input class="span6" name="wechat" id="" type="text" value="<?php  echo $_GPC['wechat'];?>">
						</td>
					</tr>
					<?php  if($_W['isfounder']) { ?>
					<tr>
						<th>所属用户名</th>
						<td>
								<input class="span6" name="username" id="" type="text" value="<?php  echo $_GPC['username'];?>">
						</td>
					</tr>
					<?php  } ?>
					 <tr class="search-submit">
						<td colspan="2"><button class="btn pull-right span2"><i class="icon-search icon-large"></i> 搜索</button></td>
					 </tr>
				</tbody>
			</table>
			</form>
		</div>
		<div class="account">
			<div class="alert alert-info" style="margin:0 0 10px 0; width:auto;">
				<i class="icon-lightbulb"></i> 粉丝可以在主公众号中触发子公众号中设置的回复规则，该功能适用于集团公司、连锁店、政府部门。
			</div>
			<?php  if(is_array($list)) { foreach($list as $row) { ?>
			<table class="account-main table">
				<tr>
				<td class="account-left">
					<div class="account-left-main">
						<div class="account-name">
							<span class="active" copy-status="1" id="info-<?php  echo $row['weid'];?>"><?php  echo $row['name'];?><a class="icon-remove" title="删除" onclick="return confirm('删除帐号将同时删除全部规则及回复，确认吗？');return false;" href="<?php  echo create_url('account/delete', array('id' => $row['weid']))?>"></a></span>
						
							<?php  if(is_array($row['sub'])) { foreach($row['sub'] as $childrow) { ?>
							<span id="info-<?php  echo $childrow['weid'];?>" copy-status="0"><?php  echo $childrow['name'];?><a class="icon-remove" title="删除" onclick="return confirm('删除帐号将同时删除全部规则及回复，确认吗？');return false;" href="<?php  echo create_url('account/delete', array('id' => $childrow['weid']))?>"></a></span>
							<?php  } } ?>
							
						</div>
						<a class="account-plus" href="<?php  echo create_url('account/post', array('parentid' => $row['weid']))?>"><i class="icon-plus"></i> 添加子公众号</a>
					</div>
				</td>
				<td class="account-right">
					<ul class="account-info unstyled" id="info-<?php  echo $row['weid'];?>-content">
						<li data=''><span>小提示</span><em id="tips">当前为主公众号信息</em></li>
						<li><span>所属用户</span><em><?php  if(in_array($row['uid'], $founder)) { ?>创始人<?php  } else { ?><?php  echo $users[$row['uid']]['username'];?><?php  } ?></em></li>
						<li><span>接口地址</span><em><?php  echo $_W['siteroot'];?>api.php?hash=<?php  echo $row['hash'];?></em></li>
						<li><span>Token</span><em><?php  echo $row['token'];?></em></li>
						<li><span>操作功能</span><em><a onclick="return confirm('删除帐号将同时删除全部规则及回复，确认吗？');return false;" href="<?php  echo create_url('account/delete', array('id' => $row['weid']))?>">删除</a><a href="<?php  echo create_url('account/post', array('id' => $row['weid']))?>">编辑</a><a href="<?php  echo create_url('account/switch', array('id' => $row['weid']))?>" onclick="return ajaxopen(this.href, function(s) {switchHandler(s)})">切换</a></em></li>
					</ul>
					<?php  if(!empty($row['sub'])) { ?>
					<?php  if(is_array($row['sub'])) { foreach($row['sub'] as $childrow) { ?>
					<ul class="account-info unstyled" style="display:none;" id="info-<?php  echo $childrow['weid'];?>-content">
						<li data=''><span>小提示</span><em id="tips" style="color:red;">当前为子公众号信息</em></li>
						<li><span>所属用户</span><em><?php  if(in_array($childrow['uid'], $founder)) { ?>创始人<?php  } else { ?><?php  echo $users[$childrow['uid']]['username'];?><?php  } ?></em></li>
						<li><span>接口地址</span><em><?php  echo $_W['siteroot'];?>api.php?hash=<?php  echo $childrow['hash'];?></em></li>
						<li><span>Token</span><em><?php  echo $childrow['token'];?></em></li>
						<li><span>操作功能</span><em><a onclick="return confirm('删除帐号将同时删除全部规则及回复，确认吗？');return false;" href="<?php  echo create_url('account/delete', array('id' => $childrow['weid']))?>">删除</a><a href="<?php  echo create_url('account/post', array('id' => $childrow['weid']))?>">编辑</a><a href="<?php  echo create_url('account/switch', array('id' => $childrow['weid']))?>" onclick="return ajaxopen(this.href, function(s) {switchHandler(s)})">分销管理</a></em></li>
					</ul>
					<?php  } } ?>
					<?php  } ?>
				</td>
				</tr>
			</table>
			<?php  } } ?>
		</div>
		<?php  echo $pager;?>
	</div>
<script>
	function switchHandler(s) {
		if (window.top.frames['main'].location.href.indexOf('global') > -1) {
			window.top.location.href = 'index.php?do=profile';
		}
		window.top.location.href = 'index.php?do=profile';
	}
	$(".account-main").each(function(i) {
		//处理左侧高度
		$(".account-main").eq(i).find(".account-left .account-left-main").height($(".account-main").eq(i).find(".account-left").height()-30);
		//复制处理
		var info = $(".account-main").eq(i).find(".account-right .account-info:eq(0) li");
		info.eq(2).zclip({
			path:'./resource/script/ZeroClipboard.swf',
			copy:info.eq(2).find("em").html()
		});
		info.eq(3).zclip({
			path:'./resource/script/ZeroClipboard.swf',
			copy:info.eq(3).find("em").html()
		});
		//公众号信息切换
		$(this).find(".account-left .account-name").delegate("span", "click", function(){
			$(".account-main").eq(i).find(".account-right .account-info").hide();
			$(".account-main").eq(i).find(".account-left span").attr('class', '');
			if ($('#' + this.id + '-content')) {
				$('#' + this.id + '-content').show();
			}
			this.className = 'active';
			//复制处理
			if($(this).attr("copy-status") == 0) {
				$('#' + this.id + '-content li').eq(2).zclip({
					path:'./resource/script/ZeroClipboard.swf',
					copy:$('#' + this.id + '-content li').eq(2).find("em").html()
				});
				$('#' + this.id + '-content li').eq(3).zclip({
					path:'./resource/script/ZeroClipboard.swf',
					copy:$('#' + this.id + '-content li').eq(3).find("em").html()
				});
				$(this).attr("copy-status", 1);
			}
		});
		$(this).find(".account-right").delegate(".account-info", "mouseover", function(){
			var data = $(this).find("li:eq(0)").attr("data");
			if(data == '') $(this).find("li:eq(0)").attr("data", $(this).find("li:eq(0) em").html());
			$(this).find("li:eq(0) em").html("鼠标左键点击链接或者Token即可自动复制").css('color', 'red')
		});
		$(this).find(".account-right").delegate(".account-info", "mouseout", function(){
			var data = $(this).find("li:eq(0)").attr("data");
			$(this).find("li:eq(0) em").html(data).css('color', '');
		});
	});
</script>
<?php  include template('common/footer', TEMPLATE_INCLUDEPATH);?>
