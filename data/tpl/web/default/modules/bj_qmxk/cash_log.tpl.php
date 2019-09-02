<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<div class="main" style='align:center'>
	<div class="form form-horizontal" style='width:80%;margin:0 auto;'>
		<h4 style='text-align:center;font-weight: bold;margin-right:60px;border: none'>资金池变更历史记录 &nbsp;
                <a href="<?php  echo $this->createWebUrl('fansmanager',array('op'=>'cash_log_detail'));?>" style='font-size:14px;text-decoration:underline;'>详细的变更记录</a>
                </h4>
                <table class="table table-responsive">
                    <?php  if(count($cash_log)>0) { ?>
                    <?php  if(is_array($cash_log)) { foreach($cash_log as $key => $val) { ?>
                    <tr>
                        <td>
                            <div>
                                <span><?php  echo $val['day'];?></span>
                                <?php  if($val['change_type']==1 || $val['change_type']==2) { ?>
                                <em style="color: #00CC66">增加  <?php  echo $val['sum_value'];?>积分</em>
                                <?php  } else { ?>
                                <em style="color: #FF0000">减少  <?php  echo $val['sum_value'];?>积分</em>
                                <?php  } ?>
                            </div>
                            <div style="width:950px">
                                <div  style="width:150px;margin-right:40px;text-align:right;">资金池变更原因：</div>
                                <div style="width:730px;">
                                    <?php  if($val['change_type']==1 || $val['change_type']==2) { ?>
                                    今日收盈<?php  echo $val['sum_value'];?>元。
                                    <?php  } else { ?>
                                    发给会员<?php  echo $val['sum_value'];?>元。
                                    <?php  } ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php  } } ?>
                    <?php  } else { ?>
                    <tr>
                        <td style='text-align: center;padding-top: 40px;'>
                            暂无资金池变更历史记录～
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
