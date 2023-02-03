
<?php
/**
  * wechat php test
  */

//define your token
// "type":"view",
// "name":"名师计划",
// "url":"http://u.eqxiu.com/s/WI0jln3O"
define("TOKEN", "weixin");

$data = '{
     "button":[
     {	
          "type":"view",
          "name":"找老师",
          "url":"http://9jiujiu.com/products.php"
      },
      {
           "name":"精品文章",
           "sub_button":[
            {
               "type":"click",
               "name":"音乐老师重要性",
               "key":"V1001_HELLO_TW1"
            },
            {
               "type":"click",
               "name":"家长常犯的错误",
               "key":"V1001_HELLO_TW2"
            },
            {
               "type":"click",
               "name":"如何做好宝贝陪练",
               "key":"V1001_HELLO_TW3"
            }]
       },
      {
           "name":"我的服务",
           "sub_button":[
            {
               "type":"view",
               "name":"我的订单",
               "url":"http://9jiujiu.com/account.php?module=orders&act=prelist#contents"
            },
            {
               "type":"view",
               "name":"老师入驻",
               "url":"http://9jiujiu.com/account.php?module=create&type=teacher"
            },
            {
               "type":"view",
               "name":"学员注册",
               "url":"http://9jiujiu.com/account.php?module=create&type=parent"
            }]
       }
       ]
 }';

 $data = '{
     "button":[
     {  
          "type":"view",
          "name":"找老师",
          "url":"http://9jiujiu.com/weixin/web/products.php"
      },
      {
          "type":"view",
          "name":"视频教学",
          "url":"http://9jiujiu.com/mobile/subchannel.php"
       },
      {
           "name":"我的服务",
           "sub_button":[
            {
               "type":"view",
               "name":"我的订单",
               "url":"http://9jiujiu.com/account.php"
            },
            {
               "type":"view",
               "name":"老师入驻",
               "url":"http://9jiujiu.com/account.php?module=create&type=teacher"
            },
            {
               "type":"view",
               "name":"学员注册",
               "url":"http://9jiujiu.com/account.php?module=create&type=parent"
            },
            {
               "type":"view",
               "name":"九啾啾微店",
               "url":"http://weidian.com/?userid=847575828&wfr=!app!847575828!1449800991620_340691!1450261343329"
            }
            ]
       }
       ]
 }';

$wechatObj = new wechatCallbackapiTest();
$wechatObj->post($wechatObj->get_access_token(), $data);
//$wechatObj->responseMsg();
//$wechatObj->get_access_token();


class wechatCallbackapiTest
{
	public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }
	
	public function get_access_token(){  
        $json=$this->http_request_json("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxf2bd74751985d977&secret=ae52e6534d31e74ba950e2db5e016842");  
        $data=json_decode($json,true);  
        if($data['access_token']){  
            return $data['access_token'];  
        }else{  
            return "获取access_token错误";  
        }         
    }  
	
    public function http_request_json($url){    
        $ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL, $url);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
        $result = curl_exec($ch);  
        curl_close($ch);  
        return $result;    
    }  
	
	public function post($token, $jsonData){
		echo $token;
		
		
		$MENU_URL = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$token;
		
		$ch = curl_init() ;
		curl_setopt($ch, CURLOPT_URL, $MENU_URL);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch) ;
		
		
		if (curl_errno($ch)) {
			echo 'Error'.curl_error($ch);
		}
		
		curl_close($ch) ;
		
		echo $result;
		
		return $result;
	}

}
?>
