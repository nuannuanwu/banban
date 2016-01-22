<?php

/**
 * This is the model class for table "{{activity}}".
 *
 * The followings are the available columns in table '{{activity}}':
 * @property integer $id
 * @property string $activityname
 * @property string $desc
 * @property integer $total
 * @property integer $current
 * @property integer $boxes
 * @property string $startdate
 * @property string $enddate
 * @property integer $deleted
 */
class Activity extends MasterActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{activity}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('total, current, boxes, deleted', 'numerical', 'integerOnly'=>true),
			array('activityname', 'length', 'max'=>20),
			array('desc', 'length', 'max'=>1000),
			array('startdate, enddate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, activityname, desc, total, current, boxes, startdate, enddate, deleted', 'safe', 'on'=>'search'),
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
		    'conf' => array(self::HAS_MANY, 'ActivityConfig', 'aid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID主键',
			'activityname' => '活动名称',
			'desc' => '活动描述',
			'total' => '总数',
			'current' => '当前数量',
			'boxes' => '箱子数',
			'startdate' => '起始日期',
			'enddate' => '截至日期',
			'deleted' => '是否删除',
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
		$criteria->compare('activityname',$this->activityname,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('total',$this->total);
		$criteria->compare('current',$this->current);
		$criteria->compare('boxes',$this->boxes);
		$criteria->compare('startdate',$this->startdate,true);
		$criteria->compare('enddate',$this->enddate,true);
		$criteria->compare('deleted',$this->deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	

	public static function getPrize()
	{
	    $criteria=new CDbCriteria;
	    $criteria->compare('visible',0);
	    $data = MallGoods::model()->findAll($criteria);
	    return $data;
	}
	
	/**
	 * panrj 2014-12-18
	 * @param $userid 用户ID
	 * 用户抽奖箱子总数
	 * @return int
	 */
	public static function getBoxNumber($userid)
	{
	    $got_prize = MallOrders::checkWinPrize($userid);
	    $activity = self::model()->find();
	    if($got_prize){
	        return $activity->total * 2;
	    }else{
	        return $activity->total;
	    }
	}
	
	/**
	 * 查询活动
	 * @param string $name
	 * @return Activity
	 */
	public static function getActivity($name)
	{
	    $criteria = new CDbCriteria;
	    
	    $criteria->compare('activityname', $name);
	    $criteria->compare('deleted', 0);
	    
	    return self::model()->find($criteria);
	}
	

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Activity the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
