<?php
	$cur='账户中心';
	if($_POST['data']=='member_profile'){
	$MHead = '';
	if($_FILES['HeadPic']){
		include($site_root_path.'/inc/fun/img_resize.php');
		del_file($member_info['Face']);
		$save_dir='/u_file/face/'.date('y_m/d/', $now_time);
		$MHead=up_file($_FILES['HeadPic'], $save_dir);
		//$dirname=dirname($MHead);
		//$filename=basename($MHead);
		$pic_size=array('240X240','235X235','default'=>'150X150','105X105','72X72');
		foreach( $pic_size as $key => $value){
			$w_h=@explode('X', $value);
					$filename="$key"=='default'?'':dirname($MHead).'/'.$value.'_'.basename($MHead);
					$path=img_resize($MHead, $filename, (int)$w_h[0], (int)$w_h[1]);
					"$key"=='default' && $SmallPicPath=$path;
		}
		$MHead=@is_file($site_root_path.$SmallPicPath)?$SmallPicPath:$member_info['Face'];
	}
	$db->update('member', $where, array(
			'Face'		=>	$MHead,
		)
	);
	//print_r($_POST);
	//exit;
	js_location("$member_url_cn?profile_success=1&$query_string");
}
$cur='头像设置';
?>
<div id="lib_member_index">
	<div class="webpath">
    	<div class="fl"><span>当前位置：</span><a href="/">首页</a> > <a href="/account.php?module=index">会员中心</a> > <span class="cur"><?=$cur?></span></div>
		<div class="fr account_web">
       	<a href="<?=$account_url?>">个人主页</a>
		</div>
    </div>
    
    <div class="member_author">
     <form id="index_form" action="/inc/lib/member/action/mod.php" method="post" enctype="multipart/form-data" OnSubmit="return checkForm(this);">
            <div class="item">
                  <span>昵称：<font class="fc_red" style="font-size:18px;">*</font></span><div class="name"><input type="text" class="input_txt" name="UserName" check="请正确填写昵称！~*" value="<?=$member_info['UserName']?>" /></div>
            </div>
            <div class="item">
                <span>性别：<font class="fc_red" style="font-size:18px;">*</font></span><div class="sexy"><input type="radio" name="Title" <?=$member_info['Title']=='保密'?'checked="checked"':''?> value="保密"/>&nbsp;保密&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" <?=$member_info['Title']=='男'?'checked="checked"':''?> name="Title" value="男"/>&nbsp;男&nbsp;&nbsp;&nbsp;&nbsp; <input <?=$member_info['Title']=='女'?'checked="checked"':''?> type="radio" name="Title" value="女" />&nbsp;女</div>
            </div>
			<div class="item">
                <span>出生年月：<font class="fc_red" style="font-size:18px;">*</font></span>
				<?php $brith=explode('-',$member_info['Brithday']);
					//var_dump($brith);
				?>
				<select name="Year" check="请选择出生年类型！~*">
                	<option value="" selected >请选择</option>
					<?php
						for($i=1950;$i<date('Y',time());$i++){
							$select='';
							$brith[0]==$i && $select='selected'; 
							echo "<option value='$i' $select>$i</option>";
						}
					 ?>
				</select>年
				<select name="Month" check="请选择出生月份类型！~*">
                	<option value="" selected >请选择</option>
					<?php
						for($i=1;$i<13;$i++){
							$select='';
							$brith[1]==$i && $select='selected';
							echo "<option value='$i' $select>$i</option>";
						}
					 ?>
				</select>月
				<select name="Days"  check="请选择出生日份类型！~*">
                	<option value="" selected >请选择</option>
					<?php
						for($i=1;$i<32;$i++){
							$select='';
							$brith[2]==$i && $select='selected'; 
							echo "<option value='$i' $select>$i</option>";
						}
					 ?>
				</select>日
				
            </div>
            <div class="item">
				<span>头像：</span>
                    <input type="file" class="fl" style="margin-top:29px; margin-left:5px;" name="HeadPic" />(大小1.5M左右,格式300X300像素)<br /> 
                    <input type="hidden" name="S_Face" value="<?=$member_info['Face']?>" />
            </div>
             <?php if(!$member_info['Apply']){?>
            <div class="item">
                <span>期望上课地点：<font class="fc_red" style="font-size:18px;">*</font></span><select name="State" id="State" check="请正确填写省份城市!~*"></select>
                                        <select name="City" id="City" check="请正确填写省份城市!~*"></select>
                                        <select name="Area" id="Area" check="请正确填写省份城市!~*"></select>
                                        <script language="javascript" src="/js/china_area.js"></script>
                                        <script language="javascript">new PCAS('State', 'City', 'Area','<?=$member_info['Country']?>','<?=$member_info['State']?>','<?=$member_info['City']?>');</script>
            </div>
            <div class="item">
                <span>希望学习的科目：</span>
                <div class="member_cate">
                    <?php $member_fav=$db->get_all('product_category','Dept = 2');?>
                     <ul class="member_cate_ul">
                    <?php foreach((array)$member_fav as $item){
							if($hobby){$check=in_array($item['CateId'],$hobby)?'checked="checked"':'';}
						?>
                       		<li>
                            	<input type="checkbox" name="Class_CateId[]" <?=$check?> value="<?=$item['CateId']?>" />&nbsp; <?=$item['Category']?>
                            </li>
                    <?php }?>
                    </ul>
                </div>
                <div class="blank20"></div>
            </div>
            <div class="item">
                <span>视频地址：</span><input class="input_txt" name="Video" type="text" value="<?=$member_ext['Video']?>"  />
            </div>
            <div class="item">
                <span>展示图片1：</span><input class="form_input" style="margin-top:25px;" name="Path_0" type="file" value="<?=$member_img['PicPath_0']?>"  /><a href="<?=$member_img['PicPath_0']?>"></a>
                <input type="hidden" name="S_PicPath_0" value="<?=$member_img['PicPath_0']?>" />
            </div>
            <div class="item">
                <span>展示图片2：</span><input class="form_input" style="margin-top:25px;" name="Path_1" type="file" value="<?=$member_img['PicPath_1']?>"  /><a href="<?=$member_img['PicPath_1']?>"></a>
                <input type="hidden" name="S_PicPath_1" value="<?=$member_img['PicPath_1']?>" />
            </div>
            <div class="item">
                <span>展示图片3：</span><input class="form_input" style="margin-top:25px;" name="Path_2" type="file" value="<?=$member_img['PicPath_2']?>"  /><a href="<?=$member_img['PicPath_2']?>"></a>
                <input type="hidden" name="S_PicPath_2" value="<?=$member_img['PicPath_2']?>" />
            </div>
            <div class="item">
                <span>展示图片4：</span><input class="form_input" style="margin-top:25px;" name="Path_3" type="file" value="<?=$member_img['PicPath_3']?>"  /><a href="<?=$member_img['PicPath_3']?>"></a>
                <input type="hidden" name="S_PicPath_3" value="<?=$member_img['PicPath_3']?>" />
            </div>
            <div class="item">
                <span>自我介绍：</span><textarea name="IntroDes" style=" margin:17px 0px; width:380px; height:230px; padding:10px; border: 1px solid #29aedf;"><?=$member_ext['IntroDes']?></textarea>
            </div>
            <?php }?>
            <input class="sub_rad" type="submit" name="mod_base" value="保存" />
            <?php /*?><a class="sub_rad" onclick="mod_base(1)">取消</a><?php */?>
            <input type="hidden" name="data" value="mod_base"  />
            <input type="hidden" name="IsTitle" value="<?=$member_info['Title']?'1':''?>" check="请选择性别！~*"  />
            <input type="hidden" name="MemberId" value="<?=$_SESSION['member_MemberId']?>" />
        </form>
    </div>
</div>
<script type="text/javascript">
	$('#index_form').find('input[Name=Title]').click(
		function(){
			$('#index_form').find('input[Name=IsTitle]').val(1);
		}
	);
	function bdaychange(){
		$('#index_form').find('input[Name=IsBrithday]').val(1);
	}
	/*function mod_base(i){
		if(i==1){
			jQuery('.member_author').eq(1).hide();
			jQuery('.member_author').eq(0).show();
		}else{
			jQuery('.member_author').eq(0).hide();
			jQuery('.member_author').eq(1).show();
		}
	}*/
</script>