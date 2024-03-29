<?php defined('IN_IA') or exit('Access Denied');?><div class="alert alert-block alert-new">
	<a class="close" data-dismiss="alert">×</a>
	<h4 class="alert-heading">添加处理接口</h4>
	<table>
		<tr>
			<th>接口类型：</th>
			<td>
				<label for="radio_remote" class="radio inline" onclick="$('#remote').show();$('#location').hide();$('#radio_remote').attr('checked', 'checked');"> <input type="radio" name="type" id="radio_remote"   value="1" <?php  if(strexists($row['apiurl'], 'http://')) { ?> checked="checked"<?php  } ?> /> 远程地址</label>
				<label for="radio_local" class="radio inline" onclick="$('#remote').hide();$('#location').show();$('#radio_local').attr('checked', 'checked');"><input type="radio" name="type" id="radio_local"  value="0" <?php  if(!strexists($row['apiurl'], 'http://')) { ?> checked="checked"<?php  } ?> /> 本地文件</label>
			</td>
		</tr>
		<tbody id="remote" <?php  if(!strexists($row['apiurl'], 'http://')) { ?>style="display:none;"<?php  } ?>>
		<tr>
			<th>远程地址：</th>
			<td>
				<input type="text" id="" class="span7" placeholder="" name="apiurl" value="<?php  echo $row['apiurl'];?>">
				<div class="help-block" style="margin-top:10px;">
					<ol style="margin-top:10px;">
						<li>使用远程地址接口，你可以兼容其他的微信公众平台管理工具。</li>
						<li>你应该填写其他平台提供给你保存至公众平台的URL和Token</li>
						<li>添加此模块的规则后，只针对于单个规则定义有效，如果需要全部路由给接口处理，则修改该模块的优先级顺序。</li>
						<?php  if(IMS_FAMILY != 'x') { ?><li>具体请<a href="http://www.we7.cc/docs/#api" target="_blank">查看“自定义接口回复”文档</a></li><?php  } ?>
					</ol>
				</div>
			</td>
		</tr>
		<tr>
			<th style="color:red">Token</th>
			<td>
				<input type="text" name="wetoken" class="span6" value="<?php  echo $row['token'];?>" />
				<div class="help-block">与目标平台接入设置值一致，必须为英文或者数字，长度为3到32个字符.</div>
			</td>
		</tr>
		</tbody>
		<tbody id="location" <?php  if(strexists($row['apiurl'], 'http://')) { ?> style="display:none;"<?php  } ?>>
		<tr>
			<th>文件列表：</th>
			<td>
				<select name="apilocal"><option value="0">请选择本地文件</option><?php  if(is_array($apis)) { foreach($apis as $file) { ?><option <?php  if($row['apilocal'] == $file) { ?> selected="selected"<?php  } ?> value="<?php  echo $file;?>"><?php  echo $file;?></option><?php  } } ?></select>
				<div class="help-block" style="margin-top:10px;">
					<ol style="margin-top:10px;">
						<li>使用本地文件扩展你可以快速的扩展系统功能。</li>
						<li>添加此模块的规则后，只针对于单个规则定义有效，如果需要全部路由给接口处理，则修改该模块的优先级顺序。</li>
						<li>本地文件存放在模块文件夹内（/source/modules/userapi/api）下。</li>
						<?php  if(IMS_FAMILY != 'x') { ?><li>具体请<a href="http://www.we7.cc/docs/#api" target="_blank">查看“自定义接口回复”文档</a></li><?php  } ?>
					</ol>
				</div>
			</td>
		</tr>
		</tbody>

		<tr>
			<th>默认回复文字</th>
			<td>
				<input type="text" id="" class="span7" placeholder="" name="default-text" value="<?php  echo $row['default_text'];?>">
				<div class="help-block">当接口无回复时，则返回用户此处设置的文字信息，优先级高于“默认回复URL”</div>
			</td>
		</tr>
		<tr>
			<th>缓存时间</th>
			<td><input type="text" id="" class="span7" placeholder="" name="cachetime" value="<?php  echo $row['cachetime'];?>">
				<div class="help-block">接口返回数据将缓存在系统中的时限，默认为0不缓存。</div></td>
		</tr>
	</table>
</div>
