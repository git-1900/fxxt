<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('common/header', TEMPLATE_INCLUDEPATH);?>
<?php  include $this->template('common', TEMPLATE_INCLUDEPATH);?>
<ul class="nav nav-tabs">
    <li <?php  if($operation == 'display' && $modules!='promotion') { ?> class="active" <?php  } ?>><a href="<?php  echo $this->createWebUrl('adv',array('op' =>'display'))?>">幻灯片</a></li>
    <li<?php  if($operation == 'post' && $modules!='promotion') { ?> class="active" <?php  } ?>><a href="<?php  echo $this->createWebUrl('adv',array('op' =>'post'))?>">添加幻灯片</a></li>

	  <li<?php  if($operation == 'display' &&  $modules!='adv') { ?> class="active" <?php  } ?>><a href="<?php  echo $this->createWebUrl('promotion',array('op' =>'display'))?>">促销活动管理</a></li>
	  <li<?php  if($operation == 'post' && $modules!='adv') { ?> class="active" <?php  } ?>><a href="<?php  echo $this->createWebUrl('promotion',array('op' =>'post'))?>">添加促销活动</a></li>

    <?php  if(!empty($adv['id']) && $operation== 'post') { ?> <li class="active"><a href="<?php  echo $this->createWebUrl('adv',array('op' =>'post','id'=>$adv['id']))?>">编辑物流方式</a></li> <?php  } ?>
<!--    <li><a href="<?php  echo $this->createWebUrl('template',array('op' =>'display'))?>">模板管理</a></li>-->
</ul>
<?php  if($operation == 'display') { ?>
<div class="main">
    <div style="padding:15px;">
        <table class="table table-hover">
            <thead class="navbar-inner">
                <tr>
                    <th style="width:30px;">ID</th>
                    <th>显示顺序</th>					
                    <th>标题</th>
                    <th>连接</th>
                    <th >操作</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($list)) { foreach($list as $adv) { ?>
                <tr>
                    <td><?php  echo $adv['id'];?></td>
                    <td><?php  echo $adv['displayorder'];?></td>
                    <td><?php  echo $adv['advname'];?></td>
                    <td><?php  echo $adv['link'];?></td>
                    <td style="text-align:left;"><a href="<?php  echo $this->createWebUrl('adv', array('op' => 'post', 'id' => $adv['id']))?>">修改</a> <a href="<?php  echo $this->createWebUrl('adv', array('op' => 'delete', 'id' => $adv['id']))?>">删除</a> </td>
                </tr>
                <?php  } } ?>
            </tbody>
        </table>
        <?php  echo $pager;?>
    </div>
</div>
<?php  } else if($operation == 'post') { ?>
<div class="main">
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" onsubmit='return formcheck()'>
        <input type="hidden" name="id" value="<?php  echo $adv['id'];?>" />
        <h4>幻灯片设置</h4>
        <table class="tb">
            <tr>
                <th><label for="">排序</label></th>
                <td>
                    <input type="text" name="displayorder" class="span6" value="<?php  echo $adv['displayorder'];?>" />
                </td>
            </tr>
         <!--   <tr>
                <th><span class='red'>*</span><label for="">幻灯片标题</label></th>
                <td>
                    <input type="text" name="advname" id='advname' class="span6" value="<?php  echo $adv['advname'];?>" />
                </td>
            </tr> -->
            <tr>
                <th>幻灯片图片</th>
                <td><?php  echo tpl_form_field_image('thumb',$adv['thumb']);?>
                </td>
            </tr>
           <tr>
                <th><span class='white'>*</span><label for="">幻灯片链接</label></th>
                <td>
                    <input type="text" name="link" id='link' class="span6" value="<?php  echo $adv['link'];?>" />
                </td>
            </tr>
                 <tr>
                <th><label for="">是否显示</label></th>
                <td>
                    <label for="enabled1" class="radio inline"><input type="radio" name="enabled" value="1" id="enabled1" <?php  if(empty($adv) || $adv['enabled'] == 1) { ?>checked="true"<?php  } ?> /> 是</label>
                    &nbsp;&nbsp;&nbsp;
                    <label for="enabled2" class="radio inline"><input type="radio" name="enabled" value="0" id="enabled2"  <?php  if(!empty($adv) && $adv['enabled'] == 0) { ?>checked="true"<?php  } ?> /> 否</label>
                    <span class="help-block"></span>
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <input name="submit" type="submit" value="提交" class="btn btn-primary span3">
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </td>
            </tr>
        </table>
    </form>
</div>
<!--
<script language='javascript'>
    function formcheck() {
        if ($("#advname").isEmpty()) {
            Tip.focus("advname", "请填写幻灯片名称!", "right");
            return false;
        }
       
        return true;
    }
    
</script>
-->
<?php  } ?>
<?php  include $this->template('common/footer', TEMPLATE_INCLUDEPATH);?>