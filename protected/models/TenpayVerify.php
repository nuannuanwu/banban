<?php

/**
 * This is the model class for table "{{tenpay_verify}}".
 *
 * The followings are the available columns in table '{{tenpay_verify}}':
 * @property string $package
 * @property integer $teachercount
 * @property integer $studentcount
 * @property integer $noticecount
 * @property integer $balance
 * @property integer $allpayamt
 * @property string $applydate
 * @property string $verifydate
 * @property integer $verifystate
 */
class TenpayVerify extends XiaoXinActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{tenpay_verify}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('package', 'required'),
			array('teachercount, studentcount, noticecount, balance, allpayamt, verifystate', 'numerical', 'integerOnly'=>true),
			array('package', 'length', 'max'=>30),
			array('applydate, verifydate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('package, teachercount, studentcount, noticecount, balance, allpayamt, applydate, verifydate, verifystate', 'safe', 'on'=>'search'),
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
			'package' => 'Package',
			'teachercount' => 'Teachercount',
			'studentcount' => 'Studentcount',
			'noticecount' => 'Noticecount',
			'balance' => 'Balance',
			'allpayamt' => 'Allpayamt',
			'applydate' => 'Applydate',
			'verifydate' => 'Verifydate',
			'verifystate' => 'Verifystate',
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

		$criteria->compare('package',$this->package,true);
		$criteria->compare('teachercount',$this->teachercount);
		$criteria->compare('studentcount',$this->studentcount);
		$criteria->compare('noticecount',$this->noticecount);
		$criteria->compare('balance',$this->balance);
		$criteria->compare('allpayamt',$this->allpayamt);
		$criteria->compare('applydate',$this->applydate,true);
		$criteria->compare('verifydate',$this->verifydate,true);
		$criteria->compare('verifystate',$this->verifystate);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * 添加审核记录
	 * @param unknown $package 批次号
	 * @param unknown $classFeeBalance 当前班费余额       
	 */
	public static function addAuditRecord($package, $cid = [])
	{
	    $feeInfo = JceHelper::getClassFeeInfo($cid);
	    $balance = sprintf("%.2f", $feeInfo[0]['dBalance']);
	    
	    $audit = new TenpayVerify();
	    $audit->package = $package;
	    $audit->balance = (int)($balance * 100);
	    $audit->applydate = date('Y-m-d H:i:s', time());
	    $audit->save();	    	    
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TenpayVerify the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
