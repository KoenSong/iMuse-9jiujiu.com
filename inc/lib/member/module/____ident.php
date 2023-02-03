<?php
$cur='账号设置';
$member_ident_row=$db->get_one('member_ident',"MemberId = '{$member_info['MemberId']}'");
$model_row=$db->get_one('ad',"AId = 6");
?>
<style>
.form_btn{position: relative;overflow: hidden;margin-right: 4px;display:inline-block; 
*display:inline;padding:4px 10px 4px;font-size:14px;line-height:18px; 
*line-height:20px;color:#fff; 
text-align:center;vertical-align:middle;cursor:pointer;background:#5bb75b; 
border:1px solid #cccccc;border-color:#e6e6e6 #e6e6e6 #bfbfbf; 
border-bottom-color:#b3b3b3;-webkit-border-radius:4px; 
-moz-border-radius:4px;border-radius:4px;} 
.form_btn input{position: absolute;top: 0; right: 0;margin: 0;border:solid transparent; 
opacity: 0;filter:alpha(opacity=0); cursor: pointer;} 
.progress{position:relative; margin-left:100px; margin-top:4px;  
width:200px;padding: 1px; border-radius:3px; display:none} 
.bar {background-color: green; display:block; width:0%; height:20px;  
border-radius:3px; } 
.percent{position:absolute; height:20px; line-height:20px; display:inline-block;  
top:1px; left:4%; color:#fff } 
.files{height:22px; line-height:22px; margin:10px 0} 
.delimg{margin-left:20px; color:#090; cursor:pointer}

.form_btn2{position: relative;overflow: hidden;margin-right: 4px;display:inline-block; 
*display:inline;padding:4px 10px 4px;font-size:14px;line-height:18px; 
*line-height:20px;color:#fff; 
text-align:center;vertical-align:middle;cursor:pointer;background:#5bb75b; 
border:1px solid #cccccc;border-color:#e6e6e6 #e6e6e6 #bfbfbf; 
border-bottom-color:#b3b3b3;-webkit-border-radius:4px; 
-moz-border-radius:4px;border-radius:4px;} 
.form_btn2 input{position: absolute;top: 0; right: 0;margin: 0;border:solid transparent; 
opacity: 0;filter:alpha(opacity=0); cursor: pointer;} 
.progress2{position:relative; margin-left:100px; margin-top:4px;  
width:200px;padding: 1px; border-radius:3px; display:none} 
.bar2 {background-color: green; display:block; width:0%; height:20px;  
border-radius:3px; } 
.percent2{position:absolute; height:20px; line-height:20px; display:inline-block;  
top:1px; left:4%; color:#fff } 
.files2{height:22px; line-height:22px; margin:10px 0} 
.delimg2{margin-left:20px; color:#090; cursor:pointer}

.form_btn3{position: relative;overflow: hidden;margin-right: 4px;display:inline-block; 
*display:inline;padding:4px 10px 4px;font-size:14px;line-height:18px; 
*line-height:20px;color:#fff; 
text-align:center;vertical-align:middle;cursor:pointer;background:#5bb75b; 
border:1px solid #cccccc;border-color:#e6e6e6 #e6e6e6 #bfbfbf; 
border-bottom-color:#b3b3b3;-webkit-border-radius:4px; 
-moz-border-radius:4px;border-radius:4px;} 
.form_btn3 input{position: absolute;top: 0; right: 0;margin: 0;border:solid transparent; 
opacity: 0;filter:alpha(opacity=0); cursor: pointer;} 
.progress3{position:relative; margin-left:100px; margin-top:4px;  
width:200px;padding: 1px; border-radius:3px; display:none} 
.bar3 {background-color: green; display:block; width:0%; height:20px;  
border-radius:3px; } 
.percent3{position:absolute; height:20px; line-height:20px; display:inline-block;  
top:1px; left:4%; color:#fff } 
.files3{height:22px; line-height:22px; margin:10px 0} 
.delimg3{margin-left:20px; color:#090; cursor:pointer}
</style>

<div id="lib_member_profile">
	<div class="webpath">
    	<div class="fl"><span>当前位置：</span><a href="/">首页</a> > <a href="/account.php?module=index">会员中心</a> > <span class="cur"><?=$cur?></span></div>
		<div class="fr account_web">
       	<a href="<?=$account_url?>">个人主页</a>
		</div>
    </div>
	<?php if($_GET['profile_success']==1){?>
		<div class="blank15"></div>
		<div class="change_success lib_member_item_card">
			<br />教师认证。<br /><br /><br />
			<a href="<?=$member_url_cn;?>?module=index"><strong>我的账号</strong></a><br /><br />
		</div>
	<?php }else{?>
		<?php /*?><div class="lib_member_info">如果您要更改您的教师认证资料，请填写下面的表格，点击"保存"按钮。</div><?php */?>
		<div class="form lib_member_item_card">
			<form action="/ajax/action.php" method="post"  name="member_profile_form" enctype="multipart/form-data" OnSubmit="return checkForm(this);">
				<div class="lib_member_sub_title">上传认证资料</div>
				<div class="rows">
                	<label>教龄:<font class="fc_red" style="font-size:18px;">*</font></label>
                    <span>
						<?php if(!$member_info['IsTeacher']){?>
							<input type="text" name="T_age" class="form_input" onkeyup="set_number(this, 1);" onpaste="set_number(this, 1);" value="<?=$member_ident_row['T_age']?>" />&nbsp;年
						<?php }else{?>
							<?=$member_ident_row['T_age']+date('y',$service_time)-date('y',$member_info['RegTime'])?>&nbsp;年
						<?php }?>
                    </span>
                    <div class="clear"></div>
                </div>
                
                <div class="rows">
                	<label>身份证: </label>
                    <span style="margin-top:22px;">
                        <div class="form_btn fl"> 
                            <span>添加附件</span> 
                            <input class="fileupload" type="file" name="mypic0"> 
                        </div> 
                        <div class="progress"> 
                            <div class="bar fl"></div><div class="percent fl">0%</div> 
                        </div> 
                        <div class="showimg"></div>
                    </span>
                    <div class="clear"></div>
                </div>
                
                <div class="rows">
                	<label>教师资格证: </label>
                    <span style="margin-top:22px;">
                        <div class="form_btn fl"> 
                            <span>添加附件</span> 
                            <input class="fileupload" type="file" name="mypic1"> 
                        </div> 
                        <div class="progress"> 
                            <div class="bar fl"></div><div class="percent fl">0%</div> 
                        </div> 
                        <div class="showimg"></div>
                    </span>
                    <div class="clear"></div>
                </div>
                <div class="rows">
                	<label>相关证书: </label>
                    <span style="margin-top:22px;">
                        <div class="form_btn fl"> 
                            <span>添加附件</span> 
                            <input class="fileupload" type="file" name="mypic2"> 
                        </div> 
                        <div class="progress"> 
                            <div class="bar fl"></div><div class="percent fl">0%</div> 
                        </div> 
                        <div class="showimg"></div>
                    </span>
                    <div class="clear"></div>
                </div>
                
				<div class="clear"></div>
				<?php /*?><div class="rows">
					<label></label>
					<span><input name="Submit" type="submit" class="form_button form_button_130" value="保 存"></span>
					<div class="clear"></div>
				</div><?php */?>
                <input type="hidden" name="MemberId" value="<?=$member_info['MemberId']?>" />
				<input type="hidden" name="data" value="member_ident" />
			</form>
		</div>
	<?php }?>
</div>
<script>
	$(function () {
     
		/*var bar = $('.bar'); 
		var percent = $('.percent'); 
		var showimg = $('#showimg'); 
		var progress = $(".progress"); 
	   // var files = $(".files"); 
		var btn = $(".form_btn span"); */
   
	 
    $(".fileupload").change(function(){ //选择文件
	 	$(this).parent().wrap("<form action='/ajax/action.php' method='post' enctype='multipart/form-data'></form>");
		var bar = $(this).parent().parent().parent().find('.bar'); 
		var percent = $(this).parent().parent().parent().find('.percent'); 
		var showimg = $(this).parent().parent().parent().find('.showimg'); 
		var progress = $(this).parent().parent().parent().find(".progress");
	   // var files = $(".files"); 
		var btn = $(this).parent().parent().parent().find(".form_btn span"); 
        $(this).parent().parent().ajaxSubmit({ 
            dataType:  'json', //数据格式为json 
            beforeSend: function() { //开始上传 
                //showimg.empty(); //清空显示的图片 
                progress.show(); //显示进度条 
                var percentVal = '0%'; //开始进度为0% 
                bar.width(percentVal); //进度条的宽度 
                percent.html(percentVal); //显示进度为0% 
                btn.html("上传中..."); //上传按钮显示上传中 
            }, 
            uploadProgress: function(event, position, total, percentComplete) { 
                var percentVal = percentComplete + '%'; //获得进度 
                bar.width(percentVal); //上传进度条宽度变宽 
                percent.html(percentVal); //显示上传进度百分比 
            }, 
            success: function(data) { //成功 
                //获得后台返回的json数据，显示文件名，大小，以及删除按钮 
                //files.html("<b>"+data.name+"("+data.size+"k)</b><span class='delimg' rel='"+data.pic+"'>删除</span>"); 
                //显示上传后的图片 
                var img = "http://9jiujiu.com/"+data.pic; 
                showimg.html("<img src='"+img+"'>"); 
                btn.html("添加附件"); //上传按钮还原 
            }, 
            error:function(xhr){ //上传失败 
                btn.html("上传失败"); 
                bar.width('0'); 
                files.html(xhr.responseText); //返回失败信息 
            } 
        }); 
    });
	
}); 
</script>