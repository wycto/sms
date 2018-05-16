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
    /**
     * 发送短信
     * @param unknown $accessKeyId 阿里云控制台的AccessKeyId
     * @param unknown $accessKeySecret 阿里云控制台的AccessKeySecret
     * @param unknown $params 参数
     * // fixme 必填: 短信接收号码
	    $params["PhoneNumbers"] = "18788712731";

	    // fixme 必填: 短信签名，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
	    $params["SignName"] = "村蛙";

	    // fixme 必填: 短信模板Code，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
	    $params["TemplateCode"] = "SMS_135000060";

	    // fixme 可选: 设置模板参数, 假如模板中存在变量需要替换则为必填项
	    $params['TemplateParam'] = Array (
	        "code" => "a12345",
	        "product" => "asrf23"
	    );

	    // fixme 可选: 设置发送短信流水号
	    $params['OutId'] = "12345";

	    // fixme 可选: 上行短信扩展码, 扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段
	    $params['SmsUpExtendCode'] = "1234567";


	    // *** 需用户填写部分结束, 以下代码若无必要无需更改 ***
	    if(!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
	        $params["TemplateParam"] = json_encode($params["TemplateParam"], JSON_UNESCAPED_UNICODE);
	    }
     */
	static function sendSms($accessKeyId,$accessKeySecret,$params = array ()) {

	    // *** 需用户填写部分结束, 以下代码若无必要无需更改 ***
	    if(!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
	        $params["TemplateParam"] = json_encode($params["TemplateParam"], JSON_UNESCAPED_UNICODE);
	    }

	    // 初始化SignatureHelper实例用于设置参数，签名以及发送请求
	    $helper = new SignatureHelper();

	    // 此处可能会抛出异常，注意catch
	    try {
	        $content = $helper->request(
	            $accessKeyId,
	            $accessKeySecret,
	            "dysmsapi.aliyuncs.com",
	            array_merge($params, array(
	                "RegionId" => "cn-hangzhou",
	                "Action" => "SendSms",
	                "Version" => "2017-05-25",
	            ))
	            // fixme 选填: 启用https
	            // ,true
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
	static function sendBatchSms($accessKeyId,$accessKeySecret,$params = array ()) {

	    // todo 可选: 上行短信扩展码, 扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段
	    // $params["SmsUpExtendCodeJson"] = json_encode(array("90997","90998"));


	    // *** 需用户填写部分结束, 以下代码若无必要无需更改 ***
	    $params["TemplateParamJson"]  = json_encode($params["TemplateParamJson"], JSON_UNESCAPED_UNICODE);
	    $params["SignNameJson"] = json_encode($params["SignNameJson"], JSON_UNESCAPED_UNICODE);
	    $params["PhoneNumberJson"] = json_encode($params["PhoneNumberJson"], JSON_UNESCAPED_UNICODE);

	    if(isset($params["SmsUpExtendCodeJson"]) && !empty($params["SmsUpExtendCodeJson"]) && is_array($params["SmsUpExtendCodeJson"])) {
	        $params["SmsUpExtendCodeJson"] = json_encode($params["SmsUpExtendCodeJson"], JSON_UNESCAPED_UNICODE);
	    }

	    // 初始化SignatureHelper实例用于设置参数，签名以及发送请求
	    $helper = new SignatureHelper();

	    // 此处可能会抛出异常，注意catch
	    $content = $helper->request(
	        $accessKeyId,
	        $accessKeySecret,
	        "dysmsapi.aliyuncs.com",
	        array_merge($params, array(
	            "RegionId" => "cn-hangzhou",
	            "Action" => "SendBatchSms",
	            "Version" => "2017-05-25",
	        ))
	        // fixme 选填: 启用https
	        // ,true
	    );

	    return $content;
	}

	/**
	 * 短信发送记录查询
	 * @param unknown $accessKeyId 阿里云控制台的AccessKeyId
	 * @param unknown $accessKeySecret 阿里云控制台的AccessKeySecret
	 * @param unknown $params
	 */
	static function querySendDetails($accessKeyId,$accessKeySecret,$params = array ()) {

	    // *** 需用户填写部分结束, 以下代码若无必要无需更改 ***

	    // 初始化SignatureHelper实例用于设置参数，签名以及发送请求
	    $helper = new SignatureHelper();

	    // 此处可能会抛出异常，注意catch
	    $content = $helper->request(
	        $accessKeyId,
	        $accessKeySecret,
	        "dysmsapi.aliyuncs.com",
	        array_merge($params, array(
	            "RegionId" => "cn-hangzhou",
	            "Action" => "QuerySendDetails",
	            "Version" => "2017-05-25",
	        ))
	        // fixme 选填: 启用https
	        // ,true
	    );

	    return $content;
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
}