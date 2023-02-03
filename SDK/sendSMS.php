<?php
include("CCPRestSDK.php");
include("sms_config.php");
/**
 * 短信调用发送类
 *
 */
class sendSMS{
	/**
	  * 发送模板短信
	  * @param to 手机号码集合,用英文逗号分开
	  * @param datas 内容数据 格式为数组 例如：array('Marry','Alon')，如不需替换请填 null
	  * @param $tempId 模板Id
	  */       
	function sendCurSMS($to,$datas,$tempId){
		 // 初始化REST SDK
		 global $accountSid,$accountToken,$appId,$serverIP,$serverPort,$softVersion;
		 $rest = new REST($serverIP,$serverPort,$softVersion);
		 $rest->setAccount($accountSid,$accountToken);
		 $rest->setAppId($appId);
		
		 // 发送模板短信
		 $result = $rest->sendTemplateSMS($to,$datas,$tempId);
		 if($result == NULL ) {
			 echo "result error!";
			 break;
		 }
		 if($result->statusCode!=0) {
			//TODO 添加错误处理逻辑
		 }else{
			 // 获取返回信息
			 $smsmessage = $result->TemplateSMS;
			 //TODO 添加成功处理逻辑
		 }
	}
}
?>