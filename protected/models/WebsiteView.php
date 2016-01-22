<?php

/**
 * This is the model class for table "{{website_view}}".
 *
 * The followings are the available columns in table '{{website_view}}':
 * @property string $userid
 * @property string $lasturl
 * @property string $lastip
 * @property string $lasttime
 */
class WebsiteView extends XiaoXinActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{website_view}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userid', 'required'),
			array('userid', 'length', 'max'=>20),
			array('lasturl', 'length', 'max'=>256),
			array('lastip', 'length', 'max'=>15),
			array('lasttime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('userid, lasturl, lastip, lasttime', 'safe', 'on'=>'search'),
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
			'userid' => '用户ID',
			'lasturl' => '上次访问URL',
			'lastip' => '上次访问IP',
			'lasttime' => '上次访问时间',
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

		$criteria->compare('userid',$this->userid,true);
		$criteria->compare('lasturl',$this->lasturl,true);
		$criteria->compare('lastip',$this->lastip,true);
		$criteria->compare('lasttime',$this->lasttime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function setUserSiteView($uid,$arr = array('url'=>'','ip'=>'','time'=>''))
	{
		$record = self::model()->findByPk($uid);
		if($record){
			$time = $record->lasttime;
			if(strtotime($time)<strtotime($arr['time'])){
				$record->lasttime = $arr['time'];
				if($record->save()){
					return true;
				}
			}else{
				return true;
			}
		}else{
			$record = new WebsiteView;
			$record->userid = $uid;
			$record->lasturl = $arr['url'];
			$record->lastip = $arr['ip'];
			$record->lasttime = $arr['time'];
			if($record->save()){
				return true;
			}
		}
		return false;
	}

	public static function getStudentActive($guardians,$month='')
	{
		if($month==''){
			$month = date('Y-m', strtotime('-1 month'));
		}
		$criteria = new CDbCriteria;
        $criteria->compare('userid', $guardians);
        $criteria->addCondition("DATE_FORMAT(lasttime,'%Y-%m')='".$month."'");
        $results=self::model()->findAll($criteria);
        return count($results);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return WebsiteView the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    /*
     * 获取一批uid的web访问数据
     */
    public static function getWebViewByUids($uid){
        $criteria=new CDbCriteria;
        $criteria->compare('userid',$uid);
        return self::model()->findAll($criteria);

    }
}
