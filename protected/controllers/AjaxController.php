<?php
class AjaxController extends Controller
{
    const SEND_CODE_LIMIT = 3;
    const SEND_SMS_LIMIT = 3;
    const RES_SEND_SMS_LOAD_APP_ADDRESS_SMS_TIMES = 1971;

    public function actionGetcaptcha()
    {
        // getCode(100, 24);
        $w = 90;
        $h = 25;
        // function getCode($w, $h) {
            $im = imagecreate($w, $h);

            //imagecolorallocate($im, 14, 114, 180); // background color
            $red = imagecolorallocate($im, 255, 0, 0);
            $white = imagecolorallocate($im, 255, 255, 255);

            $num1 = rand(1, 20);
            $num2 = rand(1, 20);

            Yii::app()->session->add('helloweba_math',$num1 + $num2);

            $gray = imagecolorallocate($im, 118, 151, 199);
            $black = imagecolorallocate($im, mt_rand(0, 100), mt_rand(0, 100), mt_rand(0, 100));

            //画背景
            imagefilledrectangle($im, 0, 0, 100, 24, $black);
            //在画布上随机生成大量点，起干扰作用;
            for ($i = 0; $i < 80; $i++) {
                imagesetpixel($im, rand(0, $w), rand(0, $h), $gray);
            }

            imagestring($im, 5, 5, 4, $num1, $red);
            imagestring($im, 5, 30, 3, "+", $red);
            imagestring($im, 5, 45, 4, $num2, $red);
            imagestring($im, 5, 70, 3, "=", $red);
            imagestring($im, 5, 80, 2, "?", $white);

            header("Content-type: image/png");
            imagepng($im);
            imagedestroy($im);
        // }
    }

    public function actionCheckcaptcha()
    {

        $code = Yii::app()->request->getParam('code');
        if($code==Yii::app()->session->get("helloweba_math")){
            echo 'success';
            exit;
        }
        echo 5;
        exit;
        
    }
    /**
     * 账号设置-绑定手机-忘记密码-Apollo发送验证码-1注册，2找回密码，3修改绑定手机，4.班费转出
     * panrj 2014-08-14
     * $ty 验证码类型：旧密码，新密码，重置密码
     */
    public function actionSendmobilecode()
    {
        $mobile = Yii::app()->request->getParam('mobile');
        $ty = Yii::app()->request->getParam('ty');
        
        $code = Yii::app()->request->getParam('code');
        if($ty==1 && !$code){
            echo 5;
            exit;
        }
        if($code){
            if($code!=Yii::app()->session->get('helloweba_math')){
                echo 5;
                exit;
            }
        }
        
        if ($mobile && $ty) {

            $res = JceHelper::sendMobileCode($mobile, $ty);
            $iResult = $res->iResult->val;
            if($iResult == 0){
                echo '1';   //正常
            }else if($iResult == 61){                
                echo '2';   //发送次数上限
            }else if($iResult == 23){                
                echo '3';   //手机号已绑定
            } else if($iResult==241){
                echo '4';
            }else{
                echo '0';
            }
            
        } else {
            echo '0';
        }
    }

    /**
     * 账号设置-绑定手机-忘记密码-Apollo发送验证码-1注册，2找回密码，3修改绑定手机，4.班费转出
     * panrj 2014-08-14
     * $ty 验证码类型：旧密码，新密码，重置密码
     */
    public function actionSendmobilecodenew()
    {
        $mobile = Yii::app()->request->getParam('mobile');
        $ty = Yii::app()->request->getParam('ty');

        $code = Yii::app()->request->getParam('code');
        if($ty==1 && !$code){
            echo 5;
            exit;
        }
        if($code){
            if($code!=Yii::app()->session->get('helloweba_math')){
                echo 5;
                exit;
            }
        }

        if ($mobile && $ty) {

            $res = JceHelper::sendMobileCode($mobile, $ty);
            $iResult = $res->iResult->val;
            echo $iResult."--".$res->sMessage->val;
        }
    }

    /**
     * 检验校验码,接口方式(原来是yii，现在改接口)
     */
    public function actionCheckmobilecode()
    {
        $mobile = Yii::app()->request->getParam('mobile');
        $type = Yii::app()->request->getParam('ty');
        $code = Yii::app()->request->getParam('code');

        if ($mobile && $type&&$code) {
            $res = JceHelper::checkMobileCode($mobile,$code,$type);
            $iResult = $res->iResult->val;
            if($iResult == RES_SUCCEED){
                echo '1';   //正常
            }else if($iResult == 27){ //RES_AUTHCODE_OUT_OF_DATE
                echo '验证码已过期';   //
            }else if($iResult == 28){ //RES_AUTHCODE_MISMATCH
                echo '验证码不匹配';   //
            } else {
                echo '未知错误';
            }

        } else {
            echo '请输入手机号';
        }
    }

    /**
     * 提供手机号码获取班费卡（给运营策划那边用）
     */
    public function actionGeneralclassfeecard()
    {
        $secretKey = 'j23b5sf8u';
        // mlog(md5($secretKey.'admin'));//475b056f95b095b1b35f8ad1afcbd013
        $jsonArr = array('status'=>0, 'result'=> array());
        
        $uid = Yii::app()->request->getParam('uid');
        if(!$uid){
            $jsonArr['result'] = array(
                'errorcode'=>404,
            );
            echo json_encode($jsonArr);
            exit;
        }
        $mobile = Yii::app()->request->getParam('mobile');
        $key = Yii::app()->request->getParam('key');
        $code = Yii::app()->request->getParam('code');
        if($code && $key && strtolower(md5($secretKey.$key))==strtolower($code)){
            $activeidArr = ['1', '2', '3'];
            $result = JceHelper::getInvitedClassFeeCard($mobile, $uid, $activeidArr);
            if($result['result']==0){
                $jsonArr['status'] = 1;
                $jsonArr['result'] = array(
                    'money'=>$result['amt'],
                );
            }else{
                $jsonArr['result'] = array(
                    'money'=>$result['amt'],
                    'msg' => $result['msg'],
                    'errorcode'=>$result['result'],
                );
            }
        }
        echo json_encode($jsonArr);
    }
    
    /**
     * 发送手机短信（下载链接）
     */
    public function actionSendsmsbydownload()
    {
        $jsonArr = ['status'=>0, 'msg'=> '发送失败'];
        
        $mobile = Yii::app()->request->getParam('mobile');
        
        if($mobile && preg_match("/1\d{10}$/",$mobile)) {
            $result = JceHttpBase::sendSmsDownloadAddr($mobile);
            if($result == 0) {
                $jsonArr['status'] = 1;
                $jsonArr['msg'] = '发送成功';
            }else if($result == self::RES_SEND_SMS_LOAD_APP_ADDRESS_SMS_TIMES){
                $jsonArr['status'] = 2;
                $jsonArr['msg'] = '该手机号今天已接收3次短信，无法接收更多';
            }
        }
        
        echo json_encode($jsonArr);
    }

    /*
     * 根据选择的班级返回成绩单数据以及关联数据
     */
    public function actionIndex()
    {
        $cid = (int)Yii::app()->request->getParam("cid");
        $eid = (int)Yii::app()->request->getParam("eid");
        $isShowLevel = (int)Yii::app()->request->getParam("showlevel", 0); //是否需要显示成绩等级ABCD...
        $examInfo = Exam::model()->loadByPk($eid);
        $uid = Yii::app()->user->id;
        $schoolid = $examInfo->schoolid;
        $classes = ClassTeacherRelation::getTeacherClassRelation($uid, $schoolid);
        $tmp = array();
        $cids = explode(",", $examInfo->cid);
        foreach ($classes as $v) {
            if (in_array($v->cid, $cids)) {
                $tmp[] = $v;
            }
        }
        $gcinfo = MClass::getGradeClassArr($tmp);
        $sids = explode(",", $examInfo->sid);
        $subjectList = Subject::getSubjects($examInfo->sid);
        if ($cid) {
            $classMan = ExamService::getClsssStudent($cid, $sids); //获取班级下的学生
            $score = array();
            $evaluation = array();
            foreach ($sids as $sid) {
                $examAlone = ExamAlone::getExamAndAloneInfo($cid, $sid, $eid);
                if ($examAlone) {
                    $score[$sid] = ExamScore::getExamScoreByEaid($examAlone['eaid']);
                    $avgtmp[$sid] = ExamScore::getExamScoreByEaid($examAlone['eaid']);
                } else {
                    $avgtmp[$sid] = array();
                }
            }
            foreach ($avgtmp as $key => $val) {
                $avg[$key]['avg'] = (ExamService::average($val)) ? ExamService::average($val) : '';
            }
            $evaluation = ExamEvaluation::getExamEvaluation($eid);
            $config = json_decode($examInfo->config, true);
            if (is_array($classMan)) {
                foreach ($classMan as $k => $val) {
                    foreach ($sids as $sid) {
                        $sidconfig = isset($config[$sid]) ? $config[$sid] : array();
                        $sc = isset($score[$sid]) ? $score[$sid] : array();
                        $classMan[$k][$sid] = isset($sc[$val['userid']]) ? $sc[$val['userid']] : '';
                        if ($isShowLevel) {
                            $levelName = ExamService::getLevelNameByScoreShow($classMan[$k][$sid], $sidconfig);
                            $classMan[$k][$sid] .= ($levelName) ? ('（' . $levelName . '）') : '';
                        }
                    }
                    if (isset($val['userid'])) {
                        if (isset($evaluation[$val['userid']])) {
                            $classMan[$k]['evaluation'] = isset($evaluation[$val['userid']]) ? $evaluation[$val['userid']] : '';
                        }
                    }
                }

            }
        }


        $relationArr = ExamService::getRelationExam($eid, $gcinfo, $subjectList);
        die(json_encode(array('data' => $classMan, 'score' => $avg, 'sids' => $sids, 'relationArr' => $relationArr)));
    }

    /**
     * 返回学校老师数据
     */
    public function actionTeacherschinfo()
    {
        $sid = Yii::app()->request->getParam("sid", '');
        $ty = Yii::app()->request->getParam("ty");
        $uid = Yii::app()->user->id;
        if ($sid && $ty) {
            if ($ty == 'class') {
                $classes = NoticeService::getExamClassBySidUid($sid,$uid);
                $gcinfo = MClass::getGradeClassArr($classes);
                echo json_encode($gcinfo);
                exit;
            }
            if ($ty == 'subject') {
                $subjects = Subject::getSubjectsBySchoolids($sid);

                echo json_encode($subjects);
                exit;
            }
        } else {
            echo '';
            exit;
        }
    }

    public function actionGetteachersbysid(){
        $sid = Yii::app()->request->getParam("sid", 0);
        $teacherArr = School::getSchoolTeacherReturnArr($sid,true);
        die(json_encode($teacherArr));
    }

    public function actionTeacherclass()
    {
        $sid = Yii::app()->request->getParam("sid", '');
        $uid = Yii::app()->user->id;
        $classes = NoticeService::getExamClassBySidUid($sid,$uid);
        $arr = array();
        foreach ($classes as $class) {
            if($class instanceof MClass){
                $arr[] = array('cid'=>$class->cid,'name'=>$class->name);
            }else{
                $arr[] = array('cid'=>$class->c->cid,'name'=>$class->c->name);//$class->c->name;
            }
        }

        die(json_encode($arr));
        exit;
    }

    /*
     * 上传成绩改放到这，主要是flash登录机制，这里不需要登录
     */
    public function actionScheck()
    {

        $id = Yii::app()->request->getParam('id');
        $uid = Yii::app()->request->getParam('uid') ? Yii::app()->request->getParam('uid') : Yii::app()->user->id;
        if (empty($uid) || empty($id)) {
            die(json_encode(array('status' => '2', 'msg' => '上传失败,参数有误'), JSON_UNESCAPED_UNICODE));
        }
        $examInfo = Exam::getExamByEid($id);
        $sids = explode(",", $examInfo['sid']);
        $sid_score = array();
        $subcount = count($sids);

        if (isset($_FILES['Filedata'])) {
            $root = yii::app()->basePath;
            spl_autoload_unregister(array('YiiBase', 'autoload'));
            $uploadfile = $_FILES['Filedata']['tmp_name'];
            Yii::$enableIncludePath = false;
            Yii::import('application.extensions.PHPExcel', 1);
            require_once($root . '/extensions/PHPExcel/IOFactory.php');
            require_once($root . '/extensions/PHPExcel/Reader/Excel5.php');
            $objPHPExcel = new PHPExcel();
            $objReader = PHPExcel_IOFactory::createReader('Excel5');
            $objReader->setReadDataOnly(true);
            $objPHPExcel = $objReader->load($uploadfile);
            $sheets = $objPHPExcel->getAllSheets();
            $objPHPExcel->setActiveSheetIndex(0);
            $allData = array();
            $ActiveSheet = null;
            $names = $objPHPExcel->getSheetNames();
            $sheetNum = $objPHPExcel->getSheetCount();
            for ($pp = 0; $pp < $sheetNum; $pp++) {
                $ActiveSheet = $objPHPExcel->getSheet($pp);
                $max = $ActiveSheet->getHighestRow();
                $maxColumn = $ActiveSheet->getHighestColumn();
                $counColumn = $this->getalphnum($maxColumn);
                $upalonesids = $counColumn - 3; //上传的成绩单有多少科目
                if ($upalonesids != $subcount) {
                    die(json_encode(array('status' => '3', 'msg' => '上传的成绩单与本次考试成绩不匹配'), JSON_UNESCAPED_UNICODE));
                }
                $cidname = $names[$pp];
                $cidid = explode("-", $cidname);
                $dataArr = array();
                for ($row = 2; $row <= $max; $row++) {
                    $userid = $ActiveSheet->getCellByColumnAndRow(0, $row)->getValue();
                    $name = $ActiveSheet->getCellByColumnAndRow(1, $row)->getValue();
                    for ($i = 0; $i < $subcount; $i++) {
                        $sid_score[$sids[$i]] = $ActiveSheet->getCellByColumnAndRow($i + 2, $row)->getValue();
                    }
                    $evaluation = $ActiveSheet->getCellByColumnAndRow($i + 2, $row)->getValue();
                    $data = array('userid' => $userid, 'name' => $name, 'evaluation' => $evaluation);
                    foreach ($sid_score as $key => $vv) {
                        $data[$key] = $vv;
                    }
                    $dataArr[] = $data;
                }
                $allData[$cidid[1]] = $dataArr;
            }
            $cache = Yii::app()->cache;
            $cache->set("exam" . $id . "examscoreupload" . $uid, $allData);
            spl_autoload_register(array('YiiBase', 'autoload'));
            die(json_encode(array('status' => '1', 'msg' => '上传成功'), JSON_UNESCAPED_UNICODE));
        } else {
            die(json_encode(array('status' => '2', 'msg' => '上传失败'), JSON_UNESCAPED_UNICODE));
        }
        //  $this->render('import', array('id' => $id, 'examInfo' => $examInfo));
    }

    private function getalphnum($char)
    {
        $sum = '';
        $array = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
        $len = strlen($char);
        for ($i = 0; $i < $len; $i++) {
            $index = array_search($char[$i], $array);
            $sum += ($index + 1) * pow(26, $len - $i - 1);
        }
        return $sum;
    }

    public function actionTest()
    {
       MemberService::setThreeMemberInfo(1,2,'吕秀军','18680342346');

    }
    /*
     * 导入老师
     */
    public function actionImportteacher()
    {

        $sid = Yii::app()->request->getParam('sid');
        $uid = Yii::app()->request->getParam('uid') ? Yii::app()->request->getParam('uid') : Yii::app()->user->id;
        if (empty($uid) || empty($id)) {
            die(json_encode(array('status' => '2', 'msg' => '上传失败,参数有误'), JSON_UNESCAPED_UNICODE));
        }

        if (isset($_FILES['Filedata'])) {
            $root = yii::app()->basePath;
            spl_autoload_unregister(array('YiiBase', 'autoload'));
            $uploadfile = $_FILES['Filedata']['tmp_name'];
            Yii::$enableIncludePath = false;
            Yii::import('application.extensions.PHPExcel', 1);
            require_once($root . '/extensions/PHPExcel/IOFactory.php');
            require_once($root . '/extensions/PHPExcel/Reader/Excel5.php');
            $objPHPExcel = new PHPExcel();
            $objReader = PHPExcel_IOFactory::createReader('Excel5');
            $objReader->setReadDataOnly(true);
            $objPHPExcel = $objReader->load($uploadfile);
            $objPHPExcel->setActiveSheetIndex(0);
            $mobileArr = array();
            $ActiveSheet = $objPHPExcel->getActiveSheet();
            $max = $objPHPExcel->getActiveSheet()->getHighestRow();
            $dataArr = array();
            $mobileArr = array();
            for ($row = 2; $row <= $max; $row++) {
                $name = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, $row)->getValue();
                $mobile = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, $row)->getValue();
                if (!in_array($mobile, $mobileArr) && $name && $mobile && CheckHelper::IsMobile($mobile)) {
                    array_push($mobileArr, $mobile);
                    array_push($dataArr, array('name' => $name, 'mobile' => $mobile));
                }
            }
            $cache = Yii::app()->cache;
            $cache->set("schoolid" . $sid . "teacherupload" . $uid, $dataArr);
            spl_autoload_register(array('YiiBase', 'autoload'));
            die(json_encode(array('status' => '1', 'msg' => '上传成功'), JSON_UNESCAPED_UNICODE));
        } else {
            die(json_encode(array('status' => '2', 'msg' => '上传失败'), JSON_UNESCAPED_UNICODE));
        }
        //  $this->render('import', array('id' => $id, 'examInfo' => $examInfo));
    }
    /*
     * 导入学生
     */
    public function actionImportStudent()
    {

        $sid = Yii::app()->request->getParam('sid');
        $uid = Yii::app()->request->getParam('uid') ? Yii::app()->request->getParam('uid') : Yii::app()->user->id;
        if (empty($uid) || empty($id)) {
            die(json_encode(array('status' => '2', 'msg' => '上传失败,参数有误'), JSON_UNESCAPED_UNICODE));
        }

        if (isset($_FILES['Filedata'])) {
            $root = yii::app()->basePath;
            spl_autoload_unregister(array('YiiBase', 'autoload'));
            $uploadfile = $_FILES['Filedata']['tmp_name'];
            Yii::$enableIncludePath = false;
            Yii::import('application.extensions.PHPExcel', 1);
            require_once($root . '/extensions/PHPExcel/IOFactory.php');
            require_once($root . '/extensions/PHPExcel/Reader/Excel5.php');
            $objPHPExcel = new PHPExcel();
            $objReader = PHPExcel_IOFactory::createReader('Excel5');
            $objReader->setReadDataOnly(true);
            $objPHPExcel = $objReader->load($uploadfile);
            $objPHPExcel->setActiveSheetIndex(0);
            $mobileArr = array();
            $ActiveSheet = $objPHPExcel->getActiveSheet();
            $max = $objPHPExcel->getActiveSheet()->getHighestRow();
            $dataArr = array();
            $mobileArr = array();
            for ($row = 2; $row <= $max; $row++) {
                $name = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, $row)->getValue();
                $mobile = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, $row)->getValue();
                $classname = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(2, $row)->getValue();
                if (!in_array($mobile, $mobileArr) && $name && $classname &&$mobile && CheckHelper::IsMobile($mobile)) {
                    array_push($mobileArr, $mobile);
                    array_push($dataArr, array('name' => $name, 'mobile' => $mobile,'classname'=>$classname));
                }
            }
            $cache = Yii::app()->cache;
            $cache->set("schoolid" . $sid . "studentupload" . $uid, $dataArr);
            spl_autoload_register(array('YiiBase', 'autoload'));
            die(json_encode(array('status' => '1', 'msg' => '上传成功'), JSON_UNESCAPED_UNICODE));
        } else {
            die(json_encode(array('status' => '2', 'msg' => '上传失败'), JSON_UNESCAPED_UNICODE));
        }
        //  $this->render('import', array('id' => $id, 'examInfo' => $examInfo));
    }
    public function actionPwd(){
        $uid=(int)Yii::app()->request->getParam("uid");
        if($uid){
            $userList=UCQuery::queryAll("select * from tb_user where length(pwd)<10 and deleted=0 and pwd!='' and userid=$uid limit 1000");
        }else{
            $userList=UCQuery::queryAll("select * from tb_user where length(pwd)<10 and deleted=0 and pwd!=''  limit 1000");
        }
        foreach($userList as $val){
            $member=Member::model()->findByPk($val['userid']);
            if($member){
                $member->pwd=MainHelper::encryPassword($member->pwd);
                $member->save();
            }
        }

    }

    public function actionQiniutoken()
    {
        $arr = array('uptoken'=>MainHelper::generate_password(22));
        // "uptoken": "0MLvWPnyya1WtPnXFy9KLyGHyFPNdZceomL"
        echo JsonHelper::JSON($arr);
    }
    
    /**
     * 公众号的七牛云上传地址，对返回格式作了区别
     */
    public function actionOfficialtoken($type)
    {
        require_once( Yii::app()->basePath.'/extensions/qiniu/qiniuphp/rs.php');
        
        if($type == 'tx'){ //头像图片
            $bucket = STORAGE_QINNIU_BUCKET_TX;
        }else if(($type == 'xx')){ //消息图片
            $bucket = STORAGE_QINNIU_BUCKET_XX;
        }
        
        //$bucket = STORAGE_QINNIU_BUCKET;
        $accessKey = STORAGE_QINNIU_ACCESSKEY;
        $secretKey = STORAGE_QINNIU_SECRETKEY;
        
        Qiniu_SetKeys($accessKey, $secretKey);
        $putPolicy = new Qiniu_RS_PutPolicy($bucket);
        
        $putPolicy->ReturnBody = '{"key": $(key),"width": $(imageInfo.width),"height": $(imageInfo.height)}';
        $upToken = $putPolicy->Token(null);
        echo '{"uptoken": "'.$upToken.'"}'; 
    }

    public function actionGettoken($type)
    {
        require_once( Yii::app()->basePath.'/extensions/qiniu/qiniuphp/rs.php');

        if($type == 'tx'){ //头像图片
            $bucket = STORAGE_QINNIU_BUCKET_TX;
        }else if(($type == 'xx')){ //消息图片
            $bucket = STORAGE_QINNIU_BUCKET_XX;
        }

        //$bucket = STORAGE_QINNIU_BUCKET;
        $accessKey = STORAGE_QINNIU_ACCESSKEY;
        $secretKey = STORAGE_QINNIU_SECRETKEY;

        Qiniu_SetKeys($accessKey, $secretKey);
        $putPolicy = new Qiniu_RS_PutPolicy($bucket);
        // $putPolicy -> Scope = $bucket . ":" . Yii::app()->user->id.'.jpg';
        // $putPolicy -> InsertOnly = 0;
        // $putPolicy->SaveKey = Yii::app()->user->id.'.jpg';
        $upToken = $putPolicy->Token(null);
        echo '{"uptoken": "'.$upToken.'"}';
    }
    /*
     *点提交验证码
     */
    public function actionCheckphonenum(){
        $cache = Yii::app()->cache;
        $phone = trim(Yii::app()->request->getParam('phone'));
        $code = trim(Yii::app()->request->getParam('code'));
        $phoneday = "openregister_" . $phone.date("Y-m-d");
        $key = "openregister_" . $phone;
        $todaynum=$cache->get($phoneday);
        $codevalue=$cache->get($key);
        if(!$codevalue&&$todaynum){
            die(json_encode(array('status' => '0','msg'=>'验证码错误或已失效')));//
        }
        if($code&&$codevalue==$code){
            die(json_encode(array('status' => '1','msg'=>'')));//
        }else if($code&&$codevalue!==$code){
            $todaynum=$cache->get($phoneday);
            if(!$todaynum){
                die(json_encode(array('status' => '0','msg'=>'请点击获取验证码按扭，获取验证码')));//
            }
            die(json_encode(array('status' => '0','msg'=>'验证码错误或已失效')));//
        }

        $todaynum=$cache->get($phoneday);
        if(!$todaynum){
            die(json_encode(array('status' => '0','msg'=>'请点击获取验证码按扭，获取验证码')));//
        }
        if(!preg_match('/^1\d{10}$/',$phone)){
            die(json_encode(array('status' => '0','msg'=>'手机号格式不正确')));//
        }
        if($todaynum&&(int)$todaynum>=3){
            die(json_encode(array('status' => '0','msg'=>'已超过发送次数限制，请明天再试')));//一天发送验证不能超过3次
        }else{
            die(json_encode(array('status' => '1','msg'=>'')));//
        }
    }

    //开放注册验证手机-v3.7弃用
    public function actionCheckphone()
    {
        $cache = Yii::app()->cache;
        $phone = Yii::app()->request->getParam('phone');
        $phoneday = "openregister_" . $phone.date("Y-m-d");
        $todaynum=$cache->get($phoneday);
        if($todaynum&&(int)$todaynum>=3){
            die(json_encode(array('status' => '0','msg'=>'已超过发送次数限制，请明天再试')));//一天发送验证不能超过3次
        }
        $match = Member::getUniqueByOpenReg($phone);
        if($match){
            $key = "openregister_" . $phone;
            $code = MainHelper::generate_code(6);
            $msg = "尊敬的用户，您本次获得的验证码是：" . $code."，请勿告诉他人。";
            UCQuery::sendMobileMsg($phone, $msg,Constant::SMS_VERIFICATIONCODE);
            $cache->set($key, $code, 1800);
            if($todaynum){
                $todaynum=$todaynum+1;
            }else{
                $todaynum=1;
            }
            $cache->set($phoneday, $todaynum, 3600*24);
            if($match == 1){
                //,'code' => $code
                echo json_encode(array('status' => '1'));
            }else{
                //, 'code' => $code
                echo json_encode(array('status' => '2','uid' => $match));
            }
            exit();
        }
        echo json_encode(array('status' => '0'));
    }

    //开放注册发送验证码-v3.7弃用
    public function actionSendcode()
    {
        $phone = Yii::app()->request->getParam('phone');

        if ($phone) {
            $cache = Yii::app()->cache;
            $key = "openregister_" . $phone;

            $code = MainHelper::generate_code(6);
            $msg = "尊敬的用户，您本次获得的验证码是：" . $code."，请勿告诉他人。";
            UCQuery::sendMobileMsg($phone, $msg,Constant::SMS_VERIFICATIONCODE);

            $cache->set($key, $code, 1800);

            echo json_encode(array('status' => '1'));
        } else {
            echo json_encode(array('status' => '0'));
        }
    }

    /**
     * 第三方验证码发送
     */
    public function actionSendthird()
    {
        $phone = Yii::app()->request->getParam('phone');
        $cache = Yii::app()->cache;

        if (!$phone) exit(json_encode(array('status' => '0')));

        $sendCountKey = "third-part-info_" . $phone . date('Y-m-d');
        $sendCountValue = $cache->get($sendCountKey) ? $cache->get($sendCountKey) : 0;

        if ($sendCountValue && (int)$sendCountValue >= self::SEND_CODE_LIMIT) {
            exit(json_encode(array('status' => '0', 'msg' => '已超过发送次数限制，请明天再试')));
        }

        $cache = Yii::app()->cache;
        $key = "third-part-info_" . $phone;

        $code = MainHelper::generate_code(6);
        $msg = "尊敬的用户，您本次获得的验证码是：" . $code."，请勿告诉他人。";
        UCQuery::sendMobileMsg($phone, $msg,Constant::SMS_VERIFICATIONCODE);

        $cache->set($key, $code, 1800);
        $cache->set($sendCountKey, $sendCountValue + 1, 3600*24);

        exit(json_encode(array('status' => 1)));
    }

    //开放注册-检查验证码-v3.7弃用
    public function actionCheckcode()
    {
        $phone = Yii::app()->request->getParam('phone');
        $code = Yii::app()->request->getParam('code');
        $userid = Yii::app()->user->id;

        $key = "openregister_" . $phone;
        $cache = Yii::app()->cache;
        $cachecode = $cache->get($key);
        $msg = $cachecode ? '验证码有误，请输入正确验证码' : '验证码已过期，请重新获取验证码';
        $rs = array('status' => 0, 'msg' => $msg);
        if ($phone && $code) {
            if ($cachecode == $code) {
                $rs['status'] = 1;
                $rs['msg'] = '验证通过';
            }
        }
        echo json_encode($rs);
    }

    //开放注册-学校名是否存在-v3.7弃用
    public function actionCheckschool()
    {
        $schoolName = Yii::app()->request->getParam('sname');
        $sid = School::getSchoolByName($schoolName);

        if($sid){            
            if($sid == 1){
                echo json_encode(array('status' => '0'));//系统存在
            }else{
                echo json_encode(array('status' => '2','sid' => $sid));
            }
        }else{
            echo json_encode(array('status' => '1'));
        }
    }

    /**
    * 重新邀请限制
    * zengp 2014-12-28    
    * @return json 
    */
    public function actionCheckAnewSendCount()
    {
        $cache=Yii::app()->cache;
        $anew_pinvite_day_count = Constant::ANEW_PINVITE_DAY_COUNT;
        $anew_pinvite_day_nums = Constant::ANEW_PINVITE_DAY_NUMS;

        $cid = Yii::app()->request->getParam('cid');
        $type = Yii::app()->request->getParam('ty');
        $userid = Yii::app()->user->id;
        $needSendpwdNum=0;
        $identity = $type == 1 ? 'teacher' : 'student';
        $sendpwd=Sendpwd::getTeacherSendpwd($userid);
         $key_count = "anewpinvitedaycount_" . $userid . $cid . $identity .date("Y-m-d");
        // $key_nums = "anewpinvitedaynums_" . $userid . $cid . date("Y-m-d");
        // conlog($cache->get($key_count));exit;
        //  $currCount = $cache->get($key_count);
        //$currNums = $cache->get($key_nums);
        $currCount = $cache->get($key_count);
        if($currCount >= $anew_pinvite_day_count){
            Yii::app()->msg->postMsg('success', '每天只能发送一次邀请');
            die(json_encode(array('status'=>0)));
        }
        if($sendpwd&&$sendpwd->sendpwdnum>=$sendpwd->maxsendnum){
           // Yii::app()->msg->postMsg('success', '您已超过邀请短信发送量，如有问题请联系客服');
            //die(json_encode(array('status'=>0)));
        }

        die(json_encode(array('status'=>1,'needSendpwdNum'=>$needSendpwdNum)));
    }
    
    
    /**
     * 根据省或市获取下面的城市或区县
     */
    public function actionGetcity()
    {
        //510100
        $id=Yii::app()->request->getParam("id",0);
        $cache=Yii::app()->cache;
        if($id){
            //$info=$cache->get("newcity_child_$id");
            $info=null;
            if(empty($info)){
               // if(empty($areas)){
                    $areas=BaseArea::getProvinceCity();
               // }
                $city_list = isset($areas[$id])?$areas[$id]:array();
                $info=isset($city_list['citys'])?$city_list['citys']:array();
              //  D($city_list);
                //$info=Area::getCity(array('cid'=>$id));
                $cache->set("newcity_child_$id",$info);
            }
            die(json_encode(array('status'=>'1','data'=>$info)));
        }

    }
    
    
    /**
     * 根据区县获取该区县下所有学校
     */
    public function actionGetschool()
    {
        $aid=Yii::app()->request->getParam("aid");
        $name=Yii::app()->request->getParam("name");
        //暂不要缓存
       // $schools=Yii::app()->cache->get("front_".$aid."_schools_list");
       // if(!$schools){
           $schools=School::getSchoolArrByArea(array("area"=>$aid,'name'=>$name));
           // Yii::app()->cache->set("front_".$aid."_schools_list",$schools);
       // }
        die(json_encode(array('status'=>1,'data'=>$schools)));
    }
    
    
    /**
     * 根据省获取城市 -- 班费转出
     */
    public function actionGetcitys()
    {
       $provid = Yii::app()->request->getParam('provid');
       
       $citys = TenpayHelper::getCitys();
       
       echo json_encode($citys[$provid]);
       
    }
    
    /**
     * 晒班费webview加载班费
     */
    public function actionGettotalfee()
    {
        $classid = Yii::app()->request->getParam('cid');
        
        $data = array('status'=>0);
        
        if($classid){
            $dTotalIncome = 0;
            $feeInfo = JceHelper::getClassFeeInfo(array($classid));
            if(count($feeInfo)){
                $dTotalIncome = sprintf('%.2f', $feeInfo[0]['dTotalIncome']);
                $data['status'] = 1;
                $data['dTotalIncome'] = $dTotalIncome;
            }   
        }
            
        echo json_encode($data);
        
    }
    
    /**
     * 班费转出--检查是否可以转出班费
     */
    public function actionCheckexpense()
    {
        $cid = Yii::app()->request->getParam('cid');
        $userid = Yii::app()->user->id;
        $amt = Yii::app()->request->getParam('amt', 0);
        $amt = $amt * 100;
        $uname = Yii::app()->request->getParam('uname');
        
        $data = array('status'=> 1, 'msg'=> 'success');
        
        $checkupdown = JceHelper::transferClassFee($userid, $cid, $amt, $uname, 1); //首次下限300
        if($checkupdown['iRet'] != 0){
            $data['status'] = 0;
            
            if($checkupdown['iRet'] == ClassFeeStatus::RES_CLASS_FEE_BALANCE_LOWER_FIRST_TRANSFER_LIMIT){
                $data['msg'] = '班费余额不足' . Constant::EXPENSE_FIRST_TRANSFER . '元，无法转出。';
            }else if($checkupdown['iRet'] == ClassFeeStatus::RES_CLASS_FEE_BALANCE_LOWER_NORMAL_TRANSFER_LIMIT){  //非首次50
                $data['msg'] = '班费余额不足' . Constant::EXPENSE_NORMAL_TRANSFER . '元，无法转出。';
            }else if($checkupdown['iRet'] == ClassFeeStatus::RES_CLASS_FEE_UERINFO_ERROR){  //登录超时
                $data['msg'] = '用户登录超时，请重新登录后再转出。';
            }else if($checkupdown['iRet'] == ClassFeeStatus::RES_CLASS_FEE_TRANSFER_FORBID_CID){
                $data['msg'] = '当前班级已被禁止转出班费。';
            }else{
                $data['msg'] = '未知错误, 状态码:' . $checkupdown['iRet'];
            }    
        }
        
        echo json_encode($data);        
    }
    
    /**
     * 班费转出--检查月上限，余额
     */
    public function actionCheckmonthquota()
    {
        $cid = Yii::app()->request->getParam('cid');
        $userid = Yii::app()->user->id;
        $amt = Yii::app()->request->getParam('amt',0);
        $amt = $amt * 100;
        $uname = Yii::app()->request->getParam('uname');
        
//         conlog($cid. '/' . $userid . '/' . $amt . '/' . $uname);
        
        $data = array('status'=> 1, 'msg'=> 'success');
        
        $checkMonth = JceHelper::transferClassFee($userid, $cid, $amt, $uname, 2); //检查月上限，余额是否足够
        
        if($checkMonth['iRet'] != 0){
            $data['status'] = 0;
            
            if($checkMonth['iRet'] == ClassFeeStatus::RES_CLASS_FEE_INSUFFICIENT_BALANCE){
                $data['msg'] = '班费余额不足!';
            }else if($checkMonth['iRet'] == ClassFeeStatus::RES_CLASS_FEE_TRANSFER_OUT_OF_UPPER_LIMIT){
                $checkMonth['monthTransferBanlance'] = $checkMonth['monthTransferBanlance']/100;
                $balance = $checkMonth['monthTransferBanlance'] ? sprintf("%.2f", $checkMonth['monthTransferBanlance']) : 0;
                $data['msg'] = '超出您本月转出所剩限额（' . $balance . '元）';
            }else if($checkMonth['iRet'] == ClassFeeStatus::RES_CLASS_FEE_UERINFO_ERROR){  //登录超时
                $data['msg'] = '用户登录超时，请重新登录后再转出。';
            }else if($checkMonth['iRet'] == ClassFeeStatus::RES_CLASS_FEE_TRANSFER_FORBID_CID){
                $data['msg'] = '当前班级已被禁止转出班费。';
            }else{
                $data['msg'] = '未知错误, 状态码:' . $checkMonth['iRet'];
            }
            
        }
                
        echo json_encode($data);
    }

    /**
     * 班班奖品兑换
     */
    public function actionExchange()
    {
        $uid = Yii::app()->user->id;
        $phone = Yii::app()->request->getParam('phone');
        $inviteid = Yii::app()->request->getParam('id');
        
        $ty = Yii::app()->request->getParam('ty');
        if($ty && $ty== 'invite'){
            $mgid = Yii::app()->cache->get("invite_" . $uid);
        }else if($ty && $ty == 'regclass'){
            $mgid = Yii::app()->cache->get("exchange_" . $uid);
        }
        
        $data = array('status'=>0);
        
        if($uid && $phone && $mgid && $ty){
        
            $transaction = Yii::app()->db->beginTransaction();
            try {                
                $mo = new MallOrders;
                $moid = MallOrders::generalOrderPk($mgid);
                $mo->moid = $moid;
                $mo->userid = $uid;
                $mo->state = 1;
                
                $mgc = MallGoodsCard::getCardByMgid($mgid);
                
                if($mo->save() && $mgc){
                    
                    $mogr = new MallOrdersGoodsRelation;
                    $mogr->moid = $moid;
                    $mogr->mgid = $mgid;
                    $mogr->mgcid = $mgc->mgcid;
                    $mogr->score = 0;
                    if($mogr->save()){
                        
                        $mogrex = new MallOrderGoodsRelationExt;
                        $mogrex->mogrid = $mogr->mogrid;
                        $mogrex->userid = $uid;
                        $mogrex->mobile = $phone;
                        if($mogrex->save()){
                            
                            if($ty == 'regclass'){
                                
                                $exchange = TeacherActiveStat::model()->findByAttributes(array('teacherid'=>$uid, 'deleted'=>0, 'isexchange'=>0));
                                if($exchange){
                                    $exchange->isexchange = 1;
                                    $exchange->save();
                                }
                                

                                $user = Member::model()->findByPk($uid);
                                $user->bean = $user->bean - Constant::GIFT_ACTIVITY_BEANS;
                                $result =$user->save();
                                
                            }else if($ty == 'invite' && $inviteid){
                                
                                $result = UserRegisterInvited::setIsExchange($uid, $inviteid);
                                
                            }
                            
                            if($result){

                                $beanlog = BeanAcquire::getOrCreate($uid,18); //18 活动消费
                                $beanlog->bean -= Constant::GIFT_ACTIVITY_BEANS;
                                $beanlog->number +=1;
                                $beanlog->save();

                                $log = new BeanLog;
                                $log->userid = $uid;
                                $log->bean = -Constant::GIFT_ACTIVITY_BEANS;
                                $log->ruleid = 18;
                                $log->serverid = 2;
                                $log->comment = '活动消耗';
                                $log->save();

                                $transaction->commit();
                                $data['status'] = 1;
                                Yii::app()->cache->delete("exchange_" . $uid);
                            }
                                                        
                        }
                    }
                }                
            } catch (Exception $e) {
                $transaction->rollback();
            }
            
        }
        
        echo json_encode($data);
    }

    /*
     * 获取班费json接口
     */
    public function actionAddclassfee(){
        $cid=(int)Yii::app()->request->getParam('cid',0);
        $uid=(int)Yii::app()->request->getParam('uid',0);
        $event=(int)Yii::app()->request->getParam('event',0);
        $uname=Yii::app()->request->getParam('uname','');
        $iAdID=(int)Yii::app()->request->getParam('iadid',0);
        $callback=isset($_REQUEST['callback'])?$_REQUEST['callback']:'';
        $res=JceClassFee::classFeeIncome($cid,$uid,$event,$uname,$iAdID);
        if(is_object($res)){
            if($callback){
                echo  $callback.'('.json_encode(array('result'=>$res->iRet->val,'msg'=>$res->strMsg->val,'money'=>$res->dValue->val)).')';
            }else{
                echo  json_encode(array('result'=>$res->iRet->val,'msg'=>$res->strMsg->val,'money'=>$res->dValue->val));
            }
        }else if(is_array($res)){
            if($callback){
                echo  $callback.'('.json_encode($res).')';
            }else{
                echo(json_encode($res));
            }
        }else{
            if($callback){
                echo  $callback.'('.json_encode(array('result'=>-1,'msg'=>'获取班费失败')).')';
            }else{
                echo(json_encode(array('result'=>-1,'msg'=>'获取班费失败')));
            }

        }
    }

    /*
    * 获取班费卡json接口
    */
    public function actionAddclasscardfee(){
        $mobilephone=Yii::app()->request->getParam('mobilephone','');
        $uid=(int)Yii::app()->request->getParam('uid',0);
        $activeidArr = ['1', '2', '3'];
       // error_log('uid:'.$uid);
        $res=JceHelper::getInvitedClassFeeCard($mobilephone, $uid,$activeidArr);
        Yii::log("res:".$res,CLogger::LEVEL_ERROR);
        echo json_encode($res);
       // error_log(json_encode($res));
    }
    /*
     * 判断是否发送过邀请
     */
    public function actionChecksendsms(){
        $userid=Yii::app()->user->id;
        $cid=Yii::app()->request->getParam('cid','');
        $type=Yii::app()->request->getParam('type','');
        $date=date("Y-m-d");
        $cache=Yii::app()->cache;
        $todayinvite=$cache->get("invitesmsclass.$date.$userid.$cid.$type");
        if($todayinvite){
            die(json_encode(array('status'=>'1')));
        }else{
            die(json_encode(array('status'=>'0')));
        }
    }

    /*
     *
     */
    public function actionGetsurveyjson(){
        $id=(int)Yii::app()->request->getParam('id',0);
        $result=array('status'=>0,'msg'=>'错误，无效id','data'=>'');
        if(!$id){
            die(json_encode($result));
        }
        if($id){
            $surver=Survey::model()->findByPk($id);
            if(!$surver){
                $result['msg']='无此考试数据';
                die(json_encode($result));
            }
            $data=array('sid'=>$surver->sid,
                'desc'=>$surver->desc,
                'title'=>$surver->title
            );
            $questionlist=SurveyQuestion::getQuestions(array('sid'=>$id));//
            $questions=array();
            $questionitemlist=SurveyQuestionItem::getQuestionItems(array('sid'=>$id));
            $itemArr=array();
            foreach($questionitemlist as $item){
                if(!array_key_exists($item->sqid,$itemArr)){
                    $itemArr[$item->sqid]=array();
                    $itemArr[$item->sqid][]=$item;
                }else{
                    $itemArr[$item->sqid][]=$item;
                }
            }
            foreach($questionlist as $question){
                 $tempquestion=array('sid'=>$question->sid,
                    'sqid'=>$question->sqid,
                   'content'=>$question->content,
                   'order'=>$question->order,
                   'type'=>$question->type,
                   'items'=>array()
                );
                $tempitems=array();
                if(isset($itemArr[$tempquestion['sqid']])){
                    $tempitems=$itemArr[$tempquestion['sqid']];
                }
                foreach($tempitems as $val){
                    $tempquestion['items'][]=array(
                        "sid"=>$val->sid,
                    "sqid"=>$val->sqid,
                    "sqiid"=>$val->sqiid,
                    "score"=>$val->score,
                    "content"=>$val->content,
                    "order"=>$val->order
                    );
                }
                $questions[]=$tempquestion;
            }
            $data['questions']=$questions;
            $result['data']=$data;
            $result['status']='1';
            $result['msg']='';
            die(json_encode($data,JSON_UNESCAPED_UNICODE));
        }
    }
    /*
     * 根据手机号获取用户信息
     */
    public function actionGetuserbymobile(){
        $mobile=trim(Yii::app()->request->getParam("mobile",''));
        if($mobile&&strlen($mobile)==11){
            //$user=JceUser::
            $user= Member::model()->findByAttributes(array('mobilephone'=>$mobile,'deleted'=>0));
            if($user){
                die(json_encode(array('status'=>'1','data'=>array('name'=>$user->name))));
            }
        }
        die(json_encode(array('status'=>'0')));
    }

}