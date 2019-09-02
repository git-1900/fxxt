<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta content="telephone=no" name="format-detection" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="viewport" content="width=320, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title><?php  echo $goods['title'];?></title>
	<link rel='stylesheet' type='text/css' href='<?php echo BJ_QMXK_ROOT;?>/recouse/css/bjdetail.css?ver=556654' />	
	<link href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/reset.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/bjcommon.css?x=4444333" rel="stylesheet" type="text/css" />	
	<script type="text/javascript" src="./resource/script/jquery-1.7.2.min.js"></script>
	<script src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/jquery.json.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/common.js"></script>
	<script type="text/javascript" src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/transport.js"></script>
	<script type="text/javascript" src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/utils.js"></script>



</head>
<body style=" margin:0 auto;">



<div class="main" >

	<section class="sp" >
<div class="product-intro" >
	
	<div id="cont_show">
<script type="text/javascript" src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/jquery.flexslider-min.js"></script>
<script type="text/javascript">
$(function() {
	$('.flexslider').flexslider({
		 animation: "slide",
		 slideDirection: "horizontal"
	 });
	$("#btn_continue").click(function(){
		$("#buy_lay").hide();
		$("#buy_lay_frm").hide();
	});
	$("#btn_check").click(function(){
		window.location='cart.php';
	});	 
	$(document).bind("click",function(){
		$("#buy_lay").hide();
		$("#buy_lay_frm").hide();
	});
});
</script>
<script type="text/javascript">
var $$ = function (obj) {
    if (obj != null && obj != undefined && obj.toString().length > 0) {
        if (obj[0] == '#') {
            return document.getElementById(obj.substr(1, obj.length - 1));
        }
    }
}
function chgNum(a) {
    var number = $$("#total");
    var p = parseInt(number.value);
    if (a == 1) {
        if (p < 1038) number.value = ++p;
    }
    else {
        if (p > 1) number.value = --p;
    }
}
</script>
<link href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/flexslider.css" rel="stylesheet" type="text/css" />
<div id="viewport" class="viewport">

<div class="show">
	<div class="slider card card-nomb" style="visibility: visible;">
    <!-- banner轮播Start -->
    <script type="text/javascript" src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/TouchSlide.1.1.js"></script>
    <div id="focus" class="focus">
      <div class="hd">
        <ul>
        </ul>
      </div>
      <div class="bd">
        <ul>
       <?php  if(is_array($piclist)) { foreach($piclist as $row) { ?>
        <li><img src="<?php  echo $_W['attachurl'];?><?php  echo $row['attachment'];?>" /></li>
		<?php  } } ?>
        </ul>
      </div>
    </div>
    <script type="text/javascript">
	TouchSlide({ 
		slideCell:"#focus",
		titCell:".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
		mainCell:".bd ul",
		delayTime:600,
		interTime:4000,
		effect:"leftLoop", 
		autoPlay:true,//自动播放
		autoPage:true, //自动分页
		switchLoad:"_src" //切换加载，真实图片路径为"_src" 
	});
	</script>
    <!-- banner轮播End -->
  </div>
</div>
</div>

<div class="pro-info">
<p class="pro-name"   ><strong style="color:#000;"><?php  echo $goods['title'];?></strong></br></p>


<div class="price clearfix">
<p class="jx-price" style="font-size:16px;">价&nbsp;&nbsp;&nbsp;格<strong style=" padding-left:15px" id="marketprice">¥<?php  echo $marketprice;?> </strong><?php  if($goods['issendfree']==1) { ?><span><img src="<?php echo BJ_QMXK_ROOT;?>/recouse/images/baoyou.png"></span><?php  } ?></p>

<?php  if($member) { ?>
<?php  if($member['flag']==1) { ?>
<?php  if($commission !=0) { ?>

<p id="share_for_money" style="display: block;width:60px; text-align:center;">

	     <a href="javascript:;" style="color:#ff9900;font-size:15px;" onClick="	document.getElementById('mcover').style.display='block';" title="我要分销">我要分销</a>
               
              
                </p>


<?php  } ?>
<?php  } ?>
<?php  } ?>

</div>
<?php  if($marketprice < $productprice) { ?>
<!--<div class="price clearfix">
<p class="jx-pricem">市场价<strong style=" padding-left:15px;color:#BEBEBE" id="productprice">¥<?php  echo $productprice;?></strong></p> 
</div>-->
<?php  } ?>
<?php  if($goods['istime']==1) { ?>
<div class="price clearfix">
<p class="jx-price">倒计时：<strong style=" padding-left:15px;color:#ff0500;font-size: 16px;"><em id="time_<?php  echo $goods['id'];?>"><?php  echo $goods['timelaststr'];?></em></strong></p> 
</div>
<script language='javascript'>
                     var total_time_<?php  echo $goods['id'];?> = <?php  echo $goods['timelast'];?>;  
                         var int_time_<?php  echo $goods['id'];?>  = setInterval(function(){
                             d(<?php  echo $goods['id'];?>);
                         },1000);
                     </script>

<script type="text/javascript">


          
function d(id){
            eval("total_time_" + id+"--");
            var total_time = eval("total_time_" + id);
          
           var days = parseInt(total_time/86400)
           
           var remain = parseInt(total_time%86400);
            var hours = parseInt(remain/3600)
              var remain = parseInt(remain%3600);
    
     var mins = parseInt(remain/60);
     var secs = parseInt(remain%60);
     
            if (total_time <= 0) {
                $("#time_" + id).html( "时间到了");
                var int_time =  eval("int_time_" + id);
                window.clearInterval(int_time);
          
            } else {
                
                var ret = "";
                if(days>0){
                    days = days+"";
                    if(days.length<=1) { days="0"+days;}
                    ret+=days+" 天 ";
                }
                if(hours>0){
                    hours = hours+"";
                    if(hours.length<=1) { hours="0"+hours;}
                    ret+=hours+":";
                }
                if(mins>0){
                        mins = mins+"";
                    if(mins.length<=1) { mins="0"+mins;}
                    ret+=mins+":";
                }
              
                       secs = secs+"";
                     if(secs.length<=1) { secs="0"+secs;}
                     ret+=secs;
             
     
                $("#time_" + id).html( ret);
            }
        }

</script>

<?php  } ?>


<?php  if($goods['istime']==1&&$stock!=-1) { ?>
<div class="price clearfix">
<p class="jx-price">剩&nbsp;&nbsp;&nbsp;余:<strong style=" padding-left:15px;color:#BEBEBE; " id="goodstotail"><?php  echo $stock;?></strong></p> 
</div>
<?php  } ?>

<form action="javascript:addToCart(6)" method="post" name="ECS_FORMBUY" id="ECS_FORMBUY" >
	<?php  if($from_user) { ?>
<div class="goods_number clearfix">
	<p class="name" style="font-size:16px;">数&nbsp;&nbsp;&nbsp;量</p>
	<div class="addForm">	
		        <input type="button" value="-" class="btn" onClick="chgNum(-1);" />	
		        <input type="text" id="total" name="number"  value="1" class="text"/>	
		        <input type="button" value="+" class="btn" onClick="chgNum(1);" />
	</div>
<!--  -->
</div>
<?php  } ?>


<?php  if($goods['hasoption']==1) { ?>
  <?php  if(is_array($specs)) { foreach($specs as $spec) { ?>
                  <input type='hidden' name="optionid[]" class='optionid optionid_<?php  echo $spec['id'];?>' value="" title="<?php  echo $spec['title'];?>">
                  <div id='option_group' class='detail-group' style="margin-top:10px;">
                      
                       <div class="detail-group">
			 
	 <span style='float:left;margin-left:15px;padding:0'><?php  echo $spec['title'];?> :</span>
                        <span style="float:left;margin-left:8px;" class='options options_<?php  echo $spec['id'];?>' specid='<?php  echo $spec['id'];?>'>
                          
                          <?php  if(is_array($spec['items'])) { foreach($spec['items'] as $o) { ?>
                          
                                  <?php  if(empty($o['thumb'])) { ?>
                                     <span class="property option option_<?php  echo $spec['id'];?>" specid='<?php  echo $spec['id'];?>' oid="<?php  echo $o['id'];?>"  sel='false'><?php  echo $o['title'];?></span>
                                        <?php  } else { ?>
                                       <span class="propertyimg optionimg option_img_<?php  echo $spec['id'];?> " oid="<?php  echo $o['id'];?>" specid='<?php  echo $spec['id'];?>' sel='false'><img src="<?php  echo $_W['attachurl'].$o['thumb']?>" width='50' height='70' /></span>
                                  <?php  } ?>
                               
                            <?php  } } ?> 
                        </span>
    </div>
                </div>
      <?php  } } ?>
         <?php  } ?>
</form>

<?php  if(is_array($params)) { foreach($params as $p) { ?>
<div class='goods_number clearfix'>
	<p class="name"><?php  echo $p['title'];?></p>
	<span color="black"><?php  echo $p['value'];?></span>
</div>
<?php  } } ?>


<input type="hidden"  id="optionid" name="optionid" value="" />



</div>
 
 
 
 


<div class="active">
<p class="tip"></p>
</div>

<div class="card card-list">


    <div style="clear:both;"></div>
<div class="pro-info1">
<p class="pro-name1"><strong></strong></p>
</div>


 <div class="custom-store">
     
    <a class="custom-store-link clearfix" href="<?php  echo $this->createMobileUrl('list',array('dzdid'=>$this->getDzdid()))?>">
        <div class="custom-store-img"></div>
        <div class="custom-store-name"><?php  echo $this->getDzdname($profile)?></div>
        <span class="custom-store-enter">进入首页</span>
    </a>
    			
</div>  
<div class="pro-info1">
<p class="pro-name1"><strong></strong></p>
</div>
<div class="pro-detial" >
	<div class="pro-intro clearfix" style="margin-bottom:-56px;">
		<?php  echo $goods['content'];?>
	</div>
</div>
<style>
#mcover {position: fixed;top: 0;left: 0;width: 100%;height: 100%;background: rgba(0, 0, 0, 0.7);display: none;z-index: 20000;}
.qrcode-box .comment{position:relative;margin:55px 10% 10% 10%;color:#ffffff;z-index: 200;}
.qrcode-box .comment ul{list-style:none;width:100%;margin:20px 10px 10px 10px;padding:0;z-index: 200}
.qrcode-box .comment ul li{height:28px;line-height:28px;margin:5px;z-index: 200;padding-top:30px}
.qrcode-box .comment ul li img{ position: fixed;right: 18px;top: 5px;width: 260px!important;height: 180px!important;z-index: 20001;}
.qrcode-box .comment ul li.friend img{margin:0 0.5em 0 1.5em}
.qrcode-box .comment .qrcode{text-align:center;z-index: 200}
.qrcode-box .comment .qrcode img{position:relative;display:inline-block;width:160px;z-index: 9999;}
.qrcode-box .comment .know{text-align:center}
.qrcode-box .comment .know .btn-know{position:relative;margin:20px 10% 0 10%;text-shadow:none;font-weight:normal;text-decoration:none;font-size:16px;padding:0.5em 1.5em;display:inline-block;cursor:pointer;-webkit-border-radius:3px;-moz-border-radius:3px;-ms-border-radius:3px;-o-border-radius:3px;border-radius:3px;*zoom:1;filter:progid:DXImageTransform.Microsoft.gradient(gradientType=0, startColorstr='#FF08B12D', endColorstr='#FF044F14');background-color:#08b12d;border:0;color:white;text-shadow:#02370e 0 -1px 0}
.qrcode-box .comment .know .btn-know:hover{text-decoration:none}
.qrcode-box .comment .know .btn-know:hover{background-color:#079927}
.qrcode-box .comment .know .btn-know:active{background-color:#068a23}
.qrcode-box .comment .know .btn-know.disabled,.qrcode-box .comment .know .btn-know[disabled]{filter:progid:DXImageTransform.Microsoft.Alpha(Opacity=60);opacity:0.6;background:false;cursor:default;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}
.qrcode-box .comment .know .btn-know::-moz-focus-inner{padding:0 !important;margin:-1px !important}
/*********************************#mcover img {position: fixed;right: 18px;top: 5px;width: 260px!important;height: 180px!important;z-index: 20001;}**********/
</style>
	<div id="mcover"  onclick="document.getElementById('mcover').style.display='';" style="display:none;">

<div class="qrcode-box" >
		<div class="comment" >
      <ul>		
        <li><img alt="Wxmenu" src="<?php echo BJ_QMXK_ROOT;?>/recouse/images/guide.png" style="height:264px;width:182px"/> </li>
          <li><br/></li>
         <li>或者： 邀请好友扫二维码</li>
      </ul>
      <div class="qrcode"><img src="<?php echo BJ_QMXK_ROOT;?>/style/images/share/share_qrx<?php  echo $profile['id'];?>.png" style="height:200px;width:200px"/></div>
      <div class="know"><a class="btn-know">知道了</a></div>
    </div>
</div>   
	</div>


<!--  -->

<!--  -->						

<div id="buy_lay"></div>
<div id="buy_lay_frm">
	<div class="frm">
		<div class="tips">商品已添加到购物车！</div>
		<div class="btns">
			<input id="btn_continue" class="btn" type="button" value=" 再逛会 " />
			<input id="btn_check" class="btn" type="button" value=" 去结算 " />
		</div>
	</div>
</div>

<style>
.btn_wrap{border-top:0px solid #e77366;}
.cart_wrap{border-left:1px solid #ffcc00;float:left;border-top:1px solid #ffcc00;}
.btn_fav{border-top:1px solid #ffcc00}


.btn_wrap_fixed {height: 40px;}
.btn_wrap .btn_col .btn {margin-top: 0px;}
.btn_wrap .btn_fav i { margin: 0px auto; margin-left:12px;}
.cart_wrap:after {
    content: "购物车";
    font-size: 12px;
    height: 12px;
    line-height: 12px;
    color: #666;
    position: absolute;
    top: 25px;
    left: 0px;
    width: 50px;
    text-align: center;
	}
.btn_wrap .btn_fav:after {
    content: "收藏";
    font-size: 12px;
    height: 12px;
    width: 50px;
    text-align: center;
    line-height: 12px;
    color: #666;
    position: absolute;
    top: 25px;
    left: 0px;
	}
.btn_wrap .btn_fav_checked:after{
    content:"已收藏";
    color:#ff9600;
    font-size: 12px;
    height: 12px;
    width: 50px;
    text-align: center;
    line-height: 12px;

    position: absolute;
    top: 25px;
    left: 0px;
	}
.cart_wrap .i_cart {
    display: block;
    width: 25px;
    height: 25px;
    margin: 0px auto 0px;
    background-position: -0px -175px;
	}
.cart_wrap {
    width: 50px;
    height: 50px;
    position: absolute;
    top: 0;
    left:50px;
	}
.btn_wrap .btn_col {
    margin-left: 100px;
    margin-right: 0px;
	}

.btn btn_buy{ margin-left: 0px;
    margin-right: 0px; }

.btn_wrap .btn_col .btn_cart {
    float: left;
    width: 45%;
	}
.btn btn_buy{border:1px solid #000; }

.btn_wrap .btn_cart {
    float: left;
    width: 16%;
    background: #ffcc00;font-size:18px;border-radius:0px;

	}
.btn_wrap .btn_col .btn {
    height: 40px;
    line-height: 40px;
    margin-top: 0px;
	}
.btn_wrap .btn_col .btn_buy {
    float:left;
    width: 55%;
	background:#ff9900;font-size:18px;border-radius:0px;
	}

.btn_wrap .btn_fav_checked i{
    
    margin: 0px auto;margin-left:-2px;
	}


</style>



<div class="btn_wrap btn_wrap_fixed" id="btnTools">
        <input type="hidden" id="favoriteId" value=""/>
              
				<div>
				<a class="btn_fav" href="javascript:void(0);" id="collect-link"><i></i></a>    

<a class="cart_wrap" href="<?php  echo $this->createMobileUrl('mycart')?>">
            <!--               <i class="i_cart" id="cartNum" num="0"></i>-->
            <i class="i_cart" id="cartNum"></i>
            <span class="cart"></span>
            <span class="add_num" id="popone">+1</span>
        </a>
</div>

        <div class="btn_col">
            <a class="btn btn_cart" href="javascript:void()" onclick='addtocart()'>加入购物车</a>
            <a class="btn btn_buy" href="javascript:void()" onclick='buy()'>立即购买</a>
        </div>

        
    </div>


<!--collect begin-->

  <div class="collect-tip" id="collect-tip" style="display:none;">
    <img src="<?php echo BJ_QMXK_ROOT;?>/recouse/images/collect.png"> 
    <a class="a-know" id="a-know" href="javascript:void(0)">我知道了</a>
  </div>
  <!--collect end-->

	
	   <script>
         
          $(function(){            
              //contact float
             
             
              $("#collect-link").on("click", function () {
                  $("#collect-tip").show();
              })
              $("#a-know").on("click", function () {
                  $("#collect-tip").hide();
              })
             
          })
      </script>


	</div>
</div>
</section>

	
<script type="text/javascript">
		var global_loading=document.getElementById("global_loading");
		global_loading.parentNode.removeChild(global_loading);
</script>
<script type="text/javascript">
var addto_cart_success = "该商品已添加到购物车。";
var goods_id = 6;
var goodsattr_style = 1;
var goodsId = 6;
var now_time = 1415650474;
onload = function(){
  //changePrice();
  try {onload_leftTime();}
  catch (e) {}
}

</script>
﻿<!--页面底部-->
		<div class="viewport">
		<?php  include $this->template('footer', TEMPLATE_INCLUDEPATH);?>
		</div>





<?php  if($shownotice == true) { ?>
<style>
.mui-bar-tab {top: 0;display: table;width: 100%;height: 50px;padding: 0;table-layout: fixed;border-top: 0;border-bottom: 0;}
.mui-bar {position: fixed;right: 0;left: 0;z-index: 10;height: 44px;padding-right: 10px;padding-left: 10px;filter:alpha(opacity=50); background:rgba(49, 48, 48, 0.5) none repeat scroll 0 0 !important;border-bottom: 0;-webkit-backface-visibility: hidden;backface-visibility: hidden;}
.mui-btn {position: relative;top: 7px;z-index: 20;padding: 6px 12px 7px;margin-top: 0;font-weight: 400;}
.mui-btn-warning {color: #fff;background-color: #f0ad4e;border: 1px solid #f0ad4e;float: right;margin-right: 5px;line-height: 21px;}
</style>
<nav class="mui-bar mui-bar-tab" style="z-index:99999;font-family: Helvetica,STHeiti STXihei, Microsoft JhengHei, Microsoft YaHei, Arial;">
<img src="<?php  if(empty($myheadimg['avatar'])) { ?><?php echo BJ_QMXK_ROOT;?>/style/images/yh.png<?php  } else { ?><?php  echo $myheadimg['avatar'];?><?php  } ?>" style="width:40px;height:40px;float:left;margin:5px;">
<div style="color:#ffffff;font-size:12px;font-weight:500;line-height:20px;float:left;margin-top: 5px;"><span style="color:#31FF00;font-size:13px;"><?php  echo $myheadimg['nickname'];?></span><br>您还未关注<?php  echo $_W['account']['name'];?>！</div>
<button onClick="location.href='<?php  echo $cfg['ydyy'];?>';" class="mui-btn mui-btn-warning" style="float:right;margin-right:15px;font-size:15px;">点击关注</button>
</nav>
<?php  } ?>

<script src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/zepto.min.js" type="text/javascript"></script>


<script type="text/javascript">
    var options=<?php  echo json_encode($options)?>;
    var specs=<?php  echo json_encode($specs)?>;
    var hasoption = <?php echo $goods['hasoption']=='1'?'true':'false'?>;
    

        
         $(".option,.optionimg").click(function() {   
             var specid = $(this).attr("specid");
             var oid = $(this).attr("oid");
            $(".optionid_"+specid).val(oid);
         
            $(".options_" + specid + "  span").removeClass("current").attr("sel", "false");
            $(this).addClass("current").attr("sel", "true");
            var optionid = "";
            var stock =0;
            var marketprice = 0;
            var productprice = 0;
             var ret = option_selected();
  
            if(ret.no==''){
                var len = options.length;
                for(var i=0;i<len;i++) {
                    var o = options[i];
                  
                    var ids = ret.all.join("_");
                   
                    if( o.specs==ids){
                        optionid = o.id;
                        stock = o.stock;
                        marketprice = o.marketprice;
                        productprice = o.productprice;
                        break;
                    }
                    
                }
               $("#optionid").val(optionid); 
            
               <?php  if($stock!=-1) { ?>
              	$("#goodstotail").html(stock); 
              	<?php  } ?>
                $("#marketprice").html(marketprice);
                 
                 
                $("#productprice").html(productprice);
                if(productprice<=0){
                    $("#productpricecontainer").hide();
                }
                else{
                    $("#productpricecontainer").show();
                }
            }
        });
        
 
        

function get_search_box(){
	try{
		document.getElementById('get_search_box').click();
	}catch(err){
		document.getElementById('keywordfoot').focus();
 	}
}
</script>
<script language='javascript'>
    function tip(msg,autoClose){
     var div = $("#poptip");
     var content =$("#poptip_content");
     if(div.length<=0){
         div = $("<div id='poptip'></div>").appendTo(document.body);
         content =$("<div id='poptip_content'>" + msg + "</div>").appendTo(document.body);
     }
     else{
         content.html(msg);
         content.show(); div.show();
     }
     if(autoClose) {
        setTimeout(function(){
            content.fadeOut(500);
            div.fadeOut(500);

        },1000);
     }
}
function tip_close(){
    $("#poptip").fadeOut(500);
     $("#poptip_content").fadeOut(500);
}
</script>

<script type="text/javascript">
//立即购买
var hasoption = <?php echo $goods['hasoption']=='1'?'true':'false'?>;
function buy(){
    var ret = option_selected();
        if(ret.no!=''){
           tip("请选择" + ret.no + "!",true);
            return;
        }
         var total = $("#total").val();
           <?php  if($stock!=-1) { ?>
          if(total>parseInt($("#goodstotail").html()))
        {
        	tip("最多只能购买" + parseInt($("#goodstotail").html()) + "件!",true);
            return;
        	
        }
         	<?php  } ?>
     var total = $("#total").val();
     location.href = '<?php  echo $this->createMobileUrl('confirm',array('id'=>$goods['id']),true);?>'+"&optionid=" + $("#optionid").val() + "&total=" + total;
}
//添加到购物车
function addtocart(){
    var ret = option_selected();
        if(ret.no!=''){
           tip("请选择" + ret.no + "!",true);
            return;
        }
        
         var total = $("#total").val();
          <?php  if($stock!=-1) { ?>
        if(total>parseInt($("#goodstotail").html()))
        {
        	tip("最多只能购买" + parseInt($("#goodstotail").html()) + "件!",true);
            return;
        	
        }  	<?php  } ?>
        
        tip("正在处理数据...");
        var url = '<?php  echo $this->createMobileUrl('mycart',array('op'=>'add','id'=>$goods['id']),true);?>' +"&optionid=" + $("#optionid").val() + "&total=" + total;
        $.getJSON(url, function(s){
        if(s.result==0){
            tip("只能购买 " + s.maxbuy + " 件!");
        }else{
            tip_close();
				  	tip("已加入购物车!");
			//alert("已加入购物车!");
           $('#globalId').css({'width':'22px', 'height':'16px', 'line-height':'16px'}).html(s.total).animate({'width':'15px', 'height':'16px', 'line-height':'20px'}, 'slow');
           $('#carId').css({'width':'22px', 'height':'16px', 'line-height':'16px'}).html(s.total).animate({'width':'15px', 'height':'16px', 'line-height':'20px'}, 'slow');
       }
        });
}



function option_selected(){
   
     var ret= {
         no: "",
         all: []
     };
    if(!hasoption){
        return ret;
    }
            $(".optionid").each(function(){
                ret.all.push($(this).val());
                if($(this).val()==''){
                    ret.no = $(this).attr("title");
                    return false;
                }
     })
     return ret;
}
</script>

<?php  include $this->template('jsweixin', TEMPLATE_INCLUDEPATH);?>

</div>
</body>

</html>
<?php  echo $this->getKFcode();?>