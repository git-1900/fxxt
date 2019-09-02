<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('header', TEMPLATE_INCLUDEPATH);?>
<style>
	
	.head{height:40px; line-height:40px; background:#2786fb; margin-bottom:5px; padding:0 5px; color:#fa0600;}
	.head .bn{display:inline-block; height:30px; line-height:30px; padding:0 10px; margin-top:4px; font-size:20px; border:1px #1176f2 solid; background:#3f95ff; color:#FFF; text-decoration:none;}
	.head .bn.pull-right{position:absolute; right:5px; top:0;}
	.head .title{font-size:14pt;display:block;padding-left:10px;font-weight:bolder;margin-right:49px;text-align:center;height:40px;line-height:40px;text-overflow:ellipsis;white-space:nowrap;overflow: hidden;}
	.head .order{background:#F9F9F9; position:absolute; z-index:9999; right:0;}
	.head .order li > a{display:block; padding:0 10px; min-width:100px; height:35px; line-height:35px; font-size:16px; color:#333; text-decoration:none; border-top:1px #EEE solid;}
	.head .order li.icon-caret-up{font-size:20px;color:#F9F9F9;position:absolute;top:-11px;right:16px;}
	.footer_btn {position:fixed;left:25%;bottom:0;text-align:center;width:50%;height:40px;border:2px solid #009fff;border-radius:25px;font-size:25px;background-color:#58a3ff;color:#FFFFFF}
	.text-center{padding:20px 15px}
        .text-center span{color:#ffffff;font-size:18px}
        .text-center span input {margin:15px auto;height:50px;width:250px }
        .text-center span textarea{margin:15px auto;width:250px;height:150px }
        #submit{width:250px;margin-top: 50px}
        body{background:url('./source/modules/site/template/image/background.jpg');height: 100%}
        #footer{color:#ffffff}

</style>
<div class="head">
	<a href="javascript:history.go(-1);" class="bn pull-left"><i class="icon-reply"></i></a>
	<span class="title">活动报名</span>

</div>
<div class="text-center" style="">
    <form action="" method="post" onsubmit="return check()">
    <div class="text-center">
        <span>姓名：<input type="text" class="text_1" name="username" value="" placeholder="请输入姓名"/></span></br>
        <span>电话：<input type="text" class="text_1"  name="tel" value="" placeholder="请输入手机号码"/></span></br>
        <span>备注：<textarea name="remark" placeholder=""></textarea></span></br>
        <span><input type="submit" name="submit" class="btn btn-primary btn-large" value="报名" id="submit"></span>
        <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
    </div> 
    </form>
</div>
<?php  include $this->template('footer', TEMPLATE_INCLUDEPATH);?>
<script>
    function check(){
        var username = $("input[name='username']");
        var tel = $("input[name='tel']");
        var remark = $("textarea[name='remark']");
        if (username.val() == '') {
            alert("请输入姓名");
            username.focus();
            return false;
        }
        if (tel.val() == '') {
            alert("请输入手机号码");
            tel.focus();
            return false;
        }else if (!/^1(3[0-9]|4[57]|5[0-35-9]|7[0135678]|8[0-9])\d{8}$/.test(tel.val())) {
            alert("请输入有效的手机号码");
            tel.focus();
            return false;
        }
        if (remark.val().length > 2) {
            alert("备注不能超过50个字");
            remark.focus();
            return false;
        }
        return true;
    }
</script>