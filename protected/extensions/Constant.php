<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-7-29
 * Time: 下午5:32
 */

class Constant
{

    /*
     *      "0" => '系统消息',
            '1' => '家庭作业',
            '2' => '通知家长', //这是老师发给家长的
            '3' => '在校表现',
            '4' => '紧急通知',
            '5' => '成绩通知',
            '6' => '邀请',
            '7' => '通知老师', //这是老师发给老师的
            '8' => '学校餐单'); //这是老师发给老师的
     */
    const NOTICE_TYPE_0 = "0";
    const NOTICE_TYPE_1 = "1";
    const NOTICE_TYPE_2 = "2";
    const NOTICE_TYPE_3 = "3";
    const NOTICE_TYPE_4 = "4";
    const NOTICE_TYPE_5 = "5";
    const NOTICE_TYPE_6 = "6";
    const NOTICE_TYPE_7 = "7";
    const NOTICE_TYPE_8 = "8";
    const NOTICE_TYPE_9 = "9";

    const FAMILY_IDENTITY = 4; //家长身份标志
    const TEACHER_IDENTITY = 1; //老师身份标志
    const STUDENT_IDENTITY = 2; //学生身份标志
    const TEACHER_FAMILY_IDENTITY = 5; //(老师,家长)共同身份标志

    const LOGIN_TYPE_TEACHER = 1; //老师登录标志
    const LOGIN_TYPE_FAMILY = 4; //家长登录标志

    const MESSAGE_PAGE_SIZE = 10; //每页消息数d

    const MESSAGE_REPLY_PAGE_SIZE = 15; //评论每页数d


    const APPID1 = 1; //布置作业
    const APPID2 = 2; //通知家长
    const APPID3 = 3; //通知老师
    const APPID4 = 4; //在校表现
    const APPID5 = 5; //教育资讯
    const APPID6 = 6; //课程表
    const APPID7 = 7; //餐单管理
    const APPID8 = 8; //新菜单
    const APPID9 = 9; //紧急通知
    const APPID10 = 10; //蜻豆商城
    const APPID11 = 11; //班级通知
    const APPID12 = 12; //学校通知
    const APPID13 = 13; //成绩管理
    const APPID14 = 14; //我的宝贝
    const APPID15 = 15; //自定义分组
    const APPID16 = 16; //消息审核
    const APPID17 = 17; //花名册
    const APPID18 = 18; //电话本
    const APPID19 = 19; //消息监控
    const APPID20 = 20; //自定义签名
    const APPID21 = 21; //定向发送


    const CACHE_BADWORD_LIST = "cache_badword_list"; //所有敏感词缓存常量
    const CACHE_SCHOOL_LIST = "cache_school_list"; //所有学校缓存常量

    const ANEW_PINVITE_DAY_COUNT = 1; //重新邀请每天一次
    const ANEW_PINVITE_DAY_NUMS = 100; //重新邀请短信一天100次
    const CLASS_TOTAL = 100; //班级最大人数
    const CLASS_MIN_TOTAL = 20; //班级最小人数

    const GIFT_ACTIVITY_ACTIVEUSERS = 30; //礼包兑换需达到人数
    const GIFT_ACTIVITY_BEANS = 500; //礼包兑换需达到青豆数

    const EXPENSE_FIRST_TRANSFER = 200; //转费转出首次下限
    const EXPENSE_NORMAL_TRANSFER = 200; //班费转出正常下限
    const EXPENSE_MONTH_QUOTA = 800; //每月最高限额

    const NOTICE_PLATFORM_0 = 0; //发送平台0：web，1：android，2：ios,3:新班班
    const NOTICE_PLATFORM_1 = 1;
    const NOTICE_PLATFORM_2 = 2;
    const NOTICE_PLATFORM_3 = 3;


    const  UNKNOWN_SCHOOL_SID = 9999; //创建班级后未选择学校，暂用这个，表示未知学校，待选择学校后，update过来

    //写到sms里的字段，记录是哪种短信类型
    const SMS_HOMEWORK = 1; //家庭作业
    const SMS_NOTICE = 2; //家长学校通知
    const SMS_PERFORMANCE = 3; //在校表现
    const SMS_EMERGENCY = 4; //紧急通知
    const SMS_SCORE = 5; //成绩通知
    const SMS_INVITATION = 6; //邀请
    const SMS_TEACHERNOTICE = 7; //老师学校通知
    const SMS_MEALMENU = 8; //工作餐单
    const SMS_VERIFICATIONCODE = 11; //验证码
    const SMS_ACCOUNTPWD = 12; //账号密码
    const SMS_CLASSFEE_ROLLOUT = 13; //班费转出提醒
    const SMS_BRING_BACK_PWD = 14; //回密码
    const SMS_MODIFY_MOBILE = 15; //修改手机号
    const SMS_OTHER = 98; //其它消息
    const SMS_SYS = 99; //系统消息

    const  DIRECTION_UP = 1;		// 表示向上（即取比较新的记录）
    const DIRECTION_DOWN = 2;		// 表示向下（即比较旧的历史记录）
    const DIRECTION_FORCE = -1;    //强制拉取一页


    /*
     * 通知类型
     */
    public static function noticeTypeArray()
    {
        return array(
            "0" => '系统消息',
            '1' => '家庭作业',
            '2' => '通知家长', //这是老师发给家长的
            '3' => '在校表现',
            '4' => '紧急通知',
            '5' => '成绩通知',
            '6' => '邀请',
            '7' => '通知老师', //这是老师发给老师的
            '8' => '学校餐单', //这是老师发给老师的
        );
    }

    public static function evaluatetypeArr()
    {
        return array('0' => '表扬', '1' => '批评');
    }

    /*
     * 根据通知类型id获取通知类型
     */
    public static function  getNoticeTypeById($noticeId)
    {
        $arr = self::noticeTypeArray();
        return $arr[$noticeId];
    }

    /*
     *  前台班主任添加学生,导入学生发送的短信密码内容　　
     */
    public static function getFrontFamilySendPwdSms()
    {
        $msg = "家长您好：我是%s的%s老师，邀请您使用“" . SITE_NAME . "”APP，接收您孩子的学校通知、作业及联系老师。点击 " . SITE_APP_DOWNLOAD_SHORT_URL .
            " 下载即可使用，动动手指还可以挣班费！您的帐号：%s，初始密码：%s。登录后建议修改密码。咨询电话4001013838。";
        //$msg=str_replace("未知学校的",'',$msg);
        return $msg;
    }


    /*
 * 前台班主任添加老师,导入老师发送的短信密码内容　　　
 */
    public static function getFrontTeacherSendPwdSms()
    {
        $msg = '%s老师:我是%s' . '的%s' . '老师，我刚在' . SITE_NAME . '创建了班级，并为你开通了登录账号，账号：%s' . ',初始密码:%s' . ',大家可以在上面交流了。下载地址：' . SITE_APP_DOWNLOAD_SHORT_URL;
        //$msg=str_replace("未知学校的",'',$msg);
        return $msg;
    }

    /*
     * 其它发送密码短信内容　
     */
    public static function getPublicSendPwdSms()
    {
        $msg = "你好！感谢您使用" . SITE_NAME . "（" . SITE_APP_DOWNLOAD_URL . "）,平台有家校沟通丶成绩管理等功能，我们的手机客户端同时推出，点击（" . SITE_APP_DOWNLOAD_SHORT_URL . "） 即可下载安装。您的账号:%s，密码:%s。客服电话:4001013838，工作时间:08:00-20:00";
        return $msg;
    }

    public static function getProvinceCity(){
      //  return
    }
}