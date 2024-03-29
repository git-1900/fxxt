<?php defined('IN_IA') or exit('Access Denied');?><script type="text/javascript" src="./resource/script/jquery.jplayer.min.js"></script>
<link type="text/css" rel="stylesheet" href="./resource/script/kindeditor/themes/default/default.css" />
<style>
</style>
<div id="append-list" class="reply-list-common list">
<?php  if(!empty($list)) { ?>
	<?php  if(is_array($list)) { foreach($list as $item) { ?>
	<div class="item" id="music-item-<?php  echo $item['id'];?>">
		<?php  include $this->template('item');?>
	</div>
	<?php  } } ?>
<?php  } ?>
</div>
<a href="javascript:;" onclick="musicHandler.buildAddForm();" class="add-reply-button"><i class="icon-plus"></i> 添加语音</a>
<script type="text/html" id="music-item-html">
<?php  unset($item); include $this->template('item');?>
</script>
<script type="text/javascript">
<!--
	var musicHandler = {
		'doAdd' : function(itemid) {
			var parent = $('#' + itemid);
			if ($('#item-title', parent).val() == '') {
				message('请输入标题！', '', 'error');
				return false;
			}
			if ($('#item-url', parent).val() == '') {
				message('请输入音频地址或是上传音频文件！', '', 'error');
				return false;
			}

			$('#show #title', parent).html($('#item-title', parent).val());
			$('#show', parent).css('display', 'block');
			$('#form', parent).css('display', 'none');
			this.buildMusicContent();
			<?php  if(empty($rid)) { ?>this.buildAddForm('music-item-html', $('#append-list'));<?php  } ?>
		},
		'doEditItem' : function(itemid) {
			this.buildMusicContent();
		},
		'buildMusicContent' : function() { //编辑其他信息时，把本条信息下的数据赋值给播放器
			$('#append-list .item').each(function() {
				var parent = $(this);
				$('#show #title', parent).html($('#item-title', parent).val());
				$('.music_button', parent).attr('music_url', $('#item-url', parent).val());
			});
		},
		'buildAddForm' : function() {
			var obj = buildAddForm('music-item-html', $('#append-list'));
			var itemid = obj.attr('id').split('-')[2];
			obj.find('.jp').attr('id', 'jp-'+itemid); //区分每条信息的音乐播放器
			this.kindeditorUploadBtn(obj.find('#music-attach-btn')[0]);
		},
		'music_off_all' : function() { //关闭所有音乐
			$("#append-list #music_off").each(function() {
				$(this).find(".music_button i").removeClass("icon-stop").addClass("icon-play");
				$(this).find(".music_button").attr("music_switch", "1");
			});
		},
		'kindeditorUploadBtn' : function(obj) {
			if (typeof KindEditor == 'undefined') {
				$.getScript('./resource/script/kindeditor/kindeditor-min.js', initUploader);
			} else {
				initUploader();
			}
			function initUploader() {
				var uploadbutton = KindEditor.uploadbutton({
					button : obj,
					fieldName : 'attachFile',
					url : '<?php  echo create_url('site/module/uploadmusic', array('name' => 'music'))?>',
					width : 100,
					afterUpload : function(data) {
						if (data.error === 0) {
							$(uploadbutton.div.parent().parent().parent().parent().parent()[0]).find('#item-url').val(data.filename);
						} else {
							message('上传失败，错误信息：'+data.message, '', 'error');
						}
						$(uploadbutton.div).removeClass("up_loading");
					},
					afterError : function(str) {
						message('上传失败，错误信息：'+str, '', 'error');
					}
				});
				uploadbutton.fileBox.change(function(e) {
					$(uploadbutton.div).addClass("up_loading");
					uploadbutton.submit();
				});
			}
		}
	};
	<?php  if(empty($rid)) { ?>
	$(function(){
		musicHandler.buildAddForm();
	});
	<?php  } ?>
	$(function(){
		//music_button
		$("#append-list").delegate(".music_button", "click", function(){
			var music_switch = $(this).attr("music_switch");
			var jp = $("#"+$(this).parent("#music_off").find(".jp:first").attr("id"));
			if($(this).attr("music_url").indexOf("http://") == -1) {
				var _setMedia = {mp3: '<?php  echo $_W['attachurl'];?>'+$(this).attr("music_url")};
			} else {
				var _setMedia = {mp3: $(this).attr("music_url")};
			}
			//初始化
			jp.jPlayer({
				ready: function(event) {
					jp.jPlayer("setMedia", _setMedia).jPlayer("play");
				},
				swfPath: "./resource/script",
				wmode: "window"
				//solution: "flash, html"
			})
			.bind($.jPlayer.event.play, function() {
				$(this).jPlayer("pauseOthers");
			});
			musicHandler.music_off_all();
			if(music_switch == 1) {
				jp.jPlayer("play");
				$(this).find("i").removeClass("icon-play").addClass("icon-stop");
				$(this).attr("music_switch", "0");
			} else {
				jp.jPlayer("stop");
				$(this).find("i").removeClass("icon-stop").addClass("icon-play");
				$(this).attr("music_switch", "1");
			}
		});
		$('.item').each(function(){
			musicHandler.kindeditorUploadBtn($(this).find('#music-attach-btn')[0]);
		});
	});
//-->
</script>