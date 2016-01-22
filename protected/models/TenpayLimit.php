<?php

/**
 * This is the model class for table "{{tenpay_limit}}".
 *
 * The followings are the available columns in table '{{tenpay_limit}}':
 * @property integer $id
 * @property string $userid
 * @property integer $cid
 * @property string $creationtime
 * @property integer $payamt
 */
class TenpayLimit extends XiaoXinActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{tenpay_limit}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userid', 'required'),
			array('cid, payamt, detailid', 'numerical', 'integerOnly'=>true),
			array('userid', 'length', 'max'=>20),
			array('creationtime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, userid, cid, creationtime, payamt, detailid', 'safe', 'on'=>'search'),
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
			'detail' => array(self::BELONGS_TO, 'TenpayDetail', 'detailid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '自增ID',
			'userid' => '用户ID',
			'cid' => '班级ID',
			'creationtime' => '转出时间',
			'payamt' => '付款金额(以分为单位)',
			'detailid' => '明细ID',
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
		$criteria->compare('userid',$this->userid,true);
		$criteria->compare('cid',$this->cid);
		$criteria->compare('creationtime',$this->creationtime,true);
		$criteria->compare('payamt',$this->payamt);
		$criteria->compare('detailid',$this->detailid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function getUserMonthHistory($userid)
    {

        $criteria = new CDbCriteria();
        $month = date('Y-m',time());
        $criteria->with=array("detail");
        $criteria->compare('t.userid',$userid);
        $criteria->compare('detail.state','<>4');
        $criteria->compare('detail.ban',0);
        $criteria->compare('detail.deleted',0);
        $criteria->addCondition("DATE_FORMAT(t.creationtime,'%Y-%m')='".$month."'",'and');
        $record = self::model()->find($criteria);
        return $record;
    }

    public static function checkIsOutTransMonthAmt()
    {
    	$db = Yii::app()->db_xiaoxin;
    	$month = date('Y-m-d',time());
    	$sql = "SELECT SUM(l.payamt) FROM bb_xiaoxin.tb_tenpay_limit l LEFT JOIN bb_xiaoxin.tb_tenpay_detail d ON l.detailid=d.id  WHERE DATE_FORMAT(l.creationtime,'%Y-%m-%d')='".$month."' AND d.state<>4";
    	// $sql = "SELECT SUM(payamt) FROM tb_tenpay_limit WHERE DATE_FORMAT(creationtime,'%Y-%m-%d')='".$month."'";
        $result = $db->createCommand($sql);
        $amt = $result->queryScalar();
        if($amt && $amt>=500000){
        	return true;
        }
        return false;
    }

    public static function setRecordLimit($detail)
    {
    	$limit = new TenpayLimit;
    	$limit->userid = $detail->userid;
    	$limit->cid = $detail->cid;
    	$limit->payamt = $detail->payamt;
    	$limit->detailid = $detail->id;
    	$limit->save();
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TenpayLimit the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
