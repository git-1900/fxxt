<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
<title>我的银行卡</title>
<meta charset="utf-8">
<link rel="stylesheet" href="<?php echo BJ_QMXK_ROOT;?>/style/css/style.css"/>
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
               
				<p class="rb-row"><input type="text" class="input" id="bankAccount" value="<?php  echo $profile['realname'];?>" readonly style="background:#ccc" /></p>
				<p class="rb-row"><input type="text" placeholder="请输入您的银行名称" class="input" id="banktype" value="<?php  echo $profile['banktype'];?>"/></p>
                <p class="rb-row"><input type="tel" placeholder="请输入您的银行卡号" class="input" id="bankcard" value="<?php  echo $profile['bankcard'];?>"/></p>
				<p class="rb-row"><input type="text" placeholder="请输入您的支付宝账号，可不填" id="alipay" class="input" value="<?php  echo $profile['alipay'];?>"/></p>
				<p class="rb-row"><input type="text" placeholder="请输入您的微信支付号码，可不填" id="wxhao" class="input" value="<?php  echo $profile['wxhao'];?>"/></p>
				<div class="recommend-tips">
					<h6>提示</h6>
					<p>为了您能快速结佣请提供详细的开户行信息,如招商银行福州华林支行。</p>
				</div>
				<p class="rb-submit"><input type="button" value="保存" class="btn" id="J_saveCard"/></p>
			</div>
		</section>
<?php  include $this->template('footer', TEMPLATE_INCLUDEPATH);?>

<script src="http://libs.baidu.com/jquery/1.7.1/jquery.min.js"></script>
<script src="<?php echo BJ_QMXK_ROOT;?>/style/js/com.js"></script>
<script>
//保存银行卡信息
$('#J_saveCard').live("click", function () {
			
	bankcard = $("#bankcard").val();
	banktype = $("#banktype").val();
	alipay = $("#alipay").val();
	wxhao = $("#wxhao").val();
	opp = "<?php  echo $_GPC['opp'];?>";
	if (banktype == "") {
		TopBox.alert("请填写银行卡名称!");
		return;
	}
	if (bankcard == "") {
		TopBox.alert("请填写银行卡号码!");
		return;
	} else {
		
		$.ajax({
			type: "POST",
			url: "<?php  echo $this->createMobileurl('bankcard',array('op'=>'edit'))?>",
			data: { 'bankcard': bankcard, 'banktype': banktype, 'alipay': alipay, 'wxhao': wxhao, 'opp': opp},
			dataType: "text",
			
			success: function (d) {
				if (d == "1") {
					
					TopBox.alert("填写成功.", function () { window.location.href = "<?php  echo $this->createMobileurl('fansindex',array('id'=>$profile['id']))?>"; });
					
				} else if (d == "3") {
					TopBox.alert("完善资料成功.", function () { window.location.href = '<?php  echo $this->createMobileurl('commission', array('op'=>'commapply'))?>'; });
				} else if (d == "0") {
					
					TopBox.alert("填写失败.");
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