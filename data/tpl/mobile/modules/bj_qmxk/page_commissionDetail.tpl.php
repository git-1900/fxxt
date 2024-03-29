<?php defined('IN_IA') or exit('Access Denied');?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title>佣金明细</title>
     <link rel="stylesheet" type="text/css" href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/fd.css?v=<?php echo BJ_QMXK_VERSION;?>">
    <link rel="stylesheet" type="text/css" href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/normalize.css">
     <link rel="stylesheet" type="text/css" href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/fcommom.css?v=<?php echo BJ_QMXK_VERSION;?>">
	 <link href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/bottom.css?x=<?php echo BJ_QMXK_VERSION;?>" rel="stylesheet" type="text/css" />
    <script src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/jquery.js"></script>
</head>

<body>
 
    <!--table begin-->
    <dl class="tabs tab-title2">

		<dd class="active" id="brokeragetab"><a href="javascript:void(0)" onclick="brokeragelistshow(this)"><i class="icon-comdetail"></i>佣金明细</a></dd>
        <dd id="extracttab"><a href="javascript:void(0)" onclick="extractlistshow(this)"><i class="icon-extract"></i>提现记录</a></dd>
    </dl>
    <!--table end-->
    <!--content begin-->
    <div class="tabs-content">
          <!--content begin-->
    <div class="tabs-content">
        <!--commission begin-->
        <div class="content active" id="brokeragelist">
        	<?php  if(!empty($list)) { ?>
              <ul class="list-disorder">
              	  	<table class="table table-hover" style="width:100%">
			<!--<thead class="navbar-inner" >
				<tr>
					<th >订单编号</th>
					
					<th >状态</th>
					<th >下单时间</th>
					<th >佣金</th>	
					<th >级别</th>	
					<th >昵称</th>	
				</tr>
			</thead>-->
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
			
				<tr>
					<td><?php  echo $item['level'];?>级订单:<?php  echo $item['ordersn'];?></td>
						
					

					
				
					<td><?php  if(!empty($item['commission'])) { ?>+<?php  echo $item['commission'];?>元<?php  } else { ?>--<?php  } ?></td>
				<!--<td><?php  echo $item['level'];?></td>
					<td><?php  echo $item['realname'];?></td>-->
				</tr>
						<tr>
					
						
					<td style="color:#999;"><?php  echo date('Y-m-d H:i:s', $item['createtime'])?></td>

					<td style="color:#999;">
		<?php  if($item['status1'] == 0) { ?>	<span class="label-info">
						<?php  if($item['status'] == 0) { ?>待付款<?php  } ?>
						<?php  if($item['status'] == 1) { ?>待发货<?php  } ?>
						<?php  if($item['status'] == 2) { ?>待收货<?php  } ?>
							<?php  if($item['status'] ==3) { ?>已完成<?php  } ?>
							<?php  if($item['status'] == -1) { ?>已关闭<?php  } ?>
							<?php  if($item['status'] == -2) { ?>退款中<?php  } ?>
							<?php  if($item['status'] == -3) { ?>换货中<?php  } ?>
							<?php  if($item['status'] ==-4) { ?>退货中<?php  } ?>
							<?php  if($item['status'] == -5) { ?>已退货<?php  } ?>
						<?php  if($item['status'] == -6) { ?>已退款<?php  } ?>
						
						</span><?php  } ?>

						<?php  if($item['status1'] == 1) { ?><span class=" label-info">审核中</span><?php  } ?>
						<?php  if($item['status1'] == 2) { ?><span class=" label-info">已提现</span><?php  } ?>
					
				
					
				</tr>
				
				<?php  } } ?>
			</tbody>
			
		</table>
              </ul>
              	<?php  echo $pager;?>
           <?php  } ?>
           <?php  if(empty($list)) { ?>
            <!--none begin-->
            <div class="disorder-none"><i class="icon-none"></i><span class="nonetext">您还没有佣金！</span></div>
            <!--none end-->
           <?php  } ?>
        </div>
        <!--commission end-->
        
        <!--wait recevie begin-->
        <div class="content" id="extractlist">
        	
        	
        		<?php  if(!empty($list2)) { ?>
              <ul class="list-disorder">
              	  	<table class="table table-hover" style="width:100%">
			<thead class="navbar-inner" >
								<tr>
									<th style="text-align: center;">日期</th>
									<th style="text-align: center;">类型</th>
									<th style="text-align: center;">金额</th>
								
									<th style="text-align: center;">说明</th>
								</tr>
									</thead>
										<tbody>
						<?php  if(is_array($list2)) { foreach($list2 as $v) { ?>
									
								<tr>
									<td style="text-align: center;">
										<?php  echo $v['tid'];?>
									</td>
									<td style="text-align: center;">
										打款
										
									</td>
									<td style="text-align: center;">
										<?php  echo $v['fee'];?>	
									</td>
									<!--<td style="text-align:center;">
										<?php  echo $mtype[$v['module']];?>
									</td>-->
									<td style="text-align: center;">
										<?php  echo $v['tag'];?>								
									</td>
								</tr>
									
								<?php  } } ?>
											</tbody>
	
		
		</table>
              </ul>
           <?php  } ?>
        	
                  <?php  if(empty($list2)) { ?>
            <!--none begin-->
            <div class="disorder-none"><i class="icon-none"></i><span class="nonetext">您还没有提现记录！</span></div>
            <!--none end-->
               <?php  } ?>
        </div>
        <!--wait recevie end-->
    </div>
	
<?php  include $this->template('footer', TEMPLATE_INCLUDEPATH);?>	
<?php  include $this->template('wx_nav', TEMPLATE_INCLUDEPATH);?>
    <!--content begin-->
    <script type="text/javascript">
        $('a[name="list"]').click(function () {
            //  alert(1)
            $(this).parent().children("div").toggle();
            $(this).parent().toggleClass("current");
        })

        $('div[name="listext"]').click(function () {
            $(this).toggleClass("current");
        })
            
        
        function brokeragelistshow() {
            $("#brokeragelist").show();
            $("#extractlist").hide();
            $("#brokeragetab").addClass("active");
            $("#extracttab").removeClass("active");
        }
        function extractlistshow() {
            $("#brokeragelist").hide();
            $("#extractlist").show();
            $("#extracttab").addClass("active");
            $("#brokeragetab").removeClass("active");
        }
    </script>
</body>
</html>
