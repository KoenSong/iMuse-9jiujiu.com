<?php
/**
  * wechat php test
  */

//define your token
//define(AppId, "wx666cae44xxxxxx2");//定义AppId，需要在微信公众平台申请自定义菜单后会得到
 
//define(AppSecret, "d77026a714d443a01d0229xxxxxxxx");//定义AppSecret，需要在微信公众平台申请自定义菜单后会得到
 
define("TOKEN", "jiujiu");
$wechatObj = new wechatCallbackapi();
//$wechatObj->valid();
$wechatObj->responseMsg();



class wechatCallbackapi
{
	public function valid()
    {
		header('content-type:text');
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }

    public function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

      	//extract post data
		if (!empty($postStr)){
                /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
                   the best way is to check the validity of xml by yourself */
                libxml_disable_entity_loader(true);
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
				$type = $postObj->MsgType;
				$customevent = $postObj->Event;
				$customeventkey = $postObj->EventKey;
				$locationX = $postObj->Location_X;//纬度
				$locationY = $postObj->Location_Y;//经度
				
                $keyword = trim($postObj->Content);
                $time = time();
                //客服
                $kfTpl = "<xml>
     					  <ToUserName><![CDATA[%s]]></ToUserName>
     					  <FromUserName><![CDATA[%s]]></FromUserName>
						  <CreateTime>%s</CreateTime>
     					  <MsgType><![CDATA[transfer_customer_service]]></MsgType>
 						  </xml>";
				//普通消息体
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
				//音乐消息体
				$musicTextTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Music>
							<Title><![CDATA[逢いたい…]]></Title>
							<Description><![CDATA[逢いたい… - YU-A]]></Description>
							<MusicUrl><![CDATA[http://bcs.duapp.com/projectd/-.mp3]]></MusicUrl>
							<HQMusicUrl><![CDATA[http://bcs.duapp.com/projectd/-.mp3]]></HQMusicUrl>
							</Music>
							<FuncFlag>0</FuncFlag>
							</xml>";
				//图文消息体
				/*$newsTextTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[news]]></MsgType>
							<ArticleCount>2</ArticleCount>
							<Articles>
							<item>
							<Title><![CDATA[匪徒gangsta]]></Title> 
							<Description><![CDATA[简介：GANGSTA,是日本漫画家コースケ所著的青年漫画。]]></Description>
							<PicUrl><![CDATA[http://9jiujiu.com/weixin/images/Gangsta_0.jpg]]></PicUrl>
							<Url><![CDATA[http://9jiujiu.com/weixin/images/Gangsta_0.jpg]]></Url>
							</item>
							<item>
							<Title><![CDATA[内容介绍]]></Title>
							<Description><![CDATA[GANGSTA匪徒 漫画 ，黑帮、妓女、黑警…有条叫艾尔盖斯托姆的黑街，是这类人盘踞的地方。]]></Description>
							<PicUrl><![CDATA[http://9jiujiu.com/weixin/images/Gangsta_3.jpg]]></PicUrl>
							<Url><![CDATA[http://9jiujiu.com/weixin/images/Gangsta_3.jpg]]></Url>
							</item>
							</Articles>
							</xml> ";*/
				//图文消息体
				$newsTextTp1 = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[news]]></MsgType>
							<ArticleCount>1</ArticleCount>
							<Articles>
							<item>
							<Title><![CDATA[音乐老师在教学中起到什么样的作用]]></Title> 
							<Description><![CDATA[随着教学课程改的不断深入和推进，音乐老师的教学水平、艺术涵养、知识素质、业务素质、能力等，都在不断地进化与提升。]]></Description>
							<PicUrl><![CDATA[http://9jiujiu.com/weixin/images/tw1.png]]></PicUrl>
							<Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MzA5NDcwNjU3OA==&mid=204456287&idx=1&sn=4234e21de0107638969562c2fc96a3b8&scene=18#rd/]]></Url>
							</item>
							</Articles>
							</xml> ";
				$newsTextTp2 = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[news]]></MsgType>
							<ArticleCount>1</ArticleCount>
							<Articles>
							<item>
							<Title><![CDATA[家长常犯的错误]]></Title> 
							<Description><![CDATA[感谢关注，九啾啾是国内首家音乐教师预约平台，我们将尽我们最大的努力为您找到优质的音乐老师。孩子到一定年龄的时]]></Description>
							<PicUrl><![CDATA[http://9jiujiu.com/weixin/images/tw2.png]]></PicUrl>
							<Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MzA5NDcwNjU3OA==&mid=204670128&idx=1&sn=f0456526782a1fed73a3dec90b9415cc&scene=18#rd/]]></Url>
							</item>
							</Articles>
							</xml> ";
				$newsTextTp3 = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[news]]></MsgType>
							<ArticleCount>1</ArticleCount>
							<Articles>
							<item>
							<Title><![CDATA[不懂钢琴的家长 如何做好宝贝的陪练？]]></Title> 
							<Description><![CDATA[学琴不止是宝贝自己的事情，家长如果可以很好地参与其中，也能更大程度调动宝贝的积极性]]></Description>
							<PicUrl><![CDATA[http://9jiujiu.com/weixin/images/tw3.jpg]]></PicUrl>
							<Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MzA5NDcwNjU3OA==&mid=204891003&idx=1&sn=ced35d5fd0b9232dcdfc122ac5188b6c&scene=18#rd/]]></Url>
							</item>
							</Articles>
							</xml> ";
				$newsTextTp4 = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[news]]></MsgType>
							<ArticleCount>1</ArticleCount>
							<Articles>
							<item>
							<Title><![CDATA[吉他教学入门 第七课 兰花草 吉他谱]]></Title> 
							<Description><![CDATA[吉他教学入门 第七课 兰花草 吉他谱]]></Description>
							<PicUrl><![CDATA[http://9jiujiu.com/weixin/images/lanhuachao.jpg]]></PicUrl>
							<Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MzA5NDcwNjU3OA==&mid=401057749&idx=1&sn=534e2ad39595108e2ffcedab727b941b#rd/]]></Url>
							</item>
							</Articles>
							</xml> ";
				$newsTextTp5 = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[news]]></MsgType>
							<ArticleCount>1</ArticleCount>
							<Articles>
							<item>
							<Title><![CDATA[小蜜蜂 吉他谱 吉他教学入门 第十二课]]></Title> 
							<Description><![CDATA[小蜜蜂 吉他谱 吉他教学入门 第十二课]]></Description>
							<PicUrl><![CDATA[http://9jiujiu.com/weixin/images/bee.jpg]]></PicUrl>
							<Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MzA5NDcwNjU3OA==&mid=401251657&idx=1&sn=31102155cee48e05d47cd7447146b84d#rd/]]></Url>
							</item>
							</Articles>
							</xml> ";
				$newsTextTp6 = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[news]]></MsgType>
							<ArticleCount>1</ArticleCount>
							<Articles>
							<item>
							<Title><![CDATA[南山南 吉他谱 中国好声音张磊版 全网最原版的版本]]></Title> 
							<Description><![CDATA[南山南 吉他谱 中国好声音张磊版 全网最原版的版本]]></Description>
							<PicUrl><![CDATA[http://9jiujiu.com/weixin/images/nsn.jpg]]></PicUrl>
							<Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MzA5NDcwNjU3OA==&mid=401257573&idx=1&sn=3feeab18b91fc82d1e400db7211ee522#rd/]]></Url>
							</item>
							</Articles>
							</xml> ";
				$newsTextTp7 = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[news]]></MsgType>
							<ArticleCount>1</ArticleCount>
							<Articles>
							<item>
							<Title><![CDATA[我真的受伤了 吉他谱 精编版 带间奏]]></Title> 
							<Description><![CDATA[我真的受伤了 吉他谱 精编版 带间奏]]></Description>
							<PicUrl><![CDATA[http://9jiujiu.com/weixin/images/shoushang.jpg]]></PicUrl>
							<Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MzA5NDcwNjU3OA==&mid=401293941&idx=1&sn=8352de60dcbf5fc490d644349f2e8a82#rd/]]></Url>
							</item>
							</Articles>
							</xml> ";
				$newsTextTp8 = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[news]]></MsgType>
							<ArticleCount>2</ArticleCount>
							<Articles>
							<item>
							<Title><![CDATA[小幸运 钢琴谱]]></Title> 
							<Description><![CDATA[小幸运 钢琴谱]]></Description>
							<PicUrl><![CDATA[http://9jiujiu.com/weixin/images/xiaoxingyun.jpg]]></PicUrl>
							<Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MzA5NDcwNjU3OA==&mid=401293307&idx=1&sn=679b68d5c29eebebf202f8411db0284e#rd/]]></Url>
							</item>
							<item>
							<Title><![CDATA[小幸运 吉他谱]]></Title> 
							<Description><![CDATA[小幸运 吉他谱]]></Description>
							<PicUrl><![CDATA[http://9jiujiu.com/weixin/images/xxy_jt.jpg]]></PicUrl>
							<Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MzA5NDcwNjU3OA==&mid=401544724&idx=1&sn=7d44da142e154cc29f0175524bf16a6b#rd/]]></Url>
							</item>
							</Articles>
							</xml> ";
				$newsTextTp9 = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[news]]></MsgType>
							<ArticleCount>1</ArticleCount>
							<Articles>
							<item>
							<Title><![CDATA[滴答 吉他谱]]></Title> 
							<Description><![CDATA[滴答 吉他谱]]></Description>
							<PicUrl><![CDATA[http://9jiujiu.com/weixin/images/dd.jpg]]></PicUrl>
							<Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MzA5NDcwNjU3OA==&mid=401548411&idx=1&sn=1e1ab67756751b16e49e6bc073452283#rd/]]></Url>
							</item>
							</Articles>
							</xml> ";
				$newsTextTp10 = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[news]]></MsgType>
							<ArticleCount>1</ArticleCount>
							<Articles>
							<item>
							<Title><![CDATA[一次就好 吉他谱 完整版]]></Title> 
							<Description><![CDATA[一次就好 吉他谱 完整版]]></Description>
							<PicUrl><![CDATA[http://9jiujiu.com/weixin/images/ycjh.jpg]]></PicUrl>
							<Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MzA5NDcwNjU3OA==&mid=401548494&idx=1&sn=fab570326e7d325709c5e955ffe4425f#rd/]]></Url>
							</item>
							</Articles>
							</xml> ";
				$newsTextTp11 = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[news]]></MsgType>
							<ArticleCount>1</ArticleCount>
							<Articles>
							<item>
							<Title><![CDATA[好想你 吉他谱 完整版]]></Title> 
							<Description><![CDATA[好想你 吉他谱 完整版]]></Description>
							<PicUrl><![CDATA[http://9jiujiu.com/weixin/images/hxn.jpg]]></PicUrl>
							<Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MzA5NDcwNjU3OA==&mid=401701779&idx=1&sn=ab738a8fa2482b31a0ca09ce61eb6255#rd/]]></Url>
							</item>
							</Articles>
							</xml> ";
				$newsTextTp12 = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[news]]></MsgType>
							<ArticleCount>1</ArticleCount>
							<Articles>
							<item>
							<Title><![CDATA[少年锦时 吉他谱 完整版]]></Title> 
							<Description><![CDATA[少年锦时 吉他谱 完整版]]></Description>
							<PicUrl><![CDATA[http://9jiujiu.com/weixin/images/snjs.jpg]]></PicUrl>
							<Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MzA5NDcwNjU3OA==&mid=401975611&idx=1&sn=e89d679815c099584bc679816ddaa167#rd/]]></Url>
							</item>
							</Articles>
							</xml> ";
				//事件推送：关注
				if($type == "event" and $customevent == "subscribe"){
					$msgType = "text";
					$contentStr = "欢迎订阅，九啾啾微信公众平台，最好的音乐老师都在这里！";
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
				}
				//菜单点击
				if($type == "event" and $customevent == "CLICK"){
					switch($customeventkey){
						case "V1001_HELLO_TW1":
							$msgType = "news";
							$resultStr = sprintf($newsTextTp1, $fromUsername, $toUsername, $time);
							echo $resultStr;
							break;
						case "V1001_HELLO_TW2":
							$msgType = "news";
							$resultStr = sprintf($newsTextTp2, $fromUsername, $toUsername, $time);
							echo $resultStr;
							break;
						case "V1001_HELLO_TW3":
							$msgType = "news";
							$resultStr = sprintf($newsTextTp3, $fromUsername, $toUsername, $time);
							echo $resultStr;
							break;
						case "V1001_HELLO_KF":
							$resultStr = sprintf($kfTpl, $fromUsername, $toUsername, $time);
							echo $resultStr;
							break;
						default:
							break;
					}
					
				}
				//图片推送
				if($type == "image"){	
					$msgType = "text";
					$contentStr = "你的图片不错哦！";
					$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
				}
				//地理位置
				if($type == "location"){
					$msgType = "text";
					//$contentStr = "你的经度为：{$locationX},你的纬度为：{$locationY},我已经锁定了。";
					$contentStr = "你的经度为：$locationX,你的纬度为：$locationY,我已经锁定了。";
					$shopLocationX = 23.146428;
					$shopLocationY = 113.368686;
					//所在位置
					/*
					//$geourl = "http://api.map.baidu.com/telematics/v3/reverseGeocoding?location={$locationY},{$locationX}&coord_type=gcj02&ak=1345423d017e258273b195e795a9cc32";
					//$geourl = "http://api.map.baidu.com/telematics/v3/reverseGeocoding?location={$shopLocationY},{$shopLocationX}&coord_type=gcj02&ak=1345423d017e258273b195e795a9cc32";
					$apistr = file_get_contents($geourl);//读取文件
					$apiobj = simplexml_load_string($apistr);//xml解析
					$addstr = $apiobj->results->result[0]->name;
					$contentStr = "你的经度为：{$locationX},你的纬度为：{$locationY},你的位置在{$addstr}附近。";
					*/
					//两点测距
					$geourl = "http://api.map.baidu.com/telematics/v3/distance?waypoints={$shopLocationY},{$shopLocationX};{$locationY},{$locationX}&ak=1345423d017e258273b195e795a9cc32";
					$apistr = file_get_contents($geourl);
					$apiobj = simplexml_load_string($apistr);
					$distanceObj = $apiobj->results->distance;
					$distanceint = intval($distanceObj);
					$distance = $distanceint / 1000;
					$contentStr = "你当前位置距离华景新城店，为：${distance}公里。";
					$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
				}
				//语音
				if($type == "voice"){
					$msgType = "text";
					$contentStr = "帅哥，美女你们语音我们收到咯，请静候回复！";
					$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
				}
				//超链接
				if($type == "link"){
					$msgType = "text";
					$contentStr = "你的链接，我已经接受了";
					$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
				}		
            	//消息推送
				if(!empty( $keyword )){
              		$msgType = "text";
                    //自动回复消息
                	$contentStr = "欢迎关注九啾啾微信公众平台，最好的音乐老师都在这里！";
                    //关键字回复
                    if($keyword == "1"){
						$msgType = "text";
                        $contentStr = "/:rose/:rose/:rose/:rose/:rose";
                    }
					//音乐回复
					if(strcasecmp($keyword,"m") == 0){
						$msgType = "music";
						$resultStr = sprintf($musicTextTpl, $fromUsername, $toUsername, $time, $msgType);
						echo $resultStr;
					}
					//图文回复
					if(strcasecmp($keyword,"tw") == 0){
						$msgType = "news";
						$resultStr = sprintf($newsTextTpl, $fromUsername, $toUsername, $time);
						echo $resultStr;
					}
					//客服
					if($keyword == "客服"){
						$resultStr = sprintf($kfTpl, $fromUsername, $toUsername, $time);
						echo $resultStr;
					}
					//乐谱
					if($keyword == "兰花草"){
						$msgType = "news";
                        $contentStr = "/:rose/:rose/:rose/:rose/:rose";
                        $resultStr = sprintf($newsTextTp4, $fromUsername, $toUsername, $time);
                        echo $resultStr;
                    }
                    if($keyword == "小蜜蜂"){
						$msgType = "news";
                        $contentStr = "/:rose/:rose/:rose/:rose/:rose";
                        $resultStr = sprintf($newsTextTp5, $fromUsername, $toUsername, $time);
                        echo $resultStr;
                    }
                    if($keyword == "南山南"){
						$msgType = "news";
                        $contentStr = "/:rose/:rose/:rose/:rose/:rose";
                        $resultStr = sprintf($newsTextTp6, $fromUsername, $toUsername, $time);
                        echo $resultStr;
                    }
                    if($keyword == "我真的受伤了"){
						$msgType = "news";
                        $contentStr = "/:rose/:rose/:rose/:rose/:rose";
                        $resultStr = sprintf($newsTextTp7, $fromUsername, $toUsername, $time);
                        echo $resultStr;
                    }
                    if($keyword == "小幸运"){
						$msgType = "news";
                        $contentStr = "/:rose/:rose/:rose/:rose/:rose";
                        $resultStr = sprintf($newsTextTp8, $fromUsername, $toUsername, $time);
                        echo $resultStr;
                    }
                    if($keyword == "滴答"){
						$msgType = "news";
                        $contentStr = "/:rose/:rose/:rose/:rose/:rose";
                        $resultStr = sprintf($newsTextTp9, $fromUsername, $toUsername, $time);
                        echo $resultStr;
                    }
                    if($keyword == "一次就好"){
						$msgType = "news";
                        $contentStr = "/:rose/:rose/:rose/:rose/:rose";
                        $resultStr = sprintf($newsTextTp10, $fromUsername, $toUsername, $time);
                        echo $resultStr;
                    }
                    if($keyword == "好想你"){
						$msgType = "news";
                        $contentStr = "/:rose/:rose/:rose/:rose/:rose";
                        $resultStr = sprintf($newsTextTp11, $fromUsername, $toUsername, $time);
                        echo $resultStr;
                    }
                    if($keyword == "少年锦时"){
						$msgType = "news";
                        $contentStr = "/:rose/:rose/:rose/:rose/:rose";
                        $resultStr = sprintf($newsTextTp12, $fromUsername, $toUsername, $time);
                        echo $resultStr;
                    }

					//天气
					if(strcasecmp($keyword,"tq") == 0){
						$msgType = "text";
						$weatherUrl = "http://api.map.baidu.com/telematics/v3/weather?location=广州&output=xml&ak=1345423d017e258273b195e795a9cc32";
						$weatherStr = file_get_contents($weatherUrl);
						$apiObj = simplexml_load_string($weatherStr);
						$pleaseObj = $apiObj->results->currentCity;//当前城市
						$dateObj = $apiObj->results->weather_data->date;//星期
						$weatherObj = $apiObj->results->weather_data->weather;//天气
						$windObj = $apiObj->results->weather_data->wind;//风力
						$temObj = $apiObj->results->weather_data->temperature;//温度
						$contentStr = "{$pleaseObj}，{$dateObj}\n天气{$weatherObj}，风力{$windObj}，温度{$temObj}。\n如果需要知道其他城市天气，可以编辑'tq-广州'来获取。";
					}
					if(stripos($keyword,'tq-') !== false){
						$msgType = "text";
						$city = substr($keyword,3);//截取城市
						$weatherUrl = "http://api.map.baidu.com/telematics/v3/weather?location={$city}&output=xml&ak=1345423d017e258273b195e795a9cc32";
						$weatherStr = file_get_contents($weatherUrl);
						$apiObj = simplexml_load_string($weatherStr);
						$pleaseObj = $apiObj->results->currentCity;//当前城市
						$dateObj = $apiObj->results->weather_data->date;//星期
						$weatherObj = $apiObj->results->weather_data->weather;//天气
						$windObj = $apiObj->results->weather_data->wind;//风力
						$temObj = $apiObj->results->weather_data->temperature;//温度
						$contentStr = "{$pleaseObj}，{$dateObj}\n天气{$weatherObj}，风力{$windObj}，温度{$temObj}。";

					}
                    //小黄鸡（试用7日）
                    if(stripos($keyword,'xhj-') !== false){
                        $msgType = "text";
                        $content = substr($keyword,4);//截取内容
                        $apiUrl = "http://sandbox.api.simsimi.com/request.p?key=7d66eac6-f009-4b4e-8827-cd0444761b90&lc=ch&ft=1.0&text={$content}";
                        $apiStr = file_get_contents($apiUrl);
                        $apiJson = json_decode($apiStr);
                        $contentStr = $apiJson->response;
                    }
                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                	echo $resultStr;
                }else{
                	echo "Input something...";
                }

        }else {
        	echo "";
        	exit;
        }
    }
		
	private function checkSignature()
	{
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
}

?>