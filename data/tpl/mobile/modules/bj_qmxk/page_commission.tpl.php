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
    <link rel="stylesheet" type="text/css" href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/fcommom.css?v=<?php echo BJ_QMXK_VERSION;?>">
	    <link rel="stylesheet" type="text/css" href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/ds4.css?v=<?php echo BJ_QMXK_VERSION;?>">
		<link href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/bottom.css?x=<?php echo BJ_QMXK_VERSION;?>" rel="stylesheet" type="text/css" />
    <script src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/jquery.js"></script>
    <script src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/foundation.js"></script>
    <script src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/foundation.tab.js"></script>
    <script src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/foundation.accordion.js"></script>
    <script src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/func.js"></script>
</head>
<body>
    <div class="mask"></div>
  
    <!--topbar end-->
    <!--amount begin-->
    <div class="bro-spare">
        <p class="tip-txt"><i class="icon-money"></i>可提现佣金余额</p>
        <span class="number-big">¥<?php  echo $commissioningpe;?></span>
        <p class="field-2">已打款佣金总额：<big>¥<?php  echo $commissioned;?></big></p>
    </div>
    <!--amount end-->
    <!--list begin-->
    <ul class="maneylist" style="display: ;">
   <?php  if(CUSTOMER_CODE!='001HEML'&&CUSTOMER_CODE!='002XM') { ?>
    <li class="maneylist-li">
            <a  class="a-personal">
                <i class="icon-money-circle"></i>
                <span class="text">未付款订单佣金</span>
                <span class="money-number">¥<?php  echo $commission4_1;?></span>
            </a>
        </li>
           <li class="maneylist-li">
            <a  class="a-personal">
                <i class="icon-money-circle"></i>
                <span class="text">已付款订单佣金</span>
                <span class="money-number">¥<?php  echo $commission5_1;?></span>
            </a>
        </li>
      
          <li class="maneylist-li">
            <a  class="a-personal">
                <i class="icon-money-circle"></i>
                <span class="text">已发货订单佣金</span>
                <span class="money-number">¥<?php  echo $commission6_1;?></span>
            </a>
        </li>
              <!--<li class="maneylist-li">
            <a  class="a-personal">
                <i class="icon-money-circle"></i>
                <span class="text">已收货订单佣金</span>
                <span class="money-number">¥<?php  echo $commission7;?></span>
            </a>
        </li>-->
           <li class="maneylist-li">
            <a  class="a-personal">
                <i class="icon-money-circle"></i>
                <span class="text">已完成订单佣金</span>
                <span class="money-number">¥<?php  echo $commission7;?></span>
            </a>
        </li>
        
             
        
              <li class="maneylist-li">
            <a  class="a-personal">
                <i class="icon-money-circle"></i>
                <span class="text">待审核订单佣金</span>
                <span class="money-number">¥<?php  echo $commission9_1;?></span>
            </a>
        </li>
          <li class="maneylist-li">
									            <a  class="a-personal">
									                <i class="icon-money-circle"></i>
									                <span class="text">无效佣金</span>
									                <span class="money-number">¥<?php  echo $commission3;?></span>
							 </li>
      <?php  } ?> 
   
   
          <?php  if(CUSTOMER_CODE=='001HEML') { ?>
         
          <li class="maneylist-li">
            <a  class="a-personal">
                <i class="icon-money-circle"></i>
                <span class="text">已提现佣金</span>
                <span class="money-number">¥<?php  echo $commissioned;?></span>
            </a>
        </li>
          <li class="maneylist-li">
            <a  class="a-personal">
                <i class="icon-money-circle"></i>
                <span class="text">可提现佣金</span>
                <span class="money-number">¥<?php  echo $commissioningpe;?></span>
            </a>
        </li>
        <?php  } else { ?>
        
        
				          <?php  if(CUSTOMER_CODE=='002XM') { ?>
				                 <li class="maneylist-li">
				            <a  class="a-personal">
				                <i class="icon-money-circle"></i>
				                <span class="text">未付款订单总金额</span>
				                <span class="money-number">¥<?php  echo $commission4;?></span>
				            </a>
				        </li>
				           <li class="maneylist-li">
				            <a  class="a-personal">
				                <i class="icon-money-circle"></i>
				                <span class="text">已付款订单总金额</span>
				                <span class="money-number">¥<?php  echo $commission5;?></span>
				            </a>
				        </li>
				            <li class="maneylist-li">
				            <a  class="a-personal">
				                <i class="icon-money-circle"></i>
				                <span class="text">未收货佣金</span>
				                <span class="money-number">¥<?php  echo $commission6;?></span>
				            </a>
				        </li>
				        
				              <li class="maneylist-li">
				            <a  class="a-personal">
				                <i class="icon-money-circle"></i>
				                <span class="text">已收货佣金</span>
				                <span class="money-number">¥<?php  echo $commission7;?></span>
				            </a>
				        </li>
				        
				        
				                <li class="maneylist-li">
				            <a  class="a-personal">
				                <i class="icon-money-circle"></i>
				                <span class="text">未收货订单总金额</span>
				                <span class="money-number">¥<?php  echo $commission8;?></span>
				            </a>
				        </li>
				        
				              <li class="maneylist-li">
				            <a  class="a-personal">
				                <i class="icon-money-circle"></i>
				                <span class="text">已收货订单总金额</span>
				                <span class="money-number">¥<?php  echo $commission9;?></span>
				            </a>
				        </li>
				          <li class="maneylist-li">
				            <a  class="a-personal">
				                <i class="icon-money-circle"></i>
				                <span class="text">已提现金额</span>
				                <span class="money-number">¥<?php  echo $commissioned;?></span>
				            </a>
				        </li>
				          <li class="maneylist-li">
				            <a  class="a-personal">
				                <i class="icon-money-circle"></i>
				                <span class="text">可提现金额</span>
				                <span class="money-number">¥<?php  echo $commissioningpe;?></span>
				            </a>
				        </li>
				           <?php  } else { ?>
				             <!--	 <li class="maneylist-li">
									            <a class="a-personal">
									                <i class="icon-money-circle"></i>
									                <span class="text">待完成订单佣金</span>
									                <span class="money-number">¥<?php  echo $commission1;?></span>
									            </a>
									        </li>
									         <li class="maneylist-li">
									            <a  class="a-personal">
									                <i class="icon-money-circle"></i>
									                <span class="text">审核中的佣金</span>
									                <span class="money-number">¥<?php  echo $commission2;?></span>
									            </a>
									        </li>
									  
									            -->
				        
				          <?php  } ?> 
        
           <?php  } ?> 
           
    </ul>
    <!--list end-->

    <div class="bro-extract-btn">
	 <a href="<?php  echo $this->createMobileUrl('commission', array('op'=>'commissionDetail'))?>" class="button [radius round] gray">佣金明细</a>
        <a href="<?php  echo $this->createMobileUrl('commission', array('op'=>'commapply'))?>" class="button [radius round] red">申请提现</a>
		
    </div>

    <!--help begin-->
    <div class="bro-help">
        <h3>推广的订单完成后，就显示在可提现佣金。订单被关闭或是审核无效就是无效佣金。</h3>
        <ul class="bro-help-list"><!--href="javascript:void(0)" onclick="showShare()"-->
            <li class="bro-help-list-li"><a class="bro-help-list-a" href="<?php  echo $this->createMobileUrl('list')?>"><i class="icon-share-circle"></i><span>分享商城很重要</span><i class="arrow"></i></a></li>
           <!-- <li class="bro-help-list-li"><a class="bro-help-list-a" href="#"><i class="icon-friend-circle"></i><span>我要推广，分享朋友圈</span><i class="arrow"></i></a></li>-->
        </ul>
    </div>
    <!--help end-->


	<?php  include $this->template('footer', TEMPLATE_INCLUDEPATH);?>
	   <div class="h50"></div>

    <div class="fixed bottom">
        <div class="shareList">
            <ul class="small-block-grid-4" id="sharelist">
                <li shareid="tsina"><i class="icon-sina"></i><span class="name">新浪微博</span></li>
                <li shareid="qzone"><i class="icon-qqzone"></i><span class="name">QQ空间</span></li>
                <li shareid="tqq"><i class="icon-txwb"></i><span class="name">腾讯微博</span></li>
                <li class="no-line" shareid="xiaoyou"><i class="icon-friend"></i><span class="name">朋友网</span></li>
                <li shareid="ydnote"><i class="icon-youdao"></i><span class="name">有道云笔记</span></li>
            </ul>
        </div>
    </div>
	

<?php  include $this->template('wx_nav', TEMPLATE_INCLUDEPATH);?>
 <script>
        $(document).foundation().foundation('joyride', 'start');

        function showShare() {
            $(".shareList").slideToggle("slow");
            $(".mask").toggle();
        }

        $(document).ready(function () {
            $(".mask").click(function () {
                $(".shareList").slideToggle("slow");
                $(".mask").toggle();
            })
        })
    </script>
    <!-- JiaThis Button BEGIN -->


    
<?php  include $this->template('jsweixin', TEMPLATE_INCLUDEPATH);?>
</body>
</html>
