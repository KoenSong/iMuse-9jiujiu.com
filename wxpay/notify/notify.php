<?php
ini_set('date.timezone','Asia/Shanghai');
error_reporting(E_ERROR);

//数据库相关配置
$db_host		=	'localhost';	//数据库地址
$db_port		=	'';				//数据库端口
$db_username	=	'root';			//数据库用户名
$db_database	=	'jiujiu';		//数据库名称
$db_password	=	'gyE4o2rJyl';		//数据库密码
$db_char		=	'utf8';			//数据库编码

require_once ('../../inc/fun/mysql.php');

require_once "../lib/WxPay.Api.php";
require_once '../lib/WxPay.Notify.php';
require_once '../tool/log.php';

//初始化日志
$logHandler= new CLogFileHandler("../../log/wxpay_log/".date('Y-m-d').'.log');
$log = Log::Init($logHandler, 15);

class PayNotifyCallBack extends WxPayNotify
{
	//查询订单
	public function Queryorder($transaction_id)
	{
		$input = new WxPayOrderQuery();
		$input->SetTransaction_id($transaction_id);
		$result = WxPayApi::orderQuery($input);
		Log::DEBUG("query:" . json_encode($result));
		
		if(array_key_exists("return_code", $result)
			&& array_key_exists("result_code", $result)
			&& $result["return_code"] == "SUCCESS"
			&& $result["result_code"] == "SUCCESS")
		{
			//TODO生产订单
			$attachArr = explode("&",$result['attach']);
			$wxOrder = array(
					'transaction_id'	=>	$result['transaction_id'],
					'out_trade_no'		=>	$result['out_trade_no'],
					'openid'			=>	$result['openid'],
					'buyer'				=>	$attachArr[0],
					'phone'				=>	$attachArr[1],
					'end_time'			=>	$result['time_end'],
					'total_fee'			=>	$result['total_fee'],
					'trade_state'		=>	$result['trade_state'],
					'num'				=>	$attachArr[2],
					'is_subscribe'		=>	$result['is_subscribe'],
					'trade_type'		=>	$result['trade_type'],
					'wx_pid'			=>	$attachArr[3]
				);
			global $db;
			try{
				$db->insert('wx_order',$wxOrder);
				Log::DEBUG("###插入数据：transaction_id:".$result['transaction_id']."，用户："
							.$attachArr[0]."，电话：".$attachArr[1]."，购买数：".$attachArr[2]."，产品号：".$attachArr[3]."，金额(分)：".$result['total_fee']);
			}catch(Exception $e){
				Log::DEBUG("transaction_id:".$result['transaction_id']."###插入数据库出错，错误为：".$e);
			}
			return true;
		}
		return false;
	}
	
	//重写回调处理函数
	public function NotifyProcess($data, &$msg)
	{
		Log::DEBUG("call back:" . json_encode($data));
		$notfiyOutput = array();
		
		if(!array_key_exists("transaction_id", $data)){
			$msg = "输入参数不正确";
			return false;
		}
		//查询订单，判断订单真实性
		if(!$this->Queryorder($data["transaction_id"])){
			$msg = "订单查询失败";
			return false;
		}
		return true;
	}
}

Log::DEBUG("begin notify");
$notify = new PayNotifyCallBack();
$notify->Handle(false);
