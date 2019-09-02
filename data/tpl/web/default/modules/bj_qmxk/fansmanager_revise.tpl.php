<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<div class="main">
	<div class="form form-horizontal"  style='width:80%;margin:0 auto'>
		<h4>代理信息修改</h4>
                <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" onsubmit='return check()'>
		<table class="tb">
			<tr>
				<th style="width:200px"><label for="aa">姓名</label></th>
				<td>
                                    <input type="text" name='realname' value="<?php  echo $user['realname'];?>"/>
				</td>
			</tr>
<!--                        <tr>
				<th style="width:200px"><label for="">身份</label></th>
				<td>
                                    <?php  if(is_array($cardtype)) { foreach($cardtype as $key => $val) { ?>
                                        <label class="radio inline"><input type="radio" name="vip" value="<?php  echo $val['cardid'];?>" <?php  if($user['cardid']==$val['cardid']) { ?>checked<?php  } ?> <?php  if($user['cardid']>$val['cardid']) { ?>disabled<?php  } ?>><?php  echo $val["card_name"];?></label>
                                    <?php  } } ?>
                                    <span  class="help-inline">（会员卡只能进行升级，不能降级）</span>
				</td>
			</tr>-->
                        <tr>
				<th style="width:200px"><label for="">禁用状态</label></th>
				<td>
					<label class="radio inline"><input type="radio" name="status" value="1" <?php  if($user['status']==1) { ?>checked<?php  } ?>>可用</label>
					<label class="radio inline"><input type="radio" name="status" value="0" <?php  if($user['status']==0) { ?>checked<?php  } ?>>禁用</label>
				</td>
			</tr>
			<tr>
				<th style="width:200px"><label for="">手机号码</label></th>
				<td>
					<input type="text" name='mobile'  value="<?php  echo $user['mobile'];?>"/>
				</td>
			</tr>
                        <tr>
				<th style="width:200px"><label for="">分红积分上限</label></th>
				<td>
					<input type="text" name='creditlimit'  value="<?php  echo $user['creditlimit'];?>"/>
                                        <span style="color: gray">(注：分红积分上限设置为0时，分红积分无上限)</span>
				</td>
			</tr>
			<tr>
				<th><label for="">注册时间</label></th>
				<td>
					<?php  echo date('Y-m-d H:i:s', $user['createtime']);?>
				</td>
			</tr>	
                        <tr>
				<th><label for="">银行类型</label></th>
				<td>
					<input type="text" name='banktype' value="<?php  echo $user['banktype'];?>"/>
				</td>
			</tr>
			<tr>
				<th><label for="">银行卡号</label></th>
				<td>
					<input type="text" name='bankcard'  value="<?php  echo $user['bankcard'];?>"/>
				</td>
			</tr>
<!--			<tr>
				<th><label for="">支付宝号</label></th>
				<td>
					<?php  if($user['alipay']!="") { ?> <?php  echo $user['alipay'];?><?php  } else { ?>--<?php  } ?>
				</td>
			</tr>-->
			
			<tr>
				<th><label for="">备注</label></th>
				<td>
                                    <textarea name='content' rows="10" cols="60" style="width:auto;"><?php  echo $user['content'];?></textarea>
				</td>
			</tr>
			<tr>
				<th></th>
				<td>
                                    <input type="hidden" name='op'  value="revise"/>    
                                    <input type="hidden" name='id'  value="<?php  echo $user['id'];?>"/>
                                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                                    <input type="submit"  name="submit" class="btn btn-primary span3" value="保存修改"/>
				</td>
			</tr>
		</table>
                </form>
	</div>
</div>

<script type="text/javascript">
    function check(){
        var realname = $('input[name="realname"]').val();       
        var mobile = $('input[name="mobile"]').val();
        if (realname == "") {
            alert("请填写姓名");
            return false;
        }
        if (mobile == "") {
            alert("请填写手机号");
            return false;
        }
        return true;
    }
window.onload = function(){
	var bankcard = "<?php  echo $user['bankcard'];?>";
	//var bankcard = bankcard.toString();
	if(bankcard != ''){
		var card = '';
		for(var i=0; i<5; i++){
			card = card + bankcard.substr(4*i,4) + ' ';
		}
		window.document.getElementById('bankcard').innerHTML = card;
	}
}

</script>
<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>
