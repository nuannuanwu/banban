<?php

/**
 * This is the model class for table "{{phone_school_grade_relation}}".
 *
 * The followings are the available columns in table '{{phone_school_grade_relation}}':
 * @property integer $psgrid
 * @property string $phone
 * @property string $sid
 * @property integer $gid
 * @property integer $state
 * @property string $creationtime
 * @property string $updatetime
 * @property integer $deleted
 *
 * The followings are the available model relations:
 * @property School $s
 * @property Grade $g
 */
class PhoneSchoolGradeRelation extends MasterActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{phone_school_grade_relation}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('phone, sid, gid', 'required'),
			array('gid, state, deleted', 'numerical', 'integerOnly'=>true),
			array('phone', 'length', 'max'=>20),
			array('sid', 'length', 'max'=>10),
			array('creationtime, updatetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('psgrid, phone, sid, gid, state, creationtime, updatetime, deleted', 'safe', 'on'=>'search'),
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
			's' => array(self::BELONGS_TO, 'School', 'sid'),
			'g' => array(self::BELONGS_TO, 'Grade', 'gid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'psgrid' => '关系ID',
			'phone' => '用户手机号码',
			'sid' => '学校',
			'gid' => '年级',
			'state' => '状态',
			'creationtime' => '创建时间',
			'updatetime' => '更新时间',
			'deleted' => '已删除',
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

		$criteria->compare('psgrid',$this->psgrid);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('sid',$this->sid,true);
		$criteria->compare('gid',$this->gid);
		$criteria->compare('state',$this->state);
		$criteria->compare('creationtime',$this->creationtime,true);
		$criteria->compare('updatetime',$this->updatetime,true);
		$criteria->compare('deleted',$this->deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function getByMobile($mobile)
	{
		$criteria=new CDbCriteria;
		$criteria->compare('phone',$mobile);
		$criteria->compare('deleted',0);
		$ar=self::model()->find($criteria);
		return $ar;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PhoneSchoolGradeRelation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
