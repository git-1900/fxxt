<?php defined('IN_IA') or exit('Access Denied');?><style>
.quick{
	height:50px;
	text-align:center;
}

.footer_bar .quick{height:0;}
.quick ul{
	border-top:1px solid #4b3e38;
	height:50px;
	position:fixed;
	z-index:200;
	bottom:0;
	left:0;
	width:100%;
	background:-webkit-gradient(linear, 0 0, 0 100%, from(#5e544f), to(#433c38));
}
.quick li>a{
	color:#8c8f94;
	-webkit-box-sizing:border-box;
	box-sizing:border-box;
	border-bottom:0;
	display:block;
	height:100%;
	padding:5px 0;
	text-align:center;
	-webkit-tap-highlight-color:rgba(0,0,0,0);
}
.quick li>a.on, .quick li>a.active{
	color:#fff;
}
.quick li>a>*{
	pointer-events:none;
}
.quick li>a>p{
	display: block;
	width:25px;
	height:25px;
	margin:auto;
	-webkit-background-size:100px auto;
}
.quick li>a>p[class*="icon"]{
	background: none;
	font-size: 19px;
	line-height: 25px;
}
.quick li>a>p.voice{
	background-position:-13px -63px;
}
.quick li>a>p.addr{
	background-position:-13px -113px;
}
.quick li>a>p.tip{
	background-position:-13px -163px;
}
.quick li>a>p.back{
	background-position:-13px -213px;
}
.quick li>a>p.share{
	background-position:-13px -263px;
}
.quick li>a>p.back2{
	background-position:-13px -313px;
}
.quick li>a.on>p, .quick li>a.active>p{
	background-position-x:-63px;
}

.quick li>a.home{
	height:70px;
	width:70px;
	margin:auto;
	border-radius: 60px;
	position:relative;
	top:-20px;
	background:url('./themes/mobile/quick/images/quick5.png') no-repeat center center;
	-webkit-background-size:100% 100%;
}
.quick-box {
	width: 100%;
	display: -webkit-box;
	display: -moz-box;
	-webkit-box-orient: horizontal;
	-moz-box-orient: horizontal;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
}
.quick-box > * {
	-webkit-box-flex: 1;
	-moz-box-flex: 1;
}
</style>
<div class="top_bar footer_bar">
	<div class="quick">
		<ul class="quick-box">
        	<?php  $i = 1;?>
			<?php  if(is_array($_W['quickmenu']['menus'])) { foreach($_W['quickmenu']['menus'] as $nav) { ?>
			<li>
				<?php  if($i==3) { ?>
				<a href="<?php  echo $nav['url'];?>" class="home"></a>
				<?php  } else { ?>
				<a href="<?php  echo $nav['url'];?>" style="<?php  echo $nav['css']['icon']['style'];?>">
					<p class="<?php  echo $nav['css']['icon']['icon'];?>"></p>
					<span style="<?php  echo $nav['css']['name'];?>"><?php  echo $nav['name'];?></span>
				</a>
				<?php  } ?>
			</li>
            <?php  if($i>=5) break;?>
            <?php  $i++;?>
			<?php  } } ?>
		</ul>
	</div>
</div>