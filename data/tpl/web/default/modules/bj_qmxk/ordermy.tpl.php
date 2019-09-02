<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<?php  include $this->template('common', TEMPLATE_INCLUDEPATH);?>
<ul class="nav nav-tabs">
<?php  if(empty($shareid)) { ?>
	<li ><a href="<?php  echo create_url('site/module', array('do' => 'charge', 'op' => 'list','name' => 'bj_qmxk','weid'=>$_W['weid']))?>">会员信息</a></li>	
	<li <?php  if($operation == 'display' && $status == '1') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'status' => 1,'from_user'=>$_GPC['from_user']))?>">待发货</a></li>
	<li <?php  if($operation == 'display' && $status == '0') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'status' => 0,'from_user'=>$_GPC['from_user']))?>">待付款</a></li>
	<li <?php  if($operation == 'display' && $status == '2') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'status' => 2,'from_user'=>$_GPC['from_user']))?>">待收货</a></li>
	<li <?php  if($operation == 'display' && $status == '3') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'status' => 3,'from_user'=>$_GPC['from_user']))?>">已完成</a></li>
	<li <?php  if($operation == 'display' && $status == '-2') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'status' => -2,'from_user'=>$_GPC['from_user']))?>">退款中</a></li>
	<li <?php  if($operation == 'display' && $status == '-3') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'status' => -3,'from_user'=>$_GPC['from_user']))?>">换货中</a></li>
	<li <?php  if($operation == 'display' && $status == '-4') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'status' => -4,'from_user'=>$_GPC['from_user']))?>">退货中</a></li>
	<li <?php  if($operation == 'display' && $status == '-1') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'status' => -1,'from_user'=>$_GPC['from_user']))?>">已关闭</a></li>
	<li <?php  if($operation == 'display' && $status == '-99') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('order', array('op' => 'display', 'status' => -99,'from_user'=>$_GPC['from_user']))?>">全部订单</a></li>
	
	<?php  } ?>
</ul>

<?php  if($operation == 'display') { ?>
<div class="main">
	<div style="padding:15px;">
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th style="width:120px;">订单编号</th>
					<th style="width:100px;">会员姓名</th>
					<th style="width:80px;">联系电话</th>
					<th style="width:80px;">支付方式</th>
					<?php  if(empty($shareid)) { ?>
					<th style="width:80px;">配送方式</th>
					<th style="width:50px;">运费</th>			
                    <?php  } ?>
					<th style="width:50px;">总价</th>             
<!--				<th style="width:50px;">类型</th>-->
					<th style="width:50px;">状态</th>
					<th style="width:150px;">下单时间</th>
					<?php  if(!empty($shareid)) { ?>
					<th style="width:50px;">1级佣金</th>			
					<th style="width:50px;">2级佣金</th>		
						<th style="width:50px;">3级佣金</th>		
                    <?php  } ?>
					<?php  if(empty($shareid)) { ?>
					<th style="width:120px;">操作</th>
					<?php  } ?>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td><?php  echo $item['ordersn'];?></td>
					<td><?php  echo $address[$item['addressid']]['realname'];?></td>
					<td><?php  echo $address[$item['addressid']]['mobile'];?></td>
					<td><?php  if($item['paytype'] == 2) { ?><span class="label label-important">在线支付</span><?php  } ?><?php  if($item['paytype'] == 3) { ?><span class="label label-warning">货到付款</span><?php  } ?></td>
					<?php  if(empty($shareid)) { ?>
					<td><?php  if(empty($item['dispatch'])) { ?>自提<?php  } else if($item['dispatch']['dispatchname'] =='货到付款') { ?>货到付款<?php  } else { ?>快递配送<?php  } ?></td>
                                        <td><?php  echo $item['dispatchprice'];?></td>
					<?php  } ?>
					<td><?php  echo $item['price'];?> 元</td>
<!--					<td><?php  if($item['goodstype']) { ?>实物<?php  } else { ?>虚拟<?php  } ?></td>-->
					<td>
						
						<?php  if($item['status'] == 0) { ?><span class="label label-warning" >待付款</span><?php  } ?>
						<?php  if($item['status'] == 1) { ?><span class="label label-important" >待发货</span><?php  } ?>
						<?php  if($item['status'] == 2) { ?><span class="label label-warning">待收货</span><?php  } ?>
							<?php  if($item['status'] ==3) { ?><span class="label label-success" >已完成</span><?php  } ?>
							<?php  if($item['status'] == -1) { ?><span class="label label-success">已关闭</span><?php  } ?>
							<?php  if($item['status'] == -2) { ?><span class="label label-important">退款中</span><?php  } ?>
							<?php  if($item['status'] == -3) { ?><span class="label label-important">换货中</span><?php  } ?>
							<?php  if($item['status'] ==-4) { ?><span class="label label-important">退货中</span><?php  } ?>
							<?php  if($item['status'] == -5) { ?><span class="label label-success">已退货</span><?php  } ?>
						<?php  if($item['status'] == -6) { ?><span class="label  label-success">已退款</span><?php  } ?>
						
						
						</td>
					<td><?php  echo date('Y-m-d H:i:s', $item['createtime'])?></td>
					<?php  if(!empty($shareid)) { ?>
					<td><?php  if($item['status'] == 3) { ?><?php  echo $item['commission'];?>元<?php  } else { ?>--<?php  } ?></td>
							<td><?php  if($item['status'] == 3) { ?><?php  echo $item['commission2'];?>元<?php  } else { ?>--<?php  } ?></td>
									<td><?php  if($item['status'] == 3) { ?><?php  echo $item['commission3'];?>元<?php  } else { ?>--<?php  } ?></td>
                    <?php  } ?>
					<?php  if(empty($shareid)) { ?>
					<td><a href="<?php  echo $this->createWebUrl('order', array('op' => 'detail', 'id' => $item['id'],'from_user'=>$_GPC['from_user']))?>">查看详情</a></td>
					<?php  } ?>
				</tr>
				<?php  } } ?>
			</tbody>
			<!--tr>
				<td></td>
				<td colspan="3">
					<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
					<input type="submit" class="btn btn-primary" name="submit" value="提交" />
				</td>
			</tr-->
		</table>
		<?php  echo $pager;?>
	</div>
</div>
<?php  } else if($operation == 'detail') { ?>
<div class="main">
	<form class="form-horizontal form" action="" method="post" enctype="multipart/form-data" onsubmit="return formcheck(this)">
		<?php  if($item['transid']) { ?><div style="margin:10px 0; width:auto;" class="alert alert-error"><i class="icon-lightbulb"></i> 此为微信支付订单，必须要提交发货状态！</div><?php  } ?>
		<input type="hidden" name="id" value="<?php  echo $item['id'];?>">
		<h4>订单信息</h4>
		<table class="tb">

			<tr>
				<th ><label for="">收货人姓名:</label></th>
				<td >
					<?php  echo $item['user']['realname'];?>
				</td>
				<th ><label for="">联系电话:</label></th>
				<td >
					<?php  echo $item['user']['mobile'];?>
				</td>
			</tr>
			
			<tr>
				<th><label for="">订单编号:</label></th>
				<td>
					<?php  echo $item['ordersn'];?>
				</td>
				<th><label for="">总金额:</label></th>
				<td>
					<?php  echo $item['price'];?> 元 （商品: <?php  echo $item['goodsprice'];?> 元 运费: <?php  echo $item['dispatchprice'];?> 元)
				</td>
			</tr>
			<tr>
			<th><label for="">下单时间：</label></th>
				<td>
					<?php  echo date('Y-m-d H:i:s', $item['createtime'])?>
				</td>
				<th><label for="">收货地址：</label></th>
				<td>
					<?php  echo $item['user']['province'];?><?php  echo $item['user']['city'];?><?php  echo $item['user']['area'];?><?php  echo $item['user']['address'];?>
				</td>
			</tr>
			
			
			
			<tr>
				<th><label for="">分销员：</label></th>
				<td><?php  if(!empty($member[$item['shareid']])) { ?>
					<?php  echo $member[$item['shareid']];?>
					<?php  } else { ?> -- <?php  } ?>
				</td>
						<th><label for="">订单状态：</label></th>
				<td>
					<?php  if($item['status'] == 0) { ?><span class="label label-info">待付款</span><?php  } ?>
					<?php  if($item['status'] == 1) { ?><span class="label label-info">待发货</span><?php  } ?>
					<?php  if($item['status'] == 2) { ?><span class="label label-info">待收货</span><?php  } ?>
					<?php  if($item['status'] == 3) { ?><span class="label label-success">已完成</span><?php  } ?>
					<?php  if($item['status'] == -1) { ?><span class="label label-success">已关闭</span><?php  } ?>
				</td>
			</tr>
			</tr>
			
		<!--	<tr>
				<th><label for="">价钱</label></th>
				<td>
					<?php  echo $item['price'];?> 元 （商品: <?php  echo $item['goodsprice'];?> 元 运费: <?php  echo $item['dispatchprice'];?> 元)
				</td>
			</tr>-->
			<tr>
				<th><label for="">配送方式：</label></th>
				<td>
					<?php  if(empty($dispatch)) { ?>自提<?php  } else { ?><?php  echo $dispatch['dispatchname'];?><?php  } ?>
				</td>
					<th><label for="">付款方式：</label></th>
				<td>
					<?php  if($item['paytype'] == 1) { ?>余额支付<?php  } ?>
					<?php  if($item['paytype'] == 2) { ?>在线支付<?php  } ?>
					<?php  if($item['paytype'] == 3) { ?>货到付款<?php  } ?>
				</td>
			</tr>
			<!--<tr>
				<th><label for="">付款方式</label></th>
				<td>
					<?php  if($item['paytype'] == 1) { ?>余额支付<?php  } ?>
					<?php  if($item['paytype'] == 2) { ?>在线支付<?php  } ?>
					<?php  if($item['paytype'] == 3) { ?>货到付款<?php  } ?>
				</td>
			</tr>
			<tr>
				<th><label for="">订单状态</label></th>
				<td>
					<?php  if($item['status'] == 0) { ?><span class="label label-info">待付款</span><?php  } ?>
					<?php  if($item['status'] == 1) { ?><span class="label label-info">待发货</span><?php  } ?>
					<?php  if($item['status'] == 2) { ?><span class="label label-info">待收货</span><?php  } ?>
					<?php  if($item['status'] == 3) { ?><span class="label label-success">已完成</span><?php  } ?>
					<?php  if($item['status'] == -1) { ?><span class="label label-success">已关闭</span><?php  } ?>
				</td>
			</tr>
			<tr>
				<th><label for="">下单日期</label></th>
				<td>
					<?php  echo date('Y-m-d H:i:s', $item['createtime'])?>
				</td>
			</tr>-->
			<!--<tr>
				<th>备注</th>
				<td>
					<textarea style="height:150px;" class="span7" name="remark" cols="70"><?php  echo $item['remark'];?></textarea>
				</td>
			</tr>-->
		</table>
		<!--<h4>用户信息</h4>
		<table class="tb">
			<tr>
				<th><label for="">姓名</label></th>
				<td>
					<?php  echo $item['user']['realname'];?>
				</td>
			</tr>
			<tr>
				<th><label for="">手机</label></th>
				<td>
					<?php  echo $item['user']['mobile'];?>
				</td>
			</tr>
			<tr>
				<th><label for="">QQ</label></th>
				<td>
					<?php  echo $item['user']['qq'];?>
				</td>
			</tr>
			<tr>
				<th><label for="">地址</label></th>
				<td>
					<?php  echo $item['user']['province'];?><?php  echo $item['user']['city'];?><?php  echo $item['user']['area'];?><?php  echo $item['user']['address'];?>
				</td>
			</tr>
		</table>
		<h4>商品列表</h4>-->
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th style="width:30px;">ID</th>
					<th style="min-width:350px;">商品标题</th>
                                        <th style="min-width:250px;">商品规格</th>
					<th style="width:100px;">商品编号</th>
					<th style="width:100px;">商品条码</th>
                                        
					<!--<th style="width:100px;">销售价/成本价</th>
					<th style="width:100px;">属性</th>-->
                                        <th style="width:80px;color:red;">成交价</th>
					<th style="width:50px;">数量</th>
					<!--<th style="text-align:right; min-width:60px;">操作</th>-->
				</tr>
			</thead>
			<?php  if(is_array($item['goods'])) { foreach($item['goods'] as $goods) { ?>
			<tr>
				<td><?php  echo $goods['id'];?></td>
				<td><?php  if($category[$goods['pcate']]['name']) { ?>
                                    <span class="text-error">[<?php  echo $category[$goods['pcate']]['name'];?>] </span><?php  } ?><?php  if($children[$goods['pcate']][$goods['ccate']]['1']) { ?>
                                    <span class="text-info">[<?php  echo $children[$goods['pcate']][$goods['ccate']]['1'];?>] </span><?php  } ?>
                                    <?php  echo $goods['title'];?>
                                
                                </td>
                                <td> <?php  if(!empty($goods['optionname'])) { ?><?php  echo $goods['optionname'];?><?php  } ?></td>
				<td><?php  echo $goods['goodssn'];?></td>
				<td><?php  echo $goods['productsn'];?></td>
                               
				<!--td><?php  echo $category[$goods['pcate']]['name'];?> - <?php  echo $children[$goods['pcate']][$goods['ccate']]['1'];?></td-->
				<!--<td style="background:#f2dede;"><?php  echo $goods['marketprice'];?>元 / <?php  echo $goods['productprice'];?>元</td>
				<td><?php  if($goods['status']==1) { ?><span class="label label-success">上架</span><?php  } else { ?><span class="label label-error">下架</span><?php  } ?>&nbsp;<span class="label label-info"><?php  if($goods['type'] == 1) { ?>实体商品<?php  } else { ?>虚拟商品<?php  } ?></span></td>-->
                                 <td style='color:red;font-weight:bold;'><?php  echo $goods['orderprice'];?></td>
				<td><?php  echo $goods['total'];?></td>
				<!--<td style="text-align:right;">
					<a href="<?php  echo $this->createWebUrl('goods', array('id' => $goods['id'], 'op' => 'post'))?>">编辑</a>&nbsp;&nbsp;<a href="<?php  echo $this->createWebUrl('goods', array('id' => $goods['id'], 'op' => 'delete'))?>" onclick="return confirm('此操作不可恢复，确认删除？');return false;">删除</a>
				</td>-->
			</tr>
			<?php  } } ?>
		</table>
		<table class="tb">
		
			<tr>
				<th>备注</th>
				<td>
					<textarea style="height:150px;" class="span7" name="remark" cols="70"><?php  echo $item['remark'];?></textarea>
				</td>
			</tr>
		</table>
		
	</form>
</div>
<script language='javascript'>
     $(function(){
         <?php  if(!empty($express)) { ?>
             $("#express").val("<?php  echo $express['express_url'];?>");
             $("#expresscom").val(  $("#express").find("option:selected").attr("data-name"));
         <?php  } ?>
             
        $("#express").change(function(){
          
            var obj = $(this);  
            var sel =obj.find("option:selected").attr("data-name");
            $("#expresscom").val(  sel.val() );
        });
      
    })
    
</script>
<?php  } ?>
<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>
