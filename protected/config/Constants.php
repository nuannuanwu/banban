<?php

	if(defined("BANBAN_ENVIRONMENT") && BANBAN_ENVIRONMENT=='localhost'){
		//本地开发环境
		require_once(dirname(__FILE__).'/ConstantsTest.php');
	}elseif(defined("BANBAN_ENVIRONMENT") && BANBAN_ENVIRONMENT=='develop'){
		//测试开发环境
		require_once(dirname(__FILE__).'/ConstantsDevelop.php');
	}else{
		//生产环境
		require_once(dirname(__FILE__).'/ConstantsProduct.php');
	}

	define ("XIAOXIN_LOGIN_IDENTITY", "apollo_banban_login_identity"); //用户身份cookie键值
	define ("CLIENT_FILE_DOWNLOAD_URL", "http://file27.qtxiaoxin.com/FileHandler.ashx");


    //校信用户版本
    define('USER_BRANCH','01');
    //站点名称
    define('SITE_NAME','班班');
    //班班web版本号
    define('SITE_VERSION','5.5.1');

    //学校通知登录地址
    define('SCHOOL_NOTICE_LOGIN','http://schoolnotice.banban.im/site/login');


    //短信下载短域名
    define('SITE_MSG_DOWNLOAD_SHORT_URL','http://t.cn/Ry2M2cG');
    //APP下载短域名
    define('SITE_APP_DOWNLOAD_SHORT_URL','http://t.cn/RwU3di3');
    //APP 下载地址 android
    define('SITE_APP_DOWNLOAD_URL','http://app.banban.im/install');
    //APP 下载地址 web ios
    define('SITE_APP_DOWNLOAD_IOS_URL','https://itunes.apple.com/cn/app/ban-ban-yi-ban-wei-dan-wei/id965712604?mt=8');
    //公共号地址
    define('OFFICIAL_URL','http://gzh.qtxiaoxin.com');
    //客户端应用宝下载地址
	define('APP_MOLO_DOWNLOAD_URL','http://a.app.qq.com/o/simple.jsp?pkgname=cn.youteach.xxt2');
	//WEB端安卓应用宝下载地址
	define('WEB_ANDROID_MOLO_DOWNLOAD_URL','http://android.myapp.com/myapp/detail.htm?apkName=cn.youteach.xxt2');
	//WEB端IOS下载地址
	define('WEB_IOS_DOWNLOAD_URL','https://itunes.apple.com/cn/app/ban-ban-yi-ban-wei-dan-wei/id965712604?mt=8');

    //短信签名
    define("SMS_SIGN","【班班】");
    //第三方登录密匙
    define("LOGIN_BANBAN_KEY","qtbanban");

    // URL的GET方式的ID前缀识别
    define("SITE_URL_KEY","A_eD");
    //QQ微信用户信息
    define ("LOGIN_THREE_USER_INFO", "login_three_qqwx_info"); 

	//JCE协议常量---------------------------------------------------------------------
	define ("RES_SUCCEED", 0);
	define ("RES_UNKNOWN", -1);	//未知错误
	define ("RES_NOLOGINCMD", 9);
	define ("RES_USER_PWD_MISMATCH", 22); //密码不对
	define ("RES_MOBILEPHONE_ALREADY_BINDING", 23); //该手机号已绑定
	define ("RES_MOBILEPHONE_NOT_BINDING", 24); //该手机号没绑定


	define ("APOLLO_CLIENT_TYPE", 3);//web(客户端类型)
	define ("ECMD_NULL", 0); //ECMD_TYPE默认值
	define ("ECMD_LOGIN", 1); //ECMD_TYPE登录
	define ("ECMD_SEND", 2); //ECMD_TYPE发送通知
	define ("ECMD_AUTH", 3); //ECMD_TYPE用户验证
	define ("ECMD_LOGOUT", 4); //ECMD_TYPE用户注销
	define ("ECMD_USERINFO", 5); //ECMD_TYPE用户基本信息
	define ("ECMD_USERCLASS", 6); //ECMD_TYPE用户对应的班级
	define ("ECMD_RESET_PWD", 8); //ECMD_TYPE用户重设密码
	define ("ECMD_MODIFY_MOBILEPHONE", 9); //ECMD_TYPE修改手机号
	define ("ECMD_TEST_MOBILEPHONE_BINDING", 10); //ECMD_TYPE验证手机是否已绑定
	define ("ECMD_MODIFY_USER_INFO", 13); // ECMD_TYPE修改用户信息
	define ("ECMD_GET_SCHOOL_CLASS_LIST", 14); // ECMD_TYPE取学校的班级列表
	define ("ECMD_MOBILEPHONE_GET_USER", 15); // ECMD_TYPE手机号码查找用户
	define ("ECMD_GET_USER_SCHOOLS", 16); // ECMD_TYPE用户的学校列表
	define ("ECMD_GET_SCHOOL_CLASSES", 17); // ECMD_TYPE取用户学校班级列表

    define ("ECMD_CHECK_MOBILE_AUTH_CODE",23);		// 校验手机号验证码
	define ("ECMD_MOBILE_GET_AUTH_CODE", 24); // ECMD_TYPE找回密码时，手机号取验证码
	define ("ECMD_BRING_BACK_PWD_SET_NEW", 25); // ECMD_TYPE找回密码时，用手机号及验证码设置新密码
	define ("ECMD_HISTORY_NOTIFY_LIST", 26); //ECMD_TYPE，Web拉取发送过的通知
	define ("ECMD_MSG_DETAIL", 27); //ECMD_TYPE，web 请求uid对应的消息总数和未读消息总数
	
	define ("ECMD_MODIFY_CLASS_NAME", 28); //ECMD_TYPE修改班级名称
	define("ECMD_DISMISS_CLASS", 29); //解散某一班级
	define ("ECMD_STUDENT_OUT_OF_CLASS", 30); //ECMD_TYPE某一学生退出班级
	define ("ECMD_GET_CLASS_STUDENT_LIST", 31); //ECMD_TYPE取某一班级的学生列表
	define ("ECMD_GET_CLASS_TEACHER_LIST", 32); //ECMD_TYPE取某一班级的老师列表
	define ("ECMD_MODIFY_CLASS_MASTER", 33); //ECMD_TYPE修改某一班级班主任
	define ("ECMD_GET_CLASS_INFO", 34); //ECMD_TYPE取某一班级信息
	define ("ECMD_ADD_STUDENT", 35); //ECMD_TYPE添加某一个学生到班级
	define ("ECMD_ADD_CLASS", 36); //ECMD_TYPE创建一个班级
	define ("ECMD_CHECK_IMPORT_BATCH_STUDENTS", 37); //批量导入学生验证数据
	define ("ECMD_IMPORT_BATCH_STUDENTS", 38); //批量导入学生
	define ("ECMD_GET_AREAS", 41); //获取地区区域等请求
	define("ECMD_GET_USER_MASTER_COUNT", 42);//获取某老师班主任数量
	define("ECMD_CREATE_SCHOOL", 43); //创建学校
	define("ECMD_JUDGE_CLASS_TEACHER", 44); //判断任课老师
	define("ECMD_CHECK_SCHOOL_EXIST", 45); //检查学校是否存在
	define("ECMD_TEACHER_QUIT_CLASS", 46); //某一老师退出班级
	define("ECMD_GET_PARENTS_STUDENT", 47); //获取孩子列表
	define("ECMD_ADD_CLASS_TEACHER", 48);  //添加老师到班级

	define ("ECMD_CLASSFEE_INCOME", 50); //ECMD_TYPE改变班费
	define ("ECMD_CLASSFEE_INFO", 51); //ECMD_TYPE获取班费汇总
	define ("ECMD_CLASSFEE_DETAIL", 52); //ECMD_TYPE获取班费明细
	define ("ECMD_CLASSFEE_TRANSFER", 53); //ECMD_TYPE提款
	define ("ECMD_CLASSFEE_ROLLBACK", 54); //ECMD_TYPE回滚
	define ("ECMD_CLASSFEE_AD_CLICK_STATUS",55);// 取广告点击状态

    define ("ECMD_CLASSFEECARD_GET",70);// 获取我的班费卡
    define ("ECMD_CLASSFEECARD_CHANGE",71);// 兑换班费卡
    define ("ECMD_CLASSFEECARD_ADD",72);// 增加一张班费卡
    define ("ECMD_CLASSFEECARD_INIT_ACTIVE",73);// 生成一次活动
    define ("ECMD_CLASSFEECARD_JOIN_ACTIVE",74);// /参与活动
    define ("ECMD_CLASSFEECARD_GET_ACTIVE_LIST",75);// /获得活动列表
    define ("ECMD_CLASSFEECARD_ROLL_OUT", 79);//班费卡提现
	define ("ECMD_AD_GET_AD_PLACES", 80);// 获取广告位显示列表

	define ("ECMD_CLASSFEECARD_ROLLBACK", 81);//班费卡提现回滚
	define ("ECMD_CLASSFEECARD_QUERY_BILL", 82);//班费卡提现或者回滚账单
	define ("ECMD_CLASSFEECARD_QUERY_WHITE_LIST", 83);//班费卡提现的白名单查询

	define ("ECMD_BEAN_ACQUIRE", 100); //积分请求
	define ("ECMD_BEAN_INFO", 101); //ECMD_TYPE用户的积分信息

	define("ECMD_HISTORY_NOTIFY", 120); //拉取单条的历史通知
	
	//短信服务
	define("ECMD_SEND_SMS", 196); //发送短信
	// 目前位于OMSProxyServer
	define("ECMD_SEND_SMS_LOAD_APP_ADDRESS", 197);			// 发app下载地址内容短信
	
	define("ECMD_SEND_SMS_INVITATION", 198);			// 发送推荐短信
	
	define("ECMD_GET_INVITED_CLASS_FEE_CARD", 199);		// 被推荐人用手机号取班费劵
	
	//登录服务
	define ("ECM_LOGIN_REGISTER", 240); //ECMD_TYPE用户注册
	
	// Class相关
	define ("ECMD_CREATE_CLASS", 300); //ECMD_TYPE创建班级
	define ("ECMD_SEARCH_CLASS", 301); //ECMD_TYPE查找班级
	define ("ECMD_JOIN_CLASS", 302); //ECMD_TYPE加入班级
	define ("ECMD_GET_ClASSGROUPS", 303); //ECMD_TYPE获取用户班级列表
	define ("ECMD_GET_ClASSGINFO", 304); //ECMD_TYPE班级详情
	define ("ECMD_EXITClASS", 305); //ECMD_TYPE退出班级
	define ("ECMD_GETCLASSMEMBER", 306); //ECMD_TYPE获取班级成员
	define ("ECMD_DElETEDCLASSMEMBER", 307); //ECMD_TYPE删除班级成员
	define ("ECMD_SETCLASS", 308); //ECMD_TYPE班级设置
	define ("ECMD_VERIFYJIONCLASS", 309); //ECMD_TYPE入班审核
	define ("ECMD_DISMISSCLASS", 311); //ECMD_TYPE解散班级
	define ("ECMD_GET_ALL_SCHOOL_TYPES", 312); //ECMD_TYPE获取所有学校类型列表
	define ("ECMD_GET_ALL_GRADES", 313); //ECMD_TYPE获取某个学校的所有年级列表
	define ("ECMD_GET_CLASS_GRADE", 314); //ECMD_TYPE获取当前班级的年级
	define ("ECMD_SET_SUBJECT", 315); //修改任教学科
	define ("ECMD_GET_DETAILED_IDENTITY", 316); //获取用户具有的身份
	define ("ECMD_SET_STUDENT_NUMBER", 317);    //修改学生学号
	define("ECMD_GET_TEACHER_OF_ClASS", 318);  //取老师班级
	define("ECMD_SET_PERSONAL_INFO", 319);  //修改个人信息
	define("ECMD_SET_PASSWORD", 320);  //修改密码
	define("ECMD_SET_MOBILE_PHONE", 321);  //修改手机号，绑定手机号
	define("ECMD_CREATE_CHILD", 322);  //创建小孩
	define("ECMD_GET_REC_SCHOOL_ClASS", 323);  //获取收件人学校班级列表


	define("ECMD_GET_TUSER", 324);  //获取取用户信息
	define("ECMD_GET_EMERGENCY_SCHOOL_CLASS_TEACHER", 325);  //获取取用户信息
	define("ECMD_APPLY_AUTH_TEACHER", 329);  //申请教师认证
	define("ECMD_GET_CHILD_INFO", 342); // 获取小孩信息
	
	//AuditServer
	define ("ECMD_SEND_AUDIT_RECORD", 400); //触发班级动态审核 
	define ("ECMD_QUERY_AUDIT_RECORD", 401); //查询班级动态审核记录
	
	//通知
	define ("EMSG_NOTICE_SEND", 501); // 发送通知
	define ("EMSG_NOTICE_GET", 502); // 获取单个人的通知
	define ("EMSG_NOTICE_SENDEDS_GET", 503); // 获取已发通知
	define ("EMSG_NOTICE_SENDED_DETALL_GET", 504); // 获取已发通知的统计数据
	define ("EMSG_NOTICE_BOXS_GET", 505); // 获取推送已发消息盒子
	define ("EMSG_NOTICE_PSUH", 506); // 推送已发消息盒子
	define ("EMSG_NOTICE_ACK_STATUS", 507); // 客户端确认通知状态
	define ("ECMD_FIXED_TIME_NOTICE_SEND", 508); // 发送定时通知
	define ("ECMD_SEND_SYSTEM_NOTICE", 509); // 发送系统通知
	define ("EMSG_SINGLE_NOTICE_GET", 510); // //拉取单条接受消息 （WEB）
	define ("EMSG_SINGLE_SENDED_NOTICE_GET", 511); // /拉取单条已发通知 （WEB）
    define ("ECMD_URGENCY_NOTICE_SEND", 512); // /拉取单条已发通知 （WEB）
    define ("ECMD_SMS_SENDEDS_GET", 515); // /拉取单条已发通知 （WEB）
//ECMD_URGENCY_NOTICE_SEND	  =512,               //发送紧急通知
    /*
    ECMD_FIXED_TIME_NOTICE_SEND   = 508,             //发送定时通知
	ECMD_SEND_SYSTEM_NOTICE       = 509,             //发送系统通知
	EMSG_SINGLE_NOTICE_GET	      = 510,              //拉取单条接受消息 （WEB）
	EMSG_SINGLE_SENDED_NOTICE_GET	      = 511,              //拉取单条已发通知 （WEB）
	*/

	//系统通知
	//define ("ECMD_SEND_SYSTEM_NOTICE", 600); //  发送系统通知
	define ("ECMD_HINT", 601);			     // 服务器发送通知的提示
	define ("ECMD_OFFLINEHINT", 602);           // 服务器发送通知的离线提示
	define ("ECMD_PULL_MESSAGE", 603);			// 拉取通知消息 根据消息的流水ＩＤ
	define ("ECMD_REQMESSAGESTATE", 604);      // 客户端回复所属的通知的消息的状态（已达、已读）
	define ("ECMD_PULL_MESSAGE_LIST", 605);			// Web拉取通知的分页消息内容
	
	//Zone Server
	define ("ECMD_SEND_ZONE_MSG", 600);     //发送班话题消息
	define ("ECMD_GET_ZONE_MSG", 601);     //拉取班级话题贴子
	define ("ECMD_ZONE_GET_TAG_LIST", 602);       //拉取 话题列表
	define ("ECMD_UPDATE_ZONE_MSG_STATUS", 603);       //更新帖子的状态
	define ("ECMD_SEND_ZONE_COMMENT", 604);        //发表帖子的评论
	define ("ECMD_PULL_ZONE_COMMENT", 605);      // 拉取评论
	define ("ECMD_GET_ZONE_MSGDETAIL", 606);      // 获取帖子详细信息
	define ("ECMD_CREATE_ZONE", 607);        //发布话题
	define ("ECMD_SEND_ZONE_TOPHOTS", 608);        //发布广告
	define ("ECMD_GET_ZONE_MAIM", 609);       //获取发现首页
	define ("ECMD_GET_ZONE_ZONES", 610);         //获取所有话题
	define ("ECMD_GET_ZONE_PUBLISHTOPADV", 611);         //发布广告
	define ("ECMD_UPDATE_ZONE_OBJECTLOCATION", 612);        //更新位置
	define ("ECMD_UPDATE_ZONE_ROBOTSTATISTICS", 613);        //更新机器人数据
	define ("ECMD_DELETE_ZONE_DELETECONTENT", 614);        //删除内容
	define ("ECMD_GET_ZONE_DETAIL", 615);      // 获取空间详情
	define ("ECMD_GET_ZONE_LIKER", 616);    //获取点赞人
	define ("ECMD_WEB_IMPORT_STUDENT_GUARDIAN_INTO_CLASS", 750);    //web导入学生
    define ("ECMD_WEB_SMS_INVITATION", 751);    //web导入后发送短信邀请　
    define ("ECMD_WEB_IMPORT_TEACHER_INTO_CLASS", 752);    //web添加老师
    define ("ECMD_CONTAIN_BAD_WORD", 800);    //web添加老师
    define ("ECMD_PULL_NEW_GET_USER_TEACH_CID", 820);    //获取用户在活动期间可接新的班级
    define ("ECMD_PULL_NEW_CID_UP_TO_STANDARD", 821);    //获取用户在活动期间班级是否达标具有特权
    



   	define ("APOLLO_OFFICIAL_ACCOUNT", APOLLO_API_DOMAIN.":19801/httpofficialaccount"); //自助公众号服务
    define ("APOLLO_OFFICIAL_ACCOUNT_MANAGER", APOLLO_API_DOMAIN.":19801/httpoamanage"); //总后台公众号服务
	
	define ("APOLLO_USER_BEAN", APOLLO_API_DOMAIN.":19801/bean"); //青豆服务
	define ("APOLLO_USER_UPDATE", APOLLO_API_DOMAIN.":19801/update"); //更新用户资料
	define ("APOLLO_USER_QUERY", APOLLO_API_DOMAIN.":19801/query"); //查询用户资料
	define ("APOLLO_CLASS_EXPENSE", APOLLO_API_DOMAIN.":19801/classaccount"); //班费服务
	define ("APOLLO_CLASS_CLASSFEECARD", APOLLO_API_DOMAIN.":19801/classfeecard"); //班费服务
	define ("APOLLO_USER_LOGIN", APOLLO_API_DOMAIN.":19801/login"); //登陆服务
	define ("APOLLO_NOTICE_PUSH", APOLLO_API_DOMAIN.":19801/push"); //发送通知
	define ("APOLLO_NOTICE_RECEIVE", APOLLO_API_DOMAIN.":19801/receive"); //获取通知
	define ("APOLLO_APP_UPGRADE", APOLLO_API_DOMAIN.":19801/upgrade"); //升级服务
	define ("APOLLO_CLASS_INFO", APOLLO_API_DOMAIN.":19801/httpclass"); //创建班级、查找班级、加入班级接口服务
	define ("APOLLO_ADAPTE_INFO", APOLLO_API_DOMAIN.":19801/adapte"); //导入学生等适配服务
	define ("APOLLO_CLASS_AUDIT", APOLLO_API_DOMAIN.":19801/audit"); //动态审核
	define ("APOLLO_CLASS_ZONE", APOLLO_API_DOMAIN.":19801/zone"); //班级圈	
	define ("APOLLO_OMS_PROXY", APOLLO_API_DOMAIN.":19801/omsproxy"); //推送	
	define ("APOLLO_WORD_PROXY", APOLLO_API_DOMAIN.":19801/word"); //字符串服务
	define ("APOLLO_PULL_NEW_PROXY", APOLLO_API_DOMAIN.":19801/pullnew"); //拉新活动服务


    
