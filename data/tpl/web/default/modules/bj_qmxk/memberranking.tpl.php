<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<ul class="nav nav-tabs">

	<li <?php  if($op == 'salereport') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'salereport'))?>">零售生意报告</a></li>
	<li <?php  if($op == 'orderstatistics' ) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'orderstatistics'))?>">订单统计</a></li>
	<li <?php  if($op == 'saledetails' ) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'saledetails'))?>">商品销售明细</a></li>
	<li <?php  if(op == 'saletargets' ) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'saletargets'))?>">销售指标分析</a></li>
	<li <?php  if($op == 'productsaleranking' ) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'productsaleranking'))?>">商品销售排行</a></li>
<li <?php  if($op == 'productsalestatistics') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'productsalestatistics'))?>">商品访问与购买比</a></li>
<li <?php  if($op == 'memberranking' ) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'memberranking'))?>">会员消费排行</a></li>
<li <?php  if($op == 'fansrange' ) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'fansrange'))?>">代理粉丝排行</a></li>
<li <?php  if($op == 'userincreasestatistics'&&$usertype=='user' ) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'userincreasestatistics'))?>">会员增长统计</a></li>
<li <?php  if($op == 'userincreasestatistics'&&$usertype=='agent' ) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('statistics', array('op' => 'userincreasestatistics','usertype'=>'agent'))?>">代理增长统计</a></li>

</ul>

<div class="main">
		<div class="alert alert-info" style="margin:10px 0; width:auto;">
			<i class="icon-lightbulb"></i> 查询有成交记录的会员的订单数和购物金额,并按购物金额从高到低排行
		</div>
		
		<form action="">
				<input type="hidden" name="act" value="module" />
				<input type="hidden" name="name" value="bj_qmxk" />
				<input type="hidden" name="do" value="statistics" />
				<input type="hidden" name="op" value="memberranking" />
				<table class="table sub-search">
					<tbody>
						<tr>
							<td style="vertical-align: middle;font-size: 14px;font-weight: bold;width:100px">起始日期：</td>
			<td style="width:100px">
	<?php  if(!empty($start_time)) { ?>
				<?php  echo tpl_form_field_date2('start_time', date('Y-m-d',$start_time), false)?>
				<?php  } else { ?>  <?php  echo tpl_form_field_date2('start_time', date('Y-m-d',time()), false)?>
				<?php  } ?>
			</td>	
			<td style="vertical-align: middle;font-size: 14px;font-weight: bold;width:100px">终止日期：</td>
			<td>
				<?php  if(!empty($end_time)) { ?>
				<?php  echo tpl_form_field_date2('end_time', date('Y-m-d',$end_time), false)?>
				<?php  } else { ?>  <?php  echo tpl_form_field_date2('end_time', date('Y-m-d',time()), false)?>
				<?php  } ?>
			</td>
			<td>&nbsp;</td>
						</tr>
						
							<tr>
							<td style="vertical-align: middle;font-size: 14px;font-weight: bold;width:100px">排行方式：</td>
			<td style="width:100px">
					<select name="sortname"  style="width:150px;">
	<option <?php  if($sortname == 'ordermoney') { ?>selected="selected"<?php  } ?> value="ordermoney">消费金额</option>
	<option <?php  if($sortname == 'ordercount') { ?>selected="selected"<?php  } ?>value="ordercount">订单数</option>

</select>
			</td>	
			<td></td>	
			<td>
			</td>
			<td>&nbsp;</td>
						</tr>
			
						<tr>
								<td></td>	
							<td><input type="submit" name="" value="查询" class="btn btn-primary" style="height:30px"></td><td><button type="submit" name="memberrankingEXP01" value="memberrankingEXP01" class="btn btn-warning btn-lg">导出excel</button></td>
									<td></td>	
							<td>
							</td>
						</tr>
					</tbody>
				</table>
			</form>
		
	<div style="padding:15px;">

		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th width="85"  >排行</th>
					<th width="41" >会员</th>
					<th width="42" >订单数</th>
					<th width="85" >消费金额</th>
				</tr>
			</thead>
			<tbody>
				<?php  $index=1?>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td><?php  echo $index;?> <?php  if($index==1||$index==2||$index==3) { ?>
						<img  src="<?php echo BJ_QMXK_ROOT;?>/recouse/images/000<?php  echo $index;?>.gif" style="border-width:0px;">
						<?php  } ?><?php  $index++?></td>
					<td><?php  echo $item['realname'];?></td>
					<td><?php  echo $item['ordercount'];?></td>
					<td><?php  if(empty($item['ordermoney'])) { ?>0 <?php  } else { ?><?php  echo $item['ordermoney'];?><?php  } ?></td>
				</tr>
				<?php  } } ?>

				<td colspan="10">
					<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" /></td>
			</tr>
		</table>
		<?php  echo $pager;?>
	</div>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/jquery-ui.css" />
<style type="text/css">a{color:#007bc4/*#424242*/; text-decoration:none;}a:hover{text-decoration:underline}ol,ul{list-style:none}body{height:100%; font:12px/18px Tahoma, Helvetica, Arial, Verdana, "\5b8b\4f53", sans-serif; color:#51555C;}img{border:none}.demo{width:500px; margin:20px auto}.demo h4{height:32px; line-height:32px; font-size:14px}.demo h4 span{font-weight:500; font-size:12px}.demo p{line-height:28px;}input{width:200px; height:20px; line-height:20px; padding:2px; border:1px solid #d3d3d3}pre{padding:6px 0 0 0; color:#666; line-height:20px; background:#f7f7f7}.ui-timepicker-div .ui-widget-header { margin-bottom: 8px;}.ui-timepicker-div dl { text-align: left; }.ui-timepicker-div dl dt { height: 25px; margin-bottom: -25px; }.ui-timepicker-div dl dd { margin: 0 10px 10px 65px; }.ui-timepicker-div td { font-size: 90%; }.ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }.ui_tpicker_hour_label,.ui_tpicker_minute_label,.ui_tpicker_second_label,.ui_tpicker_millisec_label,.ui_tpicker_time_label{padding-left:20px}</style>
<script type="text/javascript" src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/jquery-ui-slide.min.js"></script>
<script type="text/javascript" src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/jquery-ui-timepicker-addon.js"></script><script type="text/javascript">
    $(function() {
        $('#start_time').timepicker({});
        $('#end_time').timepicker({});
    });
</script>
<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>