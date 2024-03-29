<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<ul class="nav nav-tabs">
	<li <?php  if($op == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('fansmanager');?>">代理</a></li>
	<li <?php  if($op == 'nocheck') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('fansmanager', array('op'=>'nocheck'));?>">非代理</a></li>
	<li><a href="<?php  echo $this->createWebUrl('phbmedal', array('op' => 'post'))?>">添加粉丝排行头衔</a></li>
	<li ><a href="<?php  echo $this->createWebUrl('phbmedal', array('op' => 'display'))?>">管理粉丝排行头衔</a></li>

</ul>
    <div class="main">
		<div class="stat">
		
			<form action="">
				<input type="hidden" name="act" value="module" />
				<input type="hidden" name="name" value="bj_qmxk" />
				<input type="hidden" name="do" value="fansmanager" />
				<input type="hidden" name="op" value="sort" />
				<table class="table sub-search">
				<table class="table sub-search">
					<tbody>
						<tr>
							<th style="width:100px;">会员姓名</th>
							<td>
								<input name="realname" type="text" value="<?php  echo $sort['realname'];?>" />
							</td>
						</tr>
						<tr>
							<th style="width:100px;">手机号码</th>
							<td>
								<input name="mobile" type="text" value="<?php  echo $sort['mobile'];?>" />
							</td>
						</tr>
						<tr>
							<th></th>
							<td>
								<input type="submit" name="" value="搜索" class="btn btn-primary">
							</td>
						</tr>
					</tbody>
				</table>
			</form>
			
			<div class="stat-div">
				<div class="navbar navbar-static-top">
					<div class="navbar-inner">
						<span class="pull-right" style="color:red; padding:10px 10px 0 0;">总数：<?php  echo $total;?></span>
						<span class="brand">名单</span>
					</div>
				</div>
				<div class="sub-item" id="table-list">
					<h4 class="sub-title">代理名单</h4>

					<form action="" method="post" onsubmit="">
					<div class="sub-content">
						<table class="table table-hover">
							<thead class="navbar-inner">
								<tr>
									<th class="row-hover">会员姓名</th>
									<th class="row-hover">手机号码</th>
									<th class="row-hover">注册时间</th>
								    <th class="row-hover">状态</th>
								  <!--  <th class="row-hover">还需充值</th>-->
								    <th class="row-hover">余额</th>
								      <th class="row-hover">点击数</th>
									<th class="row-hover">操作</th>
								</tr>
							</thead>
							<tbody>
								<?php  if(is_array($list)) { foreach($list as $v) { ?>
								<tr>
									<td style="text-align: center;">
										<?php  echo $v['realname'];?>
									</td>
									<td style="text-align: center;">
										<?php  echo $v['mobile'];?>
									</td>
									<td style="text-align: center;">
										<?php  echo date('Y-m-d',$v['createtime'])?>
									</td>
									<td style="text-align: center;">
									<?php  if($v['status']==0) { ?>
										<span class="label label-important">已禁用</span>
									<?php  } else { ?>
										<span class="label label-success">正常</span>
									<?php  } ?>
									</td>
								  <!-- 		<td style="text-align: center;">
									<?php  if(empty($commission[$v['id']])) { ?>
										0
									<?php  } else { ?>
										<?php  echo $commission[$v['id']]-$v['commission']?>
									<?php  } ?>
									</td>-->
										<td style="text-align: center;">
										
												<?php  echo $v['credit2'];?>
									</td>
									<td style="text-align: center;">
										<?php  echo $v['clickcount'];?>
									</td>
									<td style="text-align: center;">
											<?php  if($v['status']==1) { ?>
										<a href="<?php  echo $this->createWebUrl('fansmanager',array('op'=>'delete','id' => $v['id'],'isstatus' => 0));?>" onclick="return confirm('确定要禁用该代理吗？');">禁用代理身份</a>
										
											<?php  } else { ?>
										<a href="<?php  echo $this->createWebUrl('fansmanager',array('op'=>'delete','id' => $v['id'],'isstatus' => 1));?>" onclick="return confirm('确定要恢复该代理吗？');">恢复代理身份</a>
										
									<?php  } ?>
										<a href="<?php  echo $this->createWebUrl('fansmanager',array('op'=>'detail','id' => $v['id']));?>">详情</a>		
										<a href="<?php  echo $this->createWebUrl('order',array('operation'=>'display','status'=>-99, 'shareid' => $v['id']));?>">推广订单</a>
										<a href="<?php  echo $this->createWebUrl('fansmanager',array('op'=>'user','from_user' => $v['from_user']));?>">代理名单</a>
										<!--<a href="<?php  echo $this->createWebUrl('fansmanager',array('op'=>'recharge','id' => $v['id']));?>">充值</a>-->
									</td>
								</tr>
								<?php  } } ?>
							</tbody>
						</table>
					</div>
					</form>
					<?php  echo $pager;?>
				</div>
			</div>
		</div>
    </div>

<link type="text/css" rel="stylesheet" href="./resource/style/daterangepicker.css" />
<script type="text/javascript" src="./resource/script/daterangepicker.js"></script>
<script>
$(function() {
	$('#date-range').daterangepicker({
		format: 'YYYY-MM-DD',
		startDate: $(':hidden[name=start]').val(),
		endDate: $(':hidden[name=end]').val(),
		locale: {
			applyLabel: '确定',
			cancelLabel: '取消',
			fromLabel: '从',
			toLabel: '至',
			weekLabel: '周',
			customRangeLabel: '日期范围',
			daysOfWeek: moment()._lang._weekdaysMin.slice(),
			monthNames: moment()._lang._monthsShort.slice(),
			firstDay: 0
		}
	}, function(start, end){
		$('#date-range .date-title').html(start.format('YYYY-MM-DD') + ' 至 ' + end.format('YYYY-MM-DD'));
		$(':hidden[name=start]').val(start.format('YYYY-MM-DD'));
		$(':hidden[name=end]').val(end.format('YYYY-MM-DD'));
	});
	$('#date-range1').daterangepicker({
		format: 'YYYY-MM-DD',
		startDate: $(':hidden[name=start1]').val(),
		endDate: $(':hidden[name=end1]').val(),
		locale: {
			applyLabel: '确定',
			cancelLabel: '取消',
			fromLabel: '从',
			toLabel: '至',
			weekLabel: '周',
			customRangeLabel: '日期范围',
			daysOfWeek: moment()._lang._weekdaysMin.slice(),
			monthNames: moment()._lang._monthsShort.slice(),
			firstDay: 0
		}
	}, function(start, end){
		$('#date-range1 .date-title').html(start.format('YYYY-MM-DD') + ' 至 ' + end.format('YYYY-MM-DD'));
		$(':hidden[name=start1]').val(start.format('YYYY-MM-DD'));
		$(':hidden[name=end1]').val(end.format('YYYY-MM-DD'));
	});

});
</script>
<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>