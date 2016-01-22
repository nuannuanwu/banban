<?php

/**
 * This is the model class for table "{{survey}}".
 *
 * The followings are the available columns in table '{{survey}}':
 * @property integer $sid
 * @property string $title
 * @property string $desc
 * @property string $creator
 * @property string $editor
 * @property integer $state
 * @property string $updatetime
 * @property string $creationtime
 * @property integer $deleted
 */
class Survey extends MasterActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{survey}}';
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
			array('title, desc', 'length', 'max'=>255),
			array('creator, editor', 'length', 'max'=>20),
			array('updatetime, creationtime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('sid, title, desc, creator, editor, state, updatetime, creationtime, deleted', 'safe', 'on'=>'search'),
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
			'sid' => 'Sid',
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

		$criteria->compare('sid',$this->sid);
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

	public static function getSurveyJson($sid=0)
	{
		$result = [];
		$survey = self::model()->findByPk($sid);
		if(!$survey){
			$result['sid'] = 0;
			return json_encode($result);
			exit;
		}
        $cache=Yii::app()->cache;
        $key="surveydata_".$sid;
        //$cache->delete($key);
        $data=$cache->get($key);
        if($data){ //如果缓存中存在，直接读缓存
            return $data;
        }
		$result['sid'] = $survey->sid;
		$result['title'] = $survey->title;
		$result['desc'] = $survey->desc;
		$questions = SurveyQuestion::getQuestions(array('sid'=>$sid));
		foreach($questions as $question){
			$res_que = [];
			$res_que['sid'] = $survey->sid;
			$res_que['sqid'] = $question->sqid;
			$res_que['content'] = $question->content;
			$res_que['order'] = $question->order;
			$res_que['type'] = $question->type;
			$items = SurveyQuestionItem::getQuestionItems(array('sqid'=>$question->sqid));
			foreach($items as $item){
				$res_item = [];
				$res_item['sid'] = $survey->sid;
				$res_item['sqid'] = $question->sqid;
				$res_item['sqiid'] = $item->sqiid;
				$res_item['score'] = $item->score;
				$res_item['content'] = $item->content;
				$res_item['order'] = $item->order;
				// if($question->type==2 || $question->type=3){
				// 	$res_item['isright'] = 1;
				// }else{
				// 	$res_item['isright'] = $item->score>0?1:0;
				// }
				$res_que['items'][] = $res_item;
			}
			$result['questions'][] = $res_que;
		}
		$result = JsonHelper::JSON($result);
        $cache->set($key,$result);
		return $result;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Survey the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
