<?php

/**
 * This is the model class for table "{{tenpay_record}}".
 *
 * The followings are the available columns in table '{{tenpay_record}}':
 * @property string $package
 * @property string $paystate
 * @property string $querystate
 * @property integer $tradestate
 * @property integer $count
 * @property integer $amount
 * @property integer $succount
 * @property integer $succfee
 * @property integer $failcount
 * @property integer $failfee
 * @property string $retmsg
 * @property integer $payreqcount
 * @property string $queryfailtime
 * @property integer $state
 * @property string $creationtime
 * @property string $updatetime
 * @property integer $deleted
 */
class TenpayRecord extends XiaoXinActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{tenpay_record}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('package', 'required'),
			array('tradestate, count, amount, succount, succfee, failcount, failfee, payreqcount, state, ban, deleted, verifystate, transtype', 'numerical', 'integerOnly'=>true),
			array('package', 'length', 'max'=>30),
			array('paystate, querystate', 'length', 'max'=>12),
			array('retmsg', 'length', 'max'=>500),
			array('payretcode, queryretcode', 'length', 'max'=>200),
			array('queryfailtime, updatetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('package, paystate, querystate, tradestate, count, amount, succount, succfee, failcount, failfee, retmsg, payreqcount, queryfailtime, state, ban, creationtime, updatetime, deleted, payretcode, queryretcode, verifystate', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'details' => array(self::HAS_MANY, 'TenpayDetail', 'package'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'package' => 'Package',
			'paystate' => 'Paystate',
			'querystate' => 'Querystate',
			'tradestate' => 'Tradestate',
			'count' => 'Count',
			'amount' => 'Amount',
			'succount' => 'Succount',
			'succfee' => 'Succfee',
			'failcount' => 'Failcount',
			'failfee' => 'Failfee',
			'retmsg' => 'Retmsg',
			'payreqcount' => 'Payreqcount',
			'queryfailtime' => 'Queryfailtime',
			'state' => 'State',
			'ban' => 'Ban',
			'payretcode' => 'Payretcode',
			'queryretcode' => 'Queryretcode',
			'creationtime' => 'Creationtime',
			'updatetime' => 'Updatetime',
			'deleted' => 'Deleted',
            'verifystate' => 'Verifystate',
            'transtype' => 'Transtype',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('package',$this->package,true);
		$criteria->compare('paystate',$this->paystate,true);
		$criteria->compare('querystate',$this->querystate,true);
		$criteria->compare('tradestate',$this->tradestate);
		$criteria->compare('count',$this->count);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('succount',$this->succount);
		$criteria->compare('succfee',$this->succfee);
		$criteria->compare('failcount',$this->failcount);
		$criteria->compare('failfee',$this->failfee);
		$criteria->compare('retmsg',$this->retmsg,true);
		$criteria->compare('payreqcount',$this->payreqcount);
		$criteria->compare('queryfailtime',$this->queryfailtime,true);
		$criteria->compare('state',$this->state);
		$criteria->compare('ban',$this->ban);
		$criteria->compare('creationtime',$this->creationtime,true);
		$criteria->compare('updatetime',$this->updatetime,true);
		$criteria->compare('deleted',$this->deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
    * panrj 2015-02-04
    * 获取需要处理的班费的银行代付记录
    * @return TenpayRecord records
    */
    public static function getNeedDealTenpays()
    {
        $criteria = new CDbCriteria();
        $criteria->compare('payreqcount','<3');
        $criteria->compare('amount','>0');
        $criteria->compare('count','>0');
        $criteria->compare('state',0);
        $criteria->compare('verifystate',1);
        $criteria->compare('transtype',0);
        $criteria->compare('deleted',0);
        $criteria->compare('ban',0);
        return self::model()->findAll($criteria);
    }

    /**
    * panrj 2015-10-23
    * 获取需要处理的班费卡的银行代付记录
    * @return TenpayRecord records
    */
    public static function getNeedDealFeeCardTenpays()
    {
        $criteria = new CDbCriteria();
        $criteria->compare('payreqcount','<3');
        $criteria->compare('amount','>0');
        $criteria->compare('count','>0');
        $criteria->compare('state',0);
        $criteria->compare('verifystate',0);
        $criteria->compare('transtype',1);
        $criteria->compare('deleted',0);
        $criteria->compare('ban',0);
        return self::model()->findAll($criteria);
    }


    /**
     * 设置批次中每笔参数
     */
    public function setTenpayDetailsToRecords()
    {
    	$details = $this->details;
    	$records = array();
    	foreach($details as $detail){
    		$item = array(
    			'serial'=>$detail->serial,
                'rec_bankacc'=>$detail->bankacc, 
                'bank_type'=>$detail->banktype,
                'rec_name'=>$detail->recname,
                'pay_amt'=>$detail->payamt,
                'acc_type'=>$detail->acctype,
                'area'=>$detail->area,
                'city'=>$detail->city,
                'subbank_name'=> $detail->subbankname,
                'desc'=>$detail->paydesc, 
                'recv_mobile'=>$detail->recmobile,
            );
            $records[] = $item;
    	}
    	return $records;
    }

    /**
     * 查询结果处理并更新状态
     * @param array $data 银行代付查询接口返回得查询数据
     */
    public function setTenpayQueryResult($data)
    {
    	$package = $this->package;
    	$trade_state = $data['trade_state'];
    	
    	//已提交银行
    	$tobank_set = $data['tobank_set'];
    	if($tobank_set['tobank_total']>0 && isset($tobank_set['tobank_rec'])){
    		$tobank_rec = $tobank_set['tobank_total']>1?$tobank_set['tobank_rec']:array($tobank_set['tobank_rec']);
    		$tobank_rec = TenpayHelper::recordCharSet($tobank_rec,'GB2312','UTF-8');
    		foreach($tobank_rec as $item){
    			$detail = TenpayDetail::getTenpayDetailByAttrs($package,$item['serial']);
    			$detail->state = 1;
    			$detail->modifytime = $item['modify_time'];
    			$detail->save();
    		}
    	}

    	//处理中
    	$handling_set = $data['handling_set'];
    	if($handling_set['handling_total']>0 && isset($handling_set['handling_rec'])){
    		$handling_rec = $handling_set['handling_total']>1?$handling_set['handling_rec']:array($handling_set['handling_rec']);
    		$handling_rec = TenpayHelper::recordCharSet($handling_rec,'GB2312','UTF-8');
    		foreach($handling_rec as $item){
    			$detail = TenpayDetail::getTenpayDetailByAttrs($package,$item['serial']);    			
    			$detail->state = 2;
    			$detail->modifytime = $item['modify_time'];
    			$detail->save();
    		}
    	}

    	//成功
    	$success_set = $data['success_set'];
    	if($success_set['suc_total']>0 && isset($success_set['suc_rec'])){
    		$suc_rec = $success_set['suc_total']>1?$success_set['suc_rec']:array($success_set['suc_rec']);
    		$suc_rec = TenpayHelper::recordCharSet($suc_rec,'GB2312','UTF-8');
    		foreach($suc_rec as $item){
    			$detail = TenpayDetail::getTenpayDetailByAttrs($package,$item['serial']);
    			$detail->state = 3;
    			$detail->modifytime = $item['modify_time'];
    			$detail->save();

    			// //最终态处理
    			// if(in_array($trade_state, array(4,6,7))){
	    		// 	//短信通知
	    		// 	$mobile = $detail->recmobile;
	    		// 	$outMoney = sprintf('%0.2f', $detail->payamt/100);
	    		// 	$msg = '尊敬的班班用户您好，您成功转出班费'. $outMoney .'元，班费已转账到您尾号为'.substr($detail->bankacc, -4).'的银行卡中。';

       //              //给班级成员发通知
       //              self::sendClassNotice($detail);
                    
	    		// 	UCQuery::sendMobileMsg($mobile,$msg);
	    		// }
    		}
    	}

    	//失败
    	$fail_set = $data['fail_set'];
    	if($fail_set['fail_total']>0 && isset($fail_set['fail_rec'])){
    		$fail_rec = $fail_set['fail_total']>1?$fail_set['fail_rec']:array($fail_set['fail_rec']);
    		$fail_rec = TenpayHelper::recordCharSet($fail_rec,'GB2312','UTF-8');
    		foreach($fail_rec as $item){
    			$detail = TenpayDetail::getTenpayDetailByAttrs($package,$item['serial']);
    			$detail->state = 4;
    			$detail->faildesc = $item['desc'];
    			$detail->errcode = $item['err_code'];
    			$detail->errmsg = $item['err_msg'];
    			$detail->modifytime = $item['modify_time'];

    			//最终态处理
    			if(in_array($trade_state, array(4,6,7))){
    				//提款回滚设置
    				$detail->rollbackstate = 1;
    			}
    			$detail->save();
    		}
    	}
    }

    /**
     * 班费转出成功后给班级成员发送班费转出通知
     * @param  integer $cid 班级ID
     * @param  string $uid 用户ID
     */
    public static function sendClassNotice($detail)
    {
    	$outMoney = sprintf('%0.2f', $detail->payamt/100);
    	$class = MClass::model()->findByPk($detail->cid);
    	$user = Member::model()->findByPk($detail->userid);
        //查询班费余额
        $feeInfoArr = JceHelper::getClassFeeInfo(array($detail->cid));
        $classFee = sprintf('%0.2f', $feeInfoArr[0]['dBalance']);

    	$receiver = array('1'=>$detail->cid);
    	$teachers = ClassTeacherRelation::getClassTeacher($detail->cid);
    	$teacher_pks = '';
    	foreach($teachers as $t){
    		if($teacher_pks){
    			$teacher_pks = $teacher_pks.',';
    		}
    		$teacher_pks = $teacher_pks.$t['teacher'];
    	}
    	$receiver['5'] = $teacher_pks;
    	$receiver = json_encode($receiver); //接收者集
    	$content = '您的班级“'.$class->name.'”的班主任'.$user->name.'老师成功转出'.$outMoney.'元班费！班费剩余'.$classFee.'元。大家继续加油挣班费吧！';
        $data = array();
        $data['uid'] = $user->userid; //发布者
        $data['sendertitle'] = '班班官方团队'; //发送者签名
        $data['receiver'] = $receiver; //接收人集合
        $data['noticeType'] = 0; //通知类型
        $data['isSendsms'] = 0; //是否给目标发短信
        $data['receiveTitle'] = 'xxx'; //接收者称呼
        $data['fixed_time'] = ''; //定时发送时间
        $data['receivename'] = $class->name.'全体成员'; //接收人名称集合();
        $data['sid'] = $class->sid; //学校id
        $data['uname'] = '班班官方团队'; //发送人真实姓名
        $data['data'] = json_encode(array('content' => strip_tags(trim($content))), JSON_UNESCAPED_UNICODE);
        $data['evaluatetype'] = 0; 
        $success = NoticeQuery::publishNotice($data, 101, 0);
    }

    /**
     * 班费转出成功后给班级成员发送班费转出通知(redis)
     * @param  integer $cid 班级ID
     * @param  string $uid 用户ID
     */
    public static function sendClassNoticeByRedis($detail)
    {


       // D($teachers);
        $outMoney = sprintf('%0.2f', $detail->payamt/100);
        $class = JceHelper::classInfo($detail->cid,1);
        $user = JceHelper::getUserInfo($detail->userid);
        //查询班费余额
        $feeInfoArr = JceHelper::getClassFeeInfo(array($detail->cid));
        $classFee = sprintf('%0.2f', $feeInfoArr[0]['dBalance']);
        $receiver['1'] = array($detail->cid);
        $teachers = JceClass::getClassMember($detail->cid,1,$user->uid);

        $teachersArr=array();
        $teacher_pks = '';
        if(is_array($teachers)){
            foreach($teachers as $t){
                $teachersArr[]=$t->uid;
            }
        }
        if(!empty($teachersArr)){
            $receiver['5'] = $teachersArr;
        }
        //$receiver = json_encode($receiver); //接收者集
        $content = '您的班级“'.$class->name.'”的班主任'.$user->name.'老师成功转出'.$outMoney.'元班费！班费剩余'.$classFee.'元。大家继续加油挣班费吧！';
        $data = array();
        $data['uid'] = $user->uid; //发布者
        $data['sendertitle'] = '班班官方团队'; //发送者签名
        $data['receiver'] = $receiver; //接收人集合
        $data['noticeType'] = 0; //通知类型
        $data['isSendsms'] = 0; //是否给目标发短信
        $data['receiveTitle'] = 'xxx'; //接收者称呼
        $data['fixed_time'] = ''; //定时发送时间
        $data['receivename'] = $class->name.'全体成员'; //接收人名称集合();
      //  $data['sid'] = $class->sid; //学校id
        $data['uname'] = '班班官方团队'; //发送人真实姓名
        $data['data'] = json_encode(array('content' => strip_tags(trim($content))), JSON_UNESCAPED_UNICODE);
        $data['evaluatetype'] = 0;
      //  $success =JceNotice::sendNotice(time(),$receiverObject,$noticeType,'',trim($_POST['content']),
       //     $instance->name,$uid,$postevalute,$receivername);
        $success =JceHelper::sendNotice(time(),$receiver,0,'',$content,$data['sendertitle'],$data['uid'],0,$data['receivename']);
            //NoticeQuery::publishNotice($data, 101, 0);
    }


    /**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TenpayRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
