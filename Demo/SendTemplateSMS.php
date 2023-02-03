<?php
/*
 *  Copyright (c) 2014 The CCP project authors. All Rights Reserved.
 *
 *  Use of this source code is governed by a Beijing Speedtong Information Technology Co.,Ltd license
 *  that can be found in the LICENSE file in the root of the web site.
 *
 *   http://www.yuntongxun.com
 *
 *  An additional intellectual property rights grant can be found
 *  in the file PATENTS.  All contributing project authors may
 *  be found in the AUTHORS file in the root of the source tree.
 */

include("../SDK/CCPRestSDK.php");

//主帐号
$accountSid= '8a48b5514e3e5862014e429645e2033a';

//主帐号Token
$accountToken= '355072b6aeaa4893ae0f623b2ae57650';

//应用Id
$appId='aaf98f894e52805a014e566534d7034a';

//请求地址，格式如下，不需要写https://
$serverIP='app.cloopen.com';

//请求端口 
$serverPort='8883';

//REST版本号
$softVersion='2013-12-26';


/**
  * 发送模板短信
  * @param to 手机号码集合,用英文逗号分开
  * @param datas 内容数据 格式为数组 例如：array('Marry','Alon')，如不需替换请填 null
  * @param $tempId 模板Id
  */       
function sendTemplateSMS($to,$datas,$tempId)
{
     // 初始化REST SDK
     global $accountSid,$accountToken,$appId,$serverIP,$serverPort,$softVersion;
     $rest = new REST($serverIP,$serverPort,$softVersion);
     $rest->setAccount($accountSid,$accountToken);
     $rest->setAppId($appId);
    
     // 发送模板短信
     echo "Sending TemplateSMS to $to <br/>";
     $result = $rest->sendTemplateSMS($to,$datas,$tempId);
     if($result == NULL ) {
         echo "result error!";
         break;
     }
     if($result->statusCode!=0) {
        // echo "error code :" . $result->statusCode . "<br>";
        // echo "error msg :" . $result->statusMsg . "<br>";
         //TODO 添加错误处理逻辑
     }else{
        // echo "Sendind TemplateSMS success!<br/>";
         // 获取返回信息
         $smsmessage = $result->TemplateSMS;
         //echo "dateCreated:".$smsmessage->dateCreated."<br/>";
        // echo "smsMessageSid:".$smsmessage->smsMessageSid."<br/>";
         //TODO 添加成功处理逻辑
     }
}

//Demo调用
$TempId=(int)$_GET['_TempId'];
if($TempId=='1' || $TempId=='2'||$TempId=='3'){
	//echo 123;
	$Phone=$_GET['date'];
	$temp_model=array( '1' => '24775','2' => '24797', '3' => '24798');
	$str='123456789asdfghjklzxcvbnmqwertyuiop';
	$num=6;
	$CheckNum='';
	for($i=0;$i<$num;$i++){
		$CheckNum.=substr($str,rand(0,32),1);
	}
	$date[]=$CheckNum;
	$date[]=2;
	session_start();
	//sendTemplateSMS($Phone,$date,'24775');
	sendTemplateSMS($Phone,$date,$temp_model[$TempId]);
	$_SESSION['__CheckNum']=$CheckNum;
}
//var_dump($_SESSION['__CheckNum']);
//var_dump($temp_model[$TempId]);
//var_dump($_SESSION['__CheckNum']);


?>
