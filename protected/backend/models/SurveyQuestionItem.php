<?php

/**
 * This is the model class for table "{{survey_question_item}}".
 *
 * The followings are the available columns in table '{{survey_question_item}}':
 * @property integer $sqiid
 * @property integer $sid
 * @property integer $sqid
 * @property integer $score
 * @property string $content
 * @property integer $order
 * @property string $creator
 * @property string $editor
 * @property integer $state
 * @property string $updatetime
 * @property string $creationtime
 * @property integer $deleted
 */
class SurveyQuestionItem extends MasterActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{survey_question_item}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sid, sqid', 'required'),
			array('sid, sqid, score, order, state, deleted', 'numerical', 'integerOnly'=>true),
			array('content', 'length', 'max'=>255),
			array('creator, editor', 'length', 'max'=>20),
			array('updatetime, creationtime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('sqiid, sid, sqid, score, content, order, creator, editor, state, updatetime, creationtime, deleted', 'safe', 'on'=>'search'),
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
			'question' => array(self::BELONGS_TO, 'SurveyQuestion', 'sqid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sqiid' => 'Sqiid',
			'sid' => 'Sid',
			'sqid' => 'Sqid',
			'score' => 'Score',
			'content' => 'Content',
			'order' => 'Order',
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

		$criteria->compare('sqiid',$this->sqiid);
		$criteria->compare('sid',$this->sid);
		$criteria->compare('sqid',$this->sqid);
		$criteria->compare('score',$this->score);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('order',$this->order);
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
	 * @return SurveyQuestionItem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getQuestionItems($params){
        $criteria=new CDbCriteria;
        if(isset($params['sqid'])&&$params['sqid']){
            $criteria->compare('sqid',$params['sqid']);
        }
        if(isset($params['sid'])&&$params['sid']){
            $criteria->compare('sid',$params['sid']);
        }
        $criteria->compare('deleted',0);
        $criteria->order=' sqid asc,`order` asc';
        return self::model()->findAll($criteria);

    }

    /*
     * 根据答案计算分数
     */
    public static function getScore($answer,$items,$id,$uid,$inner=false){
        $score=0;
        $arr=explode("-",trim($answer));

        if(is_array($arr)){
            foreach($arr as $questionanswer){
                $temp=explode(":",$questionanswer);
                if(count($temp)==2){
                    $sqid=$temp[0];//题id;
                    $result=$temp[1];//用户选择的

                    $questionItem=isset($items[$sqid])?$items[$sqid]:array();
                    $tempscore=0;
                    foreach($questionItem as $v){
                        if($v->sqiid==$result&&$v->score){
                            $tempscore+=$v->score;
                        }
                    }
                    //error_log('inner:'.$inner);
                    if($inner){
                      //  error_log('uid:'.$uid);
                        $surveyQuestionAnswer=new SurveyQuestionAnswer;
                        $surveyQuestionAnswer->sid=$id;
                        $surveyQuestionAnswer->sqid=$sqid;
                        $surveyQuestionAnswer->userid=$uid;
                        $surveyQuestionAnswer->sqiid=$result;
                        $surveyQuestionAnswer->score=$tempscore;
                        $surveyQuestionAnswer->save();
                    }
                    //D($surveyQuestionAnswer->save());
                    $score+=$tempscore;
                }
            }
        }
        return $score;
    }

    /*
     * 答案提交与返回结果
     */
    public static function setScore($answer,$id,$uid,$inner=false){
        $score=0;
        $arr = json_decode($answer,true);
        if(is_array($arr)){
        	$surveyQuestionItems=SurveyQuestionItem::model()->findAllByAttributes(array('sid'=>$id,'deleted'=>0));
            $itemArr=array();
            foreach($surveyQuestionItems as $item){
            	$itemArr[$item->sqid][$item->sqiid] = $item;
            }

            $transaction = Yii::app()->db->beginTransaction();
            try {
                $insertArr=array();
	            foreach($arr as $sqid=>$sqiids){
                    $itemscore=0;
	            	$multipleAnswers = array();

                    $surveyQuestion=SurveyQuestion::model()->findByPk($sqid);
	            	$sqiidArr = explode(",",trim($sqiids));
	                if(count($sqiidArr)>0){
                        if(count($sqiidArr)==1){
                            $item = isset($itemArr[$sqid][$sqiids])?$itemArr[$sqid][$sqiids]:null;
                            $itemscore = $item?$item->score:0;
                            if($inner&&$item){
                                $surveyQuestionAnswer=new SurveyQuestionAnswer;
                                $surveyQuestionAnswer->sid=$id;
                                $surveyQuestionAnswer->sqid=$sqid;
                                $surveyQuestionAnswer->userid=$uid;
                                $surveyQuestionAnswer->sqiid=$sqiids;
                                $surveyQuestionAnswer->score=$itemscore;
                                $insertArr[]=$surveyQuestionAnswer;
                            }
                            //error_log("sqid:$sqid:".":score:".$itemscore);
                        }else if(count($sqiidArr)>1){ //多选　 or开放多选
                            $itemscore=0;
                            if($surveyQuestion->type==3){ //开放多选,选中任一项，有分则有分
                                foreach($sqiidArr as $sqiid){
                                     $tempScore=$itemArr[$sqid][$sqiid]->score;
                                     $itemscore+=$tempScore;
                                      if($inner){
                                          $surveyQuestionAnswer=new SurveyQuestionAnswer;
                                          $surveyQuestionAnswer->sid=$id;
                                          $surveyQuestionAnswer->sqid=$sqid;
                                          $surveyQuestionAnswer->userid=$uid;
                                          $surveyQuestionAnswer->sqiid=$sqiid;
                                          $surveyQuestionAnswer->score=$tempScore;
                                          $insertArr[]=$surveyQuestionAnswer;
                                      }
                                }
                               // error_log("sqid:$sqid:".":score:".$itemscore);
                            }else if($surveyQuestion->type==1){ //多选题，如果正确是AD,只选A或Ｄ,则５分，其它多选时，只有选择AD才才得10,AC,AB,CD,ABCD,ABC均不得分
                                $items=SurveyQuestionItem::getQuestionItems(array('sqid'=>$sqid));
                                $scoreArr=array();
                                foreach($items as $val){
                                    if($val->score){
                                        $scoreArr[]=$val->sqiid;
                                    }
                                }
                                $diff=array_diff($sqiidArr,$scoreArr);
                                if(empty($diff)){ //选中的与有分的完全相等，则对了
                                    foreach($sqiidArr as $sqiid){
                                        $tempScore=$itemArr[$sqid][$sqiid]->score;
                                        if($inner){
                                            $surveyQuestionAnswer=new SurveyQuestionAnswer;
                                            $surveyQuestionAnswer->sid=$id;
                                            $surveyQuestionAnswer->sqid=$sqid;
                                            $surveyQuestionAnswer->userid=$uid;
                                            $surveyQuestionAnswer->sqiid=$sqiid;
                                            $surveyQuestionAnswer->score=$tempScore;
                                            $insertArr[]=$surveyQuestionAnswer;
                                        }
                                        $itemscore+=$tempScore;
                                    }
                                   // error_log("sqid:$sqid:".":score:".$itemscore);
                                }else{
                                    foreach($sqiidArr as $sqiid){
                                       // $tempScore=$itemArr[$sqid][$sqiid]->score;
                                        if($inner){
                                            $surveyQuestionAnswer=new SurveyQuestionAnswer;
                                            $surveyQuestionAnswer->sid=$id;
                                            $surveyQuestionAnswer->sqid=$sqid;
                                            $surveyQuestionAnswer->userid=$uid;
                                            $surveyQuestionAnswer->sqiid=$sqiid;
                                            $surveyQuestionAnswer->score=0;
                                            $insertArr[]=$surveyQuestionAnswer;
                                        }

                                        $itemscore+=0;
                                       // error_log("sqid:$sqid:".":score:".$itemscore);
                                    }
                                }

                            }
                        }


	                }
                    $score+=$itemscore;
	            }
                if($inner){
                    foreach($insertArr as $answeritem){
                        $answeritem->save();
                    }
                }
                $transaction->commit();
	        }catch(Exception $e){
			    $transaction->rollback();
			    return 0;
			}
        }
        return $score;
    }
}
