<?php defined('IN_IA') or exit('Access Denied');?>
<div class="wx_nav" style="font-size:16px;">

<?php  if($this->isDzdMode($profile,$dzduid)==true) { ?>
			<a href="<?php  echo $this->createMobileUrl('list',array('dzdid'=>$profile['id']))?>"  ptag="37080.1.1" class="nav_index on" style="font-size:14px;">我的小店</a>
		<?php  } else { ?>
<a href="<?php echo $this->createMobileUrl('list',array('dzdid'=>$dzduid==-1?-1:$this->getDzdid($dzduid)))?>" data-href="###" ptag="37080.1.1" class="nav_index on" style="font-size:14px;">首页</a>

	<?php  } ?>
		<a href="<?php  echo $this->createMobileUrl('listCategory')?>"  ptag="37080.1.2" class="nav_search" style="display:;font-size:14px;">分类</a>

	<a href="<?php  echo $this->createMobileUrl('mycart')?>"  ptag="37080.1.3" class="nav_shopcart"  style="font-size:14px;" >购物车</a><a href="<?php  echo $this->createMobileUrl('myorder')?>"  ptag="37080.1.4" class="nav_shopping_guide"  style="font-size:14px;" >我的订单</a><a href="<?php  echo $this->createMobileUrl('fansindex')?>"  ptag="37080.1.4" class="nav_me" style="font-size:14px;" >个人中心</a>
</div>

<style>

.wx_nav{
	overflow:hidden;
	height:50px;
	position:fixed;
	z-index:900;
	width:100%;
	bottom:0;
	left:0;
	background:#fff;
	border-top:2px #ff9900 solid;
border-bottom:2px #fff solid;

	}


	
.wx_nav a{
	width:200px;
	height:45px;
	padding-top:4px;
	color:#5c6066;
	font-size:12px;
	filter:alpha(opacity=50); 
	background:#fff none repeat scroll 0 0 !important;
	text-align:center
	}
	
.wx_nav a:before{
	width:23px;
	height:23px;
	content:'\20';
	display:block;
	margin:0 auto 2px auto
	}
	
.wx_nav a:active{
	background-color:#fff;
	}
	
.wx_nav a:active,.wx_nav a.on{
	color:#5c6066
	}
	
.wx_nav a:active:before,.wx_nav a.on:before{
	background-position-y:-23px
	}
	
.wx_nav a.dot{
	position:relative
	}
	
.wx_nav a.dot:after{
	content:'';
	display:inline-block;
	width:7px;
	height:7px;
	background:#e4393c;
	border-radius:4px;
	position:absolute;
	top:5px;
	left:50%;
	margin-left:10px
	}
	
.wx_nav .nav_index:before{
	background-position:0 0
	}
	
.wx_nav .nav_search:before{
	background-position:-46px 0
	}
	
.wx_nav .nav_fav:before{
	background-position:-23px 0
	}
	
.wx_nav .nav_shopcart:before{
	background-position:-138px 0
	}
	
.wx_nav .nav_me:before{
	background-position:-69px 0
	}
	
.nav_me1:before{
	background-position:-69px 0
	}
	
.wx_nav .nav_newsfeed:before{
	background-position:-161px 0
	}
	
.wx_nav .nav_shopping_guide:before{
	background-position:-184px 0
	}
	
.WX_search_promote .WX_search_frm{
	padding:0 60px 0 43px
	}
	
.WX_search_frm1{
	padding:0 60px 0 13px
	}
	





</style>