<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-11-10
 * Time: 下午3:41
 */

class PingyinCommand extends CConsoleCommand
{
    public function run($args)
    {
        $cache=Yii::app()->cache;
        $key = 'last_userid_for_pinyin_trans';
        $lastid = $cache->get($key)?$cache->get($key):0;
        //找用户
        $userList = UCQuery::queryAll("select userid,name from tb_user where deleted=0 and  (length(pingyin)<1 or pingyin is null) and userid>".$lastid." order by userid limit 1000 ");
        $py = new py_class();

        foreach ($userList as $val) {
            $pingyin = $py->str2py(trim($val['name']));
            if($pingyin){
                try{
                    UCQuery::execute("update tb_user set pingyin='" . substr($pingyin, 0, 10) . "' where userid=" . $val['userid']);
                }catch(Exception $e){
                    echo $e->getMessage();
                    UCQuery::execute("update tb_user set pingyin='      ' where userid=" . $val['userid']);
                }
            }else{
                //转不过的，为
                UCQuery::execute("update tb_user set pingyin='      ' where userid=" . $val['userid']);
            }
            $lastid = $val['userid'];
        }
        $cache->set($key,$lastid);

        //转学校
        $key = 'last_sid_for_pinyin_trans';
        $lastid = $cache->get($key)?$cache->get($key):0;
        $schoolList = UCQuery::queryAll("select sid,name from tb_school where deleted=0  and (length(pingyin)<1 or pingyin is null) and sid>".$lastid."  order by sid limit 100");
        foreach ($schoolList as $val) {
            $schoolpingyin=$py->str2py(trim($val['name']));
            if($schoolpingyin){
                // UCQuery::execute("update tb_school set pingyin='".substr($schoolpingyin,0,10)."' where sid=".$val['sid']);
                try{
                    UCQuery::execute("update tb_school set pingyin='".substr($schoolpingyin,0,10)."' where sid=".$val['sid']);
                }catch(Exception $e){
                    echo $e->getMessage();
                    UCQuery::execute("update tb_school set pingyin='      ' where sid=" . $val['sid']);
                }
            }
            $lastid = $val['sid'];
        }
        $cache->set($key,$lastid);

        //转班级
        $key = 'last_cid_for_pinyin_trans';
        $lastid = $cache->get($key)?$cache->get($key):0;
        $classList = UCQuery::queryAll("select cid,name from tb_class where deleted=0  and (length(pingyin)<1 or pingyin is null) and cid>".$lastid."  order by cid limit 100 ");

        foreach ($classList as $val) {
            $classpingyin=$py->str2py(trim($val['name']));
            if($classpingyin){
                // UCQuery::execute("update tb_class set pingyin='".substr($classpingyin,0,10)."' where cid=".$val['cid']);
                try{
                    UCQuery::execute("update tb_class set pingyin='".substr($classpingyin,0,10)."' where cid=".$val['cid']);
                }catch(Exception $e){
                    echo $e->getMessage();
                    UCQuery::execute("update tb_class set pingyin='      ' where cid=" . $val['cid']);
                }
            }
            $lastid = $val['cid'];
        }
        $cache->set($key,$lastid);
    }
}