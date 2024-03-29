<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<style>
.field label{float:left;margin:0 !important; width:140px;}
</style>
<ul class="nav nav-tabs">
	<li><a href="<?php  echo $this->createWebUrl('settings');?>">粉丝管理设置</a></li>
	<li class="active"><a href="<?php  echo $this->createWebUrl('display');?>">粉丝列表</a></li>
</ul>
<div class="main">
	<div class="stat">
		<div class="alert alert-default">
			同步粉丝信息: 选定粉丝后, 访问公众平台获取特定粉丝的相关资料. 需要为认证微信服务号, 或者高级易信号<br>
			下载所有粉丝: 访问公众平台下载所有粉丝列表(这个操作不能获取粉丝资料, 只能获取粉丝标志). 需要为认证微信服务号, 或者高级易信号<br>
			下载粉丝只能获取粉丝标志，如果您需要查看下载的粉丝，可以点击“查看下载的粉丝”按钮来查看。因下载的粉丝只有粉丝标志，系统会自动获取下载的粉丝的详细资料<br>
		</div>
		<?php  if($_W['account']['level'] != 2) { ?>
		<div class="alert alert-danger">
			您的公众号类型为 "<?php  echo $array[$_W['account']['level']];?>"，不能使用 "同步粉丝信息" 和 "下载所有粉丝" 功能
		</div>
		<?php  } ?>

		<div class="stat-div">
			<div class="navbar navbar-static-top">
				<div class="navbar-inner">
					<span class="brand">关键指标详解</span>
				</div>
				<div class="sub-item">
					<h4 class="sub-title">搜索</h4>
					<form action="site.php" method="get" id="form1">
					<input type="hidden" name="act" value="module" />
					<input type="hidden" name="name" value="fans" />
					<input type="hidden" name="do" value="display" />
					<input type="hidden" name="flag" value="" />
					<table class="table sub-search">
					<tbody>
						<tr>
							<th style="width:80px;">
								登记情况
								<div style="font-weight:normal;">
									<label class="checkbox inline" id="field-all"><input type="checkbox"> 全选</label>
								</div>
							</th>
							<td class="field">
								<?php  if(is_array($fields)) { foreach($fields as $field) { ?>
								<label class="checkbox inline"><input type="checkbox" name="select[]" value="<?php  echo $field['field'];?>" <?php  if(in_array($field, $select)) { ?> checked<?php  } ?> /> <?php  echo $field['title'];?></label>
								<?php  } } ?>
							</td>
						</tr>
						<tr>
							<th>关注时间</th>
							<td>
								<button style="margin:0;" class="btn span5" id="date-range" type="button"><span class="date-title"><?php  echo date('Y-m-d', $starttime)?> 至 <?php  echo date('Y-m-d', $endtime)?></span> <i class="icon-caret-down"></i></button>
								<input name="start" type="hidden" value="<?php  echo date('Y-m-d', $starttime)?>" />
								<input name="end" type="hidden" value="<?php  echo date('Y-m-d', $endtime)?>" />
							</td>
						</tr>
						<tr>

							<th></th>
							<td><input type="submit" name="" value="搜索" class="btn btn-primary"></td>
						</tr>
					</tbody>
					</table>
					</form>
				</div>
			</div>
			<div class="sub-item" id="table-list">
				<h4 class="sub-title">详细数据</h4>
				<form action="" method="post" onsubmit="">
				<div class="sub-content">
					<table class="table table-hover">
						<thead class="navbar-inner">
							<tr>
								<th style="width:40px;" class="row-first">选择</th>
								<th class="row-hover" style="width:80px;">用户<i></i></th>
								<?php  if(is_array($select)) { foreach($select as $field) { ?>
								<th><?php  echo $fields[$field]['title'];?><i></i></th>
								<?php  } } ?>
								<th style="width:110px;">关注时间<i></i></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php  if(is_array($list)) { foreach($list as $row) { ?>
							<tr>
								<td class="row-first"><input type="checkbox" name="fanids[]" value="<?php  echo $row['id'];?>" /></td>
								<td class="row-hover"><a href="#" title="<?php  echo $row['from_user'];?>"><?php  echo cutstr($row['from_user'], 8)?></a></td>
								<?php  if(is_array($select)) { foreach($select as $field) { ?>
								<?php  if($field == 'avatar') { ?>
								<th><img src="<?php  echo toimage($row[$field]);?>"></th>
								<?php  } else if($field == 'gender') { ?>
								<th>
									<?php  if($row[$field] == '1') { ?>
										  男
									<?php  } else if($row[$field] == '2') { ?>
										  女
									<?php  } else { ?>
										  保密
									<?php  } ?>
								</th>
								<?php  } else { ?>
									<th><?php  echo $row[$field];?><i></i></th>
								<?php  } ?>
								<?php  } } ?>
								<td style="font-size:12px; color:#666;">
								<?php  echo date('Y-m-d <br /> H:i:s', $row['createtime']);?>
								</td>
								<td><a href="<?php  echo $this->createWebUrl('profile', array('from_user' => $row['from_user']))?>">编辑</a></td>
							</tr>
							<?php  } } ?>
						</tbody>
					</table>
					<table class="table">
						<tr>
							<td style="text-align:left;width:40px;padding-left:15px">
								<input type="checkbox" value="1" onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});" >
							</td>
							<td style="text-align:left">
								<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
								<a class="btn btn-primary" href="javascript:;" id="download"><span id="info">下载所有粉丝</span><span id="downloadState"></span></a>
								<a class="btn btn-primary" href="javascript:;" id="view">查看下载的粉丝</a>
								<a class="btn btn-primary" href="javascript:;" id="sync"><span id="syncinfo">同步粉丝信息</span><span id="syncinfo"></span></a>
							</td>
						</tr>
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
	//详细数据相关操作
	var tdIndex;
	$("#table-list thead").delegate("th", "mouseover", function(){
		if($(this).find("i").hasClass("")) {
			$("#table-list thead th").each(function() {
				if($(this).find("i").hasClass("icon-sort")) $(this).find("i").attr("class", "");
			});
			$("#table-list thead th").eq($(this).index()).find("i").addClass("icon-sort");
		}
	});
	$("#table-list thead th").click(function() {
		if($(this).find("i").length>0) {
			var a = $(this).find("i");
			if(a.hasClass("icon-sort") || a.hasClass("icon-caret-up")) { //递减排序
				/*
					数据处理代码位置
				*/
				$("#table-list thead th i").attr("class", "");
				a.addClass("icon-caret-down");
			} else if(a.hasClass("icon-caret-down")) { //递增排序
				/*
					数据处理代码位置
				*/
				$("#table-list thead th i").attr("class", "");
				a.addClass("icon-caret-up");
			}
			$("#table-list thead th,#table-list tbody:eq(0) td").removeClass("row-hover");
			$(this).addClass("row-hover");
			tdIndex = $(this).index();
			$("#table-list tbody:eq(0) tr").each(function() {
				$(this).find("td").eq(tdIndex).addClass("row-hover");
			});
		}
	});
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
	//全选
	$('#field-all input[type="checkbox"]').change(function() {
		var a = $(this).is(':checked');
		if(a) {
			$('.field input[type="checkbox"]').each(function() {
				$(this).attr("checked", true);
			});
		} else {
			$('.field input[type="checkbox"]').each(function() {
				$(this).attr("checked", false);
			});
		}
	});
	var running = false;
	window.onbeforeunload = function(e) {
		if(running) {
			return (e || window.event).returnValue = '正在进行粉丝数据同步中, 离开此页面将会中断操作.';
		}
	}

	//下载粉丝
	function download(next, count) {
		running = true;
		var params = {};
		params.method = 'download';
		if(next != '') {
			params.next = next;
		}
		if(!count) {
			count = 0;
		}
		$.post("<?php  echo $this->createWebUrl('Settings');?>", params).success(function(dat){
			dat = $.parseJSON(dat);
			count += dat.count;
			$('#downloadState').html('(' + count + '/' + dat.total + ')');
			if(dat.total <= count) {
				running = false;
				message('粉丝下载成功', "<?php  echo $this->createWebUrl('display');?>", 'success');
				//location.reload();
			} else {
				$('#downloadState').html('(' + count + '/' + dat.total + ')');
				download(dat.next, count);
			}
		});
	}

	$('#download').click(function(){
		var level = "<?php  echo $_W['account']['level'];?>";
		if(level != 2) {
			message('您的公众号不是“微信认证服务号”，不能使用下载粉丝功能', '', 'error');
			return;
		}
		$('#info').html('粉丝下载中');
		message('粉丝下载中<br>请不要离开页面或进行其他操作,下载成功后系统会自动刷新本页面', '', 'info');
		download('', 0);
	});

	$('#sync').click(function(){
		var level = "<?php  echo $_W['account']['level'];?>";
		if(level != 2) {
			message('您的公众号不是“微信认证服务号”，不能使用同步粉丝信息功能', '', 'error');
			return;
		}
		if($(":checkbox:checked").size() <= 0){
			alert('没有选择粉丝');
			return;
		}
		message('正在同步粉丝信息<br>请不要离开页面或进行其他操作,同步成功后系统会自动刷新本页面', '', 'info');
		$('#syncinfo').html('粉丝信息同步中');
		running = true;
		var fanids = [];
		$(':checkbox:checked').each(function(){
			var fanid = parseInt($(this).val());
			if(!isNaN(fanid)) {
				fanids.push(fanid);
			}
		});
		var params = {};
		params.method = 'sync';
		params.fanids = fanids;
		$.post("<?php  echo $this->createWebUrl('Settings');?>", params).success(function(dat){
			running = false;
			if(dat == 'success') {
				message('信息同步成功.', "<?php  echo $this->createWebUrl('display');?>" , 'success')
			} else {
				message('未知错误, 请稍后重试.', location.href, 'error')
			}
		});
	});
	$('#view').click(function(){
		$(':input[name="flag"]').val(1);
		$('#form1').submit();
	});
});
</script>
<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>
