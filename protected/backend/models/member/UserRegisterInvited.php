<?php

/**
 * This is the model class for table "{{user_register_invited}}".
 *
 * The followings are the available columns in table '{{user_register_invited}}':
 * @property integer $id
 * @property string $sender
 * @property string $mobilephone
 * @property string $recevier
 * @property integer $state
 * @property string $creationtime
 * @property string $updatetime
 * @property integer $deleted
 */
class UserRegisterInvited extends MemberActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user_register_invited}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('state, deleted', 'numerical', 'integerOnly'=>true),
			array('sender, mobilephone, recevier', 'length', 'max'=>20),
			array('creationtime, updatetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sender, mobilephone, recevier, state, creationtime, updatetime, deleted', 'safe', 'on'=>'search'),
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
		    'r' => array(self::BELONGS_TO, 'Member', 'recevier'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'sender' => '邀请人用户ID',
			'mobilephone' => '邀请人手机号码',
			'recevier' => '应邀注册人用户ID',
			'state' => '状态：0 默认 ，1 礼包被领取',
			'creationtime' => '创建时间',
			'updatetime' => '更新时间',
			'deleted' => '是否已删除',
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
		$criteria->compare('sender',$this->sender,true);
		$criteria->compare('mobilephone',$this->mobilephone,true);
		$criteria->compare('recevier',$this->recevier,true);
		$criteria->compare('state',$this->state);
		$criteria->compare('creationtime',$this->creationtime,true);
		$criteria->compare('updatetime',$this->updatetime,true);
		$criteria->compare('deleted',$this->deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserRegisterInvited the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * 获取登录用户所发出邀请且已注册用户
	 * @param Integer $uid 用户id
	 * @param integer $state 是否领取
	 */
	public static function getInviteList($uid, $state=0)
	{
	    $criteria = new CDbCriteria;
	    $criteria->compare('sender', $uid);
	    $criteria->addCondition("recevier != 0");
	    $criteria->compare('deleted', 0);
	    if($state < 2){
	        $criteria->compare('state', $state);
	    }
	
	    return self::model()->findAll($criteria);
	}
	

	/**
	 * 设置礼包被兑换
	 * @param Integer $uid 用户id
	 */
	public static function setIsExchange($uid, $inviteid)
	{
	    $criteria = new CDbCriteria;
	    $criteria->compare('sender', $uid);
	    $criteria->compare('id', $inviteid);
	    $criteria->addCondition("recevier != 0");
	    $criteria->compare('deleted', 0);
	    $criteria->compare('state', 0);
	
	    $inviteList = self::model()->findAll($criteria);
	
	    $flag = false;
	    if(count($inviteList)){
	        foreach ($inviteList as $invite){
	            $userInfo = Member::model()->findByPk($invite->recevier);
	            $bean = $userInfo->bean;
	
	            $exchangeInvite = TeacherActiveStat::model()->findByAttributes(array('teacherid'=>$invite->recevier, 'deleted'=>0));
	
	            //如果被邀请人已注册且已领取建班礼包应该把此礼包减去的青豆加上
	            if($exchangeInvite && $exchangeInvite->isexchange > 0){
	                $bean += Constant::GIFT_ACTIVITY_BEANS;
	            }
	
	            if($bean >= Constant::GIFT_ACTIVITY_BEANS && $exchangeInvite && $exchangeInvite->activeusers >= Constant::GIFT_ACTIVITY_ACTIVEUSERS){
	                $invite->state = 1; //设置已领取
	                if($invite->save())
	                    $flag = true;
	                break;
	            }
	        }
	    }
	
	    return $flag;
	
	}

	/**
	 * 邀请我的人
	 * @param  interger $receiver 被邀请的用户ID
	 * @return UserInvite record
	 */
	public static function getInviteUser($receiver)
	{
	    $criteria = new CDbCriteria;
	    $criteria->compare('recevier', $receiver);
	    $criteria->compare('deleted', 0);
	    // $criteria->addCondition('sender is not null');
	    return self::model()->find($criteria);
	}
	

	/**
	 * 我邀请的人
	 * @param Integer $uid 发送邀请的用户id
	 */
	public static function getInviteListAll($uid)
	{
	    $criteria = new CDbCriteria;
	    $criteria->compare('sender', $uid);
	    $criteria->compare('deleted', 0);
	    return self::model()->findAll($criteria);
	}

	/**
	 * 查找邀请人用户id为空的记录
	 * @return [type] [description]
	 */
	public static function getNullSender()
	{
		$criteria = new CDbCriteria;
        $criteria->compare('deleted', 0);
        $criteria->addCondition("sender IS NULL");
        return self::model()->findAll($criteria);
	}
}
