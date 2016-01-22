<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/main';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

    public function init(){

    }

	//用户身份过滤规则
    public function filterInlineIdentity($filterChain){
    	mlog('filterInlineIdentity');
    	$teacherPages = array(
            'notice/send',
        );

    	$parentPages = array(

        );
    	$route = $this->id . '/' . $this->getAction()->getId();
        if (Yii::app()->user->getCurrIdentity()->isTeacher && in_array($route, $teacherPages)){
        	$message = '访问此页面需要老师身份，请切换身份后再试！';
        	$url = Yii::app()->createUrl('notice/receive');
        	MainHelper::redirectMessage($message, $url = '', $delay=3, $type = 'error');
        }

        $filterChain->run();//参数$filterChain就是执行该filter的action实例，调用$filterChain->run()其实就是执行该action了。
    }

 	protected function loginAndNotDeleted($user)    //其中$user代表Yii::app()->user即登录用户。
    {
    	if(Yii::app()->user->isGuest){
    		$this->redirect(Yii::app()->createUrl('site/login'));
    	}
    	return true;
    }

    /**
	 * @var String $action . The current action
	 * 初始化控制器beforeAction
	*/
	protected function beforeAction($action)
	{
	    BaseUrl::decodeAllGet();      // 解码GET数据的ID值
	    
        $url=Yii::app()->request->url;
        $uid=Yii::app()->user->id;
        $cache=Yii::app()->cache;
        $today=date("Y-m-d")."pv_activeuser";//当天活跃用户缓存键

        if($uid){
            $todayUserids=$cache->get($today);
            if($todayUserids&&is_array($todayUserids)){
                if(!in_array($uid,$todayUserids)){
                    $todayUserids[]=$uid;
                }
            }else{
                $todayUserids=array();
                $todayUserids[]=$uid;
            }
            $cache->set($today,$todayUserids,96*3600); //缓存96小时
            $ip=MainHelper::get_client_ip();
            $date=date("Y-m-d H:i:s");
            $cache->set(date("Y-m-d").'_'.$uid."pv_lastvisit",array('url'=>$url,'ip'=>$ip,'time'=>$date),96*3600);
        }
		return parent::beforeAction($action);
	}
}