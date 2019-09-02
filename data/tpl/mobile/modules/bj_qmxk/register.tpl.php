<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
<title><?php  if($opp=='complate') { ?>完善资料<?php  } else { ?>注册<?php  } ?></title>
<meta charset="utf-8">
<link rel="stylesheet" href="<?php echo BJ_QMXK_ROOT;?>/style/css/style.css?r=<?php  echo time()?>"/>
<link href="<?php echo BJ_QMXK_ROOT;?>/recouse/css/bottom.css?x=<?php echo BJ_QMXK_VERSION;?>" rel="stylesheet" type="text/css" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no" />
<meta name="mobileOptimized" content="width" />
<meta name="handheldFriendly" content="true" />
<meta http-equiv="Cache-Control" content="max-age=0" />
<meta name="apple-touch-fullscreen" content="yes" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
</head>
<body>
	
<section class="main animated fadeInDown">
	<div class="main-box">
		
		
		<p class="rb-row"><span>姓名昵称：</span><input type="text" id="realname" placeholder="请输入您的姓名或是昵称" class="input" value="<?php  echo $profile['realname'];?>"/></p>
		<p class="rb-row"><span>手机号码：</span><input type="tel" id="mobile" placeholder="请输入您的手机号码" class="input" value="<?php  echo $profile['mobile'];?>"/></p>
		
		<?php  if($opp=='complate') { ?>
		<p class="rb-row"><span>银行名称：</span><input type="text" id="banktype" placeholder="请输入您的银行卡名称" class="input" value="<?php  echo $profile['banktype'];?>"/></p>
		<p class="rb-row"><span>银行卡号：</span><input type="tel" id="bankcard" placeholder="请输入您的银行卡号" class="input" value="<?php  echo $profile['bankcard'];?>"/></p>
		<p class="rb-row"><span>支付宝号：</span><input type="text" id="alipay" placeholder="请输入您的支付宝号" class="input" value="<?php  echo $profile['alipay'];?>"/></p>
		<p class="rb-row"><span>微支付号：</span><input type="text" id="wxhao" placeholder="请输入您的微信支付号码" class="input" value="<?php  echo $profile['wxhao'];?>"/></p>
		<?php  } ?>
	
		<div class="rb-row registerRuleBox border-box">
		
			<?php  if(!empty($profile)) { ?>
				<p class="rb-submit"><input type="button" value="确定" class="btn" id="J_submitReg"/></p>
			<?php  } else { ?>
				<p class="rb-submit"><input type="button" value="确定" class="btn" id="J_submitReg"/></p>
			<?php  } ?>
			<!--<hr>
			<h1>注册条款</h1>
			<div class="rule-text">
				<?php  echo $rule['terms'];?>
			</div>-->
			
		</div>
</section>
<?php  include $this->template('footer', TEMPLATE_INCLUDEPATH);?>
<?php  include $this->template('wx_nav', TEMPLATE_INCLUDEPATH);?>
<script src="http://libs.baidu.com/jquery/1.7.1/jquery.min.js"></script>
<script src="<?php echo BJ_QMXK_ROOT;?>/style/js/com.js"></script>
<script>
//注册粉丝信息
$("#J_submitReg").live("click", function () {
	var reg = /^1[3458]\d{9}$/;
	var bank = /^\d*$/g;
	//if($("#agree").attr('checked')=='checked'){
		
	//}else{
		//TopBox.alert("请同意注册协议!");
		//return;
	//}

	realname = $("#realname").val();
	mobile 	 = $("#mobile").val();
	password = $("#password").val();
	alipay 	 = '';
	wxhao 	 = '';
	banktype = '';
	bankcard = '';
	if('<?php  echo $opp;?>'=='complate'){
		alipay = $("#alipay").val();
		wxhao = $("#wxhao").val();
		banktype = $("#banktype").val();
		bankcard = $("#bankcard").val();
	}

	if (realname == "") {
		TopBox.alert("姓名不能为空!");
		return;
	} else if (!reg.test(mobile)) {
		TopBox.alert("手机格式不正确!");
		return;
	//}else if (password == "") {
		//TopBox.alert("密码不能为空!");
		//return;
	//}else if (password.length < 6) {
		//TopBox.alert("密码至少为6位!");
		//return;
	}else {
		
		$.ajax({
			type: "POST",
			url: "<?php  echo $this->createMobileurl('register',array('op'=>'add'))?>",
			data: { realname:realname, mobile:mobile, banktype:banktype, bankcard:bankcard, password:password, alipay:alipay, wxhao:wxhao },
			dataType: "text",
			success: function (d) {
				d = d.replace(/\s+/g,""); 
				if (d == "1") {
					TopBox.alert("粉丝注册成功.", function () { window.location.href = '<?php echo $this->createMobileurl(empty($fromaction)?'fansindex':$fromaction)?>'; });
				} else if (d == "2") {
					TopBox.alert("修改资料成功.", function () { window.location.href = '<?php echo $this->createMobileurl(empty($fromaction)?'fansindex':$fromaction)?>'; });
				} else if (d == "0") {
					TopBox.alert("粉丝注册失败.");
				} else if (d == "-1") {
					TopBox.alert("请完善银行卡信息！");
				}  else if (d == "-2") {
					TopBox.alert("请勿重复注册粉丝.");
				} else if (d == "-3") {
					TopBox.alert("已存在该手机号码.");
				} else {
					TopBox.alert("信息填写不正确.");
				}
			},
			
			error: function (xml, text, thrown) {
				TopBox.alert("出错啦!");
			}
		});

	}
});

</script>

<?php  include $this->template('jsweixin', TEMPLATE_INCLUDEPATH);?>
</body>
</html>