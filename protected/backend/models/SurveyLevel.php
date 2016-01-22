<?php

/**
 * This is the model class for table "{{survey_level}}".
 *
 * The followings are the available columns in table '{{survey_level}}':
 * @property integer $slid
 * @property integer $sid
 * @property integer $minscore
 * @property integer $maxscore
 * @property string $title
 * @property string $desc
 * @property string $creator
 * @property string $editor
 * @property integer $state
 * @property string $updatetime
 * @property string $creationtime
 * @property integer $deleted
 */
class SurveyLevel extends MasterActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{survey_level}}';
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
			array('sid, minscore, maxscore, state, deleted', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>25),
			array('desc', 'length', 'max'=>255),
			array('creator, editor', 'length', 'max'=>20),
			array('updatetime, creationtime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('slid, sid, minscore, maxscore, title, desc, creator, editor, state, updatetime, creationtime, deleted', 'safe', 'on'=>'search'),
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
			'slid' => 'Slid',
			'sid' => 'Sid',
			'minscore' => 'Minscore',
			'maxscore' => 'Maxscore',
			'title' => 'Title',
			'desc' => 'Desc',
			'creator' => 'Creator',
			'editor' => 'Editor',
			'state' => 'State',
			'updatetime' => 'Updatetime',
			'creationtime' => 'Creationtime',
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

		$criteria->compare('slid',$this->slid);
		$criteria->compare('sid',$this->sid);
		$criteria->compare('minscore',$this->minscore);
		$criteria->compare('maxscore',$this->maxscore);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('creator',$this->creator,true);
		$criteria->compare('editor',$this->editor,true);
		$criteria->compare('state',$this->state);
		$criteria->compare('updatetime',$this->updatetime,true);
		$criteria->compare('creationtime',$this->creationtime,true);
		$criteria->compare('deleted',$this->deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SurveyLevel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
