# sms
一个PHP的第三方短信服务接口类库

版本 0.0.1上架  阿里云通讯，阿里云短信服务

#阿里云-云通信-短信服务 使用方法如下：

/**
 * 阿里云通讯发送短信
 * @author : weiyi <294287600@qq.com>
 * Licensed ( http://www.wycto.com )
 * Copyright (c) 2016~2099 http://www.wycto.com All rights reserved.
 */

namespace wycto\sms\test;
require_once "../src/dysms/dysms.php";
require_once "../src/dysms/SignatureHelper.php";
use wycto\sms\dysms\Dysms;

function utf8(){
    ini_set("display_errors", "on"); // 显示错误提示，仅用于测试时排查问题
    // error_reporting(E_ALL); // 显示所有错误提示，仅用于测试时排查问题
    set_time_limit(0); // 防止脚本超时，仅用于测试使用，生产环境请按实际情况设置
    header("Content-Type: text/plain; charset=utf-8"); // 输出为utf-8的文本格式，仅用于测试
}



function check(){
    //此方法用于检测运行环境，请在浏览器中运行检测,可以不用理会
    Dysms::check();
}

/***************消息发送**************/

function sendsms(){

    $params = array ();

    // fixme 必填: 短信接收号码
    $params["PhoneNumbers"] = "15008501308";

    // fixme 必填: 短信签名，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
    $params["SignName"] = "wycto";

    // fixme 必填: 短信模板Code，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
    $params["TemplateCode"] = "SMS_136009060";

    // fixme 可选: 设置模板参数, 假如模板中存在变量需要替换则为必填项
    $params['TemplateParam'] = array (
        "code" => "a12345",
        "product" => "asrf23"
    );

    // fixme 可选: 设置发送短信流水号
    $params['OutId'] = "12345";

    // fixme 可选: 上行短信扩展码, 扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段
    $params['SmsUpExtendCode'] = "1234567";

    // 验证发送短信(SendSms)接口
    print_r(Dysms::sendSms("LTDIBu6wdiT43dCr","fSKDEFQdrI5dnPF9hWPyBUM23KlDIs",$params));
}


/***************批量发送短信**************/

function sendBatchSms(){

    $params = array ();

    // fixme 必填: 待发送手机号。支持JSON格式的批量调用，批量上限为100个手机号码,批量调用相对于单条调用及时性稍有延迟,验证码类型的短信推荐使用单条调用的方式
    $params["PhoneNumberJson"] = array(
        "15008501308",
        "15085222438",
    );

    // fixme 必填: 短信签名，支持不同的号码发送不同的短信签名，每个签名都应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
    $params["SignNameJson"] = array(
    "wycto",
    "wycto",
    );

    // fixme 必填: 短信模板Code，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
    $params["TemplateCode"] = "SMS_1350D0060";

    // fixme 必填: 模板中的变量替换JSON串,如模板内容为"亲爱的${name},您的验证码为${code}"时,此处的值为
    // 友情提示:如果JSON中需要带换行符,请参照标准的JSON协议对换行符的要求,比如短信内容中包含\r\n的情况在JSON中需要表示成\\r\\n,否则会导致JSON在服务端解析失败
    $params["TemplateParamJson"] = array(
        array (
        "code" => "133520",
        "product" => "asrf23"
    ),
        array (
        "code" => "133520",
        "product" => "asrf23"
    ),
    );

    print_r(Dysms::sendBatchSms("LTAID06wdiT43dCr","fSKKE2DdrI5dnPI9hWPyBUM23KlDIs",$params));
}


/***************短信发送记录查询**************/

function querySendDetails(){

    $params = array ();
    // fixme 必填: 短信接收号码
    $params["PhoneNumber"] = "15008501308";

    // fixme 必填: 短信发送日期，格式Ymd，支持近30天记录查询
    $params["SendDate"] = "20180516";

    // fixme 必填: 分页大小
    $params["PageSize"] = 10;

    // fixme 必填: 当前页码
    $params["CurrentPage"] = 1;

    // fixme 可选: 设置发送短信流水号
    //$params["BizId"] = "12345";

print_r(Dysms::querySendDetails("LTAIB06DdiT43dCr","fSKKE2QdrD5dnPI9hWPyBUM23KlDIs",$params));
}

sendsms();
//sendBatchSms();
//querySendDetails();
