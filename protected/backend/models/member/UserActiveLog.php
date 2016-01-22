<?php

/**
 * This is the model class for table "{{user_active_log}}".
 *
 * The followings are the available columns in table '{{user_active_log}}':
 * @property string $id
 * @property string $userid
 * @property integer $identity
 * @property string $classid
 * @property integer $fromplat
 * @property string $createtime
 * @property integer $dealstatus
 * @property string $dealtime
 */
class UserActiveLog extends MemberActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user_active_log}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userid, identity, classid, fromplat, dealstatus', 'required'),
			array('identity, fromplat, dealstatus', 'numerical', 'integerOnly'=>true),
			array('userid, classid', 'length', 'max'=>20),
			array('createtime, dealtime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, userid, identity, classid, fromplat, createtime, dealstatus, dealtime', 'safe', 'on'=>'search'),
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
			'userid' => 'Userid',
			'identity' => 'Identity',
			'classid' => 'Classid',
			'fromplat' => 'Fromplat',
			'createtime' => 'Createtime',
			'dealstatus' => 'Dealstatus',
			'dealtime' => 'Dealtime',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('userid',$this->userid,true);
		$criteria->compare('identity',$this->identity);
		$criteria->compare('classid',$this->classid,true);
		$criteria->compare('fromplat',$this->fromplat);
		$criteria->compare('createtime',$this->createtime,true);
		$criteria->compare('dealstatus',$this->dealstatus);
		$criteria->compare('dealtime',$this->dealtime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function addLog($uid, $identity, $cid, $fromplat = 3){
	    
	    $isExists = UserActiveLog::model()->findByAttributes(array('userid'=>$uid, 'identity'=>$identity));
	    if(!count($isExists)){
    	    $ulog = new UserActiveLog;    	    
    	    $ulog->userid = $uid;
    	    $ulog->identity = $identity;
    	    $ulog->classid = $cid;
    	    $ulog->fromplat = $fromplat;
    	    $ulog->createtime = date('Y-m-d H:i:s',time());
    	    $ulog->dealstatus = 0; 	    
    	    return $ulog->save();
	    }else{
	        $isExists->classid = $cid;
	        return $isExists->save();
	    }
	    
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserActiveLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
