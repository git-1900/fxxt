<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<?php  include $this->template('common', TEMPLATE_INCLUDEPATH);?>

<link rel="stylesheet" href="./resource/script/kindeditor/themes/default/default.css" />
		<script charset="utf-8" src="./resource/script/kindeditor/kindeditor-min.js"></script>
		<script charset="utf-8" src="./resource/script/kindeditor/lang/zh_CN.js"></script>
<div class="main">
 
    <form action="" method="post" class="form-horizontal form" onsubmit="return check()">
		 <h4>分销参数设置</h4>
        <table class="tb">
            <tr>
                <th>当前资金池资金数：</th>
                <td>
                    <?php  echo $theone["cash_pool"];?> 元 &nbsp;    
                    <a href="<?php  echo $this->createWebUrl('fansmanager',array('op'=>'cash_log'));?>" class="btn btn-primary">查看资金池变更记录</a>
                </td>
            </tr>
            <tr>
                <th>预设分红：</th>
                <td>
                    <input type="text" name="default_dividend" class="span1" value="<?php  echo $theone['default_dividend'];?>" /> 元<span  class="help-inline">（如当天收益x抽取比例低于预设分红，则使用预设分红给代理分红）</span>
                </td>
            </tr>
            <tr>
                <th>分红抽取比例：</th>
                <td>
                    <input type="text" name="extract" class="span1" value="<?php  echo $theone['extract'];?>" /> %
                </td>
            </tr>
        </table>
                  <?php  if(is_array($cardtype)) { foreach($cardtype as $k => $p) { ?>
            <fieldset>
                <legend><?php  echo $p["card_name"];?>：</legend>
                <label for="price"  style="width: 400px">价&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;格&nbsp;：<span style="width: 30px" class="span1"></span><input type="text" id="price" name='card[<?php  echo $p["cardid"];?>][price]' class="span1" value="<?php  echo $p['price'];?>"/> 元</label>
                <label for="upper_lim" style="width: 400px">提&nbsp;&nbsp;佣&nbsp;&nbsp;上&nbsp;&nbsp;限&nbsp;：<span style="width: 30px" class="span1"></span><input type="text" id="upper_lim" name='card[<?php  echo $p["cardid"];?>][upper_lim]' class="span1" value="<?php  echo $p['upper_lim'];?>" /> 元</label>
                <label for="commission_ratio" style="width: 400px">兑换积分比例：<span style="width: 30px" class="span1"></span><input type="text" id="commission_ratio" name='card[<?php  echo $p["cardid"];?>][commission_ratio]' class="span1" value="<?php  echo $p['commission_ratio'];?>" /> %</label>
                <label for="use_years" style="width: 400px">使&nbsp;&nbsp;用&nbsp;&nbsp;年&nbsp;&nbsp;限&nbsp;：<span style="width: 30px" class="span1"></span><input type="text" id="use_years" name='card[<?php  echo $p["cardid"];?>][use_years]' class="span1" value="<?php  echo $p['use_years'];?>" /> 年&nbsp;<span style="color: grey">( 0代表没有限制 )</span></label>
                <label for="discount" style="width: 400px">消&nbsp;&nbsp;费&nbsp;&nbsp;折&nbsp;&nbsp;扣&nbsp;：<span style="width: 30px" class="span1"></span><input type="text" id="discount" name='card[<?php  echo $p["cardid"];?>][discount]' class="span1" value="<?php  echo $p['discount'];?>" /> 折</label>
                <label for="upper_lim2" style="width: 550px">预设每日分红：<span style="width: 30px" class="span1"></span><input type="text" id="upper_lim2" name='card[<?php  echo $p["cardid"];?>][upper_lim2]' class="span1" value="<?php  echo $p['upper_lim2'];?>" /> 元（当日无新会员加入时，按此分红返还给该类会员）</label>
            </fieldset>
            <?php  } } ?>
            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
            <input name="submit" type="submit" value="提交" class="btn btn-primary span3" />
    </form>
</div>
<script type="text/javascript">
    function check(){
        var col = 1;
        $('input[class="span1"]').each(function(){  
            if($(this).val()==''){
                alert("请填写完整");
                col = 0;
                $(this).css("border","1px solid red").focus();
            }else{
                $(this).css("border","");
            }
        });  
        if (col == 0) {
            return false;
        }
        return true;
    }
    KindEditor.ready(function(K) {
        var editor;
        if (editor) {
                editor.remove();
                editor = null;
        }
        editor = K.create('textarea[name="terms"]', {
                allowFileManager : true,
                uploadJson : "./index.php?act=attachment&do=upload",
                fileManagerJson : "./index.php?act=attachment&do=manager",
                newlineTag : 'br'
        });
    });

//kindeditor($('#terms'));

kindeditor($('#rule'));

</script>


<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>