<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<div class="main" style='align:center'>
	<div class="form form-horizontal" style='width:80%;margin:0 auto;'>
		<h4 style='text-align:center;font-weight: bold;margin-right:60px;border:none'>资金池详细变更记录</h4>
                <table class="table table-responsive">
                    <?php  if(count($cash_detail)>0) { ?>
                    <?php  if(is_array($cash_detail)) { foreach($cash_detail as $key => $val) { ?>
                    <tr>
                        <td>
                            <div>
                                <span><?php  echo date('Y-m-d H:i:s',$val['create_time'])?></span>
                                <?php  if($val['change_type']==1 || $val['change_type']==2) { ?>
                                <em style="color: #00CC66">增加  <?php  echo $val['change_value'];?>积分</em>
                                <?php  } else if($val['change_type']==3 || $val['change_type']==4) { ?>
                                <em style="color: #FF0000">减少  <?php  echo $val['change_value'];?>积分</em>
                                <?php  } else if($val['change_type']==5) { ?>
                                <?php  if($val['change_value']<0) { ?><em style="color: #00CC66">增加  <?php  echo abs($val['change_value'])?>积分</em><?php  } else { ?><em style="color: #FF0000">减少  <?php  echo $val['change_value'];?>积分</em><?php  } ?>
                                <?php  } ?>
                            </div>
                            <div style="width:950px">
                                <div  style="width:150px;margin-right:40px;text-align:right;">资金池变更原因：</div>
                                <div style="width:730px;">
                                    <?php  if(intval($val['change_type'])==1) { ?>
                                    <strong><?php  echo $val['realname'];?></strong> 办理了<?php  echo $val['card_name'];?>会员
                                    <?php  } else if(intval($val['change_type'])==2) { ?>
                                    <strong><?php  echo $val['realname'];?></strong> 升级为<?php  echo $val['card_name'];?>会员
                                    <?php  } else if(intval($val['change_type'])==3) { ?>
                                    分佣给会员
                                    <?php  } else if(intval($val['change_type'])==4) { ?>
                                    <strong><?php  echo $val['realname'];?></strong> 兑换了2个有效会员
                                    <?php  } else if(intval($val['change_type'])==5) { ?>
                                        <?php  if($val['change_value']<0) { ?>预计分红积比分实际分红积分多<?php  echo abs($val['change_value'])?>积分<?php  } else { ?>预计分红积比分实际分红积分少<?php  echo $val['change_value'];?>积分<?php  } ?>
                                    <?php  } ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php  } } ?>
                    <?php  } else { ?>
                    <tr>
                        <td style='text-align: center;padding-top: 40px;'>
                            暂无资金池详细变更记录～
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
        width:15%;
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
