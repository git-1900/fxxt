<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('header', TEMPLATE_INCLUDEPATH);?>
<?php  $row = $detail;?>
<div id="activity-detail">
<style type="text/css">
@charset "utf-8";
html{background:#FFF;color:#000;}
body, div, dl, dt, dd, h1, h2, h3, h4, h5, h6, pre, code, form, fieldset, legend, input, textarea, p, blockquote, th, td{margin:0;padding:0;}
table{border-collapse:collapse;border-spacing:0;}
fieldset, img{border:0;}
address, caption, cite, code, dfn,  th, var{font-style:normal;font-weight:normal;}
ol, ul{list-style:none;}
caption, th{text-align:left;}
h1, h2, h3, h4, h5, h6{font-size:100%;font-weight:normal;}
q:before, q:after{content:'';}
abbr, acronym{border:0;font-variant:normal;}
sup{vertical-align:text-top;}
sub{vertical-align:text-bottom;}
input, textarea, select{font-family:inherit;font-size:inherit;font-weight:inherit;}
input, textarea, select{font-size:100%;}
legend{color:#000;}
body{color:#222;font-family:Helvetica, STHeiti STXihei, Microsoft JhengHei, Microsoft YaHei, Tohoma, Arial;height:100%;position:relative;}
body > .tips{display:none;left:50%;padding:20px;position:fixed;text-align:center;top:50%;width:200px;z-index:100;}
.page{padding:15px;}
.page .page-error, .page .page-loading{line-height:30px;position:relative;text-align:center;}
#activity-detail .page-bizinfo{border-bottom:1px dotted #CCC;}
#activity-detail .page-bizinfo .header{padding:10px 10px 10px;}
#activity-detail .page-bizinfo .header #activity-name{color:#000;font-size:20px;font-weight:bold;word-break:normal;word-wrap:break-word;}
#activity-detail .page-bizinfo .header #post-date{color:#8c8c8c;font-size:11px;margin:0;}
#activity-detail .page-content{padding:10px;}
#activity-detail .page-content .media{margin-bottom:18px;}
#activity-detail .page-content .media img{width:100%;}
#activity-detail .page-content .text{color:#3e3e3e;font-size:1.5;line-height:1.5;width: 100%;overflow: hidden;zoom:1;}
#activity-detail .page-content .text p{min-height:1.5em;min-height: 1.5em;word-wrap: break-word;word-break:break-all;}
#activity-list .header{font-size:20px;}
#activity-list .page-list{border:1px solid #ccc;border-radius:5px;margin:18px 0;overflow:hidden;}
#activity-list .page-list .line.btn{border-radius:0;margin:0;text-align:left;}
#activity-list .page-list .line.btn .checkbox{height:25px;line-height:25px;padding-left:35px;position:relative;}
#activity-list .page-list .line.btn .checkbox .icons{background-color:#ccc;left:0;position:absolute;top:0;}
#activity-list .page-list .line.btn.off .icons{background-image:none;}
#activity-list #save.btn{background-image:linear-gradient(#22dd22, #009900);background-image:-moz-linear-gradient(#22dd22, #009900);background-image:-ms-linear-gradient(#22dd22, #009900);background-image:-o-linear-gradient(#22dd22, #009900);background-image:-webkit-gradient(linear, left top, left bottom, from(#22dd22), to(#009900));background-image:-webkit-linear-gradient(#22dd22, #009900);}
.vm{vertical-align:middle;}
.tc{text-align:center;}
.db{display:block;}
.dib{display:inline-block;}
.b{font-weight:700;}
.clr{clear:both;}
.text img{max-width:100%;}
.page-url{padding-top:18px;}
.page-url-link{color:#607FA6;font-size:14px;text-decoration:none;text-shadow:0 1px #ffffff;-webkit-text-shadow:0 1px #ffffff;-moz-text-shadow:0 1px #ffffff;}
#mbutton{padding:15px 10px 15px 10px; overflow:hidden; border-bottom:1px #DDD solid;}
#mbutton > span{float:right; display:inline-block; background:#58a3ff; border:1px #63a0eb solid; color:#FFF; height:30px; line-height:30px; padding:0 10px; margin-left:10px;}
#mcover{position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0, 0, 0, 0.7);display:none;z-index:20000;}
#mcover img{position:fixed;right: 18px;top:5px;width:260px;height:180px;z-index:20001;}
.head{height:40px; line-height:40px; background:#2786fb; margin-bottom:5px; padding:0 5px; color:#FFF;}
.head .bn{display:inline-block; height:30px; line-height:30px; padding:0 10px; margin-top:4px; font-size:20px; border:1px #1176f2 solid; background:#3f95ff; color:#FFF; text-decoration:none;}
.head .bn.pull-right{position:absolute; right:5px; top:0;}
.head .title{font-size:14pt;display:block;padding-left:10px;font-weight:bolder;margin-right:49px;text-align:center;height:40px;line-height:40px;text-overflow:ellipsis;white-space:nowrap;overflow: hidden;}
.head .order{background:#F9F9F9; position:absolute; z-index:9999; right:0;}
.head .order li > a{display:block; padding:0 10px; min-width:100px; height:35px; line-height:35px; font-size:16px; color:#333; text-decoration:none; border-top:1px #EEE solid;}
.head .order li.icon-caret-up{font-size:20px;color:#F9F9F9;position:absolute;top:-11px;right:16px;}
.footer_btn {position:fixed;left:25%;bottom:0;text-align:center;width:50%;height:40px;border:2px solid #009fff;border-radius:25px;font-size:25px;background-color:#58a3ff;color:#FFFFFF}
</style>
<div class="head">
	<a href="javascript:history.go(-1);" class="bn pull-left"><i class="icon-reply"></i></a>
	<span class="title"><?php  echo $title;?></span>
	<a href="javascript:$('.head .order').toggleClass('hide');" class="bn pull-right"><i class="icon-reorder"></i></a>
	<ul class="unstyled order hide">
		<li class="icon-caret-up"></li>
		<?php  $site_category = modulefunc('site', 'site_category', array (
  'func' => 'site_category',
  'limit' => 1,
)); if(is_array($site_category)) { foreach($site_category as $i => $row) { ?>
		<li>
			<a href="<?php  echo $this->createMobileUrl('list', array('name' => 'site', 'cid' => $row['id'], 'weid' => $_W['weid']))?>">
				<?php  echo $row['name'];?>
			</a>
		</li>
		<?php  if(is_array($row['children'])) { foreach($row['children'] as $item) { ?>
		<li>
			<a href="<?php  echo $this->createMobileUrl('list', array('name' => 'site', 'cid' => $item['id'], 'weid' => $_W['weid']))?>">
				<?php  echo $item['name'];?>
			</a>
		</li>
		<?php  } } ?>
		<?php  } } ?>
	</ul>
</div>
<div class="page-bizinfo">
	<div class="header">
		<h1 id="activity-name"><?php  echo $detail['title'];?></h1>
		<span id="post-date">作者：<?php  echo $detail['author'];?>&nbsp;&nbsp;&nbsp;时间：<?php  echo date("Y-m-d", $detail['createtime']);?>&nbsp;&nbsp;&nbsp;<a href="weixin://contacts/profile/<?php  echo $_W['account']['account'];?>" class="contacts"><?php  if(empty($_W['account']['name'])) { ?>运河印象团队<?php  } else { ?><?php  echo $_W['account']['name'];?><?php  } ?></a>&nbsp;&nbsp;&nbsp;&nbsp;阅读：<?php  echo $detail['clicktimes'];?></span>
	</div>
</div>
<div class="page-content">
	<div class="text">
		<?php  echo $detail['content'];?>
	</div>
</div>
</div>
<div id="mbutton">
	<span class="" onclick="$('#mcover').show()"><i class="icon-share-alt"></i> 转发</span>
	<span class="" onclick="$('#mcover').show()"><i class="icon-group"></i> 分享</span>
</div>
<?php  if($detail['pcate_name']=="活动报名") { ?>
<div class="footer_btn">
	<?php  if($activity_exit>0) { ?>
    已报名
    <?php  } else { ?>
    <span id="signup">我要报名</span>
    <?php  } ?>
	</div>
<?php  } ?>
<div id="mcover" onclick="$(this).hide()"><img src="./source/modules/site/template/image/guide.png"></div>
<script>
$(function() {
	if(!navigator.userAgent.match(/Android/i)) {
		$(".contacts").click(function() {
			$('#mcover').show();
			return false;
		});
	}
});
$("#signup").click(function(){
    window.location.href="<?php  echo $this->createMobileUrl('activity', array('id' =>$detail['id'], 'weid' => $_W['weid']))?>";
});
</script>
<?php  $_share_content = $detail['content'];?>
<?php  include $this->template('footer', TEMPLATE_INCLUDEPATH);?>