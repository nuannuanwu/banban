<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property string $userid
 * @property string $account
 * @property string $pwd
 * @property string $name
 * @property integer $sex
 * @property string $photo
 * @property integer $identity
 * @property integer $vtid
 * @property string $mobilephone
 * @property string $email
 * @property integer $version
 * @property string $lastlogintime
 * @property integer $state
 * @property string $creationtime
 * @property string $updatetime
 * @property integer $deleted
 *
 * The followings are the available model relations:
 * @property Class[] $classes
 * @property ClassStudentRelation[] $classStudentRelations
 * @property ClassTeacherRelation[] $classTeacherRelations
 * @property Group[] $groups
 * @property GroupUserRelation[] $groupUserRelations
 * @property Guardian[] $guardians
 * @property Guardian[] $guardians1
 * @property SchoolTeacherRelation[] $schoolTeacherRelations
 * @property StudentExt $studentExt
 */
class Member extends MemberActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('account, pwd, name', 'required'),
			array('sex, identity, vtid, version, state, deleted, isnewuser', 'numerical', 'integerOnly'=>true),
			array('userid, name, mobilephone', 'length', 'max'=>20),
			array('account', 'length', 'max'=>12),
            array('lastloginip', 'length', 'max'=>15),
			array('pwd, email', 'length', 'max'=>50),
			array('photo', 'length', 'max'=>256),
			array('threeareaid,threeareaid,lastlogintime, updatetime,creationtime,issendpwd,pingyin,createtype', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('issmsauth,threeareaid,threeareaid,userid, account, pwd, name, sex, photo, identity, vtid, mobilephone, email, version, lastlogintime, state, creationtime, updatetime, deleted,createtype, isnewuser', 'safe', 'on'=>'search'),
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
			'classes' => array(self::HAS_MANY, 'Class', 'master'),
			'classStudentRelations' => array(self::HAS_MANY, 'ClassStudentRelation', 'student'),
			'classTeacherRelations' => array(self::HAS_MANY, 'ClassTeacherRelation', 'teacher'),
			'groups' => array(self::HAS_MANY, 'Group', 'creater'),
			'groupUserRelations' => array(self::HAS_MANY, 'GroupUserRelation', 'member'),
			'guardians' => array(self::HAS_MANY, 'Guardian', 'child'),
			'guardians1' => array(self::HAS_MANY, 'Guardian', 'guardian'),
			'schoolTeacherRelations' => array(self::HAS_MANY, 'SchoolTeacherRelation', 'teacher'),
			'studentExt' => array(self::HAS_ONE, 'StudentExt', 'userid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'userid' => '用户ID',
			'account' => '登录账号',
			'pwd' => '密码',
			'name' => '姓名',
			'sex' => '性别：0无；1男；2女',
			'photo' => '头像',
			'identity' => '用户身份：1老师；2学生；3家长；4教育局',
			'vtid' => 'vip类型',
			'mobilephone' => '注册手机',
			'email' => '注册邮箱',
			'version' => '版本：0通用；1校信；2校安；3成都数字学校',
			'lastlogintime' => '最后登录时间',
			'state' => '状态：0待激活；1已激活',
			'creationtime' => '创建时间',
			'updatetime' => '更新时间',
			'deleted' => '已删除：0未删除；1已删除',
			'issendpwd' => '是否发送过初始密码,1--发送过,0,未发送',
			'pingyin' => '姓名拼音',
            'lastloginip' => '最后登录IP',
            'createtype' => '创建类型',
            'isnewuser' => '是否是新用户，默认新用户，旧用户需要手动改为1',
            'threeareaid' => '第三方areaid',
            'threeuserid' => '第三方用户id',
            'issmsauth'=>'班班用户是否拥有学校通知(短信权限),默认没有，需要的话需要在后台老师管理修改'

		);
	}



	public static function getName($userid)
	{
		$member = self::model()->findByPk($userid);
		if($member){
			return $member->name;
		}else{
			return '';
		}
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
		$criteria->compare('account',$this->account,true);
		$criteria->compare('pwd',$this->pwd,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('sex',$this->sex);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('identity',$this->identity);
		$criteria->compare('vtid',$this->vtid);
		$criteria->compare('mobilephone',$this->mobilephone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('version',$this->version);
		$criteria->compare('lastlogintime',$this->lastlogintime,true);
		$criteria->compare('state',$this->state);
		$criteria->compare('creationtime',$this->creationtime,true);
		$criteria->compare('updatetime',$this->updatetime,true);
		$criteria->compare('deleted',$this->deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public static function checkteachermobilephone($mobilephone,$identity=1){
    	return self::getUniqueMember($mobilephone,$identity);
        // $criteria=new CDbCriteria;
        // $criteria->compare('mobilephone',$mobilephone);
        // $criteria->compare('identity',$identity);
        // $criteria->compare('deleted',0);
        // $data = self::model()->findAll($criteria);
        // return $data;
    }

    /*
     * 删除老师
     */
    public static function deleteMember($uid){
        try{
            SchoolTeacherRelation::model()->deleteTeachersRelation($uid);
            ClassTeacherRelation::deleteTeachersClassRelation($uid);
            $member = self::model()->loadByPk($uid);
            $mclass=MClass::model()->updateAll(array("master" => null), "master=:master", array(":master" => $uid));
            //判断是否还存在家长身份
            $guardian =  Guardian::getChilds($member->userid);
            if($guardian){
                $member->identity = Constant::FAMILY_IDENTITY;
                $member->issmsauth=0;
                $member->save();
            }else{
                $member->deleteMark();
            }
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    /*
     * 删除学生
     */
    public static function deleteStudent($uid){
        try{
            ClassStudentRelation::deleteStudentClassRelation($uid);//删除班级对应关系
            Guardian::model()->deleteStudentGrardianRelation($uid);
            $member = self::model()->loadByPk($uid);
            $member->deleteMark();
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    /*
     * 手机号码获取老师
     */
    public static function getMemberByMobile($mobile,$identity=3){
        $criteria=new CDbCriteria;
        $criteria->compare('mobilephone',$mobile);
        $criteria->compare('identity',$identity);
        $criteria->compare('deleted',0);
        $data = self::model()->find($criteria);
        return $data;
    }

    public static function getUseridByMobile($mobile)
    {
    	$criteria=new CDbCriteria;
        $criteria->compare('mobilephone',$mobile);
        $criteria->compare('deleted',0);
        $data = self::model()->findAll($criteria);
        $ids = array();
        if(count($data)){
        	foreach($data as $d){
        		$ids[] = $d['userid'];
        	}
        }
        return $ids;
    }
    
    public static function getUserinfoByMobile($mobile)
    {
        $criteria=new CDbCriteria;
        $criteria->compare('mobilephone',$mobile);
        $criteria->compare('deleted',0);
        return self::model()->find($criteria);
    }

    public static function getUserMobileByUserid($uid)
    {
    	$user = Member::model()->findByPk($uid);
    	if($user){
    		return $user->mobilephone;
    	}else{
    		return '';
    	}
    }

    /*
     * 获取用户扩展信息
     * panrj 2014-10-14
     */
    public function getUserExt()
    {
    	$ext = UserExt::model()->findByPk($this->userid);
    	if($ext){
    		return $ext;
    	}else{
    		$ext = new UserExt;
    		$ext->userid = $this->userid;
    		$ext->save();
    		return $ext;
    	}
    }

    /*
     * 查询唯一用户数据
     * panrj 2014-10-18
     * @parms string $mobile 用户手机号码
     * @parms int $identity 为false：返回手机匹配用户 
     * @parms string $login_type 登录账号类型
	 * @return array $member 
     */
    public static function getUniqueMember($account,$identity=false,$login_type='mobilephone')
    {
    	$member = Member::model()->findByAttributes(array($login_type=>$account,'deleted'=>0));
    	if($member){
    		if(!$identity){
    			return $member;
    		}
    		$role = $member->identity;
    		switch ($identity){
				case 1:
					$match = in_array($role,array(1,5));
				  	break;
				case 2:
				  	$match = in_array($role,array(2));
				  	break;
				case 4:
				 	$match = in_array($role,array(4,5));
				  	break;
				default:
					$match = false;
				  	break;
			}
			return $match?$member:null;
    	}else{
    		return null;
    	}
    }

     /*
     * 开放注册-查询手机唯一用户数据，如果是老师返回userid
     * panrj 2014-10-18
     * @parms string $phone 用户手机号码
     * @return int 
     */
    public static function getUniqueByOpenReg($phone)
    {
        $member = Member::model()->findByAttributes(array('mobilephone'=>$phone,'deleted'=>0));
        if($member){
            $identity = $member->identity;
            if($identity == 1 || $identity == 5){
                return 0;
            }else if($identity == 4){
                return $member->userid;
            }else{
                return 1;
            }
        }else{
            return 1;
        }
    }

    /*
     * 换算用户身份
     * panrj 2014-10-18
     * @parms string $new_itd 新用户身份
     * @parms string $old_idt 旧用户身份
	 * @return string $idt 换算后的用户身份 
     */
    public static function transIdentity($new_itd,$old_idt=false)
    {
    	if(!$old_idt){
    		return $new_itd;
    	}
    	if($new_itd==$old_idt || $old_idt==5){
    		return $old_idt;
    	}else{
    		return $new_itd+$old_idt;
    	}
    }

    /**
     * 扩展beforeSave方法,用来同步商品库存
     * panrj 2014-09-19
     */
    public function beforeSave()
    {
        if($this->isNewRecord){
            $this->version=(int)USER_BRANCH;
            $this->state=1;
        }
        $this->name=trim($this->name);
       // if($this->identity!==4){
            $py=new py_class();
            $this->pingyin=substr($py->str2py($this->name),0,10);
        //}

        return parent::beforeSave();
    }


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Member the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function defaultPhoto($uid)
    {
        if(Yii::app()->user->isGuest){
            return Yii::app()->request->baseUrl.'/image/xiaoxin/default_pic.jpg';
        }

        $user = self::model()->findByPk($uid);
        if($user&&$user->deleted==0){
            /*  成都上线。暂时屏弊，因为上传头像还有问题
            $userExt=UserExt::model()->findByPk($uid);
            if($userExt&&$userExt->photo){
                return STORAGE_QINNIU_XIAOXIN_TX.$userExt->photo;
            }
            */
        if($user->sex==0)
            return Yii::app()->request->baseUrl.'/image/xiaoxin/default_pic.jpg';
        if($user->sex==1)
            return Yii::app()->request->baseUrl.'/image/xiaoxin/man_pic.jpg';
        if($user->sex==2)
            return Yii::app()->request->baseUrl.'/image/xiaoxin/woman_pic.jpg';
        }else{
            return Yii::app()->request->baseUrl.'/image/xiaoxin/default_pic.jpg';
        }
    }

    /*
     * 根据手机号,学生姓名，添加学生
     * $$issendinvite 是否发送邀请 1,发， 0－－不发
     * 返回学生id及要发送密码的数组
     */
    public static function addStudentByMobileAndName($mobile,$name,$cid,$role='家长',$classInfo=null,$studentid=''){
        $transaction = Yii::app()->db_member->beginTransaction();
        $class =$classInfo;

        if(!$class){
            $class=MClass::model()->findByPk($cid);
            if(!$class)
            return null;
        }
        $result=array();
        try{

            $isExists = Member::getUniqueMember($mobile);
            $studentinfo=ClassStudentRelation::getStudentByName($name,$class->cid);
            if($studentinfo){
                $result['status']=1;
                $result['studentexists']=1;
               // $result['name']=$name;
               // $result['mobile']=$mobile;
                return $result;
            }
            //家长已存在，建立对应关系
            if ($isExists) {
                $studentinfo=ClassStudentRelation::getStudentByName($name,$class->cid);
                if($studentinfo){ //学生已存在
                    $result['status']=1;
                    $result['userexists']=1;
                    $result['name']=$name;
                    $result['mobile']=$mobile;
                    return $result;

                }
               // $childs = Guardian::getChilds($isExists->userid);
                //判断学生名字是否一致,是否在这个监护人的孩子中
                $child = Guardian::checkGuardianChildByName($isExists->userid,$name);

                $firstChildGuardian=null;
                //监护人已经有这个孩子名
                //取这个孩子的最早监护人
                if($child){
                    $firstChildGuardian=Guardian::getChildFirstGuardian($child->child);
                   // error_log('ddddd;.'.$firstChildGuardian->guardian);
                }
                //换算身份
                $transIdentity = Member::transIdentity(4, $isExists->identity);
                $isExists->identity = $transIdentity;
                $isExists->state = 1;
                $isExists->save();
                //如果最早监护人就是这个家长，就默认为同一个孩子，如果不是，是以其它关注人添加的，则要新生成另一学生,这产品的我也是醉了，非要搞个 狗屁关注人家长逻辑太扯了，
                //必须差评,看这样的东西想吐
                if($child&&($firstChildGuardian&&$isExists->userid==$firstChildGuardian->guardian)){
                    $isInclass =ClassStudentRelation::countClassStudentRelation($class->cid, $child->child);
                    if($isInclass){
                    }else{
                        $classRelation = new ClassStudentRelation;
                        $classRelation->cid = $cid;
                        $classRelation->state = 1;
                        $classRelation->student = $child->child;
                        $classRelation->save();
                        $result['status']=1;
                    }
                }else{
                    //创建学生
                   // $studentinfo=ClassStudentRelation::getStudentByName($name,$class->cid);
                    if(!$studentinfo){
                        $suid = UCQuery::makeMaxId(0, true);
                        $member = new Member;
                        $member->userid = $suid;
                        $member->name =$name;
                        $member->identity = 2; //学生标志;
                        $member->account = "s" . $suid; //学生前加s;
                        $member->pwd = MainHelper::encryPassword("123456");
                        $member->state = 1;
                        $member->issendpwd = 0;
                       
                        $member->createtype = 1;
                        
                        $member->save();
                    }else{
                        $suid=$studentinfo->student;
                    }
                    if(!empty($studentid)){
                        $studentExt=StudentExt::model()->findByPk($member->userid);
                        if($studentExt){
                            $studentExt->studentid=MainHelper::csubstr($studentid,0,20,'utf-8',false);
                            $studentExt->save();
                        }else{
                            $studentExt=new StudentExt();
                            $studentExt->userid=$member->userid;
                            $studentExt->studentid=MainHelper::csubstr($studentid,0,20,'utf-8',false);;
                            $studentExt->save();
                        }
                    }
                    if(!Guardian::getRelationByChildGuardian($isExists->userid,$suid)){
                        $guardianNum=Guardian::countChildGuardian($suid);
                        if($guardianNum<5){
                            $guardian = new Guardian;
                            $guardian->child = $suid;
                            $guardian->guardian = $isExists->userid;
                            $guardian->role = $role?$role : '家长';
                            $guardian->main = $guardianNum ? 0 : 1;
                            $guardian->save();
                        }
                    }
                    //班级关系
                    if(!ClassStudentRelation::countClassStudentRelation($cid,$suid)){
                        $classRelation = new ClassStudentRelation;
                        $classRelation->cid = $cid;
                        $classRelation->state = 1;
                        $classRelation->student = $suid;
                        $classRelation->save();
                    }

                }
                $result['status']=1;
                $result['userexists']=1;
                $result['name']=$name;
                $result['mobile']=$mobile;

            } else {
                //创建学生
                $studentinfo=ClassStudentRelation::getStudentByName($name,$class->cid);
                if(!$studentinfo){
                    $suid = UCQuery::makeMaxId(0, true);
                    $member = new Member;
                    $member->userid = $suid;
                    $member->name =$name;
                    $member->identity = 2; //学生标志;
                    $member->account = "s" . $suid; //学生前加s;
                    $member->pwd = MainHelper::encryPassword("123456");
                    $member->state = 1;
                    $member->issendpwd = 0;
                    if($class->s->createtype == 1){
                        $member->createtype = 1;
                    }
                    $member->save();
                }else{
                    $suid=$studentinfo->student;
                }
                if(!empty($studentid)){
                    $studentExt=StudentExt::model()->findByPk($suid);
                    if($studentExt){
                        $studentExt->studentid=$studentid;
                        $studentExt->save();
                    }else{
                        $studentExt=new StudentExt();
                        $studentExt->userid=$suid;
                        $studentExt->studentid=$studentid;
                        $studentExt->save();
                    }
                }
                //创建家长
                $userid = UCQuery::makeMaxId(0, true);
                $member = new Member;
                $member->userid = $userid;
                $member->state = 1;
                $member->name = '用户' . substr($mobile, -4); //$_POST['Student']['name'] . '的' . $roles[$i];
                $member->identity = Constant::FAMILY_IDENTITY; //家长标志;
                $member->mobilephone = $mobile;
                $member->account = "p" . $userid; //;aa
                $member->issendpwd = 0;
                $password = MainHelper::generate_code(6);
                $member->pwd = MainHelper::encryPassword($password);
               
                $member->createtype = 1;
                
                if ($member->save()) {
                    $guardianNum=Guardian::countChildGuardian($suid);
                    if($guardianNum<5){
                        $guardian = new Guardian;
                        $guardian->child = $suid;
                        $guardian->guardian = $userid;
                        $guardian->role = $role?$role:'家长';
                        $guardian->main = Guardian::countChildGuardian($suid)?0:1;
                        $guardian->save();
                    }
                }
                //班级关系
                if(!ClassStudentRelation::countClassStudentRelation($cid,$suid)){
                    $classRelation = new ClassStudentRelation;
                    $classRelation->cid = $cid;
                    $classRelation->state = 1;
                    $classRelation->student = $suid;
                    $classRelation->save();
                }

                $result['mobile']=$mobile;
                $result['password']=$password;
                $result['userexists']=0;
                $result['name']=$name;
                //$resutl['mobile']=$mobile;

            }
            $transaction->commit();


        }catch(Exception $e){
            Yii::log($e->getMessage(),CLogger::LEVEL_ERROR);
            $transaction->rollback();
        }
        return $result;
    }


    //根据uids集合,逗号分隔的,获取用户信息
    public static function getUsersByUids($uids)
    {
        $criteria=new CDbCriteria;
        if(empty($uids)) return array();
        $criteria->addInCondition("userid",$uids);
        $criteria->compare('deleted',0);
        $criteria->order="pingyin";
        $data = self::model()->findAll($criteria);
        return $data;
    }

    /*
     * 根据account查找用户
     */
    public static function getMemberByAccount($account)
    {
        $criteria=new CDbCriteria;
        $criteria->compare('deleted',0);
        $criteria->compare('account',$account);
        return self::model()->find($criteria);
    }

     /*
     * 批量导入老师
     * zengp 2014-12-27
     * $mobile 手机号码
     * $name 老师名称
     * $cid 班级id
     */
    public static function addTeacherByMobileAndName($mobile, $name, $cid, $role='老师', $classInfo=null)
    {
        $userid = Yii::app()->user->id;
        $class = $classInfo;
        if(!$class){
            $class = MClass::model()->findByPk($cid);
            if(!$class)
                return null;
        }
        $sid = $class->sid;
        $version = (int)USER_BRANCH;
        $password=MainHelper::generate_code(6);
        $pwd = MainHelper::encryPassword($password);
        $tid = 0;
        $result=array();
        $memberEntity = Member::model()->findByAttributes(array('mobilephone'=>$mobile,'deleted'=>0));
        if(!$memberEntity){
            //老师不存在，添加老师
            $tuid = UCQuery::makeMaxId(0, true);
            $member = new Member;
            $member->userid = $tuid;
            $member->account = 't' . $tuid;
            $member->pwd = $pwd;
            $member->name = $name;
            $member->identity = 1;
            $member->mobilephone = $mobile;
            $member->state = 1;
            $member->version = $version;
            $member->issendpwd = 0;
           
            $member->createtype = 1;
           
            $member->save();
            $tid = $member->userid;
            $result['teacher'] = $tid;
            $result['name'] = $name;
            $result['mobile'] = $mobile;
            $result['password'] = $password;
            $result['userexists']=0;
        }else{
            //存在，修改身份
            $oldidentity = $memberEntity->identity;
            $newIdentity=Member::transIdentity(Constant::TEACHER_IDENTITY,$oldidentity);
            $memberEntity->state = 1;
            if($class->s->createtype == 1){  //以第一次生成帐号为准　
               // $memberEntity->createtype = 1;
            }
            //$memberEntity->name = $name;
           // $result['invitecount']=$memberEntity->invitecount;
            $result['name']=$name;
            $result['mobile']=$mobile;
            $result['userexists']=1;
            $memberEntity->identity = $newIdentity;
            $memberEntity->save();
            $tid = $memberEntity->userid;
        }

        //建立老师学校关系

        if($sid){
            $stRelation = SchoolTeacherRelation::getSchoolTeachersRelation(array('sid'=>$sid,'teacher'=>$tid));
            if(!$stRelation){
                   $stNewRecord = new SchoolTeacherRelation;
                   $stNewRecord->sid = $sid;
                   $stNewRecord->teacher = $tid;
                   $stNewRecord->state = 1;
                  // if($class->s->createtype == 1){
                        $stNewRecord->duty = 58; //自注册老师 
                   //}
                   
                   $stNewRecord->save();
            }
        }

        $ctRelation = ClassTeacherRelation::countTeacherClassRelation($tid,$cid);        
        if(empty($ctRelation)){            
            //建立老师班级关系
            //如果不存在老师班级关系，建立关系
            $ctNewRecord = new ClassTeacherRelation;
            $ctNewRecord->cid = $cid;
            $ctNewRecord->teacher = $tid;
            $ctNewRecord->state = 1;
            $ctNewRecord->creater = $userid;
            $ctNewRecord->subject = '';
            $ctNewRecord->save();
        }else{
            $result['isexists']=1;//已存在班级中
        }
        
        return $result;
        
    }
    /*
     * 根据一组mobiles更新是否发送密码状态,即issendpwd字段
     */
    public static function updateissendpwdStateByMobiles($mobiles){
        $criteria=new CDbCriteria;
        $criteria->compare('deleted',0);
        $criteria->addInCondition('mobilephone',$mobiles);
        self::model()->updateAll(array('issendpwd'=>1),$criteria);
    }

    /*
     * zengp 2014-12-27
     * 判断用户是否为自注册用户
     */
    public static function isSelfReg(){
        $userid = Yii::app()->user->id;
        $member = Member::model()->findByPk($userid);
        return $member->createtype;
    }

    public static function getUseridByMobileArr($mobiles)
    {
        $criteria=new CDbCriteria;
        if(count($mobiles)){
            $criteria->addInCondition('mobilephone',$mobiles);
            $criteria->compare('deleted',0);
            $data = self::model()->findAll($criteria);
        }else{
            $data=array();
        }
        $ids = array();
        foreach($data as $val){
            $ids[$val['mobilephone']]=$val;
        }
        return $ids;
    }
    
    /*
     * zengp 2015-01-28
     * 新班班-更换手机绑定时查询用户是否存在绑定
     */
    public static function countByidentityMobile($mobile, $userid){
        
        $criteria=new CDbCriteria;
        $criteria->compare('deleted',0);
        $criteria->compare('mobilephone', $mobile);
        $criteria->addCondition('userid != ' . $userid);        
        return self::model()->count($criteria);               
        
    }

    /**
     * 获取家长用户称谓
     * @param  integer $uid 家长用户ID
     * @return string       家长称谓
     */
    public static function getParentName($uid)
    {
        $criteria=new CDbCriteria;
        $criteria->compare('deleted',0);
        $criteria->compare('guardian', $uid);
        $criteria->compare('state',1);        
        $guardian = Guardian::model()->find($criteria);   
        if($guardian){
            $role = $guardian->role?$guardian->role:'家长';
            return $guardian->child0->name.'的'.$role;
        }else{
            $parent = self::model()->findByPk($uid);
            return $parent->name;
        }
    }

    //获取用户app,web活跃状态,以及否激活等,考虑效率，$uid可为数组，一起查询，如果为单个，则只查单个
    public static function getUserActiveState($uid){

        if(is_int($uid)||is_string($uid)){
            $appstate=0;
            $webstate=0;
            $user=Member::model()->findByPk((int)$uid);
            $appactive=0;
            $webactive=0;
            $active=$user&&$user->active?1:0;;

                //查app的活跃状态
                $client = UserOnline::getOnLineByUserId($uid,true); //这个表记录app登陆数据
                if($client){ //
                    $appactive=1;
                    $clientinfo=$client[0];
                    if($clientinfo->state==1){//如果存在,并且在线
                        $appstate=1;
                    }else{ //不在线，则看更新时间,如果更新时间小于30天还是活跃状态
                        $lastupdatetime=$clientinfo->updatetime;
                        if($lastupdatetime){
                            $diff=time()-strtotime($lastupdatetime);
                            if($diff<=24*3600*30){
                                $appstate=1;
                            }
                        }
                    }
                }

                //查web活跃状态
                $todaycache=date("Y-m-d")."pv_activeuser";//当天活跃用户缓存键
                $arr=Yii::app()->cache->get($todaycache);
                //先看当天缓存中有没有这个用户　
                if($arr&&is_array($arr)&&in_array($uid,$arr)){
                    $webstate=1;
                    $webactive=1;
                }else{
                    $websiteview=WebsiteView::model()->findByPk($uid);
                    if($websiteview){
                        $webactive=1;
                        $lastvisit=strtotime($websiteview->lasttime);
                        $diff=time()-$lastvisit;
                        if($diff<=24*3600*30){
                            $webstate=1;
                        }
                    }
                }


            //}
            return array('active'=>$active,'appactive'=>$appactive,'webactive'=>$webactive,'webstate'=>$webstate,'appstate'=>$appstate);

        }else if(is_array($uid)){
                if(empty($uid)){
                   return array();
                }
                $result=array();
                $users=Member::getUsersByUids($uid); //获取所有uid信息
                $client = UserOnline::getOnLineByUserId($uid,true); //这个表记录app登陆数据
                $clientArr=array();
                foreach($client as $client_info){
                    $clientArr[$client_info->userid]=$client_info;
                }
                $websiteview=WebsiteView::getWebViewByUids($uid);
                $webArr=array();
                foreach($websiteview as $web){
                    $webArr[$web->userid]=$web;
                }
                foreach($users as $user){
                    $appstate=0;
                    $webstate=0;
                    $appactive=0;
                    $webactive=0;
                    $active=$user&&$user->active?1:0;;;
                    if (!$active) {
    
                    }else{
                        $clientinfo = isset($clientArr[$user->userid])?$clientArr[$user->userid]:null;; //这个表记录app登陆数据
                        if($clientinfo){ //
                            $appactive=1;
                            if($clientinfo->state==1){//如果存在,并且在线
                                $appstate=1;
                            }else{ //不在线，则看更新时间,如果更新时间小于30天还是活跃状态
                                $lastupdatetime=$clientinfo->updatetime;
                                if($lastupdatetime){
                                    $diff=time()-strtotime($lastupdatetime);
                                    if($diff<=24*3600*30){
                                        $appstate=1;
                                    }
                                }
                            }
                        }
    
                        //查web活跃状态
                        $todaycache=date("Y-m-d")."pv_activeuser";//当天活跃用户缓存键
                        $arr=Yii::app()->cache->get($todaycache);
                       // var_dump($uid);
                       // D($arr);
                        //先看当天缓存中有没有这个用户
    
    
                        if($arr&&is_array($arr)&&in_array(strval($user->userid),$arr)){
                            $webstate=1;
                            $webactive=1;
                        }else{
    
                            $websiteview=isset($webArr[$user->userid])?$webArr[$user->userid]:null;;
                            if($websiteview){
                                $webactive=1;
                                $lastvisit=strtotime($websiteview->lasttime);
                                $diff=time()-$lastvisit;
                                if($diff<=24*3600*30){
                                    $webstate=1;
                                }
                            }
                        }
                    }
                    $result[$user->userid]=array('active'=>$active,'appactive'=>$appactive,'webactive'=>$webactive,'webstate'=>$webstate,'appstate'=>$appstate);
                }
                return $result;
        }
    }

    /**
     * 判断当前登录用户是否存在班级
     * @return boolean
     */
    public static function isExistsClassByUser()
    {
        $userid = Yii::app()->user->id;
        $teaClass = ClassTeacherRelation::model()->findByAttributes(array('deleted'=>0, 'teacher'=>$userid, 'state'=>1));
        if(!$teaClass){
            $childs = Guardian::getChildsUserid($userid);
            foreach ($childs as $child){
                $stuClass = ClassStudentRelation::model()->findByAttributes(array('deleted'=>0, 'state'=>1, 'student'=>$child));
                if($stuClass){
                    return true;
                    break;
                }
            }
            return false;     
        }else{
            return true;
        }        
    }

    /*
    * 批量导入学生
     * 一个学生，多个家长
    */
    public static function importStudent($mobile,$name,$cid,$role='家长',$classInfo=null,$studentid='',$mobile1,$mobile2,$mobile3,$mobile4){
        $result=array();
        $class=MClass::model()->findByPk($cid);
      //  $transaction = Yii::app()->db_member->beginTransaction();
       // try{
            $studentinfo=ClassStudentRelation::getStudentByName($name,$class->cid);
            if($studentinfo){//　//学生在班级已存在，不再导入　
                $result['status']=1; //
                $result['studentexists']=1;
                $result['name']=$name;
                $result['mobile']=$mobile;
                return $result;
            }else{
                //学生在班级不存在,添加学生
                $result['status']=1; //
                $result['studentexists']=0;
                //添加学生
                $isexistsstudent=false;
                $oldstudentid=0;
                if($mobile||$mobile1||$mobile2||$mobile3||$mobile4){
                    if($mobile){
                        $firstGuardian=Member::getUniqueMember($mobile); //判断家长是不是存在
                        if($firstGuardian){
                            $student_tmp=Guardian::checkGuardianChildByName($firstGuardian->userid,$name);//家长存在，判断家长有没有这个孩子
                            if($student_tmp){ //家长已有这个孩子　，则不需要新建孩子
                                //再判断是不是第一监护人
                                //如果第一个手机号是这个孩子的家长（第一监护人），则不需要新建孩子，否则需要新建孩子，并且当家长

                                $first=Guardian::getChildFirstGuardian($student_tmp->child);
                                if($first&&$first->guardian==$firstGuardian->userid){
                                    $oldstudentid=$student_tmp->child;
                                    $isexistsstudent=true;
                                }else{
                                    $oldstudentid=$student_tmp->child;

                                }
                            }
                        }
                    }
                    if(!$isexistsstudent){
                        $suid = UCQuery::makeMaxId(0, true);
                        $user = new Member;
                        $user->userid = $suid;
                        $user->name =$name;
                        $user->identity = 2; //学生标志;
                        $user->account = "s" . $suid; //学生前加s;
                        $user->pwd = MainHelper::encryPassword("123456");
                        $user->state = 1;
                        $user->issendpwd = 0;
                        
                        $user->createtype = 1;
                        
                        $user->save();
                    }else{
                        if($oldstudentid){
                           $user=Member::model()->findByPk($oldstudentid);
                            if(!$user){
                                return $result;
                            }
                        }
                    }


                    if(!empty($studentid)){
                        $studentExt=StudentExt::model()->findByPk($user->userid);
                        if($studentExt){
                            $studentExt->studentid=MainHelper::csubstr($studentid,0,20,'utf-8',false);
                            $studentExt->save();
                        }else{
                            $studentExt=new StudentExt();
                            $studentExt->userid=$user->userid;
                            $studentExt->studentid=MainHelper::csubstr($studentid,0,20,'utf-8',false);;
                            $studentExt->save();
                        }
                    }

                    //添加学生与班级关系
                    $classRelation = new ClassStudentRelation;
                    $classRelation->cid = $cid;
                    $classRelation->state = 1;
                    $classRelation->student = $user->userid;
                    $classRelation->save();
                    $sendarr=array();
                    $guardianexists=array();
                    //添加家长
                    $mobiles=array($mobile,$mobile1,$mobile2,$mobile3,$mobile4);
                    foreach($mobiles as $mobilephone){
                        if($mobilephone){
                            $isExists=Member::getUniqueMember($mobilephone); //判断家长是不是存在
                            if($isExists){ //家长存在
                                $guardianexists[]=array('name'=>$name,'mobile'=>$mobilephone);
                                $transIdentity = Member::transIdentity(4, $isExists->identity);
                                $isExists->identity = $transIdentity;
                                $isExists->state = 1;
                                $isExists->save();
                                if(!Guardian::getRelationByChildGuardian($isExists->userid,$user->userid)){
                                    $guardianNum=Guardian::countChildGuardian($user->userid);
                                    if($guardianNum<5){
                                        $guardian = new Guardian;
                                        $guardian->child = $user->userid;
                                        $guardian->guardian = $isExists->userid;
                                        $guardian->role = $role?$role : ($guardianNum>0?'关注人':'家长');
                                        $guardian->main = $guardianNum ? 0 : 1;
                                        $guardian->save();
                                    }

                                }
                            }else{
                                //创建家长
                                $userid = UCQuery::makeMaxId(0, true);
                                $member = new Member;
                                $member->userid = $userid;
                                $member->state = 1;
                                $member->name = '用户' . substr($mobilephone, -4); //$_POST['Student']['name'] . '的' . $roles[$i];
                                $member->identity = Constant::FAMILY_IDENTITY; //家长标志;
                                $member->mobilephone = $mobilephone;
                                $member->account = "p" . $userid; //;aa
                                $member->issendpwd = 0;
                                $password = MainHelper::generate_code(6);
                                $member->pwd = MainHelper::encryPassword($password);
                               
                                $member->createtype = 1;
                                
                                $member->save();
                                $sendarr[]=array('name'=>$name,'mobile'=>$mobilephone,'password'=>$password);
                                $guardianNum=Guardian::countChildGuardian($user->userid);
                                if($guardianNum<5){
                                    $guardian = new Guardian;
                                    $guardian->child = $user->userid;
                                    $guardian->guardian = $member->userid;
                                    $guardian->role = $role?$role : ($guardianNum>0?'关注人':'家长');
                                    $guardian->main = $guardianNum ? 0 : 1;
                                    $guardian->save();
                                }

                            }
                        }
                    }
                    //error_log('sss:'.json_encode($sendarr));
                    $result['sendpwd']=$sendarr;
                    $result['guardian']=$guardianexists;

                }
            }
           // $transaction->commit();
//        }catch(Exception $e){
//            Yii::log($e->getMessage(),CLogger::LEVEL_ERROR);
//            $transaction->rollback();
//        }
        return $result;
    }


    
}
