<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<?php  include $this->template('common', TEMPLATE_INCLUDEPATH);?>
<div class="main">
	<ul class="nav nav-tabs">
		<li<?php  if($_GPC['do'] == 'manage') { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('manage');?>">大转盘管理</a></li>
		<li<?php  if($_GPC['do'] == 'post') { ?> class="active"<?php  } ?>><a href="<?php  echo create_url('rule/post',array('module'=>'bigwheel'));?>">添加大转盘规则</a></li>
		<li<?php  if($_GPC['do'] == 'awardlist') { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('awardlist',array('name'=>'bigwheel', 'rid' => $rid));?>">中奖名单</a></li>
	</ul>
		<div class="search">
		<form action="site.php" method="get">
		<input type="hidden" name="act" value="module" />
		<input type="hidden" name="name" value="bigwheel" />
		<input type="hidden" name="do" value="awardlist" />
		<input type="hidden" name="rid" value="<?php  echo $_GPC['rid'];?>" />
		<table class="table table-bordered tb">
			<tbody>
				<tr>
					<th>关键字</th>
					<td>
						<input class="span6" name="keywords" id="" type="text" value="<?php  echo $_GPC['keywords'];?>">
						 可查询SN码,手机号
					</td>
				</tr>	<tr>
					<th>状态</th>
					<td>
						<select name="status" class="input-small" style="float:left">
                                        <option value="">全部</option>
                                        <option value="1">未发放</option>
                                        <option value="2">已发放</option>
                                        <option value="3">已消费</option>
                                    </select>
                                    <button class="btn btn-primary pull-left span2" style='margin-left:95px;'><i class="icon-search icon-large"></i> 搜索</button>
					</td>
				</tr>
			 
			</tbody>
		</table>
		</form>
	</div>
		<div style="padding: 0 15px 0  15px;">
		  <div class="row-fluid">
                                <div class="span8 control-group">
                                    <a class="btn" href="<?php  echo create_url('site/module', array('do' => 'download', 'name' => 'bigwheel','rid'=>$rid))?>"><i class="icon-download-alt"></i>导出SN码和兑奖信息</a>
                                    <a class="btn" href="<?php  echo create_url('site/module', array('do' => 'awardlist', 'name' => 'bigwheel','rid'=>$rid))?>">全部</a>
                                    <a class="btn" href="<?php  echo create_url('site/module', array('do' => 'awardlist', 'name' => 'bigwheel','rid'=>$rid,'status'=>1))?>">已中奖</a>
                                    <a class="btn" href="<?php  echo create_url('site/module', array('do' => 'awardlist', 'name' => 'bigwheel','rid'=>$rid,'status'=>2))?>">已消费</a>
                                </div>
                            </div>

                            <div class="alert">
                                本次活动奖品总数：<?php  echo $num1;?>个　 　抽中未兑换：<?php  echo $num2;?>个　　抽中已兑换：<?php  echo $num3;?>个 领取规则先到先得！
                            </div>
		</div>
	<div style="padding: 0 15px 0  15px;" style="position:relative">
		<table class="table table-hover" style="position:relative">
			<thead class="navbar-inner">
				<tr><th>序号</th>
                                                <th>SN码</th>
                                                <th>奖品类别</th>
                                                <th>状态</th>
                                                <th width="120px">领取者手机号</th>
                                                <th>领取者微信码</th>
                                                <th>中奖时间</th>
                                                <th>使用时间</th>
                                                <th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $row) { ?>
				<tr>
				<td><?php  echo $row['id'];?></td>
                                                <td><?php  echo $row['award_sn'];?></td>
                                                <td><?php  echo $row['name'];?></td>
                                                <td><?php  if($row['status']==0) { ?><span class="label">未领取</span><?php  } else if($row['status']==1) { ?><span class="label label-green">已中奖</span><?php  } else { ?><span class="label label-red">已兑奖</span><?php  } ?></td>
                                                <td><span class="label label-teal phone" data-fans="<?php  echo $row['from_user'];?>"}>显示手机号</span></td>
                                                <td><?php  echo $row['from_user'];?></td>
                                                <td><?php  echo date('Y/m/d H:i',$row['createtime']);?></td>
                                                <td><?php  if($row['consumetime'] == 0) { ?>未使用<?php  } else { ?><?php  echo date('Y/m/d H:i',$row['consumetime']);?><?php  } ?></td>
                                                <td>
                                                   
                                                                <a class="btn" href="#" onclick="drop_confirm('确认设置为未发放?','<?php  echo create_url('site/module', array('do' => 'setstatus', 'name' => 'bigwheel','status'=>0,'id'=>$row['id'],'rid'=>$row['rid']))?>');"><i class="icon-ban-circle"></i> 未发放</a>
                                                           
                                                                <a class="btn" href="#" onclick="drop_confirm('确认设置为已抽中?','<?php  echo create_url('site/module', array('do' => 'setstatus', 'name' => 'bigwheel','status'=>1,'id'=>$row['id'],'rid'=>$row['rid']))?>');"><i class="icon-remove-circle"></i> 已抽中</a>
                                                           
                                                                <a class="btn" href="#" onclick="drop_confirm('确认设置为已兑奖?','<?php  echo create_url('site/module', array('do' => 'setstatus', 'name' => 'bigwheel','status'=>2,'id'=>$row['id'],'rid'=>$row['rid']))?>');"><i class="icon-ok-circle"></i> 已兑奖</a>
                                                            
                                                        </ul>
                                                    </div>
                                                </td>
				</tr>
				<?php  } } ?>
				
			</tbody>
		</table>
		<?php  echo $pager;?>
	</div>
	
</div>
<script>
$(".phone").click(function() {
	$(".phone").addClass('label-teal');
	$(".phone").text('显示手机号');
	obj=$(this);
	obj.text('加载中...');
	fans=obj.attr('data-fans');
	$.post("<?php  echo create_url('site/module', array('do' => 'getphone','name' => 'bigwheel','rid'=>$rid))?>", { fans: fans},
	function(data){
		obj.removeClass('label-teal');
		obj.text(data);
	});

});
	function drop_confirm(msg, url){
    if(confirm(msg)){
        window.location = url;
    }
}
</script>
<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>