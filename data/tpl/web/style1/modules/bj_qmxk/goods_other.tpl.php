<?php defined('IN_IA') or exit('Access Denied');?><table class="tb">
       <tr>
        <th><label for="">商品类型</label></th>
        <td>
            <label for="isshow3" class="radio inline"><input type="radio" name="type" value="1" id="isshow3" <?php  if(empty($item['type']) || $item['type'] == 1) { ?>checked="true"<?php  } ?> onclick="$('#product').show()" /> 实体商品</label>&nbsp;&nbsp;&nbsp;<label for="isshow4" class="radio inline"><input type="radio" name="type" value="2" id="isshow4"  <?php  if($item['type'] == 2) { ?>checked="true"<?php  } ?>  onclick="$('#product').hide()" /> 虚拟商品</label>
            <span class="help-block">虚拟商品，例如：优惠券，打折卡等，需要用户去店里消费使用的。实体商品，需要进行用户自提或是邮递的商品。</span>
        </td>
    </tr>
   
    
            
                 <tr>
                <th><label for="">排序</label></th>
                <td>
                    <input type="text" name="displayorder" class="span6" value="<?php  echo $item['displayorder'];?>" />
                </td>
            </tr>
</table>