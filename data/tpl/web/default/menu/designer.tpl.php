<?php defined('IN_IA') or exit('Access Denied');?><?php  include template('common/header', TEMPLATE_INCLUDEPATH);?>
<script type="text/javascript" src="./resource/script/jquery-ui-1.10.3.min.js"></script>
<script type="text/javascript">
	var pIndex = 1;
	var currentEntity = null;
	$(function(){
		$('tbody.mlist').sortable({handle: '.icon-move'});
		$('.smlist').sortable({handle: '.icon-move'});
		$('.mlist .hover').each(function(){
			$(this).data('do', $(this).attr('data-do'));
			$(this).data('url', $(this).attr('data-url'));
			$(this).data('forward', $(this).attr('data-forward'));
		});
		$('.mlist .hover .smlist div').each(function(){
			$(this).data('do', $(this).attr('data-do'));
			$(this).data('url', $(this).attr('data-url'));
			$(this).data('forward', $(this).attr('data-forward'));
		});
		$(':radio[name="ipt"]').click(function(){
			if(this.checked) {
				if($(this).val() == 'url') {
					$('#url-container').show();
					$('#forward-container').hide();
				} else {
					$('#url-container').hide();
					$('#forward-container').show();
				}
			}
		});
		$('#dialog').modal({backdrop: 'static', keyboard: false, show: false});
		//模拟关键字搜索
		$('#ipt-forward').keydown(function(event){
			if(event.keyCode == 13){
				$('#search').click();
			}
		});
		$('#dialog').click(function(event){
			var clickid = $(event.target).attr('id');
			if(clickid != 'key-result' && clickid != 'ipt-forward'  && clickid != 'search') {
				$('#key-result').hide();
				return;
			}
		});
		$('#search').click(function(){
			var search_value = $('#ipt-forward').val();
			$.post("<?php  echo create_url('menu/designer/search_key')?>", {'key_word' : search_value}, function(data){
				var data = $.parseJSON(data);
				var total = data.length;
				var html = '';
				if(total > 0) {
					for(var i = 0; i < total; i++) {
						html += '<li><a href="javascript:;">' + data[i] + '</a></li>';
					}
				} else {
					html += '<li><a href="javascript:;" id="no-result">没有找到您输入的关键字</a></li>';
				}
				$('#key-result ul').html(html);
				$('#key-result ul li a[id!="no-result"]').click(function(){
					$('#ipt-forward').val($(this).html());
					$('#key-result').hide();
				});
				$('#key-result').show();
			});
		});		
	});
	function addMenu() {
		if($('.mlist .hover').length >= 3) {
			return;
		}
		var html = '<tr class="hover" data-url="">'+
						'<td>'+
							'<div class="menu">'+
								'<input type="text" class="span4" value=""> &nbsp; &nbsp; '+
								'<a href="javascript:;" class="icon-move" title="拖动调整此菜单位置"></a> &nbsp; '+
                                '<a href="javascript:;" onclick="selectEmoji($(this))" title="表情"><i class="icon-github-alt"></i></a> &nbsp; '+
								'<a href="javascript:;" onclick="setMenuAction($(this).parent().parent().parent());" class="icon-edit" title="设置此菜单动作"></a> &nbsp; '+
								'<a href="javascript:;" onclick="deleteMenu(this)" class="icon-remove-sign" title="删除此菜单"></a> &nbsp; '+
								'<a href="javascript:;" onclick="addSubMenu($(this).parent().next());" title="添加子菜单" class="icon-plus-sign" title="添加菜单"></a> '+
							'</div>'+
							'<div class="smlist submenu"></div>'+
						'</td>'+
					'</tr>';
		$('tbody.mlist').append(html);
	}
	function addSubMenu(o) {
		if(o.find('div').length >= 5) {
			return;
		}

		var html = '' +
                    '<div style="margin-top:20px;padding-left:80px;background:url(\'./resource/image/bg_repno.gif\') no-repeat -245px -545px;" data-url="">'+
                        '<input type="text" class="span3" value=""> &nbsp; &nbsp; '+
                        '<a href="javascript:;" class="icon-move" title="拖动调整此菜单位置"></a> &nbsp; '+
                        '<a href="javascript:;" onclick="selectEmoji($(this),\'submenu\')" class="icon-github-alt" title="表情"></a> &nbsp; '+
                        '<a href="javascript:;" onclick="setMenuAction($(this).parent());" class="icon-edit" title="设置此菜单动作"></a> &nbsp; '+
                        '<a href="javascript:;" onclick="deleteMenu(this)" class="icon-remove-sign" title="删除此菜单"></a> '+
                    '</div>';
		o.append(html);
	}
	function deleteMenu(o) {
		if($(o).parent().parent().hasClass('smlist')) {
			$(o).parent().remove();
		} else {
			$(o).parent().parent().parent().remove();
		}
	}
	function setMenuAction(o) {
		if(o == null) return;
		if(o.find('.smlist div').length > 0) {
			message('该菜单含有子菜单,不能设置动作', '', 'error')
			return;
		}
		currentEntity = o;
		$('#ipt-forward').val($(o).data('forward'));
		if ($(o).data('do') == 'click') {
			$(':radio[value="forward"]').attr('checked', 'checked');
		} else if ($(o).data('do') == 'view') {
			$(':radio[value="url"]').attr('checked', 'checked');
		} else {
			$(':radio[value="'+$(o).data('do')+'"]').attr('checked', 'checked');
		}
		var url = $(o).data('url');
		if (url === '' || url === undefined) {
			$('#ipt-url').val('http://');
		} else {
			$('#ipt-url').val($(o).data('url'));
		}
		$(':radio:checked').trigger('click');
		$('#dialog').modal('show');
	}
	function saveMenuAction(e) {
		var o = currentEntity;
		var t = $(':radio:checked').val();
		if (t == 'forward') {
			t = 'click';
		} else if (t == 'url') {
			t = 'view';
		}
		if(o == null) return;
		if (t == 'view') {
			if (!/^(http|https)(.*)/.test($('#ipt-url').val())) {
				if (e == 'save') {
					alert('由于公众平台限制，URL必须以http或是https开头。');
					return false;
				} else {
					$(o).data('url', 'http://');
				}
			} else {
				$(o).data('url', $('#ipt-url').val());
			}
		}
		$(o).data('do', t);
		$(o).data('forward', $('#ipt-forward').val());
	}
	function saveMenu(type) {
		$('#menutype').val(type);
		if (type == 'history') {
			$('#form')[0].submit();
		}
		if($('.span4:text').length > 3) {
			message('不能输入超过 3 个主菜单才能保存.', '', 'error');
			return;
		}
		if($('.span4:text,.span3:text').filter(function(){ return $.trim($(this).val()) == '';}).length > 0) {
			message('存在未输入名称的菜单.', '', 'error');
			return;
		}
		var dat = '[';
		var error = false;
		$('.mlist .hover').each(function(){
			var name = $.trim($(this).find('.span4:text').val()).replace(/"/g, '\"');
			
			if ($(this).data('do') == 'forward') {
				var type = 'click';
			} else if ($(this).data('do') == 'url') {
				var type = 'view';
			} else {
				var type = $(this).data('do');
			}
			var url = $(this).data('url');
			if(!url) {
				url = '';
			}
			var forward = $.trim($(this).data('forward'));
			if(!forward) {
				forward = '';
			}
			dat += '{"name": "' + name + '"';
			if($(this).find('.smlist div').length > 0) {
				dat += ',"sub_button": [';
				$(this).find('.smlist div').each(function(){
					var sName = $.trim($(this).find('.span3:text').val()).replace(/"/g, '\"');
					if ($(this).data('do') == 'forward') {
						var sType = 'click';
					} else if ($(this).data('do') == 'url') {
						var sType = 'view';
					} else {
						var sType = $(this).data('do');
					}
					var sUrl = $(this).data('url');
					if(!sUrl) {
						sUrl = '';
					}
					var sForward = $.trim($(this).data('forward'));
					if(!sForward) {
						sForward = '';
					}
					dat += '{"name": "' + sName + '"';
					if((sType != 'view' && sForward == '') || (sType == 'view' && !sUrl)) {
						message('子菜单项 “' + sName + '”未设置对应规则.', '', 'error');
						error = true;
						return false;
					}
					if(sType == 'click') {
						dat += ',"type": "click","key": "' + encodeURIComponent(sForward) + '"';
					} else if(sType == 'view') {
						dat += ',"type": "view","url": "' + sUrl + '"';
					} else {
						dat += ',"type": "'+sType+'","key": "' + encodeURIComponent(sForward) + '"';
					}

					dat += '},';
				});
				if(error) {
					return false;
				}
				dat = dat.slice(0,-1);
				dat += ']';
			} else {
				if((type != 'view' && forward == '') || (type == 'view' && !url)) {
					message('菜单 “' + name + '”不存在子菜单项, 且未设置对应规则.', '', 'error');
					error = true;
					return false;
				}

				if(type == 'click') {
					dat += ',"type": "click","key": "' + encodeURIComponent(forward) + '"';
				} else if(type == 'view') {
					dat += ',"type": "view","url": "' + url + '"';
				} else {
					dat += ',"type": "'+type+'","key": "' + encodeURIComponent(forward) + '"';
				}
			}
			dat += '},';
		});
		if(error) {
			return false;
		}
		dat = dat.slice(0,-1);
		dat += ']';
		$('#do').val(dat);
 		$('#form')[0].submit();
	}

	function selectEmoji(obj, type) {
		var emoji = ajaxshow('<?php  echo create_url('site/emoji')?>', '请选择表情', {width : 800});
		if (typeof obj == 'object') {
			$('#menu-index').attr('data-subindex', '');
			if (type == 'submenu') {
				$('#menu-index').attr('data-subindex', obj.parent().index());
				var obj = obj.parent().parent().parent().parent();
			} else {
				var obj = obj.parent().parent().parent();
			}
			$('#menu-index').val(obj.index() - 1);
		}
		return emoji;
	}
</script>
<style type="text/css">
	.table-striped td{padding-top: 10px;padding-bottom: 10px}
	a{font-size:14px;}
	a:hover, a:active{text-decoration:none; color:red;}
	.hover td{padding-left:10px;}
</style>
<div class="main">
	<div class="form form-horizontal">
		<h4>菜单设计器 <small>编辑和设置微信公众号码, 必须是服务号才能编辑自定义菜单。</small></h4>
		<table class="tb table-striped">
			<tbody class="mlist">
			<input type="hidden" id="menu-index" value="" data-subindex="" />
 			<?php  if(!empty($menus['menu']['button'])) { ?>
			<?php  if(is_array($menus['menu']['button'])) { foreach($menus['menu']['button'] as $row) { ?>
			<tr class="hover" data-do="<?php  echo $row['type'];?>" data-url="<?php  echo $row['url'];?>" data-forward="<?php  echo $row['forward'];?>">
					<td>
						<div class="menu">
							<input type="text" class="span4" value="<?php  echo $row['name'];?>"> &nbsp; &nbsp;
							<a href="javascript:;" class="icon-move" title="拖动调整此菜单位置"></a> &nbsp;
							<a href="javascript:;" onclick="selectEmoji($(this))" class="icon-github-alt" title="表情"></a> &nbsp;
							<a href="javascript:;" onclick="setMenuAction($(this).parent().parent().parent());" class="icon-edit" title="设置此菜单动作"></a> &nbsp;
							<a href="javascript:;" onclick="deleteMenu(this)" class="icon-remove-sign" title="删除此菜单"></a> &nbsp;
							<a href="javascript:;" onclick="addSubMenu($(this).parent().next());" title="添加子菜单" class="icon-plus-sign" title="添加菜单"></a>
						</div>
						<div class="smlist submenu">
							<?php  if(!empty($row['sub_button'])) { ?>
							<?php  if(is_array($row['sub_button'])) { foreach($row['sub_button'] as $btn) { ?>
							<div style="margin-top:20px;padding-left:80px;background:url('./resource/image/bg_repno.gif') no-repeat -245px -545px;" data-do="<?php  echo $btn['type'];?>" data-url="<?php  echo $btn['url'];?>" data-forward="<?php  echo $btn['forward'];?>">
								<input type="text" class="span3" value="<?php  echo $btn['name'];?>"> &nbsp; &nbsp;
								<a href="javascript:;" class="icon-move" title="拖动调整此菜单位置"></a> &nbsp;
								<a href="javascript:;" onclick="selectEmoji($(this), 'submenu')" class="icon-github-alt" title="表情"></a> &nbsp;
								<a href="javascript:;" onclick="setMenuAction($(this).parent());" class="icon-edit" title="设置此菜单动作"></a> &nbsp;
								<a href="javascript:;" onclick="deleteMenu(this)" class="icon-remove-sign" title="删除此菜单"></a>
							</div>
							<?php  } } ?>
							<?php  } ?>
						</div>
					</td>
				</tr>
			<?php  } } ?>
			<?php  } ?>
			</tbody>
		</table>
		<div class="well well-small" style="margin-top:20px;">
			<a href="javascript:;" onclick="addMenu();">添加菜单 <i class="icon-plus-sign" title="添加菜单"></i></a> &nbsp; &nbsp; &nbsp;  <span class="help-inline">可以使用 <i class="icon-move"></i> 进行拖动排序</span>
		</div>
		
		<!-- 历史记录菜单 -->
		<h4>历史记录菜单 <small>最后一次编辑时间：<?php  echo date('Y-m-d H:i:s', $hmenus['createtime']);?> <b><a href="javascript:;" onclick="$('.history-body').fadeToggle();$('.history-foot').fadeToggle();">点击展示</a></b></small></h4>
		<table class="tb table-striped history-body" style="display:none;">
			<tbody class="hmlist">
			<?php  if(!empty($hmenus['menus'])) { ?>
			<?php  if(is_array($hmenus['menus'])) { foreach($hmenus['menus'] as $row) { ?>
			<tr class="hhover" data-do="<?php echo $row['type'] == 'click' ? 'forward' : 'view';?>" data-url="<?php  echo $row['url'];?>" data-forward="<?php  echo $row['forward'];?>">
					<td>
						<div>
							<input type="text" class="hspan4" value="<?php  echo $row['name'];?>" readonly> &nbsp; &nbsp;
							<a href="javascript:;"></a> &nbsp;
							<a href="javascript:;"></a> &nbsp;
							<a href="javascript:;"></a> &nbsp;
							<a href="javascript:;"></a>
						</div>
						<div class="smlist submenu">
							<?php  if(!empty($row['sub_button'])) { ?>
							<?php  if(is_array($row['sub_button'])) { foreach($row['sub_button'] as $btn) { ?>
							<div style="margin-top:20px;padding-left:80px;background:url('./resource/image/bg_repno.gif') no-repeat -245px -545px;" data-do="<?php echo $btn['type'] == 'click' ? 'forward' : 'view';?>" data-url="<?php  echo $btn['url'];?>" data-forward="<?php  echo $btn['forward'];?>">
								<input type="text" class="hspan3" value="<?php  echo $btn['name'];?>" readonly> &nbsp; &nbsp;
								<a href="javascript:;"></a> &nbsp;
								<a href="javascript:;"></a> &nbsp;
								<a href="javascript:;"></a>
							</div>
							<?php  } } ?>
							<?php  } ?>
						</div>
					</td>
				</tr>
			<?php  } } ?>
			<?php  } ?>
			</tbody>
		</table>
		<div class="well well-small history-foot" style="display:none;">
			<a href="javascript:;" onclick="saveMenu('history');" class="btn btn-success span3" style="margin-top:-5px;">使用历史菜单</a>
		</div>
		
		

		<h4>操作 <small>设计好菜单后再进行保存操作</small></h4>
		<table class="tb">
			<tbody>
				<tr>
					<td>
						<input type="button" value="保存菜单结构" class="btn btn-primary span3" onclick="return saveMenu();"/>
						<span class="help-block">保存当前菜单结构至公众平台, 由于缓存可能需要在24小时内生效</span>
					</td>
				</tr>
				<tr>
					<td>
						<input type="button" value="删除" class="btn btn-primary span3" onclick="$('#do').val('remove');$('#form')[0].submit();" />
						<div class="help-block">清除自定义菜单</div>
					</td>
				</tr>
				<tr>
					<td>
						<input type="button" value="刷新" class="btn btn-primary span3" onclick="$('#do').val('refresh');$('#form')[0].submit();" />
						<div class="help-block">重新从公众平台获取菜单信息</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<form action="" method="post" id="form">
	<input id="do" name="do" type="hidden" />
	<input id="menutype" name="menutype" type="hidden" />
</form>
<div id="dialog" class="modal hide">
	<div class="modal-header">
		<button type="button" onClick="saveMenuAction('close')" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3>选择要执行的操作</h3>
	</div>
	<div id="url">
		<div class="well">
			<label class="radio inline">
				<input type="radio" name="ipt" value="url" checked="checked"> 链接
			</label>
			<label class="radio inline">
				<input type="radio" name="ipt" value="forward"> 模拟关键字
			</label>
			<label class="radio inline">
				<input type="radio" name="ipt" value="scancode_push"> 扫码
			</label>
			<label class="radio inline">
				<input type="radio" name="ipt" value="scancode_waitmsg"> 扫码（等待信息）
			</label>
			<label class="radio inline">
				<input type="radio" name="ipt" value="pic_sysphoto"> 系统拍照发图
			</label>
			<label class="radio inline">
				<input type="radio" name="ipt" value="pic_photo_or_album"> 拍照或者相册发图
			</label>
			<label class="radio inline">
				<input type="radio" name="ipt" value="pic_weixin"> 微信相册发图
			</label>
			<label class="radio inline">
				<input type="radio" name="ipt" value="location_select"> 地理位置
			</label>
			<hr />
			<div id="url-container">
				<input class="span6" id="ipt-url" type="text" value="http://" />
				<span class="help-block">指定点击此菜单时要跳转的链接（注：链接需加http://）</span>
				<span class="help-block"><strong>注意: 由于接口限制. 如果你没有网页oAuth接口权限, 这里输入链接直接进入微站个人中心时将会有缺陷(有可能获得不到当前访问用户的身份信息. 如果没有oAuth接口权限, 建议你使用图文回复的形式来访问个人中心)</strong></span>
			</div>
			<div id="forward-container" class="hide" style="position:relative">
				<div class="input-append">
		  		  <input class="span6" id="ipt-forward" type="text">
		   		  <button class="btn btn-primary" type="button" id="search">搜索</button>
		   		</div>
				<div id="key-result" style="position:absolute;top:32px;left:0px;display:none;z-index:10000">
				  <ul class="dropdown-menu span6" style="display:block;"></ul>
				</div>
				<span class="help-block">指定点击此菜单时要执行的操作, 你可以在这里输入关键字, 那么点击这个菜单时就就相当于发送这个内容至运河印象</span>
				<span class="help-block"><strong>这个过程是程序模拟的, 比如这里添加关键字: 优惠券, 那么点击这个菜单是, 运河印象系统相当于接受了粉丝用户的消息, 内容为"优惠券"</strong></span>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<a href="javascript:;" onClick="saveMenuAction('save')" class="pull-right btn btn-primary span2" data-dismiss="modal" aria-hidden="true">保存</a>
	</div>
</div>
<?php  include template('common/footer', TEMPLATE_INCLUDEPATH);?>
