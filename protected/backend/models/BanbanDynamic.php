<?php

/**
 * This is the model class for table "{{banban_dynamic}}".
 *
 * The followings are the available columns in table '{{banban_dynamic}}':
 * @property integer $id
 * @property string $title
 * @property integer $adtype
 * @property string $summery
 * @property string $addesc
 * @property string $image
 * @property string $url
 * @property string $uid
 * @property integer $state
 * @property string $creationtime
 * @property string $updatetime
 * @property integer $deleted
 */
class BanbanDynamic extends MasterActiveRecord
{
    public static $typearr=array('1'=>'产品动态','2'=>'活动推广','3'=>'行业资讯');
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{banban_dynamic}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, summery, image,addesc', 'required'),
			array('adtype, state, deleted', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>64),
			array('summery, image, url', 'length', 'max'=>255),
			array('uid', 'length', 'max'=>20),
			array('creationtime, updatetime,uid', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, adtype, summery, addesc, image, url, uid, state, creationtime, updatetime, deleted', 'safe', 'on'=>'search'),
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
			'title' => 'Title',
			'adtype' => 'Adtype',
			'summery' => 'Summery',
			'addesc' => 'Addesc',
			'image' => 'Image',
			'url' => 'Url',
			'uid' => 'Uid',
			'state' => 'State',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('adtype',$this->adtype);
		$criteria->compare('summery',$this->summery,true);
		$criteria->compare('addesc',$this->addesc,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('uid',$this->uid,true);
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
	 * @return BanbanDynamic the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * 班斑动态分页数据
     * panrj 2014-05-20
     * @param array $parms 查询条件及分页参数
     * @return array $result
     */
    public function pageData($parms=array())
    {
        $result = array();
        $criteria = new CDbCriteria();
        $criteria->select = '`id`,`title`,addesc,`summery`,`adtype`,`image`,`url`,`uid`,`state`,`creationtime`,`updatetime`,`deleted`';
        if(isset($parms['title']) && $parms['title']!=''){
            $criteria->compare('title',$parms['title'],true);
        }
        if(isset($parms['uid']) && $parms['uid']!==''){
            $criteria->compare('uid',$parms['uid']);
        }
        if(isset($parms['adtype']) && $parms['adtype']){
            $criteria->compare('adtype',$parms['adtype']);
        }
        $criteria->compare('deleted',0);
        $criteria->order = 'creationtime DESC';
        $count = self::model()->count($criteria);
        $pager = new CPagination($count);
        if(isset($parms['size']) && $parms['size']){
            $pager->pageSize = $parms['size'];
        }else{
            $pager->pageSize = 15;
        }
        $pager->applyLimit($criteria);
        $datalist = self::model()->findAll($criteria);
        $result['model'] = $datalist;
        $result['pages'] = $pager;
        return $result;
    }
}
