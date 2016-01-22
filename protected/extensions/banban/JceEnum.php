<?php

class ENoticeType
{
    const EHOMEWORK = 0;
    const ENOTIFY = 1;
    const ECOMMENT = 2;
    const EALL = 3; //当请求这种通知类型时，取所有的类型的前十条（即一页），再按时间排序，取出十条回复给客户端
}

class EReceiverObjectType
{
    const ENULL = 0;
    const ECLASS = 1; //班级
    const EGROUP = 2; //分组
    const EGRADE = 3; //年级
    const EALLTEACHER = 4; //全体老师
    const EPERSON = 5;  //个人
}

//获取验证码的类型
class AuthType
{
    const AUTH_REGISTER       = 1; //注册
    const AUTH_GETPWD         = 2; //找回密码,重置密码
    const AUTH_EDITMOBILE     = 3; //修改绑定手机
    const AUTH_CHANGECLASSFEE = 4; //班费转出
}

// class EPlatformType
// {
//     const EWEB = 0; //WEB,PC 端
//     const EANDROID = 1;   //Android终端
//     const EIOS = 2;  //苹果终端
// };

// 班费操作事件
class ClassFeeEventID
{
    const EVENT_CREATE = 1;       //创建班级        +
    const EVENT_ACTIVE = 2;         //激活           +
    const EVENT_ADVERT = 3;   //点击广告             +
    const EVENT_DEPOSIT = 4;    //提款               -
    const EVENT_ROLLBACK = 5;   //回退提款           +
    const EVENT_OWN_ADVERT = 6; //自有广告点击    +
    const EVENT_SYSTEM_ADD = 7; //系统赠送    +
    const EVENT_SENDNOTICE = 10;
    const EVENT_MALL_CONSUME = 11; // 商城消费      - 
};

//班费相关返回状态
class ClassFeeStatus
{
    const RES_CLASS_FEE_INSUFFICIENT_BALANCE		= 40;	// 班费余额不足
    const RES_CLASS_FEE_LOG_NOT_EXIST			    = 41;	// 班费明细单号不存在
    const RES_CLASS_FEE_LOG_NOT_TO_DRAW_MONEY		= 42;	// 班费明细不是提款单
    const RES_CLASS_FEE_LOG_YOU_NOT_OWNER			= 43;	// 该明细不是本人操作
    const RES_CLASS_FEE_LOG_ROLLBACK_VALUE_MISMATCH	= 44;	// 回滚提现金额不匹配
    const RES_CLASS_FEE_ADVERT_CLICK_TIMES_OVERRANGING	= 45;	// 当天用户广告点击超次数
//     const RES_CLASS_FEE_BALANCE_LESS_THAN_LOWER_LIMIT	= 46;	// 余额少于提现下限
    const RES_CLASS_FEE_BALANCE_LOWER_FIRST_TRANSFER_LIMIT	= 46;	// 余额少于提现下限(首次300)
    const RES_CLASS_FEE_UERINFO_ERROR = 47;                     //操作uid或者用户名错误
    
    const RES_CLASS_FEE_TRANSFER_FORBID_CID = 59;        //班级id为禁止班费转出操作的
    const RES_CLASS_FEE_TRANSFER_OUT_OF_UPPER_LIMIT  = 60;      //转出班费本月用户超限
    
    const RES_CLASS_FEE_BALANCE_LOWER_NORMAL_TRANSFER_LIMIT  = 62;      //余额少于提现下限（非首次50）
}

//班级操作相关回包状态
class ClassStatus
{
    const RES_CLASS_NOT_EXIST                       = 29;  //班级不存在
    const RES_NOT_CLASS_TEACHER                     = 30;  //不是班级老师
    const RES_SCHOOL_NOT_EXIST                      = 31;  //学校不存在
    
    const RES_HTTPCLASS_EXIST_SAME_STUDENT_NAME     = 100; //同班级中已经存在同名学生
    const RES_HTTPCLASS_AS_MASTER_COUNT_OVERRANGING = 101; //一个老师做为班主任的班级个数超限
    const RES_HTTPCLASS_ALREADY_IS_CLASS_TEACHER    = 102; //该老师已经是当前班级的老师
    
    const RES_JOIN_CLASS_NOT_EXIST_CLASS             = 3021;    // 加入班级，班级不存在
    const RES_JOIN_CLASS_MASTER                      = 3022;    //  加入班级， 班主任不存在
    const RES_JOIN_CLASS_TYPE_ERROR                  = 3023; 	// 加入班级，type错误
    const RES_FORBID_JOIN_CLASS                      = 3024; // 加入班级，班级禁止加入
    const RES_JOIN_CLASS_SUBMITTED		             = 3025;			// 加入班级，申请已经提交
    
    const RES_ClASSMEMBER_CID					= 3061;		// 获取班级的成员请求, 班级不存在
    const RES_ClASSMEMBER_STUDENT			    = 3062;		// 获取班级的成员请求, 学生不存在
    const RES_ClASSMEMBER_TEACHER				= 3063;		// 获取班级的成员请求, 老师不存在
}

//发送验证码回包状态
class SendCodeStatus
{
    const RES_PHONE_REQUEST_TIMES_OVERRANGING = 25; //当天请求超过限制次数
    const RES_PHONE_REQUEST_SEND_SMS_FAILED   = 26; //发送失败
    const RES_AUTHCODE_OUT_OF_DATE            = 27; //验证码过期
    const RES_AUTHCODE_MISMATCH               = 28; //验证码不匹配
    const RES_EXCEED_FREQLIMIT                = 61; //超过发送次数限制
}

//用户注册回包状态
class UserRegisterStatus
{
    const RES_REGISTER_USER_FAIL    = 131;  //添加新用户失败
}
