<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<ul class="nav nav-tabs">
 	<li><a href="<?php  echo $this->createWebUrl('commission', array('op'=>'display'))?>">佣金审核提现操作</a></li>
		<li><a href="<?php  echo $this->createWebUrl('commission', array('op'=>'applyed'))?>">已结算订单</a></li>
	
	<li  class="active"><a href="<?php  echo create_url('site/module', array('do' => 'zhifu', 'op' => 'list','name' => 'bj_qmxk','weid'=>$_W['weid']))?>">代理提现报表</a></li>	
 	<li><a href="<?php  echo $this->createWebUrl('commission', array('op'=>'invalid'))?>">审核无效</a></li>

</ul>
    <div class="main">
		<div class="stat">
				<form >
				<input type="hidden" name="act" value="module" />
				<input type="hidden" name="name" value="bj_qmxk" />
				<input type="hidden" name="do" value="zhifu" />
				<input type="hidden" name="op" value="list" />
				

				<table class="table sub-search">
				<table class="table sub-search">
					<tbody>
						
							<th style="width:80px;text-align: right;">姓名</th>
							<td>
								<input type="text"  name="realname" /> <input type="submit" name="submit" value="搜索" class="btn btn-primary">
							</td>
						</tr>
					
						
					</tbody>
					</table>
						
		</form>
			<div class="stat-div">
				
				<div class="sub-item" id="table-list">
					<h4 class="sub-title" style="float:right;color:red;">总数：<?php  echo $total;?> <a href="">刷新</a> </h4>
					<h4 class="sub-title">会员列表</h4>

					<div class="sub-content">
						<table class="table table-hover">
							<thead class="navbar-inner">
								<tr>
									<th class="row-hover">姓名</th>
									<th class="row-hover">联系方式</th>
									<th class="row-hover">银行卡</th>
									<th class="row-hover">支付宝</th>
									<th class="row-hover">微支付</th>
									<th class="row-hover">已打款</th>
									<!--<th class="row-hover">未打款</th>-->
									<th class="row-hover">操作</th>
								</tr>
							</thead>
							<tbody>
							
								<?php  if(is_array($list)) { foreach($list as $v) { ?>
									
								<tr>
									<td style="text-align: center;">
										<?php  echo $v['realname'];?>
									</td>
									<td style="text-align: center;">
										<?php  echo $v['mobile'];?>
									</td>
										<td style="text-align: center;">
											<?php  if(!empty($v['banktype'])) { ?>
										银行名称:<?php  echo $v['banktype'];?><br/><?php  } ?>		<?php  if(!empty($v['bankcard'])) { ?>银行卡号:<?php  echo $v['bankcard'];?><?php  } ?>
									</td>
										<td style="text-align: center;">
										<?php  echo $v['alipay'];?>
									</td>
										<td style="text-align: center;">
										<?php  echo $v['wxhao'];?>
									</td>
									<td style="text-align: center;">
										<?php  echo $v['zhifu'];?>
									</td>
							<!--		<td style="text-align:center;">
									<?php  echo round($v['commission'] - $v['zhifu'],2)?>
									</td>-->
									<td style="text-align: center;">

										<a href="<?php  echo create_url('site/module', array('do' => 'zhifu', 'op' => 'post','name' => 'bj_qmxk','weid'=>$_W['weid'],'from_user'=>$v['from_user']))?>" class="btn btn-primary">明细</a>
									</td>
								</tr>
									
								<?php  } } ?>
							</tbody>
						</table>
					</div>
					
					<?php  echo $pager;?>
				</div>
			</div>
		</div>
    </div>


<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>