<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<style>
    .member_list li {margin-bottom:15px;float:left;width:12.5%;text-align:center;}
    .member_list li em{display:block;}
    .member_list li span{font-size:12px;color:#333;display:block;}
    .member_list li span i{padding:0 5px;}
    .member_list li b{color:#fe0000;font-size:14px;display:block;} 
    .member_list li em a img{border-radius:50%;width: 60%}
</style>
<div class="main" style='align:center'>
	<div class="form form-horizontal" style='width:80%;margin:0 auto'>
		<h4>代理详细信息</h4>
		<table class="tb">
			<tr>
				<th style="width:200px"><label for="">姓名</label></th>
				<td>
					<?php  if($user['realname']!="") { ?> <?php  echo $user['realname'];?><?php  } else { ?>--<?php  } ?>
				</td>
			</tr>
			<tr>
				<th style="width:200px"><label for="">积分</label></th>
				<td>
					<?php  if($user['credit2']!="") { ?> <?php  echo $user['credit2'];?><?php  } else { ?>--<?php  } ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="<?php  echo $this->createWebUrl('fansmanager',array('op'=>'credit_detail','from_user' => $user['from_user']));?>" class="btn">积分变更历史记录</a>
				</td>
			</tr>
                        <tr>
				<th style="width:200px"><label for="">身份</label></th>
				<td>
					<?php  if($user['card_name']!="") { ?> <?php  echo $user['card_name'];?><?php  } else { ?>--<?php  } ?>
				</td>
			</tr>
                        <tr>
				<th style="width:200px"><label for="">禁用状态</label></th>
				<td>
					<?php  if($user['status']==0) { ?>禁用<?php  } else { ?>未禁用<?php  } ?>
				</td>
			</tr>
			<tr>
				<th style="width:200px"><label for="">手机号码</label></th>
				<td>
					<?php  if($user['mobile']!="") { ?> <?php  echo $user['mobile'];?><?php  } else { ?>--<?php  } ?>
				</td>
			</tr>
                        <tr>
				<th style="width:200px"><label for="">分红积分上限</label></th>
				<td>
					<?php  if($user['creditlimit']!=0) { ?> <?php  echo $user['creditlimit'];?><?php  } else { ?>无上限<?php  } ?>
				</td>
			</tr>
			<tr>
				<th><label for="">注册时间</label></th>
				<td>
					<?php  echo date('Y-m-d H:i:s', $user['createtime']);?>
				</td>
			</tr>			
			<tr>
				<th><label for="">银行卡号</label></th>
				<td>
					<?php  if($user['banktype']!="") { ?> <?php  echo $user['banktype'];?>－<span id="bankcard"><?php  echo $user['bankcard'];?></span> <?php  } else { ?>--<?php  } ?>
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
					<?php  if($user['content']!="") { ?><?php  echo $user['content'];?><?php  } else { ?>--<?php  } ?>
				</td>
			</tr>
			<tr>
				<th></th>
				<td>
					<!--<input type="button" class="btn btn-primary span3" name="submit" onclick="history.go(-1)" value="返回" />-->
                                        <a href="<?php  echo $this->createWebUrl('fansmanager', array('op'=>'revise','id'=>$user['id']));?>" class="btn btn-primary span3">修改</a>
				</td>
			</tr>
		</table>
                <h4>发展的会员</h4>
                <div id='member_list' class="member_list" >
                    <ul class="clearFix">
                        <?php  if(is_array($member_list)) { foreach($member_list as $key => $val) { ?>
                            <li>
                                <em><a href="<?php  echo $this->createWebUrl('fansmanager',array('op'=>'detail','id' => $val['id']));?>"><img src="<?php  echo $val['avatar'];?>"></a></em>
                                <span><?php  echo $val['realname'];?><i></br></i><?php  echo $val['card_name'];?></span>
                                <b>
                                    <?php  if($val['exchange_status'] == 2) { ?>已兑换<?php  } else { ?>未兑换<?php  } ?>
                                </b>
                            </li>
                        <?php  } } ?>
                    </ul>
                </div>
	</div>
</div>
<link type="text/css" rel="stylesheet" href="./resource/style/base.css" />

<script type="text/javascript">
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
