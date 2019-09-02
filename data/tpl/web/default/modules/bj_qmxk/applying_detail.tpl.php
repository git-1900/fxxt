<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<ul class="nav nav-tabs">
	<li><a href="<?php  echo $this->createWebUrl('commission', array('op'=>'display'))?>">佣金审核提现操作</a></li>
	<li ><a href="<?php  echo $this->createWebUrl('commission', array('op'=>'applyed'))?>">已结算订单</a></li>
	
		<li class="active"><a href="#">审核打款详细信息</a></li>
	
	<li><a href="<?php  echo create_url('site/module', array('do' => 'zhifu', 'op' => 'list','name' => 'bj_qmxk','weid'=>$_W['weid']))?>">代理提现报表</a></li>
	<li><a href="<?php  echo $this->createWebUrl('commission', array('op'=>'invalid'))?>">审核无效</a></li>
</ul>
<div class="main">
	<div class="form form-horizontal">
		<h4>审核打款详细信息</h4>
		<table class="tb">
		<form action="">
			<input type="hidden" name="id" value="<?php  echo $info['id'];?>">
			<input type="hidden" name="shareid" value="<?php  echo $shareid;?>">
			<input type="hidden" name="op" value="display">
			<input type="hidden" name="opp" value="checked">
			<input type="hidden" name="act" value="module" />
			<input type="hidden" name="name" value="bj_qmxk" />
			<input type="hidden" name="do" value="commission" />
		  <input type="hidden" name="level" value="<?php  echo $level;?>"/>
			<tr>
				<th style="width:200px"><label>设置审核结算状态</label></th>
				<td style="text-align: left;">
					<label class="radio inline"><input type="radio" name="status" value="-1" <?php  if($info['status']==-1) { ?>checked<?php  } ?>>无效</label>
					<label class="radio inline" ><input type="radio" name="status" value="1" <?php  if($info['status']==1) { ?>checked<?php  } ?>>暂不处理</label>
					<label class="radio inline" ><input type="radio" name="status" value="2" <?php  if($info['status']==2) { ?>checked<?php  } ?>>打款</label>
				</td>
			</tr>
			<tr>
				<th style="width:200px"><label for="">申请人</label></th>
				<td>
					<?php  if($user['realname']!="") { ?> <?php  echo $user['realname'];?><?php  } else { ?>未完善<?php  } ?>
				</td>
			</tr>
			
					<tr>
				<th style="width:200px"><label for="">银行卡号</label></th>
				<td>
					<?php  if($bankcard['banktype']!="") { ?> <?php  echo $bankcard['banktype'];?><?php  } else { ?>未完善<?php  } ?>
				</td>
			</tr>
					<tr>
				<th style="width:200px"><label for="">银行名称</label></th>
				<td>
					<?php  if($bankcard['bankcard']!="") { ?> <?php  echo $bankcard['bankcard'];?><?php  } else { ?>未完善<?php  } ?>
				</td>
			</tr>
					<tr>
				<th style="width:200px"><label for="">支付宝</label></th>
				<td>
					<?php  if($bankcard['alipay']!="") { ?> <?php  echo $bankcard['alipay'];?><?php  } else { ?>未完善<?php  } ?>
				</td>
			</tr>
			<tr>
				<th style="width:200px"><label for="">手机号码</label></th>
				<td>
					<?php  if($user['mobile']!="") { ?> <?php  echo $user['mobile'];?><?php  } else { ?>未完善<?php  } ?>
				</td>
			</tr>
			<tr>
				<th><label for="">申请时间</label></th>
				<td>
					<?php  echo date('Y-m-d H:i:s', $info['applytime']);?>
				</td>
			</tr>
						<tr>
				<th style="width:200px"><label for="">订单编号</label></th>
				<td>
				 <a target="_blank" href="<?php  echo $this->createWebUrl('order', array('op' => 'detail', 'id' => $order['id']))?>"><?php  echo $order['ordersn'];?></a>
				</td>
			</tr>
			<tr>
				<th><label for="">商品名称</label></th>
				<td>
					<?php  echo $info['title'];?>
				</td>
			</tr>
			<tr>
				<th><label for="">商品价格</label></th>
				<td>
					<?php  echo $info['price'];?>
				</td>
			</tr>
			<tr>
				<th><label for="">购买数量</label></th>
				<td>
					<?php  echo $info['total'];?>
				</td>
			</tr>
			<tr>
				<th><label for="">订单级别</label></th>
				<td>
					<?php  echo $level;?>
				</td>
			</tr>
			<tr>
				<th><label for="">打款佣金</label></th>
				<td>
						<input type="hidden" value="<?php  echo $info['commission'];?>" readonly name="commission"/>
					<font color="red"><?php  echo $info['commission'];?> </font>
				</td>
			</tr>
			<tr>
				<th><label for="">备注</label></th>
				<td>
					<textarea name="content"><?php  echo $info['content'];?></textarea>
				</td>
			</tr>
			<tr>
				<th></th>
				<td>
					<a href="<?php  echo $this->createWebUrl('commission', array('op'=>'display'))?>"><input type="button" class="btn btn-primary span3" name="submit" value="返回" /></a>
					<input type="submit" class="btn btn-primary span3" name="submit" onclick="return confirm('确认操作吗？');" value="确定" />
				</td>
			</tr>
			</form>
		</table>
	</div>
</div>

<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>
