<?php

/**
 * This is the model class for table "{{fee_black}}".
 *
 * The followings are the available columns in table '{{fee_black}}':
 * @property integer $id
 * @property integer $cid
 * @property string $classname
 * @property string $classcode
 * @property integer $classtype
 * @property string $userid
 * @property string $username
 * @property string $mobilephone
 * @property integer $sid
 * @property string $schoolname
 * @property integer $teachercount
 * @property integer $studentcount
 * @property integer $noticecount
 * @property integer $balance
 * @property integer $totalmoney
 * @property string $operationid
 * @property string $createtime
 * @property integer $deleted
 * @property string $deleteuserid
 * @property string $payids
 * @property string $accountinfo
 * @property string $noticeids
 */
class FeeBlack extends XiaoXinActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{fee_black}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cid, classtype, sid, teachercount, studentcount, noticecount, balance, totalmoney, deleted', 'numerical', 'integerOnly'=>true),
			array('classname, username', 'length', 'max'=>50),
			array('classcode', 'length', 'max'=>10),
			array('userid, mobilephone, operationid, deleteuserid', 'length', 'max'=>20),
			array('schoolname', 'length', 'max'=>40),
			array('accountinfo', 'length', 'max'=>200),
			array('createtime, payids, noticeids', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cid, classname, classcode, classtype, userid, username, mobilephone, sid, schoolname, teachercount, studentcount, noticecount, balance, totalmoney, operationid, createtime, deleted, deleteuserid, payids, accountinfo, noticeids', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '主键',
			'cid' => '班级ID',
			'classname' => '班级名称',
			'classcode' => '班级代码',
			'classtype' => '所在学校的班级类型：0非关联班级，1关联班级',
			'userid' => '班主任ID',
			'username' => '班主任姓名',
			'mobilephone' => '班主任机号',
			'sid' => '学校ID',
			'schoolname' => '学校名称',
			'teachercount' => '老师数',
			'studentcount' => '学生数',
			'noticecount' => '已发通知总数',
			'balance' => '班费余额',
			'totalmoney' => '累计转出金额',
			'operationid' => '后台操作人ID',
			'createtime' => '创建时间（设黑名单时间）',
			'deleted' => '是否删除',
			'deleteuserid' => '后台删除操作人ID',
			'payids' => '转出记录tenpay_detail的详情ID，用“,”号分隔',
			'accountinfo' => '当时转出的金额帐号信息',
			'noticeids' => '发送消息id的历史id记录，逗号分隔',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('cid',$this->cid);
		$criteria->compare('classname',$this->classname,true);
		$criteria->compare('classcode',$this->classcode,true);
		$criteria->compare('classtype',$this->classtype);
		$criteria->compare('userid',$this->userid,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('mobilephone',$this->mobilephone,true);
		$criteria->compare('sid',$this->sid);
		$criteria->compare('schoolname',$this->schoolname,true);
		$criteria->compare('teachercount',$this->teachercount);
		$criteria->compare('studentcount',$this->studentcount);
		$criteria->compare('noticecount',$this->noticecount);
		$criteria->compare('balance',$this->balance);
		$criteria->compare('totalmoney',$this->totalmoney);
		$criteria->compare('operationid',$this->operationid,true);
		$criteria->compare('createtime',$this->createtime,true);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('deleteuserid',$this->deleteuserid,true);
		$criteria->compare('payids',$this->payids,true);
		$criteria->compare('accountinfo',$this->accountinfo,true);
		$criteria->compare('noticeids',$this->noticeids,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/*
     * 查询是否在黑名单中
     * panrj 2015-12-14
     * @parms int $cid 班级ID 
     */
    public static function checkInFeeBlack($cid=0)
    {
    	$member = self::model()->findByAttributes(array('cid'=>$cid,'deleted'=>0));
    	return $member?true:false;
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FeeBlack the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
