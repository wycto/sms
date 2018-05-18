<?php
/**
 * 阿里云通讯发送短信
 * @author : weiyi <294287600@qq.com>
 * Licensed ( http://www.wycto.com )
 * Copyright (c) 2016~2099 http://www.wycto.com All rights reserved.
 */
namespace wycto\sms\dysms;
class Dysms
{

    private $domain = "dysmsapi.aliyuncs.com";//短信发送域名

    protected $accessKeyId;

    protected $accessKeySecret;

    protected $security = false;//是否启用https协议

    protected $params = array();//参数

    /*******************************************/
    protected $TemplateCode;//必填: 短信模板Code

    /*************单个发送参数**************/
    protected $SignName;//必填: 短信签名

    protected $PhoneNumbers;//接收手机号

    protected $TemplateParam = array();//可选: 设置模板参数, 假如模板中存在变量需要替换则为必填项

    protected $OutId;//可选: 设置发送短信流水号

    protected $SmsUpExtendCode;//可选: 上行短信扩展码, 扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段

    /************批量发送参数*************/
    protected $SignNameJson;//必填: 短信签名，支持不同的号码发送不同的短信签名，每个签名都应严格按"签名名称"填写

    protected $PhoneNumberJson;//接收手机号，二维数组或者json

    protected $TemplateParamJson;//可选: 设置模板参数, 二维数组或者json

    protected $SmsUpExtendCodeJson;//todo 可选: 上行短信扩展码, 扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段
    // $params["SmsUpExtendCodeJson"] = json_encode(array("90997","90998"));

    /********************查询*********************/
    protected $PhoneNumber;//必填: 短信接收号码

    protected $SendDate;//必填: 短信发送日期，格式Ymd，支持近30天记录查询

    protected $PageSize=10;//必填: 分页大小

    protected $CurrentPage=1;//必填: 当前页码

    protected $BizId;//可选: 设置发送短信流水号

    /**
     * 构造方法
     * @param unknown $accessKeyId
     * @param unknown $accessKeySecret
     */
    function __construct($accessKeyId,$accessKeySecret){
        $this->accessKeyId = $accessKeyId;
        $this->accessKeySecret = $accessKeySecret;
    }

    /********************/
    function setSecurity($Security){
        $this->security = $Security;
    }

    function getSecurity(){
        return $this->security;
    }

    /********************/
    function setTemplateCode($TemplateCode){
        $this->TemplateCode = $TemplateCode;
        $this->params['TemplateCode'] = $TemplateCode;
    }

    function getTemplateCode(){
        return $this->TemplateCode;
    }

    /*********************/
    function setSignName($SignName){
        $this->SignName = $SignName;
        $this->params['SignName'] = $SignName;
    }

    function getSignName(){
        return $this->SignName;
    }

    /*********************/
    function setPhoneNumbers($mobile){
        $this->PhoneNumbers = $mobile;
        $this->params['PhoneNumbers'] = $mobile;
    }

    function getPhoneNumbers(){
        return $this->PhoneNumbers;
    }

    /*********************/
    function setTemplateParam($array){
        $this->TemplateParam = $array;
        $this->params['TemplateParam'] = $array;
    }

    function getTemplateParam(){
        return $this->TemplateParam;
    }

    /*********************/
    function setOutId($OutId){
        $this->OutId = $OutId;
        $this->params['OutId'] = $OutId;
    }

    function getOutId(){
        return $this->OutId;
    }

    /*********************/
    function setSmsUpExtendCode($SmsUpExtendCode){
        $this->SmsUpExtendCode = $SmsUpExtendCode;
        $this->params['SmsUpExtendCode'] = $SmsUpExtendCode;
    }

    function getSmsUpExtendCode(){
        return $this->SmsUpExtendCode;
    }

    /*********************/
    function setSignNameJson($SignNameJson){
        $this->SignNameJson = $SignNameJson;
        $this->params['SignNameJson'] = $SignNameJson;
    }

    function getSignNameJson(){
        return $this->SignNameJson;
    }

    /*********************/
    function setPhoneNumberJson($PhoneNumberJson){
        $this->PhoneNumberJson = $PhoneNumberJson;
        $this->params['PhoneNumberJson'] = $PhoneNumberJson;
    }

    function getPhoneNumberJson(){
        return $this->PhoneNumberJson;
    }

    /*********************/
    function setTemplateParamJson($TemplateParamJson){
        $this->TemplateParamJson = $TemplateParamJson;
        $this->params['TemplateParamJson'] = $TemplateParamJson;
    }

    function getTemplateParamJson(){
        return $this->TemplateParamJson;
    }

    /*********************/
    function setSmsUpExtendCodeJson($SmsUpExtendCodeJson){
        $this->TemplateParamJson = $SmsUpExtendCodeJson;
        $this->params['SmsUpExtendCodeJson'] = $SmsUpExtendCodeJson;
    }

    function getSmsUpExtendCodeJson(){
        return $this->SmsUpExtendCodeJson;
    }

    /*********************/
    function setPhoneNumber($PhoneNumber){
        $this->PhoneNumber = $PhoneNumber;
        $this->params['PhoneNumber'] = $PhoneNumber;
    }

    function getPhoneNumber(){
        return $this->PhoneNumber;
    }

    /*********************/
    function setSendDate($SendDate){
        $this->SendDate = $SendDate;
        $this->params['SendDate'] = $SendDate;
    }

    function getSendDate(){
        return $this->SendDate;
    }

    /*********************/
    function setPageSize($PageSize){
        $this->PageSize = $PageSize;
        $this->params['PageSize'] = $PageSize;
    }

    function getPageSize(){
        return $this->PageSize;
    }

    /*********************/
    function setCurrentPage($CurrentPage){
        $this->CurrentPage = $CurrentPage;
        $this->params['CurrentPage'] = $CurrentPage;
    }

    function getCurrentPage(){
        return $this->CurrentPage;
    }

    /*********************/
    function setBizId($BizId){
        $this->BizId = $BizId;
        $this->params['BizId'] = $BizId;
    }

    function getBizId(){
        return $this->BizId;
    }

    /**
     * 发送短信
     * @param unknown $accessKeyId 阿里云控制台的AccessKeyId
     * @param unknown $accessKeySecret 阿里云控制台的AccessKeySecret
     */
	function sendOne() {

    	$this->params["TemplateParam"] = $this->to_json_encode($this->params["TemplateParam"]);

	    try {
	        $content = $this->request(
	            $this->accessKeyId,
	            $this->accessKeySecret,
	            $this->domain,
	            array_merge($this->params, array(
	                "RegionId" => "cn-hangzhou",
	                "Action" => "SendSms",
	                "Version" => "2017-05-25",
	            )),
	            $this->security
	        );
	    }catch (Exception $e){
	        return "短信发送异常，接口异常";
	    }

	    return $content;
	}

	/**
	 * 批量发送短信
	 * @param unknown $accessKeyId 阿里云控制台的AccessKeyId
	 * @param unknown $accessKeySecret 阿里云控制台的AccessKeySecret
	 * @param unknown $params
	 * @return unknown
	 */
	function sendMany() {

	    $this->params["TemplateParamJson"] = $this->to_json_encode($this->params["TemplateParamJson"]);
	    $this->params["SignNameJson"] = $this->to_json_encode($this->params["SignNameJson"]);
	    $this->params["PhoneNumberJson"] = $this->to_json_encode($this->params["PhoneNumberJson"]);
	    $this->params["SmsUpExtendCodeJson"] = $this->to_json_encode($this->params["SmsUpExtendCodeJson"]);

	    // 此处可能会抛出异常，注意catch
	    $content = $helper->request(
	        $this->accessKeyId,
	        $this->accessKeySecret,
	        $this->domain,
	        array_merge($this->params, array(
	            "RegionId" => "cn-hangzhou",
	            "Action" => "SendBatchSms",
	            "Version" => "2017-05-25",
	        )),
	        $this->security
	    );

	    return $content;
	}

	/**
	 * 短信发送记录查询
	 * @param unknown $accessKeyId 阿里云控制台的AccessKeyId
	 * @param unknown $accessKeySecret 阿里云控制台的AccessKeySecret
	 * @param unknown $params
	 */
	function query() {

	    // 此处可能会抛出异常，注意catch
	    $content = $this->request(
	        $this->accessKeyId,
	        $this->accessKeySecret,
	        $this->domain,
	        array_merge($this->params, array(
	            "RegionId" => "cn-hangzhou",
	            "Action" => "QuerySendDetails",
	            "Version" => "2017-05-25",
	        )),
	        $this->security
	    );

	    return $content;
	}

	/**
	 * 如果是数组，则转换为json
	 * @param unknown $param
	 */
	protected function to_json_encode($param){
	    if(!empty($param) && is_array($param)) {
	        return json_encode($param, JSON_UNESCAPED_UNICODE);
	    }else{
	        return $param;
	    }
	}

	/**
	 * 此方法用于检测运行环境，请在浏览器中运行检测
	 * @return [type] [description]
	 */
	static function check(){
		echo '<style>li {font-size: 16px;} li.fail {color:red} li.success {color: green} li label{ display:inline-block; width: 15em}</style>';
		echo '<h1>执行环境检测</h1>';

		function success($title) {
		    print_r("<li class=\"success\"><label>{$title}</label>[成功]</li>");
		}
		function fail($title, $description) {
		    print_r("<li class=\"fail\"><label>{$title}</label>[失败] {$description}</li>");
		}

		if(preg_match("/^\d+\.\d+/", PHP_VERSION, $matches)) {
		    $version = $matches[0];
		    if($version >= 5.4) {
		        success("PHP $version");
		    } else {
		        fail("PHP $version", "需要PHP>=5.4版本");
		        exit(1);
		    }
		}


		try {
		    set_error_handler(function () { throw new Exception(); });
		    date_default_timezone_get();
		    restore_error_handler();
		} catch(Exception $e) {
		    fail('默认时区设置', '请设置默认时区，如：date_default_timezone_set("Asia/Shanghai")');
		}

		echo '<h2>依赖扩展检测，如失败请安装相应扩展</h2>';

		$dependencies = array (
		    'json_encode' => null,
		    'curl_init' => null,
		    'hash_hmac' => null,
		    'simplexml_load_string' => '如果是php7.x + ubuntu环境，请确认php7.x-libxml是否安装，x为子版本号',
		);

		foreach($dependencies as $funcName => $description) {
		    if(!function_exists($funcName)) {
		        fail($funcName, $description || '');
		    } else {
		        success($funcName);
		    }
		}
	}

	/**
	 * 以下禁止修改
	 */
	/***********************************SignatureHelper**************************************/

	/**
	 * 生成签名并发起请求
	 *
	 * @param $accessKeyId string AccessKeyId (https://ak-console.aliyun.com/)
	 * @param $accessKeySecret string AccessKeySecret
	 * @param $domain string API接口所在域名
	 * @param $params array API具体参数
	 * @param $security boolean 使用https
	 * @return bool|\stdClass 返回API接口调用结果，当发生错误时返回false
	 */
	private function request($accessKeyId, $accessKeySecret, $domain, $params, $security=false) {
	    $apiParams = array_merge(array (
	        "SignatureMethod" => "HMAC-SHA1",
	        "SignatureNonce" => uniqid(mt_rand(0,0xffff), true),
	        "SignatureVersion" => "1.0",
	        "AccessKeyId" => $accessKeyId,
	        "Timestamp" => gmdate("Y-m-d\TH:i:s\Z"),
	        "Format" => "JSON",
	    ), $params);
	    ksort($apiParams);

	    $sortedQueryStringTmp = "";
	    foreach ($apiParams as $key => $value) {
	        $sortedQueryStringTmp .= "&" . $this->encode($key) . "=" . $this->encode($value);
	    }

	    $stringToSign = "GET&%2F&" . $this->encode(substr($sortedQueryStringTmp, 1));

	    $sign = base64_encode(hash_hmac("sha1", $stringToSign, $accessKeySecret . "&",true));

	    $signature = $this->encode($sign);

	    $url = ($security ? 'https' : 'http')."://{$domain}/?Signature={$signature}{$sortedQueryStringTmp}";

	    try {
	        $content = $this->fetchContent($url);
	        return json_decode($content);
	    } catch( \Exception $e) {
	        return false;
	    }
	}

	private function encode($str)
	{
	    $res = urlencode($str);
	    $res = preg_replace("/\+/", "%20", $res);
	    $res = preg_replace("/\*/", "%2A", $res);
	    $res = preg_replace("/%7E/", "~", $res);
	    return $res;
	}

	private function fetchContent($url) {
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	        "x-sdk-client" => "php/2.0.0"
	    ));

	    if(substr($url, 0,5) == 'https') {
	        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	    }

	    $rtn = curl_exec($ch);

	    if($rtn === false) {
	        trigger_error("[CURL_" . curl_errno($ch) . "]: " . curl_error($ch), E_USER_ERROR);
	    }
	    curl_close($ch);

	    return $rtn;
	}
}