<?php defined('IN_IA') or exit('Access Denied');?><?php  include template('common/header', TEMPLATE_INCLUDEPATH);?>
<script type="text/javascript">
	var pIndex = 1;
	var action = '';
	var uid = '<?php  echo $uid;?>';
	$(function(){
		$('#aWechat').click(function(){
			pIndex = 1;
			action = 'wechat';
			ajaxshow('<?php  echo create_url('member/select', array('do' => 'account', 'owner'=>$uid));?>', '请选择所属的公众号码', {width: 800, height: 700}, {hidden: function(){location.href = location.href;}});
		});
		$('#aModule').click(function(){
			pIndex = 1;
			ajaxshow('<?php  echo create_url('member/select', array('do' => 'module', 'owner'=>$uid));?>', '请选择允许访问的模块', {width: 800, height: 700}, {hidden: function(){location.href = location.href;}});
		});
		$('#aTemplate').click(function(){
			pIndex = 1;
			ajaxshow('<?php  echo create_url('member/select', array('do' => 'template', 'owner'=>$uid));?>', '请选择允许访问的模块', {width: 800, height: 700}, {hidden: function(){location.href = location.href;}});
		});
	});
	var aW = {};
	aW.query = function() {
		var kwd = $('#wKeyword').val();
		$.post('<?php  echo create_url('member/select', array('do' => 'account', 'owner'=>$uid));?>', {keyword: kwd, page: pIndex}, function(dat){
			$('#modal-message .modal-body').html(dat);
		});
	}
	aW.auth = function(weid) {
		if(isNaN(parseInt(weid))) {
			return;
		}
		$.post('<?php  echo create_url('member/permission');?>', {'do': 'auth', 'mod': 'account', uid: uid, wechat: weid}, function(dat){
			if(dat == 'success') {
				aW.query();
			} else {
				alert('操作失败, 请稍后重试, 服务器返回信息为: ' + dat);
			}
		});
	}
	aW.revo = function(weid) {
		if(isNaN(parseInt(weid))) {
			return;
		}
		if(!confirm('确定要收回这个公众号的管理权限吗? 在重新分配用户之前, 只有管理员才能访问此公众号.')) {
			return;
		}
		$.post('<?php  echo create_url('member/permission');?>', {'do': 'revo', 'mod': 'account', uid: uid, wechat: weid}, function(dat){
			if(dat == 'success') {
				aW.query();
			} else {
				alert('操作失败, 请稍后重试, 服务器返回信息为: ' + dat);
			}
		});
	}
	aW.revos = function() {
		if($('.wechats:checked').length == 0) {
			return;
		}
		var weids = [];
		$('.wechats:checked').each(function(){
			weids.push($(this).val());
		});
		$.post('<?php  echo create_url('member/permission');?>', {'do': 'revos', 'mod': 'account', uid: uid, wechats: weids.join(',')}, function(dat){
			if(dat == 'success') {
				location.href = location.href;
			} else {
				alert('操作失败, 请稍后重试, 服务器返回信息为: ' + dat);
			}
		});
	}

	var aM = {};
	aM.query = function() {
		$.post('<?php  echo create_url('member/select', array('do' => 'module', 'owner'=>$uid));?>', function(dat){
			$('#modal-message .modal-body').html(dat);
		});
	}
	aM.auth = function(mid) {
		if(isNaN(parseInt(mid))) {
			return;
		}
		$.post('<?php  echo create_url('member/permission');?>', {'do': 'auth', 'mod': 'module', uid: uid, mid: mid}, function(dat){
			if(dat == 'success') {
				aM.query();
			} else {
				alert('操作失败, 请稍后重试, 服务器返回信息为: ' + dat);
			}
		});
	}
	aM.revo = function(mid) {
		if(isNaN(parseInt(mid))) {
			return;
		}
		if(!confirm('确定要收回这个模块的访问权限吗? ')) {
			return;
		}
		$.post('<?php  echo create_url('member/permission');?>', {'do': 'revo', 'mod': 'module', uid: uid, mid: mid}, function(dat){
			if(dat == 'success') {
				aM.query();
			} else {
				alert('操作失败, 请稍后重试, 服务器返回信息为: ' + dat);
			}
		});
	}
	aM.revos = function() {
		if($('.modules:checked').length == 0) {
			return;
		}
		var mids = [];
		$('.modules:checked').each(function(){
			mids.push($(this).val());
		});
		$.post('<?php  echo create_url('member/permission');?>', {'do': 'revos', 'mod': 'module', uid: uid, mids: mids.join(',')}, function(dat){
			if(dat == 'success') {
				location.href = location.href;
			} else {
				alert('操作失败, 请稍后重试, 服务器返回信息为: ' + dat);
			}
		});
	}

	var aT = {};
	aT.query = function() {
		$.post('<?php  echo create_url('member/select', array('do' => 'template', 'owner'=>$uid));?>', function(dat){
			$('#modal-message .modal-body').html(dat);
		});
	}
	aT.auth = function(mid) {
		if(isNaN(parseInt(mid))) {
			return;
		}
		$.post('<?php  echo create_url('member/permission');?>', {'do': 'auth', 'mod': 'template', uid: uid, mid: mid}, function(dat){
			if(dat == 'success') {
				aT.query();
			} else {
				alert('操作失败, 请稍后重试, 服务器返回信息为: ' + dat);
			}
		});
	}
	aT.revo = function(mid) {
		if(isNaN(parseInt(mid))) {
			return;
		}
		if(!confirm('确定要收回这个模块的访问权限吗? ')) {
			return;
		}
		$.post('<?php  echo create_url('member/permission');?>', {'do': 'revo', 'mod': 'template', uid: uid, mid: mid}, function(dat){
			if(dat == 'success') {
				aT.query();
			} else {
				alert('操作失败, 请稍后重试, 服务器返回信息为: ' + dat);
			}
		});
	}
	aT.revos = function() {
		if($('.modules:checked').length == 0) {
			return;
		}
		var mids = [];
		$('.modules:checked').each(function(){
			mids.push($(this).val());
		});
		$.post('<?php  echo create_url('member/permission');?>', {'do': 'revos', 'mod': 'template', uid: uid, mids: mids.join(',')}, function(dat){
			if(dat == 'success') {
				location.href = location.href;
			} else {
				alert('操作失败, 请稍后重试, 服务器返回信息为: ' + dat);
			}
		});
	}

	function p(url, p, state) {
		pIndex = p;
		if(action == 'wechat') {
			aW.query();
		}
	}
</script>
<style>
.form th {
	width: auto;
}
</style>
<ul class="nav nav-tabs">
	<li><a href="<?php  echo create_url('member/create');?>">添加用户</a></li>
	<li><a href="<?php  echo create_url('member/display');?>">用户列表</a></li>
	<li class="active"><a href="<?php  echo create_url('member/permission', array('uid' => $uid));?>">编辑用户权限</a></li>
</ul>
<div class="main">
	<div class="stat">
		<div class="stat-div" style="padding-bottom:50px;">
			<div class="navbar navbar-static-top">
				<div class="navbar-inner">
					<span class="brand">分配用户权限</span>
				</div>
			</div>
			<div class="sub-item" id="table-list">
				<h4 class="sub-title">当前用户所属的公众号</h4>
				<div class="sub-content">
					<table class="table table-hover">
						<thead class="navbar-inner">
							<tr>
								<th style="width:40px;" class="row-first">选择</th>
								<th>公众号名称<i></i></th>
								<th>微信号码</th>
								<th>公众号类型</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
						<?php  if(is_array($wechats)) { foreach($wechats as $wechat) { ?>
							<tr>
								<td class="row-first"><input class="wechats" type="checkbox" value="<?php  echo $wechat['weid'];?>" /></td>
								<td><?php  echo $wechat['name'];?></td>
								<td><?php  echo $wechat['account'];?></td>
								<td><?php  if(!empty($wechat['key']) && !empty($wechat['secret'])) { ?><span class="badge badge-info">服务号</span><?php  } else { ?><span class="badge badge-success">订阅号</span><?php  } ?></td>
								<td><a href="<?php  echo create_url('account/post', array('id' => $wechat['weid']));?>">编辑</a></td>
							</tr>
						<?php  } } ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="btn-group" style="margin-left:20px;">
				<input id="aWechat" class="btn btn-primary span3" type="button" value="选择所属的公众号">
				<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu">
					<li><a href="javascript:;" onclick="aW.revos();">收回所选账号管理权限</a></li>
				</ul>
			</div>
			<div class="sub-item" id="table-list">
				<h4 class="sub-title">设置当前用户允许访问的模块</h4>
				<div class="sub-content">
					<table class="table table-hover">
						<thead class="navbar-inner">
							<tr>
								<th style="width:40px;" class="row-first">选择</th>
								<th>模块名称</th>
								<th>模块标识</th>
								<th>功能简介</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php  if(is_array($modules)) { foreach($modules as $module) { ?>
							<tr>
								<td class="row-first"><?php  if(!$module['issystem']) { ?><?php  if(!empty($groupsmodules['modules']) && in_array($module['mid'], $groupsmodules['modules'])) { ?><span class="label label-info">继承用户组</span><?php  } else { ?><input class="modules" type="checkbox" value="<?php  echo $module['mid'];?>" /><?php  } ?><?php  } ?></td>
								<td><?php  echo $module['title'];?></td>
								<td><?php  echo $module['name'];?></td>
								<td><?php  echo $module['ability'];?></td>
								<td><?php  if($module['issystem']) { ?><span class="label label-success">系统模块</span><?php  } ?></td>
							</tr>
							<?php  } } ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="btn-group" style="margin-left:20px;">
				<input id="aModule" class="btn btn-primary span3" type="button" value="选择允许访问的模块">
				<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu">
					<li><a href="javascript:;" onclick="aM.revos();">收回所选模块访问权限</a></li>
				</ul>
			</div>
			<div class="sub-item" id="table-list">
				<h4 class="sub-title">设置当前用户允许访问的模板</h4>
				<div class="sub-content">
					<table class="table table-hover">
						<thead class="navbar-inner">
							<tr>
								<th style="width:40px;" class="row-first">选择</th>
								<th>模板名称</th>
								<th>模板标识</th>
								<th>功能简介</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php  if(is_array($templates)) { foreach($templates as $temp) { ?>
							<tr>
								<td class="row-first"><?php  if($temp['name'] != 'default') { ?><?php  if(!empty($groupsmodules['templates']) && in_array($temp['id'], $groupsmodules['templates'])) { ?><span class="label label-info">继承用户组</span><?php  } else { ?><input class="modules" type="checkbox" value="<?php  echo $temp['id'];?>" /><?php  } ?><?php  } ?></td>
								<td><?php  echo $temp['title'];?></td>
								<td><?php  echo $temp['name'];?></td>
								<td><?php  echo $temp['description'];?></td>
								<td></td>
							</tr>
							<?php  } } ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="btn-group" style="margin-left:20px;">
				<input id="aTemplate" class="btn btn-primary span3" type="button" value="选择允许访问的模板">
				<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu">
					<li><a href="javascript:;" onclick="aT.revos();">收回所选模块访问权限</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<?php  include template('common/footer', TEMPLATE_INCLUDEPATH);?>
