<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<ul class="nav nav-tabs">
 	<li ><a href="<?php  echo create_url('site/module', array('do' => 'charge', 'op' => 'list','name' => 'bj_qmxk','weid'=>$_W['weid']))?>">会员信息</a></li>	
 	<?php  if($_GPC['from_user']) { ?><li class="active"><a >会员信息修改</a></li><?php  } ?>
</ul>
    <div class="main">
	
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" >
			<h4>会员信息修改</h4>
			<table class="tb">
				<tr>
					<th style="text-align: right;"><label>真实姓名:</label></th>
					<td >
                                            &nbsp;&nbsp;
                                            <input type="text" name="realname"  value="<?php  echo $profile['realname'];?>" />
					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label>昵称:</label></th>
					<td >
                                            &nbsp;&nbsp;
                                            <input type="text" name="nickname" value="<?php  echo $profile['nickname'];?>" />
					</td>
				</tr>
				<tr>
					<th style="text-align: right;"><label>头像:</label></th>
					<td >
                                            &nbsp;&nbsp;
                                            <img src="<?php  echo $profile['avatar'];?>" style='height: 100px;width: 100px'/>
					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label>QQ号:</label></th>
					<td >
                                            &nbsp;&nbsp;
                                            <input type="text" name="qq" value="<?php  echo $profile['qq'];?>" />
					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label>手机号码:</label></th>
					<td >
                                            &nbsp;&nbsp;
                                            <input type="text" name="mobile" value="<?php  echo $profile['mobile'];?>" />
					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label>固定电话:</label></th>
					<td >
                                            &nbsp;&nbsp;
                                            <input type="text" name="telephone" value="<?php  echo $profile['telephone'];?>" />
					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label>身份证号:</label></th>
					<td >
                                            &nbsp;&nbsp;
                                            <input type="text" name="idcard" value="<?php  echo $profile['idcard'];?>" />
					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label>是否订阅:</label></th>
					<td >
                                            &nbsp;&nbsp;
                                            <?php  if($profile['follow']==1) { ?>已订阅<?php  } else { ?>未订阅<?php  } ?>
					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label>会员级别:</label></th>
					<td >
                                            &nbsp;&nbsp;
                                            <input type="radio" name="vip" value="0" <?php  if($profile['vip']==0 ) { ?> checked<?php  } ?>>普通会员&nbsp;                                         
                                            <input type="radio" name="vip" value="1" <?php  if($profile['vip']==1 ) { ?> checked<?php  } ?>>银卡会员&nbsp;                                      
                                            <input type="radio" name="vip" value="2" <?php  if($profile['vip']==2 ) { ?> checked<?php  } ?>>金卡会员&nbsp;                                     
                                            <input type="radio" name="vip" value="3" <?php  if($profile['vip']==3 ) { ?> checked<?php  } ?>>钻石卡会员
					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label>加入时间:</label></th>
					<td >
                                            &nbsp;&nbsp;<?php  echo date('Y-m-d H:i:s', $profile['createtime']);?>
					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label>积分:</label></th>
					<td >
                                            &nbsp;&nbsp;<?php  echo $profile['credit1'];?>分
					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label>余额:</label></th>
					<td >
                                            &nbsp;&nbsp;<?php  echo $profile2['credit2'];?>元
					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label>性别:</label></th>
					<td >
                                            &nbsp;&nbsp;
                                            <input type="radio" name="gender" value="0" <?php  if($profile['vip']==0 ) { ?> checked<?php  } ?>>保密&nbsp;                                        
                                            <input type="radio" name="gender" value="1" <?php  if($profile['vip']==1 ) { ?> checked<?php  } ?>>男&nbsp; 
                                            <input type="radio" name="gender" value="2" <?php  if($profile['vip']==1 ) { ?> checked<?php  } ?>>女  
					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label>出生日期:</label></th>
					<td >
                                            &nbsp;&nbsp;
                                            <input type="text" name="birthyear" class="span1" value="<?php  echo $profile['birthyear'];?>" /> 年  
                                            <input type="text" name="birthmonth" class="span1" value="<?php  echo $profile['birthyear'];?>" /> 月
                                            <input type="text" name="birthday" class="span1" value="<?php  echo $profile['birthyear'];?>" /> 日

					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label>学号:</label></th>
					<td >
                                            &nbsp;&nbsp;
                                            <input type="text" name="studentid"  value="<?php  echo $profile['studentid'];?>" />
					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label>班级:</label></th>
					<td >
                                            &nbsp;&nbsp;
                                            <input type="text" name="grade"  value="<?php  echo $profile['grade'];?>" />
					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label>星座:</label></th>
					<td >
                                            &nbsp;&nbsp;
                                            <input type="text" name="constellation"  value="<?php  echo $profile['constellation'];?>" />
					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label>生肖:</label></th>
					<td >
                                            &nbsp;&nbsp;
                                            <input type="text" name="zodiac"  value="<?php  echo $profile['zodiac'];?>" />
					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label>邮寄地址:</label></th>
					<td >
                                            &nbsp;&nbsp;
                                            <input type="text" name="address"  value="<?php  echo $profile['address'];?>" />
					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label>邮编:</label></th>
					<td >
                                            &nbsp;&nbsp;
                                            <input type="text" name="zipcode"  value="<?php  echo $profile['zipcode'];?>" />
					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label>国籍:</label></th>
					<td >
                                            &nbsp;&nbsp;
                                            <input type="text" name="nationality"  value="<?php  echo $profile['nationality'];?>" />
					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label>居住地:</label></th>
					<td >
                                            &nbsp;&nbsp;
                                            （省份）<input type="text" name="resideprovince"  value="<?php  echo $profile['resideprovince'];?>" />   
                                            （城市）<input type="text" name="residecity"  value="<?php  echo $profile['residecity'];?>" />
                                            （行政区/县）<input type="text" name="residedist"  value="<?php  echo $profile['residedist'];?>" />
					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label>毕业学校:</label></th>
					<td >
                                            &nbsp;&nbsp;
                                            <input type="text" name="graduateschool"  value="<?php  echo $profile['graduateschool'];?>" />
					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label>学历:</label></th>
					<td >
                                            &nbsp;&nbsp;
                                            <input type="text" name="education"  value="<?php  echo $profile['education'];?>" />
					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label>公司:</label></th>
					<td >
                                            &nbsp;&nbsp;
                                            <input type="text" name="company"  value="<?php  echo $profile['company'];?>" />
					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label>职业:</label></th>
					<td >
                                            &nbsp;&nbsp;
                                            <input type="text" name="occupation"  value="<?php  echo $profile['occupation'];?>" />
					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label>职位:</label></th>
					<td >
                                            &nbsp;&nbsp;
                                            <input type="text" name="position"  value="<?php  echo $profile['position'];?>" />
					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label>年收入:</label></th>
					<td >
                                            &nbsp;&nbsp;
                                            <input type="text" name="revenue"  value="<?php  echo $profile['revenue'];?>" />
					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label>情感状态:</label></th>
					<td >
                                            &nbsp;&nbsp;
                                            <input type="text" name="affectivestatus"  value="<?php  echo $profile['affectivestatus'];?>" />
					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label>交友目的:</label></th>
					<td >
                                            &nbsp;&nbsp;
                                            <input type="text" name="lookingfor"  value="<?php  echo $profile['lookingfor'];?>" />
					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label>血型:</label></th>
					<td >
                                            &nbsp;&nbsp;
                                            <input type="text" name="bloodtype"  value="<?php  echo $profile['bloodtype'];?>" />
					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label>身高:</label></th>
					<td >
                                            &nbsp;&nbsp;
                                            <input type="text" name="height"  value="<?php  echo $profile['height'];?>" />
					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label>体重:</label></th>
					<td >
                                            &nbsp;&nbsp;
                                            <input type="text" name="weight"  value="<?php  echo $profile['weight'];?>" />
					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label>支付宝帐号:</label></th>
					<td >
                                            &nbsp;&nbsp;
                                            <input type="text" name="alipay"  value="<?php  echo $profile['alipay'];?>" />
					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label>MSN:</label></th>
					<td >
                                            &nbsp;&nbsp;
                                            <input type="text" name="msn"  value="<?php  echo $profile['msn'];?>" />
					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label>电子邮箱:</label></th>
					<td >
                                            &nbsp;&nbsp;
                                            <input type="text" name="email"  value="<?php  echo $profile['email'];?>" />
					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label>阿里旺旺:</label></th>
					<td >
                                            &nbsp;&nbsp;
                                            <input type="text" name="taobao"  value="<?php  echo $profile['taobao'];?>" />
					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label>主页:</label></th>
					<td >
                                            &nbsp;&nbsp;
                                            <input type="text" name="site"  value="<?php  echo $profile['site'];?>" />
					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label>自我介绍:</label></th>
					<td >
                                            &nbsp;&nbsp;
                                            <textarea  name="bio" ><?php  echo $profile['bio'];?></textarea>
					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label>兴趣爱好:</label></th>
					<td >
                                            &nbsp;&nbsp;
                                            <textarea  name="interest" ><?php  echo $profile['interest'];?></textarea>
					</td>
				</tr>
                                <tr>
					<th style="text-align: right;"><label> </label></th>
					<td>
                                            &nbsp;&nbsp;
						<input type="hidden"  name="from_user" value="<?php  echo $_GPC['from_user'];?>" />
						<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                                                <input name="submit" type="submit" value="提 交" onclick="window.location.href ='#'" class="btn btn-primary span2">
					</td>
				</tr>
			</table>
		</form>
		
    </div>


<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>