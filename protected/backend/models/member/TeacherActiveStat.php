<?php

/**
 * This is the model class for table "{{teacher_active_stat}}".
 *
 * The followings are the available columns in table '{{teacher_active_stat}}':
 * @property string $teacherid
 * @property integer $activeusers
 * @property integer $isexchange
 * @property integer $deleted
 * @property string $creationtime
 * @property string $updatetime
 */
class TeacherActiveStat extends MemberActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{teacher_active_stat}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('teacherid', 'required'),
			array('activeusers, isexchange, deleted', 'numerical', 'integerOnly'=>true),
			array('teacherid', 'length', 'max'=>20),
			array('creationtime, updatetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('teacherid, activeusers, isexchange, deleted, creationtime, updatetime', 'safe', 'on'=>'search'),
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
			'teacherid' => '用户id',
			'activeusers' => '激活用户数',
			'isexchange' => '是否兑换礼包',
			'deleted' => '已删除：0未删除；1已删除',
			'creationtime' => '创建时间',
			'updatetime' => '修改时间',
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

		$criteria->compare('teacherid',$this->teacherid,true);
		$criteria->compare('activeusers',$this->activeusers);
		$criteria->compare('isexchange',$this->isexchange);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('creationtime',$this->creationtime,true);
		$criteria->compare('updatetime',$this->updatetime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * 查找老师激活人数
	 * @param int $tid
	 * @return Activity
	 */
	public static function getActivityStat($tid)
	{
	    $criteria=new CDbCriteria;
	    
	    $criteria->compare('teacherid', $tid);
	    $criteria->compare('deleted', 0);
	    
	    return self::model()->find($criteria);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TeacherActiveStat the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
