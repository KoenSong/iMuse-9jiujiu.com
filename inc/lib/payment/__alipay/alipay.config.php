<?php
/* *
 * 配置文件
 * 版本：3.2
 * 日期：2011-03-25
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。
	
 * 提示：如何获取安全校验码和合作身份者id
 * 1.用您的签约支付宝账号登录支付宝网站(www.alipay.com)
 * 2.点击“商家服务”(https://b.alipay.com/order/myorder.htm)
 * 3.点击“查询合作者身份(pid)”、“查询安全校验码(key)”
	
 * 安全校验码查看时，输入支付密码后，页面呈灰色的现象，怎么办？
 * 解决方法：
 * 1、检查浏览器配置，不让浏览器做弹框屏蔽设置
 * 2、更换浏览器或电脑，重新登录查询。
 */
 
//↓↓↓↓↓↓↓↓↓↓请在这里配置您的基本信息↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
//合作身份者id，以2088开头的16位纯数字
//$aliapy_config['partner']      = '2088021107541373';//'2088402821263594';
$aliapy_config['partner']      = '2088021107541373';

//安全检验码，以数字和字母组成的32位字符
$aliapy_config['key']          = 'v2lyqxyjlhbqxfes3aw52bqgw6kpp80v';//'qbck86l1uvqk3yztxgyqx4z2qtni6qdf';

//签约支付宝账号或卖家支付宝帐户
$aliapy_config['seller_email'] = 'songf@9jiujiu.com';//'121415897@qq.com';

//页面跳转同步通知页面路径，要用 http://格式的完整路径，不允许加?id=123这类自定义参数
//return_url的域名不能写成http://localhost/trade_create_by_buyer_php_utf8/return_url.php ，否则会导致return_url执行无效
$aliapy_config['return_url']   = get_domain(1).'/inc/lib/payment/alipay/return_url.php';

//服务器异步通知页面路径，要用 http://格式的完整路径，不允许加?id=123这类自定义参数
$aliapy_config['notify_url']   = get_domain(1).'/inc/lib/payment/alipay/notify_url.php';

//↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑


//签名方式 不需修改
$aliapy_config['sign_type']    = 'MD5';

//字符编码格式 目前支持 gbk 或 utf-8
$aliapy_config['input_charset']= 'utf-8';

//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
$aliapy_config['transport']    = 'http';

/*$alipay_config=@unserialize($payment_method_row['ExtVar']);

$alipay_partner=$aliapy_config['partner']=$alipay_config['alipay_partner'][1];
$alipay_security_code=$aliapy_config['key']=$alipay_config['alipay_security_code'][1];
$alipay_seller_email=$aliapy_config['seller_email']=$alipay_config['alipay_seller_email'][1];
$alipay_service_type=$alipay_config['alipay_service_type'][1];

$_input_charset=$aliapy_config['input_charset']='utf-8';	//字符编码格式
$sign_type=$aliapy_config['sign_type']='MD5';		//加密方式
$transport=$aliapy_config['transport']='http';	//访问模式,你可以根据自己的服务器是否支持ssl访问而选择http以及https访问模式
$return_url=$aliapy_config['return_url']=get_domain().'/payment_return/alipay/return';	//同步返回地址
$notify_url=$aliapy_config['notify_url']=get_domain().'/payment_return/alipay/notify';	//异步返回地*/

?>