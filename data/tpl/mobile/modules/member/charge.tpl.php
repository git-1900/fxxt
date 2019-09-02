<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('header', TEMPLATE_INCLUDEPATH);?>
<?php  include $this->template('member', TEMPLATE_INCLUDEPATH);?>
<div class="profile">
	<div class="tabbable">
		<form action="" method="post" onsubmit="return validate();">
			<div class="tab-content" style="padding:0 10px; margin-top:10px;">
				<table class="form-table">
					<tr>
						<th><label for="">充值金额</label></th>
						<td>
							<input type="text" name="fee" value="100" />
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center"><input type="hidden" name="token" value="<?php  echo $_W['token'];?>" /><input type="submit" class="btn btn-large submit" value="提交" name="submit"></td>
					</tr>
				</table>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">
	function validate() {
		var fee = parseFloat($.trim($(':text[name="fee"]').val()));
		if(isNaN(fee) || fee < 0) {
			alert('充值金额不正确');
			return false;
		}
		return true;
	}
</script>
<?php  include $this->template('footer', TEMPLATE_INCLUDEPATH);?>
