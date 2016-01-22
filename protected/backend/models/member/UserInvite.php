<?php

/**
 * This is the model class for table "{{user_invite}}".
 *
 * The followings are the available columns in table '{{user_invite}}':
 * @property integer $id
 * @property string $sender
 * @property string $mobilephone
 * @property string $creationtime
 * @property string $updatetime
 * @property integer $deleted
 */
class UserInvite extends MemberActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user_invite}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sender, mobilephone', 'required'),
			array('deleted', 'numerical', 'integerOnly'=>true),
			array('sender', 'length', 'max'=>11),
			array('mobilephone', 'length', 'max'=>11),
			array('creationtime, updatetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sender, mobilephone, creationtime, updatetime, deleted', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'sender' => 'Sender',
			'mobilephone' => 'Mobilephone',
			'creationtime' => 'Creationtime',
			'updatetime' => 'Updatetime',
			'deleted' => 'Deleted',
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
	 * @return UserInvite the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function countTeacherSenderNum($params){
        $criteria = new CDbCriteria;
        if(isset($params['sender'])&&$params['sender']){
            $criteria->compare("sender",$params['sender']);
        }
        if(isset($params['creationtime'])&&$params['creationtime']){
            $criteria->compare("creationtime",$params['creationtime'],true);
        }
        $criteria->compare("deleted",0);
        return self::model()->count($criteria);
    }
    
    public static function getUserInvite($params){
        $criteria = new CDbCriteria;
        if(isset($params['sender'])&&$params['sender']){
            $criteria->compare("sender",$params['sender']);
        }
        if(isset($params['mobilephone'])&&$params['mobilephone']){
            $criteria->compare("mobilephone",$params['mobilephone']);
        }
        if(isset($params['receiver'])&&$params['receiver']){
           // $criteria->compare("receiver",'>0');
        }
        $criteria->compare("deleted",0);
        return self::model()->find($criteria);
    }
    

    /**
     * 我邀请的人列表
     * panrj 2014-06-12
     * @param array $parms 查询条件及分页参数
     * @return array $result
     */
    public static  function pageData($params = array())
    {
        $result = array();
        $criteria = new CDbCriteria();

        if (isset($parms['sender']) && $params['sender'] != '') {
            $criteria->compare('sender', $params['sender']);
        }
        $criteria->compare('deleted', 0);
        $criteria->order = 'id desc';
        $count = self::model()->count($criteria);
        $pager = new CPagination($count);
        if (isset($parms['size']) && $params['size']) {
            $pager->pageSize = $params['size'];
        } else {
            $pager->pageSize = 10;
        }
        $pager->applyLimit($criteria);
        $datalist = self::model()->findAll($criteria);
        $result['model'] = $datalist;
        $result['pages'] = $pager;
        return $result;
    }

    
}
