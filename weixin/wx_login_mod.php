<?php
include('../inc/site_config.php');
include('../inc/set/ext_var.php');
include('../inc/fun/mysql.php');
include('../inc/function.php');

$query_string=query_string(array('forgot_success', 'forgot_fail'));

//会员登录
if($_POST['data']=='member_login'){
	$Phone=$_POST['Phone'];
	$Password=password($_POST['Password']);
	$jump_url=$_GET['jump_url'];
	//$jump_url=(substr($jump_url, 0, 1)!='/' || substr_count($jump_url, 'logout'))?"$member_url_cn?module=index":$jump_url;
	$jump_url=(substr($jump_url, 0, 1)!='/' || substr_count($jump_url, 'logout'))?"$member_url_cn?module=orders&act=prelist#contents":$jump_url;
//var_dump($jump_url);


	if($Phone=='' || $_POST['Password']==''){
		$_SESSION['login_post']=$_POST;
		js_location("$member_url_cn?fail=1&$query_string");
	}else{
		//$Email=$db->get_value('member',"LastName='$LastName'",'Email'); 
		$user_row=$db->get_one('member',"(Phone='$Phone' or ID='$Phone') and Password='$Password'"); 
		if($user_row){
			$_SESSION['member_MemberId']=$user_row['MemberId'];
			$_SESSION['member_Phone']=$user_row['Phone'];
			$_SESSION['member_IsTeacher']=$user_row['IsTeacher'];
			$_SESSION['member_Apply']=$user_row['Apply'];
			$_SESSION['member_ID']=$user_row['ID'];
			$_SESSION['member_UserName']=$user_row['UserName'];
			$_SESSION['member_Password']=$user_row['Password'];
			
			$db->update('member', "MemberId='{$user_row['MemberId']}'", array(
					'LastLoginIp'	=>	get_ip(),
					'LastLoginTime'	=>	$service_time,
					'LoginTimes'	=>	$user_row['LoginTimes']+1
				)
			);
			
			$db->insert('member_login_log', array(
					'MemberId'	=>	(int)$_SESSION['member_MemberId'],
					'LoginTime'	=>	$service_time,
					'LoginIp'	=>	get_ip()
				)
			);
			
			$_SESSION['login_post']='';
			unset($_SESSION['login_post']);

			//TODO OAuth2.0网页授权
			if($_SESSION['member_IsTeacher'] == 1){
				$jump_url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxf2bd74751985d977&redirect_uri=http://9jiujiu.com/weixin/oauth2.php?memberid={$_SESSION['member_MemberId']}&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect";
				js_location($jump_url);
			}else{
				echo "只有教师才能参与本次活动，请期待更多活动！";
			}
		}else{
			$_SESSION['login_post']=$_POST;
			//var_dump($_POST);
			//var_dump("$member_url_cn?login_fail=1&$query_string");
			//js_location("$member_url_cn?login_fail=1&$query_string");
			js_location("/weixin/oauth_member.php?login_fail=1&$query_string");
		}
	}
}
//会员发布课程
if($_POST['data']=='member_add_issue'){
	$MemberId = (int)$_POST['MemberId'];
	$IssueTime = $_POST['IssueTime'];
	$Video = $_POST['Video'];
	
	$Price_0 = (float)$_POST['Price_0'];
	$Price_1 = (float)$_POST['Price_1'];
	$Intro_Type = (int)$_POST['Intro_Type'];
	$ColorId = (int)$_POST['ColorId'];
	$CircleId=(int)$_POST['CircleId'];
	$CateId = (int)$_POST['CateId'];
	$Date='|';
	
	foreach((array)$_POST['Selected'] as $v){
		if($v!=''){
			$Date=$Date.$v.'|';
		}	
	}
	//$Price = $_POST['Price'];
	//$count=count($_POST['Selected']);
	if($MemberId == (int)$_SESSION['member_MemberId']){
		$where="MemberId='$MemberId'";
		$member_info=$db->get_one('member', "MemberId='$MemberId'");
		$member_apply=$db->get_one('member_apply',"MemberId='$MemberId'");
		$member_ext=$db->get_one('member_ext',"MemberId='$MemberId'");
	}else{
		js_location("$member_url_cn",'信息有误,请与我们联系');	
	}
	if($Date !='|'){
		if($db->get_row_count('product',"MemberId = '{$member_info['MemberId']}'")){
			$db->update('product',"MemberId = '{$member_info['MemberId']}'", array(
				'CateId'			=>	$CateId,
				'Name'				=>	$member_info['UserName']?$member_info['UserName']:$member_info['Phone'],
				'Stock'				=>	$Stock,
				'PicPath_0'			=>	$member_info['Face'],
				'Price_0'			=>	$Price_0,
				'Price_1'			=>	$Price_1,
				'SeoTitle'			=>	$SeoTitle,
				'SeoKeywords'		=>	$SeoKeywords,
				'SeoDescription'	=>	$SeoDescription,
				'AccTime'			=>	$AccTime,
				'Identity'			=>	'0',
				'Degree'			=>	'0',
				'Certification'		=>	'0',
				'Identity'			=>	'0',
				'ColorId'			=>	$ColorId,
				'CircleId'			=>	$CircleId,
				'MemberId'			=>	$member_info['MemberId'],
				'Date'				=>	$Date,
				'IssueTime'			=>	$IssueTime,
				'Video'				=>	$Video,
				'Title'				=>	$member_info['Title'],
			));
			
			$ProId=$db->get_value('product',"MemberId = '{$member_info['MemberId']}'",'ProId');
			
			if($Intro_Type==2){
				$Warranty0 = format_post_value($_POST['T_will']);
				$Warranty1 = format_post_value($_POST['T_gift']);
				$Warranty2 = format_post_value($_POST['T_thought']);
				$Warranty3 = format_post_value($_POST['T_success']);
				$Warranty4 = format_post_value($_POST['T_ter']);	
			}else{
				$Warranty0 = $member_apply['T_will'];
				$Warranty1 = $member_apply['T_gift'];
				$Warranty2 = $member_apply['T_thought'];
				$Warranty3 = $member_apply['T_success'];
				$Warranty4 = $member_apply['T_ter'];
			}
			$db->update('product_ext',"ProId='$ProId'", array(
					'ProId'			=>	$ProId,
					'Warranty0'		=>	$Warranty0,
					'Warranty1'		=>	$Warranty1,
					'Warranty2'		=>	$Warranty2,
					'Warranty3'		=>	$Warranty3,
					'Warranty4'		=>	$Warranty4,
					'T_age'			=>	$member_apply['T_age'],
					'Applicable'	=>	$member_info['Title'],
					'Volume'		=>	$member_apply['T_style'],
					'S_0'			=>	'100',
					'S_1'			=>	'88',
					'S_2'			=>	$A_Issue_L,
					'S_3'			=>	'99',
					'P_age'			=>	$member_apply['P_age'],	
				)
			);
			$is_add_issue=0;
			//$Warranty0 && $Warranty1 && $Warranty2 && $Warranty3 && $Date!='|' && $Video && $Price_0 && $Price_1 && $ColorId && $CateId && $is_add_issue=1;
			$Date!='|' && $Price_1 && $ColorId && $CircleId && $CateId && $is_add_issue=1;
			
			$db->update('member',"MemberId='{$member_info['MemberId']}'", array(
					'Is_All_1 '	=> $is_add_issue,
				));
			
			js_location("$member_url_cn?module=issue_mod",'修改成功!');
			
		}else{
			$db->insert('product', array(
				'CateId'			=>	$CateId,
				'Name'				=>	$member_info['UserName'],
				'Stock'				=>	$Stock,
				'PicPath_0'			=>	$member_info['Face'],
				'Price_0'			=>	$Price_0,
				'Price_1'			=>	$Price_1,
				'SeoTitle'			=>	$SeoTitle,
				'SeoKeywords'		=>	$SeoKeywords,
				'SeoDescription'	=>	$SeoDescription,
				'AccTime'			=>	$AccTime,
				'Identity'			=>	$member_apply['Identity_Num']?'1':'',
				'Degree'			=>	$member_apply['Degree']==1?'1':'',
				'Certification'		=>	$member_apply['Certification']==1?'1':'',
				'Identity'			=>	$member_apply['Identity']==1?'1':'',
				'ColorId'			=>	$ColorId,
				'SoldOut'			=>	'1',
				'MemberId'			=>	$member_info['MemberId'],
				'Date'				=>	$Date,
				'IssueTime'			=>	$IssueTime,
				'Video'				=>	$Video,
			));
			
			$ProId=$db->get_insert_id();
			
			if($Intro_Type==2){
				$Warranty0 = format_post_value($_POST['T_will']);
				$Warranty1 = format_post_value($_POST['T_gift']);
				$Warranty2 = format_post_value($_POST['T_thought']);
				$Warranty3 = format_post_value($_POST['T_success']);
				$Warranty4 = format_post_value($_POST['T_ter']);	
			}else{
				$Warranty0 = $member_apply['T_will'];
				$Warranty1 = $member_apply['T_gift'];
				$Warranty2 = $member_apply['T_thought'];
				$Warranty3 = $member_apply['T_success'];
				$Warranty4 = $member_apply['T_ter'];
			}
			$db->insert('product_ext', array(
					'ProId'			=>	$ProId,
					'Warranty0'		=>	$Warranty0,
					'Warranty1'		=>	$Warranty1,
					'Warranty2'		=>	$Warranty2,
					'Warranty3'		=>	$Warranty3,
					'Warranty4'		=>	$Warranty4,
					'T_age'			=>	$member_apply['T_age'],
					'Applicable'	=>	$member_info['Title'],
					'Volume'		=>	$member_apply['T_style'],
					'S_0'			=>	'100',
					'S_1'			=>	'88',
					'S_2'			=>	$A_Issue_L,
					'S_3'			=>	'99',
					'P_age'			=>	$member_apply['P_age'],
				)
			);
			$is_add_issue=0;
			$Date!='|' && $Price_1 && $ColorId && $CircleId && $CateId && $is_add_issue=1;
			
			$db->update('member',"MemberId='{$member_info['MemberId']}'", array(
					'Is_All_1 '	=> $is_add_issue,
				));
			js_location("$member_url_cn?module=issue_mod",'添加成功!');
		}
	}else{
		js_location("$member_url_cn?module=issue_mod",'添加失败!');	
	}
	
}

//基本信息
if($_POST['data']=='mod_base'){
	$MemberId = (int)$_POST['MemberId'];
	$UserName=htmlspecialchars($_POST['UserName']);
	$Title=htmlspecialchars($_POST['Title']);
	$Shcool=htmlspecialchars($_POST['Shcool']);
	$Class=htmlspecialchars($_POST['Class']);
	$State=htmlspecialchars($_POST['State']);
	$City=htmlspecialchars($_POST['City']);
	$Area=htmlspecialchars($_POST['Area']);
	$Class_CateId='|'.@implode('|', $_POST['Class_CateId']).'|';
	$Video=htmlspecialchars($_POST['Video']);
	$IntroDes=htmlspecialchars($_POST['IntroDes']);
	$save_dir='/u_file/face/'.date('y_m/d/', $now_time);
	
	$Year=$_POST['Year'];
	$Month=$_POST['Month'];
	$Days=$_POST['Days'];
	
	$Brithday=$Year.'-'.$Month.'-'.$Days;
	
	for($i=0;$i<4;$i++){
		if($Path=up_file2($_FILES['PicPath_'.$i], $save_dir)){
			$sIMG[]=$Path;
		}else{
			$sIMG[]=$_POST['S_PicPath_'.$i];
		}
	}
	

	if($MHead=up_file2($_FILES['HeadPic'], $save_dir)){
		include($site_root_path.'/inc/fun/img_resize.php');
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
	}else{
		$MHead=$_POST['S_Face'];
	}
	$Is_All_0=0;
	($UserName!='' && $Title!='' && $Year!='' && $Month!='' && $Days!='') && $Is_All_0=1;

	if($Title && $MemberId){
		$db->update('member',"MemberId = '$MemberId'",array(
			'UserName'	=>	$UserName,
			'Title'		=>	$Title,
			'Country'	=>	$State,
			'State'		=>	$City,
			'City'		=>	$Area,
			'Face'		=>	$MHead,
			'Is_All_0'	=>  $Is_All_0,
			'Brithday'	=>	$Brithday,
		));
		
		
		//产品同步
		$ProId = $db->get_value('product',"MemberId = '$MemberId'",'ProId');
		if($ProId){
			$db->update('product',"ProId = '$ProId'", array(
					'Name'				=>	$UserName,
					'PicPath_0'			=>	$MHead,
					'IssueTime'			=>	$IssueTime,
					'Title'				=>	$Title,
			));
		}
		if($db->get_row_count('student_pic',"MemberId = '$MemberId'")){
			$db->update('student_pic',"MemberId = '$MemberId'",array(
				'PicPath_0'		=>	$sIMG[0],
				'PicPath_1'		=>	$sIMG[1],
				'PicPath_2'		=>	$sIMG[2],
				'PicPath_3'		=>	$sIMG[3],
			));
		}else{
			$db->insert('student_pic',array(
				'MemberId'		=>	$MemberId,
				'PicPath_0'		=>	$sIMG[0],
				'PicPath_1'		=>	$sIMG[1],
				'PicPath_2'		=>	$sIMG[2],
				'PicPath_3'		=>	$sIMG[3],
			));	
		}
		
		if($db->get_row_count('member_ext',"MemberId = '$MemberId'")){
			
			$db->update('member_ext',"MemberId = '$MemberId'",array(
				'Shcool'	=>	$Shcool,
				'Class'		=>	$Class,
				'Hobby'		=>	$Class_CateId,
				'IntroDes'	=>	$IntroDes,
				'Video'		=>	$Video,
			));
			
		}else{
			
			$db->insert('member_ext',array(
				'MemberId' 	=> 	$MemberId,
				'Shcool'	=>	$Shcool,
				'Class'		=>	$Class,
				'Hobby'		=>	$Class_CateId,
				'IntroDes'	=>	$IntroDes,
				'Video'		=>	$Video,
				
			));	
			
		}
		js_back('基本信息修改成功！');	
	}else{
		js_back('提交信息有误!');	
	}
	
}

//账号信息
if($_POST['data']=='member_profile'){
	//$FirstName=htmlspecialchars($_POST['FirstName']);
	//$LastName=htmlspecialchars($_POST['LastName']);
	//$Brief=htmlspecialchars($_POST['Brief']);
	//$Age=(int)$_POST['Age'];
	//$Job=htmlspecialchars($_POST['Job']);
	//$Interest=htmlspecialchars($_POST['Interest']);
	$Phone=htmlspecialchars($_POST['Phone']);
	$Email=htmlspecialchars($_POST['Email']);
	$Brithday=htmlspecialchars($_POST['Brithday']);
	$MemberId=(int)$_POST['MemberId'];
	
	$CheckCode=$_POST['CheckCode'];
	//var_dump($_SESSION['__CheckNum']);
	//var_dump($CheckCode);
	if($CheckCode!=$_SESSION['__CheckNum'] || $_SESSION['__CheckNum']==''){	//验证码错误
		$_SESSION['__CheckNum'] ='';
		unset($_SESSION['__CheckNum']);
		js_back('验证码错误！');
	}
	
	($Email=='' || $Phone=='') && js_back('请填写完整！');;
	$where="MemberId = '$MemberId'";
	$db->update('member',$where , array(
			//'Title'		=>	$Title,
			//'LastName'	=>	$LastName,
			//'FirstName'	=>	$FirstName,
			'Phone'		=>	$Phone,
			'Email'		=>	$Email,
			'Brithday'	=>	$Brithday,
		)
	);
	if($db->get_row_count('member_ext',$where)){
			
			$db->update('member_ext',$where,array(
				'Brief'		=>	$Brief,
				'Age'		=>	$Age,
				'Job'		=>	$Job,
				'Interest'	=>	$Interest,
				'Brief'		=>	$Brief,
			));
			
		}else{
			
			$db->insert('member_ext',array(
				'MemberId' 	=> 	$MemberId,
				'Brief'		=>	$Brief,
				'Age'		=>	$Age,
				'Job'		=>	$Job,
				'Interest'	=>	$Interest,
			));	
			
		}
	
	$_SESSION['member_Title']=stripslashes($Title);
	$_SESSION['member_LastName']=stripslashes($LastName);
	$_SESSION['member_Email']=stripslashes($Email);
	//print_r($_POST);
	//exit;
	js_back('账号设置成功！');
}
	
//申请教师 没用了
if($_POST['data']=='apply'){
	$MemberId=(int)$_POST['MemberId'];
	$CateId=(int) $_POST['CateId'];
	$T_age=(int) $_POST['T_age'];
	$T_style=$_POST['T_style'];
	$T_address=$_POST['T_address'];
	$T_will=$_POST['T_will'];
	$T_gift=$_POST['T_gift'];
	$T_thought=$_POST['T_thought'];
	$T_success=$_POST['T_success'];
	$T_ter=$_POST['T_ter'];
	$Identity_Num=$_POST['Identity_Num'];
	$P_age = (int)$_POST['P_age'];
	
	$Is_apply=0;
	($P_age !='' && $Identity_Num!='') && $Is_apply=1;
	$where="MemberId = '$MemberId'";
	//会员审核
	
	if($db->get_row_count('member_apply',$where)){
		js_back('你已经提交了资料,请勿重复提交');
	}
	//审核信息
	$db->insert('member_apply',array(
		'MemberId' 		=> $MemberId,
		'CateId' 		=> $CateId,
		//'T_age'			=> $T_age,
		//'T_style' 		=> $T_style,
		//'T_address'		=> $T_address,
		//'T_will' 		=> $T_will,
		//'T_gift' 		=> $T_gift,
		//'T_thought' 	=> $T_thought,
		//'T_success'	 	=> $T_success,
		//'T_ter' 		=> $T_ter,
		//'ApplyTime'		=> $service_time,
		//'Identity_Num'	=> $Identity_Num,
		//'P_age'			=> $P_age,
		'Is_apply'		=> $Is_apply,
		));
	//更改状态
	//$db->update('member',$where,array('Apply' => 1));
	js_back('教师资料提交成功！');
}

//会员注册
if($_POST['data']=='member_create'){
	//$Title=$_POST['Title'];
	//$FirstName=$_POST['FirstName'];
	//$LastName=$_POST['LastName'];
	//$Email=$_POST['Email'];
	//$Password=password($_POST['Password']);
	//$Country=$_POST['Country'];
	//$State=$_POST['State'];
	//$City=$_POST['City'];
	//$Apply=(int)$_POST['Apply'];
	$CheckCode=$_POST['CheckCode'];
	//var_dump($_SESSION['__CheckNum']);
	//var_dump($CheckCode);
	if($CheckCode!=$_SESSION['__CheckNum'] || $_SESSION['__CheckNum']==''){	//验证码错误
		$_SESSION['__CheckNum'] ='';
		unset($_SESSION['__CheckNum']);
		js_back('验证码错误！');
	}
	$Phone=$_POST['Phone'];
	$Password=password($_POST['Password']);
	$Apply=(int)$_POST['IsTeacher'];
	$CId=$_POST['CId'];
	
	
	
	
	$jump_url="$member_url_cn?module=index";
	//($LastName=='' ||$LastName=='' || $Email=='' || $Password=='' || preg_match('/^[a-z0-9][a-z\.0-9-_]+@[a-z0-9_-]+(?:\.[a-z]{0,3}\.[a-z]{0,2}|\.[a-z]{0,3}|\.[a-z]{0,2})$/i',$Email)==false ) && js_location($jump_url);	//关键信息空的话不允许提交
	($Phone==''|| $Password=='')&& js_location($jump_url);	//关键信息空的话不允许
	
	if(!$db->get_row_count('member', "Phone='$Phone'")){
		$db->insert('member', array(
				/*'Title'			=>	$Title,
				'FirstName'		=>	$FirstName,
				'LastName'		=>	$LastName,
				'Email'			=>	$Email,
				'Password'		=>	$Password,
				'RegTime'		=>	$service_time,
				'RegIp'			=>	get_ip(),
				'LastLoginTime'	=>	$service_time,
				'LastLoginIp'	=>	get_ip(),
				'LoginTimes'	=>	1,
				'Country'		=>	$Country,
				'State'			=>	$State,
				'City'			=>	$City,
				'IsTeacher'		=>	0,
				'MemberLevel'	=>	$mCfg['Level'],
				'Apply'			=>	$Apply,*/
				'LoginTimes'	=>	1,
				'Phone'			=>	$Phone,
				'City'			=>	$CId,
				'Password'		=>	$Password,
				'IsTeacher'		=>	0,
				'LastLoginIp'	=>	get_ip(),
				'RegTime'		=>	$service_time,
				'LastLoginTime'	=>	$service_time,
				'RegIp'			=>	get_ip(),
				'MemberLevel'	=>	$mCfg['Level'],
				'Apply'			=>	$Apply,
					
			)
		);
		
		$MemberId=$db->get_insert_id();
		
		//审核信息
		if($Apply){
			$db->insert('member_apply',array(
				'MemberId' 		=> $MemberId,
				'CId'			=>	$CId,
				'ApplyTime'		=> $service_time,
			));
		}
		$db->update('member',"MemberId = '$MemberId'",array(
				'ID'	=>	sprintf('%08s',$MemberId),
			)
		);
		
		$_SESSION['member_MemberId']=$MemberId;
		$_SESSION['member_Phone']=$Phone;
		$_SESSION['member_Apply']=$Apply;
		
		$_SESSION['member_ID']=sprintf('%08s',$MemberId);
		$_SESSION['member_UserName']='';
		$_SESSION['member_Password']=$Password;
		
		//$_SESSION['member_Email']=$Email;
		//$_SESSION['member_Title']=$Title;
		//$_SESSION['member_FirstName']=$FirstName;
		//$_SESSION['member_LastName']=$LastName;
		//$_SESSION['member_Password']=$Password;
		//$_SESSION['member_IsTeacher']=0;
		
		$db->insert('member_login_log', array(
				'MemberId'	=>	(int)$_SESSION['member_MemberId'],
				'LoginTime'	=>	$service_time,
				'LoginIp'	=>	get_ip()
			)
		);
		//include($site_root_path.'/inc/lib/cart_cn/init.php');
		
		$_SESSION['create_post']='';
		unset($_SESSION['create_post']);
		
		include($site_root_path.'/inc/lib/mail/create_account.php');
		include($site_root_path.'/inc/lib/mail/template.php');
		sendmail($_SESSION['member_Email'],$_SESSION['member_LastName'], '欢迎来到 '.get_domain(0), $mail_contents);
		/*****************站内信发送************************/
		//js_back($_SESSION['member_FirstName'].$_SESSION['member_LastName'].'成功注册');
		if($Apply){
			js_location("/account.php?module=index",$_SESSION['member_FirstName'].$_SESSION['member_LastName'].'成功注册,请填写完整你的教师信息，经过审核才可以发布课程');
		}else{
			js_location("/account.php",$_SESSION['member_FirstName'].$_SESSION['member_LastName'].'成功注册');	
		}
	}else{
		$_SESSION['create_post']=$_POST;
		js_back('手机已经注册已存在！');
		//js_location("$member_url?create_fail=1&$query_string");
	}
}

//账号信息
if($_POST['data']=='member_price'){
	$MemberId = $_POST['MemberId'];
	$CardNum = $_POST['CardNum'];
	
	if($MemberId){
		$db->update('member',"MemberId = '$MemberId'",array('CardNum'=> $CardNum));
		js_back('银行卡号修改成功！');
	}else{
		js_back('银行卡号修改失败！');
	}
	
}

//停课修改
if($_GET['data']=='slodout'){
	$MemberId = $_GET['MemberId'];
	$is_check=$db->get_value('member',"MemberId = '$MemberId'",'IsTeacher');
	if($MemberId && $is_check){
		$db->update('product',"MemberId = '$MemberId'",array('SoldOut'=> 1));
		js_back('停课修改成功！');
	}else{
		js_back('停课修改失败！');
	}
}
//停课修改
if($_GET['data']=='slodin'){
	$MemberId = $_GET['MemberId'];
	$is_check=$db->get_value('member',"MemberId = '$MemberId'",'IsTeacher');
	if($MemberId && $is_check){
		$db->update('product',"MemberId = '$MemberId'",array('SoldOut'=> 0));
		js_back('停课修改成功！');
	}else{
		js_back('审核未通过，无法开启约课！');
	}
}
//认证信息
if($_POST['data']=='member_ident'){
	$MemberId = $_POST['MemberId'];
	$save_dir='/u_file/cer/';
	
	if($Pic_Cer=up_file2($_FILES['Pic_Cer'], $save_dir)){
		
	}else{
		$Pic_Cer=$_POST['S_Pic_Cer'];
	}
	
	if($Pic_Teach=up_file2($_FILES['Pic_Teach'], $save_dir)){
		
	}else{
		$Pic_Teach=$_POST['S_Pic_Teach'];
	}
	
	if($Pic_Other=up_file2($_FILES['Pic_Other'], $save_dir)){
		
	}else{
		$Pic_Other=$_POST['S_Pic_Other'];
	}
	$T_age=$_POST['T_age'];
	$Is_ident=0;
	$Pic_Cer!='' && $T_age  && $Is_ident=1;

	if(!$db->get_row_count('member_ident',"MemberId = '$MemberId'")){
		$db->insert('member_ident',array('MemberId'=>$MemberId,'Pic_Cer'=> $Pic_Cer,'Pic_Teach'=>$Pic_Teach,'Pic_Other'=>$Pic_Other,'Is_ident'=>$Is_ident,'T_age'=>	$T_age));
		js_back('上传成功！');
	}else{
		
		$db->update('member_ident',"MemberId = '$MemberId'",array('Pic_Cer'=> $Pic_Cer,'Pic_Teach'=>$Pic_Teach,'Pic_Other'=>$Pic_Other,'Is_ident'=>$Is_ident,'T_age'=>$T_age));
		js_back('上传成功！');	
	}
	
}
//评论
if($_POST['data']=='review_cn'){
	$un_keyword_ary=array('www', 'http');	//带有本关键词的内容不存入数据库
	
	$ProId=(int)$_POST['ProId'];
	$MemberId = (int)$_POST['MemberId'];
	$member_info=$db->get_one('member',"MemberId = '$MemberId'");
	$FullName=$member_info['UserName'];
	//$Email=$_POST['Email'];
	$Phone=$member_info['Phone'];
	$ID = (int)$_SESSION['member_ID'];
	$Rating=(int)$_POST['Rating'];
	($Rating<1 || $Rating>5) && $Rating=5;
	$Contents=$_POST['Contents'];
	//var_dump($member_info);
	//exit;
	$Review_Level=$_POST['Review_Level'];
	
	$in=0;
	foreach($un_keyword_ary as $value){
		if(@substr_count($Contents, $value)){
			$in=1;
			break;
		}
	}
	
	($in==1 || $Review_Level=='' || $Contents=='') && js_back('评论失败！');
	$limit_time=$service_time-3600*24*30;
	if($db->get_row_count('product_review',"ProId='$ProId' and ID='$MemberId'and PostTime>$limit_time")>3){js_back('一个月时间内不能对同一个老师超过4次！');}
	$Review=$db->get_sum('product_review',"ProId='$ProId'",'Review_Level');
	$db->update('product',"ProId='$ProId' and MemberId = '$MemberId'",array('Review'=> $Review));
	$db->insert('product_review', array(
			'ProId'			=>	$ProId,
			'FullName'		=>	$FullName,
			//'Email'		=>	$Email,
			'Phone'			=>	$Phone,
			//'Rating'		=>	$Rating,
			'Contents'		=>	$Contents,
			'Ip'			=>	get_ip(),
			'PostTime'		=>	$service_time,
			'Review_Level'	=> 	$Review_Level,
			'ID'			=>	$MemberId,
			'PostTime'		=>	$service_time,
		)
	);
	
	js_back('谢谢你的评论!');
}

//会员提现
if($_POST['data']=='withdraw'){
	$Price = (float)$_POST['Price'];
	$MemberId = (int)$_POST['MemberId'];
	$Password=password($_POST['Password']);
	
	$member_info = $db->get_one('member',"MemberId='$MemberId' and Password='$Password'");
	if(!$member_info){
		js_back('请输入正确的密码!');
	}
	
	if($Price > $member_info['Account_Price']){
		$Price = $member_info['Account_Price'];
	}
	
	$CurPrice = $member_info['Account_Price'] - $Price;
	
	$db->insert('member_withdraw',array(
			'MemberId'	=>  $MemberId,
			'Price'		=>  $Price,
			'PostTime'	=>  $service_time,
			'FullName'	=>  $member_info['UserName'],
			'Status'	=>  0
		)
	);

	$db->update('member',"MemberId='{$member_info['MemberId']}'",array(
			'Account_Price'  =>  $CurPrice
		)
	);
	js_back('已提现申请成功，请稍后注意查收!');
}

?>