<?php

/*
 * @file    quickpay_service.inc.php
 * @author  fengmin(felix021@gmail.com)
 * @date    2011-08-22
 * @version $Revision$
 *
 */
$payment_method_row=$lydb->get_one('payment_method', "{$C['d']['query_where']} and IsInvocation=1 and Name='银联在线'");
!$payment_method_row && Js::js_location('/cart.html?module=complete&OId='.$OId);
$unionpay_config=@unserialize($payment_method_row['ExtVar']);

define('_UnionPay_merId_', $unionpay_config['merId'][1]);
define('_UnionPay_Key_', $unionpay_config['security_key'][1]);

$data=array();
/*if($unionpay_config['unionpay_service_type'][1]==0){
	$data['front']	= "http://58.246.226.99/UpopWeb/api/Pay.action";
	$data['back']	= "http://58.246.226.99/UpopWeb/api/BSPay.action";
	$data['query']	= "http://58.246.226.99/UpopWeb/api/Query.action";
}else*/
if($unionpay_config['unionpay_service_type'][1]==1){
	$data['front']	= "https://www.epay.lxdns.com/UpopWeb/api/Pay.action";
	$data['back']	= "https://www.epay.lxdns.com/UpopWeb/api/BSPay.action";
	$data['query']	= "https://www.epay.lxdns.com/UpopWeb/api/Query.action";
}elseif($unionpay_config['unionpay_service_type'][1]==2){
	$data['front']	= "https://unionpaysecure.com/api/Pay.action";
	$data['back']	= "https://besvr.unionpaysecure.com/api/BSPay.action";
	$data['query']	= "https://query.unionpaysecure.com/api/Query.action";
}
define('__front_pay_url__', $data['front']);
define('__back_pay_url__', $data['back']);
define('__query_url__', $data['query']);

class quickpay_conf
{
	
    const VERIFY_HTTPS_CERT = false;

    static $timezone        = "Asia/Shanghai"; //时区
    static $sign_method     = "md5"; //摘要算法，目前仅支持md5 (2011-08-22)

    static $security_key    = _UnionPay_Key_;//"88888888"; //商户密钥	ERY645YTFT5RUIRT45U6Y347U35RU6RUYT	$security_key_config;//

    //支付请求预定义字段
    static $pay_params  = array(
        'version'       => '1.0.0',
        'charset'       => 'UTF-8', //UTF-8, GBK等
        'merId'         => _UnionPay_merId_,//'105550149170027', //商户填写		301440148990009
        'acqCode'       => '',  //收单机构填写
        'merCode'       => '',  //收单机构填写
        'merAbbr'       => 'MSDSCUPOP',
    );

    //* 测试环境
//    static $front_pay_url   = "http://58.246.226.99/UpopWeb/api/Pay.action";
//    static $back_pay_url    = "http://58.246.226.99/UpopWeb/api/BSPay.action";
//    static $query_url       = "http://58.246.226.99/UpopWeb/api/Query.action";

    //* 预上线环境
//    static $front_pay_url   = "https://www.epay.lxdns.com/UpopWeb/api/Pay.action";
//    static $back_pay_url    = "https://www.epay.lxdns.com/UpopWeb/api/BSPay.action";
//    static $query_url       = "https://www.epay.lxdns.com/UpopWeb/api/Query.action";
    

    //* 线上环境
//    static $front_pay_url   = "https://unionpaysecure.com/api/Pay.action";
//    static $back_pay_url    = "https://besvr.unionpaysecure.com/api/BSPay.action";
//    static $query_url       = "https://query.unionpaysecure.com/api/Query.action";
    //*/

    static $front_pay_url   = __front_pay_url__;
    static $back_pay_url    = __back_pay_url__;
    static $query_url       = __query_url__;

  
    const FRONT_PAY = 1;
    const BACK_PAY  = 2;
    const RESPONSE  = 3;
    const QUERY     = 4;

    const CONSUME                = "01";
    const CONSUME_VOID           = "31";
    const PRE_AUTH               = "02";
    const PRE_AUTH_VOID          = "32";
    const PRE_AUTH_COMPLETE      = "03";
    const PRE_AUTH_VOID_COMPLETE = "33";
    const REFUND                 = "04";
    const REGISTRATION           = "71";

    const CURRENCY_CNY      = "156";

    //支付请求可为空字段（但必须填写）
    static $pay_params_empty = array(
        "origQid"           => "",
        "acqCode"           => "",
        "merCode"           => "",
        "commodityUrl"      => "",
        "commodityName"     => "",
        "commodityUnitPrice"=> "",
        "commodityQuantity" => "",
        "commodityDiscount" => "",
        "transferFee"       => "",
        "customerName"      => "",
        "defaultPayType"    => "",
        "defaultBankNumber" => "",
        "transTimeout"      => "",
        "merReserved"       => "",
    );

    //支付请求必填字段检查
    static $pay_params_check = array(
        "version",
        "charset",
        "transType",
        "origQid",
        "merId",
        "merAbbr",
        "acqCode",
        "merCode",
        "commodityUrl",
        "commodityName",
        "commodityUnitPrice",
        "commodityQuantity",
        "commodityDiscount",
        "transferFee",
        "orderNumber",
        "orderAmount",
        "orderCurrency",
        "orderTime",
        "customerIp",
        "customerName",
        "defaultPayType",
        "defaultBankNumber",
        "transTimeout",
        "frontEndUrl",
        "backEndUrl",
        "merReserved",
    );

    //查询请求必填字段检查
    static $query_params_check = array(
        "version",
        "charset",
        "transType",
        "merId",
        "orderNumber",
        "orderTime",
        "merReserved",
    );

    //商户保留域可能包含的字段
    static $mer_params_reserved = array(
    //  NEW NAME            OLD NAME
        "cardNumber",       "pan",
        "cardPasswd",       "password",
        "credentialType",   "idType",
        "cardCvn2",         "cvn",
        "cardExpire",       "expire",
        "credentialNumber", "idNo",
        "credentialName",   "name",
        "phoneNumber",      "mobile",
        "merAbstract",

        //tdb only
        "orderTimeoutDate",
        "origOrderNumber",
        "origOrderTime",
    );

    static $notify_param_check = array(
        "version",
        "charset",
        "transType",
        "respCode",
        "respMsg",
        "respTime",
        "merId",
        "merAbbr",
        "orderNumber",
        "traceNumber",
        "traceTime",
        "qid",
        "orderAmount",
        "orderCurrency",
        "settleAmount",
        "settleCurrency",
        "settleDate",
        "exchangeRate",
        "exchangeDate",
        "cupReserved",
        "signMethod",
        "signature",
    );

    static $sign_ignore_params = array(
        "bank",
    );
}

?>