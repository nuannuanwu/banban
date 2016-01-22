<?php

/**
 * This is the model class for table "{{notice_message}}".
 *
 * The followings are the available columns in table '{{notice_message}}':
 * @property string $msgid
 * @property string $noticeid
 * @property string $sender
 * @property string $sendertitle
 * @property string $receiver
 * @property string $rguardian
 * @property string $receivertitle
 * @property integer $noticetype
 * @property string $content
 * @property string $sendtime
 * @property integer $read
 * @property integer $state
 * @property string $creationtime
 * @property string $updatetime
 * @property integer $deleted
 * @property string $sid
 * @property string $schoolname
 * @property string $uname
 * @property integer $istrans
 * @property string $rmobilephone
 * @property integer $appstate
 * @property integer $iosstate
 * @property integer $evaluatetype
 */
class NoticeMessage extends XiaoXinActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
    public $sendname;

    public $receivename;

	public function tableName()
	{
		return '{{notice_message}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('noticeid, sender, receiver, noticetype, sendtime', 'required'),
			array('noticetype, read, state, deleted, istrans, appstate, iosstate, evaluatetype, issendsms', 'numerical', 'integerOnly'=>true),
			array('noticeid, sender, receiver, sid', 'length', 'max'=>20),
			array('sendertitle, receivertitle, uname', 'length', 'max'=>50),
			array('rguardian, schoolname', 'length', 'max'=>100),
			array('rmobilephone', 'length', 'max'=>200),
			array('content, updatetime,creationtime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('msgid, noticeid, sender, sendertitle, receiver, rguardian, receivertitle, noticetype, content, sendtime, read, state, creationtime, updatetime, deleted, sid, schoolname, uname, istrans, rmobilephone, appstate, iosstate, evaluatetype, issendsms', 'safe', 'on'=>'search'),
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
            's' => array(self::BELONGS_TO, 'Member', 'sender'),
            'r' => array(self::BELONGS_TO, 'Member', 'receiver'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'msgid' => '消息ID',
			'noticeid' => '通知',
			'sender' => '发送者',
			'sendertitle' => '发送者称谓',
			'receiver' => '接收者（老师或学生）',
			'rguardian' => '接收者监护人：当接收者为学生时，该字段才生效。',
			'receivertitle' => '接收者称呼',
			'noticetype' => '通知类型：0系统消息；1家庭作业；2家长学校通知；3在校表现；4紧急通知；5成绩通知；6邀请;7:老师学校通知;8:工作餐单',
			'content' => '',
			'sendtime' => '发送时间',
			'read' => '是否已读',
			'state' => '短信处理状态：0待处理；1已处理并发送短信；2已处理未发送短信: 3学校黑名单中的短信: 4不在白名单中用户发送的短信: 5异常',
			'creationtime' => '创建时间',
			'updatetime' => '更新时间',
			'deleted' => '是否已删除',
			'sid' => '学校id',
			'schoolname' => '学校名称',
			'uname' => '发送者名称 uid相对应的username',
			'istrans' => '是否同步到ios,android客户端(1--已转换,0--未转换,2--转换异常)',
			'rmobilephone' => '监护人手机号码逗分字符',
			'appstate' => 'APP 服务状态(0.未处理;1.已处理;2.有客户端且已经发送)',
			'iosstate' => 'ios补发短信处理状态',
			'evaluatetype' => '评论类型(0--表扬  1--批评)只有点评学生时有用',
			'issendsms' => '是否将此消息发送短信(0--no  1 yes)',
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

		$criteria->compare('msgid',$this->msgid,true);
		$criteria->compare('noticeid',$this->noticeid,true);
		$criteria->compare('sender',$this->sender,true);
		$criteria->compare('sendertitle',$this->sendertitle,true);
		$criteria->compare('receiver',$this->receiver,true);
		$criteria->compare('rguardian',$this->rguardian,true);
		$criteria->compare('receivertitle',$this->receivertitle,true);
		$criteria->compare('noticetype',$this->noticetype);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('sendtime',$this->sendtime,true);
		$criteria->compare('read',$this->read);
		$criteria->compare('state',$this->state);
		$criteria->compare('creationtime',$this->creationtime,true);
		$criteria->compare('updatetime',$this->updatetime,true);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('sid',$this->sid,true);
		$criteria->compare('schoolname',$this->schoolname,true);
		$criteria->compare('uname',$this->uname,true);
		$criteria->compare('istrans',$this->istrans);
		$criteria->compare('rmobilephone',$this->rmobilephone,true);
		$criteria->compare('appstate',$this->appstate);
		$criteria->compare('iosstate',$this->iosstate);
		$criteria->compare('evaluatetype',$this->evaluatetype);
		$criteria->compare('issendsms',$this->issendsms);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return NoticeMessage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    /*
     * 置一批msgid为已读
     */
    public static function updateReadState($ids,$state=1){
        $criteria=new CDbCriteria;
        $criteria->addInCondition("msgid",$ids);
        return self::model()->updateAll(array('read'=>$state),$criteria);
    }
    /*
  * 将登录人所有消息设为已读
  */
    public static function updateReadStateByUidNoticeType($uid,$noticeType,$update=1){
        $criteria = new CDbCriteria();
        $criteria->addInCondition("receiver",explode(",",$uid));
        if(!empty($noticeType)){
            $criteria->addCondition("noticetype in(".$noticeType.")");
        }else{
            if($noticeType==='0'){
                $criteria->addCondition("noticetype in(".$noticeType.")");
            }
        }
        $criteria->compare("`read`",0);
        if($update==1){ //更新
            return self::model()->updateAll(array('read'=>1),$criteria);
        }else if($update==2){
            return self::model()->count($criteria);
        }else{
            return self::model()->findAll($criteria);
        }
    }

    /*
  * 根据家长id和消息id获取message的单条信息
  */
    public static function getMessageByFamily($uid,$noticeid){
        $criteria = new CDbCriteria();
        $criteria->compare("noticeid",$noticeid);
        $criteria->addCondition(" find_in_set(".$uid.",rguardian)");
        return self::model()->find($criteria);

    }

    public static function getYesterdayBean($date,$ty=-1,$lastid=0,$limit=5000)
    {
    	$criteria = new CDbCriteria();
        $criteria->compare("appstate",">0");
        $criteria->addCondition("msgid>".$lastid,'and');
        // $criteria->compare("state","!=1");
        $criteria->addCondition("state!=1",'and');
        $criteria->compare("issendsms",0);
        $criteria->compare("noticetype",$ty);
        $criteria->addCondition("TO_DAYS('".$date."')-TO_DAYS(sendtime)=0",'and');
        $criteria->order = 'msgid ASC'; 
        $criteria->limit = $limit;
        return self::model()->findAll($criteria);
    }
    /*
     * 获取消息
     */
    public static function getMessage($params){
        $result = array();
        $criteria = new CDbCriteria;
        if(isset($params['identity']) && !empty($params['identity'])){
            if($params['identity']==Constant::LOGIN_TYPE_TEACHER){
                if(isset($params['uid'])&&!empty($params['uid'])){
                  $criteria->compare('receiver',$params['uid']);
                }
            }else{
                //家长的话，uid传一个数组,孩子id数组
                if(isset($params['uid'])&&!empty($params['uid'])){
                    $criteria->addInCondition("receiver",$params['uid']);
                }
                if(empty($params['uid'])){
                    $criteria->addInCondition("receiver",array(0));
                }

            }

        }
        $criteria->compare("deleted",0);
        //如果传了查找字符串的话
        if(isset($params['searchname']) && $params['searchname']!=''){
            $criteria->compare('content',$params['searchname'],true);
        }
        $criteria->order = 'noticeid DESC';
        $count = self::model()->count($criteria);
        $pager = new CPagination($count);
        if(isset($params['size']) && $params['size']){
            $pager->pageSize = $params['size'];
        }else{
            $pager->pageSize = Constant::MESSAGE_PAGE_SIZE;
        }
        $pager->applyLimit($criteria);
        $datalist = self::model()->findAll($criteria);
        $result['model'] = $datalist;
        $result['pages'] = $pager;
        $result['count'] = $count;
        return $result;
    }

    /*
    * 获取消息,之前是区别自己和家长，现在是获取我，及我的孩子的消息，不再区分登陆身份
    */
    public static function getUserMessage($params){
        $result = array();
        $criteria = new CDbCriteria;
        //uid传一个数组,孩子id数组及自己
        if(isset($params['uid'])&&!empty($params['uid'])){
            $criteria->addInCondition("receiver",$params['uid']);
        }
        if(empty($params['uid'])){
            $count=0;
        }else{

            $criteria->compare("deleted",0);
            //如果传了查找字符串的话
            if(isset($params['searchname']) && $params['searchname']!=''){
                $criteria->compare('content',$params['searchname'],true);
            }
            $criteria->order = 'noticeid DESC';
            $count = self::model()->count($criteria);
        }
        $pager = new CPagination($count);
        if(isset($params['size']) && $params['size']){
            $pager->pageSize = $params['size'];
        }else{
            $pager->pageSize = Constant::MESSAGE_PAGE_SIZE;
        }
        $pager->applyLimit($criteria);
        $datalist = empty($params['uid'])?array():self::model()->findAll($criteria);
        $result['model'] = $datalist;
        $result['pages'] = $pager;
        $result['count'] = $count;
        return $result;
    }

    //获取未读的条数
    public static function getnoReadMessage($params){

        $struid="0";
        $result = array();
        $criteria = new CDbCriteria;

        //家长的话，uid传一个数组,孩子id数组
        if(isset($params['uid'])&&!empty($params['uid'])){
            $struid=implode(",",$params['uid']);
        }
        $uid=Yii::app()->user->id; //统计未读数，要重新修改
        if($uid){
                    $sql="SELECT f.num+f1.num AS num FROM  (SELECT COUNT(*) AS num  FROM `tb_notice_message` WHERE receiver IN($struid) AND `read`=0 AND deleted=0 AND sendtime<='2015-05-12 18:00:00') AS f,".
                    "(SELECT COUNT(*) AS num  FROM `tb_notice_message` WHERE  receiver IN($struid) AND  (FIND_IN_SET($uid,IF(ISNULL(readusers),'',readusers)))<1 AND deleted=0 AND sendtime>='2015-05-12 18:00:00') AS f1";
              $res=NoticeQuery::queryRow($sql);
              return $res?$res['num']:0;
        }else{
            return 0;
        }

        //error_log(json_encode($params));
        $criteria->compare("`read`",0);
        $criteria->compare("deleted",0);
        //$criteria->order = 'noticeid DESC';
        $num = self::model()->count($criteria);
        return $num;
    }
    //消息后台查询
    public static function searchMessage($params){
        $result=array();
        $criteria = new CDbCriteria;
        if(isset($params['sender'])&&$params['sender']){
            $criteria->compare("sender",$params['sender']);
        }
        if(isset($params['startdate'])&&$params['startdate']){
           // $criteria->compare("sendtime",'>='.$params['startdate']);
        }
        if(isset($params['enddate'])&&$params['enddate']){
          //  $criteria->compare("sendtime",'<'.$params['startdate']." 23:59:59");
        }
        if(isset($params['noticetype'])&&$params['noticetype']!==''){
            $criteria->compare("noticetype",$params['noticetype']);
        }
        if(isset($params['receivephone'])&&$params['receivephone']){
            $criteria->compare("rmobilephone",$params['receivephone']);
        }
        if(empty($params['startdate'])&&empty($params['enddate'])){ //开始，结束日期都为空，则取大于当天日期的前七天
            $criteria->compare("sendtime",'>='.date("Y-m-d",strtotime("-7 day")));//ss
        }
        if(empty($params['startdate'])&&!empty($params['enddate'])){ ////开始日期为空，结束日期不为空,则取结束日期前七天
            $criteria->compare("sendtime",'>='.date("Y-m-d",strtotime("-7 day",strtotime($params['enddate']))));//ss
            $criteria->compare("sendtime",'<='.$params['enddate']." 23:59:59");//ss
        }
        if(!empty($params['startdate'])&&empty($params['enddate'])){ ////开始日期不为空，结束日期为空,则取开始日期后七天
            $criteria->compare("sendtime",'>='.$params['startdate']);//ss
            $criteria->compare("sendtime",'<='.date("Y-m-d",strtotime("+7 day",strtotime($params['startdate'])))." 23:59:59");//ss

        }
        $criteria->order = 'msgid DESC';
        $count = self::model()->count($criteria);
        $pager = new CPagination($count);
        if(isset($params['size']) && $params['size']){
            $pager->pageSize = $params['size'];
        }else{
            $pager->pageSize = 15;//Constant::MESSAGE_PAGE_SIZE;
        }
        $pager->applyLimit($criteria);
        $uids=array();
        $datalist = self::model()->findAll($criteria);
        foreach($datalist as $k=>$v){
               $uids[]=$v->sender;
               $uids[]=$v->receiver;
        }
        $members=Member::getUsersByUids($uids);
        $memberArr=array();
        foreach($members as $val){
            $memberArr[$val->userid]=$val->name;
        }
        foreach($datalist as $k=>$v){
            $datalist[$k]->sendname=isset($memberArr[$v->sender])?$memberArr[$v->sender]:'';
            $datalist[$k]->receivename=isset($memberArr[$v->receiver])?$memberArr[$v->receiver]:'';
            $content=json_decode($v->content,true);
            $datalist[$k]->content=$content['content'];
        }
        $result['model'] = $datalist;
        $result['pages'] = $pager;
        $result['count'] = $count;
        return $result;
    }
    //统计消息的已读数
    public static function countNoticeReadNum($noticeid,$uid){
        //总的接收人
        $sql="select  count(receiver) as num   FROM tb_notice_message WHERE NOTICEID=$noticeid   and deleted=0 ";
        $total_res=NoticeQuery::queryRow($sql);
        $total=(int)$total_res['num'];//总接收人,不包括自己,以学生为基础，所以要对学生group



        //已读数(isappread=1(app已读)  or read=1(web已读)
        $read_sql="select count(*) as num   FROM tb_notice_message WHERE NOTICEID=$noticeid  and  ( `read`=1 or isappread=1) and deleted=0 ";
        $total_read_res=NoticeQuery::queryRow($read_sql);
        $total_read_num=(int)$total_read_res['num'];
        return array('total'=>$total,'read_num'=>$total_read_num);
    }

    public static  function SerarchReceiver($noticeid,$mobilephone){
        $criteria = new CDbCriteria;
        $criteria->compare("noticeid",$noticeid);
        $criteria->compare("deleted",0);
        if(!empty($mobilephone)){
            if(!preg_match('/^0?1\d{10}$/',$mobilephone)){
                if($mobilephone=='家长'){
                    $mobilephone="******";
                }
                $criteria->compare("receivertitle",$mobilephone,true);
            }else{
                $criteria->compare("rmobilephone",$mobilephone,true);
            }
        }
        return self::model()->findAll($criteria);
    }

}
