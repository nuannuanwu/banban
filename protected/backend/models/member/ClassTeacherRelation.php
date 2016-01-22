<?php

/**
 * This is the model class for table "{{class_teacher_relation}}".
 *
 * The followings are the available columns in table '{{class_teacher_relation}}':
 * @property integer $id
 * @property integer $cid
 * @property string $teacher
 * @property integer $sid
 * @property string $subject
 * @property integer $state
 * @property string $creationtime
 * @property string $updatetime
 * @property integer $deleted
 * @property string $creater
 *
 * The followings are the available model relations:
 * @property Class $c
 * @property User $teacher0
 * @property Subject $s
 */
class ClassTeacherRelation extends MemberActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{class_teacher_relation}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('cid', 'required'),
            array('cid, sid, state, deleted', 'numerical', 'integerOnly' => true),
            array('teacher, creater', 'length', 'max' => 20),
            array('subject', 'length', 'max' => 100),
            array('teacher,updatetime, subject, creationtime', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, cid, teacher, sid, subject, state, creationtime, updatetime, deleted, creater', 'safe', 'on' => 'search'),
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
            'c' => array(self::BELONGS_TO, 'MClass', 'cid'),
            'teacher0' => array(self::BELONGS_TO, 'Member', 'teacher'),
            's' => array(self::BELONGS_TO, 'Subject', 'sid'),
            'role' => array(self::BELONGS_TO, 'Duty', 'duty'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => '关系ID',
            'cid' => '班级',
            'teacher' => '教师用户',
            'sid' => '科目ID',
            'subject' => '科目',
            'state' => '状态：0待审核；1审核通过；2拒绝；3放弃',
            'creationtime' => '创建时间',
            'updatetime' => '更新时间',
            'deleted' => '是否已删除',
            'creater' => '创建者',
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
        $criteria->compare('cid', $this->cid);
        $criteria->compare('teacher', $this->teacher, true);
        $criteria->compare('sid', $this->sid);
        $criteria->compare('subject', $this->subject, true);
        $criteria->compare('state', $this->state);
        $criteria->compare('creationtime', $this->creationtime, true);
        $criteria->compare('updatetime', $this->updatetime, true);
        $criteria->compare('deleted', $this->deleted);
        $criteria->compare('creater', $this->creater, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function getOrCreateRelation($uid, $cid, $subject = '')
    {
        $criteria = new CDbCriteria;
        $criteria->compare('teacher', $uid);
        $criteria->compare('cid', $cid);
        $criteria->compare('deleted', 0);
        $data = self::model()->find($criteria);
        if ($data) {
            $data->subject = $subject ? $subject : $data->subject;
            $data->state = 1;
            $data->save();
        } else {
            $data = new ClassTeacherRelation;
            $data->teacher = $uid;
            $data->cid = $cid;
            $data->subject = $subject;
            $data->state = $subject;
            $data->state = 1;
            $data->save();
        }
        return $data;
    }
   /*
    * 修改 or设置班主任
    */
    public static function updateOrCreateMaster($uid, $cid)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('cid', $cid);
        $criteria->compare('type', 1);
        $criteria->compare('deleted', 0);
        $data = self::model()->find($criteria);
        if ($data) {
            if ($uid) {
                $data->teacher = $uid;
            } else {
                $data->deleted = 1;
            }
            $data->save();
        } else {
            if($uid){
                $data = new ClassTeacherRelation;
                $data->teacher = $uid;
                $data->cid = $cid;
                $data->subject = '';
                $data->type = 1;
                $data->state = 1;
                $data->save();
            }
        }
        return $data;
    }

    /**
     * 扩展beforeSave方法
     * panrj 2014-09-19
     */
    public function beforeSave()
    {
        if ($this->isNewRecord) {
            $this->subject = $this->subject ? $this->subject : '';
            $platform=Yii::app()->params['platform'];
            if($platform=='fronted'){
                $this->creater=Yii::app()->user->id;
            }
        }
        return parent::beforeSave();
    }

    /**
     * 扩展afterSave方法,用来同步老师数量
     * panrj 2014-09-19
     */
    public function afterSave()
    {
        $cid = $this->cid;
        $class = MClass::model()->findByPk($cid);
        $criteria = new CDbCriteria;
        $criteria->with=array("teacher0");
        $criteria->compare('t.cid', $cid);
        $criteria->compare('t.deleted', 0);
        $criteria->compare('t.state', 1);
        $criteria->compare('teacher0.deleted', 0);
        $criteria->group = "cid,teacher";
        $teachers = self::model()->count($criteria);

        if ($teachers != $class->teachers) {
            $class->updateByPk($cid,array("teachers"=>$teachers));
           // $class->teachers = $teachers;
           // $class->save();
        }

        return parent::afterSave();
    }
    /*
     * 删除学校时sql处理
     */
    public static function deleteBySchoolPk($sid)
    {
//        $criteria=new CDbCriteria;
//        $criteria->with = array('c');
//        $criteria->compare('c.sid',$sid);
//        self::model()->updateAll(array('t.deleted'=>1),$criteria);
        $sql = "update tb_class_teacher_relation tt inner join tb_class tc on tt.cid=tc.cid set tt.deleted=1  where   tc.sid=$sid";
        UCQuery::execute($sql);
    }
    /*
     * 获取某科，某个班级，某个老师的关联数据
     */
    public static function getTeacherSubject($cid, $uid, $sid = '')
    {
        $criteria = new CDbCriteria;
        $criteria->compare('teacher', $uid);
        $criteria->compare('cid', $cid);
        if ($sid) {
            $criteria->compare('sid', $sid);
        }
        $criteria->compare('deleted', 0);
        $criteria->compare('state', 1);
        if ($sid) {
            $data = self::model()->find($criteria);
        } else {
            $data = self::model()->findAll($criteria);
        }

        return $data;
    }
    /*
     * 获取班级的某科的任课数据
     */
    public static function getTeacherSubjectByCidSid($cid, $sid)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('cid', $cid);
        $criteria->compare('sid', $sid);

        $criteria->compare('deleted', 0);
        $criteria->compare('state', 1);
        $data = self::model()->find($criteria);
        return $data;
    }

    /*
     * 获取班级所有老师
     */
    public static function getClassTeacher($cid)
    {
        $criteria = new CDbCriteria;
        $criteria->with = array('teacher0');
        $criteria->compare('t.cid', $cid);
        $criteria->compare('t.deleted', 0);
        $criteria->compare('teacher0.deleted', 0);
        $criteria->compare('t.state', 1);
        $criteria->order="teacher0.pingyin";
        return self::model()->findAll($criteria);
    }

    public static function getTeacherSchoolSubject($uid, $sid)
    {
        $relations = self::getTeacherClassRelation($uid, $sid);
        $subjects = array();
        foreach ($relations as $r) {
            if (isset($r->s)) {
                $subjects[$r->sid] = $r->s->name;
            }
        }
        return $subjects;
    }

    /**
     * 根据职务返回老师管理的学校班级
     * panrj 2014-11-13
     * @param int $uid 老师Id
     * @param int $sid 学校Id
     * @return array $result
     */
    public static function getTeacherDutyClassPkByUidSid($sid,$uid)
    {
        $ctrelation = self::getTeacherClassRelation($uid,$sid);
        $arr = array();
        foreach($ctrelation as $r){
            $arr[] = $r->cid;
        }
        if(empty($arr)){
            $arr = '';
        }
        return $arr;

    }

    /**
     * 根据职务返回老师管理的学校班级
     * panrj 2014-11-12
     * @param int $uid 老师Id
     * @param int $sid 学校Id
     * @return array $result
     */
    public static function getDutyClassByTeacher($sid,$uid,$returnArr=false)
    {
        // $strelation = SchoolTeacherRelation::getTeacherSchoolDuty($uid,$sid);

        $arr = array();
        // if($strelation){
            // $duty = $strelation->role;
            // if($duty->isseeallclass==0){//任课班级
                $cid = self::getTeacherDutyClassPkByUidSid($sid,$uid);
                $criteria = new CDbCriteria;
                $criteria->with = array('s');
                if(!empty($cid)){
                    $criteria->compare('t.cid', $cid);
                    $criteria->compare('s.sid', $sid);
                    $criteria->compare('t.deleted', 0);
                    $criteria->compare('t.state', 1);
                    $criteria->order = 't.seqno,t.pingyin';
                    $arr = MClass::model()->findAll($criteria);
                }
            // }
            // if($duty->isseeallclass==1){//全年级班级
            //     $cid = self::getTeacherDutyClassPkByUidSid($sid,$uid);
            //     $year = $strelation->year;
            //     $stid = $strelation->stid;
            //     $criteria = new CDbCriteria;
            //     $criteria->compare('year', $year);
            //     $criteria->compare('stid', $stid);
            //     $criteria->compare('sid', $sid);
            //     if(!empty($cid)){
            //         $criteria->addCondition('cid in ('.implode(",",$cid).')','OR');
            //     }
            //     $criteria->compare('deleted', 0);
            //     $criteria->compare('state', 1);
            //     $criteria->order = 'seqno,pingyin';
            //     $classes = MClass::model()->findAll($criteria);
            //     foreach($classes as $class){
            //         $arr[] = $class;
            //     }

            // }
            // if($duty->isseeallclass==2){//全校班级
            //     $criteria = new CDbCriteria;
            //     $criteria->compare('sid', $sid);
            //     $criteria->compare('deleted', 0);
            //     $criteria->compare('state', 1);
            //     $criteria->order = 'seqno,pingyin';
            //     $classes = MClass::model()->findAll($criteria);
            //     foreach($classes as $class){
            //         $arr[] = $class;
            //     }
            // }
        // }
        if($returnArr){
            $list = array();
            foreach($arr as $c){
                $list[] = $c->getAttributes();
            }
            $arr = $list;
        }
        return $arr;
    }

    /*
    *获取老师所属班级
    */
    public static function getTeacherClassRelation($uid, $sid,$orderby='seqno')
    {
        $criteria = new CDbCriteria;
        $criteria->with = array('c');
        $criteria->compare('t.teacher', $uid);
        $criteria->compare('c.sid', $sid);
        $criteria->compare('t.deleted', 0);
        $criteria->compare('c.deleted', 0);
        $criteria->compare('t.state', 1);
        if($orderby=='seqno'){
            $criteria->order="c.seqno asc,c.pingyin asc";
        }
        //$criteria->compare('t.type',0);
        $data = self::model()->findAll($criteria);

        return $data;
    }

    /*
*获取老师所属班级
*/
    public static function getTeacherClassRelationByTeacher($uid)
    {
        $criteria = new CDbCriteria;
        $criteria->with = array('c');
        $criteria->compare('t.teacher', $uid);
        $criteria->compare('t.deleted', 0);
        $criteria->compare('c.deleted', 0);
        $criteria->compare('t.state', 1);
        $criteria->order="c.seqno,c.pingyin";
        $data = self::model()->findAll($criteria);
        return $data;
    }

    /**
     * 统计老师班级数量
     * panrj 2014-11-14
     * @param int $uid 老师Id
     * @param int $cid 班级Id
     * @return int $result
     */
    public static function countTeacherClassRelation($uid,$cid)
    {   
        $criteria = new CDbCriteria;
        $criteria->compare('teacher', $uid);
        $criteria->compare('cid', $cid);
        $criteria->compare('deleted', 0);
        $criteria->compare('state', 1);
        $data = self::model()->count($criteria);
        return $data;
    }
    /*
     * 查找某些班的老师数量，以前统计有误，需要考虑老师即是班主任又是其它几个科目老师情况，所以加上distinct，
     * 返回数组，导入时用，导入时，有多个班级情况
     */
    public static function countClassTeacherNum($cids)
    {
        if(!empty($cids)){
            $sql="select  s.cid,count(DISTINCT s.teacher) as num from tb_class_teacher_relation s inner join tb_user u on s.teacher=u.userid  where s.deleted=0 and s.state=1 and u.deleted=0  and s.cid in($cids) group by s.cid";
            $data=UCQuery::queryAll($sql);
        }else{
            $data=array();
        }
        $arr=array();
        foreach($data as $val){
            $arr[$val['cid']]=$val['num'];
        }
        return $arr;
    }
    /*
     * 获取单个班的老师数量　
     */
    public static function getClassTeacherNumByCid($cid){
        $data=self::countClassTeacherNum($cid);
        if(isset($data[$cid])){
            return $data[$cid];
        }else{
            return 0;
        }
    }

    public static function  deleteClassTeacher($teacherid, $cid)
    {

        $criteria = new CDbCriteria();
        $criteria->compare('cid', $cid);
        $criteria->compare('teacher', $teacherid);
        $criteria->compare('deleted', 0);
        $data=self::model()->findAll($criteria);
        foreach($data as $val){
            $val->deleted=1;
            $val->save();

        }
        return true;
       // return self::model()->updateAll(array('deleted' => 1), $criteria);
    }

    public static function  deleteTeachersClassRelation($teacherid)
    {
        $criteria = new CDbCriteria();
        $criteria->compare('teacher', $teacherid);
        $criteria->compare('deleted', 0);
        $data=self::model()->findAll($criteria);
        foreach($data as $val){
            $val->deleted=1;
            $val->save();

        }
        //return self::model()->updateAll(array('deleted' => 1), $criteria);
    }

    /*
     * 原来用pageData,用视图保存所有数据查找，性能问题严重
     */
    public function pageDataBySql($params = array())
    {
        $sql = " SELECT  `t`.`userid` AS `userid`,   `t`.`name` AS `username`,   `t`.`mobilephone` AS `mobilephone`,`t`.`issmsauth` AS `issmsauth`, `t`.`creationtime` AS `creationtime`,GROUP_CONCAT(s.sid SEPARATOR ',') as sid,GROUP_CONCAT(s.did SEPARATOR ',') did ";
        $totalsql = " SELECT    count(DISTINCT t.userid) as num ";
        $dutywhere='';

        $sharesql="";
        $sharesql .= " FROM     `tb_user` `t` LEFT JOIN (select teacher,`s`.`sid` ,`s`.`did`,s.duty   from tb_school_teacher_relation s where s.deleted=0 and s.state=1) s ON ";
        $sharesql .= " `t`.`userid` = `s`.`teacher`     LEFT JOIN `tb_school` `sc` ON`s`.`sid` = `sc`.`sid` WHERE `t`.`identity`  in(1,5) and `t`.`deleted` = 0 and t.state=1  ";

        if (isset($params['name']) && $params['name'] != '') {
            $sharesql.=" and t.name like '%".$params['name']."%'";
        }
        
        //后台用户权限过滤
        if(Yii::app()->params['platform']=='backend'){
            $uid = Yii::app()->user->id;
            $user = User::model()->findByPk($uid);
            $sids = UserAccess::getUserAccessTargetPks($uid,$user->type);
            if(in_array($user->type,array(1,3))){
                if(count($sids)){
                    $sids = implode(',', $sids);
                    $sharesql.=" and s.sid in (" . $sids . ")" ;
                }else{
                    $sharesql.=" and s.sid = 0" ;
                }
            }
        }
        // //用户权限过滤
        // $uid = Yii::app()->user->id;
        // $sids = UserAccess::getUserAccessTargetPks($uid,$type=1);
        // if(!empty($sids)){
        //     $sids = implode(',', $sids);
        //     $sharesql.=" and s.sid in (" . $sids . ")" ;
        // }

        if (isset($params['sid']) && !empty($params['sid'])) {
            $sharesql.=" and s.sid=" . $params['sid'] ;
        }
        if (isset($params['did']) && !empty($params['did'])) {
            $sharesql.=' and s.did=' . $params['did'] ;
        }
        if (isset($params['mobilephone']) && !empty($params['mobilephone'])) {
            $sharesql.=" and mobilephone like '%".$params['mobilephone']."%'";
        }

        if (isset($params['duty']) && !empty($params['duty'])) {
            $sharesql.=' and s.duty=' . $params['duty'] ;
        }
        $data=array();

        $data['total']=UCQuery::queryScalar($totalsql.$sharesql);
        $sharesql.=" group by t.userid";
        $page=$params['page']?(int)$params['page']:1;
        $page=$page<1?1:$page;
        $start=($page-1)*15;
        $sharesql.=" order by t.pingyin limit $start,15";
        $data['model']=UCQuery::queryAll($sql.$sharesql);
        return $data;
    }


    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ClassTeacherRelation the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /*
    * 获取某科，某个班级，某个老师的关联数据
    */
    public static function deleteTeacherSubject($cid, $uid, $sid = '')
    {
        $criteria = new CDbCriteria;
        $criteria->compare('teacher', $uid);
        $criteria->compare('cid', $cid);
        if($sid){
            $criteria->compare('sid', $sid);
        }else{

        }
        $criteria->compare('deleted', 0);
        $criteria->compare('state', 1);
        $data = self::model()->find($criteria);
        if($data){
            $data->deleteMark();
        }
    }
    /*
   * 修改 or设置班主任
   */
    public static function deleteMaster($cid,$uid)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('cid', $cid);
        $criteria->compare('type', 1);
        $criteria->compare('teacher', $uid);
       // $criteria->compare('deleted', 0);
        $data = self::model()->find($criteria);
        if($data){
            $data->deleteMark();
            $mclass=MClass::model()->findByPk($cid);
            if($mclass){
                if($mclass->master==$uid){
                    $mclass->master=null;
                    $mclass->save();
               }
            }
        }
    }
    /*
     * 得到老师的所有班级,用于检验非法操作,只有班主任才有权操作，添加学生，删除学生等
     */
    public static function getTeacherClass($teacher,$master=true){
        $criteria = new CDbCriteria;
        $criteria->with=array("c");

        $criteria->compare('t.teacher', $teacher);
        $criteria->compare('t.deleted', 0);
        $criteria->compare('c.deleted', 0);
        if($master){ //查看学生，老师
            $criteria->compare('t.type', 1);
        }
        $criteria->compare('t.state', 1);
        $criteria->group="t.cid,t.teacher";
        $data=self::model()->findAll($criteria);
        $arr=array();
        foreach($data as $val){
            $arr[$val->cid]=$val->c->name;
        }
        return $arr;
    }
    public static function getClassTeacherInfo($id){
        $criteria = new CDbCriteria;
        $criteria->with=array("teacher0","c");
        $criteria->compare('t.cid', $id);
        $criteria->compare('t.deleted', 0);
        $criteria->compare('c.deleted', 0);
        $criteria->compare('teacher0.deleted', 0);
        $criteria->compare('t.state', 1);
        $criteria->compare('c.state', 1);
        $criteria->compare('teacher0.state', 1);
        $data=self::model()->findAll($criteria);
        $arr=array();
        foreach($data as $key=> $val){
            $arr[$key]['cid']=$val->cid;
            $arr[$key]['id']=$val->id;
            $arr[$key]['creationtime']=$val->creationtime;
            $arr[$key]['sid']=$val->sid;
            $arr[$key]['state']=$val->state;
            $arr[$key]['subject']=$val->subject;
            $arr[$key]['userid']=$val->teacher0->userid;
            $arr[$key]['name']=$val->teacher0->name;
            $arr[$key]['mobilephone']=$val->teacher0->mobilephone;
        }
        return $arr;
    }
    
    public static function getLastRowByTeacher($tid){
        
        $criteria = new CDbCriteria;
        $criteria->compare('teacher', $tid);
        $criteria->compare('deleted', 0);
        $criteria->compare('state', 1);
        $criteria->order = 'id desc';
        return self::model()->find($criteria);
        
    }
    //获取班级下的老师
    public static function getClassTeacherByCidTeacher($cid,$teacher){
        $criteria = new CDbCriteria;
        $criteria->compare('cid', $cid);
        $criteria->compare('teacher', $teacher);
        $criteria->compare('deleted', 0);
        $criteria->compare('state', 1);
        $criteria->order = 'id desc';
        return self::model()->find($criteria);

    }
    
    /*
     * 获取某老师导入的老师数量（同一个老师多个班级的取最后一条）
     */
    public static function countCreater($creid){
        
        $criteria = new CDbCriteria();
        $criteria->with = array("teacher0");
        $criteria->compare('t.creater', $creid);
        $criteria->compare('t.deleted', 0);
        $criteria->compare('t.state', 1);        
        $criteria->compare('teacher0.deleted', 0);
        $criteria->compare('teacher0.isnewuser', 0);
        $criteria->compare('teacher0.active', '>0');
        $records = self::model()->findAll($criteria);
        
        $count = 0;
        foreach ($records as $record){
            $teacher = $record->teacher;
            $criteria = new CDbCriteria();
            $criteria->compare('t.teacher', $teacher);
            $criteria->compare('t.deleted', 0);
            $criteria->compare('t.state', 1);
            $criteria->order = 'id desc';
            $lastRec = self::model()->find($criteria);
            if($lastRec->creater == $creid){
                $count ++;
            }
        }
        return $count;
    }

    /*
     * 统计老师的班主任数量　
     */
    public static function countTeacherMasterNum($teacher){
        $criteria = new CDbCriteria();
        $criteria->with = array("c");
        $criteria->compare('t.teacher', $teacher);
        $criteria->compare('t.deleted', 0);
        $criteria->compare('t.type', 1);
        $criteria->compare('c.deleted', 0);
       // $criteria->compare('c.master', $teacher);
        $num= self::model()->count($criteria);
        return $num;
    }
    
    
    /***
     * 班费查看-检查老师是否存在于某班级
     */
    public static function checkTeacherClassRelation($userid, $cid)
    {
        $isexists = ClassTeacherRelation::model()->findByAttributes(array('deleted'=>0, 'teacher'=>$userid, 'cid'=>$cid));
        return $isexists;        
    }

    /*
     * 获取班级和老师关系
     * $master=1，表示只查班主任，＝２只查关系科目
     * =0查所有关系,
     * 如果班主任任教的话，会有两条数据
     */
    public static function getClassTeacherRelation($cid,$teacher,$master=1){
        $criteria = new CDbCriteria();
        $criteria->compare('t.teacher', $teacher);
        $criteria->compare('t.cid', $teacher);
        $criteria->compare('t.deleted', 0);
        $criteria->compare('t.state', 1);
        if($master==1){
            $criteria->compare('t.type', 1);
        }else if($master==2){
            $criteria->compare('t.type', 0);
        }else{

        }
        return self::model()->findAll($criteria);
    }
    /*
     * 获取某个班的班主任信息
     * 新接口不再用class表的master，都改用查关系表
     */
    public static function getClassMaster($cid){
        $criteria = new CDbCriteria();
        $criteria->with=array('teacher0');
        $criteria->compare('t.cid', $cid);
        $criteria->compare('t.deleted', 0);
        $criteria->compare('t.state', 1);
        $criteria->compare('t.type', 1);
        $criteria->compare('teacher0.deleted', 0);
        $arr=self::model()->find($criteria);
        return $arr;
    }




}
