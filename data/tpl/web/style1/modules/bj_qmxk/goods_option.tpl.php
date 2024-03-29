<?php defined('IN_IA') or exit('Access Denied');?><style type="text/css">
    .spectable td,.spectable th {border:1px solid #ccc; vertical-align: middle;text-align:center;};
    .spectable th { font-weight: bold;}
    .spectable  input { text-align: center;}
    .f {  border-color: #b94a48;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
	 -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
		  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);}
</style>
<table class="tb">
    <tr><td>
            <label class="checkbox inline">
                <input type="checkbox" id="hasoption" value="1" name="hasoption" <?php  if($item['hasoption']==1) { ?>checked<?php  } ?> />启用商品规格</label>

            <span class="help-block">启用商品规格后，商品的价格及库存以商品规格为准,库存设置为0则不显示,-1为不限制</span>
        </td></tr>
</table>
<div id='tboption' style='<?php  if($item['hasoption']!=1) { ?>display:none<?php  } ?>'>
    <div class="alert alert-info">
        1. 拖动规格可调整规格显示顺序, 更改规格及规格项后请点击下方的【刷新规格项目表】来更新数据。<br/>
        2. 每一种规格代表不同型号，例如颜色为一种规格，尺寸为一种规格，如果设置多规格，手机用户必须每一种规格都选择一个规格项，才能添加购物车或购买。
    </div>
 <a href="javascript:;" class='btn btn-primary' id='add-spec' onclick="addSpec()" style="margin-top:10px;margin-bottom:10px;"  title="添加规格"><i class='icon-plus'></i> 添加规格</a> 
        
    <div id='specs'>
        <?php  if(is_array($allspecs)) { foreach($allspecs as $spec) { ?>
        <?php  include $this->template('spec')?>
        <?php  } } ?>
    </div>

    <table class="tb">
        <tr><td>
                <h4>规格统计   <a href="javascript:;" onclick="calc()" title="刷新规格项目表" class="btn btn-primary"><i class="icon-refresh"></i> 刷新规格项目表</a></h4>            </td></tr>
    </table>       
    <div class="alert alert-new" style='width:95%;' id="options">
        <?php  echo $html;?>
    </div>

</div>

<script language="javascript">
            $(function(){
                
                $('#specs').sortable({
                    stop: function(){
                        window.optionchanged = true;
                    }
                });
                 $('.spec_item_items').sortable({handle:'.icon-move', stop: function(){
                        window.optionchanged = true;
                    }});
                
            $("#hasoption").click(function(){
            var obj = $(this);
                    if (obj.get(0).checked){
                       $("#tboption").show();
            }
            else{
            $("#tboption").hide();
            }
            });
            })

            function addSpec(){
            $("#add-spec").html("正在处理...").attr("disabled", "true").toggleClass("btn-primary");
                    var url = "<?php  echo create_url('site/module',array('do'=>'spec','name'=>'bj_qmxk'))?>";
                    $.ajax({
                    "url": url,
                            success:function(data){
                            $("#add-spec").html('<i class="icon-plus"></i> 添加规格').removeAttr("disabled").toggleClass("btn-primary"); ;
                                    $('#specs').append(data);
                                    var len = $(".add-specitem").length -1;
                                    $(".add-specitem:eq(" +len+ ")").focus();
                                    window.optionchanged = true;
                            }
                    });
            }
    function removeSpec(specid){
        if (confirm('确认要删除此规格?')){
             $("#spec_" + specid).remove();
            window.optionchanged = true;
        }
    }
    function addSpecItem(specid){
    $("#add-specitem-" + specid).html("正在处理...").attr("disabled", "true");
            var url = "<?php  echo create_url('site/module',array('do'=>'specitem','name'=>'bj_qmxk'))?>" + "&specid=" + specid;
            $.ajax({
            "url": url,
                    success:function(data){
                    $("#add-specitem-" + specid).html('<i class="icon-plus"></i> 添加规格项').removeAttr("disabled");
                            $('#spec_item_' + specid).append(data);
                            var len = $("#spec_" + specid + " .spec_item_title").length -1;
                            $("#spec_" + specid + " .spec_item_title:eq(" +len+ ")").focus();
                            window.optionchanged = true;
                    }
            });
    }
    function removeSpecItem(obj){
     $(obj).parent().parent().parent().remove();
 
    }
    function calc(){

window.optionchanged = false;
    var html = '<table  class="tb spectable" style="border:1px solid #ccc;"><thead><tr>';
    var specs = [];
    $(".spec_item").each(function(i){
      
         var _this = $(this);
 
         var spec = {
             id: _this.find(".spec_id").val(),
             title: _this.find(".spec_title").val()
         };
      
         var items = [];
          _this.find(".spec_item_item").each(function(){
               var __this = $(this);
                var item = {
                     id: __this.find(".spec_item_id").val(),
                     title: __this.find(".spec_item_title").val(),
                     show:  __this.find(".spec_item_show").get(0).checked?"1":"0"
                }
                items.push(item);
                
          });
      
          spec.items = items;
          specs.push(spec);
    });
    specs.sort(function(x,y){
        if (x.items.length > y.items.length)    
            return 1;  
         if (x.items.length < y.items.length)    
            return -1;  
    });
      var len = specs.length;
        var newlen = 1; //多少种组合
         var h = new Array(len); //显示表格二维数组  
         var rowspans = new Array(len); //每个列的rowspan
 
        for(var i=0;i<len;i++){
            //表头
            html+="<th>" + specs[i].title + "</th>";
            
            //计算多种组合
            var itemlen = specs[i].items.length;
            if(itemlen<=0) { itemlen = 1 };
              newlen*=itemlen;
              
            //初始化 二维数组
            h[i] = new Array(newlen);
            for(var j=0;j<newlen;j++){
                   h[i][j] = new Array();
            }    
            //计算rowspan
            var l  = specs[i].items.length;
            rowspans[i] = 1;
            for(j=i+1;j<len;j++){
                rowspans[i]*= specs[j].items.length;
            }
        
        }
 
       html += '<th><div class="input-append input-prepend"><span class="add-on">库存</span><input type="text" class="span1 option_stock_all"  VALUE=""/><span class="add-on"><a href="javascript:;" class="icon-hand-down" title="批量设置" onclick="setCol(\'option_stock\');"></a></span></div></th>';
       html += '<th><div class="input-append input-prepend"><span class="add-on">销售价格</span><input type="text" class="span1 option_marketprice_all"  VALUE=""/><span class="add-on"><a href="javascript:;" class="icon-hand-down" title="批量设置" onclick="setCol(\'option_marketprice\');"></a></span></div><br/></th>';
       html+='<th><div class="input-append input-prepend"><span class="add-on">市场价格</span><input type="text" class="span1 option_productprice_all"  VALUE=""/><span class="add-on"><a href="javascript:;" class="icon-hand-down" title="批量设置" onclick="setCol(\'option_productprice\');"></a></span></div></th>';
       html+='<th><div class="input-append input-prepend"><span class="add-on">成本价格</span><input type="text" class="span1 option_costprice_all"  VALUE=""/><span class="add-on"><a href="javascript:;" class="icon-hand-down" title="批量设置" onclick="setCol(\'option_costprice\');"></a></span></div></th>';
       html+='<th><div class="input-append input-prepend"><span class="add-on">重量(克)</span><input type="text" class="span1 option_weight_all"  VALUE=""/><span class="add-on"><a href="javascript:;" class="icon-hand-down" title="批量设置" onclick="setCol(\'option_weight\');"></a></span></div></th>';
       html+='</tr>';
   
       for(var m=0;m<len;m++){
            var k = 0,kid = 0,n=0;
                 for(var j=0;j<newlen;j++){
                       var rowspan = rowspans[m]; //9
                       if( j % rowspan==0){
                            h[m][j]={title: specs[m].items[kid].title, html: "<td rowspan='" +rowspan + "'>"+ specs[m].items[kid].title  +"</td>\r\n",id: specs[m].items[kid].id};
                         //   k++; if(k>specs[m].items.length-1) { k=0; }
                       }
                       else{
                           h[m][j]={title:specs[m].items[kid].title, html: "",id: specs[m].items[kid].id};    
                       }
                       n++;
                       if(n==rowspan){
                          kid++; if(kid>specs[m].items.length-1) { kid=0; }
                          n=0;
                       }
            }
       }

       var hh = "";
       for(var i=0;i<newlen;i++){
          hh+="<tr>";
          var ids = [];
          var titles = [];
          for(var j=0;j<len;j++){
              hh+=h[j][i].html; //每一行的每个规格项列
              ids.push( h[j][i].id);
              titles.push( h[j][i].title);
          }
          ids =  ids.join('_');
          titles= titles.join('+');
    
          var val ={ id : "",title:titles, stock : "",costprice : "",productprice : "",marketprice : "",weight:"" };
          if( $(".option_id_" + ids).length>0){
                 val ={
                     id : $(".option_id_" + ids+":eq(0)").val(),
                     title: titles,
                     stock : $(".option_stock_" + ids+":eq(0)").val(),
                     costprice : $(".option_costprice_" + ids+":eq(0)").val(),
                     productprice : $(".option_productprice_" + ids+":eq(0)").val(),
                     marketprice : $(".option_marketprice_" + ids +":eq(0)").val(),
                     weight : $(".option_weight_" + ids+":eq(0)").val()
                 }    
           }
           hh += '<td>'
           
           hh += '<input name="option_stock_' + ids +'[]"  type="text" class="span1 option_stock option_stock_' + ids +'" value="' +  (val.stock=='undefined'?'':val.stock )+'"/></td>';
           hh += '<input name="option_id_' + ids  +'[]"  type="hidden" class="span1 option_id option_id_' + ids +'" value="' +  (val.id=='undefined'?'':val.id )+'"/>';
           hh += '<input name="option_ids[]"  type="hidden" class="span1 option_ids option_ids_' + ids +'" value="' + ids +'"/>';
           hh += '<input name="option_title_' + ids +'[]"  type="hidden" class="span1 option_title option_title_' + ids +'" value="' +  (val.title=='undefined'?'':val.title )+'"/></td>';
           hh += '</td>';
           hh += '<td><input name="option_marketprice_' + ids  +'[]" type="text" class="span1 option_marketprice option_marketprice_' + ids +'" value="' +  (val.marketprice=='undefined'?'':val.marketprice )+'"/></td>';
           hh += '<td><input name="option_productprice_' + ids  +'[]" type="text" class="span1 option_productprice option_productprice_' + ids +'" " value="' +  (val.productprice=='undefined'?'':val.productprice )+'"/></td>';
           hh += '<td><input name="option_costprice_' +ids  +'[]" type="text" class="span1 option_costprice option_costprice_' + ids +'" " value="' +  (val.costprice=='undefined'?'':val.costprice )+'"/></td>';
           hh += '<td><input name="option_weight_' + ids +'[]" type="text" class="span1 option_weight option_weight_' + ids +'" " value="' +  (val.weight=='undefined'?'':val.weight )+'"/></td>';
           hh+="</tr>";
      }
     html+=hh;
     html+="</table>";
     $("#options").html(html);
}
  function setCol(cls){
      $("."+cls).val( $("."+cls+"_all").val());
  }
  function showItem(obj){
      var show = $(obj).get(0).checked?"1":"0";
      $(obj).next().val(show);
  }
function nofind(){
var img=event.srcElement;
img.src="./resource/image/module-nopic-small.jpg";
img.onerror=null; 
}
 
</script>