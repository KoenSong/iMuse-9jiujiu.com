<?php 
    /** 
    * @author: vfhky 20130304 20:10 
    * @description: PHP调用百度短网址API接口 
    *     * @param string $type: 非零整数代表长网址转短网址,0表示短网址转长网址 
    */ 
    function bdUrlAPI($type, $url){ 
    if($type) 
    $baseurl = 'http://dwz.cn/create.php'; 
    else 
    $baseurl = 'http://dwz.cn/query.php'; 
    $ch=curl_init(); 
    curl_setopt($ch,CURLOPT_URL,$baseurl); 
    curl_setopt($ch,CURLOPT_POST,true); 
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true); 
    if($type) 
    $data=array('url'=>$url); 
    else 
    $data=array('tinyurl'=>$url); 
    curl_setopt($ch,CURLOPT_POSTFIELDS,$data); 
    $strRes=curl_exec($ch); 
    curl_close($ch); 
    $arrResponse=json_decode($strRes,true); 
    if($arrResponse['status']!=0) 
    { 
    echo 'ErrorCode: ['.$arrResponse['status'].'] ErrorMsg: ['.iconv('UTF-8','GBK',$arrResponse['err_msg'])."]<br/>"; 
    return 0; 
    } 
    if($type) 
    return $arrResponse['tinyurl']; 
    else 
    return $arrResponse['longurl']; 
    } 
    //echo '<br/><br/>----------百度短网址API----------<br/><br/>'; 
    //echo 'Long to Short: '.bdUrlAPI(1, 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxf2bd74751985d977&redirect_uri=http://9jiujiu.com/weixin/oauth2.php?memberid=117&response_type=code&scope=snsapi_base&state=1#wechat_redirect').'<br/>'; 
    //echo 'Short to Long: '.bdUrlAPI(0, 'http://dwz.cn/1YrwXR').'<br/><br/>'; 
?>  