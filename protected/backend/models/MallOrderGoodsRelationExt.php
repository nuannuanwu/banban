<?php

/**
 * This is the model class for table "{{mall_order_goods_relation_ext}}".
 *
 * The followings are the available columns in table '{{mall_order_goods_relation_ext}}':
 * @property integer $id
 * @property integer $mogrid
 * @property string $userid
 * @property string $mobile
 * @property string $creationtime
 * @property string $updatetime
 * @property integer $state
 * @property integer $deleted
 */
class MallOrderGoodsRelationExt extends MasterActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{mall_order_goods_relation_ext}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mogrid, userid', 'required'),
			array('mogrid, state, deleted', 'numerical', 'integerOnly'=>true),
			array('userid, mobile', 'length', 'max'=>20),
			array('creationtime, updatetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, mogrid, userid, mobile, creationtime, updatetime, state, deleted', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'mogrid' => '订单关系ID',
			'userid' => '用户ID',
			'mobile' => '关联手机',
			'creationtime' => '创建时间',
			'updatetime' => '更新时间',
			'state' => '是否兑换，0：未兑换，1：已兑换',
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
		$criteria->compare('mogrid',$this->mogrid);
		$criteria->compare('userid',$this->userid,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('creationtime',$this->creationtime,true);
		$criteria->compare('updatetime',$this->updatetime,true);
		$criteria->compare('state',$this->state);
		$criteria->compare('deleted',$this->deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	

	/***
	 * 2015-3-3 zengp
	 * 确定活动条件
	 */
	public static function confirmActivity()
	{
	    //$scount = ClassStudentRelation::countCreater(Yii::app()->user->id);
	    //$tcount = ClassTeacherRelation::countCreater(Yii::app()->user->id);
	    //$totalCount = $scount + $tcount;
	    $uid = Yii::app()->user->id;
	    $totalCount = 0;
	    $isExchange = 0;
	    
	    $exchange = TeacherActiveStat::model()->findByAttributes(array('teacherid'=>$uid, 'deleted'=>0));
	    if($exchange){
	        $totalCount = $exchange->activeusers;
	        $isExchange = $exchange->isexchange;
	    }
	    
 	    $activity = Activity::model()->findByAttributes(array('activityname'=>'建班大礼包', 'deleted'=>0));
// 	    $isExchange = MallOrdersGoodsRelation::getUserExchange(Yii::app()->user->id,$activity->conf[0]->mgid);
	     
	    $user = Yii::app()->user->getInstance();
	    $bean = JceHelper::getBeanInfo(Yii::app()->user->id);
	    $endate = $activity->enddate;
	    $currDate = date('Y-m-d', time());
	    //conlog($totalCount . '/' . $bean . '/' . $isnewuser . '/' . count($isExchange) . '/' . $currDate . '/' . $endate);
	    if($totalCount >= Constant::GIFT_ACTIVITY_ACTIVEUSERS && $bean >= Constant::GIFT_ACTIVITY_BEANS && $isExchange == 0 && $currDate <= $endate){
	        return true;
	    }
	     
	    return false;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MallOrderGoodsRelationExt the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
