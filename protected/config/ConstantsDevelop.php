<?php 
	

    define('OLD_PLATFORM_DOMAIN','http://xxdemo.qtxiaoxin.com'); //校信域名
    define("NEW_PLATFORM_DOMAIN", "http://newxxdemo.qtxiaoxin.com"); //班班域名


	/* 测试环境存储 */	
	define ("STORAGE_QINNIU_BUCKET_TX", "zhoufeng"); //头像图片
	define ("STORAGE_QINNIU_BUCKET_XX", "zhoufeng"); //消息图片
	// define ("STORAGE_QINNIU_XIAOXIN_TX", "http://".STORAGE_QINNIU_BUCKET_TX.".qiniudn.com/"); //头像的图片地址
	// define ("STORAGE_QINNIU_XIAOXIN_XX", "http://".STORAGE_QINNIU_BUCKET_XX.".qiniudn.com/"); //消息的图片地址
	define ("STORAGE_QINNIU_XIAOXIN_TX", "http://7qnbf9.com1.z0.glb.clouddn.com/"); //头像的图片地址
	define ("STORAGE_QINNIU_XIAOXIN_XX", "http://7qnbf9.com1.z0.glb.clouddn.com/"); //消息的图片地址

	define ("STORAGE_QINNIU_ACCESSKEY", "0vga-ps7yxZhnuza6l155sQ6tVGr6SEtYDWK4h7Q");
	define ("STORAGE_QINNIU_SECRETKEY", "4SM6dvjJQvNwdRnApnINdfGwT_KFi0TqsfWDDiyy");


    //站点域名
    define('SITE_URL','http://newxxdemo.qtxiaoxin.com');

    //微信第三方登录配置
    define('WX_LOGIN_APPID','wx37c30cfed64ccfcc');
    define('WX_LOGIN_APPSECRET','e968d32ce2189a44ef4b007fdc1c6061');
    define('WX_GET_TOKEN_URL','https://api.weixin.qq.com/sns/oauth2/access_token');
    define('WX_CHECK_TOKEN_URL','https://api.weixin.qq.com/sns/auth');
    define('WX_GET_USERINFO_URL','https://api.weixin.qq.com/sns/userinfo');
    define('WX_GET_CODE_URL','https://open.weixin.qq.com/connect/qrconnect');
    define('WX_CALLBACK_URL','http://cdtestxx.qtxiaoxin.com/connect/wxcbk');
    
    
    //班费
    //测试证书和密码*********************************************************************************
    //密钥
    define('TENPAY_KEY','82d2f8b9fd7695aec51415ab2900a755');
    //证书必须放在用户下载不到的目录，避免证书被盗取
    define('TENPAY_CERTPATH',dirname(__FILE__).'/../extensions/tenpay/1900000107.pem');
    //证书密码,正式商户号的证书密码通过短信方式发送到合同登记的手机号，系统上线前请注意修改为正确值
    define('TENPAY_CERTPASSWORD','511448');
    define('TENPAY_CAPATH',dirname(__FILE__).'/../extensions/tenpay/cacert.pem');
    //商户号
    define('TENPAY_SP_ID', '1900000107');
    //操作员
    define('TENPAY_OP_USER','1900000107');
    //操作员密码
    define('TENPAY_OP_PASSWD','111111');
    //商户服务器IP
    define('TENPAY_CLIENT_IP','218.17.157.52');
    //测试证书和密码*********************************************************************************


    //开发环境阿波罗接口域名*********************************************************************************
    define("APOLLO_API_DOMAIN","http://testhttp.banban.im"); //阿波罗接口域名
    //开发环境阿波罗接口域名*********************************************************************************
	

	