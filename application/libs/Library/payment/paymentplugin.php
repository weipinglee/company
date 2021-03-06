<?php
namespace Library\payment;
use Library\url;

/**
 * @file paymentplugin.php
 * @brief 支付插件基类
 * @author
 * @date 2013/5/7 20:07:59
 * @version 1.0.0
 */

/**
 * @class PaymentPlugin
 * @brief 支付插件抽象类
 */
abstract class paymentPlugin {
	public $method = "post";//表单提交模式
	public $name = null;//支付插件名称
	public $version = 1.0;//版本
	public $callbackUrl = '';//支付完成后，同步回调地址
	public $serverCallbackUrl = '';//异步通知地址
	public $merchantCallbackUrl = '';//支付中断返回
	public $serverCallbackUrlForRefund = '';

	/**
	 * @brief 构造函数
	 * @param $payment_id 支付方式ID
	 */
	public function __construct($payment_id) {
		//回调函数地址
		$this->callbackUrl = url::createUrl("/index/rechargeCallbackAction/?id=" . $payment_id);

		//回调业务处理地址
		$this->serverCallbackUrl = url::createUrl("/index/serverCallbackAction/?id=" . $payment_id);
		/*//退款回调地址
	$this->serverCallbackUrlForRefund = url::getHost() . url::createUrl("/block/server_callback_refund/?_id=" . $payment_id);
	//中断支付返回
	$this->merchantCallbackUrl = url::getHost() . url::createUrl("/block/merchant_callback/?_id=" . $payment_id);
	//合并支付同步回调地址
	$this->callbackUrlMerge = url::getHost() . url::createUrl("/block/callback_merge/?_id=" . $payment_id);
	//合并支付异步回调地址
	$this->serverCallbackUrlMerge = url::getHost() . url::createUrl("/block/server_callback_merge/?_id=" . $payment_id);*/
	}

	/**
	 * @brief 开始支付
	 */
	public function doPay($sendData) {

		echo <<< OEF
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
			<head></head>
			<body>
				<p>please wait...</p>
				<form action="{$this->getSubmitUrl()}" method="{$this->method}">
OEF;
		foreach ($sendData as $key => $item) {
			echo <<< OEF
					<input type='hidden' name='{$key}' value='{$item}' />
OEF;
		}
		echo <<< OEF
				</form>
			</body>
			<script type='text/javascript'>
				window.document.forms[0].submit();
			</script>
		</html>
OEF;
	}

	/**
	 * @开始退款
	 * @param array $sendData 上传报文
	 */

	/**
	 * 添加一条交易记录
	 * @$tradeData array 插入的记录
	 * @$orderNo 订单号
	 */
/*	public static function addTrade($tradeData) {
$orderNo = $tradeData['order_no'];
if (stripos($orderNo, 'recharge') !== false) {
$tradeData['order_type'] = 0;//充值
$tradeData['order_no'] = str_replace('recharge', '', $orderNo);

} else {
$tradeData['order_type'] = 1;//消费
$tradeData['order_no'] = $orderNo;
}

$tradeDB = new IModel('trade_record');

$tradeDB->setData($tradeData);
if (!$tradeData['pay_type'] || !$tradeData['trade_no']) {
return false;
}

$where = 'pay_type=' . $tradeData['pay_type'] . ' and trade_no = "' . $tradeData['trade_no'] . '"';
if ($tradeDB->getObj($where, 'id')) {
if ($tradeData['trade_status'] == 1) {
$tradeDB->update($where);
}
return true;
}
if ($tradeDB->add()) {
return true;
}

return false;
}*/
	/**
	 * 获取交易类型1：消费，2：退款
	 * @$paymentId int  支付类型：银联，担保交易等
	 * @$code str   交易类型码
	 */
	public static function getTradeType($paymentId, $code = '01') {
		if ($paymentId == 3) {
//银联支付
			switch ($code) {
				case '01':{
						return 1;
					}
				case '04':{
						return 2;
					}
			}
		}
		if ($paymentId == 7) {
			return 1;
		}

		return 1;
	}
	/**
	 * @brief 返回配置参数
	 */
	public function configParam() {
		return array(
			'M_PartnerId' => '商户ID号',
			'M_PartnerKey' => '商户KEY密钥',
		);
	}

	/**
	 * 异步通知停止
	 */
	abstract public function notifyStop();

	/**
	 * 获取提交地址
	 * @return string Url提交地址
	 */
	abstract public function getSubmitUrl();

	/**
	 * 获取退款提交地址
	 */
	abstract public function getRefundUrl();
	/**
	 * 获取要发送的数据数组结构
	 * @param $payment array 要传递的支付信息
	 * @return array
	 */
	abstract public function getSendData($paymentInfo);

	/**
	 * 获取要退款的数据信息
	 *  @param $payment array 要传递的支付信息
	 * 	@return array
	 */
	//abstract public function getSendDataForRefund($payment);

	/**
	 * 同步支付回调
	 * @param $ExternalData array  支付接口回传的数据
	 * @param $paymentId    int    支付接口ID
	 * @param $money        float  交易金额
	 * @param $message      string 信息
	 * @param $orderNo      string 订单号
	 */
	abstract public function callback($ExternalData, &$paymentId, &$money, &$message, &$orderNo);

	/**
	 * 同步支付回调
	 * @param $ExternalData array  支付接口回传的数据
	 * @param $paymentId    int    支付接口ID
	 * @param $money        float  交易金额
	 * @param $message      string 信息
	 * @param $orderNo      string 订单号
	 */
	abstract public function serverCallback($ExternalData, &$paymentId, &$money, &$message, &$orderNo);

	public function refund($payment) {}
}