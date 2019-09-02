<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<div class="main" style="overflow-x: scroll;">
		<div class="stat" style="width:1193px">
			<div class="stat-div">
				<div class="navbar navbar-static-top">
					<div class="navbar-inner">
						<span class="pull-right" style="color:red; padding:10px 10px 0 0;">总数：<?php  echo $total;?></span>
						<span class="brand">名单</span>
					</div>
				</div>
                            <div class="sub-item" id="table-list" style="width: 1151px">
					<h4 class="sub-title">报名人员</h4>

					<form action="" method="post" onsubmit="">
					<div class="sub-content">
						<table class="table table-hover">
							<thead class="navbar-inner">
								<tr>
									<th class="row-hover">姓名</th>
									<th class="row-hover">手机号码</th>
									<th class="row-hover">代理信息</th>
                                                                        <th class="row-hover">备注</th>
								</tr>
							</thead>
							<tbody>
								<?php  if(is_array($member)) { foreach($member as $v) { ?>
								<tr>
									<td style="text-align: center;">
										<?php  echo $v['username'];?>
									</td>
									<td style="text-align: center;">
										<?php  echo $v['tel'];?>
									</td>
									<td style="text-align: center;">
										<?php  if(!empty($v['card_name'])) { ?><?php  echo $v['card_name'];?><?php  } else { ?>非代理<?php  } ?>
                                                                                <?php  if($v['flag']==1&&$v['qm_status']==0) { ?>（已禁用）<?php  } ?>
									</td>
                                                                        <td style="text-align: center;">
										<?php  echo $v['remark'];?>
									</td>
								</tr>
								<?php  } } ?>
                                                                
							</tbody>
						</table>
					</div>
					</form>
				</div>
			</div> 
		</div>
    </div>
<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>