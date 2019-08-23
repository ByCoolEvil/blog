<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AliPayController extends Controller
{
    public $app_id;
    public $gate_way;
    public $notify_url;
    public $return_url;
    public $rsaPrivateKeyFilePath = '';  //路径
    public $aliPubKey = '';  //路径
    public $privateKey = 'MIIEvwIBADANBgkqhkiG9w0BAQEFAASCBKkwggSlAgEAAoIBAQCx03NTFpyirB/NnNnNCoCTCIs2kzbAR59e4ElRfge5VF2oAOlHHQ3j4UIN2Ij4QiaZLwOWD2fE5m0ThcPiY/AZTZoBxcGLuJtSTaKjtLvxZt9AffvM702gz3CvC5oQmDvuGWJq1hbowvcoFXSE3sz4FMHG+X90pE6LiYUMu36X8kEOsDyvJZ5lVVIcZMkJ5EK1NNQVBQPKAS4HLagt7mRZfu9zcMiYJMwE7Y4m49rSsdiSpzDwE2UdZdqmx6Vsl70fpXV3J+8k79nN/Bo/xRZXmUGleQe0XtTBI/fTL/kTPMfu3jk8wz7nQwG3RifXipI0QyyxNhQAD9v5QlKL67tFAgMBAAECggEBAJHteQUlWDLyV0LvRZjK1opSh5OoqVSPMgy0t9YlO4dt4VGeNdFC2YQ49XDRUk2QU4Z/m0zIpZpikf5kVkRxSLYrBYgQ1eyn+OZIiYAYL+dBSVHuUPVzJ9wgf1NWjP6zPvL8Z9ROjgxC+notaSokgEXRGtgDJQH+V+qQVtwE/TUImvNAEB4vj3XCMToyAxr1uoofTpiv139o7IWcU3vO7zsqA4eDY7F+kGsWoGIlVCePMUnC5ZyQ8knV74ogsdFNuvTbbEbSrQPa/WfdMeji6tclU5vxcP8ZWgAvhZRzgE16ozxH1SIkeVgDvkXugxq25MfwzSjN0kyD7WaW3yU23p0CgYEA7d4xr+Rog/5d2Z7TgeJFX/uUbv81gVP0rl7inKudPFG28BHMzEF2/Yf04KK4yIGYFj/bs72E6IMB+4XD79Soey8TTcswxlX8pIyFkhbGTv1e58g1EHBt7ulRVtEzPChXME39OAsZJmmVmN+0jTqaQedqv3JySWHrSOqfCbj9rMMCgYEAv2GVqboh5hZ52S8orK1Zo44k7h4Owp2mgDAfK9HROt7EfHL3r3M7tDbhJ/qjO5KY4a7NCMdi4qoMsvg/k6KlmDofD6povo/IwbdAkrVAM7vO3Zjn/1EbCvRe/BibSp6UTm3Ixij4Pmg5M4Cmv3bYFmKvvf3gPx0N2urIq88Fl1cCgYA6slW4fbh8ucwW42Z16owL/1zFdxyQ6VK7pJZu6rpGJDPsUbgjvxPJxD7dH8pRUAljlCZ22BFv/sQCeSO8jtF0dE1jKPzENHu/bx2Wyx/sZgGBWJofkF7QUarMrZrjAWFifhw6NCLko7FSpAE9yHRARwbEb01cZllVCPBtycRvWQKBgQCr1VeGhCwJpeaTnWcc26yfUHJSJkTEcr5bXFmwg3wkKn4q6yL+si1KGvhAaCcFxxNjlwpbNoLP1zT9wC19Rkz+iDj5XN0dNIZhgEMHNpxFlvwfNTogoNbyGAXsvb842Xd5j9L0MTbq+bNaTcnqIS/VsZfvs7ITmOemxqWUtZVkkwKBgQCpNQLofRLwRED63p24yhdkW7Q1tOFoXoCDSrPTlAuFWfalhPZLglUUXs7C7xOCqFNmvfknICnMFL9CQOEorip3La+XVF48a4d8ul9zsmU1UTOXL1yPpWgG3OX6S7almywz6P/NgxR2Vps/+aldBWR1iPVokHVTwgdpQ+AaZrXamg==';
    public $publicKey = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAsdNzUxacoqwfzZzZzQqAkwiLNpM2wEefXuBJUX4HuVRdqADpRx0N4+FCDdiI+EImmS8Dlg9nxOZtE4XD4mPwGU2aAcXBi7ibUk2io7S78WbfQH37zO9NoM9wrwuaEJg77hliatYW6ML3KBV0hN7M+BTBxvl/dKROi4mFDLt+l/JBDrA8ryWeZVVSHGTJCeRCtTTUFQUDygEuBy2oLe5kWX7vc3DImCTMBO2OJuPa0rHYkqcw8BNlHWXapselbJe9H6V1dyfvJO/ZzfwaP8UWV5lBpXkHtF7UwSP30y/5EzzH7t45PMM+50MBt0Yn14qSNEMssTYUAA/b+UJSi+u7RQIDAQAB';
    public function __construct()
    {
        $this->app_id = '2016093000634031';
        $this->gate_way = 'https://openapi.alipaydev.com/gateway.do';
        $this->notify_url = env('APP_URL').'/notify_url';
        $this->return_url = 'http://www.blog.com/index/cart';
    }


    /**
     * 订单支付
     * @param $oid
     */
    public function pay()
    {

        // echo "111111";
    	// file_put_contents(storage_path('logs/alipay.log'),"\nqqqq\n",FILE_APPEND);
    	// die();
        //验证订单状态 是否已支付 是否是有效订单
        //$order_info = OrderModel::where(['oid'=>$oid])->first()->toArray();
        //判断订单是否已被支付
        // if($order_info['is_pay']==1){
        //     die("订单已支付，请勿重复支付");
        // }
        //判断订单是否已被删除
        // if($order_info['is_delete']==1){
        //     die("订单已被删除，无法支付");
        // }
        $oid = time().mt_rand(10000,99999);  //订单编号
        //业务参数
        $bizcont = [
            'subject'           => 'Lening-Order: ' .$oid,
            'out_trade_no'      => $oid,
            'total_amount'      => 9,
            'product_code'      => 'FAST_INSTANT_TRADE_PAY',
        ];
        //公共参数
        $data = [
            'app_id'   => $this->app_id,
            'method'   => 'alipay.trade.page.pay',
            'format'   => 'JSON',
            'charset'   => 'utf-8',
            'sign_type'   => 'RSA2',
            'timestamp'   => date('Y-m-d H:i:s'),
            'version'   => '1.0',
            'notify_url'   => $this->notify_url,        //异步通知地址
            'return_url'   => $this->return_url,        // 同步通知地址
            'biz_content'   => json_encode($bizcont),
        ];
        //签名
        $sign = $this->rsaSign($data);
        $data['sign'] = $sign;
        $param_str = '?';
        foreach($data as $k=>$v){
            $param_str .= $k.'='.urlencode($v) . '&';
        }
        $url = rtrim($param_str,'&');
        $url = $this->gate_way . $url;

        header("Location:".$url);
    }
    public function rsaSign($params) {
        return $this->sign($this->getSignContent($params));
    }
    protected function sign($data) {
    	if($this->checkEmpty($this->rsaPrivateKeyFilePath)){
    		$priKey=$this->privateKey;
			$res = "-----BEGIN RSA PRIVATE KEY-----\n" .
				wordwrap($priKey, 64, "\n", true) .
				"\n-----END RSA PRIVATE KEY-----";
    	}else{
    		$priKey = file_get_contents($this->rsaPrivateKeyFilePath);
            $res = openssl_get_privatekey($priKey);
    	}

        ($res) or die('您使用的私钥格式错误，请检查RSA私钥配置');
        openssl_sign($data, $sign, $res, OPENSSL_ALGO_SHA256);
        if(!$this->checkEmpty($this->rsaPrivateKeyFilePath)){
            openssl_free_key($res);
        }
        $sign = base64_encode($sign);
        return $sign;
    }
    public function getSignContent($params) {
        ksort($params);
        $stringToBeSigned = "";
        $i = 0;
        foreach ($params as $k => $v) {
            if (false === $this->checkEmpty($v) && "@" != substr($v, 0, 1)) {
                // 转换成目标字符集
                $v = $this->characet($v, 'UTF-8');
                if ($i == 0) {
                    $stringToBeSigned .= "$k" . "=" . "$v";
                } else {
                    $stringToBeSigned .= "&" . "$k" . "=" . "$v";
                }
                $i++;
            }
        }
        unset ($k, $v);
        return $stringToBeSigned;
    }
    protected function checkEmpty($value) {
        if (!isset($value))
            return true;
        if ($value === null)
            return true;
        if (trim($value) === "")
            return true;
        return false;
    }
    /**
     * 转换字符集编码
     * @param $data
     * @param $targetCharset
     * @return string
     */
    function characet($data, $targetCharset) {
        if (!empty($data)) {
            $fileType = 'UTF-8';
            if (strcasecmp($fileType, $targetCharset) != 0) {
                $data = mb_convert_encoding($data, $targetCharset, $fileType);
            }
        }
        return $data;
    }
    /**
     * 支付宝同步通知回调
     */
    public function aliReturn()
    {
        header('Refresh:2;url=/order/list');
        echo "订单： ".$_GET['out_trade_no'] . ' 支付成功，正在跳转';
//        echo '<pre>';print_r($_GET);echo '</pre>';die;
//        //验签 支付宝的公钥
//        if(!$this->verify($_GET)){
//            die('签名失敗');
//        }
//
//        //验证交易状态
////        if($_GET['']){
////
////        }
////
//
//        //处理订单逻辑
//        $this->dealOrder($_GET);
    }
    /**
     * 支付宝异步通知
     */
    public function aliNotify()
    {
        $data = json_encode($_POST);
        $log_str = '>>>> '.date('Y-m-d H:i:s') . $data . "<<<<\n\n";
        //记录日志
        file_put_contents('logs/alipay.log',$log_str,FILE_APPEND);
        //验签
        $res = $this->verify($_POST);
        $log_str = '>>>> ' . date('Y-m-d H:i:s');
        if($res === false){
            //记录日志 验签失败
            $log_str .= " Sign Failed!<<<<< \n\n";
            file_put_contents('logs/alipay.log',$log_str,FILE_APPEND);
        }else{
            $log_str .= " Sign OK!<<<<< \n\n";
            file_put_contents('logs/alipay.log',$log_str,FILE_APPEND);
        }
        //验证订单交易状态
        if($_POST['trade_status']=='TRADE_SUCCESS'){
            //更新订单状态
            $oid = $_POST['out_trade_no'];     //商户订单号
            $info = [
                'is_pay'        => 1,       //支付状态  0未支付 1已支付
                'pay_amount'    => $_POST['total_amount'] * 100,    //支付金额
                'pay_time'      => strtotime($_POST['gmt_payment']), //支付时间
                'plat_oid'      => $_POST['trade_no'],      //支付宝订单号
                'plat'          => 1,      //平台编号 1支付宝 2微信
            ];
            OrderModel::where(['oid'=>$oid])->update($info);
        }
        //处理订单逻辑
        $this->dealOrder($_POST);
        echo 'success';
    }

    //验签
    function verify($params) {
        $sign = $params['sign'];

        if($this->checkEmpty($this->aliPubKey)){
            $pubKey= $this->publicKey;
            $res = "-----BEGIN PUBLIC KEY-----\n" .
                wordwrap($pubKey, 64, "\n", true) .
                "\n-----END PUBLIC KEY-----";
        }else {
            //读取公钥文件
            $pubKey = file_get_contents($this->aliPubKey);
            //转换为openssl格式密钥
            $res = openssl_get_publickey($pubKey);
        }


        ($res) or die('支付宝RSA公钥错误。请检查公钥文件格式是否正确');
        //调用openssl内置方法验签，返回bool值
        $result = (bool)openssl_verify($this->getSignContent($params), base64_decode($sign), $res, OPENSSL_ALGO_SHA256);

        if(!$this->checkEmpty($this->aliPubKey)){
            openssl_free_key($res);
        }
        return $result;
    }
    /**
     * 处理订单逻辑 更新订单 支付状态 更新订单支付金额 支付时间
     * @param $data
     */
    public function dealOrder($data)
    {
        //加积分
        //减库存
    }


}
