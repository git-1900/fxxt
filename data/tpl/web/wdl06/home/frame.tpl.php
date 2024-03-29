<?php defined('IN_IA') or exit('Access Denied');?><?php  include template('common/sysheader', TEMPLATE_INCLUDEPATH);?>
<div class="navbar navbar-default" id="navbar">
<script type="text/javascript">
    try{ace.settings.check('navbar' , 'fixed')}catch(e){}
</script>

<div class="navbar-container" id="navbar-container">
<div class="navbar-header pull-left">
    <a href="#" class="navbar-brand">
        <small>
            <i class="icon-leaf"></i>
            <span id='accountname'><?php  echo $_W['account']['name'];?></span>
        </small>
    </a><!-- /.brand -->
</div><!-- /.navbar-header -->

<div class="navbar-header pull-right" role="navigation">
<ul class="nav ace-nav">


<li class="Larger">
    <a class="dropdown-toggle" href="./?do=profile">
        <i class="icon-user"></i>
        <span>当前公众号</span>
    </a>
</li>

<!--<li class="Larger">
    <a class="dropdown-toggle" href="./?do=global">
        <i class="icon-gear"></i>
        <span>系统设置</span>
    </a>
</li>-->
<li class="Larger">
    <a data-toggle="dropdown" class="dropdown-toggle" href="./?do=global">
        <i class="icon-wrench"></i>
        <span>常用</span>
    </a>
    <ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
        <!--<li>
            <a href="test.php" target="main">
                <div class="clearfix">
                    <span class="pull-left">
                        <i class="btn btn-xs no-hover btn-info "></i>
                        调试工具
                    </span>
                </div>
            </a>
        </li>-->
        <li>
            <a href="<?php  echo create_url('setting/updatecache')?>" target="main">
                <div class="clearfix">
                    <span class="pull-left">
                        <i class="btn btn-xs no-hover btn-info "></i>
                        更新缓存
                    </span>
                </div>
            </a>
        </li>
    </ul>
</li>
<!--
<li class="Larger">
    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
        <i class="icon-exchange"></i>
        <span id="current-account"><?php  if($_W['account']) { ?><?php  echo $_W['account']['name'];?><?php  } else { ?>请切换公众号<?php  } ?></span>
    </a>

    <ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
        <li class="dropdown-header">
            <i class="icon-ok"></i>
            请选择公众号
        </li>
        <?php  if(is_array($wechats)) { foreach($wechats as $account) { ?>
        <li>
            <a href="<?php  echo create_url('account/switch', array('id' => $account['weid']))?>"  onclick="document.title='<?php  echo $account['name'];?>';document.getElementById('accountname').innerHTML='<?php  echo $account['name'];?>';return ajaxopen(this.href, function(s) {switchHandler(s)})">
                <div class="clearfix">
                    <span class="pull-left">
                        <i class="btn btn-xs no-hover btn-info "></i>
                        <?php  echo $account['name'];?>
                    </span>
                </div>
            </a>
        </li>
        <?php  } } ?>
        <li>
        <a href="account.php?act=display&" target="main">
            查看所有 &nbsp;
            <i class="icon-arrow-right"></i>
        </a>
        </li>
    </ul>

</li>
-->
<li class="light-blue">
    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
        <img class="nav-user-photo" src="<?php  echo $_W['attachurl'];?>/headimg_<?php  echo $_W['weid'];?>.jpg?weid=<?php  echo $_W['account']['weid'];?>" alt="Jason's Photo">
								<span class="user-info">
									<small>欢迎光临,</small>
									<?php  echo $_W['username'];?>
								</span>

        <i class="icon-caret-down"></i>
    </a>

    <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">

        <li>
            <a href="<?php  echo create_url('member/logout')?>">
                <i class="icon-off"></i>
                退出
            </a>
        </li>
    </ul>
</li>
</ul><!-- /.ace-nav -->
</div><!-- /.navbar-header -->
</div><!-- /.container -->
</div>
<!-- 头部 end -->

<div class="main-container" id="main-container">
    <script type="text/javascript">
        try{ace.settings.check('main-container' , 'fixed')}catch(e){}
    </script>

    <div class="main-container-inner">
        <a class="menu-toggler" id="menu-toggler" href="#">
            <span class="menu-text"></span>
        </a>
        <div class="sidebar" id="sidebar">
            <script type="text/javascript">
                try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
            </script>
            <div class="sidebar-shortcuts" id="sidebar-shortcuts">
<!--                <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                   <a class="btn btn-small btn-success" href="./?do=profile" title="当前公众号">
						<i class="icon-pencil"></i>
					</a>
					<a class="btn btn-small btn-info" href="./?do=global" title="全局设置">
						<i class="icon-th"></i>
					</a>
					<a class="btn btn-small btn-warning" href="test.php" title="调试工具" target="main">
						<i class="icon-zoom-out"></i>
					</a>
					<a class="btn btn-small btn-danger" href="<?php  echo create_url('setting/updatecache')?>" target="main"  title="清除缓存">
						<i class="icon-trash"></i>
					</a>
                </div>-->

                <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                    <span class="btn btn-success"></span>

                    <span class="btn btn-info"></span>

                    <span class="btn btn-warning"></span>

                    <span class="btn btn-danger"></span>
                </div>
            </div><!-- #sidebar-shortcuts -->

          <ul class="nav nav-list">
                <?php  if(is_array($mset)) { foreach($mset as $k => $g) { ?>
                <?php 
						switch ($k) {
							case 'basic':
							  $snav_icon = 'icon-star';
							  break;
							case 'business':
							  $snav_icon = 'icon-briefcase';
							  break;
							case 'customer':
							  $snav_icon = 'icon-sitemap';
							  break;
							case 'activity':
							  $snav_icon = 'icon-gift';
							  break;
							case 'services':
							  $snav_icon = 'icon-cog';
							  break;
							default:
							  $snav_icon = 'icon-folder-open';
						}
						?>
                <li>
                    <!-- 导航第一级 -->
                    <a href="#" class="dropdown-toggle">
                        <i class="<?php  echo $snav_icon;?>"></i>
                        <span class="menu-text"> <?php  echo $g['title'];?></span>

                        <b class="arrow icon-angle-down"></b>
                    </a>
                    <?php  if($g['menus']) { ?>

                    <ul class="submenu">
                        <?php  if(is_array($g['menus'])) { foreach($g['menus'] as $menu) { ?>
                        <!-- 子菜单 第二级-->
                        <li>

                            <?php  if(!empty($menu['items'])) { ?>
                                <a href="#" class="dropdown-toggle">
                                    <i class="icon-double-angle-right"></i>
                                    <?php  echo $menu['title'];?>
                                    <b class="arrow icon-angle-down"></b>
                                </a>
                            <?php  } else { ?>
                                <?php  if(is_array($menu['title'])) { ?>
                                <a href="<?php  echo $menu['title']['1'];?>" target="main">
                                    <i class="icon-double-angle-right"></i>
                                    <?php  echo $menu['title']['0'];?>
                                </a>

                                <?php  } else { ?>
                                    <a href="<?php  echo $menu['title']['1'];?>" target="main">
                                        <i class="icon-double-angle-right"></i>
                                        <?php  echo $menu['title'];?>
                                    </a>
                                <?php  } ?>
                            <?php  } ?>

                            <?php  if(!empty($menu['items'])) { ?>
                            <ul class="submenu">
                            <?php  if(is_array($menu['items'])) { foreach($menu['items'] as $item) { ?>
                                <li>
                                    <?php  if(!empty($item['childItems'])) { ?>
                                    <a href="#" class="dropdown-toggle">
                                        <i class="icon-double-angle-right"></i>
                                        <?php  echo $item['0'];?>
                                        <b class="arrow icon-angle-down"></b>
                                    </a>
                                    <?php  } else { ?>
                                    <a href="<?php  echo $item['1'];?>" target="main">
                                        <i class="icon-double-angle-right"></i>
                                        <?php  echo $item['0'];?>
                                    </a>
                                    <?php  } ?>
                                    <!-- 第四级 -->
                                    <?php  if(!empty($item['childItems'])) { ?>
                                    <?php   echo $item['childItems']['2']; ?>
                                    <ul class="submenu">
                                        <li>
                                            <a href="<?php  echo $item['childItems']['1'];?>" target="main">
                                                <?php  echo $item['childItems']['0'];?>添加
                                            </a>
                                        </li>
                                    </ul>


                                    <?php  } ?>

                                </li>
                            <?php  } } ?>
                            </ul>
                            <?php  } ?>
                        </li>
                        <?php  } } ?>
                    </ul>
                    <?php  } ?>
                </li>
                <?php  } } ?>

            </ul>
            <div class="sidebar-collapse" id="sidebar-collapse">
                <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
            </div>

            <script type="text/javascript">
                try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
            </script>
        </div>

        <div class="main-content">
            <div class="breadcrumbs" id="breadcrumbs">
                <script type="text/javascript">
                    try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
                </script>

                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home home-icon"></i>
                        <a href="#">首页</a>
                    </li>
                    <li class="active">控制台</li>
                </ul><!-- .breadcrumb -->

                <div class="nav-search" id="nav-search">

                </div><!-- #nav-search -->
            </div>

            <div class="page-content" style="padding: 1px 13px 24px;">


                <div class="row">
                    <div class="col-xs-12" style="min-height: 1000px;padding-left:0px;">
                    <iframe width="100%" scrolling="yes" height="100%" frameborder="0" style="min-width:800px;min-height: 1000px; overflow:visible; height:100%;" name="main" id="main" src="<?php  echo $iframe;?>"></iframe>

                    </div>
                    </div>
            </div>
        </div>


    </div><!-- /.main-container-inner -->

</div>

<script type="text/javascript">
    
    if (<?php  echo $_W['weid'];?> == 0) {
        window.location.href='account.php?act=switch&id=35';
    }
        

    jQuery(function($) {
        $('.easy-pie-chart.percentage').each(function(){
            var $box = $(this).closest('.infobox');
            var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
            var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
            var size = parseInt($(this).data('size')) || 50;
            $(this).easyPieChart({
                barColor: barColor,
                trackColor: trackColor,
                scaleColor: false,
                lineCap: 'butt',
                lineWidth: parseInt(size/10),
                animate: /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase()) ? false : 1000,
                size: size
            });
        })

        $('.sparkline').each(function(){
            var $box = $(this).closest('.infobox');
            var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
            $(this).sparkline('html', {tagValuesAttribute:'data-values', type: 'bar', barColor: barColor , chartRangeMin:$(this).data('min') || 0} );
        });




        var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'150px'});
        var data = [
            { label: "social networks",  data: 38.7, color: "#68BC31"},
            { label: "search engines",  data: 24.5, color: "#2091CF"},
            { label: "ad campaigns",  data: 8.2, color: "#AF4E96"},
            { label: "direct traffic",  data: 18.6, color: "#DA5430"},
            { label: "other",  data: 10, color: "#FEE074"}
        ]
        function drawPieChart(placeholder, data, position) {
            $.plot(placeholder, data, {
                series: {
                    pie: {
                        show: true,
                        tilt:0.8,
                        highlight: {
                            opacity: 0.25
                        },
                        stroke: {
                            color: '#fff',
                            width: 2
                        },
                        startAngle: 2
                    }
                },
                legend: {
                    show: true,
                    position: position || "ne",
                    labelBoxBorderColor: null,
                    margin:[-30,15]
                }
                ,
                grid: {
                    hoverable: true,
                    clickable: true
                }
            })
        }
        drawPieChart(placeholder, data);

        /**
         we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
         so that's not needed actually.
         */
        placeholder.data('chart', data);
        placeholder.data('draw', drawPieChart);



        var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
        var previousPoint = null;

        placeholder.on('plothover', function (event, pos, item) {
            if(item) {
                if (previousPoint != item.seriesIndex) {
                    previousPoint = item.seriesIndex;
                    var tip = item.series['label'] + " : " + item.series['percent']+'%';
                    $tooltip.show().children(0).text(tip);
                }
                $tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
            } else {
                $tooltip.hide();
                previousPoint = null;
            }

        });






        var d1 = [];
        for (var i = 0; i < Math.PI * 2; i += 0.5) {
            d1.push([i, Math.sin(i)]);
        }

        var d2 = [];
        for (var i = 0; i < Math.PI * 2; i += 0.5) {
            d2.push([i, Math.cos(i)]);
        }

        var d3 = [];
        for (var i = 0; i < Math.PI * 2; i += 0.2) {
            d3.push([i, Math.tan(i)]);
        }


        var sales_charts = $('#sales-charts').css({'width':'100%' , 'height':'220px'});
        $.plot("#sales-charts", [
            { label: "Domains", data: d1 },
            { label: "Hosting", data: d2 },
            { label: "Services", data: d3 }
        ], {
            hoverable: true,
            shadowSize: 0,
            series: {
                lines: { show: true },
                points: { show: true }
            },
            xaxis: {
                tickLength: 0
            },
            yaxis: {
                ticks: 10,
                min: -2,
                max: 2,
                tickDecimals: 3
            },
            grid: {
                backgroundColor: { colors: [ "#fff", "#fff" ] },
                borderWidth: 1,
                borderColor:'#555'
            }
        });


        $('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
        function tooltip_placement(context, source) {
            var $source = $(source);
            var $parent = $source.closest('.tab-content')
            var off1 = $parent.offset();
            var w1 = $parent.width();

            var off2 = $source.offset();
            var w2 = $source.width();

            if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
            return 'left';
        }


        $('.dialogs,.comments').slimScroll({
            height: '300px'
        });


        //Android's default browser somehow is confused when tapping on label which will lead to dragging the task
        //so disable dragging when clicking on label
        var agent = navigator.userAgent.toLowerCase();
        if("ontouchstart" in document && /applewebkit/.test(agent) && /android/.test(agent))
            $('#tasks').on('touchstart', function(e){
                var li = $(e.target).closest('#tasks li');
                if(li.length == 0)return;
                var label = li.find('label.inline').get(0);
                if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
            });

        $('#tasks').sortable({
                    opacity:0.8,
                    revert:true,
                    forceHelperSize:true,
                    placeholder: 'draggable-placeholder',
                    forcePlaceholderSize:true,
                    tolerance:'pointer',
                    stop: function( event, ui ) {//just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
                        $(ui.item).css('z-index', 'auto');
                    }
                }
        );
        $('#tasks').disableSelection();
        $('#tasks input:checkbox').removeAttr('checked').on('click', function(){
            if(this.checked) $(this).closest('li').addClass('selected');
            else $(this).closest('li').removeClass('selected');
        });


    })
</script>

<script type="text/javascript">
/*! Copyright (c) 2013 Brandon Aaron (http://brandon.aaron.sh)
 * Licensed under the MIT License (LICENSE.txt).
 *
 * Version: 3.1.9
 *
 * Requires: jQuery 1.2.2+
 */

(function (factory) {
    if ( typeof define === 'function' && define.amd ) {
        // AMD. Register as an anonymous module.
        define(['jquery'], factory);
    } else if (typeof exports === 'object') {
        // Node/CommonJS style for Browserify
        module.exports = factory;
    } else {
        // Browser globals
        factory(jQuery);
    }
}(function ($) {

    var toFix  = ['wheel', 'mousewheel', 'DOMMouseScroll', 'MozMousePixelScroll'],
        toBind = ( 'onwheel' in document || document.documentMode >= 9 ) ?
                    ['wheel'] : ['mousewheel', 'DomMouseScroll', 'MozMousePixelScroll'],
        slice  = Array.prototype.slice,
        nullLowestDeltaTimeout, lowestDelta;

    if ( $.event.fixHooks ) {
        for ( var i = toFix.length; i; ) {
            $.event.fixHooks[ toFix[--i] ] = $.event.mouseHooks;
        }
    }

    var special = $.event.special.mousewheel = {
        version: '3.1.9',

        setup: function() {
            if ( this.addEventListener ) {
                for ( var i = toBind.length; i; ) {
                    this.addEventListener( toBind[--i], handler, false );
                }
            } else {
                this.onmousewheel = handler;
            }
            // Store the line height and page height for this particular element
            $.data(this, 'mousewheel-line-height', special.getLineHeight(this));
            $.data(this, 'mousewheel-page-height', special.getPageHeight(this));
        },

        teardown: function() {
            if ( this.removeEventListener ) {
                for ( var i = toBind.length; i; ) {
                    this.removeEventListener( toBind[--i], handler, false );
                }
            } else {
                this.onmousewheel = null;
            }
        },

        getLineHeight: function(elem) {
            return parseInt($(elem)['offsetParent' in $.fn ? 'offsetParent' : 'parent']().css('fontSize'), 10);
        },

        getPageHeight: function(elem) {
            return $(elem).height();
        },

        settings: {
            adjustOldDeltas: true
        }
    };

    $.fn.extend({
        mousewheel: function(fn) {
            return fn ? this.bind('mousewheel', fn) : this.trigger('mousewheel');
        },

        unmousewheel: function(fn) {
            return this.unbind('mousewheel', fn);
        }
    });


    function handler(event) {
        var orgEvent   = event || window.event,
            args       = slice.call(arguments, 1),
            delta      = 0,
            deltaX     = 0,
            deltaY     = 0,
            absDelta   = 0;
        event = $.event.fix(orgEvent);
        event.type = 'mousewheel';

        // Old school scrollwheel delta
        if ( 'detail'      in orgEvent ) { deltaY = orgEvent.detail * -1;      }
        if ( 'wheelDelta'  in orgEvent ) { deltaY = orgEvent.wheelDelta;       }
        if ( 'wheelDeltaY' in orgEvent ) { deltaY = orgEvent.wheelDeltaY;      }
        if ( 'wheelDeltaX' in orgEvent ) { deltaX = orgEvent.wheelDeltaX * -1; }

        // Firefox < 17 horizontal scrolling related to DOMMouseScroll event
        if ( 'axis' in orgEvent && orgEvent.axis === orgEvent.HORIZONTAL_AXIS ) {
            deltaX = deltaY * -1;
            deltaY = 0;
        }

        // Set delta to be deltaY or deltaX if deltaY is 0 for backwards compatabilitiy
        delta = deltaY === 0 ? deltaX : deltaY;

        // New school wheel delta (wheel event)
        if ( 'deltaY' in orgEvent ) {
            deltaY = orgEvent.deltaY * -1;
            delta  = deltaY;
        }
        if ( 'deltaX' in orgEvent ) {
            deltaX = orgEvent.deltaX;
            if ( deltaY === 0 ) { delta  = deltaX * -1; }
        }

        // No change actually happened, no reason to go any further
        if ( deltaY === 0 && deltaX === 0 ) { return; }

        // Need to convert lines and pages to pixels if we aren't already in pixels
        // There are three delta modes:
        //   * deltaMode 0 is by pixels, nothing to do
        //   * deltaMode 1 is by lines
        //   * deltaMode 2 is by pages
        if ( orgEvent.deltaMode === 1 ) {
            var lineHeight = $.data(this, 'mousewheel-line-height');
            delta  *= lineHeight;
            deltaY *= lineHeight;
            deltaX *= lineHeight;
        } else if ( orgEvent.deltaMode === 2 ) {
            var pageHeight = $.data(this, 'mousewheel-page-height');
            delta  *= pageHeight;
            deltaY *= pageHeight;
            deltaX *= pageHeight;
        }

        // Store lowest absolute delta to normalize the delta values
        absDelta = Math.max( Math.abs(deltaY), Math.abs(deltaX) );

        if ( !lowestDelta || absDelta < lowestDelta ) {
            lowestDelta = absDelta;

            // Adjust older deltas if necessary
            if ( shouldAdjustOldDeltas(orgEvent, absDelta) ) {
                lowestDelta /= 40;
            }
        }

        // Adjust older deltas if necessary
        if ( shouldAdjustOldDeltas(orgEvent, absDelta) ) {
            // Divide all the things by 40!
            delta  /= 40;
            deltaX /= 40;
            deltaY /= 40;
        }

        // Get a whole, normalized value for the deltas
        delta  = Math[ delta  >= 1 ? 'floor' : 'ceil' ](delta  / lowestDelta);
        deltaX = Math[ deltaX >= 1 ? 'floor' : 'ceil' ](deltaX / lowestDelta);
        deltaY = Math[ deltaY >= 1 ? 'floor' : 'ceil' ](deltaY / lowestDelta);

        // Add information to the event object
        event.deltaX = deltaX;
        event.deltaY = deltaY;
        event.deltaFactor = lowestDelta;
        // Go ahead and set deltaMode to 0 since we converted to pixels
        // Although this is a little odd since we overwrite the deltaX/Y
        // properties with normalized deltas.
        event.deltaMode = 0;

        // Add event and delta to the front of the arguments
        args.unshift(event, delta, deltaX, deltaY);

        // Clearout lowestDelta after sometime to better
        // handle multiple device types that give different
        // a different lowestDelta
        // Ex: trackpad = 3 and mouse wheel = 120
        if (nullLowestDeltaTimeout) { clearTimeout(nullLowestDeltaTimeout); }
        nullLowestDeltaTimeout = setTimeout(nullLowestDelta, 200);

        return ($.event.dispatch || $.event.handle).apply(this, args);
    }

    function nullLowestDelta() {
        lowestDelta = null;
    }

    function shouldAdjustOldDeltas(orgEvent, absDelta) {
        // If this is an older event and the delta is divisable by 120,
        // then we are assuming that the browser is treating this as an
        // older mouse wheel event and that we should divide the deltas
        // by 40 to try and get a more usable deltaFactor.
        // Side note, this actually impacts the reported scroll distance
        // in older browsers and can cause scrolling to be slower than native.
        // Turn this off by setting $.event.special.mousewheel.settings.adjustOldDeltas to false.
        return special.settings.adjustOldDeltas && orgEvent.type === 'mousewheel' && absDelta % 120 === 0;
    }

}));
</script>
<script type="text/javascript">
function max(a) {
	var b = a[0];
	for(var i=1;i<a.length;i++){ if(b<a[i])b=a[i]; }
	return b;
}
function currentMenuItem(a) {
	window.frames['main'].location.href= a;
}
function scrollButton() {
	if($(".sidebar-nav").height() > $(".content-main").height()) {
		$(".scroll-button").show();
	} else {
		if($(".sidebar-nav").position().top == 0) $(".scroll-button").hide();
	}
}
function switchHandler(s) {
	var mainurl = window.frames['main'].location;
	if (window.frames['main'].location.href.indexOf('global') > -1) {
		window.top.location.href = '?do=profile';
	}
	window.frames['main'].location = mainurl;
	$('#current-account').html(s);
}
function strlen(str) {
		var n = 0;
		for(i=0;i<str.length;i++){
			var leg=str.charCodeAt(i);
			n+=1;
		}
		return n;
}
$(document).ready(function() {
	//顶部子导航
	$(".hnav").delegate(".hnav-parent", "mouseover", function(){
		var $this = this;
		if ($(this).attr('id') == 'wechatpanel') {
			if ($(this).attr('loading') == '1'){
				return false;
			}
			position();
			if (cookie.get('wechatloaded') == '1') {
				return true;
			}
			$($this).find(".hnav-child").html('<li><a>加载中</a></li>');
			$(this).attr('loading', '1');
			ajaxopen('<?php  echo create_url('member/wechat')?>', function(s){
				var obj = $($this).find(".hnav-child");
				var html = '';
				for (i in s) {
					html += '<li><a href="account.php?act=switch&id='+s[i]['weid']+'" onclick="return ajaxopen(this.href, function(s) {main.document.location.reload();$(\'#current-account\').html(s)})">'+s[i]['name']+'</a></li>';
				}
				obj.html(html);
				$('#wechatpanel').attr('loading', '0');
			});
		} else {
			position();
		}
		function position() {
			var tmp = new Array();
			$($this).find(".hnav-child").show();
			$($this).find(".hnav-child li").each(function(i) {
				tmp[i] = strlen($(this).find("a").html());
			});
			$($this).find(".hnav-child li a").css("width", max(tmp)*18);
			$($this).find(".hnav-child").css("left", $($this).offset().left);
		}
		return false;
	});
	$(".hnav").delegate(".hnav-parent", "mouseout", function(){
		$(".hnav-child").hide();
	});
	//左侧导航
	$(".sidebar-nav").delegate(".snav-header", "click", function(){
		var a = $(this).hasClass("open");
		$(".sidebar-nav .snav-header").removeClass("open");
		$(".sidebar-nav .snav-list").hide();
		if(a) {
			$(this).removeClass("open");
			$(this).parent().find(".snav-list").each(function(i) {
				$(this).hide();
			});
		} else {
			$(this).addClass("open");
			$(this).parent().find(".snav-list").each(function(i) {
				$(this).show();
			});
		}
		scrollButton();
		return false;
	});
	$(".sidebar-nav .snav").each(function() {
		if($(this).find(".snav-header").hasClass("open")) {
			$(this).find(".snav-list").each(function() {
				$(this).toggle();
			});
		}
		$(this).find(".snav-list").each(function() {
			if($(this).hasClass("current")) {
				$(this).parent().find(".snav-header").toggleClass("open");
				$(this).parent().find(".snav-list").each(function() {
					$(this).toggle();
				});
			}
		});
		$(this).find(".snav-list a,.snav-header-list a").click(function() {
			$(".snav-list,.snav-header-list").removeClass("current");
			$(this).parent().addClass("current");
			currentMenuItem($(this).attr("href"));
			return false;
		});
	});
});
$(function() {
	//调整框架宽高 兼容ie8
	$(".content-main, .content-main table td").height($(window).height()-40);
	$("#main").width($(window).width()-200);
	//右侧菜单上下控制按钮
	var postion = 0,top = 0;
	$(".scroll-button .scroll-button-up").click(function() {
		postion = $(".sidebar-nav").position().top;
		if(postion > 0 || postion==0) {
			top = 0;
		} else {
			top = postion+$(".content-main").height()-50;
			if(top > 0) top =0;
		}
		$(".sidebar-nav").css({'position' : 'absolute', 'top' : top});
	});
	$(".scroll-button .scroll-button-down").click(function() {
		postion = $(".sidebar-nav").position().top;
		if(postion < 0 || postion==0) {
			top = postion-$(".content-main").height()+50;
			if(top< -($(".sidebar-nav").height()-$(".content-main").height()+50)) top = -($(".sidebar-nav").height()-$(".content-main").height()+50);
		} else {
			top =0;
		}
		$(".sidebar-nav").css({'position' : 'absolute', 'top' : top});
	});
	$.getScript('http%3A%2F%2Fs13.cnzz.com%2Fstat.php%3Fid%3D1998411%26web_id%3D1998411');
	$.get('index.php?act=announcement', function(s){
		$('body').append(s);
		if(cookie.get("we7_tips") == "0") {
			$("#we7_tips").hide();
		}
	});
	var mouseScroll = function(e, ui){
		console.dir(e);
		var step = parseInt(e.deltaY);
		if(step > 0) {
			postion = $(".sidebar-nav").position().top;
			if(postion > 0 || postion==0) {
				top = 0;
			} else {
				top = postion+121*step;
				if(top > 0) top = 0;
			}

			$(".sidebar-nav").css({'position' : 'absolute', 'top' : top});
		} else {
			postion = $(".sidebar-nav").position().top;
			if(postion < 0 || postion==0) {
				top = postion+121*step;
				if(top< -($(".sidebar-nav").height()-$(".content-main").height()+50)) top = -($(".sidebar-nav").height()-$(".content-main").height()+50);
			} else {
				top =0;
			}
			$(".sidebar-nav").css({'position' : 'absolute', 'top' : top});
		}
	};
	$('.sidebar-nav').parent().mousewheel(mouseScroll);
});
$(window).resize(function(){
	//调整框架宽高 兼容ie8
	$(".content-main, .content-main table td").height($(window).height()-40);
	$("#main").width($(window).width()-200);
});
</script>
