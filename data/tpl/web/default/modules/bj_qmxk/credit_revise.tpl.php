<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<div class="main">
	<div class="form form-horizontal"  style='width:80%;margin:0 auto'>
		<h4>积分信息</h4>
                <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" onsubmit='return check()'>
		<table class="tb">
			<tr>
				<th style="width:200px"><label for="aa">姓名</label></th>
				<td>
                                    <?php  echo $user['realname'];?>
				</td>
			</tr>
                        <tr>
				<th style="width:200px"><label for="">身份</label></th>
				<td>
                                    <?php  echo $user['card_name'];?>
				</td>
			</tr>
			<tr>
				<th style="width:200px"><label for="">手机号码</label></th>
				<td>
                                   <?php  echo $user['mobile'];?>
				</td>
			</tr>
                        <tr>
				<th><label for="">当前积分</label></th>
				<td>
                                    <?php  echo $user['credit2'];?>
                                    </br></br>
                                    <input type="button" class="btn btn-primary span2" data-pragram='1'  value="+加积分"/>  
                                    </br></br>
                                    <input type="button" class="btn btn-primary span2" data-pragram='0' value="-减积分"/>
				</td>
			</tr>
			<tr>
				<th><label for="">备注</label></th>
				<td>
                                    <textarea name='content' rows="10" cols="60" style="width:auto;"><?php  echo $user['content'];?></textarea>
				</td>
			</tr>
			<tr>
				<th></th>
				<td>
                                    <input type="hidden" name='op'  value="credit_revise"/>    
                                    <input type="hidden" name='from_user'  value="<?php  echo $user['from_user'];?>"/>      
                                    <input type="hidden" name='change_way'  value=""/>
                                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                                    <a href='javascript:history.back(-1)' class="btn btn-default" style='width: 15%'>返回</a>&nbsp;&nbsp;&nbsp;
                                    <input type="submit"  name="submit" class="btn btn-primary "  style='width: 20%' value="保存修改"/>
				</td>
			</tr>
		</table>
                </form>
	</div>
</div>

<script type="text/javascript">
    function check(){
        var change_value = $("input[name='change_value']").val();      
        var content = $("textarea[name='content']").val();
        if ( $("input[name='change_way']").val() == '' || change_value=="") {
            alert("您没有做任何积分修改");
            return false;
        }
        if (content == "") {
            alert("必须填写备注信息");
            $("textarea[name='content']").focus();
            return false;
        }
        return true;
    }
    $(document).on('click','.span2',function(){
        $("input[name='change_way']").val($(this).attr("data-pragram"));
        $("#rev").remove();
        $(this).after("<input type='text' name='change_value' style='margin-left:10px' id='rev' value=''>");
    });

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
