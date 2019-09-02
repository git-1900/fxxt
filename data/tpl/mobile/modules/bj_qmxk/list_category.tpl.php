<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>分类列表</title>
	<meta content="telephone=no" name="format-detection" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="viewport" content="width=320, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/reset.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/search_new.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/xmapp.css"/>
	<link href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/bjcommon.css?x=44554" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/jquery.lazyload.js"></script>
	<script type="text/javascript">
jQuery(document).ready(function($) {
	$("#submit").click(function() {
		if($("#search_word").val()){
			$("#searchForm").submit();
		} else {
			alert("请输入关键词！");
			return false;
		}
	});
});
</script>
</head>
<script type="text/javascript">
	document.write('<div id="global_loading" style="width: 100%;height: 100%;position: fixed;top: 0;left: 0;background-color: #eee;z-index:999"><div style="width: 100px;height: 75px;margin:auto;top:50%;position:relative"><span style="display:block;float:left;width:32px;height:32px;background:url(/<?php echo BJ_QMXK_ROOT;?>/recouse/images/spacer.gif);margin-top:-5px;"></span>&nbsp;&nbsp;加载中...</div></div>');
</script>
<body style=" margin:0 auto;">






<div class="WX_search1" id="mallHead">
  
	<form class="WX_search_frm1" action="mobile.php" id="searchForm" name="searchForm">
		<input type="hidden" name="act" value="module" />
		<input type="hidden" name="eid" value="<?php  echo $_GPC['eid'];?>" />
		<input type="hidden" name="name" value="bj_qmxk" />
		<input type="hidden" name="do" value="Search" />
		<input type="hidden" name="weid" value="<?php  echo $_GPC['weid'];?>" />
        <input name="keyword" id="search_word" class="WX_search_txt hd_search_txt_null" placeholder="请输入商品名进行搜索！" ptag="37080.5.2" type="search"  AUTOCOMPLETE="off"/>
      
   
    <div class="WX_me">
        <a href="javascript:;" id="submit" class="WX_search_btn_blue" >搜索</a>
       
    </div>
	 </form>
</div>





		<div class="tab">
			
			<!--Tab 标签end-->

<!-- 分类浏览begin -->
<div class="category">
	<ul>     	
		<?php  if(is_array($category)) { foreach($category as $item) { ?>
		<li class="clearfix">
			<div class="info">
				<p class="name"><a href="<?php  echo $this->createMobileUrl('list2', array('pcate' => $item['id']))?>"><?php  echo $item['name'];?></a></p>
					<div class="data">
						<?php  if(is_array($children[$item['id']])) { foreach($children[$item['id']] as $child) { ?>
                    	<a href="<?php  echo $this->createMobileUrl('list2', array('ccate' => $child['id']))?>"><?php  echo $child['name'];?></a>
						<?php  } } ?>
                    </div>
			</div>
		</li>
		<?php  } } ?>
    </ul>
</div>
<!-- 分类浏览end -->
		</div>
	</div>



<?php  include $this->template('wx_nav', TEMPLATE_INCLUDEPATH);?>
<script src="<?php echo BJ_QMXK_ROOT;?>/recouse/js/zepto.min.js" type="text/javascript"></script>
<script type="text/javascript">
		var global_loading=document.getElementById("global_loading");
		global_loading.parentNode.removeChild(global_loading);
</script>


<?php  include $this->template('footer', TEMPLATE_INCLUDEPATH);?>
<?php  include $this->template('jsweixin', TEMPLATE_INCLUDEPATH);?>
</body>
</html>
<?php  echo $this->getKFcode();?>