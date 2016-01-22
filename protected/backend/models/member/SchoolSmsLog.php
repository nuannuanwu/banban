<?php

/**
 * This is the model class for table "{{school_sms_log}}".
 *
 * The followings are the available columns in table '{{school_sms_log}}':
 * @property integer $id
 * @property integer $sid
 * @property integer $type
 * @property integer $num
 * @property string $creationtime
 * @property string $updatetime
 * @property integer $deleted
 */
class SchoolSmsLog extends MemberActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{school_sms_log}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sid', 'required'),
			array('sid, smstype, num', 'numerical', 'integerOnly'=>true),
			array('creationtime, creator', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sid, type, num,creator, creationtime', 'safe', 'on'=>'search'),
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
            'member' => array(self::BELONGS_TO, 'Member', 'creator'),
            'school' => array(self::BELONGS_TO, 'School', 'sid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '自增ID',
			'sid' => '学校ID',
			'smstype' => '类型，0：系统赠送，1：充值，2：使用',
			'num' => '短信数量',
			'creationtime' => '创建时间',
			'creator' => '操作用户uid',
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
		$criteria->compare('sid',$this->sid);
		$criteria->compare('type',$this->type);
		$criteria->compare('num',$this->num);
		$criteria->compare('creationtime',$this->creationtime,true);
		$criteria->compare('updatetime',$this->updatetime,true);
		$criteria->compare('deleted',$this->deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * 查询非首月创建要赠送短信的学校
	 * panrj 2015-05-27
	 * @return array ActiveRecords
	 */
	public static function getFirstMonthSchools()
	{
		$month = date("Y-m",time());
        $criteria = new CDbCriteria;
        $criteria->compare('isemergencynotice', 1);
        $criteria->compare('deleted', 0);
        $criteria->addCondition("DATE_FORMAT(creationtime,'%Y-%m')='".$month."'");
        $schools=School::model()->findAll($criteria);
        return $schools;
	}

	/**
	 * 查询创建首月要赠送短信的学校
	 * panrj 2015-05-27
	 * @return array ActiveRecords
	 */
	public static function getUnFirstMonthSchools()
	{
		$month = date("Y-m",time());
        $criteria = new CDbCriteria;
        $criteria->compare('isemergencynotice', 1);
        $criteria->compare('deleted', 0);
        $criteria->addCondition("DATE_FORMAT(creationtime,'%Y-%m')!='".$month."'");
        $schools=School::model()->findAll($criteria);
        return $schools;
	}

	/**
	 * 检查当月有没有处理过赠送短信
	 * panrj 2015-05-27
	 */
	public static function checkSchoolSmsReset($sid)
	{
		$month = date("Y-m",time());
        $criteria = new CDbCriteria;
        $criteria->compare('smstype', 0);
        $criteria->compare('sid', $sid);
        $criteria->addCondition("DATE_FORMAT(creationtime,'%Y-%m')='".$month."'");
        $school=self::model()->find($criteria);
        return $school;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SchoolSmsLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
