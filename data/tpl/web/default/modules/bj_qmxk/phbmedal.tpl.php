<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<?php  include $this->template('common', TEMPLATE_INCLUDEPATH);?>
<ul class="nav nav-tabs">
		<li><a href="<?php  echo $this->createWebUrl('fansmanager');?>">代理</a></li>
	<li ><a href="<?php  echo $this->createWebUrl('fansmanager', array('op'=>'nocheck'));?>">非代理</a></li>

	<li <?php  if($operation == 'post') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('phbmedal', array('op' => 'post'))?>"><?php  if(!empty($phbmedal['id'])) { ?>编辑 <?php  } else { ?> 添加<?php  } ?>粉丝排行头衔</a></li>
	<li <?php  if($operation == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('phbmedal', array('op' => 'display'))?>">管理粉丝排行头衔</a></li>
</ul>
<?php  if($operation == 'post') { ?>
<div class="main">
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php  echo $phbmedal['id'];?>" />
		<h4>粉丝排行头衔详细设置</h4>
		<table class="tb">
			<tr>
				<th><label for="">头衔名称</label></th>
				<td>
					<input type="text" name="medal_name" class="span6" value="<?php  echo $phbmedal['medal_name'];?>" />
				</td>
			</tr>
                       
			<tr>
				<th><label for="">所需粉丝数</label></th>
				<td>
					<input type="text" name="fans_count" class="span6" value="<?php  echo $phbmedal['fans_count'];?>" />
				</td>
			</tr>
                                  
			<tr>
				<th></th>
				<td>
					<input name="submit" type="submit" value="提交" class="btn btn-primary span3">
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
				</td>
			</tr>
		</table>
	</form>
</div>
<script type="text/javascript" src="./resource/script/colorpicker/spectrum.js"></script>
<link type="text/css" rel="stylesheet" href="./resource/script/colorpicker/spectrum.css" />
<script type="text/javascript">
<!--
	$(function(){
		colorpicker();
	});
//-->
</script>
<?php  } else if($operation == 'display') { ?>
<div class="main">
	<div class="phbmedal">
		<form action="" method="post" onsubmit="return formcheck(this)">
		<table class="table table-hover">
			<thead>
				<tr>
					<th style="width:10px;"></th>
					<th style="width:100px;">头衔名称</th>
					<th style="width:90px;">所需粉丝数</th>
					<th style="width:80px;">操作</th>
				</tr>
			</thead>
			<tbody>
			<?php  if(is_array($list)) { foreach($list as $row) { ?>
				<tr>
							<td></td>
					<td><?php  echo $row['medal_name'];?></td>
          	<td><?php  echo $row['fans_count'];?></td>                            
          <td><a href="<?php  echo $this->createWebUrl('phbmedal', array('op' => 'post', 'id' => $row['id']))?>">编辑</a>&nbsp;&nbsp;<a href="<?php  echo $this->createWebUrl('phbmedal', array('op' => 'delete', 'id' => $row['id']))?>" onclick="return confirm('确认删除此头衔吗？');return false;">删除</a></td>
							
				</tr>
			
			<?php  } } ?>
				<tr>
					<td></td>
					<td colspan="4">
						<a href="<?php  echo $this->createWebUrl('phbmedal', array('op' => 'post'))?>"><i class="icon-plus-sign-alt"></i> 添加新头衔</a>
					</td>
				</tr>
				<tr>
					<td></td>
					<td colspan="4">
						<input name="submit" type="submit" class="btn btn-primary" value="提交">
						<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
					</td>
				</tr>
			</tbody>
		</table>
		</form>
	</div>
</div>
<?php  } ?>
<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>
