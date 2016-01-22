<?php

/**
 * This is the model class for table "{{examination_score}}".
 *
 * The followings are the available columns in table '{{examination_score}}':
 * @property integer $id
 * @property integer $examid
 * @property string $student
 * @property string $examscore
 * @property string $creator
 * @property string $creationtime
 * @property string $lastupdateuser
 * @property string $updatetime
 */
class ExaminationScore extends XiaoXinActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{examination_score}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('examid, student, creator, lastupdateuser', 'required'),
			array('examid', 'numerical', 'integerOnly'=>true),
			array('student, creator, lastupdateuser', 'length', 'max'=>20),
			array('examscore', 'length', 'max'=>50),
			array('creationtime, updatetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, examid, student, examscore, creator, creationtime, lastupdateuser, updatetime', 'safe', 'on'=>'search'),
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
			'examid' => 'Examid',
			'student' => 'Student',
			'examscore' => 'Examscore',
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
		$criteria->compare('examid',$this->examid);
		$criteria->compare('student',$this->student,true);
		$criteria->compare('examscore',$this->examscore,true);
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
	 * @return ExaminationScore the static model class
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
     * 获取某次考试所有成绩数据
     */
    public function findAllScoreByExamid($examid){
        $criteria=new CDbCriteria();
        $criteria->compare("examid",$examid);
        return self::model()->findAll($criteria);
    }

    /*
    * 获取某次考试某个学生的成绩数据
    */
    public function findStudentScoreByExamidUserid($examid,$student){
        $criteria=new CDbCriteria();
        $criteria->compare("examid",$examid);
        $criteria->compare("student",$student);
        return self::model()->find($criteria);
    }
}
