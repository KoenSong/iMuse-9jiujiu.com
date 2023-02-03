<?
class Wechat
 {
 private function getAccessToken() //获取access_token
 {
 $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".AppId."&secret=".AppSecret;
 $data = getCurl($url);//通过自定义函数getCurl得到https的内容
 $resultArr = json_decode($data, true);//转为数组
 return $resultArr["access_token"];//获取access_token
 }
public function creatMenu()//创建菜单
 {
 //$accessToken = $this->getAccessToken();//获取access_token
 $accessToken = "44dw1vzIDq7sHyNI9y46cQuLIOD0btfHNOsZlZRig7GnLkVCp-ZzUt5FPWEGwyK4P1uEBdZ39LZMtv7RMAyUZESRKD7BaTBDN9utQ3jHZX8";
 $menuPostString = '{//构造POST给微信服务器的菜单结构体
 "button":[
      {
           "name":"产品介绍",
           "sub_button":[
           {
               "type":"view",
               "name":"分销A型",
               "url":"http://www.027099.com/fenxiao/jianjie/soft.html"
            },
			{
               "type":"view",
               "name":"分销B型",
               "url":"http://www.027099.com/fenxiaob/jianjie/soft.html"
            },{
               "type":"view",
               "name":"地接批发",
               "url":"http://www.027099.com/dijie/jianjie/soft.html"
            },{
               "type":"view",
               "name":"精简组团",
               "url":"http://www.027099.com/zutuan/jianjie/soft.html"
            },{
               "type":"view",
               "name":"直客网站",
               "url":"http://www.027099.com/tripal/jianjie/soft.html"
            }]
       },
      {
           "name":"申请试用",
           "sub_button":[
            {
               "type":"click",
               "name":"分销A型",
               "key":"fxa"
            },
            {
               "type":"click",
               "name":"分销B型",
               "key":"fxb"
            },
			{
               "type":"click",
               "name":"地接批发",
               "key":"dj"
            },
			{
               "type":"click",
               "name":"精简组团",
               "key":"zutuan"
            },
			{
               "type":"click",
               "name":"直客网站",
               "key":"zhike"
            }
			]
       },
	  	   {
           "name":"博纵在线",
           "sub_button":[
            {
               "type":"view",
               "name":"企业介绍",
               "url":"http://www.027099.com/about.html"
            },
            {
               "type":"view",
               "name":"公司新闻",
               "url":"http://www.027099.com/news/company/"
            },
			{
               "type":"view",
               "name":"联系我们",
               "url":"http://www.027099.com/contact.html"
            }
			]
       } 
	   
	   
	   ]
 }';
 $menuPostUrl = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$accessToken;//POST的url
 $menu = dataPost($menuPostString, $menuPostUrl);//将菜单结构体POST给微信服务器
 }
 }
 function getCurl($url){//get https的内容
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL,$url);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);//不输出内容
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
 $result =  curl_exec($ch);
 curl_close ($ch);
 return $result;
 }
function dataPost($post_string, $url) {//POST方式提交数据
 $context = array ('http' => array ('method' => "POST", 'header' => "User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US) \r\n Accept: */*", 'content' => $post_string ) );
 $stream_context = stream_context_create ( $context );
 $data = file_get_contents ( $url, FALSE, $stream_context );
 return $data;
 }
 ?>