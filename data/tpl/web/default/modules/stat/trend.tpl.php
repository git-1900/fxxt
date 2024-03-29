<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<link type="text/css" rel="stylesheet" href="./resource/style/daterangepicker.css" />
<script type="text/javascript" src="./resource/script/daterangepicker.js"></script>
<script type="text/javascript">
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
		$('form[method=get]')[0].submit();
	});
});
function range(days) {
	var start = moment().add('days', 0 - days).format('YYYY-MM-DD');
	var end = moment().format('YYYY-MM-DD');
	$('#date-range .date-title').html(start + ' 至 ' + end);
	$(':hidden[name=start]').val(start);
	$(':hidden[name=end]').val(end);
	$('form[method=get]')[0].submit();
}
</script>
	<div class="main">
		<div class="stat">
			<form action="" method="get">
			<div class="stat-div">
				<div class="navbar navbar-static-top">
					<div class="navbar-inner">
						<span class="brand">关键指标详解</span>
					</div>
				</div>
				<div class="sub-item">
					<input name="act" type="hidden" value="<?php  echo $_GPC['act'];?>" />
					<input type="hidden" name="eid" value="<?php  echo $_GPC['eid'];?>" />
					<input name="do" type="hidden" value="<?php  echo $_GPC['do'];?>" />
					<input name="name" type="hidden" value="<?php  echo $_GPC['name'];?>" />
					<input name="id" type="hidden" value="<?php  echo $_GPC['id'];?>" />
					<div class="pull-left">
						<input name="start" type="hidden" value="<?php  echo date('Y-m-d', $starttime)?>" />
						<input name="end" type="hidden" value="<?php  echo date('Y-m-d', $endtime)?>" />
						<button class="btn" id="date-range" class="date" type="button"><span class="date-title"><?php  echo date('Y-m-d', $starttime)?> 至 <?php  echo date('Y-m-d', $endtime)?></span> <i class="icon-caret-down"></i></button>
						<span class="date-section"><a href="javascript:;" onclick="range(7);">7天</a><a href="javascript:;" onclick="range(30);">30天</a><a href="javascript:;" onclick="range(60);">60天</a></span>
					</div>
				</div>
				<div class="sub-item">
					<h4 class="sub-title">规则使用趋势图</h4>
					<div class="sub-content" id="trend"></div>
				</div>
				<?php  if(is_array($keywords)) { foreach($keywords as $id => $row) { ?>
				<div class="sub-item">
					<h4 class="sub-title">所属关键字使用趋势图&nbsp;&nbsp;&nbsp;<small>(关键字：<?php  echo $keywordnames[$id]['content'];?>)</small></h4>
					<div class="sub-content" id="trend_keyword_<?php  echo $id;?>"></div>
				</div>
				<?php  } } ?>
			</div>
			</form>
		</div>
	</div>
<script type="text/javascript">
	var day = ['<?php  echo implode('\',\'', $day)?>'];
	function initchart(id, options) {
		var defaults = {
			chart: {
				renderTo:id,
				zoomType:'xy',
				type:'areaspline',
				backgroundColor:'#F3F3F3'
			},
			title: {
				text: ""
			},
			credits:{
				enabled:false
			},
			yAxis: [{ // Secondary yAxis
				title: {
					text: ""
				},
				labels: {
					formatter: function() {
						return this.value + '个';
					},
					style: {
						color: '#666',
						fontFamily:'Microsoft yahei'
					}
				},
				gridLineColor:"#D2D1D1",
				allowDecimals:false
			}],
			xAxis: [{
				labels:{
					formatter: function() {
						return this.value;
					},
					style: {
						color: '#000'
					}
				},
				title: {
					text: '',
					style: {
						color: '#7eafdd'
					}
				},
				lineColor: "#8E8E8F",
				lineWidth: 2
			}],
			legend: {
				enabled:false
			},
			labels: {
				style: {
					color: '#CCC'
				}
			},
			tooltip:{
				backgroundColor:'#525253',
				borderColor:"#000",
				style:{
					color: "#fff"
				},
				headerFormat:'',
				pointFormat: '<b style="font-family:Microsoft yahei">{point.y}个</b>'
			},
			plotOptions: {
				areaspline: {
					fillColor: "rgba(190,216,240,0.7)"
				}
			},
			exporting: {
				enabled: false
			},
			series: [{
				name: '触发次数'
			}]
		};
		var config = $.extend({}, defaults, options);
		return new Highcharts.Chart(config);
	}
	$(function(){
		new initchart('trend', {
			series: [{
				data: [<?php  echo implode(',', $hit)?>]
			}],
			xAxis: [{
				categories: day
			}]
		});
		<?php  if(is_array($keywords)) { foreach($keywords as $id => $row) { ?>
		new initchart('trend_keyword_<?php  echo $id;?>', {
			series: [{
				data: [<?php  echo implode(',', $row['hit'])?>]
			}],
			xAxis: [{
				categories: day
			}]
		});
		<?php  } } ?>
	});
</script>
<script type="text/javascript" src="./resource/script/highcharts.js"></script>
<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>
