<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<style>
    .arrow{
	display:inline-block;
	background:url("../style/new/icon-ps.png") ;
	width:6px;
	height:11px;
	}
</style>
<div class="main" style='align:center'>
	<div class="form form-horizontal" style='width:80%;margin:0 auto'>
		<h4 style='text-align:center;font-weight: bold'>积分变更明细</h4>
		<table class="tb" style="margin-top:40px;font-size: 16px;">
                        <tr style="margin-top:160px">
                            <th style="width:200px;">姓名：</th>
				<td>
					<?php  echo $user['realname'];?>
				</td>
			</tr>
                        <tr style="padding-bottom:60px">
				<th style="width:200px">当前积分：</th>
				<td>
					<?php  echo $user['credit2'];?> 积分
				</td>
			</tr>
		</table>
                <table class="table table-responsive">
                    <?php  if(count($credit_detail)>0) { ?>
                    <?php  if(is_array($credit_detail)) { foreach($credit_detail as $key => $val) { ?>
                    <tr>
                        <td>
                            <div>
                                <span><?php  echo date('Y-m-d H:i:s',$val['create_time'])?></span>
                                <?php  if($val['change_way']==1) { ?>
                                <em style="color: #00CC66">增加  <?php  echo $val['change_value'];?>积分</em>
                                <?php  } else { ?>
                                <em style="color: #FF0000">减少  <?php  echo $val['change_value'];?>积分</em>
                                <?php  } ?>
                                
                            </div>
                            <div style="width:950px">
                                <div  style="width:150px;margin-right:40px;text-align:right;">积分变更理由：</div>
                                <div style="width:730px">
                                    <?php  if(intval($val['change_reason'])==0) { ?>
                                    新会员加入，获得分佣积分
                                    <?php  } else if(intval($val['change_reason'])==1) { ?>
                                    兑换两个会员，获得分享积分
                                    <?php  } else { ?>
                                    修改了积分，其原因为：<?php  echo $val['remark'];?>
                                    <?php  } ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php  } } ?>
                    <?php  } else { ?>
                    <tr>
                        <td style='text-align: center;padding-top: 40px'>
                            暂无积分明细～
                        </td>
                    </tr>
                    <?php  } ?>
		</table>
                
	</div>
</div>
<style>
    td div{
        line-height:35px;
    }
    td div span{
        width:150px;
        margin-right: 40px;
        text-align:right;
        display:inline-block;
    }
    td div div{
        float: left;
    }
</style>
<link type="text/css" rel="stylesheet" href="./resource/style/base.css" />
<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>
