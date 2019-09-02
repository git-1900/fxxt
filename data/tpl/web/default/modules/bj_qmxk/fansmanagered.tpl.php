<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<ul class="nav nav-tabs">
	<li <?php  if($op == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('fansmanager');?>">代理</a></li>
	<li <?php  if($op == 'nocheck') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('fansmanager', array('op'=>'nocheck'));?>">非代理</a></li>
	
</ul>
    <div class="main">
		<div class="stat">
		
			<form action="">
				<input type="hidden" name="act" value="module" />
				<input type="hidden" name="name" value="bj_qmxk" />
				<input type="hidden" name="do" value="fansmanager" />
				<input type="hidden" name="op" value="sort" />
				<input type="hidden" name="opp" value="nocheck" />
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
					<h4 class="sub-title">代理名单</h4>

					<form action="" method="post" onsubmit="">
					<div class="sub-content">
						<table class="table table-hover">
							<thead class="navbar-inner">
								<tr>
									<th class="row-hover">真实姓名</th>
									<th class="row-hover">手机号码</th>
                                                                        <th class="row-hover">推荐上级</th>
									<th class="row-hover">注册时间</th>
                                                                        <?php  if(($_W['username']!='shanghe_01')) { ?>
									<th class="row-hover">操作</th>
                                                                        <?php  } ?>
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
										<?php  echo $v['parent_name'];?>
									</td>
									<td style="text-align: center;">
										<?php  echo date('Y-m-d',$v['createtime'])?>
									</td>
                                                                        <?php  if(($_W['username']!='shanghe_01')) { ?>
									<td style="text-align: center;">
                                                                                <a href="jacascript:;" class="btn btn-primary" id="setidentity" data-pragram="<?php  echo $v['cardid'];?>" data-user="<?php  echo $v['from_user'];?>" data-par="<?php  echo $v['shareid'];?>"  data-toggle="modal"  data-target="#myModal">审核</a>	
									</td>
                                                                        <?php  } ?>
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
<form action="" method="post">
<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">设置身份为：</h4>
            </div>
            <div class="modal-body center" style='padding-top: 40px'>
                <div style="text-align: center;" id="all_card">
                <?php  if(is_array($cardtype)) { foreach($cardtype as $key => $val) { ?>
                        <input type="button" name="" value="<?php  echo $val['card_name'];?>" data-pragram="<?php  echo $val['cardid'];?>" data-price="<?php  echo $val['price'];?>" id="choose_1" class="btn btn-large"  style="margin-top: 10px"/></br>
                <?php  } } ?>
                </br></br>
                <span  class="help-inline">（审核过的会员将成为代理）</span>
                        <input type="hidden" name="vip" value="">
                        <input type="hidden" name="shareid" value="">
                        <input type="hidden" name="price" value="">
                        <input type="hidden" name="from_user" value="">
                        <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                        <input type="hidden" name="op" value="nocheck">
                </div>
            </div>
            <div class="modal-footer">
                <div style='display: inline-block;color: red;position:relative;right:35px' id='tips'></div>
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <input type="submit" name="submit" class="btn btn-primary" id="submit_btn" value="提交更改"/>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
</form>
<link type="text/css" rel="stylesheet" href="./resource/style/daterangepicker.css" />
<script type="text/javascript" src="./resource/script/daterangepicker.js"></script>
<script>
    $(document).on('click','#choose_1',function(){
        $(this).addClass("btn-primary").siblings('#choose_1').removeClass('btn-primary');
        $("input[name='vip']").val($(this).attr("data-pragram"));  
        $("input[name='price']").val($(this).attr("data-price"));
    });
    $(document).on('click','#setidentity',function(){
        $("input[name='vip']").val("");     
        $("input[name='price']").val("");
        $("#all_card").find('.btn-primary').removeClass('btn-primary');
        var cardid = $(this).attr("data-pragram");
        var from_user = $(this).attr("data-user");
        $("input[name='from_user']").val(from_user); 
        $("input[name='shareid']").val($(this).attr("data-par"));
    });
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