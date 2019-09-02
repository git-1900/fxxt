<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>

<ul class="nav nav-tabs">
	<li <?php  if($op == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('fansmanager');?>">代理</a></li>
	<li <?php  if($op == 'nocheck') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('fansmanager', array('op'=>'nocheck'));?>">非代理</a></li>
<!--	<li><a href="<?php  echo $this->createWebUrl('phbmedal', array('op' => 'post'))?>">添加粉丝排行头衔</a></li>
	<li ><a href="<?php  echo $this->createWebUrl('phbmedal', array('op' => 'display'))?>">管理粉丝排行头衔</a></li>-->

</ul>
<div class="main" style="overflow-x: scroll;">
		<div class="stat" >
		
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
								<input type="submit" name="" value="搜索" class="btn btn-primary"/>
							</td>
						</tr>
					</tbody>
				</table>
			</form>
                    <div style='width: 100%;text-align: right;font-size: 18px;line-height: 30px'>今日发展：银发浪漫会员<?php  echo $silver_total['silver_total'];?>个，颐养天年会员<?php  echo $gold_total['gold_total'];?>个，合家欢聚会员<?php  echo $diam_total['diam_total'];?>个，共<span style="color: #00CC66"><?php  if($sum_money['sum_money']) { ?><?php  echo $sum_money['sum_money'];?><?php  } else { ?>0<?php  } ?></span>元</div>
			<div class="stat-div">
				<div class="navbar navbar-static-top">
					<div class="navbar-inner">
						<span class="pull-right" style="color:red; padding:10px 10px 0 0;">总数：<?php  echo $total;?></span>
						<span class="brand">名单</span>
					</div>
				</div>
                            <div class="sub-item" id="table-list" style="">
					<h4 class="sub-title">代理名单</h4>

					<form action="" method="post" onsubmit="">
					<div class="sub-content">
						<table class="table table-hover">
							<thead class="navbar-inner">
								<tr>
									<th class="row-hover">会员姓名</th>
									<th class="row-hover">手机号码</th>
									<th class="row-hover">注册时间</th>
                                                                        <th class="row-hover">成为代理时间</th>
                                                                        <th class="row-hover">推荐上级</th>
                                                                        <th class="row-hover">身份</th>
                                                                        <th class="row-hover">状态</th>
                                                                        <!--  <th class="row-hover">还需充值</th>-->
                                                                        <th class="row-hover">积分</th>
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
										<?php  echo date('Y-m-d',$v['createtime'])?>	
									</td>
                                                                        <td style="text-align: center;">
										<?php  echo date('Y-m-d',$v['flagtime'])?>
									</td>
                                                                        <td style="text-align: center;">
                                                                                <?php  if($v['sharename'] != '') { ?><?php  echo $v['sharename'];?><?php  } else { ?>无<?php  } ?> 
									</td>
                                                                        <td style="text-align: center;">
                                                                                <?php  echo $v['card_name'];?>
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
                                                                        <?php  if(($_W['username']!='shanghe_01')) { ?> 
									<td style="text-align: center;">
                                                                                <a href="jacascript:;" class="btn btn-primary" id="setidentity" data-pragram="<?php  echo $v['cardid'];?>" data-user="<?php  echo $v['from_user'];?>" data-par="<?php  echo $v['shareid'];?>"  data-toggle="modal"  data-target="#myModal">设置身份</a>	
									<?php  if($v['status']==1) { ?>
										<a href="<?php  echo $this->createWebUrl('fansmanager',array('op'=>'delete','id' => $v['id'],'isstatus' => 0));?>" onclick="return confirm('确定要禁用该代理吗？');" class="btn btn-primary">禁用代理身份</a>
									<?php  } else { ?>
										<a href="<?php  echo $this->createWebUrl('fansmanager',array('op'=>'delete','id' => $v['id'],'isstatus' => 1));?>" onclick="return confirm('确定要恢复该代理吗？');" class="btn btn-primary">恢复代理身份</a>
									<?php  } ?>
										<a href="<?php  echo $this->createWebUrl('fansmanager',array('op'=>'detail','id' => $v['id']));?>" class="btn btn-primary">详情</a>		
										<a href="<?php  echo $this->createWebUrl('fansmanager',array('op'=>'credit_revise','id' => $v['id']));?>" class="btn btn-primary">修改积分</a>
										<a href="<?php  echo $this->createWebUrl('fansmanager',array('op'=>'credit_detail','from_user' => $v['from_user']));?>" class="btn btn-primary">积分变更详情</a>
                                                                                <?php  if($_W['username']=="boss_sh") { ?>
                                                                                <a href="<?php  echo $this->createWebUrl('fansmanager',array('op'=>'remove','id' => $v['id'],'from_user'=>$v['from_user']));?>" onclick="return confirm('确定要删除该代理吗？');" class="btn btn-primary">删除</a>
                                                                                <?php  } ?>
										<!--<a href="<?php  echo $this->createWebUrl('fansmanager',array('op'=>'recharge','id' => $v['id']));?>">充值</a>-->
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
<form action="" method="post" onsubmit='return check()'>
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
                <input type="button" name="" value="<?php  echo $val['card_name'];?>" data-pragram="<?php  echo $val['cardid'];?>" data-price="<?php  echo $val['price'];?>" id="choose_1" class="btn btn-large " style="margin-top: 10px"/></br>
                <?php  } } ?>
                </br></br>
                <span  class="help-inline">（会员卡只能进行升级，不能降级）</span>
                        <input type="hidden" name="vip" value="">
                        <input type="hidden" name="price1" value="">
                        <input type="hidden" name="price2" value="">  
                        <input type="hidden" name="shareid" value="">
                        <input type="hidden" name="from_user" value="">
                        <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                        <input type="hidden" name="op" value="change_vip">
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
<link type="text/css" rel="stylesheet" href="./resource/sty le/daterangepicker.css" />
<script type="text/javascript" src="./resource/script/daterangepicker.js"></script>
<script>
    $(document).on('click','#choose_1',function(){
        $(this).addClass("btn-primary").siblings('#choose_1').removeClass('btn-primary');
        $("input[name='vip']").val($(this).attr("data-pragram"));  
        $("input[name='price2']").val($(this).attr("data-price"));
    });
    $(document).on('click','#setidentity',function(){
        $("input[name='vip']").val("");     
        $("input[name='price2']").val("");
        $("#all_card").find("input").removeAttr("disabled");
        var cardid = $(this).attr("data-pragram");
        var from_user = $(this).attr("data-user");
        var elm = "input[data-pragram='"+cardid +"']";
        $("input[name='from_user']").val(from_user); 
        $("input[name='price1']").val($(elm).attr("data-price")); 
        $("input[name='shareid']").val($(this).attr("data-par"));
        $(elm).addClass("btn-primary").siblings('#choose_1').removeClass('btn-primary');
        $(elm).prevAll('#choose_1').attr('disabled','disabled');
    });
function check(){
    var cardid = $("input[name='vip']").val();
    if (cardid == "") {
        $("#tips").html("* 您没有做任何更改，无需提交");
    return false;
}
}
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