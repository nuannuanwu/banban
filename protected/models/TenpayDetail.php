<?php

/**
 * This is the model class for table "{{tenpay_detail}}".
 *
 * The followings are the available columns in table '{{tenpay_detail}}':
 * @property integer $id
 * @property string $package
 * @property integer $cid
 * @property string $userid
 * @property string $ordernum
 * @property integer $serial
 * @property integer $state
 * @property string $bankacc
 * @property string $banktype
 * @property string $recname
 * @property string $idcard
 * @property integer $payamt
 * @property integer $acctype
 * @property string $area
 * @property string $city
 * @property string $subbankname
 * @property string $recmobile
 * @property string $paydesc
 * @property string $faildesc
 * @property string $errcode
 * @property string $errmsg
 * @property string $modifytime
 * @property string $creationtime
 * @property string $updatetime
 * @property integer $deleted
 */
class TenpayDetail extends XiaoXinActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{tenpay_detail}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('package, serial, cid, userid, ordernum, bankacc, banktype, recname, idcard, area, city, subbankname, verifystate', 'required'),
			array('id, cid, state, ban, payamt, acctype, rollbackstate, issendnotice, issendmsg, deleted, refund, verifystate, transtype', 'numerical', 'integerOnly'=>true),
			array('package', 'length', 'max'=>30),
			array('serial', 'length', 'max'=>32),
			array('userid, ordernum', 'length', 'max'=>20),
			array('bankacc', 'length', 'max'=>25),
			array('banktype, area', 'length', 'max'=>4),
			array('recname', 'length', 'max'=>120),
			array('city', 'length', 'max'=>8),
			array('subbankname, paydesc', 'length', 'max'=>150),
			array('recmobile', 'length', 'max'=>15),
		    array('idcard', 'length', 'max'=>18),
			array('faildesc, errcode, errmsg', 'length', 'max'=>500),
			array('modifytime, updatetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, package, cid, userid, ordernum, serial, state, ban, bankacc, banktype, recname, idcard, payamt, acctype, area, city, subbankname, recmobile, paydesc, faildesc, errcode, errmsg, modifytime, creationtime, updatetime,rollbackstate, issendnotice, issendmsg, deleted, refund', 'safe', 'on'=>'search'),
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
			'parent' => array(self::BELONGS_TO, 'TenpayRecord', 'package'),
		    'verify' => array(self::HAS_ONE, 'TenpayVerify', 'package'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'package' => 'Package',
			'cid' => 'Cid',
			'userid' => 'Userid',
			'ordernum' => 'Ordernum',
			'serial' => 'Serial',
			'state' => 'State',
			'ban' => 'Ban',
			'bankacc' => 'Bankacc',
			'banktype' => 'Banktype',
			'recname' => 'Recname',
		    'idcard' => 'Idcard',
			'payamt' => 'Payamt',
			'acctype' => 'Acctype',
			'area' => 'Area',
			'city' => 'City',
			'subbankname' => 'Subbankname',
			'recmobile' => 'Recmobile',
			'paydesc' => 'Paydesc',
			'faildesc' => 'Faildesc',
			'errcode' => 'Errcode',
			'errmsg' => 'Errmsg',
			'modifytime' => 'Modifytime',
			'rollbackstate'=>'Rollbackstate',
			'issendnotice'=>'Issendnotice', 
			'issendmsg'=>'Issendmsg',
			'creationtime' => 'Creationtime',
			'updatetime' => 'Updatetime',
			'deleted' => 'Deleted',
			'refund' => 'Refund',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('package',$this->package,true);
		$criteria->compare('cid',$this->cid);
		$criteria->compare('userid',$this->userid,true);
		$criteria->compare('ordernum',$this->ordernum,true);
		$criteria->compare('serial',$this->serial);
		$criteria->compare('state',$this->state);
		$criteria->compare('ban',$this->ban);
		$criteria->compare('bankacc',$this->bankacc,true);
		$criteria->compare('banktype',$this->banktype,true);
		$criteria->compare('recname',$this->recname,true);
		$criteria->compare('idcard',$this->idcard,true);
		$criteria->compare('payamt',$this->payamt);
		$criteria->compare('acctype',$this->acctype);
		$criteria->compare('area',$this->area,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('subbankname',$this->subbankname,true);
		$criteria->compare('recmobile',$this->recmobile,true);
		$criteria->compare('paydesc',$this->paydesc,true);
		$criteria->compare('faildesc',$this->faildesc,true);
		$criteria->compare('errcode',$this->errcode,true);
		$criteria->compare('errmsg',$this->errmsg,true);
		$criteria->compare('modifytime',$this->modifytime,true);
		$criteria->compare('creationtime',$this->creationtime,true);
		$criteria->compare('updatetime',$this->updatetime,true);
		$criteria->compare('issendmsg',$this->issendmsg);
		$criteria->compare('issendnotice',$this->issendnotice);
		$criteria->compare('deleted',$this->deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function getTenpayDetailByAttrs($package,$serial)
    {
        $criteria = new CDbCriteria();
        $criteria->compare('package',$package);
        $criteria->compare('serial',$serial);
        $record = self::model()->find($criteria);
        return $record;
    }

    //班费提交成功后转出失败回滚
    public static function getNeedRollbackDetails()
    {
        $criteria = new CDbCriteria();
        $criteria->with=array("parent");
        $criteria->compare('parent.tradestate',array(4,6,7));
        $criteria->compare('parent.state',array(1,3));
        $criteria->compare('parent.deleted', 0);
        $criteria->compare('parent.ban', 0);
        $criteria->compare('parent.transtype', 0);
        $criteria->compare('t.state',4);
        $criteria->compare('t.verifystate',1);
        $criteria->compare('t.rollbackstate',1);
        $criteria->compare('t.transtype',0);
        $criteria->compare('t.deleted',0);
        $criteria->compare('t.ban',0);
        return self::model()->findAll($criteria);
    }

    //班费卡提交成功后转出失败回滚
    public static function getFeeCardNeedRollbackDetails()
    {
        $criteria = new CDbCriteria();
        $criteria->with=array("parent");
        $criteria->compare('parent.tradestate',array(4,6,7));
        $criteria->compare('parent.state',array(1,3));
        $criteria->compare('parent.deleted', 0);
        $criteria->compare('parent.ban', 0);
        $criteria->compare('parent.transtype', 1);
        $criteria->compare('t.state',4);
        $criteria->compare('t.verifystate',0);
        $criteria->compare('t.rollbackstate',1);
        $criteria->compare('t.transtype',1);
        $criteria->compare('t.deleted',0);
        $criteria->compare('t.ban',0);
        return self::model()->findAll($criteria);
    }
    
    //班费三次调用提交失败转出失败回滚
    public static function getNeedRollbackDetailsByThreeFail()
    {
        $criteria = new CDbCriteria();
        $criteria->with=array("parent");
        $criteria->compare('parent.tradestate',0);
        $criteria->compare('parent.verifystate',1);
        $criteria->compare('parent.payreqcount',3);
        $criteria->compare('parent.state',2);
        $criteria->compare('parent.deleted',0);
        $criteria->compare('parent.ban',0);
        $criteria->compare('parent.transtype', 0);
        $criteria->compare('t.verifystate',1);
        $criteria->compare('t.deleted',0);
        $criteria->compare('t.ban',0);
        $criteria->compare('t.transtype',0);
        return self::model()->findAll($criteria);
    }

    //班费卡三次调用提交失败转出失败回滚
    public static function getFeeCardNeedRollbackDetailsByThreeFail()
    {
        $criteria = new CDbCriteria();
        $criteria->with=array("parent");
        $criteria->compare('parent.tradestate',0);
        $criteria->compare('parent.verifystate',0);
        $criteria->compare('parent.payreqcount',3);
        $criteria->compare('parent.state',2);
        $criteria->compare('parent.deleted',0);
        $criteria->compare('parent.ban',0);
        $criteria->compare('parent.transtype', 1);
        $criteria->compare('t.verifystate',0);
        $criteria->compare('t.deleted',0);
        $criteria->compare('t.ban',0);
        $criteria->compare('t.transtype',1);
        return self::model()->findAll($criteria);
    }

    //审核未通过回滚
    public static function getVerifyFail()
    {
        $criteria = new CDbCriteria();
        $criteria->with=array("parent");
        $criteria->compare('parent.verifystate',2);
        $criteria->compare('parent.state',3);
        $criteria->compare('parent.deleted',0);
        $criteria->compare('parent.ban',0);
        $criteria->compare('parent.transtype',0);
        $criteria->compare('t.verifystate',2);
        $criteria->compare('t.state',4);
        $criteria->compare('t.rollbackstate',1);
        $criteria->compare('t.deleted',0);
        $criteria->compare('t.ban',0);
        $criteria->compare('t.transtype',0);
        return self::model()->findAll($criteria);
    }

    public static function getNeedSendMsg()
    {
        $criteria = new CDbCriteria();
        $criteria->with=array("parent");
        $criteria->compare('parent.tradestate',array(4,6,7));
        $criteria->compare('parent.state',1);
        $criteria->compare('parent.deleted', 0);
        $criteria->compare('parent.ban', 0);
        $criteria->compare('parent.transtype', 0);
        $criteria->compare('t.state',3);
        $criteria->addCondition("t.idcard IS NOT NULL AND LENGTH(trim(t.idcard))>1");
        $criteria->compare('t.issendmsg',0);
        $criteria->compare('t.deleted',0);
        $criteria->compare('t.ban',0);
        $criteria->compare('t.transtype',0);
        return self::model()->findAll($criteria);
    }

    public static function getFeeCardNeedSendMsg()
    {
        $criteria = new CDbCriteria();
        $criteria->with=array("parent");
        $criteria->compare('parent.tradestate',array(4,6,7));
        $criteria->compare('parent.state',1);
        $criteria->compare('parent.deleted', 0);
        $criteria->compare('parent.ban', 0);
        $criteria->compare('parent.transtype', 1);
        $criteria->compare('t.state',3);
        $criteria->addCondition("t.idcard IS NOT NULL AND LENGTH(trim(t.idcard))>1");
        $criteria->compare('t.issendmsg',0);
        $criteria->compare('t.deleted',0);
        $criteria->compare('t.ban',0);
        $criteria->compare('t.transtype',1);
        return self::model()->findAll($criteria);
    }

    public static function getNeedSendNotice()
    {
        $criteria = new CDbCriteria();
        $criteria->with=array("parent");
        $criteria->compare('parent.tradestate',array(4,6,7));
        $criteria->compare('parent.state',1);
        $criteria->compare('parent.deleted', 0);
        $criteria->compare('parent.ban', 0);
        $criteria->compare('parent.transtype', 0);
        $criteria->compare('t.state',3);
        $criteria->addCondition("t.idcard IS NOT NULL AND LENGTH(trim(t.idcard))>1");
        $criteria->compare('t.issendnotice',0);
        $criteria->compare('t.deleted',0);
        $criteria->compare('t.ban',0);
        $criteria->compare('t.transtype', 0);
        return self::model()->findAll($criteria);
    }

    public static function getFeeCardNeedSendNotice()
    {
        $criteria = new CDbCriteria();
        $criteria->with=array("parent");
        $criteria->compare('parent.tradestate',array(4,6,7));
        $criteria->compare('parent.state',1);
        $criteria->compare('parent.deleted', 0);
        $criteria->compare('parent.ban', 0);
        $criteria->compare('parent.transtype', 1);
        $criteria->compare('t.state',3);
        $criteria->addCondition("t.idcard IS NOT NULL AND LENGTH(trim(t.idcard))>1");
        $criteria->compare('t.issendnotice',0);
        $criteria->compare('t.deleted',0);
        $criteria->compare('t.ban',0);
        $criteria->compare('t.transtype', 1);
        return self::model()->findAll($criteria);
    }

    public static function getNeedSendNoticeTest()
    {
        $criteria = new CDbCriteria();
        $criteria->with=array("parent");
        $criteria->compare('parent.tradestate',array(4,6,7));
        $criteria->compare('parent.state',1);
        $criteria->compare('parent.deleted', 0);
        $criteria->compare('parent.ban', 0);
        //$criteria->compare('t.state',3);
       // $criteria->addCondition("t.idcard IS NOT NULL AND LENGTH(trim(t.idcard))>1");
        //$criteria->compare('t.issendnotice',0);
      //  $criteria->compare('t.deleted',0);
        $criteria->compare('t.id',469);
        return self::model()->findAll($criteria);
    }
    
    /**
     * 获取上一次用户的转出信息
     * @param string $uid
     * @return ar
     */
    public static function getPrevInfo($uid)
    {
        $criteria = new CDbCriteria();
        $criteria->compare('userid', $uid);
        $criteria->compare('deleted', 0);
        $criteria->order = 'id desc';
        return self::model()->find($criteria);
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TenpayDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
