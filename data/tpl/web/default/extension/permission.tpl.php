<?php defined('IN_IA') or exit('Access Denied');?><?php  include template('common/header', TEMPLATE_INCLUDEPATH);?>
<style type="text/css">
table li{padding:5px 0;}
small a{color:#999;}
</style>
<?php  include template('extension/module-tabs', TEMPLATE_INCLUDEPATH);?>
<div class="main">
	<div class="form form-horizontal">
		<h4>模块基本信息 <small>这里来定义你自己模块的基本信息</small></h4>
		<table class="tb">
			<tr>
				<th><label for="">模块名称</label></th>
				<td>
					<?php  echo $module['title'];?>
				</td>
			</tr>
			<tr>
				<th><label for="">模块标识</label></th>
				<td>
					<?php  echo $module['name'];?>
				</td>
			</tr>
			<tr>
				<th><label for="">版本</label></th>
				<td>
					<?php  echo $module['version'];?>
				</td>
			</tr>
			<tr>
				<th><label for="">分类</label></th>
				<td>
					<?php  echo $modtypes[$module['type']];?>
				</td>
			</tr>
			<tr>
				<th><label for="">模块简述</label></th>
				<td>
					<?php  echo $module['ability'];?>
				</td>
			</tr>
			<tr>
				<th><label for="">模块介绍</label></th>
				<td>
					<?php  echo $module['description'];?>
				</td>
			</tr>
			<tr>
				<th><label for="">作者</label></th>
				<td>
					<?php  echo $module['author'];?>
				</td>
			</tr>
			<tr>
				<th><label for="">发布页</label></th>
				<td>
					<?php  echo $module['url'];?>
				</td>
			</tr>
			<?php  if($module['settings']) { ?>
			<tr>
				<th><label for="">设置项</label></th>
				<td>
					存在全局设置项(针对公众号独立保存)
					<?php  if($module['isinstall']) { ?><a href="<?php  echo create_url('member/module/setting', array('mid' => $module['mid']))?>">访问设置项</a><?php  } ?>
				</td>
			</tr>
			<?php  } ?>
			<?php  if($version_error) { ?>
			<tr>
				<th><label for="">版本不兼容</label></th>
				<td>
					当前模块与系统版本不兼容
					<a href="<?php  echo create_url('extension/module/convert', array('id' => $module['name']))?>">转换模块版本</a>
				</td>
			</tr>
			<?php  } else { ?>
			<?php  if($module['isinstall']) { ?>
			<tr>
				<th><label for="">卸载及更新</label></th>
				<td>
					当前模块已安装
					<?php  if($module['upgrade']) { ?><a href="<?php  echo create_url('extension/module/upgrade', array('id' => $module['name']))?>" style="color:red;">更新</a><?php  } ?>
					<?php  if(!$module['issystem']) { ?><a href="<?php  echo create_url('extension/module/uninstall', array('id' => $module['name']))?>">卸载此模块</a><?php  } ?>
				</td>
			</tr>
			<?php  } else { ?>
			<tr>
				<th><label for="">安装模块</label></th>
				<td>
					当前模块还未安装
					<a href="<?php  echo create_url('extension/module/install', array('id' => $module['name']))?>">安装此模块</a>
				</td>
			</tr>
			<?php  } ?>
			<?php  } ?>
			<?php  if($module['issystem']) { ?>
			<tr>
				<th><label for="">系统模块</label></th>
				<td>
					此模块由系统内置, 不能删除
				</td>
			</tr>
			<?php  } ?>
		</table>
		<h4>公众平台消息处理选项</h4>
		<table class="tb">
			<tr>
				<th><label for="">订阅的消息类型</label></th>
				<td>
					<?php  if(empty($module['subscribes'])) { ?>
					<label>
						<i class="icon-check-empty"> &nbsp; 没有订阅任何消息类型</i>
					</label>
					<?php  } else { ?>
					<?php  if(is_array($module['subscribes'])) { foreach($module['subscribes'] as $k => $v) { ?>
					<label>
						<i class="icon-check"> &nbsp; <?php  echo $mtypes[$v];?></i>
					</label>
					<?php  } } ?>
					<?php  } ?>
					<span class="help-block">订阅特定的消息类型后, 此消息类型的消息到达运河印象系统后将会以通知的方式(消息数据只读, 并不能返回处理结果)调用模块的接受器, 用这样的方式可以实现全局的数据统计分析等功能. 请参阅 <a href="http://www.we7.cc/docs/#flow-module-subscribe">模块消息订阅</a></span>
					<div class="alert-warning alert" style="width:auto;margin-top:5px;">注意: 订阅的消息信息是只读的, 只能用作分析统计, 不能更改, 也不能改变运河印象处理主流程</div>
				</td>
			</tr>
			<tr>
				<th><label for="">直接处理的类型</label></th>
				<td>
					<?php  if(empty($module['handles'])) { ?>
					<label>
						<i class="icon-check-empty"> &nbsp; 不能直接处理任何消息类型</i>
					</label>
					<?php  } else { ?>
					<?php  if(is_array($module['handles'])) { foreach($module['handles'] as $k => $v) { ?>
					<label>
						<i class="icon-check"> &nbsp; <?php  echo $mtypes[$v];?></i>
					</label>
					<?php  } } ?>
					<?php  } ?>
					<span class="help-block">当前模块能够直接处理的消息类型(没有上下文的对话语境, 能直接处理消息并返回数据). 如果公众平台传递过来的消息类型不在设定的类型列表中, 那么系统将不会把此消息路由至此模块</span>
					<div class="alert-warning alert" style="width:auto;margin-top:5px;">
						注意: 关键字路由只能针对文本消息有效, 文本消息最为重要. 其他类型的消息并不能被直接理解, 多数情况需要使用文本消息来进行语境分析, 再处理其他相关消息类型
						<br>注意: 上下文锁定的模块不受此限制, 上下文锁定期间, 任何类型的消息都会路由至锁定模块
					</div>
				</td>
			</tr>
			<?php  if($module['isrulefields']) { ?>
			<tr>
				<th><label for="">是否要嵌入规则</label></th>
				<td>
					需要嵌入规则
				</td>
			</tr>
			<?php  } ?>
		</table>
		<h4>微站功能绑定 <small>这里来定义此功能模块中微站的相关功能如何同系统对接</small></h4>
		<table class="tb">
			<?php  if(is_array($points)) { foreach($points as $point => $row) { ?>
			<tr>
				<th><label for=""><?php  echo $row['title'];?></label></th>
				<td>
					<?php  if(!empty($module[$point])) { ?>
					<ul class="unstyled">
						<?php  if(is_array($module[$point])) { foreach($module[$point] as $v) { ?>
						<li>
							<div class="input-prepend">
								<span class="add-on">操作名称</span>
								<span class="uneditable-input span2"><?php  echo $v['title'];?></span>
							</div>
							<div class="input-prepend">
								<span class="add-on">操作入口标识</span>
								<span class="uneditable-input span2"><?php  echo $v['do'];?></span>
							</div>
							<div class="input-prepend">
								<span class="add-on">操作附加参数</span>
								<span class="uneditable-input span2"><?php  echo $v['state'];?></span>
							</div>
							<?php  if($v['direct']) { ?>
							<label class="checkbox inline">
								<i class="icon-check"> &nbsp; 无需登录</i>
							</label>
							<?php  } ?>
						</li>
						<?php  } } ?>
					</ul>
					<span class="help-block"><?php  echo $row['desc'];?></span>
					<span class="help-block"><strong>注意: <?php  echo $row['title'];?>扩展功能定义于 WeSite 类的实现中</strong></span>
					<?php  } else { ?>
					<span class="help-block">未定义</span>
					<?php  } ?>
				</td>
			</tr>
			<?php  } } ?>
		</table>
		<h4>模块发布 <small>这里来定义模块发布时需要的配置项</small></h4>
		<table class="tb">
			<tr>
				<th><label for="">模块缩略图</label></th>
				<td>
					<img class="media-object" src="./source/modules/<?php  echo strtolower($module['name']);?>/icon.jpg" onerror="this.src='./resource/image/module-nopic-small.jpg'">
				</td>
			</tr>
			<tr>
				<th><label for="">模块封面</label></th>
				<td>
					<img class="media-object" src="./source/modules/<?php  echo strtolower($module['name']);?>/preview.jpg" onerror="this.src='./resource/image/module-nopic-big.jpg'">
				</td>
			</tr>
			<tr>
				<th></th>
				<td>
					<input type="button" class="btn btn-primary span3" name="submit" onclick="history.go(-1)" value="返回" />
				</td>
			</tr>
		</table>
	</div>
</div>
<?php  include template('common/footer', TEMPLATE_INCLUDEPATH);?>
