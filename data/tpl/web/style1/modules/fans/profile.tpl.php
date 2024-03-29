<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<style>
.field label{float:left;margin:0 !important; width:140px;}
/*重定义bootstrap样式*/
select, textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input{width:100%; margin-bottom:0; box-sizing:border-box; -webkit-box-sizing:border-box; -moz-box-sizing:border-box;}
input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input{height:30px;}
.input-append, .input-prepend{width:100%; margin-bottom:0;}
select{padding:0 5px; line-height:28px; -webkit-appearance:button;}
.checkbox.inline{margin-top:0;}
.checkbox.inline + .checkbox.inline {margin-left:0;}
.checkbox input[type="checkbox"]{filter:alpha(opacity:0); opacity:0;}
.file{position:relative;}
.file input[type="file"]{position:absolute; top:0; left:0; width:100%; filter:alpha(opacity:0); opacity:0;}
.file button{width:100%; text-align:left;}
.tb{width:500px;}
</style>
<ul class="nav nav-tabs">
	<li class="active"><a href="<?php  echo $this->createWebUrl('profile', array('from_user' => $_GPC['from_user']));?>">编辑粉丝资料</a></li>
	<li><a href="<?php  echo $this->createWebUrl('display');?>">粉丝列表</a></li>
	<li><a href="<?php  echo $this->createWebUrl('asyn');?>">获取粉丝信息</a></li>
</ul>
<div class="main">
<form action="" class="form-horizontal form" method="post" enctype="multipart/form-data">
<input type="hidden" name="from_user" value="<?php  echo $from_user;?>" />
	<h4>基本资料</h4>
	<table class="tb">
		<tr>
			<th><label for="">头像</label></th>
			<td>
				<?php  echo tpl_fans_form('avatar');?>
			</td>
		</tr>
		<tr>
			<th><label for="">用户名</label></th>
			<td><input type="text" name="" value="<?php  echo $from_user;?>" readonly="readonly"></td>
		</tr>
		<tr>
			<th><label for="">昵称</label></th>
			<td><?php  echo tpl_fans_form('nickname',$profile['nickname'] );?></td>
		</tr>
		<tr>
			<th><label for="">真实姓名</label></th>
			<td><?php  echo tpl_fans_form('realname',$profile['realname'] );?></td>
		</tr>
		<tr>
			<th><label for="">性别</label></th>
			<td><?php  echo tpl_fans_form('gender',$profile['gender']);?></td>
		</tr>
		<tr>
			<th><label for="">生日</label></th>
			<td>
				<?php  echo tpl_fans_form('birth',array('birthyear' => $profile['birthyear'], 'birthmonth' => $profile['birghmonth'], 'birthday' => $profile['birthday']));?>
			</td>
		</tr>
		<tr>
			<th><label for="">地区</label></th>
			<td>
				<?php  echo tpl_fans_form('reside',array('resideprovince' => $profile['resideprovince'], 'residecity' => $profile['residecity'], 'residedist' => $profile['residedist']));?>
			</td>
		</tr>
		<tr>
			<th><label for="">详细地址</label></th>
			<td><?php  echo tpl_fans_form('address',$profile['address']);?></td>
		</tr>
		<tr>
			<th><label for="">手机</label></th>
			<td><?php  echo tpl_fans_form('mobile',$profile['mobile']);?></td>
		</tr>
		<tr>
			<th><label for="">QQ</label></th>
			<td><?php  echo tpl_fans_form('qq',$profile['qq']);?></td>
		</tr>
		<tr>
			<th><label for="">Email</label></th>
			<td><?php  echo tpl_fans_form('email',$profile['email']);?></td>
		</tr>
	</table>
	<h4>联系方式</h4>
	<table class="tb">
		<tr>
			<th><label for="">固定电话</label></th>
			<td><?php  echo tpl_fans_form('telephone',$profile['telephone']);?></td>
		</tr>
		<tr>
			<th><label for="">MSN</label></th>
			<td><?php  echo tpl_fans_form('msn',$profile['msn']);?></td>
		</tr>
		<tr>
			<th><label for="">阿里旺旺</label></th>
			<td><?php  echo tpl_fans_form('taobao',$profile['taobao']);?></td>
		</tr>
		<tr>
			<th><label for="">支付宝帐号</label></th>
			<td><?php  echo tpl_fans_form('alipay',$profile['alipay']);?></td>
		</tr>
	</table>
	<h4>教育情况</h4>
	<table class="tb">
		<tr>
			<th><label for="">学号</label></th>
			<td><?php  echo tpl_fans_form('studentid',$profile['studentid']);?></td>
		</tr>
		<tr>
			<th><label for="">班级</label></th>
			<td><?php  echo tpl_fans_form('grade',$profile['grade']);?></td>
		</tr>
		<tr>
			<th><label for="">毕业学校</label></th>
			<td><?php  echo tpl_fans_form('graduateschool',$profile['graduateschool']);?></td>
		</tr>
		<tr>
			<th><label for="">学历</label></th>
			<td>
				<?php  echo tpl_fans_form('education',$profile['education']);?>
			</td>
		</tr>
	</table>
	<h4>工作情况</h4>
	<table class="tb">
		<tr>
			<th><label for="">公司</label></th>
			<td><?php  echo tpl_fans_form('company',$profile['company']);?></td>
		</tr>
		<tr>
			<th><label for="">职业</label></th>
			<td><?php  echo tpl_fans_form('occupation',$profile['occupation']);?></td>
		</tr>
		<tr>
			<th><label for="">职位</label></th>
			<td><?php  echo tpl_fans_form('position',$profile['position']);?></td>
		</tr>
		<tr>
			<th><label for="">年收入</label></th>
			<td><?php  echo tpl_fans_form('revenue',$profile['revenue']);?></td>
		</tr>
	</table>
	<h4>个人情况</h4>
	<table class="tb">
		<tr>
			<th><label for="">星座</label></th>
			<td>
				<?php  echo tpl_fans_form('constellation',$profile['constellation']);?>
			</td>
		</tr>
		<tr>
			<th><label for="">生肖</label></th>
			<td>
				<?php  echo tpl_fans_form('zodiac',$profile['zodiac']);?>
			</td>
		</tr>
		<tr>
			<th><label for="">国籍</label></th>
			<td><?php  echo tpl_fans_form('nationality',$profile['nationality']);?></td>
		</tr>
		<tr>
			<th><label for="">身高</label></th>
			<td><?php  echo tpl_fans_form('height',$profile['height']);?></td>
		</tr>
		<tr>
			<th><label for="">体重</label></th>
			<td><?php  echo tpl_fans_form('weight',$profile['weight']);?></td>
		</tr>
		<tr>
			<th><label for="">血型</label></th>
			<td>
			<?php  echo tpl_fans_form('bloodtype',$profile['bloodtype']);?>
			</td>
		</tr>
		<tr>
			<th><label for="">身份证号</label></th>
			<td><?php  echo tpl_fans_form('idcard',$profile['idcard']);?></td>
		</tr>
		<tr>
			<th><label for="">邮编</label></th>
			<td><?php  echo tpl_fans_form('zipcode',$profile['zipcode']);?></td>
		</tr>
		<tr>
			<th><label for="">个人主页</label></th>
			<td><?php  echo tpl_fans_form('site',$profile['site']);?></td>
		</tr>
		<tr>
			<th><label for="">情感状态</label></th>
			<td><?php  echo tpl_fans_form('affectivestatus',$profile['affectivestatus']);?></td>
		</tr>
		<tr>
			<th><label for="">交友目的</label></th>
			<td><?php  echo tpl_fans_form('lookingfor',$profile['lookingfor']);?></td>
		</tr>
		<tr>
			<th><label for="">自我介绍</label></th>
			<td><?php  echo tpl_fans_form('bio',$profile['bio']);?></td>
		</tr>
		<tr>
			<th><label for="">兴趣爱好</label></th>
			<td><?php  echo tpl_fans_form('interest',$profile['interest']);?></td>
		</tr>
		<tr>
			<th></th>
			<td>
				<button type="submit" class="btn btn-primary span3" name="submit" value="提交">提交</button>
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
			</td>
		</tr>
	</table>
</form>
</div>
<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>
