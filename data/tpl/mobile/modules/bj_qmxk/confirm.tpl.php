<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
     <meta charset="utf-8">
    <title>订单确认</title>
    
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/confirm.css?v=111" />
	<script type="text/javascript" src="./resource/script/jquery-1.7.2.min.js"></script>

	
	
	
	
	<style>
body{padding-bottom:55px}

.label_radio input { 
	margin-right: 5px; 
}

.has-js .label_radio { 
	padding-left: 26px; 
}

.has-js .label_radio { 
	background-position: 0 0;
	background: url(<?php echo BJ_QMXK_ROOT;?>/recouse/images/radio_none.png) no-repeat;
	background-size: 16px 16px;
}
.has-js label.r_on { 
	background-position: 0 0px;
	background: url(<?php echo BJ_QMXK_ROOT;?>/recouse/images/radio_check.png) no-repeat;
	background-size: 16px 16px;
}
.has-js .label_radio input { 
	position: absolute; 
	left: -9999px; 
} 

.btn-danger {
  color: #ffffff;
  background-color: #d9534f;
  border-color: #d43f3a;
}

.btn {
  display: inline-block;
  padding: 6px 12px;
  margin-bottom: 0;
  font-size: 14px;
  font-weight: normal;
  line-height: 1.428571429;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  cursor: pointer;
  background-image: none;
  border: 1px solid transparent;
  border-radius: 4px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  -o-user-select: none;
  user-select: none;
}

</style>

    </head>
<body>



<section class="accounts">
<div class="infobox">
 <h2>收货信息</h2>
   <?php  if(!empty($row)) { ?>
 
 <p class="address_item"><?php  echo $row['province'];?> <?php  echo $row['city'];?> <?php  echo $row['area'];?> <?php  echo $row['address'];?> <br/> <?php  echo $row['realname'];?>, <?php  echo $row['mobile'];?></p>
<p><button type="button" class="btn btn-danger" onclick="location.href='<?php  echo $this->createMobileUrl('address',array('from'=>'confirm','returnurl'=>urlencode($returnurl)))?>'"><i class="icon-plus"></i>管理收货地址</button></p>
	  <?php  } else { ?>
	<p><button type="button" class="btn btn-danger" onclick="location.href='<?php  echo $this->createMobileUrl('address',array('from'=>'confirm','returnurl'=>urlencode($returnurl)))?>'"><i class="icon-plus"></i> 添加收货地址</button></p>
		<?php  } ?>

</div>
 	
 	 <form id='formorder' name="input" onsubmit="return check()" method="post">
 	<input type="hidden" name="goodstype" value="<?php  echo $goodstype;?>" />
<input type="hidden" name="address" value="<?php  echo $row['id'];?>" />
 <div class="infobox">
 <h2>配送方式</h2>
 <ul class="payStyle">
 <li><label><input name="sendtype" id='sendtype'  type="radio" checked="checked" value="0" /><img src="<?php echo BJ_QMXK_ROOT;?>/recouse/images/icon-wein.png" />快递配送<?php echo ($issendfree==1?"(包邮)":"")?></label></li>
  </ul>
</div>

 
<div class="infobox">
 <h2>支付方式</h2>
 <ul class="payStyle">
 	
 	

 	
 	<?php  if(is_array($dispatch)) { foreach($dispatch as $d) { ?>
  				    <li><label><input name='dispatch' onchange='oncheckboxchange("paytype<?php  echo $d['dispatchtype'];?>","<?php echo $issendfree==1?0:$d['price']?>");' type="radio"  value="<?php  echo $d['id'];?>"  /><img src="<?php echo BJ_QMXK_ROOT;?>/recouse/images/<?php  if($d['dispatchtype']==0) { ?>icon-huod.png<?php  } ?><?php  if($d['dispatchtype']==1) { ?>icon-weixin.png<?php  } ?><?php  if($d['dispatchtype']==3) { ?>icon-yuer.png<?php  } ?>" /><?php  echo $d['dispatchname'];?></label></li>
  				  
                      
                      
                  
                          
                          
                        <?php  } } ?>
 	
 
  </ul>
</div>

<div class="my-memvers">
  <div class="member-browse">
        <h2 class="member-browse-title"><span>订单详情</span></h2>
        <ul class="member-browse-ul">
        		<?php  if(is_array($allgoods)) { foreach($allgoods as $item) { ?>
            <li class="member-browse-li">
                <div class="row member-browse-summey">
                    <a class="member-browse-summey-info" href="<?php  echo $this->createMobileUrl('detail',array('id'=>$item['id']))?>" >                 
                        <div class="member-browse-nt">                           
                            <span class="member-browse-name"> <?php  echo $item['title'];?></span>
                        </div>
                    </a>                   
                </div>
              <span class='goodsprice' style="hidden"><?php  echo $item['totalprice'];?></span>
                <div class="member-browser-pro-list" >
                    
                    <a class="member-browser-pro-a" href="#"><span class="pro-img">
                        <img src="<?php  echo $_W['attachurl'].$item['thumb']?>"></span><p class="pro-info"><span class="pro-name">价格：<?php  echo $item['totalprice'];?></span><span class="pro-price">数量：<?php  echo $item['total'];?><?php  if(!empty($item['unit'])) { ?><?php  echo $item['unit'];?><?php  } ?></strong></span>
                        	 <?php  if(!empty($item['optionname'])) { ?>
                        	<br/><span class="pro-price">规格：  <?php  echo $item['optionname'];?></span><?php  } ?></p>
                    </a>
                    
                </div>
            </li>
				<?php  } } ?>
			
			
            
        </ul>
    </div>
	    </div>




<div class="infobox ">
<ul id='infoul' class="otherInfo">
	<li>备注信息：<textarea name="remark" onchange='oninputchange("detail");' style='width:100%;border: none;' type="text" value="" placeholder="亲，还有什么要交待的话，告诉我们吧！" ></textarea></li>
</ul>
</div>



<div class="carFoot"><button type="submit" id='submit'  name="submit" value="yes" style="display: inline-block;float: right;padding: 0 33px;text-align: center;height: 35px;line-height: 35px;margin-right: 10px;color: #fff;background: #e4393c;font-size: 16px;border: none;border-radius: 5px;">提交订单</button><p>合计：<i class="price">&yen;<span id='totalprice'><?php  echo $totalprice;?></span><span >元</span></i></p></div>




	
	<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
</form>
</section>


	<?php  include $this->template('footer', TEMPLATE_INCLUDEPATH);?>			





<script src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/zepto.min.js" type="text/javascript"></script>
<script type="text/javascript">
Zepto(function($){
   var $nav = $('.global-nav'), $btnLogo = $('.global-nav__operate-wrap');
   //点击箭头，显示隐藏导航
   $btnLogo.on('click',function(){
     if($btnLogo.parent().hasClass('global-nav--current')){
       navHide();
     }else{
       navShow();
     }
   });
   var navShow = function(){
     $nav.addClass('global-nav--current');
   }
   var navHide = function(){
     $nav.removeClass('global-nav--current');
   }
   
   $(window).on("scroll", function() {
		if($nav.hasClass('global-nav--current')){
			navHide();
		}
	});
})
function get_search_box(){
	try{
		document.getElementById('get_search_box').click();
	}catch(err){
		document.getElementById('keywordfoot').focus();
 	}
}
</script>




        <script language='javascript'>
    
			function changeAddress(){
                location.href = '<?php  echo $this->createMobileUrl('address', array('from'=>'confirm','returnurl'=>urlencode($returnurl)))?>'
            }
            function check(){
			    if(<?php  echo $_W['weid'];?>==18){
				   return true;
				}
                if($(".address_item").length<=0){
                    alert("请添加收货地址!");
                    return false;
                }      
                 if($('input:radio[name="dispatch"]:checked').val()!=null)
                 {
                 	return true;
                 	
                 }else
                	{
                		alert("请选择支付方式");
                		  return false;
                		}
          
              
            }
       
            function oncheckboxchange(paytype,dispatchpricestr){
                var price = 0;
                $(".goodsprice").each(function(){
                    price+=parseFloat($(this).html());
                });
                var dispatchprice = parseFloat(dispatchpricestr);
                if(dispatchprice>0){
                	var allmoney=parseFloat(price) + parseFloat(dispatchprice);
                	  allmoney= allmoney.toFixed(2);
                   $("#totalprice").html(allmoney + "  (含运费"+dispatchprice + ")");    
                 
                  $("#dispatchshow").css('display','block');
                  
                  $("#dispatchshow_price").html(dispatchprice);    
                   $("#dispatchshow_name").html($("#dispatch").find("option:selected").attr("dispatchname"));    
 
                }
                else{
                    $("#totalprice").html(price);    
                       $("#dispatchshow").css('display','none');
                }
                
            }
 </script>
            
 

<?php  include $this->template('jsweixin', TEMPLATE_INCLUDEPATH);?>

</body>
</html>   