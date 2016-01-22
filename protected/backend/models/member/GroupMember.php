<?php

/**
 * This is the model class for table "{{group_member}}".
 *
 * The followings are the available columns in table '{{group_member}}':
 * @property integer $id
 * @property string $member
 * @property integer $gid
 * @property integer $state
 * @property string $creationtime
 * @property string $updatetime
 * @property integer $deleted
 *
 * The followings are the available model relations:
 * @property Group $g
 * @property User $member0
 */
class GroupMember extends MemberActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{group_member}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('member, gid', 'required'),
            array('gid, state, deleted', 'numerical', 'integerOnly' => true),
            array('member', 'length', 'max' => 20),
            array('updatetime,creationtime', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, member, gid, state, creationtime, updatetime, deleted', 'safe', 'on' => 'search'),
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
            'g' => array(self::BELONGS_TO, 'Group', 'gid'),
            'member0' => array(self::BELONGS_TO, 'Member', 'member'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => '关系ID',
            'member' => '组成员',
            'gid' => '群组',
            'state' => '状态：暂未使用',
            'creationtime' => '创建时间',
            'updatetime' => '更新时间',
            'deleted' => '是否已删除',
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

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('member', $this->member, true);
        $criteria->compare('gid', $this->gid);
        $criteria->compare('state', $this->state);
        $criteria->compare('creationtime', $this->creationtime, true);
        $criteria->compare('updatetime', $this->updatetime, true);
        $criteria->compare('deleted', $this->deleted);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /*
     * 获取组的成员数
     */
    public static function getGroupMemberNum($gid)
    {
        $criteria = new CDbCriteria;
        $criteria->with=array("member0");
        $criteria->compare("t.gid", $gid);
        $criteria->compare("t.deleted", 0);
        $criteria->compare("member0.deleted", 0);
        return self::model()->count($criteria);

    }

    /*
    * 获取组的成员数
    */
    public static function getGroupMemberNumBySql($gid)
    {
        if(empty($gid)){
            return 0;
        }else{
            $sql="";
            if(is_array($gid)){
                 $sql=" select count(DISTINCT g.member) as num from tb_group_member g inner join tb_user u on g.member=u.userid where u.deleted=0 and g.deleted=0 and g.gid in(".implode(",",$gid).")";
            }else if(is_string($gid)){
                $sql=" select count(DISTINCT g.member) as num from tb_group_member g inner join tb_user u on g.member=u.userid where u.deleted=0 and g.deleted=0 and g.gid in(".$gid.")";
            }
            if(!empty($sql)){
                $result = UCQuery::queryColumn($sql);
                if(is_array($result)){
                    return $result[0];
                }else{
                    return 0;
                }
            }else{
                return 0;
            }
        }

    }

    /*
     * 获取组的成员装上app的数量(老师部分)
     */
    public static function getGroupMemberInstallNum($gids)
    {
        $sql=" select count(DISTINCT u.userid) as num from tb_group_member t inner join tb_user u on t.member=u.userid
                inner join tb_user_online o on u.userid=o.userid
                  where t.deleted=0 and t.gid in($gids) and u.deleted=0 and LENGTH(u.mobilephone)>0  ";
        $result = UCQuery::queryColumn($sql);
        if(is_array($result)){
            return $result[0];
        }else{
            return 0;
        }
    }

    /*
    * 获取组的成员名单
    */
    public static function getGroupMembers($gid)
    {
        $criteria = new CDbCriteria;
        $criteria->with=array("member0");
        $criteria->compare("t.gid", $gid);
        $criteria->compare("t.deleted", 0);
        $criteria->compare("member0.deleted", 0);
        $criteria->order="member0.pingyin";
        return self::model()->findAll($criteria);

    }
//获取组成员ID
    public static function getGroupMembersUserids($gid)
    {
        $result = self::getGroupMembers($gid);
        $userids = array();
        if(is_array($result))
        foreach($result as $key=>$val){
            $userids[] = $val['member'];
        }
        return $userids;

    }

    /*
* 删除组的某个成员
*/
    public static function deleteGroupMember($gid,$uid)
    {
        $criteria = new CDbCriteria;
        $criteria->compare("gid", $gid);
        $criteria->compare("member", $uid);
        return self::model()->updateAll(array('deleted'=>1),$criteria);

    }

    /*
   * 获取组的成员名单,返回成员id数组
   */
    public static function getGroupMembersArr($gid)
    {
        $data = self::getGroupMembers($gid);
        $arr = array();
        foreach ($data as $val) {
            $arr[]=$val->member;
        }
        return $arr;
    }
    /*
    * 获取组的成员名单,返回成员数组，包括名字
    */
    public static function getGroupMembersArrName($gid)
    {
        $data = self::getGroupMembers($gid);
        $arr = array();
        foreach ($data as $val) {
            $arr[]=array('userid'=>$val->member,'name'=>$val->member0?$val->member0->name:'');
        }
        return $arr;
    }

    /*
     * 删除组时，删除组成员
     */
    public static function deleteGroup($gid)
    {
        $criteria = new CDbCriteria;
        $criteria->compare("gid", $gid);
        return self::model()->updateAll(array('deleted' => 1), $criteria);

    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return GroupMember the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
