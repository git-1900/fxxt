<?php defined('IN_IA') or exit('Access Denied');?>


<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title>我的佣金</title>
    <link rel="stylesheet" type="text/css" href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/fd.css?v=<?php echo BJ_QMXK_VERSION;?>">
    <link rel="stylesheet" type="text/css" href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/normalize.css">
       <link rel="stylesheet" type="text/css" href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/fcommom.css?v=<?php echo BJ_QMXK_VERSION;?>">

</head>
<body class="body-gray">


    <!--submit errow tip begin-->
    <div data-alert class="alert-box alert" id="errerMsg" style="display: none;"><a href="#" class="close">&times;</a></div>
    <!--submit errow tip end-->

    <!--topbar begin-->
    <div class="fixed">
        <nav class="tab-bar">
            <section class="left-small">
                <a href="<?php  echo $this->createMobileUrl('commission')?>" class="menu-icon"><span></span></a>
            </section>
            <section class="middle tab-bar-section">
                <h1 class="title">提取佣金</h1>
            </section>
        </nav>
    </div>
    <!--topbar end-->
    <!--content begin-->
    <div class="panel extract">
        <div class="commision-total"><span class="span-title">可提现金额</span><span class="number">¥<?php  echo $commissioningpe;?></span></div>
        <!--<div class="extract-number"><span class="span-title">佣金总额</span><span class="number" id="MaxCashAmount">¥0.00</span><i class="icon-horn"></i></div>-->
        
        <div class="panel extract-account">
            <ul class="side-nav">
                
                <li class="account-none"><span style="line-height: 45px;font-size: 18px;float: left;color: #999;"><span style="margin-left:10px">用户名：<?php  echo $profile['realname'];?><br/>银行卡号:<?php  echo $bankcard['banktype'];?><br/>银行名称:<?php  echo $bankcard['bankcard'];?><br/>支付宝：<?php  echo $bankcard['alipay'];?></span></span></li>
                
            </ul>
        </div>
       <!-- <div class="row extract-monynumber">
            <div class="large-12 columns">
                <input type="text" class="" id="CashAmount" placeholder="输入提取金额">
                <span class="close-input" style="display: ;"></span>
            </div>
        </div>
        <div class="tip-text">最低提现金额为<b id="MinaAmountCash">50.00</b>元，必须为<b id="IntTimes">50</b>的整数倍</div>-->
        <a href="<?php  echo $this->createMobileUrl('commission', array('op'=>'applyed'))?>" class="button [radius round] red">立即申请</a>
        
        
        	<table class="table table-hover" style="width:100%">
			<thead class="navbar-inner" >
								<tr>
									<th style="text-align: center;">订单号</th>
									<th style="text-align: center;">级数</th>
									<th style="text-align: center;">佣金</th>
									<th style="text-align: center;">代理姓名</th>
								</tr>
									</thead>
										<tbody>
						<?php  if(is_array($list2)) { foreach($list2 as $v) { ?>
									
								<tr>
									<td style="text-align: center;">
										<?php  echo $v['ordersn'];?>
									</td>
									<td style="text-align: center;">
										<?php  echo $v['level'];?>
										
									</td>
									<td style="text-align: center;">
									<?php  echo $v['commission'];?>
									</td>
									<!--<td style="text-align:center;">
										<?php  echo $mtype[$v['module']];?>
									</td>-->
									<td style="text-align: center;">
										<?php  echo $v['realname'];?>						
									</td>
								</tr>
									
								<?php  } } ?>
											</tbody>
	
		
		</table>
        
    </div>
<?php  include $this->template('footer', TEMPLATE_INCLUDEPATH);?>
</body>
</html>
