<?php

/**
 * This is the model class for table "{{examination}}".
 *
 * The followings are the available columns in table '{{examination}}':
 * @property integer $id
 * @property integer $cid
 * @property string $examsubject
 * @property integer $examtype
 * @property string $examname
 * @property string $examdate
 * @property string $creator
 * @property string $creationtime
 * @property string $lastupdateuser
 * @property string $updatetime
 */
class Examination extends XiaoXinActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{examination}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cid, examsubject, creator, lastupdateuser', 'required'),
			array('cid, examtype', 'numerical', 'integerOnly'=>true),
			array('examsubject, examname', 'length', 'max'=>50),
			array('creator, lastupdateuser', 'length', 'max'=>20),
			array('examdate, creationtime, updatetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cid, examsubject, examtype, examname, examdate, creator, creationtime, lastupdateuser, updatetime', 'safe', 'on'=>'search'),
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
			'cid' => 'Cid',
			'examsubject' => 'Examsubject',
			'examtype' => 'Examtype',
			'examname' => 'Examname',
			'examdate' => 'Examdate',
			'creator' => 'Creator',
			'creationtime' => 'Creationtime',
			'lastupdateuser' => 'Lastupdateuser',
			'updatetime' => 'Updatetime',
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
		$criteria->compare('cid',$this->cid);
		$criteria->compare('examsubject',$this->examsubject,true);
		$criteria->compare('examtype',$this->examtype);
		$criteria->compare('examname',$this->examname,true);
		$criteria->compare('examdate',$this->examdate,true);
		$criteria->compare('creator',$this->creator,true);
		$criteria->compare('creationtime',$this->creationtime,true);
		$criteria->compare('lastupdateuser',$this->lastupdateuser,true);
		$criteria->compare('updatetime',$this->updatetime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Examination the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function beforeSave(){
        $this->updatetime=date("Y-m-d H:i:s");
        $this->lastupdateuser=Yii::app()->user->id;
        return parent::beforeSave();
    }

    /*
     * 判断是不是同一考试　
     */
    public function findOne($params){
        $criteria=new CDbCriteria();
        if(isset($params['examname'])&&$params['examname']){
            $criteria->compare('examname',$params['examname']);
        }
        if(isset($params['cid'])&&$params['cid']){
            $criteria->compare('cid',$params['cid']);
        }
        if(isset($params['examtype'])&&$params['examtype']){
            $criteria->compare('examtype',$params['examtype']);
        }
        if(isset($params['examdate'])&&$params['examdate']){
            $criteria->compare('examdate',$params['examdate']);
        }
        if(isset($params['creator'])&&$params['creator']){
            $criteria->compare('creator',$params['creator']);
        }
        if(isset($params['examsubject'])&&$params['examsubject']){
            $criteria->compare('examsubject',$params['examsubject']);
        }
        return self::model()->find($criteria);
    }
}
