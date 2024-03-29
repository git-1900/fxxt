<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<ul class="nav nav-tabs">
	<li><a href="<?php  echo $this->createWebUrl('commission', array('op'=>'display'))?>">佣金审核提现操作</a></li>
		<li class="active"><a href="<?php  echo $this->createWebUrl('commission', array('op'=>'applyed'))?>">已结算订单</a></li>
	
	<li><a href="<?php  echo create_url('site/module', array('do' => 'zhifu', 'op' => 'list','name' => 'bj_qmxk','weid'=>$_W['weid']))?>">代理提现报表</a></li>
	<li><a href="<?php  echo $this->createWebUrl('commission', array('op'=>'invalid'))?>">审核无效</a></li>
</ul>
    <div class="main">
		<div class="stat">
		
			<form action="">
				<input type="hidden" name="act" value="module" />
				<input type="hidden" name="name" value="bj_qmxk" />
				<input type="hidden" name="do" value="commission" />
				<input type="hidden" name="op" value="applyed" />
				<input type="hidden" name="opp" value="sort" />
				<table class="table sub-search">
				<table class="table sub-search">
					<tbody>
						<tr>
							<th style="width:100px;">真实姓名</th>
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
					<h4 class="sub-title" style="float:right;color:red;"><a href="">刷新</a></h4>
					<h4 class="sub-title">佣金结算名单</h4>

					<form action="" method="post" onsubmit="">
					<div class="sub-content">
						<table class="table table-hover">
							<thead class="navbar-inner">
								<tr>
									<th class="row-hover">真实姓名</th>
									<th class="row-hover">手机号码</th>
									<th class="row-hover">审核时间</th>
									<th class="row-hover">佣金</th>
								    <th class="row-hover">状态</th>
									<th class="row-hover">操作</th>
								</tr>
							</thead>
							<tbody>
								<?php  if(is_array($list)) { foreach($list as $v) { ?>
											<tr>
											<td style="text-align: center;">
												<?php  echo $member['realname'][$v['shareid']];?>
											</td>
											<td style="text-align: center;">
												<?php  echo $member['mobile'][$v['shareid']];?>
											</td>
											<td style="text-align: center;">
												<?php  echo date('Y-m-d H:i:s',$v['checktime'])?>
											</td>
														<td style="text-align: center;">
												<?php  echo $v['commission'];?>
											</td>
											<td style="text-align: center;">
												<span class="label label-success">审核通过</span>
											</td>
											<td style="text-align: center;">
												<a href="<?php  echo $this->createWebUrl('commission',array('op'=>'applyed', 'opp'=>'jieyong', 'id' => $v['id'], 'shareid'=>$v['shareid'],'level'=>$v['level']));?>">结算明细</a>		
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