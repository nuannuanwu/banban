<?php
/**
* @author panrj 2014-05-21
* 后台管理菜单配置文件
*/
class XiaoxinMenu
{
	/**
	* @author panrj 2014-05-21 
	* 返回顶级菜单配置数组
	*/
	public static function top()
	{
		$arr = array(
			//发消息
			'noticesend' => array('notice_send','notice_sendexam','notice_schoolnotice','notice_schoolnotice_success','notice_exampreview','notice_examnext'),
			//我的班级
			'banban' => array('banban_index', 'banban_update', 'banban_create', 'banban_teachers', 'banban_students', 'banban_scfinish', 'banban_scimport', 'banban_scupload', 'banban_sfinish', 'banban_simport', 'banban_supload', 'banban_tupload', 'banban_timport','notmasterstudents','notmasterteachers','guardians','guardianstudents','guardianteachers','classinfo','chooseclass','createdone','perfectinfo','inclassdone','setrealname','applylist','inclasssetting','schoolsetting','gradesetting','sendpwd','banban_exprules', 'mastersetting'),
			//收件箱
			'noticereceive' => array('notice_receive', 'notice_receivedetail',),
			//已发送
			'noticehistory' => array('notice_history', 'notice_historydetail','notice_smshistory','notice_smshistorydetail'),
			//我的青豆
			'bean' => array('bean_index'),
			//我的班费
			'classfee' => array('fee_index', 'fee_detail', 'fee_transfer', 'fee_rules','fee_transfercard'),
            //我的班费
			'group' => array('group_index', 'group_create', 'group_update','notice_schoolnotice'),
            'invite' => array('invite_index', 'invite_send','invite_awarddetail','invite_state','send'),
            'login' => array('login_index', 'educationconcept','joinus','worknotice','companynews',),
		);
		return $arr;
	}

	/**
	* @author panrj 2014-05-21 
	* 返回子菜单配置数组
	*/
	public static function sub()
	{
		$arr = array(
		    //发消息
		    'notice_sendexam' => array(
		        array(
		            'module'=>"",'controller'=>'notice','action'=>'sendexam',
		        ),
		    ),
            'notice_send' => array(
                array(
                    'module'=>"",'controller'=>'notice','action'=>'send',
                ),
            ),
            'notice_schoolnotice' => array(
                array(
                    'module'=>"",'controller'=>'notice','action'=>'schoolnotice',
                ),
            ),
            'notice_schoolnotice_success' => array(
                array(
                    'module'=>"",'controller'=>'notice','action'=>'schoolnotice_success',
                ),
            ),
            'notice_exampreview' => array(
                array(
                    'module'=>"",'controller'=>'notice','action'=>'exampreview',
                ),
            ),
            'notice_examnext' => array(
                array(
                    'module'=>"",'controller'=>'notice','action'=>'examnext',
                ),
            ),
		    //我的班级
		    'banban_index' => array(
		        array(
		            'module'=>"",'controller'=>'class','action'=>'index',
		        ),
		    ),
		    'banban_update' => array(
		        array(
		            'module'=>"",'controller'=>'class','action'=>'update',
		        ),
		    ),
            'notmasterstudents' => array(
		        array(
		            'module'=>"",'controller'=>'class','action'=>'notmasterstudents',
		        ),
		    ), 
            'notmasterteachers' => array(
		        array(
		            'module'=>"",'controller'=>'class','action'=>'notmasterteachers',
		        ),
		    ),  
		    'banban_create' => array(
		        array(
		            'module'=>"",'controller'=>'class','action'=>'create',
		        ),
		    ),
		    'banban_teachers' => array(
		        array(
		            'module'=>"",'controller'=>'class','action'=>'teachers',
		        ),
		    ),
		    'banban_students' => array(
		        array(
		            'module'=>"",'controller'=>'class','action'=>'students',
		        ),
		    ),
		    'banban_scfinish' => array(
		        array(
		            'module'=>"",'controller'=>'class','action'=>'scfinish',
		        ),
		    ),
		    'banban_scimport' => array(
		        array(
		            'module'=>"",'controller'=>'class','action'=>'scimport',
		        ),
		    ),
		    'banban_scupload' => array(
		        array(
		            'module'=>"",'controller'=>'class','action'=>'scupload',
		        ),
		    ),		    
		    'banban_simport' => array(
		        array(
		            'module'=>"",'controller'=>'class','action'=>'simport',
		        ),
		    ),
            'sendpwd' => array(
                array(
                    'module'=>"",'controller'=>'class','action'=>'sendpwd',
                ),
            ),
		    'banban_supload' => array(
		        array(
		            'module'=>"",'controller'=>'class','action'=>'supload',
		        ),
		    ),
		    'banban_tupload' => array(
		        array(
		            'module'=>"",'controller'=>'class','action'=>'tupload',
		        ),
		    ),
            'guardians' => array(
		        array(
		            'module'=>"",'controller'=>'class','action'=>'guardians',
		        ),
		    ),
            'guardianteachers'=>array(
		        array(
		            'module'=>"",'controller'=>'class','action'=>'guardianteachers',
		        ),
		    ),
           
            'guardianstudents'=>array(
		        array(
		            'module'=>"",'controller'=>'class','action'=>'guardianstudents',
		        ),
		    ),
		    'banban_timport' => array(
		        array(
		            'module'=>"",'controller'=>'class','action'=>'timport',
		        ),
		    ),
            'classinfo' => array(
		        array(
		            'module'=>"",'controller'=>'class','action'=>'classinfo',
		        ),
		    ),
            'chooseclass' => array(
		        array(
		            'module'=>"",'controller'=>'class','action'=>'chooseclass',
		        ),
		    ),
             'createdone' => array(
		        array(
		            'module'=>"",'controller'=>'class','action'=>'createdone',
		        ),
		    ),
            'perfectinfo' => array(
		        array(
		            'module'=>"",'controller'=>'class','action'=>'perfectinfo',
		        ),
		    ),
            'inclasssetting'=> array(
		        array(
		            'module'=>"",'controller'=>'class','action'=>'inclasssetting',
		        ),
		    ),
                  'schoolsetting'=> array(
		        array(
		            'module'=>"",'controller'=>'class','action'=>'schoolsetting',
		        ),
		    ),
                  'gradesetting'=> array(
		        array(
		            'module'=>"",'controller'=>'class','action'=>'gradesetting',
		        ),
		    ),
            'inclassdone' => array(
		        array(
		            'module'=>"",'controller'=>'class','action'=>'inclassdone',
		        ),
		    ),
            'setrealname' => array(
		        array(
		            'module'=>"",'controller'=>'class','action'=>'setrealname',
		        ),
		    ),
            'applylist' => array(
		        array(
		            'module'=>"",'controller'=>'class','action'=>'applylist',
		        ),
		    ),
            'banban_exprules' => array(
                array(
                    'module'=>"",'controller'=>'class','action'=>'exprules',
                ),
            ),
            'mastersetting' => array(
                array(
                    'module'=>"",'controller'=>'class','action'=>'mastersetting',
                ),
            ),
		    //收件箱
		    'notice_receive' => array(
		        array(
		            'module'=>"",'controller'=>'notice','action'=>'receive',
		        ),
		    ),
		    'notice_historydetail' => array(
		        array(
		            'module'=>"",'controller'=>'notice','action'=>'historydetail',
		        ),
		    ),
            'notice_smshistorydetail' => array(
                array(
                    'module'=>"",'controller'=>'notice','action'=>'smshistorydetail',
                ),
            ),
            //已发送
		    'notice_history' => array(
		        array(
		            'module'=>"",'controller'=>'notice','action'=>'history',
		        ),
		    ),
            //已发送
            'notice_smshistory' => array(
                array(
                    'module'=>"",'controller'=>'notice','action'=>'smshistory',
                ),
            ),
		    'notice_receivedetail' => array(
		        array(
		            'module'=>"",'controller'=>'notice','action'=>'receivedetail',
		        ),
		    ),
		    //我的青豆
		    'bean_index' => array(
		        array(
		            'module'=>"",'controller'=>'bean','action'=>'index',
		        ),
		    ),
			//我的班费
			'fee_index' => array(
				array(
					'module'=>"",'controller'=>'expense','action'=>'index',
				),
			),
			'fee_detail' => array(
				array(
					'module'=>"",'controller'=>'expense','action'=>'expdetail',
				),
			),
            'fee_rules' => array(
                array(
                    'module'=>"",'controller'=>'expense','action'=>'exprules',
                ),
            ),
		    'fee_transfer' => array(
		        array(
		            'module'=>"",'controller'=>'expense','action'=>'transfer',
		        ),
		    ),
		    'fee_transfercard' => array(
		        array(
		            'module'=>"",'controller'=>'expense','action'=>'transfercard',
		        ),
		    ),
             //分组
            'group_index'=>array(
		        array(
		            'module'=>"",'controller'=>'group','action'=>'index',
		        ),
		    ),
            'group_create'=>array(
		        array(
		            'module'=>"",'controller'=>'group','action'=>'create',
		        ),
		    ),
            'group_update'=>array(
		        array(
		            'module'=>"",'controller'=>'group','action'=>'update',
		        ),
		    ),
            'notice_schoolnotice'=>array(
                array(
                    'module'=>"",'controller'=>'notice','action'=>'schoolnotice',
                ),
            ),
            'invite_index'=>array(
                array(
                    'module'=>"",'controller'=>'invite','action'=>'index',
                ),
//                array(
//                    'module'=>"",'controller'=>'invite','action'=>'awarddetail',
//                ),
            ),
            'invite_state'=>array(
                array(
                    'module'=>"",'controller'=>'invite','action'=>'state',
                ),
            ),
            'send'=>array(
                array(
                    'module'=>"",'controller'=>'invite','action'=>'send',
                ),
            ),

            //登录
            'login_index'=>array(
                array(
                    'module'=>"",'controller'=>'login','action'=>'index',
                ),
            ),
            'companynews'=>array(
                array(
                    'module'=>"",'controller'=>'login','action'=>'companynews',
                ),
            ),
            'educationconcept'=>array(
                array(
                    'module'=>"",'controller'=>'login','action'=>'educationconcept',
                ),
            ), 
            'joinus'=>array(
                array(
                    'module'=>"",'controller'=>'login','action'=>'joinus',
                ),
            ), 
            'worknotice'=>array(
                array(
                    'module'=>"",'controller'=>'login','action'=>'worknotice',
                ),
            ),  
            //登录 end                     
                  
        );
		return $arr;
	}

	/**
	* @author panrj 2014-05-21 
	* @var obj $controller 控制器对象
	* 获取控制器所属子菜单
	*/
	public static function getSubMenu($con)
	{
		$menu = self::sub();
		$module = $con->module ? $con->module->id : '';
		$controller = $con->id;
		$action = $con->getAction()->getId();
		foreach($menu as $key=>$val){
			foreach($val as $m){
				if($module==$m['module'] && $controller==$m['controller'] && $action==$m['action'])
					return $key;
			}
		}
		return '';
	}

	/**
	* @author panrj 2014-05-21 
	* @var obj $controller 控制器对象
	* 获取控制器所属顶级菜单
	*/
	public static function getTopMenu($con)
	{
		$menu = self::top();
		$sub = self::getSubMenu($con);
		if($sub){
			foreach($menu as $key=>$val){
				if(in_array($sub,$val))
					return $key;
			}
		}
		return '';
	}

	/**
	* @author panrj 2014-05-21 
	* @var obj $controller 控制器对象
	* 获取控制器所属顶级菜单活动css
	*/
	public static function getTopCss($con,$key)
	{
		$menu = self::getTopMenu($con);
		if($menu==$key)
			return 'active';
		return '';
	}

	/**
	* @author panrj 2014-05-21 
	* @var obj $controller 控制器对象
	* 获取控制器所属顶级菜单活动style
	*/
	public static function getTopStyle($con,$key)
	{
		$menu = self::getTopMenu($con);
		if($menu==$key)
			return 'display:block;';
		return '';
	}

	/**
	* @author panrj 2014-05-21 
	* @var obj $controller 控制器对象
	* 获取控制器所属子菜单活动css
	*/
	public static function getSubCss($con,$key)
	{
		$menu = self::getSubMenu($con);
		if($menu==$key)
			return 'active';
		return '';
	}

	public static function getSubTag($con)
	{
		$menu = self::getSubMenu($con);
		return $menu;
	}

	public static function getTopTag($con)
	{
		$menu = self::getTopMenu($con);
		return $menu;
	}
}