<?php 
//会员发表文章
if($_POST[$_SESSION['Code'].'_data']=='publish_cn'){
	$save_dir=get_cfg('ly200.up_file_base_dir').'publish/'.date('y_m_d/', $service_time);
	if($_SESSION['Code']==$_POST[$_SESSION['Code'].'_Code']){
	$un_keyword_ary=array('www', 'http');	//带有本关键词的内容不存入数据库
	$Subject=$_POST[$_SESSION['Code'].'_Subject'];
	$Message=save_remote_img($_POST[$_SESSION['Code'].'_Message'], $save_dir);
	$VCode=strtoupper($_POST[$_SESSION['Code'].'_VCode']);
	$jump_url=substr($_POST[$_SESSION['Code'].'_jump_url'], 0, 1)!='/account.php'?'/account.php':$_POST[$_SESSION['Code'].'_jump_url'];
	$Site=$_POST[$_SESSION['Code'].'_Site'];
	$vcode_tips='验证码错误，请正确填写验证码！';
	$success_tips='发布文章成功，请耐心等待审核，谢谢您的支持！';
	if($VCode!=$_SESSION[md5('feedback')] || $_SESSION[md5('feedback')]==''){	//验证码错误
		$_SESSION[md5('feedback')]='';
		unset($_SESSION[md5('feedback')]);
		js_back($vcode_tips);
	}
	$str=$Subject.$Message;	//过滤内容
	$in=0;
	foreach($un_keyword_ary as $value){
		if(@substr_count($str, $value)){
			$in=1;
			break;
		}
	}
	($in==1 || $Subject=='' || $Message=='') && js_location($jump_url);
	$db->insert('publish', array(
			'MemberId'	=>  $_SESSION['member_MemberId'],
			'Title'		=>	$Subject,
			'AccTime'	=>	$service_time,
			'Ip'		=>	get_ip(),
			'IsYes'		=>	0,
		)
	);
	$db->insert('publish_contents', array(
		'InfoId'	=>	$InfoId,
		'Contents'	=>	$Message
		)
	);
	js_location($jump_url, $success_tips);
	}
}

if($_POST['teacher_video']=='teacher_v_add'){
	$save_dir=get_cfg('ly200.up_file_base_dir').'instance/'.date('y_m_d/', $service_time);
	$Name=$_POST['Name'];
	$Language=(int)$_POST['Language'];
	$BriefDescription=$_POST['BriefDescription'];
	$IsInIndex=(int)$_POST['IsInIndex'];
	$IsClassic=(int)$_POST['IsClassic'];
	$BigPicPath=$SmallPicPath=array();	//$SmallPicPath存入数据库的
	if(get_cfg('instance.pic_count')){
		include($site_root_path.'/inc/fun/img_resize.php');
		for($i=0; $i<count($_FILES['PicPath']['name']); $i++){
			if($tmp_path=up_file($_FILES['PicPath'], $save_dir, $i)){
				$BigPicPath[$i]=$SmallPicPath[$i]=$tmp_path;
				foreach(get_cfg('instance.pic_size') as $key=>$value){
					$w_h=@explode('X', $value);
					$filename="$key"=='default'?'':dirname($tmp_path).'/'.$value.'_'.basename($tmp_path);
					$path=img_resize($SmallPicPath[$i], $filename, (int)$w_h[0], (int)$w_h[1]);
					"$key"=='default' && $SmallPicPath[$i]=$path;
				}
			}
		}
		if(get_cfg('ly200.img_add_watermark')){
			include($site_root_path.'/inc/fun/img_add_watermark.php');
			foreach($BigPicPath as $value){
				img_add_watermark($value);
			}
		}
	}
	$db->insert('instance', array(
			'CateId'			=>	3,
			'Name'				=>	$Name,
			'PicPath'			=>	$SmallPicPath[0],
			'BriefDescription'	=>	$BriefDescription,
			'SeoTitle'			=>	$Name,
			'SeoKeywords'		=>	$Name,
			'SeoDescription'	=>	$Name,
			'IsInIndex'			=>	$IsInIndex,
			'IsClassic'			=>	$IsClassic,
			'UpdateTime'		=>	$service_time,
			'Language'			=>	$Language
		)
	);
	$CaseId=$db->get_insert_id();
	$len = count($SmallPicPath);
	for($i=0;$i<$len;$i++){
		$db->insert('global_picture',array(
				'PicPath'			=>	$SmallPicPath[$i],	
				'Id'				=>	$CaseId,
				'Type'				=>	'instance',
		));
	}
	get_cfg('instance.description') && $Description=save_remote_img($_POST['Description'], $save_dir);
	$db->insert('instance_description', array(
			'CaseId'		=>	$CaseId,
			'Description'	=>	$Description
		)
	);
	set_page_url('instance', "CaseId='$CaseId'", get_cfg('instance.page_url'), 1);
	$db->update('manage_operation_log', 'Operation="instance_add"', array(
			'Value'	=>	$CateId
		)
	);
	save_manage_log('添加星教视频:'.$Name);
	js_location('/account.php?module=teacher_video','添加成功');
	exit;
}

if($_GET['video_action']=='delimg'){
	$CaseId=(int)$_POST['CaseId'];
	$Field=$_GET['Field'];
	$PicPath=$_GET['PicPath'];
	$AId=$_GET['AId'];
	$ImgId=$_GET['ImgId'];
	foreach(get_cfg('instance.pic_size') as $key=>$value){
		if("$key"=='default'){
			del_file($PicPath);
			del_file(str_replace('s_', '', $PicPath));
		}else{
			del_file(str_replace('s_', $value.'_', $PicPath));
		}
	}
	
	$db->delete('global_picture', "AId='$AId'");
	
	$str=js_contents_code(get_lang('ly200.del_success'));
	echo "<script language=javascript>parent.document.getElementById('$ImgId').innerHTML='$str'; parent.document.getElementById('{$ImgId}_a').innerHTML='';</script>";
	exit;
}

if($_POST['teacher_video']=='teacher_v_mod'){
	$save_dir=get_cfg('ly200.up_file_base_dir').'instance/'.date('y_m_d/', $service_time);
	$CaseId=(int)$_POST['CaseId'];
	$query_string=$_POST['query_string'];
	$Name=$_POST['Name'];
	$CateId=$db->get_row_count('instance_category')>1?(int)$_POST['CateId']:(int)$db->get_value('instance_category', 1, 'CateId');
	$Language=(int)$_POST['Language'];
	$BriefDescription=$_POST['BriefDescription'];
	$SeoTitle=$_POST['SeoTitle'];
	$SeoKeywords=$_POST['SeoKeywords'];
	$SeoDescription=$_POST['SeoDescription'];
	$IsInIndex=(int)$_POST['IsInIndex'];
	$IsClassic=(int)$_POST['IsClassic'];
	
	$BigPicPath=$SmallPicPath=$PicAlt=array();	//$SmallPicPath存入数据库的
	if(get_cfg('instance.pic_count')){
		include($site_root_path.'/inc/fun/img_resize.php');
		for($i=0; $i<count($_FILES['PicPath']['name']); $i++){
			
			$S_PicPath[$i]=is_file($site_root_path.$_POST['S_PicPath'][$i]) ? $_POST['S_PicPath'][$i] : '';
			if($tmp_path=up_file($_FILES['PicPath'], $save_dir, $i)){
				$BigPicPath[$i]=$SmallPicPath[$i]=$tmp_path;
				del_file($S_PicPath[$i]);
				del_file(str_replace('s_', '', $S_PicPath[$i]));
				foreach(get_cfg('instance.pic_size') as $key=>$value){
					$w_h=@explode('X', $value);
					$filename="$key"=='default'?'':dirname($tmp_path).'/'.$value.'_'.basename($tmp_path);
					$path=img_resize($SmallPicPath[$i], $filename, (int)$w_h[0], (int)$w_h[1]);
					"$key"=='default' && $SmallPicPath[$i]=$path;
					del_file(str_replace('s_', $value.'_', $S_PicPath[$i]));
				}
			}else{
				$SmallPicPath[$i]=$S_PicPath[$i];
			}
		}
		if(get_cfg('ly200.img_add_watermark')){
			include($site_root_path.'/inc/fun/img_add_watermark.php');
			foreach($BigPicPath as $value){
				img_add_watermark($value);
			}
		}
	}
	$db->update('instance', "CaseId='$CaseId'", array(
			'Name'				=>	$Name,
			'PicPath'			=>	$SmallPicPath[0],
			'BriefDescription'	=>	$BriefDescription,
			'SeoTitle'			=>	$Name,
			'SeoKeywords'		=>	$Name,
			'SeoDescription'	=>	$Name,
			'IsInIndex'			=>	$IsInIndex,
			'IsClassic'			=>	$IsClassic,
			'UpdateTime'		=>	$service_time,
			'Language'			=>	$Language
		)
	);
	
	$db->delete('global_picture',"Id=$CaseId AND Type='instance'");
	$len = count($SmallPicPath);
	for($i=0;$i<$len;$i++){
		$db->insert('global_picture',array(
				'PicPath'			=>	$SmallPicPath[$i],	
				'Id'				=>	$CaseId,
				'Type'				=>	'instance',
		));
	}
	
	if(get_cfg('instance.description')){
		$Description=save_remote_img($_POST['Description'], $save_dir);
		$db->update('instance_description', "CaseId='$CaseId'", array(
				'Description'	=>	$Description
			)
		);
	}
	
	set_page_url('instance', "CaseId='$CaseId'", get_cfg('instance.page_url'), 1);
	save_manage_log('编辑星教视频:'.$Name);
	js_location('/account.php?module=teacher_video','编辑成功');
	exit;
}

?>