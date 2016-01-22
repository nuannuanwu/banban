<?php
/**
* @author panrj 2015-02-02
* 财付通辅助类，提供常用方法
*/
error_reporting(0);
require_once ("tenpay/classes/client/TenpayHttpClient.class.php");
require_once ("tenpay/classes/client/DirectTransClientRequestHandler.class.php");
require_once ("tenpay/classes/client/DirectTransClientResponseHandler.class.php");

require_once ("tenpay/classes/RequestHandler.class.php");
require_once ("tenpay/classes/client/ClientResponseHandler.class.php");

class TenpayHelper
{
    /**
     * 批量银行代付提交接口
     * @param  array   $records 提交参数
     * @param  integer $num     总笔数
     * @param  integer $amt     总金额(以分为单位)
     */
    public static function payTransfer($record=null,$records=array())
    {
        $num = $record?$record->count:0;
        $amt = $record?$record->amount:0;
        $package_id=$record?$record->package:'';
        /* 创建支付请求对象 */
        $reqHandler = new DirectTransClientRequestHandler();
        //通信对象
        $httpClient = new TenpayHttpClient();
        //应答对象
        $resHandler = new DirectTransClientResponseHandler();
        $reqHandler->init();
        $reqHandler->setKey(TENPAY_KEY);

        //设置请求参数
        $reqHandler->setParameter("op_code", "1013");      
        // $reqHandler->setParameter("service_version", "1.2");                 
        $reqHandler->setParameter("op_name", "batch_draw"); 
        $reqHandler->setParameter("op_user", TENPAY_OP_USER); 
        $reqHandler->setParameter("op_passwd", md5(TENPAY_OP_PASSWD));  
        $reqHandler->setParameter("op_time", self::microtime_format("YmdHisx",self::microtime_float()));
        $reqHandler->setParameter("sp_id", TENPAY_SP_ID);   
        $reqHandler->setParameter("package_id", $package_id?$package_id:self::microtime_format("YmdHisx",self::microtime_float()));
        $reqHandler->setParameter("total_num", (int)$num);
        $reqHandler->setParameter("total_amt", (int)$amt);
        $reqHandler->setParameter("client_ip", TENPAY_CLIENT_IP);
        //setParameter只能设置一级参数，下级的xml当为上级的参数
        $reqHandler->setParameter("record_set", self::setRecordSet($records));
        // mlog($reqHandler);
        //设置商户证书
        $httpClient->setCertInfo(TENPAY_CERTPATH, TENPAY_CERTPASSWORD);
        //设置CA
        $httpClient->setCaInfo(TENPAY_CAPATH);
        //设置请求内容
        $httpClient->setReqContent($reqHandler->getRequestURL());
        //设置超时
        $httpClient->setTimeOut(20);

        if($httpClient->call()) {
            //取结果参数做业务处理
            $fcontents = $httpClient->getResContent();
            $xml = simplexml_load_string($fcontents);
            if(!$xml){
                $fcontents = preg_replace('/[^(\x20-\x7F)]*/','', $fcontents);
            }
            // $fcontents = mb_convert_encoding($fcontents,'GB2312','GBK,UTF-8,GB2312,UTF-32BE,UTF-32LE,UTF-16BE,UTF-16LE,ASCII,JIS,EUC-JP,SJIS');
            $resHandler->setContent($fcontents);
            $resHandler->setKey(TENPAY_KEY);
            
            if($resHandler->getParameter("retcode")== "0" || $resHandler->getParameter("retcode") == "00") {
                //取结果参数做业务处理
                echo "OK,package_id=" . $resHandler->getParameter("package_id") . "<br>";
                $record->payretcode = $resHandler->getParameter("retcode");
                return $record->payretcode;
            } else {
                //错误时，返回结果未签名。
                //如包格式错误或未确认结果的，请使用原来批次号重新发起，确认结果，避免多次操作
                // echo "business error message:" . $resHandler->getParameter("retcode") . "," . mb_convert_encoding($resHandler->getParameter("retmsg"),'UTF-8', 'GB2312,GBK,UTF-8' ) . "<br>";
                $record->payretcode = $resHandler->getParameter("retcode") . "," . mb_convert_encoding($resHandler->getParameter("retmsg"),'UTF-8', 'GB2312,GBK,UTF-8');
                return $resHandler->getParameter("retcode");
            }
        } else {
            //后台调用通信失败
            // echo "call err:" . iconv('GB2312', 'UTF-8//IGNORE', $httpClient->getErrInfo()) . "<br>";
            $record->payretcode = mb_convert_encoding($httpClient->getErrInfo(),'UTF-8', 'GB2312,GBK,UTF-8');
            //有可能因为网络原因，请求已经处理，但未收到应答。
            return false;
        }
        return false;
    }

    public static function queryTransfer($packid='')
    {
        /* 创建支付请求对象 */
        $reqHandler = new DirectTransClientRequestHandler();
        //通信对象
        $httpClient = new TenpayHttpClient();
        //应答对象
        $resHandler = new DirectTransClientResponseHandler();
        $reqHandler->init();
        $reqHandler->setKey(TENPAY_KEY);

        //设置请求参数
        $reqHandler->setParameter("op_code", "1014");           
        $reqHandler->setParameter("service_version", "1.2");                    
        $reqHandler->setParameter("op_name", "batch_draw_query");   
        $reqHandler->setParameter("op_user", TENPAY_OP_USER); 
        $reqHandler->setParameter("op_passwd", md5(TENPAY_OP_PASSWD));  
        $reqHandler->setParameter("op_time", self::microtime_format("YmdHisx",self::microtime_float()));
        $reqHandler->setParameter("sp_id", TENPAY_SP_ID);   
        $reqHandler->setParameter("package_id", $packid);
        $reqHandler->setParameter("client_ip", TENPAY_CLIENT_IP);
        
        //设置商户证书
        $httpClient->setCertInfo(TENPAY_CERTPATH, TENPAY_CERTPASSWORD);
        //设置CA
        $httpClient->setCaInfo(TENPAY_CAPATH);
        //设置请求内容
        $httpClient->setReqContent($reqHandler->getRequestURL());
        //设置超时
        $httpClient->setTimeOut(20);

        $record = TenpayRecord::model()->findByPk($packid);

        if($httpClient->call()) {
            $fcontents = $httpClient->getResContent();
            $xml = simplexml_load_string($fcontents);
            if(!$xml){
                $fcontents = preg_replace('/[^(\x20-\x7F)]*/','', $fcontents);
            }
            // $fcontents = mb_convert_encoding($fcontents,'GB2312','GBK,UTF-8,GB2312,UTF-32BE,UTF-32LE,UTF-16BE,UTF-16LE,ASCII,JIS,EUC-JP,SJIS');
            $resHandler->setContent($fcontents);
            $resHandler->setKey(TENPAY_KEY);

            if($resHandler->getParameter("retcode")== "0" || $resHandler->getParameter("retcode") == "00") {
                //取结果参数做业务处理
                $allParemeters = $resHandler->getAllParameters();
                $record->queryretcode = $resHandler->getParameter("retcode");
                $record->save();
                // var_dump($allParemeters);
                // echo "<pre>";print_r(self::xml_to_array($allParemeters['result']));
                // echo "OK,package_id=" . $resHandler->getParameter("package_id") . "<br>";
                return $allParemeters;
            } elseif($resHandler->getParameter("retcode")=="03020165") {
                return $resHandler->getParameter("retcode");
            } else {
                //错误时，返回结果未签名。
                //如包格式错误或未确认结果的，请使用原来批次号重新发起，确认结果，避免多次操作
                // echo "business error message:" . $resHandler->getParameter("retcode") . "," . iconv('GB2312', 'UTF-8//IGNORE', $resHandler->getParameter("retmsg")) . "<br>";
                $record->queryretcode = $resHandler->getParameter("retcode") . "," . mb_convert_encoding($resHandler->getParameter("retmsg"),'UTF-8', 'GB2312,GBK,UTF-8');
                $record->save();
                return false;
            }
        } else {
            //后台调用通信失败
            // echo "call err:" . iconv('GB2312', 'UTF-8//IGNORE', $httpClient->getErrInfo()) . "<br>";
            $record->queryretcode = mb_convert_encoding($httpClient->getErrInfo(),'UTF-8', 'GB2312,GBK,UTF-8');
            $record->save();
            //有可能因为网络原因，请求已经处理，但未收到应答。
            return false;
        }
        return false;
    }

    public static function refundTransfer()
    {
        $partner = TENPAY_SP_ID;
        $key = TENPAY_KEY;
        $starttime =  date("YmdHis",strtotime("-30 day"));
        $endtime =  date("YmdHis",time());
        /* 创建支付请求对象 */
        $reqHandler = new RequestHandler();
        //通信对象
        $httpClient = new TenpayHttpClient();
        //应答对象
        $resHandler = new ClientResponseHandler();
        //-----------------------------
        //设置请求参数
        //-----------------------------
        $reqHandler->init();
        $reqHandler->setKey($key);

        $reqHandler->setGateUrl("http://api.mch.tenpay.com/cgi-bin/agent_pay_refund.cgi");
        $reqHandler->setParameter("partner", $partner);
        $reqHandler->setParameter("start_time", $starttime);
        $reqHandler->setParameter("end_time", $endtime);

        //可选系统参数
        $reqHandler->setParameter("sign_type", "MD5");
        $reqHandler->setParameter("service_version", "1.0");
        $reqHandler->setParameter("input_charset", "GBK");
        $reqHandler->setParameter("sign_key_index", "1");
        //可选业务参数
        $reqHandler->setParameter("bank_type", "");     
        $reqHandler->setParameter("rec_bankacc", "");       
        $reqHandler->setParameter("rec_name", "");      
        //-----------------------------
        //设置通信参数
        //-----------------------------
        $httpClient->setTimeOut(5);
        //设置请求内容
        $httpClient->setReqContent($reqHandler->getRequestURL());
        //后台调用
        if($httpClient->call()) {
            //设置结果参数
            $resHandler->setContent($httpClient->getResContent());
            $resHandler->setKey($key);
            //判断签名及结果
            //只有签名正确并且retcode为0才是请求成功
            if($resHandler->isTenpaySign() && $resHandler->getParameter("retcode") == "0" ) {
                //取结果参数做业务处理
                $allParemeters = $resHandler->getAllParameters();
                return $allParemeters;
            } else {
                //错误时，返回结果可能没有签名，记录retcode、retmsg看失败详情。
                echo "验证签名失败 或 业务错误信息:retcode=" . $resHandler->getParameter("retcode"). ",retmsg=" . mb_convert_encoding($resHandler->getParameter("retmsg"),'UTF-8', 'GB2312,GBK,UTF-8') . "<br>";
            }
        } else {
            //后台调用通信失败
            echo "call err:" . $httpClient->getResponseCode() ."," . mb_convert_encoding($httpClient->getErrInfo(),'UTF-8', 'GB2312,GBK,UTF-8') . "<br>";
            //有可能因为网络原因，请求已经处理，但未收到应答。
        }
        return false;
    }

    /**
     * 获取当前时间戳，精确到毫秒
     * @return [type] [description]
     */
    public static function microtime_float()
    {
       list($usec, $sec) = explode(" ", microtime());
       return ((float)$usec + (float)$sec);
    }

    /**
     * 格式化时间戳，精确到毫秒，x代表毫秒
     * @param  string  $tag  格式
     * @param  float  $time  时间戳
     * @param  integer $len  毫秒位数
     */
    public static function microtime_format($tag, $time, $len=3)
    {
       list($usec, $sec) = explode(".", $time);
       $date = date($tag,$usec);
       if($len>0){
            $sec = substr($sec, 0, $len);
       }
       return str_replace('x', $sec, $date);
    }  

    /**
     * xml字符串转数组
     * @param  string $xml xml字符串
     * @return array 
     */
    public static function xml_to_array( $xml )
    {
        $reg = "/<(\\w+)[^>]*?>([\\x00-\\xFF]*?)<\\/\\1>/";
        if(preg_match_all($reg, $xml, $matches))
        {
            $count = count($matches[0]);
            $arr = array();
            for($i = 0; $i < $count; $i++)
            {
                $key= $matches[1][$i];
                $val = self::xml_to_array( $matches[2][$i] );  // 递归
                if(array_key_exists($key, $arr))
                {
                    if(is_array($arr[$key]))
                    {
                        if(!array_key_exists(0,$arr[$key]))
                        {
                            $arr[$key] = array($arr[$key]);
                        }
                    }else{
                        $arr[$key] = array($arr[$key]);
                    }
                    $arr[$key][] = $val;
                }else{
                    $arr[$key] = $val;
                }
            }
            return $arr;
        }else{
            return $xml;
        }
    }  

    /**
     * 银行代付明细设置，返回xml串
     * @param array $records = array(
     *        array(
     *           // 'serial'=>0,     //单笔序列号,取key值（同一个批次内的明细序号要保证唯一，不能超过32个字符）
     *           'rec_bankacc'=>0,   //收款方银行帐号
     *           'bank_type'=>0,     //银行类型（每个银行对应的4位数字编码）
     *           'rec_name'=>0,      //收款方真实姓名（个人名称大于等于4个字节，公司名称大于等于9个字节）
     *           'pay_amt'=>0,       //付款金额(以分为单位)
     *           'acc_type'=>0,      //账户类型(1为个人账户,2为公司账户)
     *           'area'=>0,          //开户地区(1～2位数字编码，不支持汉字，如果银行不验证，可以填写为0)
     *           'city'=>0,          //开户城市(1～4位数字编码，不支持汉字，如果银行不验证，可以填写为0)
     *           'subbank_name'=> '',//支行名称（汉字，参考5.2章节填写要求；如果银行不验证，可以填写为全角空格）
     *           'desc'=>0,          //付款说明
     *           'recv_mobile'=>0,   //付款接收通知手机号
     *       );
     *   );
     */
    public static function setRecordSet($records=array())
    {
        // $records = array(
        //     array(
        //         'rec_bankacc'=>'6225887811111111', 
        //         'bank_type'=>1001,
        //         'rec_name'=>'张三',
        //         'pay_amt'=>1,
        //         'acc_type'=>1,
        //         'area'=>20,
        //         'city'=>775,
        //         'subbank_name'=> '招商银行深圳泰然金谷支行',
        //         'desc'=>'0', 
        //         'recv_mobile'=>'13631511111',
        //     ),
            // array(
            //     'rec_bankacc'=>'6225887822222222', 
            //     'bank_type'=>1001,
            //     'rec_name'=>'李四',
            //     'pay_amt'=>2,
            //     'acc_type'=>1,
            //     'area'=>20,
            //     'city'=>775,
            //     'subbank_name'=> '招商银行深圳泰然金谷支行',
            //     'desc'=>'代付测试', 
            //     'recv_mobile'=>'13631522222',
            // ),
        // );

        $xml = '';
        foreach(self::recordCharSet($records) as $record){
            $item = '<record><serial>'.$record['serial'].'</serial><rec_bankacc>'.$record['rec_bankacc'].'</rec_bankacc><bank_type>'.$record['bank_type'].'</bank_type><rec_name>'.$record['rec_name'].'</rec_name><pay_amt>'.$record['pay_amt'].'</pay_amt><acc_type>'.$record['acc_type'].'</acc_type><area>'.$record['area'].'</area><city>'.$record['city'].'</city><subbank_name>'.$record['subbank_name'].'</subbank_name><desc>'.$record['desc'].'</desc><recv_mobile>'.$record['recv_mobile'].'</recv_mobile></record>';
            $xml = $xml.$item;
        }
        return $xml;
    }

    /**
     * 银行代付明细中文utf8转GB2312
     * @param  array $records 银行代付明细数组
     * @return array 
     */
    public static function recordCharSet($records,$origin='UTF-8',$target='GB2312')
    {
        $result = array();
        foreach($records as $key=>$record){
            foreach(array_keys($record) as $k){
                $record[$k] = mb_convert_encoding($record[$k], $target,$origin);
                // $record[$k] = iconv($origin, $target.'//IGNORE', $record[$k]);
            }
            $result[$key] = $record;
        }
        return $result;
    } 

    public static function getTenpayErrorCode()
    {
        $arr = array(
            '03020165',//没有该批次数据
            '03020004',//解析XML请求文档失败,参数格式异常
            '03020007',//您当前没有该功能的操作权限，请联系管理员申请开通
            '03020008',//帐号余额不足，请补足余额
            '03020081',//操作失败，生成批量处理单号失败
            // '03020083',//该批次正在处理中，请稍后查询结果
            '03019001',//系统繁忙，网络问题，请通知管理员
            '03019004',//系统内部错误
            '03020011',//操作员密码错误
            // '1165',//该批次已经存在
            '1166',//计划付款金额超出限额
            '1167',//计划付款笔数超出限额
            '1168',//付款金额超限
            // '1172',//该明细记录已存在
            '1178',//该批次信息的状态非法
            '9999',//未定义错误
        );
        return $arr;
    }
    
    /**
     * 获取银行地区/省
     * @return array 
     */
    public static function getProvs()
    {        
        $provArr = Array
        (
            1 => '北京',
            2 => '上海',
            3 => '天津',
            4 => '重庆',
            5 => '河北',
            6 => '山西',
            7 => '内蒙古',
            8 => '辽宁',
            9 => '吉林',
            10 => '黑龙江',
            11 => '江苏',
            12 => '浙江',
            13 => '安徽',
            14 => '福建',
            15 => '江西',
            16 => '山东',
            17 => '河南',
            18 => '湖北',
            19 => '湖南',
            20 => '广东',
            21 => '广西',
            22 => '海南',
            23 => '四川',
            24 => '贵州',
            25 => '云南',
            26 => '西藏',
            27 => '陕西',
            28 => '甘肃',
            29 => '宁夏',
            30 => '青海',
            31 => '新疆',
        );
        
        return $provArr;
    }

    /**
     * 获取银行城市
     * @return array 
     */
    public static function getCitys(){
        
        $citys = Array
        (
            1 => Array
            (
                10 => '北京',
            ),
        
            2 => Array
            (
                21 => '上海',
            ),
        
            3 => Array
            (
                22 => '天津',
            ),
        
            4 => Array
            (
                23 => '重庆',
                230 => '涪陵市',
                231 => '万州市',
                232 => '黔江市'
            ),
        
            5 => Array
            (
                311 => '石家庄',
                313 => '张家口',
                314 => '承德',
                335 => '秦皇岛',
                315 => '唐山',
                316 => '廊坊',
                312 => '保定',
                317 => '沧州',
                318 => '衡水',
                319 => '邢台',
                310 => '邯郸'
            ),
        
            6 => Array
            (
                351 => '太原',
                352 => '大同',
                349 => '朔州',
                353 => '阳泉',
                355 => '长治',
                356 => '晋城',
                350 => '忻州',
                358 => '离石',
                354 => '晋中',
                357 => '临汾',
                359 => '运城',
                242 => '吕梁市'
            ),
        
            7 => Array
            (
                471 => '呼和浩特',
                472 => '包头',
                473 => '乌海',
                476 => '赤峰',
                470 => '海拉尔',
                482 => '乌兰浩特',
                475 => '通辽',
                479 => '锡林浩特',
                474 => '集宁',
                477 => '东胜',
                478 => '临河',
                483 => '阿拉善左旗',
                480 => '巴彦淖尔市',
                489 => '鄂尔多斯市',
                481 => '呼伦贝尔市',
                484 => '乌兰察布市',
                485 => '锡林郭勒盟',
                486 => '兴安盟'
            ),
        
            8 => Array
            (
                24 => '沈阳',
                421 => '朝阳',
                418 => '阜新',
                410 => '铁岭',
                413 => '抚顺',
                414 => '本溪',
                419 => '辽阳',
                412 => '鞍山',
                415 => '丹东',
                411 => '大连',
                417 => '营口',
                427 => '盘锦',
                416 => '锦州',
                429 => '葫芦岛'
            ),
        
            9 => Array
            (
                431 => '长春',
                436 => '白城',
                438 => '松原',
                432 => '吉林',
                434 => '四平',
                437 => '辽源',
                435 => '通化',
                439 => '白山',
                433 => '延吉',
                247 => '延边州'
            ),
        
            10 => Array
            (
                451 => '哈尔滨',
                452 => '齐齐哈尔',
                456 => '黑河',
                459 => '大庆',
                458 => '伊春',
                468 => '鹤岗',
                454 => '佳木斯',
                469 => '双鸭山',
                464 => '七台河',
                467 => '鸡西',
                453 => '牡丹江',
                455 => '绥化',
                457 => '加格达奇',
                285 => '大兴安岭地区'
            ),
        
            11 => Array
            (
                25 => '南京',
                512 => '苏州',
                516 => '徐州',
                518 => '连云港',
                527 => '宿迁',
                517 => '淮安',
                515 => '盐城',
                514 => '扬州',
                523 => '泰州',
                513 => '南通',
                511 => '镇江',
                519 => '常州',
                510 => '无锡'
            ),
        
            12 => Array
            (
                571 => '杭州',
                572 => '湖州',
                573 => '嘉兴',
                580 => '舟山',
                574 => '宁波',
                575 => '绍兴',
                579 => '金华',
                576 => '台州',
                577 => '温州',
                578 => '丽水',
                570 => '衢州'
            ),
        
            13 => Array
            (
                551 => '合肥',
                557 => '宿州',
                561 => '淮北',
                558 => '阜阳',
                552 => '蚌埠',
                554 => '淮南',
                550 => '滁州',
                555 => '马鞍山',
                553 => '芜湖',
                562 => '铜陵',
                556 => '安庆',
                559 => '黄山',
                564 => '六安',
                565 => '巢湖',
                566 => '贵池',
                563 => '宣城',
                5581 => '亳州'
            ),
        
            14 => Array
            (
                591 => '福州',
                599 => '南平',
                598 => '三明',
                594 => '莆田',
                595 => '泉州',
                592 => '厦门',
                596 => '漳州',
                597 => '龙岩',
                593 => '宁德',
                5930 => '福安',
                5990 => '邵武',
                5950 => '石狮',
                5980 => '永安',
                5991 => '武夷山',
                5995 => '福清'
            ),
        
            15 => Array
            (
                791 => '南昌',
                792 => '九江',
                798 => '景德镇',
                701 => '鹰潭',
                790 => '新余',
                799 => '萍乡',
                797 => '赣州',
                793 => '上饶',
                794 => '临川',
                795 => '宜春',
                796 => '吉安',
                7940 => '抚州'
            ),
        
            16 => Array
            (
                531 => '济南',
                635 => '聊城',
                534 => '德州',
                546 => '东营',
                533 => '淄博',
                536 => '潍坊',
                535 => '烟台',
                631 => '威海',
                532 => '青岛',
                633 => '日照',
                539 => '临沂',
                632 => '枣庄',
                537 => '济宁',
                538 => '泰安',
                634 => '莱芜',
                543 => '滨州',
                530 => '菏泽'
            ),
        
            17 => Array
            (
                371 => '郑州',
                398 => '三门峡',
                379 => '洛阳',
                391 => '焦作',
                373 => '新乡',
                392 => '鹤壁',
                372 => '安阳',
                393 => '濮阳',
                378 => '开封',
                370 => '商丘',
                374 => '许昌',
                395 => '漯河',
                375 => '平顶山',
                377 => '南阳',
                376 => '信阳',
                3910 => '济源',
                394 => '周口',
                396 => '驻马店'
            ),
        
            18 => Array
            (
                27 => '武汉',
                719 => '十堰',
                710 => '襄樊',
                724 => '荆门',
                712 => '孝感',
                713 => '黄冈',
                711 => '鄂州',
                714 => '黄石',
                715 => '咸宁',
                716 => '荆州',
                717 => '宜昌',
                718 => '恩施',
                728 => '仙桃',
                7281 => '潜江',
                722 => '随州市',
                7221 => '广水',
                7282 => '天门'
            ),
        
            19 => Array
            (
                731 => '长沙',
                744 => '张家界',
                736 => '常德',
                737 => '益阳',
                730 => '岳阳',
                733 => '株洲',
                732 => '湘潭',
                734 => '衡阳',
                735 => '郴州',
                746 => '永州',
                739 => '邵阳',
                745 => '怀化',
                738 => '娄底',
                743 => '吉首'
            ),
        
            20 => Array
            (
                20 => '广州',
                755 => '深圳',
                763 => '清远',
                751 => '韶关',
                762 => '河源',
                753 => '梅州',
                768 => '潮州',
                754 => '汕头',
                663 => '揭阳',
                660 => '汕尾',
                752 => '惠州',
                769 => '东莞',
                756 => '珠海',
                760 => '中山',
                750 => '江门',
                757 => '佛山',
                668 => '茂名',
                759 => '湛江',
                662 => '阳江',
                766 => '云浮',
                758 => '肇庆'
            ),
        
            21 => Array
            (
                771 => '南宁',
                773 => '桂林',
                772 => '柳州',
                774 => '贺州',
                775 => '玉林',
                777 => '钦州',
                779 => '北海',
                770 => '防城港',
                776 => '百色',
                778 => '河池',
                7750 => '贵港',
                7740 => '梧州',
                7711 => '崇左市',
                284 => '来宾市'
            ),
        
            22 => Array
            (
                898 => '海口',
                899 => '三亚',
                890 => '儋州',
                8901 => '琼海',
                8902 => '文昌',
                8903 => '万宁',
                8904 => '五指山',
                8905 => '东方'
            ),
        
            23 => Array
            (
                28 => '成都',
                839 => '广元',
                816 => '绵阳',
                838 => '德阳',
                817 => '南充',
                826 => '广安',
                825 => '遂宁',
                832 => '内江',
                833 => '乐山',
                813 => '自贡',
                830 => '泸州',
                831 => '宜宾',
                812 => '攀枝花',
                827 => '巴中',
                818 => '达州',
                8320 => '资阳',
                835 => '雅安',
                834 => '西昌',
                837 => '阿坝州',
                828 => '眉山市',
                281 => '凉山州',
                282 => '甘孜州'
            ),
        
            24 => Array
            (
                851 => '贵阳',
                858 => '六盘水',
                852 => '遵义',
                857 => '毕节',
                856 => '铜仁',
                853 => '安顺',
                855 => '凯里',
                854 => '都匀',
                859 => '兴义',
                243 => '黔东南州',
                244 => '黔南州',
                245 => '黔西南州'
            ),
        
            25 => Array
            (
                871 => '昆明',
                874 => '曲靖',
                877 => '玉溪',
                888 => '丽江',
                870 => '昭通',
                879 => '思茅',
                883 => '临沧',
                875 => '保山',
                692 => '潞西',
                886 => '泸水',
                887 => '中甸',
                872 => '大理',
                878 => '楚雄',
                873 => '个旧',
                876 => '文山',
                691 => '景洪',
                8730 => '红河',
                286 => '德宏州',
                287 => '迪庆州',
                288 => '西双版纳州',
                289 => '怒江州'
            ),
        
            26 => Array
            (
                891 => '拉萨',
                896 => '那曲',
                895 => '昌都',
                894 => '林芝',
                893 => '乃东',
                892 => '日喀则',
                897 => '噶尔',
                8971 => '阿里地区',
                900 => '山南地区',
                800 => '樟木口岸'
            ),
        
            27 => Array
            (
                29 => '西安',
                911 => '延安',
                919 => '铜川',
                913 => '渭南',
                910 => '咸阳',
                917 => '宝鸡',
                916 => '汉中',
                912 => '榆林',
                914 => '商洛',
                915 => '安康'
            ),
        
            28 => Array
            (
                931 => '兰州',
                937 => '嘉峪关',
                943 => '白银',
                938 => '天水',
                9370 => '酒泉',
                936 => '张掖',
                935 => '金昌',
                934 => '庆阳',
                933 => '平凉',
                932 => '定西',
                939 => '陇南',
                930 => '临夏',
                941 => '甘南藏族',
                9350 => '武威市'
            ),
        
            29 => Array
            (
                951 => '银川',
                952 => '石嘴山',
                953 => '吴忠',
                954 => '固原',
                248 => '中卫市'
            ),
        
            30 => Array
            (
                971 => '西宁',
                972 => '平安',
                970 => '海晏',
                974 => '共和',
                973 => '同仁',
                975 => '玛沁',
                976 => '玉树',
                977 => '德令哈',
                236 => '果洛藏族自治州',
                237 => '海北藏族自治州',
                238 => '海东地区',
                239 => '海南藏族自治州',
                240 => '海西蒙古族藏族自治州',
                241 => '黄南藏族自治州'
            ),
        
            31 => Array
            (
                991 => '乌鲁木齐',
                990 => '克拉玛依',
                993 => '石河子',
                998 => '喀什',
                997 => '阿克苏',
                903 => '和田',
                995 => '吐鲁番',
                902 => '哈密',
                908 => '阿图什',
                909 => '博乐',
                994 => '昌吉',
                996 => '库尔勒',
                999 => '伊犁',
                992 => '奎屯',
                901 => '塔城',
                906 => '阿勒泰',
                904 => '巴音郭楞蒙古自治州',
                905 => '博尔塔拉蒙古自治州',
                907 => '克孜勒苏柯尔克孜自治州',
                989 => '伊犁哈萨克自治州'
            ),
        
        );
        
        return $citys;
    }
    
    public static function getTenpayTestData(){
        
        return $dataArr = Array
			(
			    'trade_state' => 5,
			    'total_count' => 3,
			    'total_fee' => 3,
			    'succ_count' => 0,
			    'succ_fee' => 0,
			    'fail_count' => 0,
			    'fail_fee' => 0,
			    'origin_set' => Array
			        (
			            'origin_total' => 0,
			            'origin_rec' => Array
			                        (
			                            'serial' => '1123123',
			                            'bank_type' => '1001',
			                            'rec_bankacc' => '6225887838841001',
			                            'rec_name' => '曾鹏',
			                            'pay_amt' => 1,
			                            'acc_type' => 1,
			                            'area' => '20',
			                            'city' => '755',
			                            'subbank_name' => '招商银行深圳常兴支行',
			                            'desc' => 'testssss',
			                            'modify_time' => '2015-02-05 17:13:05',
			                        ),
			        ),
			    'success_set' => Array
			        (
			            'suc_total' => 0,
			        ),
			    'tobank_set' => Array
			        (
			            'tobank_total' => 0,			            
			        ),
			    'fail_set' => Array
			        (
			            'fail_total' => 0,
			        ),
			    'handling_set' => Array
			        (
			            'handling_total' => 1,
			            'handling_rec' => Array
			            (
			                'serial' => '1123123',
			                'bank_type' => '1001',
			                'rec_bankacc' => '6225887838841001',
			                'rec_name' => '曾鹏',
			                'pay_amt' => 1,
			                'acc_type' => 1,
			                'area' => '20',
			                'city' => '755',
			                'subbank_name' => '招商银行深圳常兴支行',
			                'desc' => 'testssss',
			                'modify_time' => '2015-02-05 17:13:05',
			            ),
			        ),
			    'return_ticket_set' => Array
			        (
			            'ret_ticket_total' => 0,
			        )

			);
    }
    
} 