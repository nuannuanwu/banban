<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-11-10
 * Time: 下午3:41
 */

class PageViewCommand extends CConsoleCommand{
    public function run($args)
    {
        $cache=Yii::app()->cache;
        $dateBefore = array('-1','-2','-3');
        foreach($dateBefore as $before){
            $date = date("Y-m-d",strtotime($before." day"));
            $today=$date."pv_activeuser";//当天活跃用户缓存键
            $userids = $cache->get($today);
            $undo = array();
            if($userids && is_array($userids)){
                foreach($userids as $uid){
                    $view = $cache->get($date.'_'.$uid."pv_lastvisit");
                    if($view && is_array($view)){
                        $result = WebsiteView::setUserSiteView($uid,$view);
                        if($result){
                            $cache->delete($date.'_'.$uid."pv_lastvisit");
                        }else{
                            $undo[] = $uid;
                        }
                    }
                }
            }
            if(count($undo)){//未处理或处理失败的用户
                $cache->set($today,$undo,48*3600);
            }else{
                $cache->delete($today);
            }
        }
    }
}